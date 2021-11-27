<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idManodeObraProceso'])) {
  $id=$_GET['idManodeObraProceso'];
  $sql="CALL eliminar_manodeobraproceso('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Mano de obra en su proceso eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: cd_manodeobraproceso_registro.php');
}



?>
