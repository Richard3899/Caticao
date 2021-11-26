
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_gastosadminproceso'])) {

    $conexion=conexion();

	  $idGastosAdmin= $_POST['idGastosAdmin'];
    $idProceso= $_POST['idProceso'];
    $descripcion= $_POST['descripcion'];

	  $sql="CALL insertar_gastosadminproceso('$idGastosAdmin','$idProceso','$descripcion')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Gasto Admin en su proceso registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: ci_gastosadminproceso_registro.php');

}


?>


