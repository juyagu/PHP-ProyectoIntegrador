<?php
require_once('../conf.inc.php');
if (!$_SESSION['login']) {
    header("Location: ../index.php");
    exit;
}
if ($_SESSION['perfil'] != 'Administrador') {
    header("Location: ../views/welcome.php");
    exit;
}
$queryUsuarios = $db->query("select id_usuario,email,nombre,apellido,habilitado from usuarios");
$usuarios = $queryUsuarios->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['accion'] == 'habilitar') {
        $idUsuario = $_POST['id_usuario'];
        $queryHabilitar = $db->prepare("update usuarios set habilitado = 1 where id_usuario = :id_usuario");
        $habilitado = $queryHabilitar->execute(array(":id_usuario" => $idUsuario));
        if ($habilitado) {
            $_SESSION['mensaje'] = "El producto ha sido habilitado exitosamente";
            header("Location: listado_usuarios.php");
            exit;
        }
    } else if ($_POST['accion'] == 'deshabilitar') {
        $idUsuario = $_POST['id_usuario'];
        $queryDeshabilitar = $db->prepare("update usuarios set habilitado = 0 where id_usuario = :id_usuario");
        $deshabilitado = $queryDeshabilitar->execute(array(":id_usuario" => $idUsuario));
        if ($deshabilitado) {
            $_SESSION['mensaje'] = "El producto ha sido deshabilitado exitosamente";
            header("Location: listado_usuarios.php");
            exit;
        }
    }
}
?>

<?php require_once(ROOT_PATH . '/proyecto/views/cabecera.php'); ?>
<div class="container-fluid main">
    <?php if (isset($_SESSION['mensaje'])) { ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $_SESSION['mensaje']; ?>
        </div>
        <?php
        unset($_SESSION['mensaje']);
    }
    ?>
    <div class="panel panel-info">
        <div class="panel-heading">Listado de usuarios</div>
        <div class="panel-body">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Habilitado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) { ?>
                        <tr class="<?php echo ($usuario['habilitado'] == 1) ? 'success' : 'danger' ?>">
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['nombre'] ?></td>
                            <td><?= $usuario['apellido'] ?></td>
                            <td><?php echo ($usuario['habilitado'] == 1) ? 'SI' : 'NO' ?></td>
                            <?php if (!$usuario['habilitado']) { ?>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" aria-label="Left Align" onclick="habilitarUsuario(<?php echo $usuario['id_usuario']; ?>);" title="Habilitar">
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    </button>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" aria-label="Left Align" onclick="deshabilitarUsuario(<?php echo $usuario['id_usuario']; ?>);" title="Deshabilitar">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </td>
                            <?php } ?>

                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<form method="post" id="frm_habilitar">
    <input type="hidden" name="accion" value="habilitar" />
    <input type="hidden" name="id_usuario" id="id_usuarioHabilitar" value="" />
</form>
<form method="post" id="frm_deshabilitar">
    <input type="hidden" name="accion" value="deshabilitar" />
    <input type="hidden" name="id_usuario" id="id_usuarioDeshabilitar" value="" />
</form>
<?php require_once(ROOT_PATH . '/proyecto/views/footer.php'); ?>

