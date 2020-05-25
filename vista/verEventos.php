<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>FacePet</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin();
        $_SESSION['posts'] = "";
        ?>
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/eventos.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <script src="../controlador/js/pintarObjetos.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE&callback=initMap" async defer></script>
        <style>

        </style>
        <script>

            var cargando = 0;
            var cantidad = 5;

            $(document).ready(function () {
                mostrarEventos();
                //google.maps.event.addDomListener(window, 'load', initMap);

                $("#checkLugar").click(function () {
                    mostrarEventos();
                });

                $("#rdFechaI").click(function () {
                    mostrarEventos();
                });

                $("#rdFechaF").click(function () {
                    mostrarEventos();
                });

            });

            $(window).scroll(function () {

                console.log($("#cuerpo").height() - 800);
                console.log($(window).scrollTop());
                if ($(window).scrollTop() > $("#cuerpo").height() - 800 && $(window).width() > 1000) {

                    cargando += 1;
                    if (cargando == 1) {
                        cantidad += 5;
                        mostrarEventos();
                    }

                } else if ($(window).scrollTop() > $("#cuerpo").height() - 2000) {
                    cargando += 1;
                    console.log($(window).scrollTop());
                    if (cargando == 1) {
                        cantidad += 5;
                        mostrarEventos();
                    }
                } else {
                    cargando = 0;
                }

            });

            function initMap(map, lat, lng) {
                var maps = new google.maps.Map(map, {
                    center: {lat: parseFloat(lat), lng: parseFloat(lng)},
                    zoom: 16,
                    streetViewControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    zoomControl: false,
                    scrollwheel: false,
                    fullscreenControl: false
                });
                new google.maps.Marker({
                    position: {lat: parseFloat(lat), lng: parseFloat(lng)},
                    icon: '../controlador/img/marker.ico',
                    map: maps
                });

                google.maps.event.addDomListener(window, 'load', initMap);
            }

            function mostrarEventos() {

                var checkLugar = false;
                //var checkParticipantes = false;

                if ($('#checkLugar').is(':checked')) {
                    checkLugar = true;
                }

                var rdFecha = $('input[name=rdfecha]:checked').val();

                /* if ($("#checkParticipantes").is(':checked')){
                 checkParticipantes = true;
                 }*/
                console.log(rdFecha);
                console.log(checkLugar);


                var parametros = {
                    "accion": "mostrarEventosCantidad",
                    "cantidad": cantidad,
                    "checkLugar": checkLugar,
                    "rdFecha": rdFecha/*,
                     "checkParticipantes": checkParticipantes*/
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta) {
                            $("#cadEventos").val("");
                            $("#eventos").empty();
                            console.log(respuesta);
                            var eventos = JSON.parse(respuesta);
                            console.log(eventos[0].miProvincia);
                            pintarEventos(eventos, "eventos");


                        } else {
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Aquí se mostraran los eventos, pero ahora mismo no hay ninguno";
                            $("#eventos").append(h1);
                        }

                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

        </script>
    </head>
    <body>

        <div id="principal">
            <header>
                <nav id="navpc">
                    <a href="vistaUsuario.php" id="facepetA"><img src="../controlador/img/facepet.png" id="facepet"></a>
                    <li><a href="vistaUsuario.php">Inicio</a></li>
                    <li><a href="miPerfil.php">Mi Perfil</a></li>
                    <li id="crear">Crear
                        <ul>
                            <li><a href="crearPost.php">Crear Post</a></li>
                            <li><a href="crearEvento.php">Crear Evento</a></li>
                        </ul>
                    </li>
                    <li><a href="buscarAmigos.php">Buscar Amigos</a></li>
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" class="mensajes" alt="mensajes"><p style="display:none;" class="alerta" id="mensaje"></p></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" class="notificaciones" alt="notificaciones"><p style="display:none;" class="alerta" id="notificacion"></p></a></li>
                    <li id="liUsuario">
                        <a href="miPerfil.php">
                            <img class="perfil" alt="imgPerfil">
                            <span id="nombreUsuario"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <img src="../controlador/img/abajo.png" id="abajo" alt="abajo">
                        <ul>
                            <li><a href="../index.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </nav>

                <div id="cabeceramv">
                    <a href="vistaUsuario.php" id="facepetAMV"><img src="../controlador/img/facepet.png" id="facepetMV" alt="logo"></a>
                    <nav class="menuHTML">
                        <div id="hamburguesa">
                            <label for="menu-toggle">
                                <div class="botonMenu">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </label>
                        </div>
                        <input type="checkbox" id="menu-toggle"/>
                        <ul id="trickMenu">
                            <a href="miPerfil.php"><li>Mi Perfil</li></a>
                            <a href="crearPost.php"><li>Crear Post</li></a>
                            <a href="crearEvento.php"><li>Crear Evento</li></a>
                            <a href="buscarAmigos.php"><li>Buscar Amigos</li></a>
                        </ul>
                    </nav>
                </div>
            </header>

            <div id="cuerpo">
                <!--<input type="checkbox" id="checkTitle" value="title"><span>Escribir título</span>-->
                <input type="checkbox" id="checkLugar" value="lugar" checked><span>Ordenar por lugar</span>
                <input type="radio" id="rdFechaI" name="rdfecha" value="fechai" checked><span>Ordenar por fecha inicio</span>
                <input type="radio" id="rdFechaF" name="rdfecha" value="fechaf"><span>Ordenar por fecha fin</span>
                <!--<input type="checkbox" id="checkParticipantes" value="participantes"><span>Ordenar por participantes</span>-->
                <input type="text" id="cadEventos" style="display:none">
                <div id="eventos">

                </div>
            </div>

            <footer>
                <ul id="segundoMenu">
                    <li class="icono"><a href="../index.php"><img src="../controlador/img/cerrar-sesion.png" class="cerrarsesion" alt="cerrarSesion"></a></li>
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" class="mensajes" alt="mensajes"><p class="alerta" id="mensajeM">1</p></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" class="notificaciones" alt="notificaciones"><p class="alerta" id="notificacionM">1</p></a></li>
                    <li id="liUsuario">
                        <a href="miPerfil.php">
                            <img class="perfil" alt="imgPerfil">
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
    </body>
</html>
