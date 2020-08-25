<?php include("includes/template_header.php"); ?>
<?php include("includes/template_topbar.php"); ?>

<?php

if(!$session->is_signed_in()){
    redirect_to("login.php"); }

if(isset($_POST['submit']))
{
    $data = new Data();
    $data->name = $_POST['name'];
    $data->caption = $_POST['caption'];
    $data->description = $_POST['description'];
    $data->time_prepare = $_POST['time_prepare'];
    $data->price = $_POST['price'];
    $data->category_id = $_POST['category_id'];
    $data->set_file($_FILES['photo_file']);
    $data->save();
    //var_dump($data);

    if($data->save_products_and_image()) {
        $catts = Category::find_by_id($data->category_id);
        
        echo '<div class="container-fluid">
            <div class="row">
            <div class="col-4">
            <div class="card mb-3">
                <img src="'. $data->picture_path() .'"  class="menucard-img" >
                <div class="card-body">
                    <h5 class="card-title">'. $data->name .'</h5>
                    <p class="card-text">'. $data->caption .'</p>
                    <p class="card-text"><small class="text-muted">Prepare time '.$data->time_prepare .' mins</small></p>
                    <a href="#" class="btn btn-danger">push to order</a>
                </div>
            </div>
        </div>
            <div class="col-8 card mb-3" style="max-width: 750px;">
            <div class="row no-gutters">
                <div class="col-md-5 mt-3">
                    <img src="'. $data->picture_path() .'" class="menucard-img" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">'. $data->name .'</h5>
                        <p class="card-text"><small class="text-muted">' . $catts->name . '</small></p>
                        <p class="card-text"><small class="text-muted">'.$data->category_id.'</small></p>
                        <p class="card-text">'.$data->caption.'</p>
                        <p class="card-text">'.$data->description.'</p>
                        <p class="card-text"><small class="text-muted">Prepare time '. $data->time_prepare .' mins</small></p>
                        <h5 class="card-title"> € '.$data->price.'</h5>
                        <a href="#" class="btn btn-danger">push to order</a>
                    </div>
                </div>
            </div>
        </div>
            </div>';}else {
            echo $data->upload_errors_array;
            }
}

?>


<script>
    //show preview photo
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
<?php include("includes/template_footer.php"); ?>

 