
<?php

include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_combomarca";
$resultado1= mysqli_query($db1, $consulta1);
$idMarca = '';

$db2=conexion();
$consulta2="CALL mostrar_combounidadmedida";
$resultado2= mysqli_query($db2, $consulta2);
$idUnidadMedida = '';

$db3=conexion();
$consulta3="CALL mostrar_combotipomateria";
$resultado3= mysqli_query($db3, $consulta3);
$idTipoMateria = '';

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


                        
                        <form  method="POST" action="save_materiaprima.php" enctype="multipart/form-data">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="Nombre">Nombre</label>
                            <input type="text" class="form-control" id="Nombre" value="" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-6">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="" name="descripcion" placeholder="Descripción">
                            </div>


                        </div>

            

                        <button type="submit" class="btn btn-primary" name="save_materiaprima">Crear</button>
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
                                            <th>Producto</th>
                                            <th>Descripción de receta</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Descripción de receta</th>
                                            <th>Editar</th>
                                            <th>Eliminar 1 </th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                            

                                        <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_materia";
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
                                                
                                             <a class="btn btn-warning" href="edit_materiaprima.php?idMateria=<?php echo $row['idMateria'] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="delete_materiaprima.php?idMateria=<?php echo $row['idMateria']?>" >
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