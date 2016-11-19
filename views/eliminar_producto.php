<?php 
require_once('../conf.inc.php');
include(ROOT_PATH . '/Proyecto/main.php');
$idProducto = $_GET['id'];
$queryConsultar = $db->prepare("select p.prd_nombre,p.prd_descripcion,p.prd_precio,p.prd_foto1,c.cat_nombre
from productos p,categorias c
where p.cat_id = c.cat_id
and prd_id = ?");
$queryConsultar->execute(array($idProducto));
$producto = $queryConsultar->fetch(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <h1>Panel de Control - Confirmación de baja de Producto</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Se eliminará el siguiente registro:</b></div>
                <form class="form-horizontal" action="" method="eliminar">
                <div class="panel-body">
                    <div class="form-group" >
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="prd_nombre" value="<?= $producto['prd_nombre'] ?>" disabled="">          
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="prd_descripcion" disabled=""><?= $producto['prd_descripcion'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Precio:</label>
                            <div class="col-sm-10">
                                <input type="text" name="prd_precio" class="form-control" readonly="" value="<?= $producto['prd_precio'] ?>">

                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Categoria:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="prd_categoria" disabled="" value="<?= $producto['cat_nombre']; ?>">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Foto 1:</label>
                                <img src="<?php echo '../imagenes/'.$producto['prd_foto1']; ?>" height="120" width="150">
                        </div>
                        <div class="col-md-offset-6">
                            <button class="btn btn-danger" type="button">Eliminar</button>
                            <button class="btn btn-success" type="button" onclick="volverAlPanel();">Volver</button>
                        </div>
                        <input type="hidden" name="accion" value="borrar">
                    </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>