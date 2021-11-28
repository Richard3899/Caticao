
<?php
                        include 'includes/config/db.php';

                        $db1=conexion();
                        $consulta1="CALL mostrar_comboreceta";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idReceta = '';


                        $db2=conexion();
                        $consulta2="CALL mostrar_combodepreciacion";
                        $resultado2= mysqli_query($db2, $consulta2);
                        $idDepreciacion = '';

                        if  (isset($_GET['idDepreciacionReceta'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idDepreciacionReceta'];

                        $sql="CALL obtener_depreciacionreceta($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $idDepreciacion = $row['idDepreciacion'];
                            $idReceta = $row['idReceta'];
                        }

    
                        }

                        if (isset($_POST['update_depreciacionreceta'])) {
                            $conexion=conexion();
	                        $idDepreciacionReceta = $_GET['idDepreciacionReceta'];
                            $idDepreciacion = $_POST['idDepreciacion'];
                            $idReceta = $_POST['idReceta'];

	                        $sql="CALL actualizar_depreciacionreceta('$idDepreciacionReceta','$idDepreciacion',
									'$idReceta')";
									
	                        mysqli_query($conexion,$sql);
                            

                            $_SESSION['message'] = 'Actualización exitosa de la depreciacion en su receta';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: ci_depreciacionreceta_registro.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar Depreciación con su receta </h1>

                        
                        <form action="ci_depreciacionreceta_edit.php?idDepreciacionReceta=<?php echo $_GET['idDepreciacionReceta']; ?>" method="POST">
                        

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
                            <label for="descripcion_Mano de obra">Maquina</label>
                            <select id='id_idDepreciacion' name="idDepreciacion" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($depreciacion=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idDepreciacion == $depreciacion['idDepreciacion'] ? 'selected' : '';?> 
                                value= "<?php echo $depreciacion['idDepreciacion'];?>">
                                <?php echo $depreciacion ['nombre'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>
                            

                        </div>


                        <button type="submit" class="btn btn-primary" name="update_depreciacionreceta">Actualizar</button>
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