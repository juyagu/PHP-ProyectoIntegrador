<?php 
$server = "localhost";
$user = "root";
$clave = "123456";
$base = "catalogo2";

$db = new PDO("mysql:host=$server; dbname=$base; charset=utf8mb4" , "$user" , "$clave" );