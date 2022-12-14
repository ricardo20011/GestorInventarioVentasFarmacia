const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const editarProducto = document.getElementById('editar_producto');
const cancelarEdicion = document.getElementById('btn_cerrarMensaje');

let public = "https://www.rickbroken.com/farmacia/";
let local = "http://localhost/farmacia/";

let ruta = public;

const expresiones = {
	codigo: /^\d{1,24}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]+$/, // Letras, numeros, guion y guion_bajo
	concentracion: /^\w{0,40}\s[A-Za-z].+$/, // Letras y espacios, pueden llevar acentos.
	f_farmaceutica: /^[a-zA-ZÀ-ÿ\s]+$/, 
	ingreso: /^\d{4}\/\d?\d\/\d?[1-9]?$/,
	vencimiento: /^\d{4}\/\d?\d\/\d?[1-9]?$/, 
    lote: /^\d{1,24}$/,
    cantidad: /^\d{1,24}$/,
    precio: /^\d{0,40}.\d{0,5}.\d{0,5}$/,
    invima: /^\d.\d.+$/
}


const inputCodigo = document.getElementById('codigo');
const inputNombre = document.getElementById('nombre');
const inputConcentracion = document.getElementById('concentracion');
const inputF_farmaceutica = document.getElementById('f_farmaceutica');
const inputVencimiento = document.getElementById('vencimiento');
const inputInvima = document.getElementById('invima');
const inputCantidad = document.getElementById('cantidad');
const inputIngreso = document.getElementById('ingreso');
const inputPrecio = document.getElementById('precio');
const inputLote = document.getElementById('lote');


function agregarSeparadorMiles(numero) {
    let partesNumero = numero.toString().split('.');

    partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    return partesNumero.join('.');
}


cancelarEdicion.addEventListener('click',()=>{
    window.location.href = ruta + "inventario.php";
});

function formulario_valido(usuario_nombre,usuario_cantidad,usuario_codigo,usuario_precio,usuario_ingreso){
    if(usuario_nombre == ''){
        return false;
    } else if (usuario_cantidad ==''){
        return false;
    } else if (usuario_codigo == ''){
        return false;
    } else if (usuario_precio == ''){
        return false;
    }else if (usuario_ingreso == ''){
        return false;
    }

    return true;
}

function validarInput(expresion, input, campo){
    if(expresion.test(input.value)){
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo--incorrecto');
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo--incorrecto');
    }   
}

const validarFormulario = (e) => {
    switch (e.target.name){
        case "codigo":
            validarInput(expresiones.codigo,e.target,'codigo');
        break;
        case "nombre":
            validarInput(expresiones.nombre,e.target,'nombre');
        break;
        case "concentracion":
            if(inputConcentracion.value == ''){
                inputConcentracion.value = 'No Aplica';
            } else {
                validarInput(expresiones.concentracion,e.target,'concentracion');
            }
        break;
        case "f_farmaceutica":
            if(inputF_farmaceutica.value == ''){
                inputF_farmaceutica.value = 'No Aplica';
            } else {
                validarInput(expresiones.f_farmaceutica,e.target,'f_farmaceutica');
            }
        break;
        case "cantidad":
            validarInput(expresiones.cantidad,e.target,'cantidad');
        break;
        case "vencimiento":
            if(inputVencimiento.value == '' || inputVencimiento.value == 'No Aplica'){
                inputVencimiento.value = 'No Aplica';
                document.getElementById(`grupo__nombre`).classList.remove('formulario__grupo--incorrecto');
            } else {
                validarInput(expresiones.vencimiento,e.target,'vencimiento');
            }
        break;
        case "ingreso":
            validarInput(expresiones.ingreso,e.target,'ingreso');
        break;
        case "precio":
                inputPrecio.value = agregarSeparadorMiles(inputPrecio.value);
                validarInput(expresiones.precio,e.target,'precio');
        break;
        case "lote":
            if(inputLote.value == ''  || inputLote.value == 'No Aplica'){
                inputLote.value = 'No Aplica';
                document.getElementById(`grupo__lote`).classList.remove('formulario__grupo--incorrecto');
            } else {
                validarInput(expresiones.lote,e.target,'lote');
            }
        break;
        case "invima":
            if(inputInvima.value == ''  || inputInvima.value == 'No Aplica'){
                inputInvima.value = 'No Aplica';
                document.getElementById(`grupo__invima`).classList.remove('formulario__grupo--incorrecto');
            } else {
                validarInput(expresiones.invima,e.target,'invima');
            }
        break;
        
    }
}
editarProducto.addEventListener('click',(e)=>{
    if(inputNombre.value == '' && isNaN(inputNombre.value)){
        e.preventDefault();
        document.getElementById(`grupo__nombre`).classList.add('formulario__grupo--incorrecto');
    } 
    if (inputCantidad.value == ''){
        e.preventDefault();
        document.getElementById(`grupo__cantidad`).classList.add('formulario__grupo--incorrecto');
    } 
    if (inputCodigo.value == ''){
        e.preventDefault();
        document.getElementById(`grupo__codigo`).classList.add('formulario__grupo--incorrecto');
    } 
    if (inputPrecio.value == ''){
        e.preventDefault();
        document.getElementById(`grupo__precio`).classList.add('formulario__grupo--incorrecto');
    }
    if (inputIngreso.value == ''){
        e.preventDefault();
        document.getElementById(`grupo__ingreso`).classList.add('formulario__grupo--incorrecto');
    }
    if(inputInvima.value == ''){
        inputInvima.value = 'No Aplica';
    }
    if(inputConcentracion.value == ''){
        inputConcentracion.value = 'No Aplica';
    }
    if(inputF_farmaceutica.value == ''){
        inputF_farmaceutica.value = 'No Aplica';
    }
    if(inputVencimiento.value == ''){
        inputVencimiento.value = 'No Aplica';
    }
    if(inputLote.value == ''){
        inputLote.value = 'No Aplica';
    }
});
inputs.forEach((input)=>{
    input.addEventListener('blur',validarFormulario);
});


//----------------------EVENTO PARA BOTON AGREGAR PRODUCTO----------------------//
formulario.addEventListener('submit', (e)=>{
    if(formulario_valido(inputNombre.value,inputCantidad.value,inputCodigo.value,inputPrecio.value,inputIngreso.value) == true){
        agregarUsuarios(e);
        setInterval(()=>{
            if(tabla.rows.length > 1){
                vencimiento();
            }
        },200);
    } else {
        e.preventDefault();
    }
});

