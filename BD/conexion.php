<?php 
$server = "localhost";
$user = "root";
$clave = "";
$base = "catalogo2";

$db = new PDO("mysql:host=$server; dbname=$base; charset=utf8mb4" , "$user" , "$clave" );