
<?php

include 'includes/config/db.php';
    
if (isset($_POST['save_agregarcostomateria'])) {

    $conexion=conexion();

	  $idMateria= $_POST['idMateria'];
    $idCostos= $_POST['idCostos'];
    $idTipoCostos= $_POST['idTipoCostos'];
    $PrecioUnit= $_POST['PrecioUnit'];

	  $sql="CALL insertar_materiacostos('$idMateria','$idCostos','$idTipoCostos','$PrecioUnit')";

    $result = mysqli_query($conexion, $sql);

  if(!$result) {
    die("Error al insertar los datos".$sql);
  }

  $_SESSION['message'] = 'Costo de Materia registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: costos_agregarcostomateria.php');

}






?>


