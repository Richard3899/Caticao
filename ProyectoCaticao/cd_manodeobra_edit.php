
<?php
                        include 'includes/config/db.php';

                        $descripcion= '';
                        $preciounitario= '';

                        $db2=conexion();
                        $consulta2="CALL mostrar_combounidadmedida";
                        $resultado2= mysqli_query($db2, $consulta2);
                        $idUnidadMedida = '';

                        $db3=conexion();
                        $consulta3="CALL mostrar_combotipocostos";
                        $resultado3= mysqli_query($db3, $consulta3);
                        $idTipoCostos = '';


                        if  (isset($_GET['idManodeObra'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idManodeObra'];

                        $sql="CALL obtener_manodeobra($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $descripcion = $row['descripcion'];
                            $preciounitario = $row['precioUnitario'];
                            $idTipoCostos = $row['idTipoCostos'];
                            $idUnidadMedida = $row['idUnidadMedida'];
                        }

                        }

                        if (isset($_POST['update_manodeobra'])) {
                            $conexion=conexion();
	                        $idManodeObra = $_GET['idManodeObra'];
                            $descripcion = $_POST['descripcion'];
                            $preciounitario = $_POST['precioUnitario'];
                            $idTipoCostos = $_POST['idTipoCostos'];
                            $idUnidadMedida = $_POST['idUnidadMedida'];
                       
	                        $sql="CALL actualizar_manodeobra('$idManodeObra','$descripcion','$preciounitario',
                                                                 '$idTipoCostos','$idUnidadMedida')";
									
                            $result = mysqli_query($conexion, $sql);

                            if(!$result) {
                                die("Error al actualizar los datos".$sql);
                              }
                            
                            $_SESSION['message'] = 'Actualizaci??n exitosa de la Mano de obra';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: cd_manodeobra_registro.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar Mano de Obra </h1>

                        
                        <form action="cd_manodeobra_edit.php?idManodeObra=<?php echo $_GET['idManodeObra']; ?>" method="POST">
                       
                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="descripci??n"> Descripci??n </label>
                            <input type="text" class="form-control" id="descripci??n" value="<?php echo $descripcion;?>" name="descripcion" placeholder="Descripci??n">
                            </div>
                            
                            <div class="form-group col-md-6">
                            <label for="descripcion_Unidad">Unidad de Medida</label>
                            <select id='id_idUnidadMedida' name="idUnidadMedida" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($unidad=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idUnidadMedida == $unidad['idUnidadMedida'] ? 'selected' : '';?> 
                                value= "<?php echo $unidad['idUnidadMedida'];?>">
                                <?php echo $unidad ['descripcion'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>

                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
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

                            <div class="form-group col-md-6">
                            <label for="precio">Precio Unitario</label>
                            <input type="number" step="any" class="form-control" id="id_precio" value="<?php echo $preciounitario;?>" name="precioUnitario" placeholder="Precio" required>
                            </div>
                    
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_manodeobra">Actualizar</button>
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