let public = "https://www.rickbroken.com/farmacia/";
let local = "http://localhost/farmacia/";

let ruta = local;

function stripHtml(html) {
    var tmp = document.createElement("DIV");
    html = html.toString().replace(/"/g, '');
    html = html.toString().replace(/'/g, '');
    html = html.toString().replace(/`/g, '');
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}
function SegString(input){
    input = stripHtml(input);
    input = input.toString().replace(/</g, '');
    input = input.toString().replace(/>/g, '');
    return input;
}
