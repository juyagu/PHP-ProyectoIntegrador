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

$queryCategorias = $db->query("select cat_id,cat_nombre from categorias");
$categorias = $queryCategorias->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['idProducto'];
    $nombre = $_POST['prd_nombre'];
    $descripcion = $_POST['prd_descripcion'];
    $precio = $_POST['prd_precio'];
    $categoria = $_POST['prd_categoria'];
    
    if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ''){
        $archivo = $_FILES['foto']['name'];
        $queryArchivo = $db->prepare("update productos set prd_foto1 = ?, prd_foto2 = ? where prd_id = ?");
        $updateArchivo = $queryArchivo->execute(array($archivo,$archivo,$id));
        $subido = move_uploaded_file($_FILES['foto']['tmp_name'],ROOT_PATH ."/proyecto/imagenes/".$_FILES['foto']['name']);
    }
    $queryUpdate = $db->prepare("update productos set prd_nombre = :nombre, prd_descripcion = :descripcion, prd_precio = :precio, cat_id = :categoria where prd_id = :id");
    $modificar = $queryUpdate->execute(array(":nombre"=>$nombre,":descripcion"=>$descripcion,":precio"=>$precio,":categoria"=>$categoria,':id'=>$id));
    if($modificar){
         $_SESSION['mensaje'] = "El producto ha sido modificado exitosamente";
        header("Location: panel-productos.php");
        exit;
    }
}

?>
<?php require_once(ROOT_PATH . '/proyecto/views/cabecera.php'); ?>
<div class="container-fluid">
    <h1>Panel de Control - Confirmación de modificación de Producto</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Modificar producto:</b></div>
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="form-group" >
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="prd_nombre" value="<?= $producto['prd_nombre'] ?>">          
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="prd_descripcion"><?= $producto['prd_descripcion'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Precio:</label>
                            <div class="col-sm-10">
                                <input type="text" name="prd_precio" class="form-control" value="<?= $producto['prd_precio'] ?>">

                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Categoria:</label>
                            <div class="col-sm-10">
                                <!--<input type="text" class="form-control" name="prd_categoria" value="<?= $producto['cat_nombre']; ?>">-->
                                <select class="form-control" name="prd_categoria">
                                    <?php foreach($categorias as $categoria){?>
                                    <option value="<?= $categoria['cat_id'] ?>" <?php echo ($producto['cat_nombre'] == $categoria['cat_nombre'])? 'selected': ''; ?>><?= $categoria['cat_nombre']  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nueva foto:</label>
                            <div class="col-sm-10">
                                <input type="file" name="foto" id="foto" />
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Foto Actual:</label>
                                <img src="<?php echo '../imagenes/'.$producto['prd_foto1']; ?>" height="120" width="150">
                        </div>
                        <div class="col-md-offset-6">
                            <button class="btn btn-info" type="submit">Modificar</button>
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
