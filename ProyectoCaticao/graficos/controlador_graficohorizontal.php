<?php

require 'modelo_graficohorizontal.php';

    $MG = new Modelo_GraficoHorizontal();
    $consulta =$MG->TraerDatosGraficosHorizontal();
    echo json_encode($consulta);
?>