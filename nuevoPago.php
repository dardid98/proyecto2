<html>
    <head>
        <title>Modificar Tarifa</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
    <body>
    <div class="HeaderUsuario">
        <a href="menuGimnasio.php">Regresar</a>
    </div>
    <div class="d-flex justify-content-center align-items-center container">

        <div class="capa2">
<?php 

if(isset($_REQUEST['extender'])){
    include "includes/comprobarSesion.php";
    print_r($_REQUEST);

    $tiempo=$_REQUEST['tiempo'];
    $fech=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
    $fech=$fech->fetch_assoc();
    $fech=$fech['FECHA_VENCIMIENTO'];
    $fech=date_create($fech);
    date_add($fech, date_interval_create_from_date_string($tiempo." months"));
    print_r($fech);
    $fech=$fech->format('Y-m-d H:i:s');
    //echo $fech;
    $con->query("UPDATE USUARIOS SET FECHA_VENCIMIENTO='$fech' WHERE EMAIL='$email'");
    header("location: MenuGimnasio.php");
    
}

if(isset($_REQUEST['cancelar'])){
    header("location: MenuGimnasio.php");
}

if(isset($_REQUEST['nuevPagar'])){
    include "includes/comprobarSesion.php";
    //print_r($_REQUEST);
    $tarifa=$_REQUEST['nuevTarifa'];
    $con->query("UPDATE USUARIOS SET ID_TARIFA='$tarifa' WHERE EMAIL='$email'");
    $con->query("UPDATE USUARIOS SET FECHA_PAGO=DEFAULT WHERE EMAIL='$email'");
    $fechaven=$con->query("SELECT FECHA_PAGO FROM USUARIOS WHERE EMAIL='$email'");
    $fechaven=$fechaven->fetch_assoc();
    $fech=date_CREATE($fechaven['FECHA_PAGO']);
    switch ($tarifa){
        case 2: 
            date_add($fech, date_interval_create_from_date_string("1 month"));
            break;
        case 3: 
            date_add($fech, date_interval_create_from_date_string("3 months"));
            break;
        case 4: 
            date_add($fech, date_interval_create_from_date_string("12 months"));
            break;
        }
        $fech=$fech->format('Y-m-d H:i:s');
        //echo $fech;
        $con->query("UPDATE USUARIOS SET FECHA_VENCIMIENTO='$fech' WHERE EMAIL='$email'");
    
}

if(isset($_REQUEST['nuevo'])){
    
?>

<form action="" method="post">
    <div>
        <div class="mb-3">
            <div class="form-group mb-2">
                <label for="nuevTarifa" class="text-success"><h2>Cambiar Tarifa</h2></label>
                <select class="form-select form-select-lg" name="nuevTarifa" id="nuevTarifa">
                    <option selected value="2">20€(mensual)</option>
                    <option value="3">50€(trimestral)</option></option>
                    <option value="4">100€(Anual)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success" name="nuevPagar">Pagar</button>
            <button type="submit" class="btn btn-secondary" name="cancelar">Cancelar</button>
        </div>
    </div>
</form>
    <?php
}

if(isset($_REQUEST['revisar'])){
    include "includes/comprobarSesion.php";
    //print_r($_REQUEST);
    $tar=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
    $tar=$tar->fetch_assoc();
    //print_r($tar);
    if($tar['ID_TARIFA']==1){
        header("location: nuevoPago.php?nuevo=nuevo");
    }
    //$tar=$tar->fetch_assoc();
    $date= date($tar['FECHA_VENCIMIENTO']);
    //echo date($date);
    
    /*$res=$con->query("SELECT * FROM TARIFAS WHERE ID_TARIFA='$tarifa'");
    $res=$res->fetch_assoc();
    */

    ?>
<form action="" method="post">
    <div>
        <div class="mb-3">
            <h2 class="text-success">Extender Tiempo tarifa</h2>
            <div class="form-group mb-1">
                <select class="form-select form-select-lg" name="tiempo" id="tiempo">
                    <option selected value="1">1 mes (20€)</option>
                    <option value="3">3 meses (50€)</option>
                    <option value="6">6 meses (75€)</option></option>
                    <option value="12">1 año (100€)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success" name="extender">Extender</button>
            <button type="submit" class="btn btn-secondary" name="cancelar">Cancelar</button>
        </div>
    </div>
</form>
        
<?php
}
?>
        </div>
    </div>
    
    </body>
</html>
        