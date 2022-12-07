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



    $conexion->set_charset('utf8');

	$codigo = $ListaProductos[$i]->codigo;
	$nombre = $ListaProductos[$i]->nombre;
	$cantidad = $ListaProductos[$i]->cantidad;
	$precio = $ListaProductos[$i]->precio;
	$total = $ListaProductos[$i]->total;
	$fecha = $ListaProductos[$i]->fecha;
	$totalFact = $ListaProductos[$i]->totalFact;

    if($conexion->connect_errno){
        $respuesta = [
            'error' => true
        ];
    } else {
        $statement = $conexion->prepare("INSERT INTO $tabla_db2(codigo, nombre, cantidad, PrecioU, total, fecha, totalFact) VALUES(?,?,?,?,?,?,?)");
        $statement->bind_param("sssssss",$codigo,$nombre,$cantidad,$precio,$total,$fecha,$totalFact);
        $statement->execute();

        if($conexion->affected_rows <= 0){
            $respuesta = ['error' => true];
        }
        $respuesta = [];
    }
}





	
  include("cerrar_conexion.php");
?>
