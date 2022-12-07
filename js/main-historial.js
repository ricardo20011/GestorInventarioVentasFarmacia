
btn_consultar = document.getElementById('consultar');



function cargarUsuarios(){
    let peticion = new XMLHttpRequest();
    
    let inputInicio = document.getElementById('inputInicio').value;
    let inputFin = document.getElementById('inputFin').value;
    console.log(inputFin + inputInicio);

    peticion.open('GET', 'php/leer-datos-historial.php?inicio=' + inputInicio + '&fin=' + inputFin, true);

    peticion.onload = ()=>{
        let datos = JSON.parse(peticion.responseText);


        if(datos.error == true){
            error_box.classList.add('active');
        } else {
            for(i=0; i < datos.length ; i++){
                console.log(datos[i]);
                let elemento = document.createElement('tr');
                elemento.innerHTML += ("<td>" + datos[i].codigoFact + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].codigo + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].nombre + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].PrecioU + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].cantidad + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].total + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].fecha + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].hora + "</td>");
                elemento.innerHTML += ("<td>" + datos[i].totalFact + "</td>");
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


btn_consultar.addEventListener('click', (e)=>{
    e.preventDefault();
    cargarUsuarios();
});