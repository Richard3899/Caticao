
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_manodeobraproceso'])) {

    $conexion=conexion();

	  $idManodeObra= $_POST['idManodeObra'];
    $idProceso= $_POST['idProceso'];
    $descripcion= $_POST['descripcion'];

	  $sql="CALL insertar_manodeobraproceso('$idManodeObra','$idProceso','$descripcion')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Materia en su proceso registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: cd_manodeobraproceso_registro.php');

}


?>


