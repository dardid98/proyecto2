<?php
include "../includes/loginDatos.php";
include "../includes/comprobarSesion.php";


if(isset($_REQUEST['actualizar'])){
    $id_rutina=$_REQUEST['id_rutina'];
    $nombre=$_REQUEST['nombre'];
    $duracion=$_REQUEST['duracion'];
    $descripcion=$_REQUEST['descripcion'];

    $con->query("UPDATE RUTINAS SET NOMBRE='$nombre', DURACION='$duracion', DESCRIPCION='$descripcion' WHERE ID_RUTINA='$id_rutina'");
    header("location: MenuEntrenador.php");
}

if(isset($_REQUEST['modificar'])){
    $id_rutina=$_REQUEST['abrir'];
    $resR=$con->query("SELECT * FROM RUTINAS WHERE ID_RUTINA='$id_rutina'");
    $resR=$resR->fetch_assoc();
    //print_r($resR);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="entrenador">
    <header class="Entrenador">
        <nav>
            <a href="index.php">GymBd</a>
        </nav>
    </header>
    <main class="d-flex justify-content-center align-items-center container">
        <article class="cuerpo">
            <form method="post">
                <section class="mb-3">
                    <h1 class="text-danger">Modificar rutina existente </h1>
                </section>
                <section class="form-group mb-2">
                    <label class="text-light" for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="nombre" aria-label="nombre" aria-describedby="basic-addon1" required placeholder="Nombre Anterior: <?php echo $resR['NOMBRE']?>" >            
                </section>
                <section class="form-group mb-2">
                    <label class="text-light" for="duracion">Duración (minutos)</label>
                    <input class="form-control" type="number" name="duracion" id="duracion" required placeholder="Duracion Anterior: <?php echo $resR['DURACION']?> minutos" min="5" max="60">
                </section>
                <section class="form-group mb-2">
                    <label class="text-light" for="nom_usr">Descripción</label>
                    <input class="form-control" type="text" name="descripcion" id="descripcion" required placeholder="Descripcion Anterior: <?php echo $resR['DURACION']?> ">
                </section>
                <input type="hidden" name="id_rutina" value="<?php echo $id_rutina ?>">
                <input type="submit" class="btn btn-warning" value="Modificar Rutina" name="actualizar">
                <a href="menuEntrenador.php" class="btn btn-info">Cancelar</a>
            </form>
        </article>
        
    </main>
    
</body>
</html>

<?php

}


?>