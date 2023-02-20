<?php 
include "./includes/loginDatos.php";


$con->query("CREATE TABLE RECUPERAR (ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL, EMAIL VARCHAR(30) NOT NULL, TOKEN VARCHAR(40) NOT NULL, CODIGO INT NOT NULL, FECHA DATE)");
if(isset($_REQUEST['email']) && isset($_REQUEST['token'])){
    $email=$_REQUEST['email'];
    $token=$_REQUEST['token'];

    $cons=$con->query("SELECT * FROM RECUPERAR WHERE EMAIL='$email' AND TOKEN='$token'");
    if(mysqli_num_rows($cons)!=0){
        $con->query("UPDATE USUARIOS SET ACTIVADO='S' WHERE EMAIL='$email'");
        $con->query("DELETE FROM RECUPERAR WHERE EMAIL='$email' AND TOKEN='$token'");
    }

    
        echo "Tu usuario ha sido activado, ya puedes hacer login";
        ?>
            <a href="index.php">Inicio</a>
        <?
}else{

    
    
    $email=$_REQUEST['email'];
    $bytes = random_bytes(5);
    $token =bin2hex($bytes);
    // Varios destinatarios
    $para  =$email; // atención a la coma
    //$para .= 'wez@example.com';
    //echo $para;
    // título
    $título = 'Validar usuario GymD';
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
    <p>Pulse sobre el enlace para activar su usuario</p>
    <p> Haga click <a 
    href="http://localhost/proyecto/ValidaUsuario.php?email='.$email.'&token='.$token.'"> 
    aqui</a> para activar su usuario y empezar a disfrutar de los servicios del gym.</p>
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

}
?>