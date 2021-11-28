<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idDepreciacionReceta'])) {
  $id=$_GET['idDepreciacionReceta'];
  $sql="CALL eliminar_depreciacionreceta('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Receta con depreciación eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: ci_depreciacionreceta_registro.php');
}

?>


