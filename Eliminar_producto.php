<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Eliminar el producto del carrito si existe
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
}

// Redirigir de nuevo al carrito
header("Location: carrito.php");
exit();
?>
