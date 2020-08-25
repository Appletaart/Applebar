<?php include("includes/header.php");
$session->remove_table();
$session->remove_cart();
?>
<?php
date_default_timezone_set("Europe/Brussels");
$timenow = date("H:i:s");
$orders = Cart::find_by_crdate();
$order_C = Cart::count_by_crdate();// count all day
$ifcount = 0;
$elsecount = 0;
$test = 0;


if ($orders > 0) {
    foreach ($orders as $order) {
        $table = Table::find_by_id($order->table_id);
        $time = date_create($order->date_order);
        $order->date_order = date_format($time, "H:i:s");
        $h = date_format($time, 'H');
        $i = date_format($time, 'i');
        $s = date_format($time, 's');
        $i = $i + $order->totals_time_prepare;
        switch ($i) {
            case ($i == 60):
                $i = '00';
                $h = $h + 1;
                break;
            case ($i > 60):
                $i = '0' . $i % 60;
                $h = $h + 1;
                if ($h >= 0 && $h <= 9) {
                    $h = '0' . $h;
                }
                break;
            case ($i >= 0 && $i <= 9) :
                $i = '0' . $i;
                break;
        }
        $get_orders = $h . ':' . $i . ':' . $s;

        if ($get_orders >= $timenow) {
            $ifcount++;
            $test += $order->totals_time_prepare;

        } else { $elsecount++;}
    }
}

if ($orders > 0) {
     $message = $ifcount;
        $timeEs = $test;
        }
else { $message = '0';
    $timeEs = '0'; }

?>


            <div class="container-fluid p-0" id="bodypage">
                <div class="row my-5">
                    <div class="col-10 col-lg-10 d-flex flex-wrap bg-danger shadow px-2 py-5 m-2 p-lg-5 m-lg-5 rounded mx-lg-auto mx-auto">
                        <div class="col-12 text-dark text-center mx-auto">
                            <div class="col-1 bg-success text-center d-flex"></div>
                            <h5>Welcome to <span class="text-success">|</span> An Apple Bar</h5>
                            <hr>
                            <p class="text-white">Choose the apple symbol where your seat is to refer your table!?</p>
                            <p class="">We have <?php echo $message; ?> order(s) before you. Estimate your waiting time now is <?php echo $timeEs; ?> mins </p>
                        </div>
                        <div class="row col-12 mx-auto d-flex my-3 justify-content-sm-center justify-content-lg-between">
                            <a class="col-3 col-lg-2 text-white-50 text-center p-2 p-lg-0" href="see_all_product.php?table_id=1">
                                <img src="admin/img/applecandy.jpg" class="col-12 rounded p-0" alt="...">
                                <p>apple candy</p>
                            </a>
                            <a class="col-3 col-lg-2 text-white-50 text-center p-2 p-lg-0" href="see_all_product.php?table_id=2">
                                <img src="admin/img/applecider.jpg" class="col-12 rounded p-0" alt="...">
                                <p>apple cider</p>
                            </a>
                            <a class="col-3 col-lg-2 text-white-50 text-center p-2 p-lg-0" href="see_all_product.php?table_id=3">
                                <img src="admin/img/applejam.jpg" class="col-12 rounded p-0" alt="...">
                                <p>apple jam</p>
                            </a>
                            <a class="col-3 col-lg-2 text-white-50 text-center p-2 p-lg-0" href="see_all_product.php?table_id=4">
                                <img src="admin/img/applepie.jpg" class="col-12 rounded p-0" alt="...">
                                <p>apple pie</p>
                            </a>
                            <a class="col-3 col-lg-2 text-white-50 text-center p-2 p-lg-0" href="see_all_product.php?table_id=5">
                                <img src="admin/img/applesorbet.jpg" class="col-12 rounded p-0" alt="...">
                                <p>apple sorbet</p>
                            </a>

                            </div>

                        <p class="col-4 text-white pt-3">Let's enjoy drinking...</p>
                        </div>
                </div>
                <!--#bodypage-->
            </div>
           


<?php include("includes/footer.php") ?>