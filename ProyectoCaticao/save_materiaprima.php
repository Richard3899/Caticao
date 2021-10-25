
<?php

include 'includes/config/db.php';

if (isset($_POST['save_materiaprima'])) {
    $conexion=conexion();
    $Nombre= $_POST['nombre'];
    $descripcion= $_POST['descripcion'];
    $cantidad= $_POST['cantidad'];
    $Descripcion_TipoMateria= $_POST['id_idTipoMateria'];
    $descripcion_Unidad= $_POST['idUnidadMedida'];
    $Descripcion_Marca= $_POST['idMarca'];
    
    
    $sql="CALL insertar_materia('$Nombre','$descripcion','$cantidad','$Descripcion_TipoMateria'
    ,'$descripcion_Unidad','$Descripcion_Marca')";

    $result = mysqli_query($conexion, $sql);


  if(!$result) {
    die("Falta rellenar datos ".$sql);
  }
  
  $_SESSION['message'] = 'Materia prima resgistrada';
  $_SESSION['message_type'] = 'success';
  header('Location: stock_materiaprima.php');

}

?>





