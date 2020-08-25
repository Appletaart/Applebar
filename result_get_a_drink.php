<?php include("includes/header_product.php"); ?>
<?php include("includes/sidebar.php"); ?>

<?php

if(empty($_GET['id'])){
    redirect_to("see_all_product.php");
}

if($data = Data::find_by_id($_GET['id'])){
   $catts = Category::find_by_id($data->category_id);

}else {
    echo $data->errors;
}?>

     <div class="container-fluid">

    <div class="row">

        <div class="col-10 card mb-3 mx-auto">
            <div class="row no-gutters">
                <div class="col-md-5 mt-3 pb-3">
                    <img src="admin/<?php echo $data->picture_path(); ?>" class="menucard-img">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data->name;?></h5>
                        <p class="card-text"><small class="text-muted"><?php echo $catts->name; ?></small></p>
                        <p class="card-text"><?php echo $data->caption;?></p>
                        <p class="card-text"><?php echo $data->description; ?></p>
                        <p class="card-text"><small class="text-muted">Prepare time <?php echo $data->time_prepare; ?>mins</small></p>
                        <h5 class="card-title"> € <?php echo $data->price; ?></h5>
                        <a href="admin/add_to_cart_get_drink.php?action=add&id=<?php echo $data->id;?>" class="btn btn-danger col-6">tap to order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Container-fluid-->
</div>

<?php include("includes/footer.php"); ?>

