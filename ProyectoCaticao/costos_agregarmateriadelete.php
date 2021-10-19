<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idMateriaCostos'])) {
  $id=$_GET['idMateriaCostos'];
  $sql="CALL eliminar_materiacostos('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Costo de Materia prima eliminado';
  $_SESSION['message_type'] = 'danger';
  header('Location: costos_agregarcostomateria.php');
}



?>
