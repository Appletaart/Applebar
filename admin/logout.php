<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4/17/2020 AD
 * Time: 2:24 PM
 */
require_once("includes/header.php");
?>
<?php
    $session->logout();
    redirect_to("dashboard.php");
?>
