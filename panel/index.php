<?php
session_start();
// Si no ha iniciado sesión, muestra la página de inicio de sesión
require 'funciones.php';
require '../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Varishop - Acceso</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Varishop</a>
            </div>
        </div>
    </nav>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">
            Usuario o contraseña incorrectos. Por favor intenta de nuevo.
        </div>
    <?php endif; ?>


    <!-- Formulario de inicio de sesión -->
    <div class="container" id="main">
        <div class="main-login">
            <form action="login.php" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center">Acceso al Panel</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                            <img src="../assets/imagenes/logoVarishop.png" alt="Logo de Varishop" width="150" height="150">
                        </p>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="text" class="form-control" name="Email" placeholder="Correo Electrónico" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="Contrasenia" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        
                        <div class="text-center" style="margin-top: 10px;">
                            <a href="registro.php" class="btn btn-link">¿No tienes cuenta aún?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
