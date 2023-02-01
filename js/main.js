const btn_cargar = document.getElementById('btn_cargar');
const tabla = document.getElementById('tabla');
const loader = document.getElementById('loader');
const btn_vender = document.getElementById('btn_vender');
const formularioVender = document.getElementById('formularioVender');
const header = document.getElementById('header');
const mensajaConfirmacion = document.getElementById('fondo_mensaje');
const btn_vender_producto = document.getElementById('btn_vender_p');
const btn_cerrarMensaje = document.getElementById('btn_cerrarMensaje');
const inputCodigov = document.getElementById('codigov');
const inputCantidadv = document.getElementById('cantidadv');
const cerrarVentanaIngreso = document.getElementById('cerrarVentanaIngreso');
const fondo_ingresar = document.getElementById('fondo_ingresar');
const activarVentanaIngreso = document.getElementById('btn_ingresar');
const fondo_proceso_correcto = document.getElementById('fondo_proceso_correcto');
const btn_proceso_correcto = document.getElementById('btn_success_correcto');
const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const agregarProducto = document.getElementById('agregar_producto');


const expresiones = {
	//codigo: /^\d{1,24}$/, // Letras, numeros, guion y guion_bajo
    //nombre: /^[a-zA-ZÀ-ÿ\s]+$/, // Letras, numeros, guion y guion_bajo
	//concentracion: /^\w{0,40}\s[A-Za-z].+$/, // Letras y espacios, pueden llevar acentos.
	//f_farmaceutica: /^[a-zA-ZÀ-ÿ\s]+$/, 
	//ingreso: /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/, 
	//vencimiento: /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/, 
    //lote: /^\d{1,24}$/,
    //cantidad: /^\d{1,24}$/,
    //precio: /^\d{0,40}.\d{0,5}.\d{0,5}$/,
    //invima: /^\d.\d.+$/
    codigo: /.*/, // Letras, numeros, guion y guion_bajo
    nombre: /.*/, // Letras, numeros, guion y guion_bajo
	concentracion: /.*/, // Letras y espacios, pueden llevar acentos.
	f_farmaceutica: /.*/, 
	ingreso: /.*/, 
	vencimiento: /.*/, 
    lote: /.*/,
    cantidad: /.*/,
    precio: /.*/,
    invima: /.*/
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


//------------------ REMPLAZAR TECKA "ENTER" POR "TAB" EN LECTURA CODIGO DE BARRAS --------------------------//
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
      if(e.keyCode == 13) {
        e.preventDefault();
      }
    }))
});

document.addEventListener("DOMContentLoaded", () => {
    $('input,button,select').bind('keypress', function(event) {
        const $codigo = document.querySelector("#codigo");
        if(event.which === 13) {
        var obj = $(this).next();
        while ( obj.attr('type') === 'hidden' ){
        obj = (obj).next();
        }
        obj.focus();
        const codigoDeBarras = $codigo.value;
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    $('input,button,select').bind('keypress', function(event) {
        const $codigov = document.querySelector("#codigov");
        if(event.which === 13) {
        var obj = $(this).next();
        while ( obj.attr('type') === 'hidden' ){
        obj = (obj).next();
        }
        obj.focus();
        const codigoDeBarras = $codigov.value;
        }
    });
});

//------------------ ----------------------------------------------------------------------------//

let usuario_codigo = '';
let usuario_nombre = '';
let usuario_concentracion = '';
let usuario_f_farmaceutica = '';
let usuario_vencimiento = '';
let usuario_invima = '';
let usuario_cantidad = '';
let usuario_ingreso = '';
let usuario_precio = '';
let usuario_lote = '';



let icon_editar ='<svg class="icon-edit" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path fill="#1b7553" d="M7 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5ZM7 13.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-1-11a.5.5 0 0 1 1 0V3h2.5v-.5a.5.5 0 0 1 1 0V3H13v-.5a.5.5 0 0 1 1 0V3h.5A1.5 1.5 0 0 1 16 4.5v4.732c-.326.14-.632.342-.898.609L15 9.943V4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h3.72l-.163.653a1.936 1.936 0 0 0-.054.347H5.5A1.5 1.5 0 0 1 4 16.5v-12A1.5 1.5 0 0 1 5.5 3H6v-.5Zm9.81 8.048l-4.83 4.83a2.197 2.197 0 0 0-.578 1.02l-.375 1.498a.89.89 0 0 0 1.079 1.078l1.498-.374a2.194 2.194 0 0 0 1.02-.578l4.83-4.83a1.87 1.87 0 0 0-2.645-2.644Z"/></svg>';
let icon_borrar ='<svg class="icon-trash" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3m-5 5l4 4m0-4l-4 4"/></svg>';


let iconMenuRespon = document.getElementById('iconMenuRespon');
let detecMenu = document.getElementById('detec-menu');
let iconMenu = document.getElementById('iconMenuRespon');

let constanteIcon = 0;
iconMenu.addEventListener('click',()=>{
    if(constanteIcon == 1){
        iconMenu.removeAttribute('icon');
        iconMenu.setAttribute('icon','fontisto:nav-icon-a');
        constanteIcon = 0;
    } else {
        iconMenu.removeAttribute('icon');
        iconMenu.setAttribute('icon','maki:cross');
        constanteIcon = 1;
    }
});

detecMenu.addEventListener('click', ()=>{
    document.getElementById('menu').classList.toggle('menuActivo');
    detecMenu.classList.toggle('detec-menuActivo');
    iconMenu.removeAttribute('icon');
    iconMenu.setAttribute('icon','fontisto:nav-icon-a');
    constanteIcon = 0;
});

iconMenuRespon.addEventListener('click',()=>{
    document.getElementById('menu').classList.toggle('menuActivo');
    detecMenu.classList.toggle('detec-menuActivo');
});

//---------------------AGREGAR PRODUCTOS A EL INVENTARIO-----------------------//

function agregarUsuarios(e){
    e.preventDefault();


    let peticion = new XMLHttpRequest();
    peticion.open('POST', 'php/insertar-usuario.php');

    usuario_codigo = inputCodigo.value.trim();
    usuario_nombre = inputNombre.value.trim();
    usuario_concentracion = inputConcentracion.value.trim();
    usuario_f_farmaceutica = inputF_farmaceutica.value.trim();
    usuario_vencimiento = inputVencimiento.value.trim();
    usuario_invima = inputInvima.value.trim();
    usuario_cantidad = parseInt(inputCantidad.value.trim());
    usuario_ingreso = inputIngreso.value.trim();
    usuario_precio = inputPrecio.value.trim();
    usuario_lote = inputLote.value.trim();


    usuario_codigo = SegString(usuario_codigo);
    usuario_nombre = SegString(usuario_nombre);
    usuario_concentracion = SegString(usuario_concentracion);
    usuario_f_farmaceutica = SegString(usuario_f_farmaceutica);
    usuario_vencimiento = SegString(usuario_vencimiento);
    usuario_invima = SegString(usuario_invima);
    usuario_ingreso = SegString(usuario_ingreso);
    usuario_precio = SegString(usuario_precio);
    usuario_lote = SegString(usuario_lote);
    usuario_cantidad = SegString(usuario_cantidad);



    
    var parametros =  'codigo=' + usuario_codigo + '&nombre=' + usuario_nombre + '&concentracion=' + usuario_concentracion + '&f_farmaceutica=' + usuario_f_farmaceutica + '&vencimiento=' + usuario_vencimiento + '&invima=' + usuario_invima + '&cantidad=' + usuario_cantidad +'&ingreso=' + usuario_ingreso + '&precio=' + usuario_precio + '&lote=' + usuario_lote;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    peticion.onload = ()=>{
        inputCodigo.value = '';
        inputNombre.value = '';
        inputConcentracion.value = '';
        inputF_farmaceutica.value = '';
        inputVencimiento.value = ''; 
        inputInvima.value = '';
        inputCantidad.value = '';
        inputIngreso.value = '';
        inputPrecio.value = '';
        inputLote.value = '';
    }

    peticion.onreadystatechange = ()=>{
        if(peticion.readyState == 4 && peticion.status == 200){
            loader.classList.remove('active');
        }
    }
    peticion.send(parametros);

    
    fondo_ingresar.classList.remove('fondo_ingresarActivo');

    fondo_proceso_correcto.classList.add('fondo_proceso_correctoActivo');
    
}



//-------------DESPLEGAR EL FORMULARIO DE VENTA DE PRODUCTOS --------------//
//function cargarFormularioVenta(){
//    formularioVender.classList.toggle('formularioActivo');
//    header.classList.toggle('headerActivo');
//}

//-------------MOSTRAR EN PANTALLA MENSAJE DE CONFIRMACION DE VENTA----------//
function confirmacionVenta(){
    mensajaConfirmacion.classList.add('fondo_mensajeActivo');
}

//--------------------CERRAR MENSAJE DE CONFIRMACION DE VENTA -----------------//









btn_proceso_correcto.addEventListener('click',()=>{
    fondo_proceso_correcto.classList.remove('fondo_proceso_correctoActivo');
});

//------------------ APLCAR EVENTO A BOTON INGRESAR PRODUCTO --------------------------//
activarVentanaIngreso.addEventListener('click', ()=>{
    fondo_ingresar.classList.add('fondo_ingresarActivo');
});


//-------- APLCAR EVENTO A BOTON CERRAR  VENTANA INGRESO DE PRODUCTO ------------------//
cerrarVentanaIngreso.addEventListener('click', ()=>{
    fondo_ingresar.classList.remove('fondo_ingresarActivo');
});


//-----------------EVENTO PARA BOTON VENDER PRODUCTO----------------------------//
//btn_vender.addEventListener('click', ()=>{
//    cargarFormularioVenta();
//});


//---------EVENTO PARA BOTON CERRAR MENSAJE CONDIFRMACION VENTA----------------//
btn_cerrarMensaje.addEventListener('click', (e)=>{
    fondo_ingresar.classList.remove('fondo_ingresarActivo');
    e.preventDefault();
});

//----------------EVENTO PARA BOTON VENDER--------------------------------------//
btn_vender_producto.addEventListener('click', ()=>{
    if(!inputCodigov.value == "" && !inputCantidadv.value == ""){
        confirmacionVenta();
    }
});

//--------------------EVENTO PARA BOTON DE CARGAR INVENTARIO-------------------//
btn_cargar.addEventListener('click', ()=>{
    document.getElementById('block').classList.add('blockActivo');
    cargarUsuarios();
    setInterval(()=>{
        if(tabla.rows.length > 1){
            vencimiento();
        }
    },200);
});


function cerrarMensajeVenta(){
    mensajaConfirmacion.classList.remove('fondo_mensajeActivo');
}



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
                document.getElementById(`grupo__vencimiento`).classList.remove('formulario__grupo--incorrecto');
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
agregarProducto.addEventListener('click',()=>{
    if(inputNombre.value == ''){
        document.getElementById(`grupo__nombre`).classList.add('formulario__grupo--incorrecto');
    } 
    if (inputCantidad.value == ''){
        document.getElementById(`grupo__cantidad`).classList.add('formulario__grupo--incorrecto');
    } 
    if (inputCodigo.value == ''){
        document.getElementById(`grupo__codigo`).classList.add('formulario__grupo--incorrecto');
    } 
    if (inputPrecio.value == ''){
        document.getElementById(`grupo__precio`).classList.add('formulario__grupo--incorrecto');
    }
    if (inputIngreso.value == ''){
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
        $('#tabla').DataTable().ajax.reload();
    } else {
        e.preventDefault();
    }
});

