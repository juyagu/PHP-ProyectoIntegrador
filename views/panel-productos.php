<?php 
require_once("../BD/conexion.php");

$stmt = $db->query("select prd_id,prd_nombre,prd_descripcion,prd_precio,prd_foto1 from productos");
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once('../conf.inc.php');
include(ROOT_PATH . '/Proyecto/main.php');
?>
<div class="container-fluid main">
    <h1>Panel de Control - Proyecto Integrador</h1>

            <div class="panel panel-info">
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
                                <button type="button" class="btn btn-info" aria-label="Left Align" onclick="nuevoProducto();">
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
                            <?php } ?>
                        </tbody>
                  </table>
            </div>
        <input type="hidden" name="mensaje" id="mensaje" value="<?php echo isset($_GET['mensaje']) ?$_GET['mensaje'] : "" ?>">
        </div>
