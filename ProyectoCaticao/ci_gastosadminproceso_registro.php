
<?php
include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_combogastosadmin";
$resultado1= mysqli_query($db1, $consulta1);
$idGastosAdmin = '';

$db3=conexion();
$consulta3="CALL mostrar_proceso";
$resultado3= mysqli_query($db3, $consulta3);
$idProceso = '';

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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Gastos y Proceso</h1>

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

                        
                        <form  method="POST" action="ci_gastosadminproceso_save.php" enctype="multipart/form-data" id="id_form">

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="gastos">Gastos Administrativos</label>
                            <select id='id_idGastosAdmin' name="idGastosAdmin" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($gastosadmin=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idGastosAdmin == $gastosadmin['idGastosAdmin'] ? 'selected' : '';?> 
                                value="<?php echo $gastosadmin['idGastosAdmin'];?>">
                                <?php echo $gastosadmin['descripcion'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="proceso">Proceso</label>
                            <select id='id_idProceso' name="idProceso" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($proceso=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idProceso == $proceso['idProceso'] ? 'selected' : '';?> 
                                value="<?php echo $proceso['idProceso'];?>">
                                <?php echo $proceso['descripcion'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="" name="descripcion" placeholder="Descripción" required>
                            </div>
                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="save_gastosadminproceso">Crear</button>
                        </form>

                        <br>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Gastos Administrativos y Proceso
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Gastos</th>
                                            <th>Proceso</th>
                                            <th>Descripcion</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_gastosadminproceso";
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
                                                
                                             <a class="btn btn-warning" href="ci_gastosadminproceso_edit.php?idGastosAdminProceso=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="ci_gastosadminproceso_delete.php?idGastosAdminProceso=<?php echo $row[0]?>" >
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