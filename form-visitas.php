<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">
    </head>
    <body>

        <div class="container-fluid">
            <div id="top"><img src="imagenes/top.png" alt="encabezado" width="980" height="80"></div>
            <?php require_once 'views/menu.php'; ?>

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
        <div id="pie">
            <?php require_once("views/pie.php") ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

    </body>
</html>
