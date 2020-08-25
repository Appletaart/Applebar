<?php

require_once ("dbc.php");

if(!session_id()){
    session_start();
}

class Cart extends Db_object
{
    protected static $db_table = "orders";
    protected static $db_table_fields = array('table_id', 'products_id', 'quantity', 'totals_price', 'totals_time_prepare', 'date_order');
    public $table_id; //table number
    public $products_id; // array product id with all information
    public $quantity; // array link with product id
    public $totals_price; // drink infor price * quantity
    public $totals_time_prepare; // drink in for prepare_time * quantity
    public $date_order; // date to make order

    /*public $quaty;
    public $total_cost; // must be the same as $cart->totals_price*/

    public function products_id()
    {
        foreach ($_SESSION['cart'] as $id => $quaty){
            $product_id[] = "($id, $quaty)";
            $product = Data::find_by_id($id);
            $id = array('id' => 'No: '. $product->id, 'name' => ' '. $product->name, 'price' => ' €'.$product->price, 'quaty' => ' qty '.$quaty, 'cost' => ' = €'.$product->price * $quaty .'</br>');
            foreach ($id as $key => $value){
                echo /*$key .' = '.*/ $value; /*echo ", "; &nbsp; = spatie*/
            }
        }
       // $insert_id = implode(',', $product_id);
    }


    public function add_cart()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 1;
        }

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = "empty";
        }

        switch ($action) {
            case "add":
                if (isset($_SESSION['cart'][$id])) { //have value 1 in the some id
                    $_SESSION['cart'][$id]++; // increase 1 in the same id
                } else {
                    $_SESSION['cart'][$id] = 1; // if not the same id, so this id has the same number
                }
                break;
            case "remove":
                if (isset($_SESSION['cart'][$id])) { //have value 1 in the some id

                    $_SESSION['cart'][$id]--; // decrease 1 from the same id

                    if ($_SESSION['cart'][$id] == 0) { // if decrease the value until 0,
                        unset($_SESSION['cart'][$id]); //so remove this order id from the cart, it is not gonna show = 0
                    }
                }
                break;
            case "empty":
                unset($_SESSION['cart'][$id]); //so remove this order id from the cart, it is not gonna show = 0
                break;
        }

    } // don't touch it again just see how to change to redirect to the current page
    

    public function add_order()
    {
        if (isset($_SESSION['cart'])) {
            $total_cost = 0;
            $quantity = 0;
            $quaty = "";
            foreach ($_SESSION['cart'] as $id => $quaty) {
                $product = Data::find_by_id($id);
                $cost = $product->price * $quaty; // $quaty is quantity.
                $quantity += $quaty;
                $total_cost = $total_cost + $cost;
            }
            if ($quaty > 0) {
                echo "<p class='text-light pl-2 pr-2 pb-0 m-0'> $quantity </p>";
            }
        } else {
            echo "<p class='text-light pl-2 pr-2 pb-0 m-0'> Empty</p>";
        }
    }

    public function delete_order(){ //delete order/cart

        if($this->delete_id()){

            global $database;
            $sql = "DELETE FROM orders_index";
            $sql .= " WHERE order_id =" . $database->escape_string($this->id);

            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;

        }else{
            return false;
        }
    }
    

    public function add_time_prepare()
    {
        if (isset($_SESSION['cart'])) {
            $totals_time_prepare = 0;
            $quaty = "";
            foreach ($_SESSION['cart'] as $id => $quaty) {
                $product = Data::find_by_id($id);
                $totals_time_prepare += $product->time_prepare * $quaty;
            }
            if ($quaty > 0) {
                echo $totals_time_prepare;
            }
        } else {
            echo "<p class='text-light pt-2 pr-3 pb-0 m-0'> Empty</p>";
        }
    }

    public function sum_total_glass(){

        global $database;
        $sql = "SELECT SUM(quantity) FROM orders";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);

        return $result;
    }

    public function sum_total_glass_per_d(){
        date_default_timezone_set("Europe/Brussels");
        $c_m = date('Y-m-d');
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index WHERE date_order= '$c_m'";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);

        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }

    public function first_order(){
        global $database;
        date_default_timezone_set("Europe/Brussels");
        $sql ="SELECT date_order from orders WHERE DATE(date_order)=DATE(NOW()) LIMIT 1";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        return $result;
    }

    public function sum_order(){
        global $database;
        date_default_timezone_set("Europe/Brussels");
        $sql ="SELECT COUNT(id) from orders WHERE DATE(date_order)=DATE(NOW())";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        return $result;
    }

    public function sum_income_today(){
        global $database;
        date_default_timezone_set("Europe/Brussels");
        $sql ="SELECT SUM(totals_price) from orders WHERE DATE(date_order)>=DATE(NOW())";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }
    
/*start function for graph*/
    public function max_sale(){

        global $database;
        $sql = "SELECT product_id, SUM(product_quaty) FROM orders_index GROUP by product_id ORDER BY SUM(product_quaty) DESC LIMIT 1";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        return $result;
    }

    public function max_salename(){
        $this->max_sale();
        $product = Data::find_by_id($this->max_sale());
        return $product->name;
    }

    public function max_salecat(){
        $this->max_sale();
        $product = Data::find_by_id($this->max_sale());
        $catt = Category::find_by_id($product->category_id);
        return $catt->name;
    }


    public function sum_month(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 4";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }

    public function sum_may(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 5";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }

    public function sum_jun(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 6";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }

    public function sum_jul(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 7";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }

    public function sum_aug(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 8";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }
    public function sum_sep(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 9";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }
    public function sum_oct(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 10";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }
    public function sum_nov(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 11";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }
    public function sum_dec(){
        global $database;
        $sql = "SELECT SUM(product_quaty) FROM orders_index where YEAR(date_order) = 2020 AND MONTH(date_order) = 12";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }

    public function count_time(){
        global $database;
        $sql = "SELECT COUNT(id) FROM orders where HOUR(date_order) BETWEEN 18 AND 21";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        $result = array_shift($row);
        if($result>0){
            return $result;
        } else{
            echo "0";
        }
    }

    /*start function for graph*/

    // echo $diff_timestamp
    function getDateTimeDiff($date)
    {
        $now_timestamp = strtotime(date('Y-m-d H:i:s'));
        $diff_timestamp = $now_timestamp - strtotime($date);

        if ($diff_timestamp < 60){
            return 'few second ago';
        }elseif ($diff_timestamp >= 60 && $diff_timestamp<3600){
            return round($diff_timestamp/60).' mins ago';

        }elseif ($diff_timestamp >= 3600 && $diff_timestamp<86400){
            return round($diff_timestamp/60).' hours ago';

        }elseif ($diff_timestamp >= 86400 && $diff_timestamp<(86400*30)){
            return round($diff_timestamp/60).' days ago';

        }elseif ($diff_timestamp >= (86400*30) && $diff_timestamp<(86400*365)){
            return round($diff_timestamp/60).' months ago';

        }else {
            return round($diff_timestamp/(86400*365)).' years ago';
        }

        echo date('Y-m-d H:i:s').'<br>';
        echo getDateTimeDiff('1976-04-13 22:28:00').'<br>';
        echo getDateTimeDiff('1982-03-26 21:35:00').'<br>';
        echo getDateTimeDiff('2012-03-16 14:40:00');
    }

    function timediff($time){
        $now_timestamp = strtotime(date('Y-m-d H:i:s'));
    }

}

$cart = new Cart;