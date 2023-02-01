<?php 

error_reporting(0); //No me muestra errores

// Parametros a configurar para la conexion de la base de datos 
$host = "";    // Host o localhost
$basededatos = "";    // Nombre base de datos
$usuariodb = "";    // Usuario para la base de datos
$clavedb = "";    // Clave para la base de datos

//Lista de Tablas de bases de datos
$tabla_db1 = "usuarios"; 	   // Tabla donde se guarda el inventario
$tabla_db2 = "ventas";       //Tabla donde se guarda el registro de las ventas
$tabla_db3 = "temp";      //Tabla donde se validan los usurios en login.php



// Se crean dos rutas, una cuando se trabaja de manera local, y otra cuando se sube al Hosting
$local = 'http://localhost/farmacia/';
$public = 'https://www.example.com/';
// Aqui se declara con que ruta vamos a trabajar
$ruta = $public;

//Se declara la variable $Conexion, la variable se utiliza en los archivos que querramos abrir conexion con las bases
$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);

//Mostrar error si hay fallo en la conexion
if ($conexion->connect_errno) {
    echo "Nuestro sitio experimenta fallos....";
    exit();
}

?>
