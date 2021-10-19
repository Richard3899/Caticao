
<?php

include 'includes/config/db.php';

require 'includes/funciones.php';
incluirTemplate('head');
$db1=conexion();

$consulta1="Select*from unidadMedida";
$resultado1= mysqli_query($db1, $consulta1);


$Nombre = '';
$Descripcion = '';
$Descripcion_Marca='';
$cantidad='';
$Descripcion_TipoMateria='';
$iddescripcion_Unidad = '';
$idUnidadMedida='';

$db2=conexion();
$consulta2="select*from tipomateria";
$resultado2= mysqli_query($db2, $consulta2);
$idTipoMateria="";

$db3=conexion();
$consulta3="select*from Marca";
$resultado3= mysqli_query($db3, $consulta3);
$idMarca="";
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
                            <input type="text" class="form-control" id="Nombre" value="" name="Nombre" placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripción"> Descripción </label>
                            <input type="text" class="form-control" id="descripción" value="" name="descripción" placeholder="Descripción">
                            </div>
                            
                            <div class="form-group col-md-4">
                            <label for="descripcion_Unidad">Tipo de Unidad</label>
                            <select id='id_idUnidadMedida' name="idUnidadMedida" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_Unidad=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idUnidadMedida == $descripcion_Unidad['idUnidadMedida'] ? 'selected' : '';?> 
                                value= "<?php echo $descripcion_Unidad['idUnidadMedida'];?>">
                                <?php echo $descripcion_Unidad ['descripcion_Unidad'];?> </option>
                             <?php endwhile; ?>
                        
                            </select>
                           
                            </div>

                           

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="descripcion_Marca">Marca</label>
                            <select id='id_idMarca' name="idMarca" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_Marca=mysqli_fetch_assoc($resultado3)):?>
                                <option <?php echo $idMarca == $descripcion_Marca['idMarca'] ? 'selected' : '';?> 
                                value= "<?php echo $descripcion_Marca['idMarca'];?>">
                                <?php echo $descripcion_Marca ['Descripcion_Marca'];?> </option>
                             <?php endwhile; ?>
                        
                            </select>
                           
                            </div>
                              
                            <div class="form-group col-md-4">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" min="0" class="form-control" id="cantidad" value="" name="cantidad" placeholder="Cantidad">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="Descripcion_TipoMateria">Tipo de Materia</label>
                            <select name="id_idTipoMateria" class='form-control' required>
                            <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_TipoMateria=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idTipoMateria == $descripcion_TipoMateria['idTipoMateria'] ? 'selected' : '';?> 
                                value= "<?php echo $descripcion_TipoMateria['idTipoMateria'];?>">
                                <?php echo $descripcion_TipoMateria['Descripcion_TipoMateria'];?> </option>
                             <?php endwhile; ?>
                            </select>
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
                                <table id="datatablesSimple" class="table table-hover  table-bordered" style="width:100%">
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

                                         $query = "select m.idMateria, m.Nombre, m.descripción,m.cantidad,ma.Descripcion_Marca ,u.descripcion_Unidad, ti.Descripcion_TipoMateria 
                                         from materia as m inner join marca as ma on m.idMarca=ma.idMarca
                                         iNNER join unidadmedida as u on m.idUnidadMedida=u.idUnidadMedida
                                         inner join tipomateria as ti on m.idTipoMateria=ti.idTipoMateria";
                                         $resultado_materiaprima = mysqli_query($conn,$query);


                                        while($row = mysqli_fetch_array($resultado_materiaprima)){ ?>
                                         
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