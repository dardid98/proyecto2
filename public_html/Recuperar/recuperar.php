<?php 
include "../includes/loginDatos.php";

if(isset($_REQUEST['restablecer'])){
    $email=$_REQUEST['email'];
    $consulta=$con->query("SELECT * FROM USUARIOS WHERE EMAIL ='$email'");
    if(mysqli_num_rows($consulta)==0){
        $respuesta= "no";
        echo json_encode($respuesta);
    }
    else{
        $respuesta= "si";
        echo json_encode($respuesta);
    }
}

else if(isset($_REQUEST['enviar'])){


$email = $_REQUEST['email'];
$bytes = random_bytes(5);
$token =bin2hex($bytes);
// Varios destinatarios
$para  =$email; // atención a la coma
//$para .= 'wez@example.com';
//echo $para;
// título
$título = 'Restablecer contraseña GymD';
$codigo= rand(1000,9999);


// mensaje
$mensaje = '
<html>
<head>
  <title>Restablecer</title>
</head>
<body>
    <h1>GymD</h1>
    <div style="text-align:center; background-color:#ccc">
        <p>Código para restablecer su passwd</p>
        <h3>'.$codigo.'</h3>
        <p> <a 
            href="http://localhost/recuperar/restablecer.php?email='.$email.'&token='.$token.'"> 
            para restablecer su password, haga clic aqui</a> </p>
            <p>Este Código caducará en 5 minutos</p>
        <p> <small>Si no solicitaste este codigo, ignora este mensaje</small> </p>
    </div>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
/*
// Cabeceras adicionales
$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
*/
// Enviarlo
$enviado =false;
if(mail($para, $título, $mensaje, $cabeceras)){
    $enviado=true;
}

if($enviado){
    $con->query(" INSERT INTO RECUPERAR VALUES(DEFAULT,'$email','$token','$codigo',DEFAULT) ") or die($con->error);
        echo 'Verifica tu email para restablecer la contraseña de tu cuenta';
}

}
?>