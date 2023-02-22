<?php
include "./includes/loginDatos.php";
include "./includes/comprobarSesion.php";

/*$cons=$con->query("SELECT * FROM USUARIOS WHERE ID='$id' AND EMAIL='$email'");
if($cons->num_rows==0){
    $usuarios=$con->query("SELECT * FROM ENTRENADORES");
}
else{
    $usuarios=$con->query("SELECT * FROM USUARIOS");
}*/
//echo "REQUEST::::::::::::::::";
//print_r($_REQUEST);
$usr;
$fila;
//echo "SESION:::::::";
//print_r($_SESSION);
//Hacemos consultas para comprobar a quién pertenecen las credenciales pasadas desde la sesion
$resultadoUs=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
$resultadoUs=$resultadoUs->fetch_assoc();
//echo "<br>";
//print_r($resultadoUs);

//Sacamos qué tipo de usuario es el que ha accedido a chat.php para que muestre solo los otros tipos de usuario
if(isset($resultadoUs)&& $resultadoUs['TIPO_USUARIO'] =='USUARIO'){
    $usr=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='ENTRENADOR'");
    $fila=$usr->fetch_assoc();
    //print_r($usr);
}else if(isset($resultadoUs) && $resultadoUs['TIPO_USUARIO']=='ENTRENADOR'){
    $usr=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='USUARIO'");
    $fila=$usr->fetch_assoc();
    //print_r($usr);
}

$req=array_flip($_REQUEST);
//echo "REQUEST PERO DESPUÉS";
//print_r($req);
if(isset($req['generar'])){
    //Recogemos el id pasado de la otra parte de la web.
    $id=$resultadoUs['ID'];
    
    //Si la clave es id_entrenador, quiere decir que la persona que ha entrado en la web es un usuario, así que cogemos el id generado antes y lo ponemos de nombre a la tabla
    if($fila['TIPO_USUARIO']=="ENTRENADOR"){
        //$tipo="ENTRENADOR";
        $id2=$req['generar'];
        //echo $id2;

    }else if($fila['TIPO_USUARIO']=="USUARIO"){
        //$tipo="USUARIO";
        $id2=$req["generar"];
        //echo $id2;
    }
    //echo $id.", ". $id2;
    $_SESSION['chat']=array("emisor"=>$id, "receptor"=>$id2);
    //echo $nom;
    //echo $nomr;
    //print_r ($resultadoUs);
    /*$res=$con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymdalter' AND table_name = '$nom'");
    $resr=$con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymdalter' AND table_name = '$nomr'");
    $res=$res->num_rows;
    $resr=$resr->num_rows;*/
    //echo $resr;
    //echo $res;
    /*if($res==1||$resr==1){
        echo "Ya existen";
    }else{
        echo "Crear";*/
        $con->query("CREATE TABLE CHAT (ID_EMISOR INT NOT NULL, ID_RECEPTOR INT NOT NULL, MENSAJE VARCHAR(100) NOT NULL, FECHA TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CONSTRAINT FK_ID_EMISOR FOREIGN KEY(ID_EMISOR) REFERENCES USUARIOS (ID),CONSTRAINT FK_ID_RECEPTOR FOREIGN KEY(ID_RECEPTOR) REFERENCES USUARIOS (ID))");
    /*}
    echo "Este es el inicio de tu conversacion con ";*/
    header("location: chat.php");
}
else{
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
        <!--script src="chat.js"></script-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
    <body>
        <form action="" method="post" id="formul">
            <h1>Bienvenido, aquí aparecen todos los usuarios con los que puedes chatear: </h1>
            <?php

            //$most=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='$tipo'");
            //print_r($usr);
            while($usr->fetch_assoc()){
                foreach($usr as $key => $value){
                    //print_r($value);
                    ?>
                    <div class="card mb-4" style="width: 18rem;">
                    <!--<img class="card-img-top" src="..." alt="Card image cap">-->
                    <div class="card-body">
                    <div>
                
                <h5 class="chard-title"><?php echo $value['NOM_USR']?></h5>
                <p class="card-text">Este es el <?php echo strtolower($value['TIPO_USUARIO']) ." ".$value["NOM_USR"]?> pulsa sobre generar para empezar a hablar con él
                
                <input type="submit" value="generar" name="<?php echo $value["ID"]?>" id="<?php echo $value["ID"]?>">
                    </div>
                    </div>
                    
                    </div>
                    
                <?php
                    }
                    
                }   
                //echo "<br>";
            
            ?>
        </form>
    </body>
</html>

<?php
}
?>