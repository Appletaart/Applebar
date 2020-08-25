<?php

class Admins extends Db_object
{
    protected static $db_table = "admins";
    protected static $db_table_fields = array('admin_id', 'admin_name', 'password');
    public $admin_id;
    public $admin_name;
    public $password;
   

    // for verify admin
    public static function verify_admin($admin, $pass)
    {
        global $database;
        $admin_name = $database->escape_string($admin);
        $password = $database->escape_string($pass);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE ";
        $sql .= "admin_name = '{$admin_name}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = static::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    
    // write self
    public static function find_by_user($admin_name)
    {
        $result = static::find_this_query("SELECT * from " . static::$db_table . " WHERE admin_name LIKE '$admin_name'");
        return !empty($result) ? array_shift($result) : false;
    }

    public static function find_by_admin_id($admin_id)
    {
        $result = static::find_this_query("SELECT * from " . static::$db_table . " WHERE admin_id=$admin_id LIMIT 1");
        return !empty($result) ? array_shift($result) : false;
    }

    public function update_admin_id()
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_assoc = array();

        foreach ($properties as $key => $value) {
            $properties_assoc[] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(', ', $properties_assoc);
        $sql .= " WHERE admin_id =" . $database->escape_string($this->admin_id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    
    public function delete_admin_id()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table;
        $sql .= " WHERE admin_id =" . $database->escape_string($this->admin_id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }
}

$admins = new Admins();
?>