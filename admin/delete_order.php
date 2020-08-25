<?php include("includes/header.php");

    if(empty($_GET['id'])){
    redirect_to("getOrder.php");
}else{
    $order = Cart::find_by_id($_GET['id']);
    $order->delete_order();
    redirect_to("getOrder.php");}
?>

<?php include("includes/footer.php");?>

