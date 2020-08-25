<?php include("includes/header.php")?>
<?php $cart->add_cart();
redirect_to("../hot_drink.php?page={$_GET['page']}#{$_GET['id']}");
?>


























