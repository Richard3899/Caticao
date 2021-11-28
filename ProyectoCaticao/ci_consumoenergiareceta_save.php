
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_consumoenergiareceta'])) {

    $conexion=conexion();

	  $idConsumoEnergia= $_POST['idConsumoEnergia'];
    $idReceta= $_POST['idReceta'];

	  $sql="CALL insertar_consumoenergiareceta('$idConsumoEnergia','$idReceta')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Consumo de energía en receta registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: ci_consumoenergiareceta_registro.php');

}


?>


