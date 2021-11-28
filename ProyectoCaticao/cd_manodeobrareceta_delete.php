<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idManodeObraReceta'])) {
  $id=$_GET['idManodeObraReceta'];
  $sql="CALL eliminar_manodeobrareceta('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Receta con mano de obra eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: cd_manodeobrareceta_registro.php');
}



?>
