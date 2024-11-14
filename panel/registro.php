<?php
session_start();
require 'funciones.php';
require '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Varishop - Registro</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Varishop</a>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="main-login">
        <form action="procesar_registro.php" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Crea tu Cuenta</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" class="form-control" name="Nombre" required>
        </div>
            <div class="form-group">
                <label for="Apellidos">Apellidos</label>
                <input type="text" class="form-control" name="Apellidos" required>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" name="Email" required>
            </div>
            <div class="form-group">
                <label for="Telefono">Teléfono</label>
                <input type="text" class="form-control" name="Telefono" required>
            </div>
            <div class="form-group">
                <label for="Direccion">Direccion</label>
                <input type="text" class="form-control" name="Direccion" required>
            </div>
            <div class="form-group">
                <label for="Contrasenia">Contraseña</label>
                <input type="password" class="form-control" name="Contrasenia" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </div>
    </div>
    </form>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
