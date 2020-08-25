<?php


class Category extends Db_object
{
    protected static $db_table = "categories";
    protected static $db_table_fields = array('name');
    public $name;
}

$catt = new Category;