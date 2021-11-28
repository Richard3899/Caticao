
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_manodeobrareceta'])) {

    $conexion=conexion();

	  $idManodeObra= $_POST['idManodeObra'];
    $idReceta= $_POST['idReceta'];
    $cantidad= $_POST['cantidad'];

	  $sql="CALL insertar_manodeobrareceta('$idManodeObra','$idReceta','$cantidad')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Mano de obra en receta registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: cd_manodeobrareceta_registro.php');

}


?>


