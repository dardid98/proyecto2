<?php

include "../includes/loginDatos.php";

include "../includes/crearTablas.php";
session_start();

if(isset($_REQUEST['login'])){
    $email=$_REQUEST['email'];
    $password=$_REQUEST['passwd'];
    
    $consUsu=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");    //Consultamos los usuarios con el email introducido en el login.
    $considUsu=$con->query("SELECT ID FROM USUARIOS WHERE EMAIL='$email'"); //Consultamos el id_usuario de los usuarios.


    $consemaUsu=mysqli_num_rows($consUsu);  //Guardamos todo lo de las filas de Usuarios en las que coincide el email
    $considUsu=mysqli_num_rows($considUsu); //Guardamos los id de los Usuarios con el email
    
    $conscamposUsu=mysqli_fetch_assoc($consUsu);
    
    
    //Si algún email coincide con el de algún usuario de la tabla usuarios entra.
    if($consemaUsu!=0){
        if($considUsu!=0){
            //if($password==$conscamposUsu['CONTRASENA']){
            if(password_verify($password,$conscamposUsu["CONTRASENA"])){
                //echo "La contra coincide";
                $activado=$conscamposUsu['ACTIVADO'];
                if($activado=="N"){
                    echo "Tu usuario aun no ha sido activado, revisa tu correo";
                }else{
                    $_SESSION['datos']= array($email, $password);
                    //print_r($_SESSION['datos']);
                    $cons=$con->query("SELECT TIPO_USUARIO FROM USUARIOS WHERE EMAIL='$email'");
                    $cons=$cons->fetch_assoc();
                    //print_r($cons);
                    if($cons["TIPO_USUARIO"]=="ADMIN"){
                        echo "useradm";
                    }else if($cons['TIPO_USUARIO']=="USUARIO"){
                        echo "usergim";
                    }else if($cons['TIPO_USUARIO']=='ENTRENADOR'){
                        echo "usermon";
                    }
                }
            }else{
                echo "Contraseña incorrecta";
            }
        }
    }
    else{
        echo "Has introducido mal tu email";
    }
    
}

if(isset($_REQUEST['Tarifas'])){
    echo "tarifa";
}



if(isset($_REQUEST['registro'])){
    //print_r($_REQUEST);
    //echo "no";
    $email=$_REQUEST['email'];
    $passwd=$_REQUEST['passwd'];
    
    include "ValidaUsuario.php";

    $imc=$_REQUEST['peso'] / ($_REQUEST['altura'] * $_REQUEST['altura']);
                
    if($imc<18.5) {
        $imc=1;
    }else if($imc>=18.5 && $imc<=24.9){
        $imc=2;
    }else if($imc>=25 && $imc<=29.9) {
        $imc=3;
    }else if($imc>=30){
        $imc=4;
    }


    //print_r($_REQUEST);
    //echo "hola";
    $tarifa=$_REQUEST['tarifas'];
    $nom_usr=$_REQUEST['nom_usr'];
    $passwd=password_hash($passwd,PASSWORD_DEFAULT);
    $fecha=date_create();
    date_add($fecha, date_interval_create_from_date_string("12 month"));

    $fecha=$fecha->format('Y-m-d H:i:s');
    //print_r($fecha);


    //$passwd=password_hash($_REQUEST['passwd'],PASSWORD_DEFAULT);
    $numcont=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
    $numcont=$numcont->num_rows;
    if($numcont==0){

        if($con->query("INSERT INTO USUARIOS VALUES (DEFAULT,'$email','$passwd','$nom_usr','$imc','N','$tarifa','N','USUARIO',DEFAULT, '$fecha')")){
            $enviado =false;
            if(!$mail->send()){
                //echo "Mailer Error: " . $mail->ErrorInfo;
                //$enviado=false;
                echo $respuesta="error";
            }else{
                //echo "Message sent!";
                $enviado=true;
                $con->query("insert into RECUPERAR(email, token, codigo) values('$email','$token','$codigo') ") or die($con->error);
                switch($tarifa){
                    case "1": header("location: index.php"); break;
                    case "2": header("location: pago.php?tarifa=2"); break;
                    case "3": header("location: pago.php?tarifa=3"); break;
                    default: "El correo introducido ya existe en nuestra base de datos, pruebe con otro o recupere su contrasena desde el login";
                }
                
                //echo $respuesta="b";
            }
        }
    
        $cons=$con->query("SELECT ID FROM USUARIOS WHERE EMAIL='$email' AND CONTRASENA='$passwd' AND NOM_USR='$nom_usr'");
        $cons=$cons->fetch_assoc();
        $cons=$cons['ID'];
    
        $_SESSION['ID']=$cons;
        //echo "hola";
    }else{
        $respuesta= "Este correo ya está registrado en nuestra base de datos, introduzca otro o recupere su contraseña desde login";
        //echo $respuesta;
    }

    
}
?>