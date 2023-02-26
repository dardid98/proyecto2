<?php


include "./includes/loginDatos.php";
include "./includes/crearTablas.php";




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div>
        <h1>BIENVENIDO </h1>
    <div>
        <h1>Inicia sesion</h1>
        <form method="" id="formul" action="login.html">
            <input type="submit" value="Inicia Sesión" name="login" id="login">
        </form>

    </div>
    <div>
        <h1>Consulta el precio de nuestras tarifas</h1>
        <form method="" id="formul" action="tarifas.html">
            <input type="submit" value="Tarifas" name="tarifas" id="tarifas">
        </form>

    </div>
    <div>
        <h1>Regístrate</h1>
        <form method="" id="formul" action="registro.html">
            <input type="submit" value="Registrarse" name="registro" id="registro">
        </form>

    </div>
    </div>
</body>
</html>
