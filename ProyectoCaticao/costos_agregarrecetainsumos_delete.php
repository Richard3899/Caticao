<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idRecetaMateria'])) {
  $id=$_GET['idRecetaMateria'];
  $sql="CALL eliminar_recetainsumos('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Insumo de receta eliminado';
  $_SESSION['message_type'] = 'danger';
  header('Location: costos_agregarrecetainsumos.php');
}



?>
