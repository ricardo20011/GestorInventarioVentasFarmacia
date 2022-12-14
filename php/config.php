<?php 
	
// Parametros a configurar para la conexion de la base de datos 
$host = "162.241.60.251";    // sera el valor de nuestra BD 
$basededatos = "rickbrok_farmacia";    // sera el valor de nuestra BD 
$usuariodb = "rickbrok_previs_ips";    // sera el valor de nuestra BD 
$clavedb = "1006690431";    // sera el valor de nuestra BD 

//Lista de Tablas
$tabla_db1 = "usuarios"; 	   // tabla de usuarios
$tabla_db2 = "ventas";
$tabla_db3 = "temp";


// establecer ruta de del hosting
$local = 'http://localhost/farmacia/';
$public = 'https://www.rickbroken.com/farmacia/';


$ruta = $local;

//error_reporting(0); //No me muestra errores

$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);


if ($conexion->connect_errno) {
    echo "Nuestro sitio experimenta fallos....";
    exit();
}

?>