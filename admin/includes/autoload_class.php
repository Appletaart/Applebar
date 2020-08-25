<?php

function classAutoLoader($class)
{
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
    if(is_file($the_path)) {
        if(file_exists($the_path) && !class_exists($class)) {
            include($the_path);
        } else {
            die("This file name {$class}.php was not found");
        }
    }
}

spl_autoload_register("classAutoLoader");

/*spl_autoload_register('myAutoLoader');

function myAutoLoader($classname)
{
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if(strpos($url, 'includes')!== false){
        $the_path = '../includes/';
    }
    else {
        $the_path = '.includes/';
    }
    $extension ='.class.php';

    require_once $the_path . $classname . $extension;
}*/

function redirect_to($location){
    header("Location: $location");
}

/*$config['global_xss_filtering'] = true;
$autoload['helper'] = array('html', 'url', 'form','security');*/
