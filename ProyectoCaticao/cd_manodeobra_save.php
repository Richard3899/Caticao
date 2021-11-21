
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_manodeobra'])) {

    $conexion=conexion();
    $descripcion= $_POST['descripcion'];
    $preciounitario= $_POST['precioUnitario'];
    $idTipoCostos= $_POST['idTipoCostos'];
    $idUnidadMedida= $_POST['idUnidadMedida'];

	  $sql="CALL insertar_manodeobra('$descripcion','$preciounitario',
                                     '$idTipoCostos','$idUnidadMedida')";
    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Mano de obra registrada';
  $_SESSION['message_type'] = 'success';
  header('Location: cd_manodeobra_registro.php');

}


?>


