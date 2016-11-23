

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

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon">
    </head>
    <body>

        <div class="container-fluid main">
            <div id="top"><img src="../imagenes/top.png" alt="encabezado" width="980" height="80"></div>
            <?php require_once '../menu.php'; ?>

            <?php require_once(ROOT_PATH . '/Proyecto/views/' . lcfirst(VISTA) . '.php') ?>

        </div>
       
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="j../s/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>

        <script src="../js/main.js"></script>

    </body>
</html>
