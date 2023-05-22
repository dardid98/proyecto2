<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "../includes/credencialesMail.php";

require $_SERVER['DOCUMENT_ROOT'] . '/proyecto2/public_html/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto2/public_html/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto2/public_html/mail/SMTP.php';

/*require "<league>oauth2-google";

use League\OAuth2\Client\Provider\Google;
$provider = new Google([
    'clientId'     => '{506213751306-dvrkvgn8kq1t6gc7nc1t0feoivfa3062.apps.googleusercontent.com}',
    'clientSecret' => '{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}',
]);
*/

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
