
<?php

include 'includes/config/db.php';

require 'includes/funciones.php';
incluirTemplate('head');

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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Stock de Materia prima</h1>

                    <?php
                    incluirTemplate('nav_stock');
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
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" value="" name="nombre" placeholder="Nombre">
                            </div>
                            
                            <div class="form-group col-md-6">
                            <label for="tipodeunidad">Tipo de Unidad</label>
                            <select name="tipodeunidad" class='form-control'>
                                    <option value="Seleccione">Seleccione</option>
                                    <option value="Kg"> Kg </option>
                                    <option value="Lt"> Lt </option>
                            </select>
                            </div>

                        </div>

                        

                        <div class="form-row">
                            <div class="form-group col-md-6">

                            <label for="descripcion">Marca</label>
                            <input type="text" class="form-control" id="marca" value="" name="marca" placeholder="Marca">

                            </div>
                            

                            <div class="form-group col-md-6">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" min="0" class="form-control" id="cantidad" value="" name="cantidad" placeholder="Cantidad">
                            </div>
                        
                            
                        </div>

                        <button type="submit" class="btn btn-primary" name="save_materiaprima">Crear</button>
                        </form>

                        <br>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Materia Prima
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Marca</th>
                                            <th>Tipo de Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Marca</th>
                                            <th>Tipo de Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         <?php

                                         $query = "SELECT * FROM materiaprima";
                                         $resultado_materiaprima = mysqli_query($conn,$query);


                                        while($row = mysqli_fetch_array($resultado_materiaprima)){ ?>
                                         
                                         <tr>
   
                                             <td>
                                                <?php echo $row['nombre'] ?>
                                             </td>

                                             <td>
                                                <?php echo $row['marca'] ?>
                                             </td>

                                             <td>

                                             <?php echo $row['tipodeunidad'] ?>
                                               
                                             </td>

                                             

                                             <td>
                                                <?php echo $row['cantidad'] ?>
                                             </td>
                                             

                                             <td>
                                                
                                             <a class="btn btn-warning" href="edit_materiaprima.php?idMateriaprima=<?php echo $row['idMateriaprima'] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="delete_materiaprima.php?idMateriaprima=<?php echo $row['idMateriaprima']?>" >
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
        incluirTemplate('logout_modal');
    ?>

    <?php
        incluirTemplate('scripts');
    ?>

</body>

</html>