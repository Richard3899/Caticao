
<?php
                        include 'includes/config/db.php';

                        $PrecioUnit= '';

                        $db1=conexion();
                        $consulta1="CALL mostrar_combomateriaeditar";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idMateria = '';
                        

                        $db2=conexion();
                        $consulta2="CALL mostrar_combocostos";
                        $resultado2= mysqli_query($db2, $consulta2);
                        $idCostos = '';

                        $db3=conexion();
                        $consulta3="CALL mostrar_combotipocostos";
                        $resultado3= mysqli_query($db3, $consulta3);
                        $idTipoCostos = '';

                        if  (isset($_GET['idMateriaCostos'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idMateriaCostos'];

                        $sql="CALL obtener_materiacostos($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $idMateria = $row['idMateria'];
                            $idTipoCostos = $row['idTipoCostos'];
                            $precioUnitario = $row['precioUnitario'];
                        }

    
                        }

                        if (isset($_POST['update_agregarcostomateria'])) {
                            $conexion=conexion();
	                        $idMateriaCostos = $_GET['idMateriaCostos'];
                            $idMateria = $_POST['idMateria'];
                            $idTipoCostos = $_POST['idTipoCostos'];
                            $precioUnitario = $_POST['precioUnitario'];

	                        $sql="CALL actualizar_materiacostos('$idMateriaCostos','$idMateria',
									'$idTipoCostos',
									'$precioUnitario')";
									
	                        mysqli_query($conexion,$sql);
                            

                            $_SESSION['message'] = 'Actualización exitosa del costo de la materia';
                            $_SESSION['message_type'] = 'warning';
                            header('Location: costos_agregarcostomateria.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar Costo de Materia </h1>

                        
                        <form action="costos_agregarmateriaedit.php?idMateriaCostos=<?php echo $_GET['idMateriaCostos']; ?>" method="POST">
                        

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
                            

                        </div>


                        <div class="form-row">

                            

                            <div class="form-group col-md-6">
                            <label for="precio">Precio Unitario</label>
                            <input type="number" step="any" class="form-control" id="id_precio" value="<?php echo $precioUnitario;?>" name="precioUnitario" placeholder="Precio" required>
                            </div>
                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_agregarcostomateria">Actualizar</button>
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