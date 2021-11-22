<?php

require 'modelo_graficodoughnut.php';

    $MG = new Modelo_GraficoDoughnut();
    $consulta =$MG->TraerDatosGraficosDoughnut();
    echo json_encode($consulta);
?>