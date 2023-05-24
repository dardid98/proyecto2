<?php 
include "../../includes/loginDatos.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "../../includes/credencialesMail.php";

require $_SERVER['DOCUMENT_ROOT'] . '/proyecto2/public_html/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto2/public_html/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto2/public_html/mail/SMTP.php';

echo "Hol";

if(isset($_REQUEST['restablecer'])){
    $email=$_REQUEST['email'];
    $consulta=$con->query("SELECT * FROM USUARIOS WHERE EMAIL ='$email'");
    if(mysqli_num_rows($consulta)==0){
        //echo "ciao";
        header("recuperar.php");
        
    }
    else{
        $mail = new PHPMailer;
        $mail->isSMTP(); 
        
        $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 587; // TLS only
        $mail->SMTPSecure = 'tls'; // ssl is deprecated
        $mail->SMTPAuth = true;
        $mail->Username = $correo; // email
        $mail->Password = $passw; // password
        $mail->setFrom('system@cksoftwares.com', 'GymBd Systems'); // From email and name
        $mail->addAddress('to@address.com', 'Cliente'); // to email and name
        $mail->Subject = 'Registro en GymD';
        $mail->msgHTML("Confirme su Registro"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
        // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->addAddress($_REQUEST['email']);
        $email=$_REQUEST['email'];
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
        $mail->msgHtml('
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
                href="http://localhost/proyecto2/public_html/recuperar/restablecer.php?email='.$email.'&token='.$token.'"> 
                para restablecer su password, haga clic aqui</a> </p>
                <p>Este Código caducará en 5 minutos</p>
            <p> <small>Si no solicitaste este codigo, ignora este mensaje</small> </p>
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
        $enviado =false;
        if(!$mail->send()){
        $enviado=true;
        echo "Hola";
        }
        else{
        $con->query(" INSERT INTO RECUPERAR VALUES(DEFAULT,'$email','$token','$codigo',DEFAULT) ") or die($con->error);
            echo 'Verifica tu email para restablecer la contraseña de tu cuenta';
        }
        

    }
}





?>