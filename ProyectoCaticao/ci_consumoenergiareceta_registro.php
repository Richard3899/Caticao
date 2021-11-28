
<?php

include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_comboreceta";
$resultado1= mysqli_query($db1, $consulta1);
$idReceta = '';


$db2=conexion();
$consulta2="CALL mostrar_comboconsumoenergia";
$resultado2= mysqli_query($db2, $consulta2);
$idConsumoEnergia = '';


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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Receta y Consumo de Energía</h1>

                    <?php
                    incluirTemplate('nav_costosindirectos');
                    ?>

                        
                    <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php session_unset(); } ?>


                        
                        <form  method="POST" action="ci_consumoenergiareceta_save.php" enctype="multipart/form-data">

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
                            <label for="descripcion_Mano de obra">Consumo de Energía</label>
                            <select id='id_idConsumoEnergia' name="idConsumoEnergia" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($consumoenergia=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idConsumoEnergia == $consumoenergia['idConsumoEnergia'] ? 'selected' : '';?> 
                                value= "<?php echo $consumoenergia['idConsumoEnergia'];?>">
                                <?php echo $consumoenergia ['nombre'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>


                        </div>


                        <button type="submit" class="btn btn-primary" name="save_consumoenergiareceta">Crear</button>
                        </form>

                        <br>


    
                        <div class="card mb-2">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Consumo de Energía y Receta
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Receta</th>          
                                            <th>Maquina</th>
                                            <th>Pago por Batch</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                            

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_consumoenergiareceta";
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
                                                
                                             <a class="btn btn-warning" href="ci_consumoenergiareceta_edit.php?idConsumoEnergiaReceta=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="ci_consumoenergiareceta_delete.php?idConsumoEnergiaReceta=<?php echo $row[0]?>" >
                                             <i class="bi bi-x-square"></i>
                                             </a>
                                             </td>
                                             
                                         </tr>
                                         
                                        <?php } ?>

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_recetaconsumoenergiatotal";
                                        $result=mysqli_query($conexion,$sql);

                                        while($row = mysqli_fetch_array($result)){ ?>
                                        <tr>
   
                                             <td>
                                                Total:
                                             </td>
                                             <td>
                                               
                                             </td>
                                             <td>
                                                
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