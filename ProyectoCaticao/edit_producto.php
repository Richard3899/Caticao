
<?php


include 'includes/config/db.php';


$db1=conexion();
$consulta1="Select*from TipoProducto";
$resultado1= mysqli_query($db1, $consulta1);

$db2=conexion();
$consulta2="select*from Lote";
$resultado2= mysqli_query($db2, $consulta2);



                        $Nombre = '';
                        $Descripcion= '';
                        $idLote='';
                   
                        $Cantidad= '';
                        $Precio= '';
                        $idTipoProducto= '';
                        $descripcion_TipoProducto='';
                        $descripcionP= '';
                        $descripcion_Lote='';

                        if  (isset($_GET['idProducto'])) {
                        $id = $_GET['idProducto'];
                        $query = "SELECT * FROM producto WHERE idProducto=$id";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $Nombre = $row['Nombre'];
                            $Descripcion = $row['Descripcion'];
                            $Cantidad = $row['Cantidad'];
                            $Precio = $row['Precio'];
                            $idTipoProducto= $row['idTipoProducto'];
                            $idLote= $row['idLote'];
                        }
                        }

                        if (isset($_POST['update_producto'])) {

                            $id = $_GET['idProducto'];
                            $Nombre = $_POST['Nombre'];
                            $Descripcion = $_POST['Descripcion'];
                            $Cantidad = $_POST['Cantidad'];
                            $Precio = $_POST['Precio'];
                            $idTipoProducto= $_POST['idTipoProducto'];
                            $idLote= $_POST['idLote'];

                        $query = "UPDATE producto set Nombre = '$Nombre', Descripcion = '$Descripcion', Cantidad = '$Cantidad',  Precio = '$Precio', idTipoProducto = '$idTipoProducto', idLote = '$idLote' WHERE idProducto=$id";
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
                            <label for="precio">Nombre</label>
                            <input type="text" step="any" class="form-control" id="Nombre" value="<?php echo $Nombre;?>" name="Nombre" placeholder="Nombre" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                            <label for="Descripción">Descripcion</label>
                            <input type="text" step="any" class="form-control" id="Descripcion" value="<?php echo $Descripcion;?>" name="Descripcion" placeholder="Descripcion" required>
                            </div>
                         
                            <div class="form-group col-md-4">
                            <label for="Cantidad">Cantidad</label>
                            <input type="text" step="any" class="form-control" id="Cantidad" value="<?php echo $Cantidad;?>" name="Cantidad" placeholder="Cantidad" required>
                            </div>
                         
                        </div>
                            

                       
                        <div class="form-row">
                            
                            <div class="form-group col-md-4">
                            <label for="Precio">Precio</label>
                            <input type="Number" step="any" class="form-control" id="Precio" value="<?php echo $Precio;?>" name="Precio" placeholder="Precio" required>
                            </div>
    
                           
                            <div class="form-group col-md-4">
                                <label for="tipoProducto">Tipo Producto</label>
                                <select id='idtipoProducto' name="idTipoProducto" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_TipoProducto=mysqli_fetch_assoc($resultado1)):?>
                                    <option <?php echo $idTipoProducto == $descripcion_TipoProducto['idTipoProducto'] ? 'selected' : '';?> 
                                    value= "<?php echo $descripcion_TipoProducto['idTipoProducto'];?>">
                                    <?php echo $descripcion_TipoProducto ['descripcionP'];?> </option>
                                <?php endwhile; ?>
                                    
                                </select>
                                                   
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Lote">Nro Lote</label>
                                <select id='idLote' name="idLote" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_Lote=mysqli_fetch_assoc($resultado2)):?>
                                    <option <?php echo $idLote == $descripcion_Lote['idLote'] ? 'selected' : '';?> 
                                    value= "<?php echo $descripcion_Lote['idLote'];?>">
                                    <?php echo $descripcion_Lote ['NroLote'];?> </option>
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