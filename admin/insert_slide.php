<?php include("includes/template_header.php"); ?>
<?php include("includes/sidebar_DBD.php");
if(!$session->is_signed_in()){
    redirect_to("login.php"); }?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-9 mb-3 bg-light rounded mx-auto">
            <form action="result_insert_slide.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12 px-0">
                        <img id="output" src="../img/promote/allcocktails.jpg" class="h-auto">
                        <div class="container">
                            <div class="ad">
                                <label for="headline" hidden></label>
                                <h2><input type="text" name="headline" class="border-0 text-center w-100" placeholder="Headline"></h2>
                                <label for="subheadline" hidden></label>
                                <textarea name="subheadline" class="border-0 text-center w-100" placeholder="Subheadline" cols="30" rows="2"></textarea>
                                <a class="btn btn-sm btn-danger text-sm-center" href="#" role="button">Start the menu</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- submit buttom-->
                <div class="row text-grey-300 p-3">
                    <small class="col-8 col-lg-10 text-muted">
                        <label for="slide_file">Insert photo (recommended size 1280 x 800 px)</label>
                        <input type="file" accept="image/*" name="slide_file" id="file" onchange="loadFile(event)" class="border-0 w-100 text-sm text-grey-300">
                    </small>
                    <div class="col-4 col-lg-2">
                        <input type="submit" name="submit" value="submit" class="btn btn-danger mr-4 mb-3">
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

