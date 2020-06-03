
function buscarUsuario(){
    new URLSearchParams(Location.search);
    var cedula = params.get('cedula');
    if (correo == "") {
        document.getElementById("usu").innerHTML = "";
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert("llegue");
                document.getElementById("usu").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/../Chabla-Palaguachi-William-Examen/public/vista/User.php?usuario="+cedula,true);
        xmlhttp.send();
    }
    return false;
}