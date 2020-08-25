<?php
/// change user_id to admin_id
 
class Session
{
    private $signed_in = false; // set false as default
    public $admin_id;
    public $order_id;

    function __construct()
    {
        session_start();
        $this->check_the_login();
        $this->check_message();
    }

    // begin login method
    public function is_signed_in()
    {
        return $this->signed_in;
    }

    public function login($admin){
        if($admin){
            $this->admin_id = $_SESSION['admin_id'] = $admin->admin_id;// false if $admin->id
            $this->admin_name = $_SESSION['admin_name'] = $admin->admin_name;
            $this->signed_in = true;
        }
    }

    // begin log out method
    public function logout(){
        unset($_SESSION['admin_id']);
        unset($this->admin_id);
        $this->signed_in = false;
    }


    private function check_the_login(){
        if(isset($_SESSION['admin_id'])){
            $this->admin_id = $_SESSION['admin_id'];
            $this->signed_in = true;
        }
        else{
            unset($this->admin_id);
            $this->signed_in = false;
        }
    }

    public function message($msg=""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }
        else{
            return $this->message;
        }
    }

    private function check_message(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        else{
            $this->message = "";
        }
    }
    
    // write self
    public function choose_table(){
        if(isset($_GET['table_id'])) {
            $_SESSION['table_id'] = $_GET['table_id'];
        }
    }


    public function remove_table()
    {
        unset($_SESSION['table_id']);
        unset($this->table_id);
        $this->choose_table = false;
    }

    public function remove_cart()
    {
        unset($_SESSION['cart']);
        unset($this->cart);
        $this->remove_cart = false;
    }
}

$session = new Session();

?>

