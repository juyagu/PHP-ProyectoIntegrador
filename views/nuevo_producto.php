<?php 
require_once('../conf.inc.php');
include(ROOT_PATH . '/Proyecto/main.php');

$queryCategorias = $db->query("select cat_id,cat_nombre from categorias");
$categorias = $queryCategorias->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['accion']) && $_POST['accion'] == 'guardar'){
    $nombre = $_POST['prd_nombre'];
    $descripcion = $_POST['prd_descripcion'];
    $precio = $_POST['prd_precio'];
    $categoria = $_POST['prd_categoria'];

    if(isset($_FILES['prd_foto1']) && isset($_FILES['prd_foto2'])){
        $archivo1 = $_FILES['prd_foto1']['name'];
        $archivo2 = $_FILES['prd_foto2']['name'];
    }
    $queryGuardar = $db->prepare("insert into productos values (null,?,?,?,?,(select CURDATE()),?,?)");
    $guardar = $queryGuardar->execute(array($nombre,$descripcion,$precio,$categoria,$archivo1,$archivo2));
    if($guardar){
        $subido1 = move_uploaded_file($_FILES['prd_foto1']['tmp_name'],"../imagenes/".$_FILES['prd_foto1']['name']);
        $subido2 = move_uploaded_file($_FILES['prd_foto2']['tmp_name'],"../imagenes/".$_FILES['prd_foto2']['name']);
    }

    if($guardar && $subido1 && $subido2){
        header("Location: mensaje.php?mensaje=El producto fue dado de alta correctamente");
    }
}

?>
<div class="container-fluid main">
   <h1>Panel de Control - Confirmación de baja de Producto</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Ingrese los datos del producto nuevo:</b></div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="prd_nombre" maxlength="50">          
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="prd_descripcion"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Precio:</label>
                            <div class="col-sm-10">
                                <input type="text" name="prd_precio" class="form-control">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Categoria:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="prd_categoria">
                                    <option value="0">Seleccione...</option>
                                    <?php foreach ($categorias as $categoria){ ?>
                                        <option value="<?php echo $categoria['cat_id'] ?>"><?php echo $categoria['cat_nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Foto 1:</label>
                            <div class="col-sm-10">
                                <input type="file" name="prd_foto1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto 2:</label>
                            <div class="col-sm-10">
                                <input type="file" name="prd_foto2">
                            </div>
                        </div>
                        <div class="col-md-offset-6">
                            <button class="btn btn-success" type="submit">Enviar</button>
                        </div>
                    </div>
                    <input type="hidden" name="accion" value="guardar">  
                </form>
            </div>        
        </div>
    </div>
</div>
 <div id="pie">
            <?php require_once("../views/pie.php") ?>
        </div>

            