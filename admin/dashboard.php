<?php include("includes/template_header.php")?>
<?php include("includes/sidebar_DBD.php")?>

            <div class="container-fluid p-0" id="bodypage">
            <div class="row col-12 mx-auto">
                    <!--All products-->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">All Products
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-300"><?php echo Data::count_all(); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cocktail fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- How many glasses per day -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">How many glasses have u sale this day?
                                            </br><?php echo date('d-m-Y');?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cart->sum_total_glass_per_d(); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-glass-cheers fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- What is the popular product 3 tops alcohol/non alcohol -->
                    <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Top sale
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cart->max_salename(); ?><br>
                                    </div>
                                    <div class="text-sm-left text-secondary"><?php echo $cart->max_salecat(); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-grin-hearts fa-2x text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


                <!-- Content Row -->
                <div class="row col-12 mx-auto">

                    <div class="col-xl-8 col-lg-7">

                        <!-- Bar Chart -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Totals sell per month</h6>
                            </div>
                            <div class="card-body col-12">
                                <script type="text/javascript" src="js/loader.js"></script>
                                <script type="text/javascript">
                                    google.charts.load("current", {packages:['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ["Element", "Density", { role: "style" } ],
                                            ["Jan", 0, "skyblue"],
                                            ["Feb", 0, "#bee5eb"],
                                            ["Mar", 0, "#117a8b"],
                                            ["Apr", 0, "color: #0056b3"],
                                            ["May", <?php echo $cart->sum_may(); ?>, "#abdde5"],
                                            ["Jun", <?php echo $cart->sum_jun(); ?>, "#f1b0b7"],
                                            ["Jul", <?php echo $cart->sum_jul(); ?>, "pink"],
                                            ["Aug", <?php echo $cart->sum_aug(); ?>, "color: hotpink"],
                                            ["Sep", <?php echo $cart->sum_sep(); ?>, "lightpink"],
                                            ["Oct", <?php echo $cart->sum_oct(); ?>, "mediumpurple"],
                                            ["Nov", <?php echo $cart->sum_nov(); ?>, "plum"],
                                            ["Dec", <?php echo $cart->sum_dec(); ?>, "color: purple"]
                                        ]);

                                        var view = new google.visualization.DataView(data);
                                        view.setColumns([0, 1,
                                            { calc: "stringify",
                                                sourceColumn: 1,
                                                type: "string",
                                                role: "annotation" },
                                            2]);

                                        var options = {
                                           /* title: "Density of Precious Metals, in g/cm^3",*/
                                            /*padding: 0,
                                            margin: 0,
                                            width: 600,
                                            height: 300,
                                            bar: {groupWidth: "100%"},*/
                                            legend: { position: "none" }
                                        };
                                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                                        chart.draw(view, options);
                                        
                                        $(window).resize(function(){
                                            drawChart();
                                        });
                                    }
                                </script>
                                <div id="columnchart_values" class="chart"></div>
                            </div>
                        </div>

                    </div>

                    <!-- Donut Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Busy time</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <!--original with load.js-->
                                <script type="text/javascript">
                                    google.charts.load("current", {packages:["corechart"]});
                                    google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Task', 'Glasses per hours'],
                                            ['18.00-19.59', <?php echo $cart->count_time(); ?>],
                                            ['20.00-21.59', 6],
                                            ['22.00-23.59', 15]
                                        ]);

                                        var options = {
                                            padding: 0,
                                            margin: 0,
                                            width:380,
                                            height:380,
                                            chartArea:{left:15,top:30},
                                            backgroundColor: 'transparent',
                                            legend:{position: 'top', textStyle: {color: 'grey', fontSize: 10}},
                                            pieHole: 0.4,
                                            colors: ['pink', '#abdde5', 'skyblue']
                                        };

                                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                                        chart.draw(data, options);
                                    }
                                </script>

                                <div id="donutchart" style="width: 280px; height: 300px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
                <!--#bodypage-->
            </div>
            <!-- /#page-content-wrapper -->


<?php include("includes/footer.php")?>