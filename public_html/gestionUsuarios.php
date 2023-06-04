<?php

include "../includes/loginDatos.php";

if(isset($_REQUEST['crearUsu'])){
    //print_r($_REQUEST);
    $email=$_REQUEST['email'];
    $passwd=$_REQUEST['contr'];
    $passwd=password_hash($passwd,PASSWORD_DEFAULT);
    $con->query("INSERT INTO USUARIOS VALUES(DEFAULT,'$email','$passwd','pr',2,'S',1,'S','ENTRENADOR',DEFAULT,DEFAULT)");
    
}

if(isset($_REQUEST['delUsu'])){
    //print_r($_REQUEST);
    foreach ($_REQUEST as $key => $value) {
        $con->query("DELETE FROM CHAT WHERE ID_EMISOR=$value");
        $con->query("DELETE FROM CHAT WHERE ID_RECEPTOR=$value");
        $con->query("DELETE FROM REGISTRO_RUTINAS WHERE ID_USUARIO=$value");
        $con->query("DELETE FROM REGISTRO_RUTINAS WHERE ID_RUTINA IN(SELECT ID_RUTINA FROM RUTINAS WHERE ID_ENTRENADOR=$value)");
        $con->query("DELETE FROM RUTINAS WHERE ID_ENTRENADOR=$value");
        $con->query("DELETE FROM USUARIOS WHERE ID=$value");
    }
}

if(isset($_REQUEST['Activar'])){
    //print_r($_REQUEST);
    foreach ($_REQUEST as $key => $value) {
        //echo $value;
        $con->query("UPDATE USUARIOS SET ACTIVADO='S' WHERE ID=$value");
    }
}
if(isset($_REQUEST['Desactivar'])){
    //print_r($_REQUEST);
    foreach ($_REQUEST as $key => $value) {
        //echo $value;
        $con->query("UPDATE USUARIOS SET ACTIVADO='N' WHERE ID=$value");
    }
}

/*if(isset($_REQUEST['modEnt'])){
    $id=$_REQUEST['id'];
    $registro=$con->query("SELECT * FROM ENTRENADORES WHERE ID_ENTRENADOR='$id'");
    $registro=mysqli_fetch_assoc($registro);
    //print_r($registro);
    ?>
    <form action="" method="get">
        Hay datos que no puedes modificar, en esta ventana solo aparecerán lo que sí puedes cambiar.<br>
    <?php
    foreach ($registro as $key => $value) {
        if($key=="EMAIL"){
            ?>
            <label for="email">email: </label>
            <input type="text" name="<?php echo $value?>" id="<? echo $value?>">
            email antiguo: <?php echo $value?><br>
            <input type="hidden" name="id" value="<?php echo $id?>">
            <?php
        }
    }
    ?>
    <input type="submit" value="Actualizar" name="actualizar">
    </form>
    <?php
}*/

if(isset($_REQUEST['actualizar'])){
    //print_r($_REQUEST);
}
?>