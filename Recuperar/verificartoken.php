<?php 
require "./../includes/loginDatos.php";

date_default_timezone_set("europe/madrid");

if(isset($_REQUEST['cambiar'])){
    echo "has pulsado en cambiar";
    $email=$_REQUEST['email'];
    $p1=$_REQUEST['p1'];
    $p2=$_REQUEST['p2'];
    if($p1==$p2){
        $consulta=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email' ");
        if($consulta->num_rows==0){
            echo "Error";
        }
        }else{
            $con->query("UPDATE USUARIOS SET CONTRASENA='$p1' WHERE EMAIL='$email' ")or die($con->error);
        }
    $con->query("DELETE FROM RECUPERAR WHERE EMAIL='$email'");
    header("location: ../login.html");
}else{
       $email =$_POST['email'];
       $token =$_POST['token'];
       $codigo =$_POST['codigo'];
       $res=$con->query("SELECT * FROM RECUPERAR WHERE 
           EMAIL='$email'AND TOKEN='$token' AND CODIGO=$codigo")or die($con->error);
       $correcto=false;
       if(mysqli_num_rows($res) > 0){
           $fila = mysqli_fetch_row($res);
           /*$fecha =$fila[4];
           print_r($fecha);                     //Para el dani del futuro: el error es que al crear una fecha la hora tiene 30 minutos menos, además, la hroa de la base de datos se crea en 
           $fecha_actual=date("Y-m-d h:m:s");   //formato 1-24h, mientras que la que crea php es de 1-12, así que creo que se le va la olla comparándolas.
           echo ", , ";
           print_r($fecha_actual);
           $fecha_actual=strtotime("+30 minutes",strtotime($fecha_actual));
           //echo " , ";
           //print_r($fecha_actual);
           $seconds = strtotime($fecha_actual) - strtotime($fecha);
           $minutos=$seconds / 60;
           $minutos+=30;
           echo $minutos;*/
           $sirve=true;
           $correcto=true;

       }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar password </title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top:15%">
            <?php if($correcto && $sirve){ ?>
                <form class="col-3" action="" method="POST">
                    <h2>Restablecer Password</h2>
                    <div class="mb-3">
                        <label for="c" class="form-label">Nuevo Password</label>
                        <input type="password" class="form-control" id="c" name="p1">
                    
                    </div>
                    <div class="mb-3">
                        <label for="c" class="form-label">Confirmar Password</label>
                        <input type="password" class="form-control" id="c" name="p2">
                        <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email?>">

                    </div>
                
                    <button type="submit" class="btn btn-primary" name="cambiar">Cambiar</button>
                </form>
            <?php }else{ ?>
                <div class="alert alert-danger" >El código es incorrecto o ha caducado</div>
                <form action="recuperar.html">
                    <button type=submit class="btn btn-primary" name="regresar">Regresar</button>
                </form>
            <?php } ?>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
?>