<?php
include 'includes/templates/head.php';
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

                        <div class="col-xl-6 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cantidad de Productos Terminados</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-9">


                                            <canvas id="GraficoBar" width="100" height="100"></canvas>
                                        </div>

                                    </div>


                                </div>
                            </div>

                            <!-- Bar Chart -->
                            <div class="card shadow mb-5">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cantidad de Insumos</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-9">


                                            <canvas id="GraficoBarHorizontal" width="100" height="100"></canvas>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cantidad de Materia Prima</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-9">

                                            <canvas id="GraficoPie" width="100" height="100"></canvas>
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
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


            <script src="js/demo/chart-area-graficos.js"></script>
            <script src="js/demo/chart-area-graficos-horizontal.js"></script>
            <?php
    include 'includes/templates/scripts.php'
    ?>



</body>

</html>
<script>
    CargarDatosGraficosBarHorizontal();
    CargarDatosGraficosBar();
    CargarDatosGraficosBarHorizontal();
    CargarDatosGraficosPie();

    function CargarDatosGraficosBar() {
        $.ajax({
            url: 'graficos/controlador_grafico.php',
            type: 'POST'
        }).done(function(resp) {
            if (resp.length > 0) {
                var titulo = [];
                var cantidad = [];
                var colores = [];
                var data = JSON.parse(resp);
                for (var i = 0; i < data.length; i++) {
                    titulo.push(data[i][1]);
                    cantidad.push(data[i][2]);
                    colores.push(colorRGB());
                }
                CrearGrafico(titulo, cantidad, colores, 'bar', 'GRAFICO EN BARRAS DE PRODUCTO', 'GraficoBar');

            }

        })
    }

    function CargarDatosGraficosBarHorizontal() {
        $.ajax({
            url: 'graficos/controlador_graficodoughnut.php',
            type: 'POST'
        }).done(function(resp) {
            if (resp.length > 0) {
                var titulo = [];
                var cantidad = [];
                var colores = [];
                var data = JSON.parse(resp);
                for (var i = 0; i < data.length; i++) {
                    titulo.push(data[i][1]);
                    cantidad.push(data[i][2]);
                    colores.push(colorRGB());
                }
                CrearGrafico(titulo, cantidad, colores, 'doughnut', 'GRAFICO EN BARRAS HORIZONTAL  DE PRODUCTO', 'GraficoBarHorizontal');

            }

        })
    }
    function CargarDatosGraficosPie() {
        $.ajax({
            url: 'graficos/controlador_graficopie.php',
            type: 'POST'
        }).done(function(resp) {
            if (resp.length > 0) {
                var titulo = [];
                var cantidad = [];
                var colores = [];
                var data = JSON.parse(resp);
                for (var i = 0; i < data.length; i++) {
                    titulo.push(data[i][1]);
                    cantidad.push(data[i][2]);
                    colores.push(colorRGB());
                }
                CrearGrafico(titulo, cantidad, colores, 'pie', 'GRAFICO PIE   DE MATERIA PRIMA', 'GraficoPie');

            }

        })
    }
    function CrearGrafico(titulo, cantidad, colores, tipo, encabezado, id) {
        var ctx = document.getElementById(id);
        var id = new Chart(ctx, {
            type: tipo,
            data: {
                labels: titulo,
                datasets: [{
                    label: encabezado,
                    data: cantidad,
                    backgroundColor:colores,
                    borderColor:colores,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function generarNumero(numero) {
        return (Math.random() * numero).toFixed(0);
    }

    function colorRGB() {
        var coolor = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
        return "rgb" + coolor;
    }
</script>