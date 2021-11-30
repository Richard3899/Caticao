<html>
    <head>
    <meta charset="utf-8">
    <title>login</title>
    <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <form action="login_registrar.php" method="POST">
            <h2>iniciar sesion</h2>
            <input type="text" placeholder="usuario" name="usuario" required>
            <input type="password" placeholder="contraseña" name="contraseña" required>
            <input type="submit" value="ingresar" name="btningresar">


            <br>
            <a href="registrar.php" style="float:right" > crear una cuenta</a>

        </form>
    </body>

</html>