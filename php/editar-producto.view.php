<?php
session_start();
require("config.php");

if (!isset($_SESSION['usuario'])){
    header("Location: $ruta"."login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/estilos-editar-producto.css">
    <title>Editar Producto</title>
</head>
<body>
    
    <div class="fondo_editar" id="fondo_editar">
            <form autocomplete="off" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="cont_vender" id="formulario">
                <div class="main_vender">
                    <div class="close"><iconify-icon id="cerrarVentanaIngreso" icon="ep:close-bold" width="26"></iconify-icon></div>
    
                    <div class="title">
                        <p>Modulo de Edicion de productos</p>
                    </div>
    
                    <div class="formulario__grupo" id="grupo__codigo">
                        <label for="codigo" class="formulario__label">Codigo del medicamento</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="codigo" value="<?php echo($dato_producto['codigo']); ?>" readonly id="codigo" placeholder="Codigo" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__nombre">
                        <label for="nombre" class="formulario__label">Nombre del medicamento</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="nombre" value="<?php echo($dato_producto['nombre']); ?>"  id="nombre" placeholder="Medicamento" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__concentracion">
                        <label for="concentracion" class="formulario__label">Concentracion</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="concentracion" value="<?php echo($dato_producto['concentracion']); ?>" id="concentracion" placeholder="Concentracion" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__f_farmaceutica">
                        <label for="f_farmaceutica" class="formulario__label">Formula farmaceutica</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="f_farmaceutica" value="<?php echo($dato_producto['f_farmaceutica']); ?>" id="f_farmaceutica" placeholder="F - Farmaceutica" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__ingreso">
                        <label for="ingreso" class="formulario__label">Fecha de ingreso</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="ingreso" id="ingreso" value="<?php echo($dato_producto['ingreso']); ?>" placeholder="Fecha ingreso" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__vencimiento">
                        <label for="vencimiento" class="formulario__label">Fecha de vencimiento</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="vencimiento" id="vencimiento" value="<?php echo($dato_producto['vencimiento']); ?>" placeholder="Fecha vencimiento" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__invima">
                        <label for="invima" class="formulario__label">INVIMA</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="invima" id="invima" value="<?php echo($dato_producto['invima']); ?>" placeholder="INVIMA" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__lote">
                        <label for="lote" class="formulario__label">Lote del medicamento</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="lote" id="lote" value="<?php echo($dato_producto['lote']); ?>" placeholder="Ingrese aqui el lote" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__cantidad">
                        <label for="cantidad" class="formulario__label">Ingrese la cantidad en Unidades</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="cantidad" id="cantidad" value="<?php echo($dato_producto['cantidad']); ?>" placeholder="Cantidad" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="formulario__grupo" id="grupo__precio">
                        <label for="precio" class="formulario__label">Ingrese la precio por unidad</label>
                        <div class="formulario__grupo-input">
                            <input type="text" name="precio" id="precio" value="<?php echo($dato_producto['precio']); ?>" placeholder="Ingrese aqui el precio" class="form-control">
                        </div>
                        <p class="formulario__input-error">Porfavor ingrese el texto que corresponde a las condicionales del input</p>
                    </div>
                    <div class="cont_button_sucess">
                        <button type="submit" name="btnGuardar" id="editar_producto"  class="btn btn-success agregar_producto">Guardar</button>
                    </div>
                    <div class="cont_button_sucess">
                        <button id="btn_cerrarMensaje" name="btnCancelar" class="btn btn-danger cancelar_producto">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
<script src="../js/main-editar.js"></script>
</body>
</html>