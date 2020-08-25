<?php include("includes/template_header.php"); ?>
<?php include("includes/sidebar_DBD.php");
if(!$session->is_signed_in()){
    redirect_to("login.php"); }?>

<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mb-3 bg-light rounded mx-auto">
                <form action="result_insert_drink.php" method="POST" enctype="multipart/form-data">

                <div class="row no-gutters">

                    <div class="col-md-5 mt-3">
                        <img id="output" src="../img/cocktails/er5.jpg" class="h-auto" alt="...">
                    </div>

                    <div class="col-md-7">
                        <div class="m-3">
                            <h5>
                                <label for="name" hidden></label>
                                <input type="text" name="name" class="border-0 w-100" placeholder="Drink name" value="<?php /*echo $data->name = $_GET['name']; */?>">
                            </h5>
                            <p class="card-text">
                                <label for="caption" hidden></label>
                                <input type="text" name="caption" class="border-0 w-100" placeholder="Tell something about your drink" value="<?php /*echo $data->caption = $_GET['caption']; */?>">
                            </p>

                                <label for="description" hidden></label>
                                <textarea name="description" class="border-0 w-100" placeholder="Descripes details about your drink • How do the customer feel about the drink after drink your cocktail • What is the ingredients that you put in to make your drink impress to the customer?" cols="30" rows="5" value="<?php /*echo $data->description = $_GET['description']; */?>"></textarea>

                            <p><small class="text-muted">
                                <label for="time_prepare">How many minutes to prepare your drink? Give the cifer</label>
                                <input type="text" name="time_prepare" class="border-0 w-100 text-sm text-grey-300" placeholder="3" value="<?php /*echo $data->time_prepare = $_GET['time_prepare']; */?>">
                            </small></p>
                            <p><small class="text-muted">
                                <label for="price">Drink price (€)</label>
                                <input type="text" name="price" class="border-0 w-100 text-sm text-grey-300" placeholder="10"  value="<?php /*echo $data->price = $_GET['price']; */?>">
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
                                    <option value=1>Cocktails</option>
                                    <option value=2>Longdrinks</option>
                                    <option value=3>Aperitif & digestif</option>
                                    <option value=4>Wine</option>
                                    <option value=5>Beer</option>
                                    <option value=6>Non-alcohol</option>
                                    <option value=7>Hot drinks</option>
                                </select></small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- submit buttom-->
                <div class="row justify-content-end">
                    <input type="submit" name="submit" value="Submit" class="btn btn-danger mr-4 mb-3">
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

 