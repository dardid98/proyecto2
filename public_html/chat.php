<?php

require "../includes/comprobarSesion.php";
require "../includes/loginDatos.php";
include "../includes/crearTablas.php";



$idE=$_SESSION['chat']['emisor'];
$idR=$_SESSION['chat']['receptor'];

$consE=$con->query("SELECT * FROM USUARIOS WHERE ID='$idE'");
$consR=$con->query("SELECT * FROM USUARIOS WHERE ID='$idR'");

$consE=$consE->fetch_assoc();
$consR=$consR->fetch_assoc();

if($consE['TIPO_USUARIO']=="ENTRENADOR"){
    $varSalida="MenuEntrenador.php";
}else if($consE['TIPO_USUARIO']=="USUARIO"){
    $varSalida='MenuGimnasio.php';
}


if(isset($_REQUEST['salir'])){
    echo "salir";
    unset($_SESSION['chat']);
    header("location: verUsuarios.php");
}

if(isset($_REQUEST['mensaje'])){
    //print_r($_REQUEST);
    $mensaje=$_REQUEST['mensaje'];
    $con->query("INSERT INTO CHAT VALUES('$idE','$idR','$mensaje', DEFAULT)");
    
}

if(isset($_REQUEST['mostrar'])){
    $mensa=array();
    $mensajes=$con->query("SELECT * FROM CHAT");
    while($mensajes->fetch_assoc()){
        foreach ($mensajes as $key => $value) {
            if($value["ID_EMISOR"]==$idE && $value['ID_RECEPTOR']==$idR){
                $value+=["tipo"=>"mensajeE"];
                array_push($mensa, $value);
            }
            else if($value["ID_RECEPTOR"]==$idE && $value['ID_EMISOR']==$idR){
                $value +=[ "tipo" => "mensajeR"];
                array_push($mensa, $value);
            }
        }
    }
    /*$mensajes=$con->query("SELECT * FROM CHAT WHERE ID_EMISOR='$idE' AND ID_RECEPTOR='$idR'");
    while($mensajes->fetch_assoc()){
        foreach ($mensajes as $key => $value) {
            //print_r($value);

        }
    }
    $mensajes=$con->query("SELECT * FROM CHAT WHERE ID_EMISOR='$idR' AND ID_RECEPTOR='$idE'");
    while($mensajes->fetch_assoc()){
        foreach ($mensajes as $key => $value) {
        }
    }*/
    //print_r($mensa);
    //print_r($mensa);
    //print_r($mensajes);
    //$mensa=array_reverse($mensa);
    $mensa=json_encode($mensa);
    print_r($mensa);
    return $mensa;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="chat.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="chat">
    <header class="Chat">
        <nav>
            <a href="index.php">Inicio</a>
        </nav>
    </header>
    <main class="container">
        <article class="cuerpo">
            <h3 class="text-success">Bienvenido <?php echo $consE['NOM_USR']?>, este es tu registro de mensajes con <?php echo $consR['NOM_USR']?> </h3>
            <form action="" method="post" id="formulario">
                <section class="mensajes mb-3">
                    <!-- Aquí aparecen los mensajes -->
                </section>
                <div class="form-group mb-2">
                    <label for="mensaje" class="text-primary">Introduce aquí tu siguiente Mensaje: </label>
                    <input type="text" class="form-control" id="mensaje" name="mensaje">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
            <form action="" method="post">
                <a href="<?php echo $varSalida?>" class="btn btn-secondary">Salir</a>
            </form>
        </article>
    </main>
</body>
</html>