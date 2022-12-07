<?php
error_reporting(0);
require("abrir_conexion.php");
header('Content-type: application/json; charset=utf-8');

$inputInicio = $_REQUEST['inicio'];
$inputFin = $_REQUEST['fin'];


if($conexion->connect_errno){
    //header('Location: error/error.php');
    $respuesta = [
        'error' => true
    ];
} else {
    $conexion->set_charset("utf8");
    $statement = $conexion->prepare("SELECT * FROM $tabla_db2 WHERE fecha BETWEEN $inputInicio AND $inputFin");
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

    //$respuesta = implode($respuesta);

    //echo(__toString($respuesta));
}

echo json_encode($respuesta);



?>