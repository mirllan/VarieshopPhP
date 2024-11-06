<?php
require 'vendor/autoload.php';
use varishop\Zapatos;

function agregarAlCarrito($id, $cantidad = 1) {
    // Asegúrate de que el carrito existe en la sesión
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Revisa si el producto ya está en el carrito
    foreach ($_SESSION['carrito'] as &$producto) {
        if ($producto['Id'] === $id) {
            // Si el producto ya está, verifica si `cantidad` está definida y, si no, inicialízala
            if (!isset($producto['cantidad'])) {
                $producto['cantidad'] = 0;
            }
            // Incrementa la cantidad
            $producto['cantidad'] += $cantidad;
            return;
        }
    }

    // Si el producto no está en el carrito, búscalo y añádelo
    $zapatos = new Zapatos();
    $producto = $zapatos->mostrarPorId($id);

    if ($producto) {
        $producto['cantidad'] = $cantidad; // Define la cantidad inicial
        $_SESSION['carrito'][] = $producto; // Añade el producto al carrito
    }
}



function obtenerCarrito() {
    return isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
}


function eliminarDelCarrito($id) {
    foreach ($_SESSION['carrito'] as $index => $producto) {
        if ($producto['Id'] === $id) {
            unset($_SESSION['carrito'][$index]);
            // Reindexar el arreglo para evitar problemas
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            break;
        }
    }
}

function actualizarZapatos($Id, $cantidad = FALSE) {
    if ($cantidad) {
        $_SESSION['carrito'][$Id]['cantidad'] = $cantidad;
    } else {
        $_SESSION['carrito'][$Id]['cantidad'] += 1;
    }
}

function calcularTotal() {
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $indice => $value) {
            // Verificar si 'cantidad' está definida para evitar el error
            $cantidad = isset($value['cantidad']) ? $value['cantidad'] : 1; // Si no está definida, asume 1
            $total += $value['Precio'] * $cantidad;
        }
    }
    return $total;
}

function cantidadZapatos() {
    $cantidadTotal = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $indice => $value) {
            // Verificar si 'cantidad' está definida para evitar el error
            $cantidadTotal += isset($value['cantidad']) ? $value['cantidad'] : 1; // Si no está definida, asume 1
        }
    }
    return $cantidadTotal;
}
