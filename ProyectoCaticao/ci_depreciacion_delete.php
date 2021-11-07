<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idDepreciacion'])) {
  $id=$_GET['idDepreciacion'];
  $sql="CALL eliminar_depreciacion('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Depreciación eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: ci_depreciacion_registro.php');
}



?>
