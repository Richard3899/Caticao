
<?php

include 'includes/config/db.php';


include 'includes/templates/head.php'

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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Stock de Insumo</h1>

                    <?php
                    include 'includes/templates/nav_stock.php';
                   
                    ?>

                        
                    <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php session_unset(); } ?>


                        
                        <form  method="POST" action="save_insumo.php" enctype="multipart/form-data">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" value="" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="" name="descripción" placeholder="Descripción">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="tipodeunidad">Tipo de Unidad</label>
                            <select name="tipodeunidad" class='form-control'>
                                    <option value="Seleccione">Seleccione</option>
                                    <option value="Kg"> Kg </option>
                                    <option value="Lt"> Lt </option>
                            </select>
                            </div>

                        </div>

                        

                        <div class="form-row">
                            <div class="form-group col-md-4">

                            <label for="descripcion">Marca</label>
                            <input type="text" class="form-control" id="marca" value="" name="marca" placeholder="Marca">

                            </div>
                            

                            <div class="form-group col-md-4">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" min="0" class="form-control" id="cantidad" value="" name="cantidad" placeholder="Cantidad">
                            </div>
                            
                            <div class="form-group col-md-4">
                            <label for="Descripcion_TipoMateria">Tipo de Materia</label>
                            <select name="Descripcion_TipoMateria" class='form-control'>
                                    <option value="Seleccione">Seleccione</option>
                                    <option value="insumos"> Insumos </option>
                                    <option value="materiaprima"> Materia Prima </option>
                            </select>
                            </div>

                        
                            
                        </div>

                        <button type="submit" class="btn btn-primary" name="save_insumo">Crear</button>
                        </form>

                        <br>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Insumos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Marca</th>
                                            <th>Tipo de Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Tipo Materia</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Marca</th>
                                            <th>Tipo de Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Tipo Materia</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         <?php

                                         $query = " select m.idMateria, m.Nombre, m.descripción,m.cantidad,ma.Descripcion_Marca ,u.descripcion_Unidad, ti.Descripcion_TipoMateria 
                                         from materia as m inner join marca as ma on m.idMarca=ma.idMarca
                                         iNNER join unidadmedida as u on m.idUnidadMedida=u.idUnidadMedida
                                         inner join tipomateria as ti on m.idTipoMateria=ti.idTipoMateria";
                                         $resultado_insumo = mysqli_query($conn,$query);


                                        while($row = mysqli_fetch_array($resultado_insumo)){ ?>
                                         
                                         <tr>
   
                                         <td>
                                                <?php echo $row['Nombre'] ?>
                                             </td>
                                             <td>
                                                <?php echo $row['descripción'] ?>
                                             </td>

                                             <td>
                                                <?php echo $row['Descripcion_Marca'] ?>
                                             </td>

                                             <td>
                                                <?php echo $row['descripcion_Unidad'] ?>
                                             </td>

                                             <td>
                                                <?php echo $row['cantidad'] ?>
                                             </td>
                                             <td>
                                                <?php echo $row['Descripcion_TipoMateria'] ?>
                                             </td>
                                             

                                             <td>

                                             <a class="btn btn-warning" href="edit_insumo.php?idInsumo=<?php echo $row['idMateria'] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="delete_insumo.php?idInsumo=<?php echo $row['idMateria']?>" >
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

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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