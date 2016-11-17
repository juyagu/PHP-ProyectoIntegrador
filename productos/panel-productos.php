<?php 
require_once("../BD/conexion.php");

$stmt = $db->query("select prd_id,prd_nombre,prd_descripcion,prd_precio,prd_foto1 from productos");
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>

<html class="no-js" lang=""> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/main.css">

        <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">
    </head>
    <body>

        <div class="container-fluid">
            <div id="top"><img src="../imagenes/top.png" alt="encabezado" width="980" height="80"></div>
            <?php require_once '../menu.php'; ?>

            <h1>Panel de Control - Proyecto Integrador</h1>

            <div class="panel panel-info">
              <!-- Default panel contents -->
                  <div class="panel-heading">Listado de productos</div>
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th></th>
                            <th>
                                <button type="button" class="btn btn-info" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultado as $producto){ ?>
                            <tr>
                                <td><?php echo $producto['prd_nombre']; ?></td>
                                <td><?= $producto['prd_descripcion'] ?></td>
                                <td>$<?= $producto['prd_precio'] ?></td>
                                <td><img src="../imagenes/<?= $producto['prd_foto1'] ?>"></td>
                                <td><button type="button" class="btn btn-success" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>
                                </td>
                                <td><button type="button" class="btn btn-danger" aria-label="Left Align" id="<?php echo  $producto['prd_id'];?>">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                                </td>
                            </tr>
                            <input type="hidden" id="idProducto" value="<?php echo $producto['prd_id']; ?>">
                            <?php } ?>
                        </tbody>
                  </table>
            </div>

        </div>
        <div id="pie">
            <?php require_once("../views/pie.php") ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>

        <script src="../js/main.js"></script>

    </body>
</html>
