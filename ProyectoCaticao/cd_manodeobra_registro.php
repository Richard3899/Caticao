
<?php
include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');

$db2=conexion();
$consulta2="CALL mostrar_combounidadmedida";
$resultado2= mysqli_query($db2, $consulta2);
$idUnidadMedida = '';

$db3=conexion();
$consulta3="CALL mostrar_combotipocostos";
$resultado3= mysqli_query($db3, $consulta3);
$idTipoCostos = '';

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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Registrar Mano de Obra</h1>

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

                        
                        <form  method="POST" action="cd_manodeobra_save.php" enctype="multipart/form-data" id="id_form">

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="" name="descripcion" placeholder="Descripción">
                            </div>
                            
                            <div class="form-group col-md-6">
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

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                            <label for="categoria">Tipo de Costo</label>
                            <select id='id_idCategoria' name="idTipoCostos" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($tipocostos=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idTipoCostos == $tipocostos['idTipoCostos'] ? 'selected' : '';?> 
                                value="<?php echo $tipocostos['idTipoCostos'];?>">
                                <?php echo $tipocostos['Descripcion'];?> </option>
                              <?php endwhile; ?>
                            </select>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="precio">Precio Unitario</label>
                            <input type="number" step="any" class="form-control" id="id_precio" value="" name="precioUnitario" placeholder="Precio" required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary" name="save_manodeobra">Crear</button>
                        <a class="btn btn-success float-right" href="cd_manodeobraproceso_registro.php" role="button">Agregar Mano de obra en su proceso</a>
                        </form>
                        
                        <br>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Mano de Obra
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Descripción</th>
                                            <th>Unidad de medida</th>
                                            <th>Tipo de Costo</th>
                                            <th>Precio</th>   
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_manodeobra";
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
                                                
                                             <a class="btn btn-warning" href="cd_manodeobra_edit.php?idManodeObra=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="cd_manodeobra_delete.php?idManodeObra=<?php echo $row[0]?>" >
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