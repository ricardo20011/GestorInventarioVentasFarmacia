function agregarSeparadorMiles(numero) {
    let partesNumero = numero.toString().split('.');

    partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    return partesNumero.join('.');
}
function quitarSeparadorMiles(numero) {
    let partesNumero = numero.toString().split('.');

    partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, '');

    return partesNumero.join('');
}



let tabla = document.getElementById('tabla');
let btn_cargar = document.getElementById('addProducto');
let campoValor = document.getElementById('campo').value;
campoValor = SegString(campoValor);
let campo = document.getElementById('campo');
campo = SegString(campo);
let icon_borrar ='<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="#bd2626" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3m-5 5l4 4m0-4l-4 4"/></svg>';
let btnVender = document.getElementById('vender');
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

tabla.addEventListener('click', (e)=>{
    if(e.target.parentNode.parentNode.tagName == 'TD'){
        e.target.parentNode.parentNode.parentNode.remove();
    }
});

function multiplicarinputs(){
    let cellTotal = 0;
    for(i=1; i < tabla.rows.length; i++){

        let precio = tabla.rows[i].cells[5].innerHTML;
        precio = quitarSeparadorMiles(precio);
        precio = parseInt(precio);
        
        let inputs = tabla.rows[i].cells[6].children;
        
        
        let valor = "";
        valor = inputs[0].value;
        valor = SegString(valor);
        
        if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 0){
            let subprecio = agregarSeparadorMiles(precio);
            tabla.rows[i].cells[7].innerHTML = subprecio;
            inputs[0].value = valor;
        }
        
        
        if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
            let subprecio = agregarSeparadorMiles(precio);
            tabla.rows[i].cells[7].innerHTML = subprecio;
        } 
        if(inputs[0].value > 0){
            let total = precio * inputs[0].value ;
            
            total = agregarSeparadorMiles(total);

            tabla.rows[i].cells[7].innerHTML = '' + total;
        }
        
        inputs[0].addEventListener('blur',()=>{
            if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
                inputs[0].value = '1';
                let subprecio = agregarSeparadorMiles(precio);
                tabla.rows[i].cells[7].innerHTML = subprecio;
            }
        });

        let precioVenta = tabla.rows[i].cells[7].innerHTML;

        precioVenta = quitarSeparadorMiles(precioVenta);
        
        cellTotal = cellTotal + Number(precioVenta);


//
    }
    let tablaTotal = document.getElementById('table-total');
    
    tablaTotal.rows[0].cells[3].innerHTML = "$ " + agregarSeparadorMiles(cellTotal);

}

function cargarUsuarios(){
    if(campo.value == ""){
        document.getElementById('fondoCodigo').classList.add('fondoCodigoActivo');
        setTimeout(()=>{
            document.getElementById('fondoCodigo').classList.remove('fondoCodigoActivo');
        },1500);
    } else if(campo.value != "Repetido"){

        let peticion = new XMLHttpRequest();
        
        let input = document.getElementById('campo').value;
    
        peticion.open('GET', 'php/leer-datos-caja.php?campo=' + input, true);
    
        peticion.onload = ()=>{
            let datos = JSON.parse(peticion.responseText);
    
    
            if(datos.error == true){
                error_box.classList.add('active');
            } else {
                for(i=0; i < datos.length ; i++){
                    let elemento = document.createElement('tr');
                    elemento.innerHTML += ("<td>" + datos[i].codigo + "</td>");
                    elemento.innerHTML += ("<td>" + datos[i].nombre + "</td>");
                    elemento.innerHTML += ("<td class='filaCentrar'>" + datos[i].cantidad + "</td>");
                    elemento.innerHTML += ("<td class='eliminarPrimera'>" + datos[i].concentracion + "</td>");
                    elemento.innerHTML += ("<td class='filaCentrar'>" + datos[i].vencimiento + "</td>");
                    elemento.innerHTML += ("<td class='filaCentrar'>" + datos[i].precio + "</td>");
                    elemento.innerHTML += ("<td><input type='number' min='1' value='1'></input></td>");
                    elemento.innerHTML += ("<td class='filaCentrar'>" + datos[i].precio + "</td>");
                    elemento.innerHTML += ("<td class='filaCentrar'><span class='icon_borrar' id='N" + [i] + "'>" + icon_borrar + "</span></td>");
                    document.getElementById('tabla').appendChild(elemento);
                }
            }
        }
    
        peticion.onreadystatechange = ()=>{
            if(peticion.readyState != 4 && peticion.status != 200){
                console.log('algo salio mal con la conexion');
            }
        }
    
    
        peticion.send();
    
    }

}

function validarRepetidos(){
    for(i=0 ; i < tabla.rows.length ; i++){
        let codigo = tabla.rows[i].cells[0].innerHTML;
         if(campo.value == codigo){
            campo.value = 'Repetido';
            if(campo.value == 'Repetido'){
                document.getElementById('fondoDuplicado').classList.add('fondoDuplicadoActivo');
                setTimeout(()=>{
                    document.getElementById('fondoDuplicado').classList.remove('fondoDuplicadoActivo');
                },1500);
            }
         }
    }
}



let obj = {};
let hoy = moment().format('YYYY/MM/DD');
let hora = moment().format('h:mm a');
let codigoFact = moment().unix();

function confirmarVenta(){
    if(tabla.rows.length - 1 > 0){
        console.log('se envie el formulario');

        for(i=1;i < tabla.rows.length; i++){
            codigo = tabla.rows[i].cells[0].innerHTML;
            nombre = tabla.rows[i].cells[1].innerHTML;
            existencia = tabla.rows[i].cells[2].innerHTML;
            precio = tabla.rows[i].cells[5].innerHTML;
            cantidad = tabla.rows[i].cells[6].firstChild.value;
            total = tabla.rows[i].cells[7].innerHTML;
            totalFact = document.getElementById('totalFactura').innerHTML;

            if(i < tabla.rows.length){
                obj[i - 1] = {
                    "codigoFact" : codigoFact,
                    "codigo" : codigo,
                    "nombre" : nombre,
                    "existencia" : existencia,
                    "precio" : precio,
                    "cantidad" : cantidad,
                    "total" : total,
                    "fecha" : hoy,
                    "hora" : hora,
                    "totalFact" : totalFact
                };
            }
        }
        //console.log(obj);
        
        let encapsulado = JSON.stringify(obj);

        let peticion = new XMLHttpRequest();

        //console.log(encapsulado);

        
        //peticion.open('GET', 'php/vender-producto.php?encapsulado=' + encapsulado, true);
        //peticion.send();

        
        peticion.open("POST", "php/vender-producto.php");
        peticion.setRequestHeader("Content-Type", "application/json");
        peticion.send(encapsulado);

        location.href = ruta;

    } else {
        console.log('no se envio el formulario');
    }
}

btnVender.addEventListener('click',(e)=>{
    if(tabla.rows.length > 1){
        e.preventDefault();
        document.getElementById('fondoVenta').classList.add('fondoVentaActivo');
    }
});


btn_cargar.addEventListener('click', (e)=>{
    e.preventDefault();
    validarRepetidos();
    cargarUsuarios();
    setInterval(()=>{
        multiplicarinputs();
        vencimiento();
    },500);
    document.getElementById('campo').value = ""; 
});

let confirmarVentaSi = document.getElementById('confirmarVenta');
let cancelarVentaNo = document.getElementById('cancelarVenta');
confirmarVentaSi.addEventListener('click',()=>{
    document.getElementById('fondoVenta').classList.remove('fondoVentaActivo');
    document.getElementById('fondoExito').classList.add('fondoExitoActivo');
    setTimeout(()=>{
        document.getElementById('fondoExito').classList.remove('fondoExitoActivo');
        confirmarVenta();
    },1500);
});
cancelarVentaNo.addEventListener('click',()=>{
    document.getElementById('fondoVenta').classList.remove('fondoVentaActivo');
});