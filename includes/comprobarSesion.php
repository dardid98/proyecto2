<?php

include "loginDatos.php";
session_start();


if(!isset($_SESSION['datos'])){
    header("location: index.php");
}

$email=$_SESSION['datos'][0];
$passwd=$_SESSION['datos'][1];


$datosUsu=$con->query("SELECT * FROM USUARIOS WHERE EMAIL = '$email'");

if($datosUsu->num_rows==0){
    
    session_destroy();
    header("location: index.php");
    
}else{
    $datosUsu=$datosUsu->fetch_assoc();
    if(!password_verify($passwd,$datosUsu["CONTRASENA"])){
        session_destroy();
        header("location: index.php");
    }
}


?>