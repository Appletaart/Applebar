<?php

require_once ("dbc.php");

if(!session_id()){
    session_start();
}

class Order_in extends Db_object
{   protected static $db_table = "orders_index";
    protected static $db_table_fields = array('order_id', 'product_id', 'product_quaty', 'date_order');
    public $order_id;
    public $product_id;
    public $product_quaty;
    public $date_order;



    public function test_id()
    {
    foreach ($_SESSION['cart'] as $id => $quaty) {

        $product = Data::find_by_id($id);
        echo $product->id;

    }
    }

    public function test_quaty()
    {
        foreach ($_SESSION['cart'] as $id => $quaty) {

            $product = Data::find_by_id($id);
            echo $quaty;

        }
    }

}
$order_in = new Order_in();

?>