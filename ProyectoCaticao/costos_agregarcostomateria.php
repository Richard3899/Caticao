
<?php
include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


$db1=conexion();
$consulta1="CALL mostrar_combomateria";
$resultado1= mysqli_query($db1, $consulta1);
$idMateria = '';

$db2=conexion();
$consulta2="CALL mostrar_combocostos";
$resultado2= mysqli_query($db2, $consulta2);
$idCostos = '';

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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Agregar Costo de Materia</h1>


                        <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php session_unset(); } ?>

                        
                        <form  method="POST" action="costos_agregarmateriasave.php" enctype="multipart/form-data" id="id_form">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="materia">Matería</label>
                            <select id='id_idMateria' name="idMateria" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($materia=mysqli_fetch_assoc($resultado1)):?>
                                <option <?php echo $idMateria == $materia['idMateria'] ? 'selected' : '';?> 
                                value="<?php echo $materia['idMateria'];?>">
                                <?php echo $materia['nombre'];?> </option>
                              <?php endwhile; ?>
                        
                            </select>

                            </div>

                            
                            <div class="form-group col-md-6">
                            <label for="costos">Costos</label>
                            <select id='id_idCostos' name="idCostos" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($costos=mysqli_fetch_assoc($resultado2)):?>
                                <option <?php echo $idCostos == $costos['idCostos'] ? 'selected' : '';?> 
                                value="<?php echo $costos['idCostos'];?>">
                                <?php echo $costos['Descripcion'];?> </option>
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
                            <label for="precio">Precio</label>
                            <input type="number" step="any" class="form-control" id="id_precio" value="" name="precioUnitario" placeholder="Precio" required>
                            </div>
                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="save_agregarcostomateria">Crear</button>
                        </form>

                        <br>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Productos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Materia</th>
                                            <th>Costos</th>
                                            <th>Tipo de Costo</th>
                                            <th>Precio</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Materia</th>
                                            <th>Costos</th>
                                            <th>Tipo de Costo</th>
                                            <th>Precio</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_materiacostos";
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
                                                
                                             <a class="btn btn-warning" href="costos_agregarmateriaedit.php?idMateriaCostos=<?php echo $row[0] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="costos_agregarmateriadelete.php?idMateriaCostos=<?php echo $row[0]?>" >
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