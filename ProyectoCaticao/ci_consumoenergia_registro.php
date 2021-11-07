
<?php
include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_combomaquina";
$resultado1= mysqli_query($db1, $consulta1);
$idMaquina = '';


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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Registrar consumo de energía</h1>

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

                        
                        <form  method="POST" action="ci_consumoenergia_save.php" enctype="multipart/form-data" id="id_form">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="maquina">Maquina</label>
                            <select id='id_idMaquina' name="idMaquina" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($maquina=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMaquina == $maquina['idMaquina'] ? 'selected' : '';?> 
                                value="<?php echo $maquina['idMaquina'];?>">
                                <?php echo $maquina['nombre'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>
                            <div class="form-group col-md-6">
                            <label for="tarifa">Tarifa Electrocentro</label>
                            <input type="number" step="any" class="form-control" id="id_tarifa" value="" name="tarifa" placeholder="Tarifa" required>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary" name="save_consumoenergia">Crear</button>
                        </form>

                        <br>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de consumo de energía
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Maquina</th>
                                            <th>Potencia HP</th>
                                            <th>Potencia Watts</th>
                                            <th>Potencia en Kw</th>
                                            <th>HT por Batch</th>
                                            <th>Consumo Kwh</th>
                                            <th>Tarifa Kwh</th>
                                            <th>Pago por Batch</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_consumoenergia";
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
                                            <?php echo $row[6] ?>
                                             </td>
                                             <td>
                                            <?php echo $row[7] ?>
                                             </td>
                                             <td>
                                            <?php echo $row[8] ?>
                                             </td>

                                             <td>
                                                
                                             <a class="btn btn-warning" href="ci_consumoenergia_edit.php?idConsumoEnergia=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="ci_consumoenergia_delete.php?idConsumoEnergia=<?php echo $row[0]?>" >
                                             <i class="bi bi-x-square"></i>
                                             </a>
                                             </td>
                                             
                                         </tr>
                                         
                                        <?php } ?>

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_consumoenergiatotal";
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
                <!-- /.container-fluid -->

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
    include 'includes/templates/logout_modal.php'
    ?>

    <?php
    include 'includes/templates/scripts.php'
    ?>

</body>

</html>