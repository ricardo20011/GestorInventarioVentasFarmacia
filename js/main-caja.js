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

tabla = document.getElementById('tabla');
btn_cargar = document.getElementById('addProducto');
campoValor = document.getElementById('campo').value;
campo = document.getElementById('campo');
let icon_borrar ="<iconify-icon icon='tabler:trash-x' style='color: #bd2626;' width='23'></iconify-icon>";
btnVender = document.getElementById('vender');


tabla.addEventListener('click', (e)=>{
    if(e.target.parentNode.parentNode.tagName == 'TD'){
        e.target.parentNode.parentNode.parentNode.remove();
    }
});

function multiplicarinputs(){
    cellTotal = 0;
    for(i=1; i < tabla.rows.length; i++){

        let precio = tabla.rows[i].cells[5].innerHTML;
        precio = quitarSeparadorMiles(precio);
        precio = parseInt(precio);
        
        let inputs = tabla.rows[i].cells[6].children;
        
        
        let valor = "";
        valor = inputs[0].value;
        
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
        alert('Ingresa un codigo de barras :)');
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
                    elemento.innerHTML += ("<td>" + datos[i].concentracion + "</td>");
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
                alert('Producto ya esta en la lista de compra :)');
            }
         }
    }
}



let obj = {};
let hoy = moment().format('YYYY/MM/DD');
let hora = moment().format('h:mm a');
let codigoFact = moment().unix();

btnVender.addEventListener('click',()=>{
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
        console.log(obj);

       
        

        let peticion = new XMLHttpRequest();

        let encapsulado = JSON.stringify(obj);
        //console.log(encapsulado);

    
        peticion.onreadystatechange = ()=>{
            if(peticion.readyState == 4 && peticion.status == 200){
            }
        }
        
        peticion.open('GET', 'php/vender-producto.php?encapsulado=' + encapsulado, true);
        peticion.send();

        
        //peticion.open("POST", "php/vender-producto.php", true);
        //peticion.setRequestHeader("Content-type", "application/x-www.form-urlencoded");
        //peticion.send("d="+encapsulado);

        location.href ="http://localhost/farmacia/index.php";
    
    } else {
        console.log('no se envio el formulario');
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