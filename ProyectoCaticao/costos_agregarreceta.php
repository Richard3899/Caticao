
<?php

include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_comboproducto";
$resultado1= mysqli_query($db1, $consulta1);
$idProducto = '';


?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

            <?php
            incluirTemplate('sidebar');
            ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Topbar -->
                <?php
                incluirTemplate('nav');
                ?>
            

                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 text-center">Receta</h1>

                    <?php
                    incluirTemplate('nav_calcularcostos');
                    ?>

                        
                    <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php session_unset(); } ?>


                        
                        <form  method="POST" action="costos_agregarreceta_save.php" enctype="multipart/form-data">

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                            <label for="producto">Producto</label>
                            <select id='id_idProducto' name="idProducto" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($producto=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idProducto == $producto['idProducto'] ? 'selected' : '';?> 
                                value="<?php echo $producto['idProducto'];?>">
                                <?php echo $producto['nombre'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>


                            <div class="form-group col-md-6">
                            <label for="descripci??n"> Descripci??n de la receta </label>
                            <input type="text" class="form-control" id="iddescripcion" value="" name="descripcion" placeholder="Descripci??n">
                            </div>


                        </div>

            

                        <button type="submit" class="btn btn-primary" name="save_agregarreceta">Crear</button>
                        </form>

                        <br>


    
                        <div class="card mb-2">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Recetas
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Descripci??n de Producto</th>
                                            <th>Descripci??n de receta</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                            

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_agregarreceta";
                                        $result=mysqli_query($conexion,$sql);

                                        while($row = mysqli_fetch_array($result)){ ?>
                                         
                                         <tr>
   
                                             <td>
                                                <?php echo $row[1] ?>
                                             </td>
                                             <td>
                                                <?php echo $row[2] ?>
                                             </td>
                                             <td>
                                                <?php echo $row[3] ?>
                                             </td>
                                             
                                             <td>
                                                
                                             <a class="btn btn-warning" href="costos_agregarreceta_edit.php?idReceta=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="costos_agregarreceta_delete.php?idReceta=<?php echo $row[0]?>" >
                                             <i class="bi bi-x-square"></i>
                                             </a>
                                             </td>
                                             
                                         </tr>
                                         
                                        <?php } ?>


                    
                                    </tbody>
                                </table>
                            </div>
                        </div>


                </div>
                <!-- /.container-fluid  nuevoooo -->

            </div>
            <!-- End of Main Content -->

            <?php
                    incluirTemplate('footer');
            ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <?php
        incluirTemplate('logout_modal');
    ?>

    <?php
        incluirTemplate('scripts');
    ?>

</body>

</html>