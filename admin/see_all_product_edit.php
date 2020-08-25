<?php include("includes/template_header.php");?>
<?php include("includes/sidebar_DBD.php"); ?>


    <div class="container-fluid p-0">
        <div class="card-group bg-white">
            <?php   $datas = Data::find_all_sort_category(); ?>
            <?php foreach ($datas as $data): ?>
                <div class="col col-sm-4 col-lg-2 p-0 border-right border-top">
                    <a href="result_edit_a_drink.php?id=<?php echo $data->id; ?>"><img src="<?php echo $data->picture_path(); ?>" class="editcard-img" alt="..."></a>
                    <div class="bg-white px-2">
                        <small class="card-title"><?php echo $data->name; ?></small><br>
                        <small class="text-muted"><?php echo $data->caption; ?></small><br>
                        <small class="text-muted">Time <?php echo $data->time_prepare; ?> mins</small>
                        <small class="text-muted"> € <?php echo $data->price; ?></small>
                    </div>
                    <a href="result_edit_a_drink.php?id=<?php echo $data->id; ?>" class="btn btn-sm btn-success col-12"><i class="fas fa-edit"></i> Edit drink</a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

<?php include("includes/footer.php")?>