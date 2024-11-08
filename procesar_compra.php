<?php
session_start();

// Vaciar el carrito después de la compra
if (isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = []; // Vaciamos el carrito
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gracias por tu compra - Varishop</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <!-- Contenedor principal -->
    <div class="container" style="margin-top: 70px;">
        <div class="text-center">
            <h1>¡Gracias por tu compra!</h1>
            <p>Tu pedido ha sido procesado exitosamente.</p>
            <a href="index.php" class="btn btn-primary">Seguir Comprando</a>
        </div>
    </div>

    <!-- Scripts de JavaScript de Bootstrap -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
