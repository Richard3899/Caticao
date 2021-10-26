
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Agregar receta</h1>

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
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="iddescripcion" value="" name="descripcion" placeholder="Descripción">
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
                                <table id="datatablesSimple" class="table table-hover  table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>idReceta</th>
                                            <th>Insumo</th>
                                            <th>Unidad de Medida</th>
                                            <th>Cantidad en Stock</th>
                                            <th>Peso Neto</th>
                                            <th>Precio Unitario</th>
                                            <th>Costo</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>idReceta</th>
                                            <th>Insumo</th>
                                            <th>Unidad de Medida</th>
                                            <th>Cantidad en Stock</th>
                                            <th>Peso Neto</th>
                                            <th>Precio Unitario</th>
                                            <th>Costo</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                            

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_recetainsumos";
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
                                                <?php echo $row[4] ?>
                                             </td>
                                             <td>
                                                <?php echo $row[5] ?>
                                             </td>
                                             <td>
                                                <?php echo $row[6] ?>
                                             </td>
                                             <td>
                                                <?php echo $row[7] ?>
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

                                        <tr>
   
                                             <td>
                                                
                                             </td>
                                             <td>
                                                
                                             </td>
                                             <td>
                                                
                                             </td>
                                             <td>
                                               
                                             </td>
                                             <td>
                                               
                                             </td>
                                             <td>
                                              
                                             </td>
                                             <td>
                                             <input type="text" class="form-control" value=" Total - 29.50" disabled>
                                             </td>
                                             
                                             <td>
                                                
                                                
                                             </td>

                                             <td>
                                             

                                             </td>
                                             
                                         </tr>

                    
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