
<?php
require_once ('../conf.inc.php');
?>
<!doctype html>
<?php require_once(ROOT_PATH . '/proyecto/views/cabecera.php'); ?>

<h1>Panel de Control - Libro de visitas</h1>
<div id="main">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info panel-visitas">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                    </div>
                    <hr />
                    <div class="form-group">
                        <label>Comentario</label>
                        <textarea rows="3" class="form-control" id="comentario" placeholder="Ingrese su comentario"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-10">
                            <button type="button" class="btn btn-lg btn-info">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<?php require_once(ROOT_PATH . '/proyecto/views/footer.php'); ?>
