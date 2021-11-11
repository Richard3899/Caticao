<?php

require 'TraerDatosGraficos1';

$MG = new Modelo_Grafico();
$consulta->$MG->TraerDatosGraficos1();
echo json_encode($consulta);
?>