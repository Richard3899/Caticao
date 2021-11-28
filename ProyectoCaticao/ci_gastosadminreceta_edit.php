
<?php
                        include 'includes/config/db.php';

                        $cantidad= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_comboreceta";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idReceta = '';


                        $db3=conexion();
                        $consulta3="CALL mostrar_combogastosadmin";
                        $resultado3= mysqli_query($db3, $consulta3);
                        $idGastosAdmin = '';

                        if  (isset($_GET['idGastosAdminReceta'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idGastosAdminReceta'];

                        $sql="CALL obtener_gastosadminreceta($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $idGastosAdmin = $row['idGastosAdmin'];
                            $idReceta = $row['idReceta'];
                            $cantidad = $row['cantidad'];
                        }

    
                        }

                        if (isset($_POST['update_gastosadminreceta'])) {
                            $conexion=conexion();
	                        $idGastosAdminReceta = $_GET['idGastosAdminReceta'];
                            $idGastosAdmin = $_POST['idGastosAdmin'];
                            $idReceta = $_POST['idReceta'];
                            $cantidad = $_POST['cantidad'];

	                        $sql="CALL actualizar_gastosadminreceta('$idGastosAdminReceta','$idGastosAdmin',
									'$idReceta',
									'$cantidad')";
									
	                        mysqli_query($conexion,$sql);
                            

                            $_SESSION['message'] = 'Actualización exitosa de Gastos Administrativos en su receta';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: ci_gastosadminreceta_registro.php');
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

                        
                        <form action="ci_gastosadminreceta_edit.php?idGastosAdminReceta=<?php echo $_GET['idGastosAdminReceta']; ?>" method="POST">
                        

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="Receta">Receta</label>
                            <select id='id_idReceta' name="idReceta" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($receta=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idReceta == $receta['idReceta'] ? 'selected' : '';?> 
                                value="<?php echo $receta['idReceta'];?>">
                                <?php echo $receta['descripcion'];?> </option>
                              <?php endwhile;?>
                            </select>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="Gastos">Gastos Administrativos</label>
                            <select id='id_idGastosAdmin' name="idGastosAdmin" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($gastosadmin=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idGastosAdmin == $gastosadmin['idGastosAdmin'] ? 'selected' : '';?> 
                                value="<?php echo $gastosadmin['idGastosAdmin'];?>">
                                <?php echo $gastosadmin['descripcion'];?> </option>
                              <?php endwhile;?>
                            </select>
                            </div>
                            

                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="precio">Cantidad</label>
                            <input type="number" step="any" class="form-control" value="<?php echo $cantidad;?>" name="cantidad" placeholder="Cantidad" required>
                            </div>
                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_gastosadminreceta">Actualizar</button>
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