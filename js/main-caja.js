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



function multiplicarinputs(){
    for(i=1; i < tabla.rows.length; i++){
        let precio = tabla.rows[i].cells[5].innerHTML;
        precio = quitarSeparadorMiles(precio);
        precio = parseInt(precio);
        
        let inputs = tabla.rows[i].cells[6].childNodes;
        
        
        console.log(inputs[0].setAttribute("id","NV"+[i]));
        
        function h(){
            if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
                let subprecio = agregarSeparadorMiles(precio);
                tabla.rows[i].cells[7].innerHTML = subprecio;
                console.log('se solto1');
            } else {
                let total = precio * inputs[0].value ;
                total = agregarSeparadorMiles(total);
                
                tabla.rows[i].cells[7].innerHTML = total;
            }
        }
        
        inputs[0].addEventListener('keyup',()=>{
            h();
            console.log('se solto');
        });
        
        inputs[0].addEventListener('click',()=>{
            h();
        });
        inputs[0].addEventListener('blur',()=>{
            if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
                inputs[0].value = '1';
                let subprecio = agregarSeparadorMiles(precio);
                tabla.rows[i].cells[7].innerHTML = subprecio;
            }
        });
        parseInt(inputs[0].value);
    }
}






function getMyWebPageChildNodes() {
    var myChildsNode = document.body.childNodes;
    var textMessages = "";
    var i;
    for (i = 0; i < myChildsNode.length; i++) {
    textMessages = textMessages + myChildsNode[i].nodeName + "<br>";
    }
    
    document.getElementById("results").innerHTML = textMessages;
}