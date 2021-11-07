
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_depreciacion'])) {

    $conexion=conexion();
    $importe= $_POST['importe'];
    $vidautil= $_POST['vidautil'];
    $idMaquina= $_POST['idMaquina'];

	  $sql="CALL insertar_depreciacion('$importe','$vidautil','$idMaquina')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Depreciación registrada';
  $_SESSION['message_type'] = 'success';
  header('Location: ci_depreciacion_registro.php');

}


?>


