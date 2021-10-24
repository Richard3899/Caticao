<?php
include 'includes/config/db.php';
$conexion=conexion();


if(isset($_GET['idMateria'])) {
  $id = $_GET['idMateria'];
  $sql="CALL eliminar_materia('$id')";
  $result = mysqli_query($conexion,$sql);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Materia prima eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: stock_materiaprima.php');
}

?>

