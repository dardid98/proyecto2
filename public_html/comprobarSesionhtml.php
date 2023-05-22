<?php

include "../includes/loginDatos.php";
session_start();


if(!isset($_SESSION['datos'])){
    echo "mal";
}

$email=$_SESSION['datos'][0];
$passwd=$_SESSION['datos'][1];


$datosUsu=$con->query("SELECT * FROM USUARIOS WHERE EMAIL = '$email'");
$datosFila=$datosUsu->fetch_assoc();

if($datosUsu->num_rows==0){
    
    session_destroy();
    echo "mal";
    
}else if(!password_verify($passwd,$datosFila["CONTRASENA"])){
        session_destroy();
        echo "mal";
    
}else{
    echo "bien";
}


?>