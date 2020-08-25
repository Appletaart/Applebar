<?php include("includes/template_header.php"); ?>
<?php include("includes/sidebar_DBD.php"); ?>
<?php
if(!$session->is_signed_in()){
    redirect_to("login.php"); }

if(isset($_POST['submit']))
{
    $slide = new Slide();
    $slide->headline = $_POST['headline'];
    $slide->subheadline = $_POST['subheadline'];
    $slide->set_file($_FILES['slide_file']);
    $slide->slide_path_and_placeholder();
    $slide->save(); //  save() ใช้ save slice with place holder
   
    if($slide->save_slide()){ //save_slide and show below
        echo '<div class="container-fluid">
                <div class="row my-5">
                <div class="col-md-10 mt-5 mx-auto">
                     <img src="'. $slide->slide_path_and_placeholder() .'" class="h-auto" alt="...">
                     <div class="container">
                      <div class="carousel-caption">
                       <h5 class="card-title">'. $slide->headline .'</h5>
                       <p class="card-text">'. $slide->subheadline .'</p>
                       <a href="#" class="btn btn-danger">push to order</a>
                      </div>               
                     </div>   
                </div>
                </div>
              </div>';
        }
    else {
        echo $slide->upload_errors_array;
    }
}

?>

<?php include("includes/template_footer.php"); ?>

 