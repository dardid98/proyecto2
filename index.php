<?php


include "./includes/loginDatos.php";

if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymdALTER' AND table_name = 'TARIFAS'")){
    $con->query("CREATE TABLE TARIFAS (ID_TARIFA INT AUTO_INCREMENT PRIMARY KEY NOT NULL, PRECIO INT NOT NULL, PLAN_DE_PAGO VARCHAR(10))");
}
if($consTarifas=$con->query("SELECT * FROM TARIFAS")){
    if(mysqli_num_rows($consTarifas)==0){
    $con->query("INSERT INTO TARIFAS VALUES (DEFAULT,0,'gratis')");
    $con->query("INSERT INTO TARIFAS VALUES (DEFAULT,20,'mensual')");
    $con->query("INSERT INTO TARIFAS VALUES (DEFAULT,50,'trimestral')");
    $con->query("INSERT INTO TARIFAS VALUES (DEFAULT,100,'anual')");
    }
}
if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymd' AND table_name = 'USUARIOS'")){
    $con->query("CREATE TABLE USUARIOS (ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL, EMAIL VARCHAR(40) NOT NULL, CONTRASENA VARCHAR(200) NOT NULL, NOM_USR varchar(20) NOT NULL, IMCTIPO VARCHAR (1) NOT NULL, ACTIVADO VARCHAR(1) NOT NULL, ID_TARIFA INT NOT NULL, TARIFA_PAGADA VARCHAR(1) NOT NULL, TIPO_USUARIO VARCHAR(10) NOT NULL, CONSTRAINT FK_ID_TARIFA FOREIGN KEY(ID_TARIFA) REFERENCES TARIFAS (ID_TARIFA))");
}
$passwd=password_hash("hola",PASSWORD_DEFAULT);
if($consAdm=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='ADMIN'")){
    if(mysqli_num_rows($consAdm)==0){
        $con->query("INSERT INTO USUARIOS VALUES (DEFAULT, 'hola@hola', '$passwd','ADM', '0', 'S', '1', 'S','ADMIN')");
    }
}
if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymd' AND table_name = 'RUTINAS'")){
    $con->query("CREATE TABLE RUTINAS (ID_RUTINA INT AUTO_INCREMENT PRIMARY KEY NOT NULL, NOMBRE VARCHAR(20) NOT NULL, DURACION INT NOT NULL, DESCRIPCION VARCHAR(400), ID INT NOT NULL, CONSTRAINT FK_ID FOREIGN KEY(ID) REFERENCES USUARIOS(ID))");
}


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
