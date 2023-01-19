<?php
session_start();
include("config.php");




header("Content-Type: application/json; charset=UTF-8");

$sesion = $_SESSION['usuario'];

//$objeto = json_decode($_GET["encapsulado"], false);
$miObjetoJSON = file_get_contents('php://input');

$miObjeto = json_decode($miObjetoJSON);

$ListaProductos = array();
$arreglo = get_object_vars( $miObjeto );

foreach( $arreglo as $indice=>$valor ){
	$ListaProductos[] = $valor;
} 


for($i = 0; $i < count($ListaProductos); $i++){
	$codigov = $ListaProductos[$i]->codigo;
	$cantidadv = $ListaProductos[$i]->cantidad;
	
	//CONSULTAR
	//$resultados = mysqli_query($conexion,"SELECT * FROM ".$sesion."X$tabla_db1  WHERE codigo = '$codigov'");
	//$consulta = mysqli_fetch_array($resultados);

	$statement = $conexion->prepare("SELECT * FROM ".$sesion."X$tabla_db1 WHERE codigo = ?");
	$statement->bind_param("s", $codigov);
	$statement->execute();
	$resultado = $statement->get_result();
	$consulta = $resultado->fetch_array();
	
	//SE SACA LA CANTIDAD DE PRODUCTOS DE LAS BASES
	$cantidadtotal = $consulta['cantidad'];
	
	//CANTIDAD DE PRODUCTOS QUE SE VAN A VENDER
	$cantidadv = (int)$cantidadv;
	//CANTIDAD DE PRODUCTOS QUE HAY EN BASES
	$cantidadtotal = (int)$cantidadtotal;
	//SE HACE LA RESTA DE LOS PRODUCTOS VENDIDOS EL TOTAL DE PRODUCTOS EN BASES
	$cantidadtotal = $cantidadtotal - $cantidadv;

	//actualizar
	$_UPDATE_SQL= "UPDATE " . $sesion . "X$tabla_db1 Set cantidad = '$cantidadtotal' WHERE codigo = '$codigov'"; 
	mysqli_query($conexion,$_UPDATE_SQL); 


    $conexion->set_charset('utf8');

	$codigoFact = $ListaProductos[$i]->codigoFact;
	$codigo = $ListaProductos[$i]->codigo;
	$nombre = $ListaProductos[$i]->nombre;
	$cantidad = $ListaProductos[$i]->cantidad;
	$precio = $ListaProductos[$i]->precio;
	$total = $ListaProductos[$i]->total;
	$fecha = $ListaProductos[$i]->fecha;
	$hora = $ListaProductos[$i]->hora;
	$totalFact = $ListaProductos[$i]->totalFact;

    if($conexion->connect_errno){
        $respuesta = [
            'error' => true
        ];
    } else {
        $statement = $conexion->prepare("INSERT INTO ".$sesion."X$tabla_db2(codigoFact, codigo, nombre, cantidad, PrecioU, total, fecha, totalFact, hora) VALUES(?,?,?,?,?,?,?,?,?)");
        $statement->bind_param("sssssssss",$codigoFact,$codigo,$nombre,$cantidad,$precio,$total,$fecha,$totalFact,$hora);
        $statement->execute();

        if($conexion->affected_rows <= 0){
            $respuesta = ['error' => true];
        }
        $respuesta = [];
    }
}





	
  include("cerrar_conexion.php");
?>
