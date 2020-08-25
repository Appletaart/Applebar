<?php include("includes/header.php")?>
<?php $cart->add_cart();
redirect_to("../cocktails.php?page={$_GET['page']}#{$_GET['id']}");
?>


























