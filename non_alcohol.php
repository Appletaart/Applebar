<?php include("includes/header_product.php") ?>
    <!-- Sidebar -->
    <div class="bg-dark" id="sidebar-wrapper">

        <?php
        $session->choose_table();

        if(!$_SESSION['table_id']){
            $session->remove_cart();
            redirect_to("start.php");
        }
        ?>

        <?php include("includes/sidebarwrap.php")?>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-dark my-3 px-0 px-lg-3">
        <div class="col-3 col-lg-3">
            <button class="btn btn-danger" id="menu-toggle">Toggle Menu</button>
        </div>
        <div class="col-5 col-lg-5">
            <?php

            $page =!empty($_GET['page'])? (int)$_GET['page'] : 1;

            $items_per_page = 3;

            $query = "SELECT COUNT(*) as items FROM products WHERE category_id =6";  //3
            $result_query = Data::find_this_query($query);
            $result_set = $database->query($query);
            $row = mysqli_fetch_array($result_set);
            $items_total_count = array_shift($row);

            $paginate = new Paginate($page, $items_per_page, $items_total_count);
            ?>
            <div class="row">
                <div class="col-3 mx-auto rounded">
                    <ul class="pagination pagination-sm justify-content-center m-0">
                        <?php
                        if ($paginate->page_total()>1){

                            if($paginate->has_previous()){

                                echo '<li class="previous page-item"><a class="page-link bg-light text-danger border-0" href="non_alcohol.php?page='.$paginate->previous().'">Previous</a></li>';

                            }
                            for ($i = 1; $i <= $paginate->page_total(); $i++){
                                if ($i == $paginate->current_page){

                                    echo '<li class="active page-item"><a class="page-link bg-danger border-0" href="non_alcohol.php?page='. $i .'"> '. $i .' </a></li>';

                                }else{

                                    echo '<li class="page-item"><a class="page-link bg-light text-danger border-0" href="non_alcohol.php?page='. $i .'"> ' . $i .' </a></li>';
                                }

                            }
                            if ($paginate->has_next()){

                                echo '<li class="next page-item"><a class="page-link bg-light text-danger border-0" href="non_alcohol.php?page='.$paginate->next().'">Next</a></li>';

                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-4 col-lg-4">
            <div class="navbar-nav float-right mt-2 mt-lg-0">
                <li class="nav-item text-danger btn-danger rounded d-flex">
                    <a class="nav-link text-white p-1 d-flex mx-2" href="orderCart.php"><i class="fas fa-shopping-basket pt-1"></i> <?php $cart->add_order();?></a>
                </li>
            </div>
        </div>
    </nav>
    <!-- end Page Content -->

    <div class="container-fluid p-0" id="bodypage">
    <div id="<?php echo $paginate->current_page; ?>">

        <div class="card-group d-flex flex-wrap">
            <?php

            $sql = "SELECT * FROM products WHERE category_id =6 ";
            $sql .= "LIMIT {$items_per_page} ";
            $sql .= "OFFSET {$paginate->offset()}";

            $datas = Data::find_this_query($sql);
            ?>

            <?php foreach ($datas as $data): ?>

                <div id="<?php echo $data->id;?>" class="col-12 col-lg-4 p-0 card">
                    <a href="result_get_a_drink.php?id=<?php echo $data->id; ?>"><img src="admin/<?php echo $data->picture_path(); ?>" class="menucard-img" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data->name; ?></h5>
                        <p class="card-text"><?php echo $data->caption; ?></p>
                        <p class="card-text"><small class="text-muted">Prepare time <?php echo $data->time_prepare; ?> mins</small></p>
                        <div class="row pl-3 align-items-end">
                            <a href=admin/add_to_cart_non_alcohol.php?action=add&id=<?php echo $data->id;?>&page=<?php echo $paginate->current_page; ?>" class="btn btn-danger col-6">tap to order</a><h5 class="card-title col-5"> € <?php echo $data->price; ?></h5>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
            <button class="btn-danger" onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        </div>
    </div>


<?php include("includes/footer.php")?>