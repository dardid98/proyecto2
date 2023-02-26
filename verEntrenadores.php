<?php
include "./includes/loginDatos.php";
include "./includes/comprobarSesion.php";


$fech2=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email' ");
$fech2=$fech2->fetch_assoc();
if($fech2['TIPO_USUARIO']=="ENTRENADOR" || $fech2['TIPO_USUARIO']=="ADMIN"){
    header("location: index.php");
}


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
$filas;
//echo "SESION:::::::";
//print_r($_SESSION);
//Hacemos consultas para comprobar a quién pertenecen las credenciales pasadas desde la sesion
$resultadoUs=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
$resultadoUs=$resultadoUs->fetch_assoc();
//print_r($resultadoUs);
//echo "<br>";
//print_r($resultadoUs);

//Sacamos qué tipo de usuario es el que ha accedido a chat.php para que muestre solo los otros tipos de usuario
if(isset($resultadoUs)&& $resultadoUs['TIPO_USUARIO'] =='USUARIO'){
    $usr=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='ENTRENADOR'");
    $filas=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='ENTRENADOR'");
    $fila=$usr->fetch_assoc();
    //print_r($fila);
}else if(isset($resultadoUs) && $resultadoUs['TIPO_USUARIO']=='ENTRENADOR'){
    $usr=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='USUARIO'");
    $filas=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='USUARIO'");
    $fila=$usr->fetch_assoc();
    //print_r($fila);
}

$req=array_flip($_REQUEST);

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
    }

    $_SESSION['chat']=array("emisor"=>$id, "receptor"=>$id2);
    $con->query("CREATE TABLE CHAT (ID_EMISOR INT NOT NULL, ID_RECEPTOR INT NOT NULL, MENSAJE VARCHAR(100) NOT NULL, FECHA TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CONSTRAINT FK_ID_EMISOR FOREIGN KEY(ID_EMISOR) REFERENCES USUARIOS (ID),CONSTRAINT FK_ID_RECEPTOR FOREIGN KEY(ID_RECEPTOR) REFERENCES USUARIOS (ID))");
    /*}
    echo "Este es el inicio de tu conversacion con ";*/
    header("location: chat.php");
}
else{
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
        <!--script src="chat.js"></script-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body class="chat">
        <div class="HeaderChat">
            <a href="index.php">GymBd</a>
            <a href="MenuGimnasio.php">Regresar</a>
        </div>
        <div class="container">
            <form action="" method="post" id="formul">
                <h1>Bienvenido, aquí aparecen todos los usuarios con los que puedes chatear: </h1>
                <?php
                while($filas->fetch_assoc()){
                    foreach($filas as $key => $value){
                        //print_r($value);
                        ?>
                        <div class="card mb-4" style="width: 100%;">
                        <!--<img class="card-img-top" src="..." alt="Card image cap">-->
                            <div class="card-body">
                                <div class="mb-2">
                                    <h5 class="card-title"><?php echo $value['NOM_USR']?></h5>
                                    <p class="card-text">Este es el <?php echo strtolower($value['TIPO_USUARIO']) ." ".$value["NOM_USR"]?> pulsa sobre generar para empezar a hablar con él</p>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-success"value="generar" name="<?php echo $value["ID"]?>" id="<?php echo $value["ID"]?>">
                                </div>
                            </div>
                        </div>
                        
                    <?php
                        }
                        
                    }   
                    //echo "<br>";
                
                ?>
            </form>
        </div>
    </body>
</html>

<?php
}
?>