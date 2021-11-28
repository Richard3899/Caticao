<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idGastosAdminReceta'])) {

  $id=$_GET['idGastosAdminReceta'];
  $sql="CALL eliminar_gastosadminreceta('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {

    die("Falló el eliminar");

  }

  $_SESSION['message'] = 'Receta con Gastos Administrativos eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: ci_gastosadminreceta_registro.php');
}

?>