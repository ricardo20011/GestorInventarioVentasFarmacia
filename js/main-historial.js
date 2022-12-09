
btn_consultar = document.getElementById('consultar');



function cargarUsuarios(){
    let peticion = new XMLHttpRequest();
    
    let inputInicio = document.getElementById('inputInicio').value;
    inputInicio = moment(inputInicio).format("YYYY/MM/DD");

    let inputFin = document.getElementById('inputFin').value;
    inputFin = moment(inputFin).format("YYYY/MM/DD");

    peticion.open('GET', 'php/leer-datos-historial.php?inicio=' + inputInicio + '&fin=' + inputFin, true);

    peticion.onload = ()=>{
        document.getElementById('cuerpoTabla').innerHTML = "";
        let datos = JSON.parse(peticion.responseText);


        if(datos.error == true){
            error_box.classList.add('active');
        } else {
            for(i=0; i < datos.length ; i++){
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
                document.getElementById('cuerpoTabla').appendChild(elemento);
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
    let inputInicio = document.getElementById('inputInicio');
    let inputFin = document.getElementById('inputFin');
    if(inputInicio.value == "" || inputFin.value == ""){
        document.getElementById('fondoFecha').classList.add('fondoFechaActivo');
        setTimeout(()=>{
            document.getElementById('fondoFecha').classList.remove('fondoFechaActivo');
        },2000);
    } else {
        e.preventDefault();
        cargarUsuarios();
    }
});