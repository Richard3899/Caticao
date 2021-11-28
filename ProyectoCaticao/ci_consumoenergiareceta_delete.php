<?php
include 'includes/config/db.php';
$conexion=conexion();

if(isset($_GET['idConsumoEnergiaReceta'])) {
  $id=$_GET['idConsumoEnergiaReceta'];
  $sql="CALL eliminar_consumoenergiareceta('$id')";
  $result = mysqli_query($conexion,$sql);

  if(!$result) {
    die("Falló el eliminar");
  }

  $_SESSION['message'] = 'Receta con consumo de energia eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: ci_consumoenergiareceta_registro.php');
}

?>


