<?php 
include "../includes/loginDatos.php";
include "mail.php";

if(isset($_REQUEST['email']) && isset($_REQUEST['token'])){
    $email=$_REQUEST['email'];
    $token=$_REQUEST['token'];
    print_r($_REQUEST);

    $cons=$con->query("SELECT * FROM RECUPERAR WHERE EMAIL='$email' AND TOKEN='$token'");
    //echo $cons->num_rows;
    if(mysqli_num_rows($cons)!=0){
        
        //echo "hola";
        $con->query("UPDATE USUARIOS SET ACTIVADO='S' WHERE EMAIL='$email'");
        $con->query("DELETE FROM RECUPERAR WHERE EMAIL='$email' AND TOKEN='$token'");
    }

    
        echo "Tu usuario ha sido activado, ya puedes hacer login";
        ?>
            <a href="index.php">Inicio</a>
        <?php
}else{

    
    $mail->addAddress($_REQUEST['email'],$_REQUEST['nom_usr']);
    $email=$_REQUEST['email'];
    $bytes = random_bytes(5);
    $token =bin2hex($bytes);
    // Varios destinatarios
    //$para  =$email; // atención a la coma
    //$para .= 'wez@example.com';
    //echo $para;
    // título
    $título = 'Validar usuario GymD';
    $codigo= rand(1000,9999);
    $enlace="http://localhost/proyecto2/public_html/ValidaUsuario.php?email=$email&token=$token";
    $enlaceRemoto="https://gymd99.000webhostapp.com/ValidaUsuario.php?email=$email&token=$token";    
    // mensaje
    //$mensaje = '
    $mail->msgHtml('
    <html>
    <head>
    <title>Recuperar</title>
    </head>
    <body>
    <h1>GymD</h1>
    <div style="text-align:center; background-color:#ccc">
    <p>Pulse sobre el enlace para activar su usuario</p>
    <p> Haga click <a 
    href='.$enlaceRemoto.'> 
    aqui</a> para activar su usuario y empezar a disfrutar de los servicios del gym.</p>
    </div>
    </body>
    </html>
    ');
    
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