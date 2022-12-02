<?php
	include("abrir_conexion.php");
	 

	if(isset($_POST['codigoId']))
    	{ 
    	$codigoId = $_POST['codigoId'];

    	//CONSULTAR
		  $resultados = mysqli_query($conexion,"DELETE FROM $tabla_db1 WHERE codigo = '$codigoId'");

    }






	if(isset($_POST['codigov']))
    	{ 
    	$codigov = $_POST['codigov'];
    	$valores = array();

    	$valores['existe'] = "0";

    	//CONSULTAR
		  $resultados = mysqli_query($conexion,"SELECT * FROM $tabla_db1 WHERE codigo = '$codigov'");
		  while($consulta = mysqli_fetch_array($resultados))
		  {
		  	$valores['existe'] = "1"; //Esta variable no la usamos en el vídeo (se me olvido, lo siento xD). Aqui la uso en la linea 97 de registro.php
		  	$valores['nombrev'] = $consulta['nombre'];
		  	$valores['concentracionv'] = $consulta['concentracion'];
			$valores['f_farmaceuticav'] = $consulta['f_farmaceutica'];
			$valores['vencimientov'] = $consulta['vencimiento'];
		  	$valores['cantidadv'] = $consulta['cantidad'];		    
		  }
		  sleep(1);
		  $valores = json_encode($valores);
			echo $valores;
    }

    if(isset($_POST['guardar'])){
    	$codigov = $_POST['codigov'];
		$cantidadv = $_POST['cantidadv'];
    	$existe = "1";

    	//CONSULTAR
		$resultados = mysqli_query($conexion,"SELECT * FROM $tabla_db1  WHERE codigo = '$codigov'");
		$consulta = mysqli_fetch_array($resultados);
		  
		$existe = "1";
		$cantidadtotal = $consulta['cantidad'];

		if($existe=="1"){	
			$cantidadv = (int)$cantidadv;
			$cantidadtotal = (int)$cantidadtotal;
			$cantidadtotal = $cantidadtotal - $cantidadv;
			//actualizar
			$_UPDATE_SQL="UPDATE $tabla_db1 Set 

			cantidad='$cantidadtotal' 
			WHERE codigo='$codigov'"; 
			mysqli_query($conexion,$_UPDATE_SQL); 
			echo "<b>Dato Actualizado</b>";
		}
    }
	
  include("cerrar_conexion.php");
?>

