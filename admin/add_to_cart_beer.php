<?php include("includes/header.php")?>
<?php $cart->add_cart();
redirect_to("../beer.php?page={$_GET['page']}#{$_GET['id']}");
?>


























