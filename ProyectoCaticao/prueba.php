

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <h1>Hello, world!</h1>

    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <button class="btn btn-primary" onclick="CargarDatosGraficosBarHorizontal()"> Graficos horizontal </button>
                    <canvas id="GraficoBarHorizontal" width="400" height="400"></canvas>
                </div>
            </div>
            
        </div>
        <div class="card-body">
        
            <div class="row">
                <div class="col-lg-2">
                    <button class="btn btn-primary" onclick="CargarDatosGraficosBar()"> Graficos Bar </button>
                    <canvas id="GraficoBar" width="400" height="400"></canvas>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
   
</body>

</html>

<script>
    function CargarDatosGraficosBar() {
        $.ajax({
            url: 'graficos/controlador_grafico.php',
            type: 'POST'
        }).done(function(resp) {
            if (resp.length > 0) {
                var titulo = [];
                var cantidad = [];
                var data = JSON.parse(resp);
                for (var i = 0; i < data.length; i++) {
                    titulo.push(data[i][1]);
                    cantidad.push(data[i][2]);
                }
                CrearGrafico(titulo, cantidad, 'bar', 'GRAFICO EN BARRAS DE PRODUCTO','GraficoBar');
            }

        })
    }

    function CargarDatosGraficosBarHorizontal() {
        $.ajax({
            url: 'graficos/controlador_grafico.php',
            type: 'POST'
        }).done(function(resp) {
            if (resp.length > 0) {
                var titulo = [];
                var cantidad = [];
                var data = JSON.parse(resp);
                for (var i = 0; i < data.length; i++) {
                    titulo.push(data[i][1]);
                    cantidad.push(data[i][2]);
                }
                CrearGrafico(titulo, cantidad, 'horizontalBar', 'GRAFICO EN BARRAS HORIZONTAL  DE PRODUCTO','GraficoBarHorizontal');
            }

        })
    }

    function CrearGrafico(titulo, cantidad, tipo, encabezado, id,) {
        var ctx = document.getElementById(id);
        var id = new Chart(ctx, {
            type: tipo,
            data: {
                labels: titulo,
                datasets: [{
                    label: encabezado,
                    data: cantidad,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
</script>