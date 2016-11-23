<?php
require_once('BD/conexion.php');

define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);

define('VISTA',basename($_SERVER['PHP_SELF'],'.php'));

if (!isset($_SESSION)) {
    session_start();
}
 ?>