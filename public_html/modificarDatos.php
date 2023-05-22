<?php

require "../includes/loginDatos.php";
require "../includes/comprobarSesion.php";
include "../includes/crearTablas.php";

//include "./ValidaUsuario.php";
$email2=$_SESSION['datos'][0];
$cons=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email2'");
$cons=$cons->fetch_assoc();
if($cons['TIPO_USUARIO']=='ADMIN'){
    header("location: index.php");
}

if(isset($_REQUEST['CambiarEma'])){
    $email=$_REQUEST['email'];
    $res=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
    if($res->num_rows==0){
        $con->query("UPDATE USUARIOS SET EMAIL='$email' WHERE EMAIL='$email2'");
    }
    else{
        echo "Este correo ya está registrado en nuestra base de datos";
    }
    //$con->query("UPDATE USUARIOS SET ACTIVADO='N' WHERE EMAIL='$email2'");
    
    //session_destroy();
    //header("location: index.php");

    

}
if(isset($_REQUEST['CambiarNom'])){
    $nom_usr=$_REQUEST['nom_usr'];
    
    $con->query("UPDATE USUARIOS SET NOM_USR='$nom_usr' WHERE EMAIL='$email2'");
}

if(isset($_REQUEST['CambiarPass'])){
    $pass1=$_REQUEST['passwd1'];
    $pass2=$_REQUEST['passwd2'];
    if($pass1===$pass2){
        $passwd=password_hash($pass1,PASSWORD_DEFAULT);
        $con->query("UPDATE USUARIOS SET CONTRASENA='$pass1' WHERE EMAIL='$email2'");
        session_destroy();
        header("location: index.php");
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Datos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body class="usuario">
    <header class="Usuario">
        <nav>
            <a href="MenuGimnasio.php">Regresar</a>
        </nav>
    </header>
    <main class="d-flex justify-content-center align-items-center container">

        <article class="cuerpo">
            <h2 class="text-success mb-3">Aquí podrás modificar tus datos</h2>
            <section class="mb-5">
                <form action="" method="post">
                    <div class="form-group mb-1">
                        <label for="email" class="text-light">Nuevo Correo Electrónico: </label>
                        <input class="form-control d-inline" type="text" name="email" id="email" placeholder="Correo Electrónico">
                    </div>
                        <button class="btn btn-outline-success" type="submit" name="CambiarEma">Enviar</button>
                </form>
            </section>

            <section class="mb-5">
                <form action="" method="post">
                    <div class="form-group mb-1">
                        <label for="nom_usr" class="text-light">Nuevo nombre de usuario: </label>
                        <input type="text" name="nom_usr" id="nom_usr" class="form-control" placeholder="Nombre de Usuario">
                    </div>
                    <button type="submit" name="CambiarNom" class="btn btn-outline-success">Enviar</button>
                </form>
            </section>
            
            <section class="mb-5">
                <form action="" method="post">
                    <div class="form-group mb-1">
                        <label class="text-light" for="passwd1">Introduce tu nueva contraseña: </label>
                        <input class="form-control" type="password" name="passwd1" id="passwd1" placeholder="Nueva Contraseña">
                    </div>
                    <div class="form-group mb-1">
                        <label class="text-light" for="passwd2">Vuelve a introducirla: </label>
                        <input class="form-control" type="password" name="passwd2" id="passwd2" placeholder="Repite la nueva Contraseña">
                    </div>
                    <button type="submit" name="CambiarPass" class="btn btn-outline-success">Enviar </button>
                </form>
            </section>
        </article>
    </main>
</body>
</html>