<? 

require "./includes/loginDatos.php";
require "./includes/comprobarSesion.php";



if(isset($_REQUEST['volver'])){
    session_destroy();
    header("location: index.php");
}
        
if(isset($_REQUEST['chat'])){
    header("location: GenerarChat.php");
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
<body>
    <div class="capa1">
        <a href="index.php">GymBd</a>
    </div>
    <h1>Bienvenido, en este panel aparecerán todas las rutinas disponibles</h1>
    <form action="" method="post" id="form">

        <?
        //$_SESSION['datos'];
            $query="SELECT * FROM RUTINAS";
            if($result=($con->query($query)));
            while($row=$result->fetch_assoc()){
                    ?>
                    <div class="card mb-4" style="width: 18rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <?php
                foreach($row as $key=> $value){
                    if($key=="NOMBRE"){
                        ?> <h5 class="card-title"><?php echo $value?></h5><?php
                    }
                    if($key=="DURACION"){
                        ?><p class="card-text"> <?php echo "Dura un total de ".$value." minutos, y ";
                    }
                    if($key=="DESCRIPCION"){
                        echo $value;
                    }
                    if($key=="ID_ENTRENADOR"){
                        $ids=$con->query("SELECT * FROM USUARIOS WHERE ID ='$value'");
                        $ids=$ids->fetch_assoc();
                        echo "Realizada por el entrenador ".$ids["EMAIL"];
                        ?>
                        <div>
                            <button type="submit" class="btn btn-danger" value="abrir" id="<?=$row['ID_RUTINA']?>" name="<?=$row['ID_RUTINA']?>">Abrir</button>
                        </div>  
                    </div>
                </div>
                
                <?
                    }
                    
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
            <button type="submit" class="btn btn-success" value="chat" name="chat">Chat</button>
            <button class="btn btn-secondary" type="submit" name="volver" value="Cerrar Sesion"> Cerrar Sesion</button>

    </form>
    

</body>
</html>
<?
