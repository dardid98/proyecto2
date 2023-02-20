<?php
//session_start();

include "includes/loginDatos.php";
include "./includes/comprobarSesion.php";


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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Administrador</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="MenuAdmin.js"></script>
</head>

<body>
    
    <form action="" method="post" id="formUsu">
        <table border="1px solid black" class="table table-dark table-hover table-striped">
            Usuarios registrados:
            <tr>
                <?php
            $thead=$resultadosUsu->fetch_assoc();
            foreach ($thead as $key => $value) {
                ?>
                    <th>
                <?php
                //echo $clave;
                echo $key;
                ?>
                    </th>
                <?php
                
            }
            //mysqli_fetch_row($resultadosUsu);
            ?></tr><?php
            foreach ($resultadosUsu as $key => $value) {
                foreach($value as $clave => $valor){
                    ?><td><?php
                    //echo $clave;
                    echo $valor;
                    ?>
                    </td>
                    <?php
                }
                ?>
                    <td><input type="checkbox" name="id" value="<?php echo $value['ID']?>" id="<?php echo $value['ID']?>"></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <button class="btn btn-danger" type="submit" value="Eliminar" id="delUsu"> Eliminar</button>
        <button class="btn btn-info" type="submit" name="volver" value="Cerrar Sesion"> Cerrar Sesion</button>
        </form>
        <a href="CrearUsuario.html">Anadir Entrenador a la Base de Datos</a>
        
    </form>
    
</body>
</html>