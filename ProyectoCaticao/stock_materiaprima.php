
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
                            <div class="form-group col-md-4">
                            <label for="Nombre">Nombre</label>
                            <input type="text" class="form-control" id="Nombre" value="" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="" name="descripcion" placeholder="Descripción">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripcion_Marca">Marca</label>
                            <select id='id_idMarca' name="idMarca" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($marca=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMarca == $marca['idMarca'] ? 'selected' : '';?> 
                                value= "<?php echo $marca['idMarca'];?>">
                                <?php echo $marca ['descripcion'];?> </option>
                             <?php endwhile; ?>
                        
                            </select>
                           
                            </div>
                            


                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-4">
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
    
                            <div class="form-group col-md-4">
                            <label for="Descripcion_TipoMateria">Tipo de Materia</label>
                            <select name="id_idTipoMateria" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($tipomateria=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idTipoMateria == $tipomateria['idTipoMateria'] ? 'selected' : '';?> 
                                value= "<?php echo $tipomateria['idTipoMateria'];?>">
                                <?php echo $tipomateria['descripcion'];?> </option>
                             <?php endwhile; ?>
                            </select>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" min="0" class="form-control" id="cantidad" value="" name="cantidad" placeholder="Cantidad">
                            </div>

                            
                        </div>

                        <button type="submit" class="btn btn-primary" name="save_materiaprima">Crear</button>
                        </form>

                        <br>


    
                        <div class="card mb-2">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Materia Prima
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Marca</th>
                                            <th>Unidad de Medida</th>                                           
                                            <th>Tipo Materia</th>
                                            <th>Cantidad</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    
                        
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
                                    <tfoot>
                                        <td>
                                            <input type="text" class="form-control filter-input" placeholder="Buscar" data-column="0"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control filter-input" placeholder="Buscar" data-column="1"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control filter-input" placeholder="Buscar" data-column="2"/>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tfoot>

                                    
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