
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
    <div class="fondo_mensaje" id="fondo_mensaje"> 
        <div class="mensaje_vender">
            <div class="title_mensaje">
                <p>¡Confirme su venta por favor!</p>
            </div>
            <div class="cont_btn_sucess"><button onclick="guardar();" class="btn btn-success">Confirmar</button></div>
            <div class="cont_btn-danger"><button  onclick="limpiar();" id="btn_cerrarMensaje" class="btn btn-danger">Cancelar</button></div>
        </div>
    </div>

	<div class="menu" id="menu">
		<div class="cont_1">
			<div class="sub_cont_1"><img src="img/logo_empresa.jpg" alt=""></div>
			<div><p class="nombre_empresa">NOMBRE DE LA EMPRESA</p></div>
			<div><p class="nit">NIT 00.000.000</p></div>
			<div><p class="direccion">DIRECCION DE LA EMPRESA</p></div>
			<div><p class="responsable">NOMBRE RESPONSABLE EMPRESA</p></div>
		</div>
		<div class="cont_2">
			<div class="sub_cont_1"><iconify-icon class="icon-caja" icon="fa-solid:cash-register"></iconify-icon><a href="index.php">Caja Vender</a></div>
			<div class="sub_cont_2"><iconify-icon class="icon-inventario" width="20" icon="mdi:clipboard-list-outline"></iconify-icon><a href="inventario.php">Inventario</a></div>
			<div class="sub_cont_3"><iconify-icon class="icon-hitorial" width="20" icon="ic:round-history"></iconify-icon><a href="historial.php">Historial Ventas</a></div>
		</div>
	</div>

	<div class="contenedor">
		<div class="sub_cont">
			<form action="" method="POST" class="cont_buscador" id="formulario">
				<input type="text" name="campo" id="campo">
				<button id="addProducto" class="btn btn-outline-success">Añadir Producto</button>
			</form>
			

			<table class="content-table" id="tabla"> 
					<tr> 
						<th>Codigo Barras</th> 
						<th>Nombre Producto</th>
						<th>Existencia</th> 
						<th>Vencimiento</th>
						<th>Concentracion</th> 
						<th>Precio U</th> 
						<th>Cantidad</th>
						<th>Precio venta</th> 
					</tr>
				</table>	
				<div class="loader" id="loader"></div>
		</div>

		<table class="content-table contador"> 
			<thead> 
				<tr> 
					<th class="sub-total">Sub Total:</th>
					<th class="sub-total-number">$3.200</th> 
					<th class="total">Total:</th>
					<th class="total-number">$3.800</th>
					<th class="th-vender">
						<button class="btn btn-success btn-vender">Vender</button>
					</th>
				</tr> 
			</thead>
			
		</table>
	</div>
	<script src="js/main-caja.js"></script>
	<script>
		//input_agregar = document.getElementById('campo')
		//tabla = document.getElementById('tabla')
		//formulario = document.getElementById('formulario')
//
		//formulario.addEventListener("submit", (e)=>{
		//	e.preventDefault();
		//	if(input_agregar.value == ""){
		//		e.preventDefault()
		//	} else {
		//		e.preventDefault()
		//		for(i=0; i < tabla.rows.length ; i++){
		//			e.preventDefault();
		//			if(input_agregar.value == tabla.rows[i].cells[0].innerHTML){
		//				e.preventDefault()
		//				console.log('si')
		//			} else{
		//				e.preventDefault()
		//				getData()
		//				console.log('no')
		//			}
		//		
		//			setInterval(() => {
		//				if(tabla.rows.length > 1){
		//					let inputs = tabla.rows[1].cells[6].children;
		//					let dato = inputs[0].value;
		//					
        //    				multiplicarinputs(e);
		//					
		//					inputs[0].value = dato;
		//					console.log(dato);
		//					e.preventDefault();
        //				}
		//			}, 1000);
		//		}
		//	}
		//})
//
		//function getData(){
		//	let input = document.getElementById('campo').value
		//	let content = document.getElementById('content')
		//	let url = "php/agregar_producto_carrito.php"
		//	let formaData = new FormData()
		//	formaData.append('campo', input)
		//	console.log(formaData.append('campo', input))
//
//
		//	fetch(url, {
		//		method: "POST",
		//		body: formaData
		//	}).then (response => response.json())
		//	.then(data => {
		//		content.innerHTML += data
		//	}).catch(err => console.log(err))
		//}
	</script>
</body>
</html>

