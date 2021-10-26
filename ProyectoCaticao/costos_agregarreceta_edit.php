
<?php
                        include 'includes/config/db.php';

                        $PrecioUnit= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_comboproducto";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idProducto = '';
                        


                        if  (isset($_GET['idReceta'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idReceta'];

                        $sql="CALL obtener_agregarreceta($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $descripcion = $row['descripcion'];
                            $idProducto = $row['idProducto'];
                        }

    
                        }

                        if (isset($_POST['update_agregarreceta'])) {
                            $conexion=conexion();
	                        $idReceta = $_GET['idReceta'];
                            $descripcion = $_POST['descripcion'];
                            $idProducto = $_POST['idProducto'];

	                        $sql="CALL actualizar_agregarreceta('$idReceta','$descripcion',
									'$idProducto')";
									
	                        mysqli_query($conexion,$sql);
                            

                            $_SESSION['message'] = 'Actualización exitosa de la receta';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: costos_agregarreceta.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar Receta </h1>

                        
                        <form action="costos_agregarreceta_edit.php?idReceta=<?php echo $_GET['idReceta']; ?>" method="POST">
                        

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="producto">Producto</label>
                            <select id='id_idProducto' name="idProducto" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($producto=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idProducto == $producto['idProducto'] ? 'selected' : '';?> 
                                value="<?php echo $producto['idProducto'];?>">
                                <?php echo $producto['nombre'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>

                            
                            <div class="form-group col-md-6">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" value="<?php echo $descripcion;?>" name="descripcion" placeholder="Descripcion" required>
                            </div>

                        </div>


                        

                        <button type="submit" class="btn btn-primary" name="update_agregarreceta">Actualizar</button>
                        </form>

                  

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
            include 'includes/templates/footer.php'
            ?>

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