<?php

require "./includes/loginDatos.php";
require "./includes/comprobarSesion.php";
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
    
    //echo $email2;
    $con->query("UPDATE USUARIOS SET NOM_USR='$nom_usr' WHERE EMAIL='$email2'");
}

if(isset($_REQUEST['CambiarPass'])){
    $pass1=$_REQUEST['pass1'];
    $pass2=$_REQUEST['pass1'];
    if($pass1===$pass2){
        $passwd=password_hash($pass1,PASSWORD_DEFAULT);
        $con->query("UPDATE USUARIOS SET CONTRASENA='$pass1' WHERE EMAIL='$email2'");
        session_destroy();
        header("location: index.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Datos</title>
</head>
<body>
    <h1>Aquí podrás modificar tus datos</h1>
    <h2>Ten en cuenta que al modificar tu correo tendrás que volver a activarlo con un mensaje que te llegará a dicho correo, y que con el cambio de contraseña tendrás que volver a iniciar sesión</h2>
    
    <div>
        <form action="" method="post">
            <input type="text" name="email" id="email">
            <input type="submit" name="CambiarEma"value="Enviar">
        </form>
    </div>

    <div>
        <form action="" method="post">
            <input type="text" name="nom_usr" id="nom_usr">
            <input type="submit" name="CambiarNom" value="Enviar">
        </form>
    </div>
    
    <div>
        <form action="" method="post">
            <input type="password" name="passwd" id="pass1">
            <input type="password" name="passwd" id="pass2">
            <input type="submit" name="CambiarPass" value="Enviar">
        </form>
    </div>
        
</body>
</html>