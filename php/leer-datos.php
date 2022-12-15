<?php
session_start();
error_reporting(0);
require 'config.php';


header('Content-type: application/json; charset=utf-8');

$sesion = $_SESSION['usuario'];

if($conexion->connect_errno){
    $respuesta = [
        'error' => true
    ];
} else {
    $conexion->set_charset("utf8");
    $statement = $conexion->prepare("SELECT * FROM ".$sesion."X$tabla_db1");
    $statement->execute();
    $resultados = $statement->get_result();

    $respuesta = [];

    while($fila = $resultados->fetch_assoc()){
        $usuario = [
            'nombre'    =>  $fila['nombre'],
            'codigo'    =>  $fila['codigo'],
            'concentracion'      =>  $fila['concentracion'],
            'f_farmaceutica'      =>  $fila['f_farmaceutica'],
            'vencimiento'    =>  $fila['vencimiento'],
            'invima'    =>  $fila['invima'],
            'cantidad'    =>  $fila['cantidad'],
            'precio'    =>  $fila['precio']
        ];
        array_push($respuesta, $usuario);
    }
}

echo json_encode($respuesta);



?>