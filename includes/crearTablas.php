<?php

include "loginDatos.php";

$fecha=date_create();
date_add($fecha, date_interval_create_from_date_string("120 month"));
$fecha=$fecha->format('Y-m-d H:i:s');


if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymd' AND table_name = 'TARIFAS'")){
    $con->query("CREATE TABLE TARIFAS (ID_TARIFA INT AUTO_INCREMENT PRIMARY KEY NOT NULL, PRECIO INT NOT NULL, PLAN_DE_PAGO VARCHAR(10), NOMBRE_TARIFA VARCHAR(10))");
}
if($consTarifas=$con->query("SELECT * FROM TARIFAS")){
    if(mysqli_num_rows($consTarifas)==0){
    $con->query("INSERT INTO TARIFAS VALUES (DEFAULT,0,'no', 'Gratis')");
    $con->query("INSERT INTO TARIFAS VALUES (DEFAULT,60,'Anual', 'Veterano')");
    $con->query("INSERT INTO TARIFAS VALUES (DEFAULT,90,'Anual', 'Novato')");
    }
}
if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymd' AND table_name = 'USUARIOS'")){
    $con->query("CREATE TABLE USUARIOS (ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL, EMAIL VARCHAR(40) NOT NULL, CONTRASENA VARCHAR(200) NOT NULL, RUTA_IMAGEN VARCHAR(100) NOT NULL, NOM_USR varchar(20) NOT NULL, IMCTIPO VARCHAR (1) NOT NULL, ACTIVADO VARCHAR(1) NOT NULL, ID_TARIFA INT NOT NULL, TARIFA_PAGADA VARCHAR(1) NOT NULL, TIPO_USUARIO VARCHAR(10) NOT NULL, FECHA_PAGO TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, FECHA_VENCIMIENTO TIMESTAMP, CONSTRAINT FK_ID_TARIFA FOREIGN KEY(ID_TARIFA) REFERENCES TARIFAS (ID_TARIFA))");
}
$passwd=password_hash("hola",PASSWORD_DEFAULT);
if($consAdm=$con->query("SELECT * FROM USUARIOS WHERE TIPO_USUARIO='ADMIN'")){
    if(mysqli_num_rows($consAdm)==0){
        $con->query("INSERT INTO USUARIOS VALUES (DEFAULT, 'hola@hola', '$passwd','','ADM', '0', 'S', '1', 'S','ADMIN',DEFAULT, DEFAULT)");
        $con->query("INSERT INTO USUARIOS VALUES (DEFAULT, 'hola@hola2', '$passwd','','USER', '0', 'S', '1', 'S','USUARIO', DEFAULT, '$fecha')");
        $con->query("INSERT INTO USUARIOS VALUES (DEFAULT, 'hola@hola3', '$passwd','','TRAIN', '0', 'S', '1', 'S','ENTRENADOR', DEFAULT, '$fecha')");
    }
}
if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymd' AND table_name = 'RUTINAS'")){
    $con->query("CREATE TABLE RUTINAS (ID_RUTINA INT AUTO_INCREMENT PRIMARY KEY NOT NULL, NOMBRE VARCHAR(20) NOT NULL, DURACION INT NOT NULL, DESCRIPCION VARCHAR(400), ID_ENTRENADOR INT NOT NULL, CONSTRAINT FK_ID FOREIGN KEY(ID_ENTRENADOR) REFERENCES USUARIOS(ID))");
}
if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymd' AND table_name = 'REGISTRO_RUTINAS'")){
    $con->query("CREATE TABLE REGISTRO_RUTINAS (ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL ,ID_RUTINA INT NOT NULL, ID_USUARIO INT NOT NULL, COMPLETADA VARCHAR(2) NOT NULL, FECHA_COMPLETADA TIMESTAMP DEFAULT CURRENT_TIMESTAMP, CONSTRAINT FK_ID_USUARIO FOREIGN KEY(ID_USUARIO) REFERENCES USUARIOS(ID), CONSTRAINT FK_ID_RUTINA FOREIGN KEY(ID_RUTINA) REFERENCES RUTINAS(ID_RUTINA))");
}
if($con->query("SELECT * FROM information_schema. tables WHERE table_schema = 'id20260728_gymd' AND table_name = 'RECUPERAR'")){
    $con->query("CREATE TABLE RECUPERAR (ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL, EMAIL VARCHAR(30) NOT NULL, TOKEN VARCHAR(20) NOT NULL, CODIGO INT NOT NULL, FECHA TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP)");
}

?>