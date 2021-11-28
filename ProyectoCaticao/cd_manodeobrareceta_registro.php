
<?php

include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_comboreceta";
$resultado1= mysqli_query($db1, $consulta1);
$idReceta = '';


$db2=conexion();
$consulta2="CALL mostrar_combomanodeobra";
$resultado2= mysqli_query($db2, $consulta2);
$idManodeObra = '';


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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Receta y Mano de obra</h1>

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


                        
                        <form  method="POST" action="cd_manodeobrareceta_save.php" enctype="multipart/form-data">

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                            <label for="Receta">Receta</label>
                            <select id='id_idReceta' name="idReceta" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($receta=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idReceta == $receta['idReceta'] ? 'selected' : '';?> 
                                value="<?php echo $receta['idReceta'];?>">
                                <?php echo $receta['descripcion'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>


                            <div class="form-group col-md-6">
                            <label for="descripcion_Mano de obra">Mano de Obra</label>
                            <select id='id_idManodeObra' name="idManodeObra" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($manodeobra=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idManodeObra == $manodeobra['idManodeObra'] ? 'selected' : '';?> 
                                value= "<?php echo $manodeobra['idManodeObra'];?>">
                                <?php echo $manodeobra ['descripcion'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>


                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="precio">Cantidad</label>
                            <input type="number" step="any" class="form-control" value="" name="cantidad" placeholder="Cantidad" required>
                            </div>

                        </div>

            

                        <button type="submit" class="btn btn-primary" name="save_manodeobrareceta">Crear</button>
                        </form>

                        <br>


    
                        <div class="card mb-2">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Mano de obra y Receta
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Receta</th>          
                                            <th>Mano de obra</th>
                                            <th>Precio Unitario</th>
                                            <th>Cantidad</th>
                                            <th>Costo</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                            

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_manodeobrareceta";
                                        $result=mysqli_query($conexion,$sql);

                                        while($row = mysqli_fetch_array($result)){ ?>
                                         
                                         <tr>
                                             <td>
                                                <?php echo $row[0] ?>
                                             </td>
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
                                                
                                             <a class="btn btn-warning" href="cd_manodeobrareceta_edit.php?idManodeObraReceta=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="cd_manodeobrareceta_delete.php?idManodeObraReceta=<?php echo $row[0]?>" >
                                             <i class="bi bi-x-square"></i>
                                             </a>
                                             </td>
                                             
                                         </tr>
                                         
                                        <?php } ?>

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_recetamanodeobratotal";
                                        $result=mysqli_query($conexion,$sql);

                                        while($row = mysqli_fetch_array($result)){ ?>
                                        <tr>
   
                                             <td>
                                                Total:
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