<?php
session_start();
require("php/config.php");

if (!isset($_SESSION['usuario'])){
    header("Location: $ruta"."login.php");
	die("Acceso denegado");
	exit;
}

$sesion = $_SESSION['usuario'];

$conexion->set_charset("utf8");
$statement = $conexion->prepare("SELECT * FROM $tabla_db3 WHERE usuario = '$sesion'");
$statement->execute();
$resultados = $statement->get_result();
$resultados = $resultados->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Historial</title>
	<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="css/estilos-historial.css">
</head>
<body>

	<div class="detec-menu" id="detec-menu"></div>
	<div class="menu-respon">
		<div class="cont-icon-menu-respon">
			<iconify-icon id="iconMenuRespon" icon="fontisto:nav-icon-a" style="color: white;" width="25"></iconify-icon>
		</div>
	</div>

	<div class="menu" id="menu">
		<div class="cont_1">
			<div class="sub_cont_1"><img src="<?php echo($resultados['img']); ?>" alt=""></div>
			<div><p class="nombre_empresa"><?php echo($resultados['nombreEmpresa']); ?></p></div>
			<div><p class="nit"><?php echo($resultados['nit']); ?></p></div>
			<div><p class="direccion"><?php echo($resultados['direccion']); ?></p></div>
			<div><p class="responsable"><?php echo($resultados['responsable']); ?></p></div>
		</div>
		<div class="cont_2">
			<div class="sub_cont_1"><iconify-icon class="icon-caja" icon="fa-solid:cash-register"></iconify-icon><a href="index.php">Caja Vender</a></div>
			<div class="sub_cont_2"><iconify-icon class="icon-inventario" width="20" icon="mdi:clipboard-list-outline"></iconify-icon><a href="inventario.php">Inventario</a></div>
			<div class="sub_cont_3"><iconify-icon class="icon-hitorial" width="20" icon="ic:round-history"></iconify-icon><a href="historial.php">Historial Ventas</a></div>
			<div class="exit"><iconify-icon icon="majesticons:door-exit" rotate="180deg" width="20"></iconify-icon><a href="php/exit.php">Cerrar sesion</a></div>
		</div>
	</div>

	<div class="contenedor">
		<div class="fondoFecha" id="fondoFecha"> 
			<div class="mensajeFecha">
				<div class="titleFecha">
				<iconify-icon icon="uiw:date" style="color: #006e6e;" width="50"></iconify-icon>
					<p>Ingrese la una fecha de inicio y una fecha final</p>
				</div>
			</div>
		</div>
		<div class="sub_cont">
			<div class="container-input">
				<div class="cont-1">
					<label for="inputInicio" class="icono-calendario">
						<iconify-icon  icon="ic:baseline-date-range" style="color: #0d7f54;" width="22"></iconify-icon>
					</label>
					<input class="input-tex" type="text" id="inputInicio" placeholder="Fecha inicio" autocomplete="off"> 
				</div>
				<div class="cont-2">
					<label for="inputFin" class="icono-calendario">
						<iconify-icon  icon="ic:baseline-date-range" style="color: #0d7f54;" width="22"></iconify-icon>
					</label>
					<input class="input-tex" type="text" id="inputFin" placeholder="Fecha fin" autocomplete="off">
				</div>
				<input id="consultar" class="btn-consultar" type="button" value="Consultar">
			</div>

			<table class="content-table" id="tabla">
				<thead>
					<tr class="row-head">
						<th class='ocultarCol2'>Codigo Factura</th>
						<th>Codigo</th>
						<th>Nombre Producto</th>
						<th class="ocultarCol1">Precio Unidad</th>
						<th>Cantidad</th>
						<th>Precio total Unidades</th>
						<th>Fecha de Venta</th>
						<th>Hora de venta</th>
						<th>Total venta</th>
					</tr>
				</thead>
				<tbody id="cuerpoTabla">
					
				</tbody>
			</table>

			
			<table class="content-table contador" id="table-total"> 
				<tbody> 
					<tr> 
						<th class="total">Productos Vendidos:</th>
						<th class="total-number" id="totalProductos">0</th>
						<th class="total">Total Ventas:</th>
						<th class="total-number" id="totalVentas">$ 0</th>
					</tr> 
				</tbody>
			</table>
		</div>
	</div>


	<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="js/config.js"></script>
	<script src="js/jquery-ui-1.13.2.js"></script>
	<script src="js/main-historial.js"></script>
	<script>
		$( function() {
			$( "#inputInicio" ).datepicker({
				dateFormat: "yy/mm/dd",
				changeMonth: true,
				changeYear: true
			});
		} );
		$( function() {
			$( "#inputFin" ).datepicker({
				dateFormat: "yy/mm/dd",
				changeMonth: true,
				changeYear: true
			});
		} );
	</script>
</body>
</html>

