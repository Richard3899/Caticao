
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_agregarrecetainsumos'])) {

    $conexion=conexion();
    $cantidad= $_POST['cantidad'];
	  $idMateria= $_POST['idMateria'];
    $idReceta= $_POST['idReceta'];
    $idUnidadMedida= $_POST['idUnidadMedida'];


	  $sql="CALL insertar_recetainsumos('$cantidad','$idMateria','$idReceta','$idUnidadMedida')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos ".$sql);
  }

  $_SESSION['message'] = 'Insumo de receta registrada';
  $_SESSION['message_type'] = 'success';
  header('Location: costos_agregarrecetainsumos.php');

}


?>


