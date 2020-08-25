<?php include("includes/header_product.php");?>
<?php include("includes/sidebar.php");?>

    <div class="container-fluid p-0" xmlns="http://www.w3.org/1999/html">
    <div class="row col-12 col-lg-10 mx-auto mt-5">
        <div class="col-12 text-hide mb-3">Order number:00001</div>
        <table class="col-12 table table-hover table-dark mx-0 mx-lg-3">
            <thead>
            <tr class="text-light">
                <th scope="col-1" width="50rem">Total</th>
                <th scope="col-1">Photo</th>
                <th scope="col-4">Your order</th>
                <th scope="col-1">Prepare time</th>
                <th scope="col-1">Prize</th>
                <th scope="col-1">Total</th>
                <th scope="col-2"></th>
            </tr>
            </thead>
            
            <tbody>
            <?php
            $table = Table::find_by_id($_SESSION['table_id']);
            
            echo "<p class='text-light'>Your order: ". $table->name .  "</p>";
           
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
                    <td><?php echo $quaty;?></td>
                    <td><img src="admin/<?php echo $product->picture_path(); ?>" width="80rem" alt="..."></td>
                    <td><?php echo $product->name;?></td>
                    <td><?php echo $product->time_prepare;?> mins</td>
                    <td>€ <?php echo $product->price; ?></td>
                    <td>€ <?php echo $cost; ?></td>
                    <td>
                    <a href="orderCart.php?action=add&id=<?php echo $product->id; ?>" class="far fa-plus-square text-secondary p-2"></a>
                    <a href="orderCart.php?action=remove&id=<?php echo $product->id; ?>" class="far fa-trash-alt text-secondary p-2"></a>
                    </td>
                    </tr>
                <?php }
                }
            else{
                echo "<td class='col-1 text-white'> Your cart is empty</td>";
                } ?>

                <?php if($quaty>0){
                    echo '<tr>
                            <td>'.$quantity.'</td><td>item(s)</td><td></td><td>'.$totals_time_prepare.' min(s)</td><td></td><td>€ '.$total_price.'</td><td></td></tr>'; }
                ?>
            
            </tbody>
        </table>


        <form action="sendOrder.php" method="POST" >
            <input name="table_id" hidden value="<?php echo $_SESSION['table_id']; ?>">
            <input name="products_id" hidden value="<?php echo $cart->products_id();?>">
            <input name="quantity" hidden value="<?php echo $quantity; ?>">
            <input name="totals_price" hidden value="<?php echo $total_price; ?>">
            <input name="totals_time_prepare" hidden value="<?php echo $totals_time_prepare; ?>">
            <input name="date_order" hidden value="<?php echo date('Y-m-d H:i:s'); ?>">

        <button class="btn btn-success" type="submit" name="submit">Test to pay (Click to finish the order)</button>
            
        <div class="col-12 text-white my-3">Choose the payment process</div>
        <div class="row col-12 text-white text-center">
            <a href="#" class="col bg-danger rounded text-white p-4 m-2"><i class="fab fa-apple-pay"></i><br>ApplePay</a>
            <a href="#" class="col bg-danger rounded text-white p-4 m-2"><i class="fab fa-bitcoin"></i><br>Bitcoin</a>
            <a href="#" class="col bg-danger rounded text-white p-4 m-2"><i class="fas fa-mobile-alt"></i><br>MobileApp</a>
            <a href="#" class="col bg-danger rounded text-white p-4 m-2"><i class="fas fa-barcode"></i><br>Paycoq</a>
            <a href="#" class="col bg-danger rounded text-white p-4 m-2"><i class="fab fa-bitcoin"></i><br>Bank App</a>
            <a href="#" class="col bg-danger rounded text-white p-4 m-2"><i class="fab fa-cc-paypal"></i><br>Paypal</a>
            <a href="admin/dashboard.php" class="col bg-danger rounded text-white p-4 m-2"><i class="fab fa-cc-paypal"></i><br>Back office</a>
        </div>
        <div>
        </form>
            <!--<a href="<?php /*$session->remove_cart(); */?>"> reset cart cause i wanna try again</a>
                            <br>
                            <a href="<?php //$session->remove_table(); ?>"> reset table cause you paid already</a>-->
    </div>
    </div>
    <!-- /table -->

<?php include("includes/footer.php") ?>