<?php include("includes/header.php");

    if(empty($_GET['id'])){
    redirect_to("see_all_product_edit.php");
}else{
    $data = Data::find_by_id($_GET['id']);
    $data->delete_photo();
    redirect_to("see_all_product_edit.php");}
?>

<?php include("includes/footer.php");?>

