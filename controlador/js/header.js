
$(document).ready(function () {
    getFotoPerfil();
    getNotificaciones();
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
            for (var i = 0; i < p.length; i++) {
                p[i].setAttribute("src", "../controlador/uploads/usuarios/" + respuesta);
            }

        },
        error: function (xhr, status) {
            alert("Error al acceder a la foto de perfil");
        },
        type: "POST",
        dataType: "text"
    });

}

function getNotificaciones() {
    var parametros = {
        "accion": "mostrarNotificaciones"
    };

    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        success: function (respuesta) {

            if (!respuesta) {

                var notificaciones = JSON.parse(respuesta);
                var notificacion=0;
                
                for(var i=0;i<notificaciones.length;i++){
                    if(notificaciones[i].visto == 0){
                        notificacion++;
                    }
                }
                                
                if(notificacion>0){
                    $("#notificacion").css("display", "block");
                    $("#notificacion").val(notificacion);
                } else {
                    $("#notificacion").css("display", "none");
                }

            } else {
                $("#notificacion").css("display", "none");
            }

        },
        error: function (xhr, status) {
            alert("Error al mostrar notificaciones");
        },
        type: "POST",
        dataType: "text"
    });

}