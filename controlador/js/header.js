
$(document).ready(function () {
    getFotoPerfil();  //Accedemos a la foto de perfil
    getNotificaciones(); //Accedemos a nuestras notificaciones
    getMensajes(); //Accedemos a nuestros mensajes
    setInterval(function () { //Cada vez que se ejecute veremos nuestras notificaciones y mensajes
        getNotificaciones();
        getMensajes();
    }, 10000);
});

function getFotoPerfil() { //Accedemos a la foto de perfil
    var parametros = {
        "accion": "getFotoPerfil"
    };

    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        success: function (respuesta) {
            if (respuesta) { //Si hay respuesta
                var p = document.getElementsByClassName("perfil");
                for (var i = 0; i < p.length; i++) {
                    //Le ponemos nuestra imagen
                    p[i].setAttribute("src", "../controlador/uploads/usuarios/" + respuesta);
                }
            }

        },
        error: function (xhr, status) {
            alert("Error al acceder a la foto de perfil");
        },
        type: "POST",
        dataType: "text"
    });

}

function getMensajes() { //Accedemos a los mensajes de nuestro usuario
    var parametros = {
        "accion": "mensajesNoVistos"
    };
    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        success: function (respuesta) {
            if (respuesta) { //Si tenemos respuesta
                var mensajes = JSON.parse(respuesta);
                var mensaje = 0; //Por defecto tendremos 0 mensajes

                for (var i = 0; i < mensajes.length; i++) {
                    if (mensajes[i].visto == 0) { //Cada vez que haya un mensaje que no hemos visto
                        mensaje++; //Mensaje se incrementa
                    }
                }
                if (mensaje > 0) { //Si mensaje es mayor a 0 
                    $("#mensaje").css("display", "block"); //Se muestra
                    $("#mensajeM").css("display", "block");
                    if (mensaje > 9) { //Si es mayor a nueve
                        $("#mensaje").text(9 + "+"); //Se muestra 9+
                        $("#mensajeM").text(9 + "+");
                    } else {
                        $("#mensaje").text(mensaje); //Si está entre 0 y 9 los mensajes son exactamente el número
                        $("#mensajeM").text(mensaje);
                    }
                } else { //Si mensaje es = 0 se oculta
                    $("#mensaje").css("display", "none");
                    $("#mensajeM").css("display", "none");
                }

            } else { //Si no hay respuesta se oculta
                $("#mensaje").css("display", "none");
                $("#mensajeM").css("display", "none");
            }

        },
        error: function (xhr, status) {
            alert("Error al mostrar mensajes");
        },
        type: "POST",
        dataType: "text"
    });

}

function getNotificaciones() { //Accedemos a las notificaciones
    var parametros = {
        "accion": "mostrarNotificaciones"
    };

    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        success: function (respuesta) {
            if (respuesta) { //Si hay respuesta
                var notificaciones = JSON.parse(respuesta);
                var notificacion = 0; //Por defecto es 0

                for (var i = 0; i < notificaciones.length; i++) { //reccoremos
                    if (notificaciones[i].visto == 0) { //Si no las hemos visto
                        notificacion++; //Se incrementa
                    }
                }

                if (notificacion > 0) { //si es mayor a 0 se muestra
                    $("#notificacion").css("display", "block");
                    $("#notificacionM").css("display", "block");
                    if (notificacion > 9) { //Si es mayor a 9 se muestra "9+"
                        $("#notificacion").text(9 + "+");
                        $("#notificacionM").text(9 + "+");
                    } else { //si están entre 0 y 9 se escribe el número d enotificaciones
                        $("#notificacion").text(notificacion);
                        $("#notificacionM").text(notificacion);
                    }
                } else { //Se ocultan si no hay notificaciones
                    $("#notificacion").css("display", "none");
                    $("#notificacionM").css("display", "none");
                }

            } else { //Si no hay respuesta se ocultan
                $("#notificacion").css("display", "none");
                $("#notificacionM").css("display", "none");
            }

        },
        error: function (xhr, status) {
            alert("Error al mostrar notificaciones");
        },
        type: "POST",
        dataType: "text"
    });

}