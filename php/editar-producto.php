<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require 'config.php';
require 'funciones.php';


$sesion = $_SESSION['usuario'];

$id_producto = $_REQUEST['id'];

if(isset($_POST['btnGuardar'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $concentracion = $_POST['concentracion'];
    $f_farmaceutica = $_POST['f_farmaceutica'];
    $ingreso = $_POST['ingreso'];
    $vencimiento = $_POST['vencimiento'];
    $invima = $_POST['invima'];
    $lote = $_POST['lote'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];


    $codigo = SecurityInputs($codigo);
    $nombre = SecurityInputs($nombre);
    $concentracion = SecurityInputs($concentracion);
    $f_farmaceutica = SecurityInputs($f_farmaceutica);
    $vencimiento = SecurityInputs($vencimiento);
    $invima = SecurityInputs($invima);
    $cantidad = SecurityInputs($cantidad);
    $ingreso = SecurityInputs($ingreso);
    $precio = SecurityInputs($precio);
    $lote = SecurityInputs($lote);

    
    $statement = $conexion->prepare("UPDATE ".$sesion."X$tabla_db1 SET 
    codigo = ?,
    nombre = ?,
    concentracion = ?,
    f_farmaceutica = ?,
    ingreso = ?,
    vencimiento = ?,
    invima = ?,
    lote = ?,
    cantidad = ?,
    precio = ? 
    WHERE codigo = ?");

    $statement->bind_param("sssssssssss", $codigo, $nombre, $concentracion, $f_farmaceutica, $ingreso, $vencimiento, $invima, $lote, $cantidad, $precio, $codigo);
    
    $statement->execute(); 
    
    header('Location: '. $ruta . 'inventario.php');
}



if(empty($_REQUEST['id'])){
  header('Location: '. $ruta . 'inventario.php');
} else {
    if (!is_numeric($id_producto)){
        header('Location: '. $ruta . 'inventario.php');
    }

    $statement = $conexion->prepare("SELECT * FROM ".$sesion."X$tabla_db1 WHERE codigo = ?");
    $statement->bind_param("s",$id_producto);
    $statement->execute();

    $resultado = $statement->get_result();
    $resultadoColuns = mysqli_num_rows($resultado);
    if($resultadoColuns > 0){
        $dato_producto = mysqli_fetch_assoc($resultado);
    } else {
        header('Location: '. $ruta . 'inventario.php');
    }
} 


require 'editar-producto.view.php';
?>