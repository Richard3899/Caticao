<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idGastosAdmin'])) {
  $id=$_GET['idGastosAdmin'];
  $sql="CALL eliminar_gastosadmin('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Gasto Administrativo eliminado';
  $_SESSION['message_type'] = 'danger';
  header('Location: ci_gastosadmin_registro.php');
}



?>
