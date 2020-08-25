<?php include("includes/template_header.php");?>
<?php include("includes/sidebar_DBD.php");
if(!$session->is_signed_in()){
    redirect_to("login.php"); }
?>

    <div class="container-fluid p-0">
        <div class="row">
            <?php $slides = Slide::find_all(); ?>
            <?php foreach ($slides as $slide): ?>
                <div class="container my-3">
                    <div class="row">
                        <div class="col-md-10 mt-3 mx-auto">
                            <a href="result_edit_a_slide.php?id=<?php echo $slide->id; ?>"><img src="<?php echo $slide->slide_path_and_placeholder(); ?>" class="h-auto" alt="..."></a>
                            <div class="container">
                                <div class="carousel-caption">
                                    <h5 class="card-title"><?php echo $slide->headline; ?></h5>
                                    <p class="card-text"><?php echo $slide->subheadline; ?></p>
                                    <a href="result_edit_a_slide.php?id=<?php echo $slide->id; ?>" class="btn btn-success"><i class="fas fa-edit"></i> Update</a>
                                    <a href="delete_slide.php?id=<?php echo $slide->id; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php include("includes/footer.php")?>