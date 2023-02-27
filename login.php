<?php

include "./includes/loginDatos.php";
include "./ValidaUsuario.php";
include "./includes/crearTablas.php";
session_start();

/*
Explicación para tontos (o sea para dani): esto es el login full php, está calcao de la aplicación que hiciste, el problema es que necesitamos que la aplicación sepa que has iniciado sesión con el usuario que toca,
y creo que la mejor opción es crear una sesión que guarde usuario y contraseña, y cada vez que cambias de página comprueba el usuario y la contraseña de la sesión para saber si puedes acceder al sitio en el que te encuentras
o no.)
*/

if(isset($_REQUEST['login'])){
    $email=$_REQUEST['email'];
    $password=$_REQUEST['passwd'];
    
    $consUsu=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");    //Consultamos los usuarios con el email introducido en el login.
    $considUsu=$con->query("SELECT ID FROM USUARIOS WHERE EMAIL='$email'"); //Consultamos el id_usuario de los usuarios.


    $consemaUsu=mysqli_num_rows($consUsu);  //Guardamos todo lo de las filas de Usuarios en las que coincide el email
    $considUsu=mysqli_num_rows($considUsu); //Guardamos los id de los Usuarios con el emai l
    
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
    $email=$_REQUEST['email'];
    //echo "hola";
    $passwd=$_REQUEST['passwd'];
    $imc=$_REQUEST['imc'];
    $tarifa=$_REQUEST['TarifaSeleccionada'];
    $nom_usr=$_REQUEST['nom_usr'];
    $passwd=password_hash($passwd,PASSWORD_DEFAULT);


    //$passwd=password_hash($_REQUEST['passwd'],PASSWORD_DEFAULT);
    $numcont=$con->query("SELECT * FROM USUARIOS WHERE EMAIL='$email'");
    $numcont=$numcont->num_rows;
    if($numcont==0){

        if($con->query("INSERT INTO USUARIOS VALUES (DEFAULT,'$email','$passwd','$nom_usr','$imc','N','$tarifa','N','USUARIO', DEFAULT, DEFAULT)")){
            $enviado =false;
            if(mail($para, $título, $mensaje, $cabeceras)){
                $enviado=true;
            }
            $respuesta="b";
            echo $respuesta=json_encode($respuesta);
            
            /*if($enviado){
                $con->query("insert into RECUPERAR(email, token, codigo) 
                values('$email','$token','$codigo') ") or die($con->error);
                $return= 'Verifica tu email para restablecer la contraseña de tu cuenta';
      
            }*/
        }
        $cons=$con->query("SELECT ID FROM USUARIOS WHERE EMAIL='$email' AND CONTRASENA='$passwd' AND NOM_USR='$nom_usr'");
        $cons=$cons->fetch_assoc();
        $cons=$cons['ID'];
    
        $_SESSION['ID']=$cons;
    }else{
        $respuesta= "Este correo ya está registrado en nustra base de datos, introduzca otro o recupere su contraseña desde login";
        $respuesta=json_encode($respuesta);
        echo $respuesta;
    }

    
}
?>