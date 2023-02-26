<?php 
require "./../includes/loginDatos.php";

date_default_timezone_set("europe/madrid");
if(!isset($_REQUEST['email'])||!isset($_REQUEST['token'])||!isset($_REQUEST['codigo']) ){
    header("location: ../index.php");
}else if(isset($_REQUEST['cambiar'])){
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
       $email =$_REQUEST['email'];
       $token =$_REQUEST['token'];
       $codigo =$_REQUEST['codigo'];
       $res=$con->query("SELECT * FROM RECUPERAR WHERE 
           EMAIL='$email'AND TOKEN='$token' AND CODIGO=$codigo")or die($con->error);
       $correcto=false;
       if(mysqli_num_rows($res) > 0){

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="recuperar">
    <div class="capa1">
        <a href="../index.php">GymBd</a>
    </div>
        <div class="d-flex justify-content-center align-items-center container">
            <?php if($correcto && $sirve){ ?>
                <form class="col-3" action="" method="POST">
                    <div class="capa2">
                        <h2 class="text-danger">Restablecer Contraseña</h2>
                        <div class="mb-3">
                            <label for="c" class="form-label text-danger">Contraseña Nueva: </label>
                            <input type="password" class="form-control" id="c" name="p1">
                        
                        </div>
                        <div class="mb-3">
                            <label for="c2" class="form-label text-danger">Confirmar Contraseña: </label>
                            <input type="password" class="form-control" id="c2" name="p2">
                            <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email?>">

                        </div>
                    
                        <button type="submit" class="btn btn-primary" name="cambiar">Cambiar</button>
                    </div>
                </form>
            <?php }else{ ?>
                <div class="alert alert-danger" >El código es incorrecto</div>
                <form action="recuperar.html">
                    <button type=submit class="btn btn-primary" name="regresar">Regresar</button>
                </form>
            <?php } ?>

        </div>
    </div>

</body>
</html>
<?php
}
?>