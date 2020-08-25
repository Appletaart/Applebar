<?php include("includes/header.php")?>
<?php $cart->add_cart();
redirect_to("../non_alcohol.php?page={$_GET['page']}#{$_GET['id']}");
?>


























