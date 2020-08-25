<?php include("includes/header.php");

    if(empty($_GET['admin_id'])){
    redirect_to("crud_admin.php");
}else{
    $admins = Admins::find_by_admin_id($_GET['admin_id']);
    $admins->delete_admin_id();
    redirect_to("crud_admin.php");}
?>

<?php include("includes/footer.php");?>

