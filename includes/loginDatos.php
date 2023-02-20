<?php
    $dbhost="localhost";
    $user="root";
    $pass="1234";

    $con=new mysqli($dbhost, $user, $pass) or die("Usuario o contrasena de inicio de sesión a la base de datos incorrectos");
    $con->query("CREATE DATABASE IF NOT EXISTS id20260728_gymdALTER");
    $con->query("use id20260728_gymdALTER");
?>