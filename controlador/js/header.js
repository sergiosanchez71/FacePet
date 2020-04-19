
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
            alert("Error en la creación de post");
        },
        type: "POST",
        dataType: "text"
    });

}

function getNotificaciones() {
    var parametros = {
        "accion": "getNotificaciones"
    };

    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        success: function (respuesta) {

            if (respuesta != "null") {

                var notificaciones = JSON.parse(respuesta);
                console.log(notificaciones.length);

                $("#notificacion").css("display", "block");
                $("#notificacion").val(notificaciones.length);
               // $("#notificacion").innerHTML = notificaciones.length;

            } else {
                $("#notificacion").css("display", "none");
            }

        },
        error: function (xhr, status) {
            alert("Error en la creación de post");
        },
        type: "POST",
        dataType: "text"
    });

}