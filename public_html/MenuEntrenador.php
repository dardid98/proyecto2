<?php

include "../includes/loginDatos.php";
include "../includes/comprobarSesion.php";
include "../includes/crearTablas.php";

$cons=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
$cons=$cons->fetch_assoc();
$id=$cons['ID'];

?>

                       
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Entrenador</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="comprobarSesion.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="entrenador">
    <header class="Entrenador">
        <nav>
            <a href="index.php">GymBd</a>
        </nav>
    </header>
    
    <main class="d-flex justify-content-center align-items-center container">
        <article class="cuerpo">
            <nav>
                <a href="CrearRutina.html" class="btn btn-warning">Crear Rutina</a>
                <a href="verUsuarios.php" class="btn btn-success">Charlar</a>
                <form action="cerrarSesion.php" style="display: inline">
                    <input type="submit" class="btn btn-info" value="Cerrar Sesion">
                </form>
            </nav>
        </article>
        
    </main>
    <hr>
        <main class="justify-content-center container">
            <article class="rutinast">
                <h3>Rutinas creadas por ti: </h3>
            <?php
                $query="SELECT * FROM RUTINAS WHERE ID_ENTRENADOR='$id'";
                $result=$con->query($query);
                if($result->num_rows==0){
                    echo "No has creado ninguna rutina";
                }else{

                
                while($result->fetch_assoc()){
                    
                    foreach($result as $key => $value){
                        
                        ?> 
                        <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Rutina de nombre <?php echo $value["NOMBRE"]?>,</h5>
                            <p class="card-text"> con una duración de <?php echo $value['DURACION']." minutos y con descripcion: ". $value['DESCRIPCION'];
                            
                            $id=$value["ID_ENTRENADOR"];
                            //echo $id;
                            $ids=$con->query("SELECT * FROM USUARIOS WHERE ID ='$id'");
                            $ids=$ids->fetch_assoc();
                        
                        //print_r($ids);
                        $tip_tar=$con->query("SELECT ID_TARIFA FROM USUARIOS WHERE EMAIL='$email'");
                        $tip_tar=$tip_tar->fetch_assoc();
                        ?>
                        <form action="modificarRutina.php" method="post">
                            <input type="hidden" name="abrir" value="<?php echo $value['ID_RUTINA']?>">
                            <button type="submit" class="btn btn-success" value="Modificar" name="modificar">Modificar</button>
                        </form>
                        </div>
                    </div>
                    
                    <?php
                    }
                        
                    
                }
            }
            ?>
            </article>
            <article class="rutinas">
                <h3>Rutinas creadas por ti, que han realizado los distintos usuarios:</h3>
                <?php
                $queryEnt="SELECT * FROM RUTINAS WHERE ID_ENTRENADOR='$id'";
                $queryReg="SELECT * FROM REGISTRO_RUTINAS";
                $result=$con->query($queryReg);
                if($result->num_rows==0){
                    echo "No has creado ninguna rutina, por lo que ningún registro aparecerá aquí";
                }else{
                    
                    
                    while($result->fetch_assoc()){
                        
                        foreach($result as $key => $value){

                        $id_us=$value['ID_USUARIO'];
                        $id_rut=$value['ID_RUTINA'];
                        $resulUs=$con->query("SELECT * FROM USUARIOS WHERE ID='$id_us'");
                        $resulRut=$con->query("SELECT * FROM RUTINAS WHERE ID_RUTINA='$id_rut' AND ID_ENTRENADOR='$id'");
                        $resulUs=$resulUs->fetch_assoc();
                        $resulRut=$resulRut->fetch_assoc();

                        ?> 
                        <div class="card mb-4">
                        <div class="card-body">
                        <p class="card-text">El usuario <span class="bold"><?php echo $resulUs["NOM_USR"]?></span>, ha completado la rutina <span class="bold"><?php echo $resulRut['NOMBRE']?></span> en el día y hora: <?php echo $value['FECHA_COMPLETADA']?></p>
                        </div>
                    </div>
                    
                    <?php
                    }
                        
                    
                }
            }
            ?>
            </article>
        </main>
        
</body>
</html>