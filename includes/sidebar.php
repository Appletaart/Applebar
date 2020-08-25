<!-- Sidebar -->

<div class="bg-dark" id="sidebar-wrapper">
    <?php
    $session->choose_table();

    if(!$_SESSION['table_id']){
        $session->remove_cart();
        redirect_to("start.php");
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
        </div>
        <div class="col-4 col-lg-4">
        <div class="navbar-nav float-right mt-2 mt-lg-0">
                <!-- Default dropleft button -->
                <li class="nav-item text-danger btn-danger rounded d-flex">
                    <a class="nav-link text-white p-1 d-flex mx-2" href="orderCart.php"><i class="fas fa-shopping-basket pt-1"></i> <?php $cart->add_order();?></a>
                </li>
            </div>
        </div>
</nav>
    <!-- end Page Content -->
<nav class="navbar col-12 testphone navbar-light bg-dark m-0 p-0">
        <div class="col-12 navbar navbar-dark bg-dark px-0">
            <button class="navbar-toggler btn-danger bg-danger text-sm-center text-white p-1 px-2 ml-3 d-flex" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="navbar col-4 justify-content-sm-end">
                <li class="nav-item text-danger btn-danger rounded d-flex">
                    <a class="nav-link text-white p-1 d-flex mx-2" href="orderCart.php"><i class="fas fa-shopping-basket pt-1"></i> <?php $cart->add_order();?></a>
                </li>
            </div>
        </div>
</nav>

