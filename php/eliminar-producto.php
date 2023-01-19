<?php
	session_start();	
	require("config.php");
	require("funciones.php");
	$sesion = $_SESSION['usuario'];

	$codigoId = $_GET['codigoId'];
	$codigoId = SecurityInputs($codigoId);
	
	//ELIMINAR PRODUCTO DE INVENTARIO
	if(isset($_GET['codigoId'])){ 
		$resultados = $conexion->prepare("DELETE FROM ".$sesion."X$tabla_db1 WHERE codigo = ?");
		$resultados->bind_param("s",$codigoId);
		$resultados->execute();
    }

  include("cerrar_conexion.php");
?>

