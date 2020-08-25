<?php include("includes/header.php") ?>
<?php include("includes/sidebar_DBD.php");
// save to the database

$session->remove_table();
$session->remove_cart();

?>

    <div class="container-fluid p-0">
    <div class="row col-10 mx-auto mt-5">

        <div class="col-12 text-white mb-3">
            <p>Countdown to the end of the lesson web development <span id="demo" class=""></span></p>

            <script>
                // Set the date we're counting down todate('Y-m-d H:i:s'); difftime
                var countDownDate = new Date("aug 27, 2020 20:37:25").getTime();

                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                        + minutes + "m " + seconds + "s ";

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                    }
                }, 1000);
            </script>

        </div>
        <!--first column-->
        <p class="text-white">All the activated order </p>
        <table class="table table-hover table-dark">
            <thead>
            <tr class="text-light">
                <th scope="col-1">ID</th>
                <th scope="col-4">Table</th>
                <th scope="col-4">All order</th>
            </tr>
            </thead>

            <tbody>
            <?php

            date_default_timezone_set("Europe/Brussels");
            $timenow = date("H:i:s");
            $orders = Cart::find_by_crdate();
            $ifcount = 0;
            $elsecount = 0;

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
                        echo '<tr class="text-light">
                              <td scope="row">' . $order->id . '</td>
                              <td>' . $table->name . '</td>
                              <td>Order at ' . $order->date_order . '<br>
                              Time prepared ' . $order->totals_time_prepare . ' mins <br>
                              <p>Get order at :' . $get_orders . ' <br>(Looking for the solution to correct time)</p>
                              </td></tr>';

                    } else { $elsecount++;

                       // $message = 'Did not get any order now 1';
                    }

                }

            } else {
                $message = 'Did not get any order now';
            }
            ?>



            </tbody>
            <?php   if ($orders > 0) {
                $the_message = $ifcount;
            }
            else { $the_message = '0';}
            echo '<br><p class="text-white"> ~ You have '. $the_message.' order(s)</p>'; ?>

        </table>
        <div class="bg-success text-white mb-5"><?php echo $message; ?></div>


        <!--second column -->

        <table class="table-responsive-sm table table-hover table-dark">
            <thead>
            <tr class="text-light">
                <th scope="col">ID</th>
                <th scope="col">Table</th>
                <th scope="col">All order</th>
                <th scope="col">Total amount</th>
                <th scope="col">Total prices</th>
                <th scope="col">Canceled order</th>
            </tr>
            </thead>

            <tbody>
            <p class="col-12 text-white">Today has total: <?php echo $cart->sum_order(); ?> order(s)<br>Total income:
                € <?php echo $cart->sum_income_today(); ?></p>
            <?php
            $timenow = date("H:i:s");
            $orders = Cart::find_by_crdate_DESC();
            $order_C = Cart::count_by_crdate();
            if ($order_C > 0) {
                foreach ($orders as $order) {
                    $table = Table::find_by_id($order->table_id);
                    $totals_time_prepare += $product->time_prepare * $quaty;
                    $cost = $product->price * $quaty; // $quaty is gonna count the quantity.
                    $quantity += $quaty;
                    $total_price = $total_price + $cost;
            ?>
                    <tr class="text-light">
                        <td scope="row"><?php echo $order->id; ?></td>
                        <td><?php echo $table->name; ?></td>
                        <td><?php echo $order->date_order; ?><br>
                            <?php echo $order->products_id; ?><br>
                            Time prepared <?php echo $order->totals_time_prepare; ?> mins
                            <?php
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

                            if ($get_orders < $timenow) {
                                echo '<p>Get order at : ' . $get_orders . '<br>Order is done.</p>';
                            } else {
                                echo '<p>Get order at :' . $get_orders . '<br> Activated order</p>';
                            }
                            ?>
                        </td>
                        <td><?php echo $order->quantity; ?></td>
                        <td>€<?php echo $order->totals_price; ?></td>
                        <td>
                            <a href="delete_order.php?action=remove&id=<?php echo $order->id; ?>" class="far fa-trash-alt text-secondary p-2"></a>
                        </td>
                    </tr>

                <?php }?><!--// end loop-->
            </tbody>
        </table>

           <?php } else {
                $messageno_order = "Did not get any order today yet." ;
            }
                ?>

    </div>

    <div class="bg-success text-white mb-5" ><?php echo $messageno_order; ?></div>
    <br>


<?php include("includes/footer.php") ?>