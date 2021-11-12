<?php

require 'modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta =$MG->TraerDatosGraficos1();
    echo json_encode($consulta);
?>