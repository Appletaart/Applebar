<?php include("includes/template_header.php"); ?>

<?php include("includes/template_sidebar_NoHB.php"); ?>

<?php
/*if(isset($_GET['preview']))
{
    $data = new Data();
    $data->name = $_GET['name'];
    $data->caption = $_GET['caption'];
    $data->description = $_GET['description'];
    $data->time_prepare = $_GET['time_prepare'];
    $data->price = $_GET['price'];
    $data->category = $_GET['category'];
    $data->set_file($_FILES['file']);
}*/
if(isset($_POST['submit']))
{
    $data = new Data(); //
    $data->name = $_POST['name'];
    $data->caption = $_POST['caption'];
    $data->description = $_POST['description'];
    $data->time_prepare = $_POST['time_prepare'];
    $data->price = $_POST['price'];
    $data->category_id = $_POST['category_id'];
    $data->set_file($_FILES['photo_file']);
    var_dump($data);
    if($data->save()) {

        echo "Photo uploaded successfully";

    }else {

        echo "", $data->errors;
    }
}
?>

<div class="container-fluid">
    <form action="backup_typeform.php" method="get" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3">
                <div class="card mb-3">
                    <img id="output1" src="img/products/Blood orange gin.jpg" class="menucard-img" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Drink Name<?php echo $data->name = $_GET['name']; ?></h5>
                        <p class="card-text">This is a wider card.<?php echo $data->caption = $_GET['caption']; ?></p>
                        <p class="card-text"><small class="text-muted">Prepare time 3 mins<?php echo $data->time_prepare = $_GET['time_prepare']; ?></small></p>
                    </div>
                </div>
            </div>
            <div class="col-9 card mb-3" style="max-width: 700px;">
                <div class="row no-gutters">
                    <div class="col-md-5 mt-3">
                        <img id="output2" src="img/products/Blood orange gin.jpg" class="menucard-img" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Prepare time 3 mins</small></p>
                            <h5 class="card-title">€10</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- test-->
            <div class="col-9 mb-3 bg-light rounded" >
                <div class="row no-gutters">
                    <div class="col-md-5 mt-3">
                        <img id="output" src="img/products/Blood orange gin.jpg" class="menucard-img" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="m-3">
                            <h5>
                                <label for="name" hidden></label>
                                <input type="text" name="name" class="border-0 w-100" placeholder="Drink name" value="<?php echo $data->name = $_GET['name']; ?>">
                            </h5>
                            <p class="card-text">
                                <label for="caption" hidden></label>
                                <input type="text" name="caption" class="border-0 w-100" placeholder="Tell something about your drink" value="<?php echo $data->caption = $_GET['caption']; ?>">
                            </p>
                            <p>
                                <label for="description" hidden></label>
                                <textarea id="" name="description" class="border-0 w-100" placeholder="Descripes details about your drink • How do the customer feel about the drink after drink your cocktail • What is the ingredients that you put in to make your drink impress to the customer?" cols="30" rows="5" value="<?php echo $data->description = $_GET['description']; ?>"></textarea>
                            </p>
                            <p><small class="text-muted">
                                    <label for="time_prepare">How many minutes that your spend time to make your drink? Give the cifer</label>
                                    <input type="text" name="time_prepare" class="border-0 w-100 text-sm text-grey-300" placeholder="3" value="<?php echo $data->time_prepare = $_GET['time_prepare']; ?>">
                                </small></p>
                            <p><small class="text-muted">
                                    <label for="price">Drink price (€)</label>
                                    <input type="text" name="price" class="border-0 w-100 text-sm text-grey-300" placeholder="10"  value="<?php echo $data->price = $_GET['price']; ?>">
                                </small></p>
                            <div class="col-12 text-grey-300 p-0">
                                <small class="text-muted">
                                    <label for="photo_file">Insert photo</label>
                                    <input type="file"  accept="image/*" name="photo_file" id="file"  onchange="loadFile(event)" class="border-0 w-100 text-sm text-grey-300">
                                </small>
                            </div>
                            <div class="form-group col-md-6 p-0">
                                <small class="text-muted">
                                    <label for="category_id">Category</label>
                                    <select id="category_id" name="category_id" class="form-control">
                                        <option selected>Choose...</option>
                                        <option value="cocktails" <?php if($category_id==='products') echo 'selected="selected"';?> >Cocktails</option>
                                        <option value="longdrinks" <?php if($category_id==='longdrinks') echo 'selected="selected"';?> >Longdrinks</option>
                                        <option value="wine" <?php if($category_id==='wine') echo 'selected="selected"';?> >Wine</option>
                                        <option value="non-alcohol" <?php if($category_id==='non-alcohol') echo 'selected="selected"';?> >Non-alcohol</option>
                                    </select></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-auto">
                <input type="" name="preview" value="Preview" value="Get Selected Values" class="btn btn-outline-primary mr-3">
                <input type="submit" name="submit" value="submit" value="Get Selected Values" class="btn btn-danger">
            </div>
            <!--form-->
        </div>
    </form>
    <!--Container-fluid-->
</div>

<div class="col-md-3">
    <!--preview photo-->
    <img id="output" class="bg-profile border-bottom-danger" /><br>
    <input type="file"  accept="image/*" name="photo_file" id="file"  onchange="loadFile(event)" style="display: none;">
</div>
<div id="navMenu" onload="hidenavmenu();">
    <ul class="pagination pagination-sm justify-content-center m-0">
        <li class="page-item"><a class="page-link" onclick="mainp1();">1</a></li>
        <li class="page-item"><a class="page-link" onclick="mainp2();">2</a></li>
        <li class="page-item"><a class="page-link" onclick="mainp3();">3</a></li>
        <li class="page-item"><a class="page-link" onclick="mainp4();">4</a></li>
    </ul>
</div>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
<?php include("includes/footer.php"); ?>

 