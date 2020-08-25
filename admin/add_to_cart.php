<?php include("includes/header.php")?>
<?php $cart->add_cart();
//header("location:javascript://history.go(-1)#{$_GET['id']}"); good but doesn't update cart realtime
// or use
//header('Location: ' . $_SERVER['HTTP_REFERER']);
redirect_to("../see_all_product.php?page={$_GET['page']}#{$_GET['id']}");

//redirect_to("../cocktails.php?page={$_GET['page']}#{$_GET['id']}");

?>


























