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
    <title>Varishop</title>
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
                <a class="navbar-brand" href="index.php">Varishop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="../pedidos/index.php" class="btn">Pedidos</a>
                    </li> 
                    <li>
                        <a href="../zapato/index.php" class="btn">Zapatos</a>
                    </li> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="#">Salir</a></li>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <?php
            #require 'vendor/autoload.php';
            #$Zapatos = new varishop\Zapatos;
            #$info_peliculas = $pelicula->mostrar();
            #$cantidad = count($info_peliculas);
            if($cantidad > 0){
                for($x = 0; $x < $cantidad; $x++){
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
                        <?php } else { ?>
                        <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                        <?php } ?>
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
            } else {
            ?>
            <h4>NO HAY REGISTROS</h4>
            <?php } ?>
        </div>

        <!-- Formulario de Productos -->

        <div class="container" id="main">
            <div class="row">
            <div class="col-md-5">
                <fieldset>
                    <legend>Registrar datos del zapto</legend>
                    <form action="../acciones.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="Nombre" placeholder="Ingrese el nombre del zapato" required>
                        </div>
                        <div class="form-group">
                            <label>Talla</label>
                            <input type="number" class="form-control" name="Talla" placeholder="Ingrese la talla del zapato" required>
                        </div>
                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" class="form-control" name="Marca" placeholder="Ingrese la marca del zapato" required>
                        </div>
                        <div class="form-group">
                            <label>Características</label>
                                <select class="form-control" name="Categoria_id" required>
                                <option value="0">---Seleccione---</option>
                                <option value="1">Zapatos formales</option>
                                <option value="2">Tenis deportivos</option>
                                <option value="3">Zapatos casuales</option>
                                <!-- Opciones adicionales aquí -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="Foto" required>
                        </div>
                        <div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" class="form-control" name="Precio" placeholder="0.000 COP" required>
                            </div>
                        </div>
                        <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
                        <a href="index.php" class="btn btn-primary">Cancelar</a>
                    </form>
                </fieldset>
            </div>
            </div>
        </div>
    </div> 


    <!-- Bootstrap core JavaScript -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

</body>
</html>
