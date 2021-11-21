
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_gastosadmin'])) {

    $conexion=conexion();
    $descripcion= $_POST['descripcion'];
    $preciounitario= $_POST['precioUnitario'];
    $idTipoCostos= $_POST['idTipoCostos'];
    $idUnidadMedida= $_POST['idUnidadMedida'];

	  $sql="CALL insertar_gastosadmin('$descripcion','$preciounitario',
                                     '$idTipoCostos','$idUnidadMedida')";
    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Gasto Administrativo registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: ci_gastosadmin_registro.php');

}


?>


