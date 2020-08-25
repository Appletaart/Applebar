<?php include("includes/header.php"); ?>


<?php



    if(isset($_POST['submit']))
    {
        $data = new Data(); // var photo to the class photo
        $data->name = $_POST['name']; // input form title
        $data->caption = $_POST['caption'];
        $data->description = $_POST['description'];
        $data->time_prepare = $_POST['time_prepare'];
        $data->price = $_POST['price'];
        $data->set_file($_FILES['file']);
        $data->category_id = $_POST['category_id'];

    if($data->save()) {

        echo $message = "Photo uploaded successfully";
        
    }else {

        echo $message = join("<br>", $data->errors);
    }
    }
var_dump(mysqli_connect_error());
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="page-header">UPLOAD</h1>
            <p><?php echo $message = ""; ?></p>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="" name="description" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="time_prepare">time_prepare</label>
                    <input type="text" name="time_prepare" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">price</label>
                    <input type="text" name="price" class="form-control">
                </div>
                <div class="form-group">
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category_id">category</label>
                    <input type="text" name="category_id" class="form-control">
                </div>
                <input type="submit" name="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

 