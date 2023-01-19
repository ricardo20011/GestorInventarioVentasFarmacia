<?php
session_start();
error_reporting(0);
require("config.php");


header('Content-type: application/json; charset=utf-8');

$sesion = $_SESSION['usuario'];

$inputInicio = $_REQUEST['inicio'];
$inputFin = $_REQUEST['fin'];



if($conexion->connect_errno){
    //header('Location: error/error.php');
    $respuesta = [
        'error' => true
    ];
} else {
    $conexion->set_charset("utf8");
    $statement = $conexion->prepare("SELECT * FROM ".$sesion."X$tabla_db2 WHERE fecha BETWEEN ? AND ? ");
    $statement->bind_param("ss",$inputInicio,$inputFin);
    $statement->execute();
    $resultados = $statement->get_result();

    $respuesta = [];

    


    while($fila = $resultados->fetch_assoc()){
        $usuario = [
            'codigoFact'    =>  $fila['codigoFact'],
            'codigo'    =>  $fila['codigo'],
            'nombre'    =>  $fila['nombre'],
            'PrecioU'      =>  $fila['PrecioU'],
            'cantidad'      =>  $fila['cantidad'],
            'total'    =>  $fila['total'],
            'fecha'    =>  $fila['fecha'],
            'hora'    =>  $fila['hora'],
            'totalFact'    =>  $fila['totalFact']
        ];
        array_push($respuesta, $usuario);
    }
}

echo json_encode($respuesta);



?>