
<?php

include 'includes/config/db.php';

if (isset($_POST['save_maquina'])) {
    $conexion=conexion();
    $Nombre= $_POST['nombre'];
    $Descripcion= $_POST['descripcion'];
    
    $sql="CALL insertar_maquina('$Nombre','$Descripcion')";

    $result = mysqli_query($conexion, $sql);


  if(!$result) {
    die("Falta rellenar datos ".$sql);
  }
  
  $_SESSION['message'] = 'Maquina resgistrada';
  $_SESSION['message_type'] = 'success';
  header('Location: maquina_registro.php');

}

?>





