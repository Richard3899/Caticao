
<?php

include 'includes/config/db.php';

if (isset($_POST['save_materiaprima'])) {

    $Nombre= $_POST['Nombre'];
    $descripción= $_POST['descripción'];
    $Descripcion_Marca= $_POST['Descripcion_Marca'];
    $descripcion_Unidad= $_POST['descripcion_Unidad'];
    $Descripcion_TipoMateria= $_POST['Descripcion_TipoMateria'];
    $cantidad= $_POST['cantidad'];
 

    $query = "INSERT INTO materiaprima(Nombre,descripción,Descripcion_Marca,descripcion_Unidad,cantidad,Descripcion_TipoMateria)
    VALUES ('$Nombre','$descripción','$Descripcion_Marca','$descripcion_Unidad','$Descripcion_TipoMateria','$cantidad')";

    $result = mysqli_query($conn, $query);


  if(!$result) {
    die("Falta rellenar datos");
  }

  $_SESSION['message'] = 'Materia prima resgistrada';
  $_SESSION['message_type'] = 'success';
  header('Location: stock_materiaprima.php');

}

?>


