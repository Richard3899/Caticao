<?php

require 'modelo_graficopie.php';

    $MG = new Modelo_GraficoPie();
    $consulta =$MG->TraerDatosGraficosPie();
    echo json_encode($consulta);
?>