
$(document).ready(function () {
    getFotoPerfil();
    getNotificaciones();
    getMensajes();
    setInterval(function () {
        getNotificaciones();
        getMensajes();
    }, 2000);
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

function getMensajes(){
    var parametros = {
        "accion": "mensajesNoVistos"
    };
    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        success: function (respuesta) {
            if (respuesta) {
                var mensajes = JSON.parse(respuesta);
                var mensaje = 0;

                for (var i = 0; i < mensajes.length; i++) {
                    if (mensajes[i].visto == 0) {
                        mensaje++;
                    }
                }
                if (mensaje > 0) {
                    $("#mensaje").css("display", "block");
                    $("#mensaje").text(mensaje);
                } else {
                    $("#mensaje").css("display", "none");
                }

            } else {
                $("#mensaje").css("display", "none");
            }

        },
        error: function (xhr, status) {
            alert("Error al mostrar notificaciones");
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
            if (respuesta) {
                var notificaciones = JSON.parse(respuesta);
                var notificacion = 0;

                for (var i = 0; i < notificaciones.length; i++) {
                    if (notificaciones[i].visto == 0) {
                        notificacion++;
                    }
                }

                if (notificacion > 0) {
                    $("#notificacion").css("display", "block");
                    $("#notificacion").text(notificacion);
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