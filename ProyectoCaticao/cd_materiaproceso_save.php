
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_materiaproceso'])) {

    $conexion=conexion();

	  $idMateria= $_POST['idMateria'];
    $idProceso= $_POST['idProceso'];
    $descripcion= $_POST['descripcion'];

	  $sql="CALL insertar_materiaproceso('$idMateria','$idProceso','$descripcion')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Materia en su proceso registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: cd_materiaproceso_registro.php');

}


?>


