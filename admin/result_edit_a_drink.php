<?php include("includes/template_header.php"); ?>
<?php include("includes/sidebar_DBD.php"); ?>
<?php

if(!$session->is_signed_in()){
    redirect_to("login.php"); }

if(empty($_GET['id'])){
    redirect_to("see_all_product_edit.php");
}

$data = Data::find_by_id($_GET['id']);

if(isset($_POST['submit'])){

        if($data) {
        $data->name = $_POST['name'];
        $data->caption = $_POST['caption'];
        $data->description = $_POST['description'];
        $data->time_prepare = $_POST['time_prepare'];
        $data->price = $_POST['price'];
        $data->category_id = $_POST['category_id'];

        if(empty($_FILES['photo_file'])) {
        $data->save();
        //redirect_to("see_all_product_edit.php");
        } else {
            $data->set_file($_FILES['photo_file']);
            $data->save_products_and_image();
            $data->save();
            redirect_to('see_all_product_edit.php');
        }

        }
        else {
            echo $data->errors;
        }
}

?>

<div class="row">

    <div class="col-12 col-lg-10 mb-3 bg-light rounded mx-auto">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row no-gutters">
                <div class="col-md-5 mt-3">
                    <img id="output" src="<?php echo $data->picture_path(); ?>" class="menucard-img">
                </div>
                <div class="col-md-7">
                    <div class="m-3">
                        <h5>
                            <label for="name" hidden></label>
                            <input type="text" name="name" class="border-0 w-100" placeholder="Drink name" value="<?php echo $data->name; ?>">
                        </h5>
                        <p class="card-text">
                            <label for="caption" hidden></label>
                            <input type="text" name="caption" class="border-0 w-100" placeholder="Tell something about your drink" value="<?php echo $data->caption; ?>">
                        </p>

                        <label for="description" hidden></label>
                        <textarea name="description" class="border-0 w-100" cols="30" rows="5" ><?php echo $data->description; ?></textarea>

                        <p><small class="text-muted">
                                <label for="time_prepare">How many minutes to prepare your drink? Give the cifer</label>
                                <input type="text" name="time_prepare" class="border-0 w-100 text-sm text-grey-300" placeholder="3" value="<?php echo $data->time_prepare; ?>">
                            </small></p>
                        <p><small class="text-muted">
                                <label for="price">Drink price (€)</label>
                                <input type="text" name="price" class="border-0 w-100 text-sm text-grey-300" placeholder="10"  value="<?php echo $data->price; ?>">
                            </small></p>
                        <div class="col-12 text-grey-300 p-0">
                            <small class="text-muted">
                                    <label for="photo_file">Insert photo</label>
                                    <input type="file" accept="image/*" name="photo_file" id="file" onchange="loadFile(event)" class="border-0 w-100 text-sm text-grey-300">
                            </small>
                        </div>
                        <div class="form-group col-md-6 p-0">
                            <small class="text-muted">
                                <label for="category_id">Category</label>
                                <select id="category_id" name="category_id" class="form-control">
                                    <option selected>Choose...</option>
                                    <option value=1 <?php if($data->category_id==1) echo 'selected="selected"';?>>Cocktails</option>
                                    <option value=2 <?php if($data->category_id==2) echo 'selected="selected"';?>>Longdrinks</option>
                                    <option value=3 <?php if($data->category_id==3) echo 'selected="selected"';?>>Aperitif & digestif</option>
                                    <option value=4 <?php if($data->category_id==4) echo 'selected="selected"';?>>Wine</option>
                                    <option value=5 <?php if($data->category_id==5) echo 'selected="selected"';?>>Beer</option>
                                    <option value=6 <?php if($data->category_id==6) echo 'selected="selected"';?>>Non-alcohol</option>
                                    <option value=7 <?php if($data->category_id==7) echo 'selected="selected"';?> >Hot drinks</option>
                                </select>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- submit buttom-->
            <div class="row justify-content-end">
                <button  type="submit" name="submit" class="btn btn-success mr-4 mb-3"><i class="fas fa-edit"></i> Update</button>
                <a href="delete_product.php?id=<?php echo $data->id; ?>" class="btn btn-danger mr-4 mb-3"><i class="fas fa-trash-alt"></i> Delete</a>
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

