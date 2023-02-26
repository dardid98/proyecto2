<?php
require "includes/loginDatos.php";

session_start();
if(!isset($_SESSION['datos'])){
    session_destroy();
    echo "no";
}else{
    if(isset($_REQUEST['crear'])){
    
        $email=$_SESSION['datos'][0];
        $passwd=$_SESSION['datos'][1];
        $resul=$con->query("SELECT ID FROM USUARIOS WHERE EMAIL='$email' AND TIPO_USUARIO='ENTRENADOR'");
        $resul=$resul->fetch_row();
        //print_r($resul);
        $duracion=$_REQUEST['duracion'];
        $nombre=$_REQUEST['nombre'];
        $descripcion=$_REQUEST['descripcion'];
        $id_entrenador=$resul[0];       
        $url=$_REQUEST['url'];
    }
    
    $con->query("INSERT INTO RUTINAS VALUES(DEFAULT,'$nombre','$duracion','$descripcion','$id_entrenador')");

}    


?>