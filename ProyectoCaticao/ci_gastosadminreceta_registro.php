
<?php
include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');

$db1=conexion();
$consulta1="CALL mostrar_comboreceta";
$resultado1= mysqli_query($db1, $consulta1);
$idReceta = '';


$db3=conexion();
$consulta3="CALL mostrar_combogastosadmin";
$resultado3= mysqli_query($db3, $consulta3);
$idGastosAdmin = '';

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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Registrar Gastos Administrativos y Otros</h1>

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

                        
                        <form  method="POST" action="ci_gastosadminreceta_save.php" enctype="multipart/form-data" id="id_form">

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                            <label for="Receta">Receta</label>
                            <select id='id_idReceta' name="idReceta" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($receta=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idReceta == $receta['idReceta'] ? 'selected' : '';?> 
                                value="<?php echo $receta['idReceta'];?>">
                                <?php echo $receta['descripcion'];?> </option>
                              <?php endwhile;?>
                            </select>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="Gastos">Gastos Administrativos</label>
                            <select id='id_idGastosAdmin' name="idGastosAdmin" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($gastosadmin=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idGastosAdmin == $gastosadmin['idGastosAdmin'] ? 'selected' : '';?> 
                                value="<?php echo $gastosadmin['idGastosAdmin'];?>">
                                <?php echo $gastosadmin['descripcion'];?> </option>
                              <?php endwhile;?>
                            </select>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="precio">Cantidad</label>
                            <input type="number" step="any" class="form-control" value="" name="cantidad" placeholder="Cantidad" required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary" name="save_gastosadminreceta">Crear</button>
                        <a class="btn btn-success float-right" href="ci_gastosadminproceso_registro.php" role="button">Agregar Gastos en su proceso</a>
                        </form>
                        
                        <br>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Gastos Administrativos y Receta
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Receta</th>
                                            <th>Gasto Administrativo</th>
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

                                        $sql="CALL mostrar_gastosadminreceta";
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
                                                
                                             <a class="btn btn-warning" href="ci_gastosadminreceta_edit.php?idGastosAdminReceta=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="ci_gastosadminreceta_delete.php?idGastosAdminReceta=<?php echo $row[0]?>" >
                                             <i class="bi bi-x-square"></i>
                                             </a>
                                             </td>
                                             
                                         </tr>
                                         
                                        <?php } ?>


                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_recetagastosadmintotal";
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