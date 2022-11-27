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


function multiplicarinputs(){
    for(i=1; i < tabla.rows.length; i++){
        //console.log(i);
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
            //console.log('se solto1');
        } else {
            //let total = precio * inputs[0].value ;
            //total = agregarSeparadorMiles(total);
            ////console.log(i);
            //tabla.rows[i].cells[7].innerHTML = total;
        }
        
        
        
        if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
            let subprecio = agregarSeparadorMiles(precio);
            tabla.rows[i].cells[7].innerHTML = subprecio;
            //console.log('se solto1');
        } 
        if(inputs[0].value > 1){
            let total = precio * inputs[0].value ;
            
            total = agregarSeparadorMiles(total);
            //console.log(i);
            tabla.rows[i].cells[7].innerHTML = total;
        }
        
        inputs[0].addEventListener('blur',()=>{
            if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
                //inputs[0].value = '1';
                let subprecio = agregarSeparadorMiles(precio);
                tabla.rows[i].cells[7].innerHTML = subprecio;
            }
        });
    }
}
//
//
////inputs[0].addEventListener('keyup',()=>{
////    multiplicarinputs();
////});
////inputs[0].addEventListener('click',()=>{
////    multiplicarinputs();
////});
//
//
//
//
//
//function getMyWebPageChildNodes() {
//    var myChildsNode = document.body.childNodes;
//    var textMessages = "";
//    var i;
//    for (i = 0; i < myChildsNode.length; i++) {
//    textMessages = textMessages + myChildsNode[i].nodeName + "<br>";
//    }
//    
//    document.getElementById("results").innerHTML = textMessages;
//}



function cargarUsuarios(){
    //document.getElementById('tabla').innerHTML = "<tr><th>Codigo Barras</th><th>Nombre Producto</th<th>Existencia</th><th>Vencimiento</th<th>Concentracion</th><th>Precio U</th><th>Cantidad</th<th>Precio venta</th></tr>";

    let peticion = new XMLHttpRequest();
    peticion.open('POST', 'php/leer-datos.php');

    peticion.onload = ()=>{
        let datos = JSON.parse(peticion.responseText);

        if(datos.error == true){
            error_box.classList.add('active');
        } else {
            for(i=0; i < datos.length ; i++){
                let elemento = document.createElement('tr');
                elemento.innerHTML += ("<td>" + datos[i].codigo + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].nombre + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].cantidad + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].vencimiento + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].concentracion + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].precio + "</td>");
                elemento.innerHTML += ("<td><input type='number' min='1' value='1'></input></td>");
                elemento.innerHTML += ("<td>$ " + datos[i].precio + "</td>");
                document.getElementById('tabla').appendChild(elemento);
            }
        }
    }

    peticion.onreadystatechange = ()=>{
        if(peticion.readyState == 4 && peticion.status == 200){
            loader.classList.remove('active');
        }
    }

    peticion.send();
    
}

document.getElementById('formulario').addEventListener('submit',(e)=>{
    e.preventDefault();
});

btn_cargar.addEventListener('click', (e)=>{
    e.preventDefault();
    cargarUsuarios();
    setInterval(()=>{
        multiplicarinputs();
    },500);
});