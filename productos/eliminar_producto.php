<?php 
require_once('../conf.inc.php');
if (!$_SESSION['login']) {
    header("Location: ../index.php");
    exit;
}
if($_SESSION['perfil'] != 'Administrador'){
    header("Location: ../views/welcome.php");
    exit;
}

$idProducto = $_GET['id'];
$queryConsultar = $db->prepare("select p.prd_nombre,p.prd_descripcion,p.prd_precio,p.prd_foto1,c.cat_nombre
from productos p,categorias c
where p.cat_id = c.cat_id
and prd_id = ?");
$queryConsultar->execute(array($idProducto));
$producto = $queryConsultar->fetch(PDO::FETCH_ASSOC);

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['idProducto'];
    $queryBorrar = $db->prepare("delete from productos where prd_id = ?");
    $borrar = $queryBorrar->execute(array($id));
    if($borrar){
        $_SESSION['mensaje'] = "El producto ha sido eliminado exitosamente";
        header("Location: panel-productos.php");
        exit;
    }
}
?>
<?php require_once(ROOT_PATH . '/proyecto/views/cabecera.php'); ?>
<div class="container-fluid">
    <h1>Panel de Control - Confirmación de baja de Producto</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Se eliminará el siguiente registro:</b></div>
                <form class="form-horizontal" action="" method="post">
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
                            <label class="col-sm-2 control-label">Foto:</label>
                                <img src="<?php echo '../imagenes/'.$producto['prd_foto1']; ?>" height="120" width="150">
                        </div>
                        <div class="col-md-offset-6">
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                            <button class="btn btn-success" type="button" onclick="volverAlPanel();">Volver</button>
                        </div>
                        <input type="hidden" name="accion" value="borrar">
                        <input type="hidden" name="idProducto" value="<?php echo $_GET['id']; ?>" />
                    </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
<?php require_once(ROOT_PATH . '/proyecto/views/footer.php'); ?>
