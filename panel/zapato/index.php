<?php
session_start();
require 'funciones.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Varishop</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
            <a class="navbar-brand" href="../dashboard.php">Varishop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
            <li>
                <a href="../pedidos/index.php" class="btn">Pedidos</a>
            </li> 
            <li class="active">
                <a href="index.php" class="btn">Zapatos</a>
            </li> 
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Salir</a></li>
                </ul>
            </li>
        </ul>
        </div><!--/.nav-collapse -->
    </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <?php
            #arreglar esto
            #require 'vendor/autoload.php';
            #$Zapatos = new varishop\Zapatos;
            #$info_peliculas = $pelicula->mostrar();
            #$cantidad = count($info_peliculas);
            if($cantidad > 0){
                for($x =0; $x < $cantidad; $x++){
                $item = $info_peliculas[$x];
            ?>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h1 class="text-center titulo-pelicula"><?php print $item['titulo'] ?></h1>  
                    </div>
                    <div class="panel-body">
                    <?php
                        $foto = 'upload/'.$item['foto'];
                        if(file_exists($foto)){
                        ?>
                        <img src="<?php print $foto; ?>" class="img-responsive">
                    <?php }else{?>
                        <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                    <?php }?>
                    </div>
                    <div class="panel-footer">
                        <a href="carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Comprar
                        </a>
                    </div>
                </div>

            </div>
        <?php
                }
            }else{?>
            <h4>NO HAY REGISTROS</h4>

        <?php }?>

        </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

</body>
</html>
