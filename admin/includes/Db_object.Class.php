<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/13/2020 AD
 * Time: 11:22 PM
 */
class Db_object
{
    public $id;
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload max_filesize from php.ini",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds MAX_FILE_SIZE in php.ini for html form",
        UPLOAD_ERR_NO_FILE => "No file uploaded",
        UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write to disk",
        UPLOAD_ERR_EXTENSION => "A php extension stopped your upload"
    );

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " .  static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);
    }

    public static function find_all()
    {
        return static::find_this_query("SELECT * from " . static::$db_table);
    }

    public static function find_all_DESC()
    {
        return static::find_this_query("SELECT * from " . static::$db_table . " ORDER BY " . static::$db_table ." . id DESC");
    }
    
    public static function find_by_id($id)
    {
        $result = static::find_this_query("SELECT * from " . static::$db_table . " WHERE id=$id LIMIT 1");
        return !empty($result) ? array_shift($result) : false;
    }

    public static function find_by_crdate()
    {
        date_default_timezone_set("Europe/Brussels");
        return static::find_this_query("SELECT * from " . static::$db_table . " WHERE DATE(date_order)=DATE(NOW())");
    }

    public static function count_by_crdate()
    {
        global $database;
        date_default_timezone_set("Europe/Brussels");
        $sql = "SELECT COUNT(id) from " . static::$db_table . " WHERE DATE(date_order)=DATE(NOW())";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);

        return $result;
    }
    
    public static function find_by_crdate_limit()
    {
        date_default_timezone_set("Europe/Brussels");
        return static::find_this_query("SELECT * from " . static::$db_table . " WHERE DATE(date_order)=DATE(NOW()) LIMIT 1");
    }

    public static function find_by_crdate_DESC()
    {
        date_default_timezone_set("Europe/Brussels");
        return static::find_this_query("SELECT * from " . static::$db_table . " WHERE DATE(date_order)=DATE(NOW()) ORDER BY id DESC");
    }

    public static function find_this_query($sql)
    {
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = static::instantie($row);
        }
        return $the_object_array;
    }

    public static function instantie($result)
    {   $calling_class = get_called_class(); // late static bining
        $the_object = new $calling_class;
        foreach ($result as $the_attribute => $value) {
            if($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database;
        $properties = $this->clean_properties();
        //var_dump($properties);
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('" . implode("','", array_values($properties)) . "')";
        //var_dump($sql);
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }

        $database->query($sql);
    }
// function update doesn't werk. @key[1] doesn't show
    public function update()
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_assoc = array();

        foreach ($properties as $key => $value) {
            $properties_assoc[] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(', ', $properties_assoc);
        $sql .= " WHERE id =" . $database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function delete_id()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table;
        $sql .= " WHERE id =" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }
    
}

?>