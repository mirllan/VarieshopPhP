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
    <meta name="description" content="">
    <meta name="author" content="">

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
                    <!-- AQUI VA  EL APARTADO DE LOS PEDIDOS PARA EL FUTURO-->
                    <li class="active">
                        <a href="index.php" class="btn">Zapatos</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Admin<span class="caret"></span>
                        </a>
                    <ul class="dropdown-menu">
                    <!-- Enlace para hacer logout y redirigir al login -->
                    <li><a href="../logout.php">Salir</a></li>
                    </ul>
                </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <a href="form_registrar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Listado de zapatos</legend>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Categoria</th>
                                <th>Precio</th>
                                <th class="text-center">Foto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require '../../vendor/autoload.php';
                                $Zapatos = new varishop\Zapatos;
                                $info_zapatos = $Zapatos->mostrar();
                                $cantidad = count($info_zapatos);
                                if($cantidad > 0){
                                    $contador=0;
                                    for($x = 0; $x < $cantidad; $x++){
                                        $contador++;
                                        $item = $info_zapatos[$x];
                            ?>

                            <tr>
                                <td><?php print $contador ?></td>
                                <td><?php print $item['Nombre'] ?></td>
                                <td><?php print $item['Marca'] ?></td>
                                <td><?php print $item['NombreCategoria'] ?></td>
                                <td><?php print $item['Precio'] ?></td>
                                <td>
                                <?php
                                    $Foto = '../../upload/'.$item['Foto'];
                                    if(file_exists($Foto)){
                                ?>
                                <img src="<?php print $Foto ?>" width="50">
                                <?php
                                    } else{
                                ?>
                                SIN FOTO
                                <?php
                                    }
                                ?>
                                </td>
                                <td>
                                <a href="form_eliminar.php?Id=<?php echo $item['Id']; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                                    <a href="form_actualizar.php?Id=<?php print $item['Id'] ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                            </tr>
                            <?php
                                }
                                }else{
                            ?>
                            <tr>
                                
                                <td colspan="7">No hay registros</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

</body>
</html>
