<?php
require_once '../conf.inc.php';

if (!$_SESSION['login']) {
    header("Location: ../index.php");
    exit;
}
setcookie("login","",time() - 3600,"/");
session_destroy();
header("Location: ../index.php");
exit;