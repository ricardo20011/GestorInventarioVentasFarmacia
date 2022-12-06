<?php
include("abrir_conexion.php");

header("Content-Type: application/json; charset=UTF-8");


$objeto = json_decode($_GET["encapsulado"], false);

$ListaProductos = array();
$arreglo = get_object_vars( $objeto );

foreach( $arreglo as $indice=>$valor ){
	$ListaProductos[] = $valor;
} 
//echo($ListaProductos[0]->codigo);
//echo($ListaProductos[0]->codigo);


for($i = 0; $i < count($ListaProductos); $i++){
	$codigov = $ListaProductos[$i]->codigo;
	$cantidadv = $ListaProductos[$i]->cantidad;
	
	//CONSULTAR
	$resultados = mysqli_query($conexion,"SELECT * FROM $tabla_db1  WHERE codigo = '$codigov'");
	$consulta = mysqli_fetch_array($resultados);
	  
	
	$cantidadtotal = $consulta['cantidad'];
	
		
	$cantidadv = (int)$cantidadv;
	$cantidadtotal = (int)$cantidadtotal;
	$cantidadtotal = $cantidadtotal - $cantidadv;

	//actualizar
	$_UPDATE_SQL="UPDATE $tabla_db1 Set 
	
	cantidad='$cantidadtotal' 
	WHERE codigo='$codigov'"; 
	mysqli_query($conexion,$_UPDATE_SQL); 
	echo "<b>Dato Actualizado</b>";
}

$local = "http://localhost/farmacia/";




	
  include("cerrar_conexion.php");
?>
