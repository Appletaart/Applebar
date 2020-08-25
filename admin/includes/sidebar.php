<!-- Sidebar -->
<div class="bg-dark" id="sidebar-wrapper">
    <?php
    $session->choose_table();

    if(!$_SESSION['table_id']){
        $session->remove_cart();
        redirect_to("../start.php");
    }
    $cart->add_cart();
    ?>
    <?php include("sidebarwrap.php")?>
</div>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">

<nav class="navbar navbar-expand-lg test navbar-light bg-dark my-3 px-0 px-lg-3">
        <div class="col-3 col-lg-3">
            <button class="btn btn-danger" id="menu-toggle">Toggle Menu</button>
        </div>
        <div class="col-5 col-lg-5">
            <?php
            /*                    $page =!empty($_GET['page'])? (int)$_GET['page'] : 1;
                                $items_per_page = 3;
                                $items_total_count = Data::count_all();
            
                                $paginate = new Paginate($page, $items_per_page, $items_total_count);
                                */?><!--
                    <div class="row">
                        <div class="col-3 mx-auto rounded">
                            <ul class="pagination pagination-sm justify-content-center m-0">
                                <?php
            /*                                if ($paginate->page_total()>1){
            
                                                if($paginate->has_previous()){
            
                                                    echo '<li class="previous page-item"><a class="page-link bg-light text-danger border-0" href="cocktails.php?page='.$paginate->previous().'">Previous</a></li>';
            
                                                }
                                                for ($i = 1; $i <= $paginate->page_total(); $i++){
                                                    if ($i == $paginate->current_page){
            
                                                        echo '<li class="active page-item"><a class="page-link bg-danger border-0" href="cocktails.php?page='. $i .'"> '. $i .' </a></li>';
            
                                                    }else{
            
                                                        echo '<li class="page-item"><a class="page-link bg-light text-danger border-0" href="cocktails.php?page='. $i .'"> ' . $i .' </a></li>';
                                                    }
            
                                                }
                                                if ($paginate->has_next()){
            
                                                    echo '<li class="next page-item"><a class="page-link bg-light text-danger border-0" href="cocktails.php?page='.$paginate->next().'">Next</a></li>';
            
                                                }
                                            }
                                            */?>
                            </ul>
                        </div>
                    </div>-->
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
<nav class="navbar col-12 testphone navbar-light bg-dark m-0 p-0">
        <div class="col-12 navbar navbar-dark bg-dark px-0">
            <div class="navbar col-6 float-right">
                <li class="nav-item text-danger btn-danger rounded d-flex">
                    <a class="nav-link text-white p-1 d-flex mx-2" href="orderCart.php"><i class="fas fa-shopping-basket pt-1"></i> <?php $cart->add_order();?></a>
                </li>
            </div>
            <button class="navbar-toggler btn-danger bg-danger text-sm-center text-white p-2 d-flex mr-3" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                Menu
            </button>
            <div class="collapse col-12 m-0 p-0" id="navbarToggleExternalContent">
                <div class="row col-12 d-block float-left pt-3 px-0 mx-0">
                    <div class="list-group list-group-flush text-center text-alignment-center">
                        <a href="see_all_product.php" class="list-group-item list-group-item-action bg-danger text-white">See all our drinks</a>
                        <a href="cocktails.php" class="list-group-item list-group-item-action bg-danger text-white">Cocktails</a>
                        <a href="longdrink.php" class="list-group-item list-group-item-action bg-danger text-white">Longdrinks</a>
                        <a href="aperitief_d.php" class="list-group-item list-group-item-action bg-danger text-white">Aperitif & digestif</a>
                        <a href="wine.php" class="list-group-item list-group-item-action bg-danger text-white">Wine</a>
                        <a href="beer.php" class="list-group-item list-group-item-action bg-danger text-white">Beers</a>
                        <a href="non_alcohol.php" class="list-group-item list-group-item-action bg-danger text-white">Non Alcohol</a>
                        <a href="hot_drink.php" class="list-group-item list-group-item-action bg-danger text-white">Hot drinks</a>
                    </div>

                </div>
            </div>
        </div>
</nav>

