
<?php
                        include 'includes/config/db.php';

                        $cantidad= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_comboreceta";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idReceta = '';


                        $db2=conexion();
                        $consulta2="CALL mostrar_combomanodeobra";
                        $resultado2= mysqli_query($db2, $consulta2);
                        $idManodeObra = '';

                        if  (isset($_GET['idManodeObraReceta'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idManodeObraReceta'];

                        $sql="CALL obtener_manodeobrareceta($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $idManodeObra = $row['idManodeObra'];
                            $idReceta = $row['idReceta'];
                            $cantidad = $row['cantidad'];
                        }

    
                        }

                        if (isset($_POST['update_manodeobrareceta'])) {
                            $conexion=conexion();
	                        $idManodeObraReceta = $_GET['idManodeObraReceta'];
                            $idManodeObra = $_POST['idManodeObra'];
                            $idReceta = $_POST['idReceta'];
                            $cantidad = $_POST['cantidad'];

	                        $sql="CALL actualizar_manodeobrareceta('$idManodeObraReceta','$idManodeObra',
									'$idReceta',
									'$cantidad')";
									
	                        mysqli_query($conexion,$sql);
                            

                            $_SESSION['message'] = 'Actualización exitosa de la mano de obra en su receta';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: cd_manodeobrareceta_registro.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar Mano de obra con su receta </h1>

                        
                        <form action="cd_manodeobrareceta_edit.php?idManodeObraReceta=<?php echo $_GET['idManodeObraReceta']; ?>" method="POST">
                        

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="Receta">Receta</label>
                            <select id='id_idReceta' name="idReceta" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($receta=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idReceta == $receta['idReceta'] ? 'selected' : '';?> 
                                value="<?php echo $receta['idReceta'];?>">
                                <?php echo $receta['descripcion'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>


                            <div class="form-group col-md-6">
                            <label for="descripcion_Mano de obra">Mano de Obra</label>
                            <select id='id_idManodeObra' name="idManodeObra" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($manodeobra=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idManodeObra == $manodeobra['idManodeObra'] ? 'selected' : '';?> 
                                value= "<?php echo $manodeobra['idManodeObra'];?>">
                                <?php echo $manodeobra ['descripcion'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>
                            

                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="precio">Cantidad</label>
                            <input type="number" step="any" class="form-control" value="<?php echo $cantidad;?>" name="cantidad" placeholder="Cantidad" required>
                            </div>
                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_manodeobrareceta">Actualizar</button>
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