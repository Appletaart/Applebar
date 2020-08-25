<?php include("includes/header.php");

    if(empty($_GET['id'])){
    redirect_to("see_all_slide_edit.php");
}else{
    $slide = Slide::find_by_id($_GET['id']);
    $slide->delete_slide();
    redirect_to("see_all_slide_edit.php");}
?>

<?php include("includes/footer.php");?>

