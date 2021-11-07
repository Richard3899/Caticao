
<?php
                        include 'includes/config/db.php';

                        $importe= '';
                        $vidautil= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_combomaquina";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idMaquina = '';


                        if  (isset($_GET['idDepreciacion'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idDepreciacion'];

                        $sql="CALL obtener_depreciacion($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $importe = $row['importe'];
                            $vidautil = $row['vidaUtil'];
                            $idMaquina = $row['idMaquina'];
                        }

    
                        }

                        if (isset($_POST['update_depreciacion'])) {
                            $conexion=conexion();
	                        $idDepreciacion = $_GET['idDepreciacion'];
                            $importe = $_POST['importe'];
                            $vidautil = $_POST['vidautil'];
                       

	                        $sql="CALL actualizar_depreciacion('$idDepreciacion','$importe','$vidautil')";
									
                            $result = mysqli_query($conexion, $sql);

                            if(!$result) {
                                die("Error al actualizar los datos ".$sql);
                              }
                            

                            $_SESSION['message'] = 'Actualización exitosa de la depreciación';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: ci_depreciacion_registro.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar depreciación </h1>

                        
                        <form action="ci_depreciacion_edit.php?idDepreciacion=<?php echo $_GET['idDepreciacion']; ?>" method="POST">
                       
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="maquina">Maquina</label>
                            <select id='id_idMaquina' name="idMaquina" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($maquina=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMaquina == $maquina['idMaquina'] ? 'selected' : '';?> 
                                value="<?php echo $maquina['idMaquina'];?>">
                                <?php echo $maquina['nombre'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="importe">Importe de la maquina</label>
                            <input type="number" step="any" class="form-control" id="id_importe" value="<?php echo $importe;?>" name="importe" placeholder="Importe" required>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="vidautil">Vida util</label>
                            <input type="number" step="any" class="form-control" id="id_vidautil" value="<?php echo $vidautil;?>" name="vidautil" placeholder="Vida util" required>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary" name="update_depreciacion">Actualizar</button>
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