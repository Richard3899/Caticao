<<<<<<< HEAD
<<<<<<< HEAD
<?php
include 'includes/config/db.php';
$db1=conexion();
$consulta1="Select*from unidadMedida";
$resultado1= mysqli_query($db1, $consulta1);

$db2=conexion();
$consulta2="select*from tipomateria";
$resultado2= mysqli_query($db2, $consulta2);

$db3=conexion();
$consulta3="select*from marca";
$resultado3= mysqli_query($db3, $consulta3);
$idMarca="";
=======
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
=======
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b

<?php
                        include 'includes/config/db.php';

                        $Nombre= '';
                        $descripción='';
                        $Cantidad= '';
                     
                        $db1=conexion();
                        $consulta1="CALL mostrar_combomarca";
                        $resultado1= mysqli_query($db1, $consulta1);
                        $idMarca = '';

                        $db2=conexion();
                        $consulta2="CALL mostrar_combounidadmedida";
                        $resultado2= mysqli_query($db2, $consulta2);
                        $idUnidadMedida = '';

                        $db3=conexion();
                        $consulta3="CALL mostrar_combotipomateria";
                        $resultado3= mysqli_query($db3, $consulta3);
                        $idTipoMateria = '';

                        if  (isset($_GET['idMateria'])) {
<<<<<<< HEAD
<<<<<<< HEAD
                        $id = $_GET['idMateria'];
                        $query = "SELECT * FROM materia WHERE idMateria=$id";
                        $result = mysqli_query($conn, $query);
=======
=======
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b

                        $conexion=conexion();
                    
                        $id=$_GET['idMateria'];

                        $sql="CALL obtener_materia($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
<<<<<<< HEAD
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
=======
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $Nombre= $row['nombre'];
                            $descripción= $row['descripcion'];
                            $idMarca= $row['idMarca'];
                            $idUnidadMedida= $row['idUnidadMedida'];
                            $Cantidad= $row['cantidad'];
                            $idTipoMateria= $row['idTipoMateria'];
                        }

    
                        }

                        if (isset($_POST['update_materiaprima'])) {
<<<<<<< HEAD
<<<<<<< HEAD
                       
                            $id = $_GET['idMateria'];
                            $Nombre= $_POST['Nombre'];
                            $descripción= $_POST['Descripción'];
                            $idMarca= $_POST['idMarca'];
                            $idUnidadMedida= $_POST['idUnidadMedida'];
                            $Cantidad= $_POST['Cantidad'];
=======
=======
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
                            $conexion=conexion();

                            $idMateria = $_GET['idMateria'];
                            $Nombre= $_POST['nombre'];
                            $descripcion= $_POST['descripcion'];
                            $cantidad= $_POST['cantidad'];
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
                            $idTipoMateria= $_POST['idTipoMateria'];
                            $idUnidadMedida= $_POST['idUnidadMedida'];
                            $idMarca= $_POST['idMarca'];
                            
	                        $sql="CALL actualizar_materia('$idMateria','$Nombre','$descripcion',
									'$cantidad',
									'$idTipoMateria',
									'$idUnidadMedida',
                                    '$idMarca')";
									
	                        mysqli_query($conexion,$sql);
                            
                            $_SESSION['message'] = 'Actualización exitosa del costo de la materia';
                            $_SESSION['message_type'] = 'warning';
                            header('Location:stock_materiaprima.php');
                        }
                    

<<<<<<< HEAD
<<<<<<< HEAD
                        $query = "UPDATE materia set Nombre = '$Nombre', Descripción = '$descripción', idMarca ='$idMarca'  , idUnidadMedida = '$idUnidadMedida', Cantidad='$Cantidad', idTipoMateria='$idTipoMateria' WHERE idMateria=$id";

                        mysqli_query($conn, $query);
                        $_SESSION['message'] = 'Actualización exitosa';
                        $_SESSION['message_type'] = 'warning';
                        header('Location: stock_materiaprima.php');

                        }
=======

>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
=======

>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
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

                        
                        <form action="edit_materiaprima.php?idMateria=<?php echo $_GET['idMateria']; ?>" method="POST">
                             <div class="form-row">


                            <div class="form-group col-md-4">
                            <label for="Nombre">Nombre</label>
                            <input type="text" step="any" class="form-control" id="Nombre" value="<?php echo $Nombre;?>" name="nombre" placeholder="Nombre" required>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripción">Descripcion</label>
<<<<<<< HEAD
<<<<<<< HEAD
                            <input type="text" step="any" class="form-control" id="descripción" value="<?php echo $descripción;?>" name="descripción" placeholder="descripción" required>
=======
                            <input type="text" step="any" class="form-control" id="Nombre" value="<?php echo $descripción;?>" name="descripcion" placeholder="descripción" required>
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
=======
                            <input type="text" step="any" class="form-control" id="Nombre" value="<?php echo $descripción;?>" name="descripcion" placeholder="descripción" required>
>>>>>>> ab121d64978fbafd9ef477d064d8ba5986bebd4b
                            </div>
                            

                            <div class="form-group col-md-4">
                            <label for="descripcion_Marca">Marca</label>
                            <select id='id_idMarca' name="idMarca" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($marca=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMarca == $marca['idMarca'] ? 'selected' : '';?> 
                                value= "<?php echo $marca['idMarca'];?>">
                                <?php echo $marca ['descripcion'];?> </option>
                             <?php endwhile; ?>
                        
                            </select>
                           
                            </div>

                        </div>

                        <div class="form-row">
                        
                            <div class="form-group col-md-4">
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


                            <div class="form-group col-md-4">
                            <label for="Descripcion_TipoMateria">Tipo de Materia</label>
                            <select name="idTipoMateria" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($tipomateria=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idTipoMateria == $tipomateria['idTipoMateria'] ? 'selected' : '';?> 
                                value= "<?php echo $tipomateria['idTipoMateria'];?>">
                                <?php echo $tipomateria['descripcion'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="Cantidad">Cantidad</label>
                            <input type="Number" min="0" step="any" class="form-control" id="Cantidad" value="<?php echo $Cantidad;?>" name="cantidad" placeholder="Cantidad" required>
                            </div>

                            
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_materiaprima">Actualizar</button>
                        </form>
                                <!-- /.HOla -->

                  

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