
<?php
                        include 'includes/config/db.php';

                        $cantidad= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_combomateriarecetainsumos";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idMateria = '';

                        $db2=conexion();
                        $consulta2="CALL mostrar_comboreceta";
                        $resultado2= mysqli_query($db2, $consulta2);
                        $idReceta = '';

                        $db3=conexion();
                        $consulta3="CALL mostrar_combounidadmedida";
                        $resultado3= mysqli_query($db3, $consulta3);
                        $idUnidadMedida = '';

                        if  (isset($_GET['idRecetaMateria'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idRecetaMateria'];

                        $sql="CALL obtener_recetainsumos($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $cantidad = $row['cantidad'];
                            $idMateria = $row['idMateria'];
                            $idReceta = $row['idReceta'];
                            $idUnidadMedida = $row['idUnidadMedida'];
     
                        }

                        }

                        if (isset($_POST['update_recetainsumos'])) {
                            $conexion=conexion();
	                        $idRecetaMateria = $_GET['idRecetaMateria'];
                            $cantidad = $_POST['cantidad'];
                            $idMateria = $_POST['idMateria'];
                            $idReceta = $_POST['idReceta'];
                            $idUnidadMedida = $_POST['idUnidadMedida'];

	                        $sql="CALL actualizar_recetainsumos('$idRecetaMateria','$cantidad','$idMateria',
									'$idReceta',
									'$idUnidadMedida')";
									
	                        mysqli_query($conexion,$sql);
                            

                            $_SESSION['message'] = 'Actualización exitosa del insumo de la Receta';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: costos_agregarrecetainsumos.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar insumos de la receta </h1>

                    
                        <form action="costos_agregarrecetainsumos_edit.php?idRecetaMateria=<?php echo $_GET['idRecetaMateria']; ?>" method="POST">

                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Receta">Receta</label>
                            <select id='id_idReceta' name="idReceta" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($receta=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idReceta == $receta['idReceta'] ? 'selected' : '';?> 
                                value="<?php echo $receta['idReceta'];?>">
                                <?php echo $receta['descripcion'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>

                            
                            <div class="form-group col-md-6">
                            <label for="materia">Insumo</label>
                            <select id='id_idMateria' name="idMateria" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($materia=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMateria == $materia['idMateria'] ? 'selected' : '';?> 
                                value="<?php echo $materia['idMateria'];?>">
                                <?php echo $materia['nombre'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>

                        </div>


                        <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="descripcion_Unidad">Unidad de Medida</label>
                            <select id='id_idUnidadMedida' name="idUnidadMedida" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($unidad=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idUnidadMedida == $unidad['idUnidadMedida'] ? 'selected' : '';?> 
                                value= "<?php echo $unidad['idUnidadMedida'];?>">
                                <?php echo $unidad ['descripcion'];?> </option>
                             <?php endwhile; ?>
                        
                            </select>
                           
                            </div>

                            <div class="form-group col-md-6">
                            <label for="precio">Cantidad</label>
                            <input type="number" step="any" class="form-control" value="<?php echo $cantidad;?>" name="cantidad" placeholder="Cantidad" required>
                            </div>
                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_recetainsumos">Actualizar</button>
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