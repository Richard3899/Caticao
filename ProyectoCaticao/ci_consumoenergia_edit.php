
<?php
                        include 'includes/config/db.php';

                        $tarifa= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_combomaquina";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idMaquina = '';

                        $db3=conexion();
                        $consulta3="CALL mostrar_combotipocostos";
                        $resultado3= mysqli_query($db3, $consulta3);
                        $idTipoCostos = '';

                        if  (isset($_GET['idConsumoEnergia'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idConsumoEnergia'];

                        $sql="CALL obtener_consumoenergia($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $tarifa = $row['tarifaKwh'];
                            $idMaquina = $row['idMaquina'];
                            $idTipoCostos = $row['idTipoCostos'];

                        }

    
                        }

                        if (isset($_POST['update_consumoenergia'])) {
                            $conexion=conexion();
	                        $idConsumoEnergia = $_GET['idConsumoEnergia'];
                            $tarifa = $_POST['tarifa'];
                            $idTipoCostos = $_POST['idTipoCostos'];
                       

	                        $sql="CALL actualizar_consumoenergia('$idConsumoEnergia','$tarifa','$idTipoCostos')";
									
                            $result = mysqli_query($conexion, $sql);

                            if(!$result) {
                                die("Error al actualizar los datos ".$sql);
                              }
                            

                            $_SESSION['message'] = 'Actualización exitosa del consumo de energía';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: ci_consumoenergia_registro.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar consumo de energia </h1>

                        
                        <form action="ci_consumoenergia_edit.php?idConsumoEnergia=<?php echo $_GET['idConsumoEnergia']; ?>" method="POST">
                       
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
                            <label for="categoria">Tipo de Costo</label>
                            <select id='id_idCategoria' name="idTipoCostos" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($tipocostos=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idTipoCostos == $tipocostos['idTipoCostos'] ? 'selected' : '';?> 
                                value="<?php echo $tipocostos['idTipoCostos'];?>">
                                <?php echo $tipocostos['Descripcion'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>
                         
                            <div class="form-group col-md-4">
                            <label for="tarifa">Tarifa Electrocentro</label>
                            <input type="number" step="any" class="form-control" id="id_tarifa" value="<?php echo $tarifa;?>" name="tarifa" placeholder="Tarifa" required>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary" name="update_consumoenergia">Actualizar</button>
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