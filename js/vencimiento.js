let tablaInventario = document.getElementById('tabla');

function vencimiento (){
    for (i=1 ; i < tablaInventario.rows.length; i++){

        let hoy = moment();
     
        hoy.format('YYYY/MM/DD');
    
        let vencimiento = tablaInventario.rows[i].cells[4].innerHTML;
        let parrafoetiqueta = tablaInventario.rows[i].cells[4];
        parrafoetiqueta.setAttribute("id","NV"+[i]);
        vencimiento = vencimiento;

        var fecha1 = moment(hoy);
        var fecha2 = moment(vencimiento);
    
        diasFaltantes = fecha2.diff(fecha1, 'days');
    
    
        if(diasFaltantes <= 90 ){
            parrafoetiqueta.classList.add('rojo');
        }
        if(diasFaltantes > 90 && diasFaltantes <= 180){
            parrafoetiqueta.classList.add('amarillo');    
        }
        if(diasFaltantes > 180){
            parrafoetiqueta.classList.add('verde');  
        }
    }
    

}