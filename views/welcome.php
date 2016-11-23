<?php
require_once('../conf.inc.php');

if (!$_SESSION['login']) {
    header("Location: ../index.php");
    exit;
}
?>
<?php require_once(ROOT_PATH . '/proyecto/views/cabecera.php'); ?>
<h1>Panel de Control - Proyecto Integrador</h1>
<h3>Bienvenido usuario <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h3>
<?php require_once(ROOT_PATH . '/proyecto/views/footer.php'); ?>


