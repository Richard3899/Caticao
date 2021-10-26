
<?php


include 'includes/config/db.php';


$db1=conexion();
$consulta1="Select*from tipoProducto";
$resultado1= mysqli_query($db1, $consulta1);

$db2=conexion();
$consulta2="select*from almacen";
$resultado2= mysqli_query($db2, $consulta2);



                        $nombre = '';
                        $descripcion= '';
                        $idAlmacen='';
                   
                        $cantidad= '';
                        $precio= '';
                        $idTipoProducto= '';
                        $descripcion_TipoProducto='';
                        $descripcionTP= '';
                        $descripcion_Almacen='';
                        $descripcionA='';

                        if  (isset($_GET['idProducto'])) {
                        $id = $_GET['idProducto'];
                        $query = "SELECT * FROM producto WHERE idProducto=$id";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $nombre = $row['nombre'];
                            $descripcion = $row['descripcion'];
                            $cantidad = $row['cantidad'];
                            $precio = $row['precio'];
                            $idTipoProducto= $row['idTipoProducto'];
                            $idAlmacen= $row['idAlmacen'];
                        }
                        }

                        if (isset($_POST['update_producto'])) {

                            $id = $_GET['idProducto'];
                            $nombre = $_POST['nombre'];
                            $descripcion = $_POST['descripcion'];
                            $cantidad = $_POST['cantidad'];
                            $precio = $_POST['precio'];
                            $idTipoProducto= $_POST['idTipoProducto'];
                            $idAlmacen= $_POST['idAlmacen'];

                        $query = "UPDATE producto set nombre = '$nombre', descripcion = '$descripcion', cantidad = '$cantidad',  precio = '$precio', idTipoProducto = '$idTipoProducto', idAlmacen = '$idAlmacen' WHERE idProducto=$id";
                        mysqli_query($conn, $query);
                        $_SESSION['message'] = 'Actualización exitosa';
                        $_SESSION['message_type'] = 'warning';
                        header('Location: stock_producto.php');
                        }


                        include 'includes/templates/head.php'

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

            <?php
            include 'includes/templates/sidebar.php'
            ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Topbar -->
                <?php
                include 'includes/templates/nav.php'
                ?>
            

                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 text-center">Stock de Productos</h1>



                    <?php
                    include 'includes/templates/nav_stock.php'
                    ?>


                        <?php
                        

                        ?>

                        
                        <form action="edit_producto.php?idProducto=<?php echo $_GET['idProducto']; ?>" method="POST">

                        
                        <div class="form-row">
                           

                            <div class="form-group col-md-4">
                            <label for="nombre">nombre</label>
                            <input type="text" step="any" class="form-control" id="nombre" value="<?php echo $nombre;?>" name="nombre" placeholder="Nombre" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                            <label for="descripción">descripcion</label>
                            <input type="text" step="any" class="form-control" id="descripcion" value="<?php echo $descripcion;?>" name="descripcion" placeholder="Descripcion" required>
                            </div>
                         
                            <div class="form-group col-md-4">
                            <label for="cantidad">cantidad</label>
                            <input type="number" step="any" class="form-control" id="cantidad" value="<?php echo $cantidad;?>" name="cantidad" placeholder="Cantidad" required>
                            </div>
                         
                        </div>
                            

                       
                        <div class="form-row">
                            
                            <div class="form-group col-md-4">
                            <label for="precio">Precio</label>
                            <input type="Number" step="any" class="form-control" id="precio" value="<?php echo $precio;?>" name="precio" placeholder="Precio" required>
                            </div>
    
                           
                            <div class="form-group col-md-4">
                                <label for="tipoProducto">Tipo Producto</label>
                                <select id='idtipoProducto' name="idTipoProducto" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_TipoProducto=mysqli_fetch_assoc($resultado1)):?>
                                    <option <?php echo $idTipoProducto == $descripcion_TipoProducto['idTipoProducto'] ? 'selected' : '';?> 
                                    value= "<?php echo $descripcion_TipoProducto['idTipoProducto'];?>">
                                    <?php echo $descripcion_TipoProducto ['descripcionTP'];?> </option>
                                <?php endwhile; ?>
                                    
                                </select>
                                                   
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Almacen">Sede Almacen</label>
                                <select id='idAlmacen' name="idAlmacen" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_Almacen=mysqli_fetch_assoc($resultado2)):?>
                                    <option <?php echo $idAlmacen == $descripcion_Almacen['idAlmacen'] ? 'selected' : '';?> 
                                    value= "<?php echo $descripcion_Almacen['idAlmacen'];?>">
                                    <?php echo $descripcion_Almacen ['descripcionA'];?> </option>
                                <?php endwhile; ?>
                                    
                                </select>
                            </div>
                        </div>
                           

                        <button type="submit" class="btn btn-primary" name="update_producto">Actualizar</button>
                        </form>

                  

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <?php
    include 'includes/templates/logout_modal.php'
    ?>

    <?php
    include 'includes/templates/scripts.php'
    ?>

</body>

</html>