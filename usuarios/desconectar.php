<?php
require_once '../conf.inc.php';

if (!$_SESSION['login']) {
    header("Location: ../index.php");
    exit;
}
session_destroy();
header("Location: ../index.php");
exit;