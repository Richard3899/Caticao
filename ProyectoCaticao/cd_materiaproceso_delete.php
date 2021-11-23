<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idMateriaProceso'])) {
  $id=$_GET['idMateriaProceso'];
  $sql="CALL eliminar_materiaproceso('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Materia en su proceso eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: cd_materiaproceso_registro.php');
}



?>
