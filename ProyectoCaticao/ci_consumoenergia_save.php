
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_consumoenergia'])) {

    $conexion=conexion();
    $tarifa= $_POST['tarifa'];
    $idMaquina= $_POST['idMaquina'];
    $idTipoCostos= $_POST['idTipoCostos'];
    $idUnidadMedida= $_POST['idUnidadMedida'];

	  $sql="CALL insertar_consumoenergia('$tarifa','$idMaquina','$idTipoCostos','$idUnidadMedida')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Consumo de energía registrada';
  $_SESSION['message_type'] = 'success';
  header('Location: ci_consumoenergia_registro.php');

}


?>


