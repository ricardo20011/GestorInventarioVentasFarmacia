<?php
session_start();
require("php/config.php");

if (!isset($_SESSION['usuario'])){
    header("Location: $ruta"."login.php");
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabla de usuarios con AJAX</title>
	<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet"> 
	<link rel="stylesheet" href="css/estilos-caja.css">
	<script src="jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
	

	<div class="menu" id="menu">
		<div class="cont_1">
			<div class="sub_cont_1"><img src="img/logo_empresa.png" alt=""></div>
			<div><p class="nombre_empresa">Drogueria Mundo Farma</p></div>
			<div><p class="nit">NIT 41936351-7</p></div>
			<div><p class="direccion">Cra 12 N 23-31 Villa Malia</p></div>
			<div><p class="responsable">Eliana Maria Ceballos Diaz</p></div>
		</div>
		<div class="cont_2">
			<div class="sub_cont_1"><iconify-icon class="icon-caja" icon="fa-solid:cash-register"></iconify-icon><a href="index.php">Caja Vender</a></div>
			<div class="sub_cont_2"><iconify-icon class="icon-inventario" width="20" icon="mdi:clipboard-list-outline"></iconify-icon><a href="inventario.php">Inventario</a></div>
			<div class="sub_cont_3"><iconify-icon class="icon-hitorial" width="20" icon="ic:round-history"></iconify-icon><a href="historial.php">Historial Ventas</a></div>
			<div class="exit"><iconify-icon icon="majesticons:door-exit" rotate="180deg" width="20"></iconify-icon><a href="php/exit.php">Cerrar sesion</a></div>
		</div>
	</div>

	<div class="contenedor">
		<div class="fondoDuplicado" id="fondoDuplicado"> 
			<div class="mensajeDuplicado">
				<div class="titleDuplicado">
				<iconify-icon icon="pepicons:duplicate-print" style="color: #006e6e;" width="60"></iconify-icon>
					<p>Ya existe el producto en la lista de venta</p>
				</div>
			</div>
		</div>

		<div class="fondoCodigo" id="fondoCodigo"> 
			<div class="mensajeCodigo">
				<div class="titleCodigo">
				<iconify-icon class="iconify" icon="material-symbols:barcode-reader-outline-rounded" style="color: #006e6e;" width="60"></iconify-icon>
					<p>Ingrese un codigo de barras</p>
				</div>
			</div>
		</div>

		<div class="fondoExito" id="fondoExito"> 
			<div class="mensajeExito">
				<div class="titleExito">
					<iconify-icon class="iconify"  icon="icon-park-outline:database-success" width="60" style="color: #006e6e;"></iconify-icon>
					<p>Venta Exitosa</p>
				</div>
			</div>
		</div>
		<div class="fondoVenta" id="fondoVenta"> 
			<div class="mensajeVenta">
				<div class="titleVenta">
					<p>¡Confirme su venta porfavor!</p>
				</div>
				<div class="cont_btn_sucess"><button  id="confirmarVenta" class="btn btn-success">Confirmar</button></div>
				<div class="cont_btn-danger"><button  id="cancelarVenta" class="btn btn-danger">Cancelar</button></div>
			</div>
		</div>
		<div class="sub_cont">
			<form  method="" class="cont_buscador" id="formulario">
				<input type="text" name="campo" id="campo">
				<button id="addProducto" class="btn btn-outline-success">Añadir Producto</button>
			</form>
			

			<table class="content-table tabla1" id="tabla"> 
				<tr> 
					<th>Codigo Barras</th> 
					<th>Nombre Producto</th>
					<th>Existencia</th> 
					<th>Concentracion</th> 
					<th>Vencimiento</th>
					<th>Precio U</th> 
					<th>Cantidad</th>
					<th>Precio venta</th> 
					<th>Eliminar</th> 
				</tr>
			</table>
		</div>

		<table class="content-table contador" id="table-total"> 
			<tbody> 
				<tr> 
					<th class="sub-total">Nombre Empresa</th>
					<th class="sub-total-number">Nit 2012.123.11</th> 
					<th class="total">Total:</th>
					<th class="total-number" id="totalFactura">$ 0</th>
					<th class="th-vender">
						<button name="vender" id="vender" class="btn btn-success btn-vender">Vender</button>
					</th>
				</tr> 
			</tbody>
			
		</table>
	</div>
	<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
	<script src="js/config.js"></script>
	<script src="js/vencimiento.js"></script>
	<script src="js/main-caja.js"></script>
</body>
</html>

