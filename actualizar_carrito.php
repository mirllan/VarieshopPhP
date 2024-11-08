<?php
session_start();

if (isset($_POST['cantidades'])) {
    foreach ($_POST['cantidades'] as $id => $cantidad) {
        $cantidad = (int)$cantidad;
        if ($cantidad > 0 && isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['Cantidad'] = $cantidad;
        }
    }
}

header("Location: carrito.php");
exit();
?>
