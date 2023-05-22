<?php
include "../includes/crearTablas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio GymD</title>
    <script src="index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
            <nav>
                <a href="index.php">GymBD</a>
            </nav>
    </header>
    <nav>
        <a href="login.html">¡Inicia Sesión!</a>

        <a href="registro.html">¡Empieza ya!</a>
        
        <a href="tarifas.html">¡Consulta nuestros precios!</a>
        
    </nav>
    <main>
        <section>
            <h1><span class="mini">a </span><span class="dest2"> ¿</span>Preparado para <span class="dest">hacer </span>el <span class="dest">cambio</span><span class="dest2">?</span></h1>
        </section>
        <section class="wrapper">
      
            <div class="image-container"><!--contenedor imágenes-->
                <i class="fa-solid fa-arrow-left button" id="prev"></i> <!--flecha izquierda-->
                <div class="carousel"><!--carrusel de imágenes-->
                    <img src="https://www.triathlete.com/wp-content/uploads/sites/4/2019/02/gymequipment.jpg" alt="Imagen 1">
                    <img src="http://cdn2.melodijolola.com/media/files/field/image/gim3.jpg" alt="Imagen 2">
                    <img src="https://i.pinimg.com/originals/e8/1a/56/e81a56bd03fe1b486f2fb2234caa9b18.jpg" alt="Imagen 3">
                    <img src="https://i.blogs.es/16b5b3/victor-freitas-570027-unsplash/1024_2000.jpg" alt="Imagen 4">
                </div>
                <i class="fa-solid fa-arrow-right button" id="next"></i><!--flecha derecha-->
            </div>
        </section>
    </main>

    <footer id="cookies" class="cookies">
        <p>Hacemos uso de cookies propias para el correcto funcionamiento de la web. Al seguir navegando entendemos que acepta nuestra Política de Cookies</p>
        <button type="button" name="aceptar" id="aceptar">Aceptar</button>
    </footer>
</body>
</html>

