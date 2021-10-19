
<?php

include 'includes/config/db.php';

if (isset($_POST['save_materiaprima'])) {

    $Nombre= $_POST['Nombre'];
    $descripción= $_POST['descripción'];
    $Descripcion_Marca= $_POST['idMarca'];
    $descripcion_Unidad= $_POST['idUnidadMedida'];
    $cantidad= $_POST['cantidad'];
    $Descripcion_TipoMateria= $_POST['id_idTipoMateria'];
    
    $query = "INSERT INTO materia(Nombre,descripción,idMarca,idUnidadMedida,cantidad,idTipoMateria)
    VALUES ('$Nombre','$descripción','$Descripcion_Marca','$descripcion_Unidad','$cantidad','$Descripcion_TipoMateria')";

    $result = mysqli_query($conn, $query);


  if(!$result) {
    die("Falta rellenar datos");
  }
  
  $_SESSION['message'] = 'Materia prima resgistrada';
  $_SESSION['message_type'] = 'success';
  header('Location: stock_materiaprima.php');

}

?>




