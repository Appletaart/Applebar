<?php include("includes/header_product.php");?>
<?php include("includes/template_sidebar_NoHB.php");

    $session->choose_table();

    if(!$_POST['products_id']){
        redirect_to("see_all_product.php");
    }


if(isset($_POST['submit'])) {

    $cart->table_id = $_POST['table_id'];
    $cart->products_id = $_POST['products_id'];
    $cart->quantity = $_POST['quantity'];
    $cart->totals_price = $_POST['totals_price'];
    $cart->totals_time_prepare = $_POST['totals_time_prepare'];
    date_default_timezone_set("Europe/Brussels");
    $cart->date_order = date('Y-m-d H:i:s');
    $cart->save();

    $order_id = $database->the_insert_id();
    $_SESSION["order_id"] = $order_id;

    foreach ($_SESSION['cart'] as $id => $quaty) {
        $order_in = new Order_in();
        $order_in->order_id = $order_id;
        $order_in->product_id = $id;
        $order_in->product_quaty = $quaty;
        date_default_timezone_set("Europe/Brussels");
        $order_in->date_order = date('Y-m-d');
        $order_in->save();
    }}

ob_start();

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

    <div class="container-fluid p-0">
    <div class="row col-10 mx-auto mt-5">
        <div class="col-12 text-hide mb-3"><?php //$orders = Cart::find_all(); ?></div>
        <table class="table table-hover table-dark mx-3">
            <thead>
            <tr class="text-light">
                <th scope="col-1">Amount</th>
                <th scope="col-4">Your order</th>
                <th scope="col-2">Prepare time</th>
                <th scope="col-1">Prize</th>
                <th scope="col-1">Total</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $table = Table::find_by_id($_SESSION['table_id']);
            echo "<p class='text-light'>Your order: ". $table->name .  " <br> Order number: " . $_SESSION["order_id"] ."<br></p>";

            if(isset($_SESSION['cart'])){
                $totals_time_prepare = 0;
                $total_price = 0;
                $quantity = 0;
                $quaty ="";

                foreach ($_SESSION['cart'] as $id => $quaty)
                {
                    $product = Data::find_by_id($id);
                    $totals_time_prepare += $product->time_prepare *$quaty;
                    $cost = $product->price * $quaty; // $quaty is gonna count the quantity.
                    $quantity += $quaty;
                    $total_price = $total_price + $cost;
                    ?>
                    <tr class="text-light">
                        <td scope="row"><?php echo $quaty;?></td>
                        <td><?php echo $product->name;?></td>
                        <td><?php echo $product->time_prepare;?> mins</td>
                        <td>€ <?php echo $product->price; ?></td>
                        <td>€ <?php echo $cost; ?></td>
                    </tr>
                <?php }
            }
            else{
                echo "<tr><td> Your cart is empty</td></tr>";
            } ?>
            <?php if($quaty>0){
                echo '<tr>
                            <td>Total '.$quantity.' items</td><td></td><td>'.$totals_time_prepare.' mins</td><td></td><td>€ '.$total_price.'</td><td></td></tr>'; } ?>
            </tbody>
        </table>
    </div>
    <div class="row col-10 mx-auto mt-3">
        <div class="col-12 text-white mb-3">
            <?php echo '<p>We have '.$message.' order(s) now. Estimate your waiting time now is '.$timeEs.' mins </p>'; ?>

            <script>
                // Set the date we're counting down to
                //var countDownDate = new Date("jun 27, 2020 20:37:25").getTime();
                var countDownDate = <?php echo strtotime("$h:$i:$s")?> * 1000;
                var now = <?php echo time()?> * 1000;

                // Update the count down every 1 second
                var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demominut"
                    document.getElementById("demominut").innerHTML = minutes + "m " + seconds + "s ";

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demominut").innerHTML = "Now, The order should be already serve at your table.";
                    }

                }, 1000);
            </script>
        </div>
        <h1 id="demominut" class="text-white"></h1>
        <br>
    </div>

    <div class="row col-3 m-3">
    <a href="admin/dashboard.php" class="col bg-danger rounded text-white p-4 m-2"><i class="fab fa-cc-paypal"></i> Go to back office</a>
    </div>
<?php $session->remove_table(); $session->remove_cart();?>
<?php include("includes/footer.php") ?>