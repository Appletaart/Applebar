<?php

require_once("dbc.php");

class Data extends Db_object
{
    protected static $db_table = "products";
    protected static $db_table_fields = array('name', 'caption', 'description', 'time_prepare', 'price', 'photo_file', 'category_id');
    public $name;
    public $caption;
    public $description;
    public $time_prepare;
    public $price;
    public $photo_file;
    public $category_id;
    public $tmp_path;
    public $upload_directory = 'img'. DS .'products';
    
    
    public static function find_all_sort_category()
    {
        return static::find_this_query("SELECT * from " . static::$db_table . " ORDER BY category_id");
    }
    
    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "No file uploaded!";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $this->photo_file = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
        }
    }

    public function picture_path(){
        return $this->upload_directory. DS .$this->photo_file;
    }

    public function delete_photo(){

        if($this->delete_id()){
            
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->photo_file;
            return unlink($target_path) ? true : false;
        
        }else{
            return false;
        }
    }

    public function save_products_and_image()
    {
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->photo_file;

        if($this->id){
            move_uploaded_file($this->tmp_path, $target_path);
            $this->update();
            unset($this->tmp_path);
            return true;
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->photo_file) || empty($this->tmp_path)){
                $this->errors[] = "File not available";
                return false;
            }
            if(file_exists($target_path)){
                $this->errors[] = "file {$this->photo_file} exists";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if ($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }else{
                $this->errors[] = "this folder has no write rights";
                return false;
            }
        }
    }

    public function categories(){
        switch ($this->category_id >1){
            case $this->category_id===1:
                echo 'Cocktails';
                break;
            case $this->category_id===2:
                echo 'Longdrinks';
                break;
            case $this->category_id===3:
                echo 'Aperitif & digestif';
                break;
            case $this->category_id===4:
                echo 'Wine';
                break;
            case $this->category_id===5:
                echo 'Beer';
                break;
            case $this->category_id===6:
                echo 'Non Alcohol';
                break;
            case $this->category_id===7:
                echo 'Hot drinks';
                break;
        }
    }
    
}


