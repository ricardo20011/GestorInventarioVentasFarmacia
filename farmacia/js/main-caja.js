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


setInterval(()=>{

    if(tabla.rows.length > 1){
        let precio = tabla.rows[1].cells[5].innerHTML;
        precio = quitarSeparadorMiles(precio);
        precio = parseInt(precio);
        
        let inputs = tabla.rows[1].cells[6].childNodes;


        inputs[0].setAttribute("id","NV"+[i]);

        function h(){
            if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
                let subprecio = agregarSeparadorMiles(precio);
                tabla.rows[1].cells[7].innerHTML = subprecio;
            } else {
                let total = precio * inputs[0].value ;
                total = agregarSeparadorMiles(total);
                
                tabla.rows[1].cells[7].innerHTML = total;
            }
        }

        inputs[0].addEventListener('keyup',()=>{
            h();
        });
        
        inputs[0].addEventListener('click',()=>{
            h();
        });
        inputs[0].addEventListener('blur',()=>{
            if(inputs[0].value == '' || inputs[0].value == '0' || inputs[0].value < 1){
                inputs[0].value = '1';
                let subprecio = agregarSeparadorMiles(precio);
                tabla.rows[1].cells[7].innerHTML = subprecio;
            }
        });

        
        parseInt(inputs[0].value);



    }
},1000)





function getMyWebPageChildNodes() {
    var myChildsNode = document.body.childNodes;
    var textMessages = "";
    var i;
    for (i = 0; i < myChildsNode.length; i++) {
    textMessages = textMessages + myChildsNode[i].nodeName + "<br>";
    }
    
    document.getElementById("results").innerHTML = textMessages;
}