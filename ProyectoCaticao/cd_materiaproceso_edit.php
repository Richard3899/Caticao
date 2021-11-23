
<?php
                        include 'includes/config/db.php';

                        $Descripcion= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_combomateria";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idMateria = '';

                        $db3=conexion();
                        $consulta3="CALL mostrar_proceso";
                        $resultado3= mysqli_query($db3, $consulta3);
                        $idProceso = '';

                        if  (isset($_GET['idMateriaProceso'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idMateriaProceso'];

                        $sql="CALL obtener_materiaproceso($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $idMateria = $row['idMateria'];
                            $idProceso = $row['idProceso'];
                            $Descripcion = $row['descripcion'];
                        }

    
                        }

                        if (isset($_POST['update_materiaproceso'])) {
                            $conexion=conexion();
	                        $idMateriaProceso = $_GET['idMateriaProceso'];
                            $idMateria = $_POST['idMateria'];
                            $idProceso = $_POST['idProceso'];
                            $descripcion = $_POST['descripcion'];

	                        $sql="CALL actualizar_materiaproceso('$idMateriaProceso','$idMateria',
									'$idProceso',
									'$descripcion')";
									
	                        mysqli_query($conexion,$sql);
                            

                            $_SESSION['message'] = 'Actualización exitosa de la materia en su proceso';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: cd_materiaproceso_registro.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar Materia con su proceso </h1>

                        
                        <form action="cd_materiaproceso_edit.php?idMateriaProceso=<?php echo $_GET['idMateriaProceso']; ?>" method="POST">
                        

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="materia">Matería</label>
                            <select  id='id_idMateria' name="idMateria" class='form-control' required>
                                <option disabled value="">Seleccione</option>
                                <?php while ($materia=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMateria == $materia['idMateria'] ? 'selected' : '';?> 
                                value="<?php echo $materia['idMateria'];?>">
                                <?php echo $materia['nombre'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="proceso">Proceso</label>
                            <select id='id_idProceso' name="idProceso" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($proceso=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idProceso == $proceso['idProceso'] ? 'selected' : '';?> 
                                value="<?php echo $proceso['idProceso'];?>">
                                <?php echo $proceso['descripcion'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>
                            

                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-12">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="<?php echo $Descripcion;?>" name="descripcion" placeholder="Descripción" required>
                            </div>
                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_materiaproceso">Actualizar</button>
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