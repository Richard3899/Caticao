
<?php


include 'includes/config/db.php';
$db1=conexion();
$consulta1="Select*from unidadMedida";
$resultado1= mysqli_query($db1, $consulta1);

$db2=conexion();
$consulta2="select*from tipomateria";
$resultado2= mysqli_query($db2, $consulta2);
$idTipoMateria="";

$db3=conexion();
$consulta3="select*from Marca";
$resultado3= mysqli_query($db3, $consulta3);
$idMarca="";


                        $Nombre = '';
                        $descripción='';
                        $Descripcion_Marca= '';
                        $descripcion_Unidad= '';
                        $Cantidad= '';
                        $Descripcion_TipoMateria='';
                        $idUnidadMedida='';
                        $idTipoMateria='';
                      

                        if  (isset($_GET['idMateria'])) {
                        $conexion=conexion();
                        $id = $_GET['idMateria'];
                        $query = "SELECT * FROM materia WHERE idMateria=$id";
                        $result = mysqli_query($conexion, $query);
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $Nombre= $row['Nombre'];
                            $descripción= $row['Descripción'];
                            $Descripcion_Marca= $row['idMarca'];
                            $descripcion_Unidad= $row['idUnidadMedida'];
                            $Cantidad= $row['Cantidad'];
                            $Descripcion_TipoMateria= $row['idTipoMateria'];
                        }
                        }

                        if (isset($_POST['update_materiaprima'])) {
                            $conexion=conexion();

                            $id = $_GET['idMateria'];
                            $Nombre= $_POST['Nombre'];
                            $descripción= $_POST['descripción'];
                            $Descripcion_Marca= $_POST['idMarca'];
                            $descripcion_Unidad= $_POST['idUnidadMedida'];
                            $cantidad= $_POST['cantidad'];
                            $Descripcion_TipoMateria= $_POST['idTipoMateria'];

                        $query = "UPDATE materia set Nombre = '$Nombre', descripción = '$descripción', idMarca ='$Descripcion_Marca'
                        
                        , idUnidadMedida = '$descripcion_Unidad', cantidad='$cantidad', idTipoMateria='$Descripcion_TipoMateria' WHERE idMateria=$id";

                        mysqli_query($conn, $query);
                        $_SESSION['message'] = 'Actualización exitosa';
                        $_SESSION['message_type'] = 'warning';
                        header('Location: stock_materiaprima.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Stock de Materia prima</h1>



                    <?php
                    include 'includes/templates/nav_stock.php'
                    ?>


                        <?php
                        

                        ?>

                        
                        <form action="edit_materiaprima.php?idMateriaprima=<?php echo $_GET['idMateria']; ?>" method="POST">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="Nombre">Nombre</label>
                            <input type="text" class="form-control" id="Nombre" value="" name="Nombre" placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="" name="descripción" placeholder="Descripción">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="descripcion_Unidad">Tipo de Unidad</label>
                                <select id='idUnidadMedida' name="idUnidadMedida" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                    <?php while ($descripcion_Unidad=mysqli_fetch_assoc($resultado1)):?>
                                    <option <?php echo $idUnidadMedida == $descripcion_Unidad['idUnidadMedida'] ? 'selected' : '';?> 
                                    value= "<?php echo $descripcion_Unidad['idUnidadMedida'];?>">
                                    <?php echo $descripcion_Unidad ['descripcion_Unidad'];?> </option>
                                <?php endwhile; ?>
                        
                            </select>
                           
                            </div>

                           

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="descripcion_Marca">Marca</label>
                            <select id='idMarca' name="idMarca" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_Marca=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idMarca == $descripcion_Marca['idMarca'] ? 'selected' : '';?> 
                                value= "<?php echo $descripcion_Marca['idMarca'];?>">
                                <?php echo $descripcion_Marca ['Descripcion_Marca'];?> </option>
                             <?php endwhile; ?>
                        
                            </select>
                           
                            </div>
                              
                            <div class="form-group col-md-4">
                            <label for="Cantidad">Cantidad</label>
                            <input type="number" min="0" class="form-control" id="Cantidad" value="" name="Cantidad" placeholder="Cantidad">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="Descripcion_TipoMateria">Tipo de Materia</label>
                            <select name="idTipoMateria" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($Descripcion_TipoMateria=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idTipoMateria == $Descripcion_TipoMateria['idTipoMateria'] ? 'selected' : '';?> 
                                value= "<?php echo $Descripcion_TipoMateria['idTipoMateria'];?>">
                                <?php echo $Descripcion_TipoMateria['Descripcion_TipoMateria'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>

                            
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_materiaprima">Actualizar</button>
                        </form>

                  

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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