
<?php
include 'includes/config/db.php';
require 'includes/funciones.php';
incluirTemplate('head');


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
                    <h1 class="h3 mb-4 text-gray-800 text-center">Costo Total por receta</h1>

                        
                        
                        <br>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Costo Total por receta
                            </div>
                            <div class="card-body">
                                <table id="tabla" class="table table-hover  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Receta</th>
                                            <th>Costo de Produción</th>
                                            <th>Unidad de Medida</th>
                                            <th>Tipo Costo</th>
                                            <th>Proceso</th>
                                            <th>Precio Unitario</th>
                                            <th>Requerimiento</th>
                                            <th>Costo</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                         <?php

                                        $conexion=conexion();

                                        $sql="CALL mostrar_recetamateriatotal";
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
                                             <?php echo $row[6] ?>
           
                                             </td>

                                             <td>

                                             <?php echo $row[7] ?>
                                        
                                             </td>
                                             <td>

                                             <?php echo $row[8] ?>

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