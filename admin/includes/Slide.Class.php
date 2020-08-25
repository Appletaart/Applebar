<?php

class Slide extends Db_object
{
    protected static $db_table = "slides";
    protected static $db_table_fields = array('headline', 'subheadline', 'slide_file');
    public $headline;
    public $subheadline;
    public $slide_file;
    public $tmp_path;
    public $type;
    public $size;
    public $upload_directory = 'img'. DS .'slides';
    public $image_placeholder = 'allcocktails.jpg';

    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "No file uploaded!";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $this->slide_file = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

        }
    }

    public function slide_path_and_placeholder(){

        return empty($this->slide_file) ? $this->upload_directory. DS . $this->image_placeholder : $this->upload_directory. DS . $this->slide_file;
    }

    public function picture_path(){
        return $this->upload_directory. DS .$this->slide_file;
    }

    public function delete_slide(){

        if($this->delete_id()){

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->slide_file;

            return unlink($target_path) ? true : false;

        }else{
            return false;
        }
    }

    public function save_slide()
    {
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->slide_file;

        if($this->id){
            move_uploaded_file($this->tmp_path, $target_path);
            $this->update();
            unset($this->tmp_path);
            return true;
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->slide_file) || empty($this->tmp_path)){
                $this->errors[] = "File not available";
                return false;
            }
            if(file_exists($target_path)){
                $this->errors[] = "file {$this->slide_file} exists";
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
}