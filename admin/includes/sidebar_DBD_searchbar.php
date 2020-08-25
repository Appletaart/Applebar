  
        <!-- Sidebar -->
        <div class="bg-dark" id="sidebar-wrapper">

            <div class="sidebar-heading text-center bg-danger py-4"><a href="dashboard.php" class="text-white text-decoration-none" ><i class="fas fa-tachometer-alt"></i> DASHBOARD <br> <i class="fas fa-apple-alt"></i> Apple bar</a></div>
            <div class="list-group list-group-flush text-center text-alignment-center">
                <a href="#" class="list-group-item list-group-item-action bg-danger text-white">Set up table</a>
                <a href="#" class="list-group-item list-group-item-action bg-danger text-white">Set up slice Ad</a>
                <a href="#" class="list-group-item list-group-item-action bg-danger text-white">Set up payment method</a>
                <a href="insert_drink.php" class="list-group-item list-group-item-action bg-danger text-white">Add a new product</a>
                <a href="see_all_product_edit.php" class="list-group-item list-group-item-action bg-danger text-white">Update/Delete products</a>
                <a href="getOrder.php" class="list-group-item list-group-item-action bg-danger text-white">See current orders</a>
                <a href="../../see_all_product.php" class="list-group-item list-group-item-action bg-danger text-white">Go to front page</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-dark my-3">
                <div class="col-2">
                    <button class="btn btn-danger" id="menu-toggle">Toggle Menu</button>
                </div>
                <div class="col-7">
                </div>
                <div class="col-3 input-group">
                    <form class="form-inline" action="" method="post">
                        <select class="custom-select" name="category_id"  aria-label="Example select with button addon">
                                <option selected>By category</option>
                                <option value=1 <?php if($data->category_id==1) echo 'selected="selected"';?>>Cocktails</option>
                                <option value=2 <?php if($data->category_id==2) echo 'selected="selected"';?>>Longdrinks</option>
                                <option value=3 <?php if($data->category_id==3) echo 'selected="selected"';?>>Aperitif & digestif</option>
                                <option value=4 <?php if($data->category_id==4) echo 'selected="selected"';?>>Wine</option>
                                <option value=5 <?php if($data->category_id==5) echo 'selected="selected"';?>>Beer</option>
                                <option value=6 <?php if($data->category_id==6) echo 'selected="selected"';?>>Non-alcohol</option>
                                <option value=7 <?php if($data->category_id==7) echo 'selected="selected"';?> >Hot drinks</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" name="submit_searchBar" type="submit"><i class="fas fa-search"></i></button>
                        </div>

                        <?php
                        if(isset($_POST['submit_searchBar'])) {
                            $search = mysqli_real_escape_string($dbc, $_POST['category_id']);
                            $myquery = "SELECT * FROM products WHERE category_id =$search ";
                            $sresult = mysqli_query($dbc, $myquery);
                            $queryResult = mysqli_num_rows($sresult);

                            if ($queryResult > 0) {
                            }
                        }
                        ?>
                    </form>

                </div>
            </nav>
            <!-- end Page Content -->
