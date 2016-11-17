<?php 
require_once("../BD/conexion.php");
$id = $_GET['id'];
$stmt = $db->prepare("select prd_nombre,prd_descripcion,prd_precio from productos where prd_id = ?");
$stmt->execute(array($id));
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>