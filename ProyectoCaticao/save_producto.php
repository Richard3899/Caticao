<?php

include 'includes/config/db.php';

if (isset($_POST['save_producto'])) {

    $nombre= $_POST['nombre'];
    $descripcion= $_POST['descripcion'];
    $idTipoProducto= $_POST['idTipoProducto'];
    $idLote= $_POST['idLote'];
    $cantidad= $_POST['cantidad'];
    $precio= $_POST['precio'];

    $query = "INSERT INTO producto(nombre,descripcion,
    cantidad,precio,idTipoProducto,idLote)
    VALUES ('$nombre','$descripcion','$cantidad','$precio','$idTipoProducto','$idLote')";

    $result = mysqli_query($conn, $query);


  if(!$result) {
    die("Falta rellenar datos");
  }

  $_SESSION['message'] = 'Producto registrado';
  $_SESSION['message_type'] = 'success';
  header('Location: stock_producto.php');

}

?>


