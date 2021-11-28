
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_depreciacionreceta'])) {

    $conexion=conexion();

	  $idDepreciacion= $_POST['idDepreciacion'];
    $idReceta= $_POST['idReceta'];

	  $sql="CALL insertar_depreciacionreceta('$idDepreciacion','$idReceta')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Depreciación en receta registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: ci_depreciacionreceta_registro.php');

}


?>


