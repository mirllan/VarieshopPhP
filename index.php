<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php';
if (!isset($_SESSION['carrito'])) {
  $_SESSION['carrito'] = [];
}
use varishop\Zapatos; // Simplifica el acceso a la clase Zapatos
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Varishop</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/estilos.css">
  
  <!-- Estilos adicionales para asegurar que los botones estén alineados -->
  <style>
    .product-card {
      display: flex;
      flex-direction: column;
      height: 100%; /* Asegura que la tarjeta tenga altura completa */
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    
    .product-image {
      flex-grow: 1; /* La imagen ocupa el espacio disponible */
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      max-height: 250px; /* Limita la altura de la imagen */
    }
    
    .product-footer {
      text-align: center;
      padding: 10px;
      background-color: #f8f8f8;
      border-top: 1px solid #ddd;
    }

    .panel-body {
      padding: 0;
    }
  </style>
</head>

<body>

  <!-- Fixed navbar -->
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
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              User<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Enlace para hacer logout y redirigir al login -->
              <li><a href="panel/logout.php">Salir</a></li>
            </ul>
          </li>

          <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadZapatos(); ?></span></a>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container" id="main">
    <div class="row">
      <?php
        $zapatos = new Zapatos(); // Crear una instancia de la clase Zapatos
        $info_zapatos = $zapatos->mostrar(); // Llamar al método mostrar
        $cantidad = count($info_zapatos);
        $productos_por_fila = 3; // Mostrar 3 productos por fila

        if($cantidad > 0){
            for($x = 0; $x < $cantidad; $x++){
                $item = $info_zapatos[$x];
                // Mostrar un salto de línea cada 3 productos
                if ($x % $productos_por_fila == 0 && $x != 0) {
                    echo '</div><div class="row">'; // Salto de línea cada 3 productos
                }
      ?>
      <div class="col-md-4">
        <div class="product-card">
          <div class="panel-heading">
            <h4 class="text-center Nombre-zapatos"><?php print $item['Nombre']; ?></h4>
          </div>
          <div class="panel-body product-image">
            <?php
              $Foto = 'upload/'.$item['Foto'];
              if(file_exists($Foto)){
            ?>
            <img src="<?php print $Foto ?>" class="img-responsive" style="max-width: 100%; max-height: 200px;">
            <?php
              } else{
            ?>
            SIN FOTO
            <?php
              }
            ?>
          </div>
          <div class="panel-footer product-footer">
            <a href="agregar_al_carrito.php?id=<?php echo $item['Id']; ?>&nombre=<?php echo urlencode($item['Nombre']); ?>&precio=<?php echo $item['Precio']; ?>" class="btn btn-success btn-block">
              <span class="glyphicon glyphicon-shopping-cart"></span> Agregar al carrito
            </a>
          </div>
        </div>
      </div>
      <?php
        }
        } else {
      ?>
      <h4>Aún no hay artículos</h4>
      <?php
        }
      ?>
    </div> <!-- /row -->
  </div> <!-- /container -->

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
