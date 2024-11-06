<?php
session_start();

// Vaciar el carrito después de la compra
if (isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = []; // Vaciamos el carrito
}

// Redirigir a una página de agradecimiento o confirmación

?>
