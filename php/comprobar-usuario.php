<?php
error_reporting(0);
require("config.php");
header('Content-type: application/json; charset=utf-8');

session_start();

if (isset($_SESSION['usuario'])){
    header("Location: $ruta"."index.php");
}


$inputUsuario = $_REQUEST['usuario'];
$inputPassword = $_REQUEST['password'];


if($conexion->connect_errno){
    $respuesta = [
        'error' => true
    ];
} else {
    $conexion->set_charset("utf8");
    $statement = $conexion->prepare("SELECT * FROM $tabla_db3 WHERE usuario = '$inputUsuario' AND pass = '$inputPassword'");
    $statement->execute();
    $resultados = $statement->get_result();

    $respuesta = array();

    $usuarios = $resultados->fetch_assoc();

    
    while($fila = $resultados->fetch_assoc()){
        $usuario = [
            'usuario'    =>  $fila['usuario'],
            'password'    =>  $fila['pass']
        ];
        array_push($respuesta, $usuario);
    }
    
    if($usuarios['usuario'] == $inputUsuario && $usuarios['pass'] == $inputPassword){
        $respuesta = [
            'exito' => true
        ];
    } else {
        $respuesta = [
            'exito' => false
        ];
    }
    
}

echo json_encode($respuesta);



?>