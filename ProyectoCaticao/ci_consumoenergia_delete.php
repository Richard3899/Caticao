<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idConsumoEnergia'])) {
  $id=$_GET['idConsumoEnergia'];
  $sql="CALL eliminar_consumoenergia('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Consumo de energia eliminado';
  $_SESSION['message_type'] = 'danger';
  header('Location: ci_consumoenergia_registro.php');
}



?>
