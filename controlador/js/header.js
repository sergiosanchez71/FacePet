
$(document).ready(function () {
    getFotoPerfil();
});

function getFotoPerfil() {
    var parametros = {
        "accion": "getFotoPerfil"
    };

    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        success: function (respuesta) {
            var p = document.getElementsByClassName("perfil");
            for(var i=0;i<p.length;i++){
                p[i].setAttribute("src", "../controlador/uploads/usuarios/" + respuesta);
            }
            
        },
        error: function (xhr, status) {
            alert("Error en la creación de post");
        },
        type: "POST",
        dataType: "text"
    });

}