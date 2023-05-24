<?php
//session_start();

include "../includes/loginDatos.php";
include "../includes/comprobarSesion.php";
include "../includes/crearTablas.php";



$resultadosUsu=$con->query("SELECT * FROM USUARIOS");

if(isset($_REQUEST['volver'])){
    session_destroy();
    header("location: index.php");
}

//print_r($_SESSION['datos']);

//Idea Actual: Al pulsar el submit llevar el id del entrenador a eliminar al script js, y desde el script hacer una consulta a este mismo archivo a otro apartado que sea un
//if(isset) y que desde ahí se haga lo de eliminar al profesor de la base de datos.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Administrador</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="MenuAdmin.js"></script>
    <style>
        .grid-container > div {
            color: #eee;
        }
    </style>
</head>

<body class="administrador">
    <header class="Admin">
        <nav>
            <a href="index.php">Inicio</a>
        </nav>
    </header>
    <main class="contenedor">
        <form action="" method="post" id="formUsu">
            <article>
                    <h1 class="mb-3">Usuarios registrados:</h1>
                
               <div class="grid-container mb-3">
                <?php
            $thead=$resultadosUsu->fetch_assoc();
            foreach ($thead as $key => $value) {
                //echo $clave;
                if($key!="CONTRASENA" && $key!="FECHA_PAGO" && $key!="IMCTIPO"){
                   ?>  <div class="itemHead"> <?php echo $key; ?> </div> <?php
                }
                
                
            }
            ?>  <div class="itemHead"> Eliminar </div> <?php
            //mysqli_fetch_row($resultadosUsu);
            ?>
        <?php 
            foreach ($resultadosUsu as $key => $value){
                foreach($value as $clave => $valor){
                    if($clave!="CONTRASENA" && $clave!="FECHA_PAGO" && $clave!="IMCTIPO"){
                        ?>  <div class="item"> <?php echo $valor; ?> </div> <?php
                    }
                }
                    ?>
                    <div class="item"><input type="checkbox" name="id" value="<?php echo $value['ID']?>" id="<?php echo $value['ID']?>"></div>
                    <?php
            }
            ?>
            </div>
                <button class="btn btn-danger" type="submit" value="Eliminar" id="delUsu"> Eliminar</button>
                <button class="btn btn-secondary" type="submit" id="Activar"> Activar Usuario</button>
                <button class="btn btn-secondary" type="submit" id="Desactivar"> Desactivar Usuario</button>
                <button class="btn btn-info" type="submit" name="volver" value="Cerrar Sesion"> Cerrar Sesion</button>
                <a href="CrearUsuario.html" class="btn btn-warning">Añadir Entrenador a la Base de Datos</a>
            </article>
        </form>
    </main>
    
</body>
</html>