<?php

require "./includes/loginDatos.php";
require "./includes/comprobarSesion.php";

//print_r($_REQUEST);

if(isset($_REQUEST["id"])){
    $rutina=$_REQUEST['id'];

    $consulta=$con->query("SELECT * FROM RUTINAS WHERE ID_RUTINA='$rutina'");
    $consulta=$consulta->fetch_assoc();
    //print_r($consulta);
    
}
//if(isset($_))
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Rutina</title>
</head>

<body class="usuario">
  <div class="HeaderUsuario">
    <a href="index.php">GymBd</a>
  </div>
  <div class="d-flex justify-content-center align-items-center container">
      <div class="capa2"> 
      <div class="card">
        <div class="card-body">
          <iframe width="840" height="540" src="<?php echo $consulta['URL']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          <h2 class="card-title"><?php echo $consulta['NOMBRE']?></h2>
          <p class="card-text"><?php echo $consulta['DESCRIPCION']?></p>
          <div>
            <a href="MenuGimnasio.php"  class="btn btn-secondary">Regresar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<!--https://www.youtube.com/embed/BpmWsGK8ESA-->