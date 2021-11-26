<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idGastosAdminProceso'])) {
  $id=$_GET['idGastosAdminProceso'];
  $sql="CALL eliminar_gastosadminproceso('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Gasto Administrativo en su proceso eliminado';
  $_SESSION['message_type'] = 'danger';
  header('Location: ci_gastosadminproceso_registro.php');
}



?>
