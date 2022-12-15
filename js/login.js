
let btnIngresar = document.getElementById('ingresar');


function loginUsuario(){
    let peticion = new XMLHttpRequest();

    let campoUsuario = document.getElementById('usuario').value;
    let campoPassword = document.getElementById('password').value;

    peticion.open('GET', 'php/comprobar-usuario.php?usuario=' + campoUsuario + '&password=' + campoPassword, true);

    peticion.onload = ()=>{
        let datos = JSON.parse(peticion.responseText);

        if(datos.error == true){
            console.log('Tienes un error de datos no recibidos');
        } else {
            console.log(datos);
           if(datos.exito == false){
                document.getElementById('p-cont-1').classList.remove('p-cont-1Ocultar');
                document.getElementById('p-cont-1').classList.add('p-contActivo');
                document.getElementById('p-cont-2').classList.remove('p-cont-2Ocultar');
                document.getElementById('p-cont-2').classList.add('p-contActivo');
           } else {
                window.location.replace(ruta + "index.php");
           }
        }
    }

    peticion.send();

}

btnIngresar.addEventListener('click',()=>{
    loginUsuario();
});
