<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idManodeObra'])) {
  $id=$_GET['idManodeObra'];
  $sql="CALL eliminar_manodeobra('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Mano de obra eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: cd_manodeobra_registro.php');
}


?>
