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



btn_consultar = document.getElementById('consultar');

let tabla2 = document.getElementById('tabla');


function cargarProductos(){
    let peticion = new XMLHttpRequest();
    
    let inputInicio = document.getElementById('inputInicio').value;
    inputInicio = moment(inputInicio).format("YYYY/MM/DD");

    let inputFin = document.getElementById('inputFin').value;
    inputFin = moment(inputFin).format("YYYY/MM/DD");

    peticion.open('GET', 'php/leer-datos-historial.php?inicio=' + inputInicio + '&fin=' + inputFin, true);

    peticion.onload = ()=>{
        document.getElementById('cuerpoTabla').innerHTML = "<tr id='ultima'></tr>";

        
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');
        let td5 = document.createElement('td');
        let td6 = document.createElement('td');
        let td7 = document.createElement('td');
        let td8 = document.createElement('td');
        let td9 = document.createElement('td');
        td1.innerText = ('321551');
        td3.innerText = ('0');
        td5.innerText = ('0');
        document.getElementById('ultima').appendChild(td1);
        document.getElementById('ultima').appendChild(td2);
        document.getElementById('ultima').appendChild(td3);
        document.getElementById('ultima').appendChild(td4);
        document.getElementById('ultima').appendChild(td5);
        document.getElementById('ultima').appendChild(td6);
        document.getElementById('ultima').appendChild(td7);
        document.getElementById('ultima').appendChild(td8);
        document.getElementById('ultima').appendChild(td9);
        
        let datos = JSON.parse(peticion.responseText);

        let filaAnterior = tabla2.rows[1];


        if(datos.error == true){
            error_box.classList.add('active');
        } else {
            
            for(i=0; i < datos.length ; i++){
                let elemento = tabla2.insertRow(filaAnterior.rowIndex);
                elemento.innerHTML += ("<td>" + datos[i].codigoFact + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].codigo + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].nombre + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].PrecioU + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].cantidad + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].total + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].fecha + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].hora + "</td>");


                let j = i + 1;
                elemento.innerHTML += ("<td>" + datos[i].totalFact + "</td>");
                


                if(tabla2.rows[i].cells[0].innerHTML == tabla2.rows[j].cells[0].innerHTML){
                    tabla2.rows[i].cells[8].innerHTML = "";
                }

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

function sumarTotal(){
    cellTotal = 0;
    cantidadT = 0;
    let tablaTotal = document.getElementById('table-total');
    for(i = 1; i < tabla2.rows.length; i++){
        
        let precioVenta = tabla2.rows[i].cells[8].innerHTML;
        let cantidadP = tabla2.rows[i].cells[4].innerHTML;

        let array = Array.from(precioVenta);
        array.shift();
        array.shift();
        precioVenta = array.join('');
        precioVenta = quitarSeparadorMiles(precioVenta);
        

        cellTotal = cellTotal + Number(precioVenta);
        cantidadT = cantidadT + Number(cantidadP);
        
    }
    tablaTotal.rows[0].cells[3].innerHTML = "$ " + agregarSeparadorMiles(cellTotal);
    tablaTotal.rows[0].cells[1].innerHTML = cantidadT;
}

btn_consultar.addEventListener('click', (e)=>{
    let inputInicio = document.getElementById('inputInicio');
    let inputFin = document.getElementById('inputFin');

    if(inputInicio.value == "" || inputFin.value == ""){
        document.getElementById('fondoFecha').classList.add('fondoFechaActivo');
        setTimeout(()=>{
            document.getElementById('fondoFecha').classList.remove('fondoFechaActivo');
        },2000);
    } else {
        e.preventDefault();
        cargarProductos();
        setInterval(()=>{
            sumarTotal();
        },500);
    }
});