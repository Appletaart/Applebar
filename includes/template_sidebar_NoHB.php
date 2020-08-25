  <?php
  //$session->remove_table();
  //$session->remove_cart();
  ?>
        <!-- Sidebar -->
        <div class="bg-dark" id="sidebar-wrapper">
            <?php include("includes/sidebarwrap.php")?>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-dark my-3">
                <div class="col-12 col-lg-2">
                    <button class="btn btn-danger" id="menu-toggle">Toggle Menu</button>
                </div>
                <div class="col-12 col-lg-6">
                </div>
                <div class="col-12 col-lg-4">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<!--                            <--<li class="nav-item active">
<!--                                <a class="nav-link text-white" href="see_all_product.php">Home <span class="sr-only">(current)</span></a>
<!--                            </li>-->
                            <li hidden class="nav-item text-danger btn-danger rounded">
                                <a class="nav-link text-white pb-1 d-flex" href="orderCart.php"><i class="fas fa-shopping-basket pt-1"></i> <?php $cart->add_cart(); $cart->add_order();?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- end Page Content -->
