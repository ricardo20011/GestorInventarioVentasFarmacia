<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
error_reporting(0);
header('Content-type: application/json; charset=utf-8');
require("config.php");




$inputUsuario = $_REQUEST['usuario'];
$inputPassword = $_REQUEST['password'];

$inputUsuario .= filter_input(INPUT_GET, $inputUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$inputPassword .= filter_input(INPUT_GET, $inputPassword, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
SecurityInputs($inputUsuario);
SecurityInputs($inputPassword);
$inputPassword = hash('sha3-512', $inputPassword);



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
        $_SESSION['usuario'] = $inputUsuario;
        $respuesta = [
            'exito' => true
        ];
    } else {
        $respuesta = [
            'exito' => false
        ];
    }
    if($inputUsuario == '' || $inputPassword == ''){
        $respuesta = [
            'exito' => false
        ];
    }
    
}

echo json_encode($respuesta);



?>