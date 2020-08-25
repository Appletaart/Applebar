<?php include("includes/header.php");

$session->remove_table();
$session->remove_cart();
?>

    <div class="container-fluid p-0" id="bodypage">
        <div class="row">

            <div id="myCarousel" class="col-12 carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">

                    <div class="carousel-item active">

                        <img src="img/promote/allcocktails.jpg" class="d-block w-100" alt="...">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Example promote menu.</h1>
                                <p>Place the promotion or suggestion menu for customers.</p>
                                <p><a class="btn btn-lg btn-danger" href="start.php" role="button">Start the menu</a></p>
                            </div>
                        </div>

                    </div>

                    <?php $slides = Slide::find_all(); foreach ($slides as $slide): ?>

                    <div class="carousel-item ">
                        <img src="admin/<?php echo $slide->slide_path_and_placeholder(); ?>" class="d-block w-100" alt="...">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1><?php echo $slide->headline; ?></h1>
                                <p><?php echo $slide->subheadline; ?></p>
                                <p><a class="btn btn-lg btn-danger" href="start.php" role="button">Start the menu</a></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>

                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </div>
        <!--#bodypage-->
    </div>
   


<?php include("includes/footer.php") ?>