<?php
error_reporting(E_ALL ^ E_NOTICE);
require '../config/config.php';
require 'abrir_conexion.php';


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

    //if(!empty($nombre) && is_numeric($nombre)){
        $_UPDATE_SQL="UPDATE $tabla_db1 Set 
        codigo = '$codigo', 
        nombre = '$nombre',
        concentracion = '$concentracion',
        f_farmaceutica = '$f_farmaceutica',
        ingreso = '$ingreso',
        vencimiento = '$vencimiento',
        invima = '$invima',
        lote = '$lote',
        cantidad = '$cantidad',
        precio = '$precio'
        WHERE codigo ='$codigo'"; 
    
        mysqli_query($conexion,$_UPDATE_SQL); 
    
        header('Location: '. $ruta . 'index.php');
    //}
}



if(empty($_REQUEST['id'])){
  header('Location: '. $ruta . 'index.php');
} else {
    $id_producto = $_REQUEST['id'];
    if (!is_numeric($id_producto)){
        header('Location: '. $ruta . 'index.php');
    }
    $query_producto = mysqli_query($conexion,"SELECT * FROM $tabla_db1 WHERE codigo = $id_producto");
    $resultado = mysqli_num_rows($query_producto);
    if($resultado > 0){
        $dato_producto = mysqli_fetch_assoc($query_producto);
    } else {
        header('Location: '. $ruta . 'index.php');
    }
} 


require 'editar-producto.view.php';
?>