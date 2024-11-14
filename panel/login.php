<?php
session_start();
require 'funciones.php';

$error = false; // Variable para indicar si hay un error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Contrasenia'];

    // Conexión a la base de datos
    $conn = new PDO("mysql:host=localhost;dbname=varishop", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si el usuario existe
    $stmt = $conn->prepare("SELECT * FROM cliente WHERE Email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password == $user['Contrasenia']) { // Comparación directa de contraseñas
        // Iniciar sesión y guardar datos del usuario en sesión
        $_SESSION['user_id'] = $user['id']; // Cambia 'id' por el nombre real de la columna de ID en tu tabla
        $_SESSION['user_nombre'] = $user['Nombre'];
        $_SESSION['user_rol'] = $user['rol']; // Guardamos el rol del usuario

        // Redirigir dependiendo del rol
        if ($user['rol'] == 'admin') {
            header("Location: zapato/index.php");// Redirige a la página de administradores
        } else {
            header("Location: ../index.php"); // Redirige a la página de clientes
        }
        exit();
    } else {
        $error = true; // Si las credenciales son incorrectas, activar el error
    }
}
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
                            <label for="nombre_usuario">Usuario</label>
                            <input type="text" class="form-control" name="Email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="Contrasenia" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>

                        <?php if ($error): ?>
                            <div class="alert alert-danger text-center" style="margin-top: 15px;">
                                <strong>Error:</strong> Email o contraseña incorrectos. Por favor intenta de nuevo.
                            </div>
                        <?php endif; ?>

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
