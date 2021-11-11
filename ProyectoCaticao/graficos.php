<?php
include 'includes/templates/head.php';
include 'includes/config/db.php';

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include 'includes/templates/sidebar.php'
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Topbar -->
                <?php
                include 'includes/templates/nav.php'
                ?>
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Graficos de Materia Prima y Productos </h1>
                    <p class="mb-4"><a target="_blank"></a>.</p>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Productos por Meses </h6>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button class="btn btn-primary" onclick="CargarDatosGraficosBar()"> Graficos Bar</button>
                                            <canvas id="myChart" width="400" height="400"></canvas>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cantidad de Materia Prima</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="myPieChart"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.c
            </div>
            <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
         <?php
            include 'includes/templates/logout_modal.php'
          ?> 
          
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"></script>
            <script src="js/demo/chart-area-graficos.js"></script>
</body>

</html>