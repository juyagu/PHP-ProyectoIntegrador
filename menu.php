
<?php require_once 'conf.inc.php'; ?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="navbar-brand" href="../views/welcome.php">Inicio</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="../visitas/form-visitas.php">Libro de Visitas<span class="sr-only">(current)</span></a></li>
                <?php if($_SESSION['perfil'] == 'Administrador'){ ?>
                <li><a href="../usuarios/listado_usuarios.php">Listado de Usuarios</a></li>
                <?php } ?>
                <li><a href="../productos/panel-productos.php">Listado de Productos</a></li>
                <li><a href="#">Listado de Categorias</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['nombre'] . " " .$_SESSION['apellido']?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../usuarios/desconectar.php">Desconectarme</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>