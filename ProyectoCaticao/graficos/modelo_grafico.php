<?php

class Modelo_Grafico{
    private $conexion;
    function __construct()
    {
        require_once('graficos/conexion.php');
        $this->conexion= new conexion();
        $this->conexion->conectar();
    }
    function TraerDatosGraficos1(){
        $sql="select nombre, cantidad *from materia;";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)){
            while ($consulta_VU = mysqli_fetch_array($consulta)){
                $arreglo[]=$consulta_VU;
            }
            return $arreglo;
           $this->conexion->cerrar(); 

        }

    }
}
?>