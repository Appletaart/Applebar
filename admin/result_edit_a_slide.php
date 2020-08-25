<?php include("includes/template_header.php"); ?>
<?php include("includes/sidebar_DBD.php"); ?>
<?php
/*if(!$session->is_signed_in()){
    redirect_to("login.php"); }*/

if(empty($_GET['id'])){
    redirect_to("see_all_slide_edit.php");
}

$slide = Slide::find_by_id($_GET['id']);

if(isset($_POST['submit'])){

        if($slide) {
            $slide->headline = $_POST['headline'];
            $slide->subheadline = $_POST['subheadline'];

        if(empty($_FILES['slide_file'])) {
            $slide->save();
        //redirect_to("see_all_slide_edit.php");
        } else {
            $slide->set_file($_FILES['slide_file']);
            $slide->save_slide();
            redirect_to('see_all_slide_edit.php');
        }
        }
        else {
            echo $slide->errors;
        }
}

?>

<div class="container-fluid">
    <div class="row my-5">
        <div class="col-9 mb-3 bg-light rounded mx-auto">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 px-0">
                        <img id="output" src="<?php echo $slide->slide_path_and_placeholder(); ?>" class="h-auto">
                        <div class="container">
                            <div class="ad">
                                <label for="headline" hidden></label>
                                <h2><input type="text" name="headline" class="border-0 text-center w-100" placeholder="Headline" value="<?php echo $slide->headline; ?>"></h2>
                                <label for="subheadline" hidden></label>
                                <textarea name="subheadline" class="border-0 text-center w-100" placeholder="Subheadline" cols="30" rows="2" ><?php echo $slide->subheadline; ?></textarea>
                                <a class="btn btn-sm btn-danger text-sm-center" href="#" role="button">Start the menu</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- submit buttom-->
                <div class="row text-grey-300 p-3">
                    <small class="col-10 text-muted">
                        <label for="slide_file">Insert photo (recommended size 1280 x 800 px)</label>
                        <input type="file" accept="image/*" name="slide_file" id="file" onchange="loadFile(event)" class="border-0 w-100 text-sm text-grey-300">
                    </small>
                    <div class="col-2">
                        <input type="submit" name="submit" value="Update" class="btn btn-danger mr-4 mb-3">
                    </div>
                </div>
            </form>
            <!--form-->
        </div>
    </div>
    <script>
        //show preview photo
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <!--Container-fluid-->
</div>

<?php include("includes/template_footer.php"); ?>

