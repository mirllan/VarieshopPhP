<?php
session_start();
require 'funciones.php';
$carrito = obtenerCarrito(); // Obtenemos los productos del carrito

// Asegurarse de que $carrito es un array
if (!is_array($carrito)) {
    $carrito = []; // Asignar un array vacío si $carrito no es un array
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de Compras - Varishop</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>
    <!-- Navbar fija en la parte superior -->
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
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li class="active"><a href="carrito.php" class="btn">Pedidos</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container" id="main" style="margin-top: 70px;">
        <h1>Carrito de Compras</h1>
        
        <?php if (count($carrito) > 0): ?>
            <form action="actualizar_carrito.php" method="POST">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalGeneral = 0;
                        foreach ($carrito as $id => $item): 
                            $cantidad = isset($item['Cantidad']) ? $item['Cantidad'] : 1;
                            $subtotal = $cantidad * $item['Precio'];
                            $totalGeneral += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['Nombre']); ?></td>
                                <td>
                                    <input type="number" name="cantidades[<?php echo $id; ?>]" value="<?php echo $cantidad; ?>" min="1" style="width: 60px;">
                                </td>
                                <td>$<?php echo number_format($item['Precio'], 2); ?>0 COP</td>
                                <td>$<?php echo number_format($subtotal, 2); ?>0 COP</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h3>Total de la Compra: $<?php echo number_format($totalGeneral, 2); ?>0 COP</h3>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar Carrito</button>
                    <a href="index.php" class="btn btn-default">Seguir Comprando</a>
                </div>
            </form>

            <form action="procesar_compra.php" method="POST" style="margin-top: 10px;">
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Comprar</button>
                </div>
            </form>
            
        <?php else: ?>
            <p class="text-center">El carrito está vacío.</p>
        <?php endif; ?>
    </div>

    <!-- Scripts de JavaScript de Bootstrap -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
