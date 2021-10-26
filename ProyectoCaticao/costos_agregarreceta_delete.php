<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idReceta'])) {
  $id=$_GET['idReceta'];
  $sql="CALL eliminar_agregarreceta('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Receta eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: costos_agregarreceta.php');
}



?>
