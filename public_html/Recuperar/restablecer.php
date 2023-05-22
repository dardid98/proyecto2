<?php 
if( isset($_GET['email'])  && isset($_GET['token']) ){
    $email=$_GET['email'];
    $token=$_GET['token'];
}else{
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer </title>
    <link rel="stylesheet" href="../css/estilos.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="recuperar">
    <div class="capa1">
        <a href="../index.php">GymBd</a>
    </div>
    <div class="d-flex justify-content-center align-items-center container">
        <form action="verificartoken.php" method="POST">
            <div class="capa2">
                <div class="mb-3">
                    <h2 class="text-danger">Restablecer Password</h2>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend ">
                        <label class="input-group-text" for="codigo">Codigo</label>
                    </div>
                    <input type="number" class="form-control" id="codigo" name="codigo">
                </div>
                <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email;?>">
                <input type="hidden" class="form-control" id="c" name="token" value="<?php echo $token;?>">
                <button type="submit" class="btn btn-primary">Restablecer</button>
            </div>
            
        </form>
    </div>
</body>
</html>