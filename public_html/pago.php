<?php
include "../includes/loginDatos.php";
session_start();

if(isset($_REQUEST['Pagar'])){
    $id=$_SESSION['ID'];
    //echo $id;
    $con->query("UPDATE USUARIOS SET TARIFA_PAGADA='S' WHERE ID='$id'");
    header("location: index.php");
}
if(isset($_REQUEST['Rechazar'])){
    header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">

</head>
<body>
    <header class="Inicio">
        <nav>
            <a href="index.php">GymBD</a>
        </nav>
    </header>
    <form action="" method="post">
        <main>
    <?php

//include "./includes/comprobarSesion.php";


if(isset($_REQUEST['tarifa'])){
    //print_r($_REQUEST);
    $tarifa=$_REQUEST['tarifa'];
    
    $res=$con->query("SELECT * FROM TARIFAS WHERE ID_TARIFA='$tarifa'");
    $res=$res->fetch_assoc();

    
    ?>
        <section>
            <p>Has elegido la tarifa <?php echo $res['NOMBRE_TARIFA']?>, esta tarifa se paga de manera anual, el importe es de <?php echo $res['PRECIO'] ?> euros</p>
        </section>    
        <section>
            <button type="submit" class="btn btn-primary" name="Pagar">Pagar</button>
            <button type="submit" class="btn btn-secondary" name="Rechazar">Rechazar</button>
        </section>
    <?php
}

?>
    </main>
</form>
</body>
</html>