<?php


class Table extends Db_object
{
    protected static $db_table = "customers_table";
    protected static $db_table_fields = array('name');
    public $name;
}

