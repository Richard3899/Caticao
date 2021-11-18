<?php
include 'includes/config/db.php';
$conexion=conexion();


if(isset($_GET['idMaquina'])) {
  $id = $_GET['idMaquina'];
  $sql="CALL eliminar_maquina('$id')";
  $result = mysqli_query($conexion,$sql);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Maquina eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: maquina_registro.php');
}

?>

