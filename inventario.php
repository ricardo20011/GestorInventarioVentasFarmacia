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
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Inventario</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet"> 
	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<link rel="stylesheet" href="css/estilos.css">
	<script src="jquery/jquery-3.4.1.min.js"></script>
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

	<div class="fondo_ingresar" id="fondo_ingresar">
		<form autocomplete="off" action="" method="" class="cont_vender" id="formulario">
			<div class="main_vender">
				<div class="close"><iconify-icon id="cerrarVentanaIngreso" icon="carbon:close" width="32"></iconify-icon></div>
		
				<div class="title">
					<p>Modulo de ingreso de productos</p>
				</div>
		
				<div class="formulario__grupo" id="grupo__codigo">
					<label for="codigo" class="formulario__label">Codigo del medicamento*</label>
					<div class="formulario__grupo-input">
						<input type="text" name="codigo" id="codigo" placeholder="Codigo" class="form-control">
					</div>
					<p class="formulario__input-error">Ingrese un codigo de barras o numero no mayor a 24 digitos</p>
				</div>
				<div class="formulario__grupo" id="grupo__nombre">
					<label for="nombre" class="formulario__label">Nombre del medicamento*</label>
					<div class="formulario__grupo-input">
						<input type="text" name="nombre" id="nombre" placeholder="Medicamento" class="form-control">
					</div>
					<p class="formulario__input-error">No se admiten numeros ni simbolos, solo palabras</p>
				</div>
				<div class="formulario__grupo" id="grupo__concentracion">
					<label for="concentracion" class="formulario__label">Concentracion</label>
					<div class="formulario__grupo-input">
						<input type="text" name="concentracion" id="concentracion" placeholder="Concentracion" class="form-control">
					</div>
					<p class="formulario__input-error">Ingrese una concentracion valida ejemp: 500 Mg / 100 ml</p>
				</div>
				<div class="formulario__grupo" id="grupo__f_farmaceutica">
					<label for="f_farmaceutica" class="formulario__label">Formula farmaceutica</label>
					<div class="formulario__grupo-input">
						<input type="text" name="f_farmaceutica" id="f_farmaceutica" placeholder="F - Farmaceutica" class="form-control">
					</div>
					<p class="formulario__input-error">Ingrese solo palabras, no se admiten simbolos ni numeros</p>
				</div>
				<div class="formulario__grupo" id="grupo__ingreso">
					<label for="ingreso" class="formulario__label">Fecha de ingreso</label>
					<div class="formulario__grupo-input">
						<input type="text" name="ingreso" id="ingreso" placeholder="Fecha ingreso" class="form-control">
					</div>
					<p class="formulario__input-error">Porfavor ingrese una fecha valida en el siguiente formato AAAA/MM/DD</p>
				</div>
				<div class="formulario__grupo" id="grupo__vencimiento">
					<label for="vencimiento" class="formulario__label">Fecha de vencimiento</label>
					<div class="formulario__grupo-input">
						<input type="text" name="vencimiento" id="vencimiento" placeholder="Fecha vencimiento" class="form-control">
					</div>
					<p class="formulario__input-error">Porfavor ingrese una fecha valida en el siguiente formato AAAA/MM/DD</p>
				</div>
				<div class="formulario__grupo" id="grupo__invima">
					<label for="invima" class="formulario__label">INVIMA</label>
					<div class="formulario__grupo-input">
						<input type="text" name="invima" id="invima" placeholder="INVIMA" class="form-control">
					</div>
					<p class="formulario__input-error">Ingrese un registro valido ejemp: 2016M-00115-R1</p>
				</div>
				<div class="formulario__grupo" id="grupo__lote">
					<label for="lote" class="formulario__label">Lote del medicamento</label>
					<div class="formulario__grupo-input">
						<input type="text" name="lote" id="lote" placeholder="Ingrese aqui el lote" class="form-control">
					</div>
					<p class="formulario__input-error">No se admiten simbolos, digite letras y numeros</p>
				</div>
				<div class="formulario__grupo" id="grupo__cantidad">
					<label for="cantidad" class="formulario__label">Ingrese la cantidad en Unidades</label>
					<div class="formulario__grupo-input">
						<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control">
					</div>
					<p class="formulario__input-error">Ingrese una cantidad valida, no se admiten letras</p>
				</div>
				<div class="formulario__grupo" id="grupo__precio">
					<label for="precio" class="formulario__label">Ingrese la precio por unidad</label>
					<div class="formulario__grupo-input">
						<input type="text" name="precio" id="precio" placeholder="Ingrese aqui el precio" class="form-control">
					</div>
					<p class="formulario__input-error">Ingrese una precio valido, no se admiten letras</p>
				</div>
				<div class="cont_button_sucess">
					<button id="agregar_producto" type="submit"  class="btn btn-success agregar_producto">Agregar Producto</button>
				</div>
				<div class="cont_button_sucess">
					<button id="btn_cerrarMensaje" class="btn btn-danger cancelar_producto">Cancelar</button>
				</div>
			</div>
		</form>
	</div>
	

	<div class="fondo_borrar" id="fondo_borrar"> 
		<div class="mensaje_borrar">
			<div class="title_borrar">
				<p>¿Seguro desea borrar este producto?</p>
			</div>
			<div class="cont_btn_sucess"><button  id="confirmarborrado" class="btn btn-success">Confirmar</button></div>
			<div class="cont_btn-danger"><button  id="cancelarborrado" class="btn btn-danger">Cancelar</button></div>
		</div>
	</div>

	<div class="fondo_proceso_correcto " id="fondo_proceso_correcto">
		<div class="cont_proceso_correcto">
			<div><iconify-icon icon="icon-park-outline:success" width="50" style="color: #2a9e8b;"></iconify-icon></div>
			<div class="title_correcto">
					<p>Proceso Realizado correctamente</p>
			</div>
			<div class="cont_btn_correcto"><button class="btn btn-success" id="btn_success_correcto">Aceptar</button></div>
		</div>
	</div>

	<div class="fondo_mensaje " id="fondo_mensaje"> 
		<div class="mensaje_vender">
			<div class="title_mensaje">
				<p>¡Confirme su venta por favor!</p>
			</div>
			<div class="cont_btn_sucess"><button onclick="guardar();" class="btn btn-success">Confirmar</button></div>
			<div class="cont_btn-danger"><button  onclick="limpiar();" id="btn_cerrarMensaje" class="btn btn-danger">Cancelar</button></div>
		</div>
	</div>


	<div class="contenedor">
		<div class="subcontenedor">
			<div class="contenedor">
				<div class="cargando row">       
					<div class="d-flex justify-content-center">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Cargando...</span>
						</div>
					</div>
				</div>
		
		
				<header class="header" id="header">
					<h1>Inventario Empresa</h1>
					<div class="grupo_btn">
						<button id="btn_cargar" class="botones btn active ocultar-cargar" onclick="">Cargar Inventario</button>
						<span class="blcok" id="block"></span>
						<button id="btn_ingresar" class="botones btn active boton_ingresar_producto" onclick="">Ingresar Producto</button>
					</div>
					<form autocomplete="off" action="" class="fomularioVender formulario" id="formulario">
						<input type="text" name="codigov" id="codigov" onblur="buscar_datos();" placeholder="Codigo">
						<input type="text" name="nombrev" id="nombrev" placeholder="Medicamento" readonly>
						<input type="text" name="concentracionv" id="concentracionv" placeholder="Concentracion" disabled>
						<input type="text" name="f_farmaceuticav" id="f_farmaceuticav" placeholder="F - Farmaceutica" disabled>
						<input type="text" name="vencimientov" id="vencimientov" placeholder="Fecha vencimiento" disabled>
						<input type="text" name="cantidadv" id="cantidadv" placeholder="Cantidad">
						<input  type="button" name="vender" id="btn_vender_p" value="Vender" class="btn_comprar">
						<input type="button" value="Limpiar Datos" class="btn btn-danger" name="btn_cancelar"  onclick="limpiar();">
					</form>
				</header>
				
					<table id="tabla" class="tabla">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Nombre Medicamento</th>
								<th>Concentracion</th>
								<th>Forma farmaceutica</th>
								<th>Fecha de Vencimiento</th>
								<th>INVIMA</th>
								<th>Cantidad</th>
								<th>Precio Und</th>
								<th>Editar</th>
								<th>Borrar</th>
							</tr>
						</thead>
						<tbody id="tbody">
							
						</tbody>

					</table>
					<div class="loader" id="loader"></div>
				
			</div>
		</div>
	</div>



	<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
	<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
	<script src="js/config.js"></script>
	<script src="js/vencimiento.js"></script>
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/main.js"></script>
</body>
</html>


<script type="text/javascript">
	$(document).ready(function(){
        $('.cargando').hide();
		let tablee = $('#tabla');

		$('#tabla').DataTable({
			ajax:{
				"url": "php/leer-datos.php",
				"dataSrc": ""
			},
			"columns": [
				{"data":"codigo"},
				{"data":"nombre"},
				{"data":"concentracion"},
				{"data":"f_farmaceutica"},
				{"data":"vencimiento"},
				{"data":"invima"},
				{"data":"cantidad"},
				{"data":"precio"},
				{"defaultContent":"<a class='icon_borrar editar' >"+ icon_editar + "</a>"},
				{"defaultContent":"<span class='icon_borrar';>"+ icon_borrar + "</span>"}
			],
			"width": "600",
			"autoWidth": false
		});

		let tablaResponsive = $('#tabla').DataTable();

		//Diseño responsivo de la tabla de invnetario
		function responsiveTable(anchoPx,NumeroColumn){
			if($(window).width() < anchoPx){
				tablaResponsive.column(NumeroColumn).visible(false);
			} else {
				tablaResponsive.column(NumeroColumn).visible(true);
			}
		}
		$(window).on('resize', function(){
			responsiveTable(1000,2);
			responsiveTable(800,5);
			responsiveTable(640,3);
			responsiveTable(560,4);
			responsiveTable(460,7);
		});	
		responsiveTable(1000,2);
		responsiveTable(800,5);
		responsiveTable(640,3);
		responsiveTable(560,4);
		responsiveTable(460,7);

		//Funcionalidad de eliminar y editar en los botones
		tabla.addEventListener('click', (e)=>{
			confirmarborrado = document.getElementById('confirmarborrado');
			cancelarborrado = document.getElementById('cancelarborrado');
			fondo_borrar = document.getElementById('fondo_borrar');
			let codigo = e.target.parentNode.parentNode.parentNode.firstElementChild.innerText;

			if(e.target.parentNode.parentNode.firstElementChild.tagName == 'A'){
				window.location.href = ruta + "php/editar-producto.php?id="+codigo;
			}
			if(e.target.parentNode.parentNode.firstElementChild.tagName == 'SPAN'){
				fondo_borrar.classList.add('fondo_borrarActivo');
				confirmarborrado.addEventListener('click',()=>{
        
					let codigoId = codigo;

					let peticion = new XMLHttpRequest();
					
					peticion.open('GET', 'php/traer-producto.php?codigoId=' + codigoId, true);
					peticion.send();

					$('#tabla').DataTable().ajax.reload();
					
					fondo_borrar.classList.remove('fondo_borrarActivo');
				});
				cancelarborrado.addEventListener('click',()=>{
					fondo_borrar.classList.remove('fondo_borrarActivo');
				});
			}
		});


		setTimeout(()=>{
			setInterval(()=>{
				if(tabla.rows.length > 2){
					vencimiento();
				}
			},500)
		},1500);

    });


	


		
	function buscar_datos(){
		codigov = $("#codigov").val();
		if(!codigov == ""){
			var parametros = 
			{
			"codigov" : codigov
			};
			$.ajax(
			{
			data:  parametros,
			dataType: 'json',
			url:   'php/traer-producto.php',
			type:  'post',
			beforeSend: function() {
				$('.formularioVender').hide();
				$('.cargando').show();
			}, 
			error: function()
			{
				alert("Error");
			},
			complete: function() 
			{
				$('.formularioVender').show();
				$('.cargando').hide();
			},
			success:  function (valores) 
			{
				if(valores.existe=="1") //Aqui usamos la variable que NO use en el vídeo
				{
					$("#nombrev").val(valores.nombrev);
					$("#concentracionv").val(valores.concentracionv);
					$("#f_farmaceuticav").val(valores.f_farmaceuticav);
					$("#vencimientov").val(valores.vencimientov);
				}
				else
				{
				alert("El propietario no existe, ¡Crealo!")
				}
			}
			}) 
		}
	}

	function limpiar(){
		$("#codigov").val("");
		$("#nombrev").val("");
		$("#concentracionv").val("");
		$("#f_farmaceuticav").val("");
		$("#vencimientov").val("");
		$("#cantidadv").val("");
		cerrarMensajeVenta();
	}

	function guardar(){
		var parametros = 
		{
		"guardar": "1",
		"codigov" : $("#codigov").val(),
		"cantidadv" : parseInt($("#cantidadv").val())
		};
		$.ajax(
		{
		data:  parametros,
		url:   'php/traer-producto.php',
		type:  'post',
		beforeSend: function() 
		{
			$('.formularioVender').hide();
			$('.cargando').show();
			
		}, 
		error: function()
		{alert("Error");},
		complete: function() 
		{
			$('.formularioVender').show();
			$('.cargando').hide();
		
		},
		success:  function (mensaje) 
		{
			$('.resultados').html(mensaje);}
		}) 
		limpiar();
		cerrarMensajeVenta();
		setTimeout(() => {
			cargarUsuarios();
		}, 3000);

	}
</script>