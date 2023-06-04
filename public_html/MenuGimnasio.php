<?php

include "../includes/loginDatos.php";
include "../includes/comprobarSesion.php";
include "../includes/crearTablas.php";


$fech2=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email' ");
$fech2=$fech2->fetch_assoc();
$imgn=$fech2["RUTA_IMAGEN"];
$id_tar=$fech2['ID_TARIFA'];
if($fech2['TIPO_USUARIO']=="ENTRENADOR" || $fech2['TIPO_USUARIO']=="ADMIN"){
    header("location: index.php");
}
$fech2=strtotime($fech2["FECHA_VENCIMIENTO"]);

$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
/*if($fecha_actual>= $fech2){
    $con->query("UPDATE USUARIOS SET ID_TARIFA=1 WHERE EMAIL='$email'");
}*/
if(isset($_REQUEST['mostrar'])){
    $fech2=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email' ");
    $fech2=$fech2->fetch_assoc();
    $id=$fech2['ID'];
    $mensa=array();
    $rutinas=$con->query("SELECT * FROM REGISTRO_RUTINAS");
    while($rutinas->fetch_assoc()){
        foreach ($rutinas as $key => $value) {
            if($value["ID_USUARIO"]==$id){
                array_push($mensa, $value);
            }
        }
    }

    $mensa=json_encode($mensa);
    print_r($mensa);
    return $mensa;
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
    //print_r($req);
    $idr=$req['abrir'];
    header("location: rutina.php?id=$idr");
}
//print_r($_SESSION['datos']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Usuario</title>
    <script src="MenuGimnasio.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="usuario">
    <header class="Usuario">
        <nav>
            <ul>
                <li><img src="<?php echo "imagenes/".$imgn ?>" class="imgperf" ></li>
                <li><a href="index.php">GymBd</a></li>
                <li><a href="modificarDatos.php">Modificar Tus Datos</a></li>
                <?php if($id_tar==1 ||$id_tar==2){
                    }else{?>
                <li><a href="verEntrenadores.php">Ver Entrenadores</a></li>
                <?php  }?>
                <li><a href="MenuGimnasio.php?volver=volver"> Cerrar Sesion</a></li>
                <li><a href="nuevoPago.php?revisar=revisar">Revisar Tarifa</a></li>
        </nav>
    </header>
    
    <main class="justify-content-center container">
        <section class="usrDis">
            <h1>Rutinas disponibles: </h1>
            <form action="" method="post" id="form">

                <?php
                //$_SESSION['datos'];
                $query="SELECT * FROM RUTINAS";
                $result=$con->query($query);
                while($result->fetch_assoc()){
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
                        $tip_tar=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
                        $tip_tar=$tip_tar->fetch_assoc();
                        //print_r($tip_tar);
                            if($tip_tar['ID_TARIFA']==1 || $tip_tar['TARIFA_PAGADA']=='N'){

                            }
                            else{
                            ?>
                            <div>
                                <button type="submit" class="btn btn-success" value="abrir" id="<?php echo $value['ID_RUTINA']?>" name="<?php echo $value['ID_RUTINA']?>">Abrir</button>
                            </div>  
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    <?php
                        }
                        
                    
                }
                        ?>
            
                    </form>
                </section>
                <section class="usrHech">
                    <h1>Registro Mensual: </h1>
                    <div id="leyenda">
                        <div><th>Leyenda de la tabla:</th></div>
                        <div><div class="col diaAc">Mll</div>Día actual</div>
                        <div><div class="col diaSi">Mll</div>Día en el que hiciste, al menos, una rutina</div>
                        <div><div class="col diaAcSi">Mll</div>Día actual + has hecho una rutina al menos.</div>
                    </div>
                    <form action="" method="post" id="form2">

                <?php
                //$_SESSION['datos'];
                $query="SELECT * FROM RUTINAS";
                $result=$con->query($query);
                while($result->fetch_assoc()){
                    foreach($result as $key => $value){
                        
                        ?> 
                        <table id="calendar">
                            
                            <tbody id="cuerpoCal">
                                
                            </tbody>
                        </table>
                        
                        </div>
                    </div>
                    
                    <?php
                        }
                        
                    
                }
                        ?>
            
                    </form>
                </section>
            </main>
            

</body>
</html>
