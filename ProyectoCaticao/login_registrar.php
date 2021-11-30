<?php
include("includes/config/db.php");
$usuario =$_POST["usuario"];
$contraseña=$_POST["contraseña"];
if(isset($_POST["btningresar"]))
{
   $query=mysqli_query($conn,"select * From login where usuario='$usuario' and contraseña='$contraseña'");
   $nr =mysqli_num_rows($query);
   if($nr==1){
       print "<script> window.location.replace('index.php')</script>";
   
   }else{
    echo "<script> alert('usuario no existe'); window.location.replace('login1.php')</script>";
   }
}

if(isset($_POST["btnregistrar"]))
{
    $sqlgrabar= "insert into login(usuario,contraseña) values('$usuario','$contraseña')";
    if(mysqli_query($conn,$sqlgrabar))
    {
    echo "<script> alert('usuario registrado $usuario');  window.location.replace('login1.php')</script>";
    } else
    {
    }
}

?>


