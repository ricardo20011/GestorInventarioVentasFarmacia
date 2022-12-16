<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require("php/config.php");

if (isset($_SESSION['usuario'])){
    header("Location: $ruta"."index.php");
}


?>
<!DOCTYPE html>
<html lang="en" class="html-login">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="css/estilos-login.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
    <title>Ingreso RickBroken</title>
</head>
<body class="body-login">
    <div class="cont-login">
        <div class="cont-logo">
            <iconify-icon icon="carbon:data-vis-1" style="color: white;" width="65"></iconify-icon>
            <p class="title-cont">Rick Broken</p>
        </div>

        <div class="cont-usuario contenedor-inputs">
            <label for="usuario">Ingrese su usuario:</label>
            <div class="cont-input-usuario cont-input">
                <input type="text" id="usuario" placeholder="Usuario">
                <iconify-icon class="icon-input" icon="mdi:user-circle" style="color: white;" width="22"></iconify-icon>
            </div>
            <p class="p-cont-1 p-cont-1Ocultar" id="p-cont-1">Ingrese los datos correctame</p>
        </div>

        <div class="cont-pass contenedor-inputs">
            <label for="password"s>Ingrese su contraseña</label>
            <div class="cont-input-password cont-input">
                <input type="password" name="" id="password" placeholder="Contraseña">
                <iconify-icon class="icon-input" style="color: white;" width="22" icon="material-symbols:lock"></iconify-icon>
                <iconify-icon class="eye-password" id="eyePassword" icon="mdi:eye-outline" style="color: white;" width="22"></iconify-icon>
            </div>
            <p class="p-cont-2 p-cont-2Ocultar"  id="p-cont-2">Ingrese los datos correctame</p>
        </div>

        <div class="cont-btn">
            <button id="ingresar">Ingresar</button>
        </div>

        <div class="footer-login">
            <a>Copyring @ 2022 Rick Broken</a>
        </div>
    </div>
    <script src="js/config.js"></script>
    <script src="js/login.js"></script>
</body>
</html>