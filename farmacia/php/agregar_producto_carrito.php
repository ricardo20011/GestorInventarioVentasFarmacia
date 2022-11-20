<?php
require "abrir_conexion.php";

$colums = ['codigo','nombre','vencimiento','concentracion','precio','cantidad'];
$table = $tabla_db1;

$campo = isset($_POST['campo']) ?  $conexion->real_escape_string($_POST['campo']) : null;


$where ='';

if($campo != null){
    $where = " WHERE (";

    $cont = count($colums);
    for($i = 0; $i < $cont; $i++){
        $where .= $colums[$i] . " LIKE '%". $campo . "%' OR ";
    }
    $where = substr_replace($where,"", -3);
    $where .= ")";
}


$sql = "SELECT " . implode(", ", $colums) . "
FROM $table
$where ";

$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if($num_rows > 0){
    while($row = $resultado->fetch_assoc()){
        $html .= '<tr>';
            $html .= '<td>'.$row['codigo'].'</td>';
            $html .= '<td>'.$row['nombre'].'</td>';
            $html .= '<td>'.$row['cantidad'].'</td>';
            $html .= '<td>'.$row['vencimiento'].'</td>';
            $html .= '<td>'.$row['concentracion'].'</td>';
            $html .= '<td>'.$row['precio'].'</td>';
            $html .= '<td><input type="number" min="1" value="1"></td>';
            $html .= '<td>'.$row['precio'].'</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7" > Producto no encontrado </td>';
    $html .= '<tr>';

}

echo json_encode($html, JSON_UNESCAPED_UNICODE);


?>