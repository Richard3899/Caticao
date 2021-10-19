    <?php

    session_start();

    //Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root','','caticao');
    
    function conexion(){
		return mysqli_connect('localhost','root','','caticao');
	  }

    ?>
