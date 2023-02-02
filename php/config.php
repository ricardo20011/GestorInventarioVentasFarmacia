<?php 

error_reporting(0); //No me muestra errores

// Parametros a configurar para la conexion de la base de datos 
$host = "";    // Valos para Host o IP ser server
$basededatos = "";    // Nombre de la base de datos
$usuariodb = "";    // Nombre de usuario el cual tiene acceso a la base de datos 
$clavedb = "";    // Clave del usuario

//Lista de Tablas
$tabla_db1 = "usuarios"; 	   // tabla de productos
$tabla_db2 = "ventas";      //tabla de registro de ventas realizadas
$tabla_db3 = "temp";      //tabla de usuarios los cuales los valida login.php



// Se establese la ruta en cada variable dependiendo si trabajamos de manera local o por hosting
$local = 'http://localhost/GestorInventarioVentasFarmacia/';
$public = 'https://www.example.com/';

//Se establese de que manera queremos trabajar
$ruta = $local;


//Se establese la variable conexion, la cual es utilizada de manera global para abrir o conectarse con la base de datos
$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);

//Se establese un mensaje en caso de error de conexion
if ($conexion->connect_errno) {
    echo "Nuestro sitio experimenta fallos....";
    exit();
}
?>
