
<?php
                        include 'includes/config/db.php';

                        $Nombre= '';
                        $Descripcion='';

                        if  (isset($_GET['idMaquina'])) {

                        $conexion=conexion();
                    
                        $id=$_GET['idMaquina'];

                        $sql="CALL obtener_maquina($id)";
                    
                        $result=mysqli_query($conexion,$sql);
                    
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $Nombre= $row['nombre'];
                            $Descripcion= $row['descripcion'];
                        }

    
                        }

                        if (isset($_POST['update_maquina'])) {
                            $conexion=conexion();

                            $idMaquina = $_GET['idMaquina'];
                            $Nombre= $_POST['nombre'];
                            $Descripcion= $_POST['descripcion'];
                            
	                        $sql="CALL actualizar_maquina('$idMaquina','$Nombre','$Descripcion')";
									
	                        mysqli_query($conexion,$sql);
                            
                            $_SESSION['message'] = 'Actualización exitosa de la maquina';
                            $_SESSION['message_type'] = 'warning';
                            header('Location:maquina_registro.php');
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Actualizar Maquina</h1>



                    <?php
                    include 'includes/templates/nav_stock.php'
                    ?>


                        <?php
                        

                        ?>

                        
                        <form action="maquina_edit.php?idMaquina=<?php echo $_GET['idMaquina']; ?>" method="POST">
                             <div class="form-row">


                            <div class="form-group col-md-4">
                            <label for="Nombre">Nombre</label>
                            <input type="text" step="any" class="form-control" id="Nombre" value="<?php echo $Nombre;?>" name="nombre" placeholder="Nombre" required>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripción">Descripción</label>
                            <input type="text" step="any" class="form-control" id="Descripcion" value="<?php echo $Descripcion;?>" name="descripcion" placeholder="descripción" required>
                            </div>
                            

                        </div>

                        <button type="submit" class="btn btn-primary" name="update_maquina">Actualizar</button>
                        </form>
                                <!-- /.HOla -->

                  

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