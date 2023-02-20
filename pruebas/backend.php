<?php
// Si esta definido el archivo

if( $_POST ){
    foreach ($_POST as $key => $value) {
        echo $key.': <br />'.$value.'<br />';
    }
}