<?php

require_once('../conf.inc.php');
if (!$_SESSION['login']) {
    header("Location: ../index.php");
    exit;
}
$stmt = $db->query("select prd_id,prd_nombre,prd_descripcion,prd_precio,prd_foto1 from productos");
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once(ROOT_PATH . '/proyecto/views/cabecera.php'); ?>
<div class="container-fluid main">
    <h1>Panel de Control - Proyecto Integrador</h1>
    <?php if(isset($_SESSION['mensaje'])){ ?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $_SESSION['mensaje']; ?>
</div>
    <?php 
        unset($_SESSION['mensaje']);
    }
    ?>
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
                        <?php if($_SESSION['perfil'] == 'Administrador'){ ?>
                        <button type="button" class="btn btn-info" aria-label="Left Align" onclick="nuevoProducto();">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                        <?php } ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $producto) { ?>
                    <tr>
                        <td><?php echo $producto['prd_nombre']; ?></td>
                        <td><?= $producto['prd_descripcion'] ?></td>
                        <td>$<?= $producto['prd_precio'] ?></td>
                        <td><img src="../imagenes/<?= $producto['prd_foto1'] ?>" width="200" height="150"></td>
                        <td>
                            <?php if($_SESSION['perfil'] == 'Administrador'){ ?>
                            <button type="button" class="btn btn-success" aria-label="Left Align" onclick="modificarProducto(<?php echo $producto['prd_id'];?>)">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </button>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($_SESSION['perfil'] == 'Administrador'){ ?>
                            <button type="button" class="btn btn-danger" aria-label="Left Align" id="<?php echo $producto['prd_id']; ?>" onclick="eliminarProducto(<?php echo $producto['prd_id'];?>)">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="mensaje" id="mensaje" value="<?php echo isset($_GET['mensaje']) ? $_GET['mensaje'] : "" ?>">
</div>
<?php require_once(ROOT_PATH . '/proyecto/views/footer.php'); ?>