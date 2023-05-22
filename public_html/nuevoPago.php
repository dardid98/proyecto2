<?php    

include "../includes/comprobarSesion.php"; 

$tarifa_actual=$con->query("SELECT ID_TARIFA FROM USUARIOS WHERE EMAIL='$email'");
$tarifa_actual=$tarifa_actual->fetch_assoc();
$tarifa_actual=$tarifa_actual['ID_TARIFA'];
//echo $tarifa_actual;

if(isset($_REQUEST['cancelar'])){
    header("location: MenuGimnasio.php");
}

if(isset($_REQUEST['nuevPagar'])){
    $tarifa=$_REQUEST['nuevTarifa'];
    $con->query("UPDATE USUARIOS SET ID_TARIFA='$tarifa' WHERE EMAIL='$email'");
    $con->query("UPDATE USUARIOS SET FECHA_PAGO=DEFAULT WHERE EMAIL='$email'");
    if($tarifa_actual==1){
        $fecha="FECHA_PAGO";
    }else{
        $fecha="FECHA_VENCIMIENTO";
    }
    $fechaven=$con->query("SELECT $fecha FROM USUARIOS WHERE EMAIL='$email'");
    $fechaven=$fechaven->fetch_assoc();
    $fech=date_CREATE($fechaven[$fecha]);
    date_add($fech, date_interval_create_from_date_string("12 months"));
    $fech=$fech->format('Y-m-d H:i:s');
    //echo $fech;
    $con->query("UPDATE USUARIOS SET FECHA_VENCIMIENTO='$fech' WHERE EMAIL='$email'");
    $con->query("UPDATE USUARIOS SET FACTURA_PAGADA='S' WHERE EMAIL='$email'");
}
    
?>
<html lang="es">
    <head>
        <title>Modificar Tarifa</title>
        <link rel="stylesheet" href="css/estilos.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="usuario">
        <main class="d-flex justify-content-center align-items-center container">
            <article class="cuerpo">
                <section>
                    <form action="" method="post">
                        <div class="mb-3">
                            <div class="form-group mb-2">
                                <label for="nuevTarifa" class="text-success"><h2>Cambiar Tarifa/Extender Duracion</h2></label>
                                <select class="form-select form-select-lg" name="nuevTarifa" id="nuevTarifa">
                                    <option selected value="1">Gratis</option>
                                    <option value="2">Modo Veterano</option></option>
                                    <option value="3">Modo Novato</option>
                                </select>
                                <p class="text-light" >*Ten en cuenta, que el pago se realiza de forma anual automáticamente*</p>
                            </div>
                            <button type="submit" class="btn btn-success" name="nuevPagar">Pagar</button>
                            <a href="MenuGimnasio.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </section>
            </article>
        </main>
    </body>
</html>

        