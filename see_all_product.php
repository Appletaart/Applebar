<?php include("includes/header_product.php") ?>
<?php include("includes/sidebar.php")?>
<div class="container-fluid p-0">
        <div class="card-group bg-white rounded">
            <?php $datas = Data::find_all_sort_category(); ?>
            <?php foreach ($datas as $data): ?>
                <div id="<?php echo $data->id;?>" class="col-12 col-md-6 col-lg-4 p-0 rounded border-right border-top">
                    <a href="result_get_a_drink.php?id=<?php echo $data->id; ?>"><img src="admin/<?php echo $data->picture_path(); ?>" class="menucard-img" alt="..."></a>
                    <div class="card-body bg-white">
                        <h5 class="card-title"><?php echo $data->name; ?></h5>
                        <p class="card-text"><?php echo $data->caption; ?></p>
                        <p class="card-text"><small class="text-muted">Prepare time <?php echo $data->time_prepare; ?> mins</small></p>
                        <div class="row pl-3 align-items-end">
                            <a href="admin/add_to_cart.php?action=add&id=<?php echo $data->id;?>" class="btn btn-danger col-6">tap to order</a><h5 class="card-title col-5"> € <?php echo $data->price; ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <button class="btn-danger" onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        </div>
</div>
    
<?php include("includes/footer.php")?>