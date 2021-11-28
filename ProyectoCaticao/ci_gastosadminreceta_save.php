<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_gastosadminreceta'])) {

    $conexion=conexion();

	$idGastosAdmin= $_POST['idGastosAdmin'];
    $idReceta= $_POST['idReceta'];
    $cantidad= $_POST['cantidad'];

	  $sql="CALL insertar_gastosadminreceta('$idGastosAdmin','$idReceta','$cantidad')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Gastos Administrativos en receta registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: ci_gastosadminreceta_registro.php');

}


?>
