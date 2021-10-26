
<?php

include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_combomateriarecetainsumos";
$resultado1= mysqli_query($db1, $consulta1);
$idMateria = '';

$db2=conexion();
$consulta2="CALL mostrar_comboreceta";
$resultado2= mysqli_query($db2, $consulta2);
$idReceta = '';

$db3=conexion();
$consulta3="CALL mostrar_combounidadmedida";
$resultado3= mysqli_query($db3, $consulta3);
$idUnidadMedida = '';


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


                        
                        <form  method="POST" action="costos_agregarrecetainsumos_save.php" enctype="multipart/form-data">

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                            <label for="Receta">Receta</label>
                            <select id='id_idReceta' name="idReceta" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($receta=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idReceta == $receta['idReceta'] ? 'selected' : '';?> 
                                value="<?php echo $receta['idReceta'];?>">
                                <?php echo $receta['descripcion'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>


                            <div class="form-group col-md-6">
                            <label for="materia">Insumo</label>
                            <select id='id_idMateria' name="idMateria" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($materia=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMateria == $materia['idMateria'] ? 'selected' : '';?> 
                                value="<?php echo $materia['idMateria'];?>">
                                <?php echo $materia['nombre'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>


                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="descripcion_Unidad">Unidad de Medida</label>
                            <select id='id_idUnidadMedida' name="idUnidadMedida" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($unidad=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idUnidadMedida == $unidad['idUnidadMedida'] ? 'selected' : '';?> 
                                value= "<?php echo $unidad['idUnidadMedida'];?>">
                                <?php echo $unidad ['descripcion'];?> </option>
                             <?php endwhile; ?>
                        
                            </select>
                           
                            </div>

                            <div class="form-group col-md-6">
                            <label for="precio">Cantidad</label>
                            <input type="number" step="any" class="form-control" value="" name="cantidad" placeholder="Cantidad" required>
                            </div>

                        </div>

            

                        <button type="submit" class="btn btn-primary" name="save_agregarrecetainsumos">Crear</button>
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
                                                
                                             <a class="btn btn-warning" href="costos_agregarrecetainsumos_edit.php?idRecetaMateria=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="costos_agregarrecetainsumos_delete.php?idRecetaMateria=<?php echo $row[0]?>" >
                                             <i class="bi bi-x-square"></i>
                                             </a>
                                             </td>
                                             
                                         </tr>
                                         
                                         
                                        <?php } ?>



                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_recetainsumostotal";
                                        $result=mysqli_query($conexion,$sql);

                                        while($row = mysqli_fetch_array($result)){ ?>
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

                                             <?php echo $row[0] ?>

                                             </td>
                                             
                                             <td>
                                                
                                                
                                             </td>

                                             <td>
                                             

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