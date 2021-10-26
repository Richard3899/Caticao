<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_agregarreceta'])) {

    $conexion=conexion();

    $descripcion= $_POST['descripcion'];
    $idProducto= $_POST['idProducto'];

	  $sql="CALL insertar_agregarreceta('$descripcion','$idProducto')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Receta registrada';
  $_SESSION['message_type'] = 'success';
  header('Location: costos_agregarreceta.php');

}


?>


