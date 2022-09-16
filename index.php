<?php
    session_start();
    if ($_POST) {
        include("config/conexionBD.php");
        $Usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";
        $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios WHERE nombre=:usuario");
        $sentenciaSQL->bindParam(':usuario', $Usuario);
        $sentenciaSQL->execute();
        $dato=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $bdNombre=(isset($dato["nombre"]))?$dato["nombre"]:"";
        $bdClave=(isset($dato["clave"]))?$dato["clave"]:"";
        $bdNivel=(isset($dato["nivel"]))?$dato["nivel"]:"";
        if (($_POST["usuario"]==$bdNombre) && (password_verify($_POST["clave"], $bdClave)) && (($bdNivel=="0") || ($bdNivel=="1"))) {
            $_SESSION["usuario"]="ok";
            $_SESSION["nombreUsuario"]=$bdNombre;
            header("Location:administrador");
        }
        else {
            $mensaje = "Error: nombre de usuario o contraseña inválido.";
        } 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Instituto 87 </title>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./index.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Instituto 87</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="row">


    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            <br/><br/><br/>
                <div class="card">
                    <div class="card-header">
                        Ingreso al sistema:
                    </div>
                    <div class="card-body">
                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>
                        <form method="POST">
                            <div class = "form-group">
                                <label for="exampleInputEmail1">Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Introduzca el nombre de usuario">
                            </div>
                            <br/><br/>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input type="password" class="form-control" name="clave" placeholder="Intruduzca la contraseña">
                            </div>
                            <br/><br/>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    </div>

</body>
</html>