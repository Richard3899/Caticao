<?php
include 'includes/config/db.php';
$conexion=conexion();


if(isset($_GET['idMateria'])) {
  $id = $_GET['idMateria'];
  $query = "DELETE FROM materia WHERE idMateria = $id";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Materia prima eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: stock_materiaprima.php');
}

?>
