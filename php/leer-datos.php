<?php
require 'config.php';
error_reporting(0);
header('Content-type: application/json; charset=utf-8');


if($conexion->connect_errno){
    $respuesta = [
        'error' => true
    ];
} else {
    $conexion->set_charset("utf8");
    $statement = $conexion->prepare("SELECT * FROM $tabla_db1");
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