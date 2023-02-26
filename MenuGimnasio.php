<? 

require "./includes/loginDatos.php";
require "./includes/comprobarSesion.php";
include "./includes/crearTablas.php";


$fech2=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email' ");
$fech2=$fech2->fetch_assoc();
if($fech2['TIPO_USUARIO']=="ENTRENADOR" || $fech2['TIPO_USUARIO']=="ADMIN"){
    header("location: index.php");
}
$fech2=strtotime($fech2["FECHA_VENCIMIENTO"]);

$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
if($fecha_actual>= $fech2){
    $con->query("UPDATE USUARIOS SET ID_TARIFA=1 WHERE EMAIL='$email'");
}

if(isset($_REQUEST['volver'])){
    session_destroy();
    header("location: index.php");
}
        
if(isset($_REQUEST['chat'])){
    header("location: verUsuarios.php");
}
$req=array_flip($_REQUEST);

if(isset($req['abrir'])){
    print_r($req);
    $idr=$req['abrir'];
    header("location: rutina.php?id=$idr");
}
//print_r($_SESSION['datos']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Usuario</title>
    <!--script src="menugimnasio.js"></script-->
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="usuario">
    <div class="HeaderUsuario">
        <a href="index.php">GymBd</a>
        <a href="modificarDatos.php">Modificar Tus Datos</a>
        <a href="verEntrenadores.php">Ver Entrenadores</a>
        <a href="MenuGimnasio.php?volver=volver"> Cerrar Sesion</a>
        <a href="nuevoPago.php?revisar=revisar">Revisar Tarifa</a>


    </div>
    <div class="container">
    <h1>Rutinas disponibles: </h1>
    <form action="" method="post" id="form">

        <?
        //$_SESSION['datos'];
            $query="SELECT * FROM RUTINAS";
            $result=$con->query($query);
            while($result->fetch_assoc()){
                    ?>
                    <?php
                foreach($result as $key => $value){
                    
                    ?> 
                    <div class="card mb-4" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $value["NOMBRE"]?></h5>
                        <p class="card-text"> <?php echo "Dura un total de ".$value['DURACION']." minutos, y ha sido ";
                        
                        $id=$value["ID_ENTRENADOR"];
                        //echo $id;
                        $ids=$con->query("SELECT * FROM USUARIOS WHERE ID ='$id'");
                        $ids=$ids->fetch_assoc();
                        echo "realizada por el entrenador ".$ids["EMAIL"];
                    
                    //print_r($ids);
                    $tip_tar=$con->query("SELECT ID_TARIFA FROM USUARIOS WHERE EMAIL='$email'");
                    $tip_tar=$tip_tar->fetch_assoc();
                        if($tip_tar['ID_TARIFA']==1){

                        }
                        else{
                        ?>
                        <div>
                            <button type="submit" class="btn btn-success" value="abrir" id="<?=$value['ID_RUTINA']?>" name="<?=$value['ID_RUTINA']?>">Abrir</button>
                        </div>  
                        <?php
                        }
                        ?>
                    </div>
                </div>
                
                <?
                    }
                    
                
            }
            //$consultas=$consultas->fetch_all();
            /*echo "<br><br>";
            print_r($consultas);
            foreach($consultas as $key=> $value){
                foreach($value as $subkey => $subvalue){
                    
                    echo $value[1];
                }
                echo "<br>";
            }*/
            ?>

    </form>
    </div>

</body>
</html>
<?
