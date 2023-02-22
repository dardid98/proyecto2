<?

require "./includes/comprobarSesion.php";
require "./includes/loginDatos.php";


$idE=$_SESSION['chat']['emisor'];
$idR=$_SESSION['chat']['receptor'];


if(isset($_REQUEST['salir'])){
    echo "salir";
    unset($_SESSION['chat']);
    header("location: verUsuarios.php");
}

if(isset($_REQUEST['mensaje'])){
    print_r($_REQUEST);
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
<body>
    <div class="chat">
        <h1>Bienvenido<?php echo $idE?>, este es tu registro de mensajes con <?php echo $idR?> </h1>
        <form action="" method="post" id="formulario">
            <div class="mensajes">
                
            </div>
            <div class="enviar">
                <input type="text" id="mensaje" name="mensaje">
                <button type="submit">Enviar</button>
            </div>
        </form>
        <form action="" method="post">
            <button type="submit" name="salir" id="salir">Salir</button>
        </form>
    </div>
</body>
</html>