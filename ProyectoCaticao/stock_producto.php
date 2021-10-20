
<?php

include 'includes/config/db.php';

require 'includes/funciones.php';
include 'includes/templates/head.php';
incluirTemplate('head');

$db1=conexion();
$consulta1="Select*from TipoProducto";
$resultado1= mysqli_query($db1, $consulta1);


$nombre = '';
$descripcion = '';
$cantidad='';
$Precio='';
$idTipoProducto='';
$idLote='';
$NroLote='';


$db2=conexion();
$consulta2="select*from Lote";
$resultado2= mysqli_query($db2, $consulta2);
$idLote="";
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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Stock de Productos</h1>

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


                        
                        <form  method="POST" action="save_producto.php" enctype="multipart/form-data">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" value="" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" value="" name="descripcion" placeholder="Descripción">
                            </div>
                            <div class="form-group col-md-4">
                            <label for="cantidad">Catidad</label>
                            <input type="text" class="form-control" id="cantidad" value="" name="cantidad" placeholder="Cantidad">
                            </div>
                         </div>
                            

                       
                        <div class="form-row">
    
                            <div class="form-group col-md-4">
                                <label for="precio">Precio</label>
                                <input type="number" class="form-control" id="precio" value="" name="precio" placeholder="Precio">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tipoProducto">Tipo Producto</label>
                                <select id='id_idtipoProducto' name="idTipoProducto" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_TipoProducto=mysqli_fetch_assoc($resultado1)):?>
                                    <option <?php echo $idTipoProducto == $descripcion_TipoProducto['idTipoProducto'] ? 'selected' : '';?> 
                                    value= "<?php echo $descripcion_TipoProducto['idTipoProducto'];?>">
                                    <?php echo $descripcion_TipoProducto ['descripcion'];?> </option>
                                <?php endwhile; ?>
                                    
                                </select>
                            
                            </div>
                                <div class="form-group col-md-4">
                                <label for="Lote">Nro Lote</label>
                                <select id='id_idtLote' name="idLote" class='form-control' required>
                                <option selected disabled value="">Seleccione</option>
                                <?php while ($descripcion_Lote=mysqli_fetch_assoc($resultado2)):?>
                                    <option <?php echo $idLote == $descripcion_Lote['idLote'] ? 'selected' : '';?> 
                                    value= "<?php echo $descripcion_Lote['idLote'];?>">
                                    <?php echo $descripcion_Lote ['NroLote'];?> </option>
                                <?php endwhile; ?>
                                    
                                </select>
                            </div>
                        </div>
                           
                       

                         <button type="submit" class="btn btn-primary" name="save_producto">Crear</button>
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
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Descripción</th>
                                            <th>Nro Lote</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Descripción</th>
                                            <th>Nro Lote</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         <?php

                                         $query = "select p.idProducto, p.nombre, p.descripcion,p.cantidad,p.precio,ti.descripcionP, l.NroLote
                                         from producto as p inner join tipoProducto as ti on p.idTipoProducto=ti.idTipoProducto
                                         inner join lote as l on p.idLote=l.idlote";
                                         $resultado_producto = mysqli_query($conn,$query);


                                        while($row = mysqli_fetch_array($resultado_producto)){ ?>
                                         
                                         <tr>
   
                                             <td>
                                                <?php echo $row['nombre'] ?>
                                             </td>

                                             <td>
                                                <?php echo $row['descripcion'] ?>
                                             </td>

                                             <td>
                                             <?php echo $row['cantidad'] ?>
                                             </td>
                                             <td>
                                                <?php echo $row['precio'] ?>
                                             </td>
                                             <td>
                                                <?php echo $row['descripcionP'] ?>
                                             </td>

                                             <td>
                                                <?php echo $row['NroLote'] ?>
                                             </td>
                                             <td> 
                                             <a class="btn btn-warning" href="edit_producto.php?idProducto=<?php echo $row['idProducto'] ?>" >
                                             <i class="bi bi-pencil-square"></i>
                                             </a>
                                                
                                             </td>

                                             <td>
                                             <a class="btn btn-danger" href="delete_producto.php?idProducto=<?php echo $row['idProducto']?>" >
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