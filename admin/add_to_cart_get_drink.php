<?php include("includes/header.php")?>
<?php

$cart->add_cart();

redirect_to("../result_get_a_drink.php?id=#{$_GET['id']}");
?>


























