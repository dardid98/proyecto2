<?php
    
    include "includes/comprobarSesion.php";

    session_destroy();
    header("location: index.php");


?>