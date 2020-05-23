<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ver Evento</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE" async defer></script>
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link href="../controlador/css/eventos.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <script src="../controlador/js/pintarObjetos.js" type="text/javascript"></script>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin();
        ?>
        <style>

            #idEvento{
                display: none;
            }
            #menuEvento{
                padding: 2rem;
            }

            .evento{
                margin-top: 1rem;
            }

            /* #map{
                 height: 20rem;
                 width: 20rem;
             }*/

            .visual{
                display:grid;
                grid-template-areas:
                    "img map";
                grid-template-columns: 30% 70%;
            }

            .visualMap{
                height: 20rem;
                grid-template-areas:
                    "map";
                grid-template-columns: 100%;
            }

            .visualImg{
                display:grid;
                grid-template-areas:
                    "img map";
                grid-template-columns: 100%;
            }

            .eventoImg{
                grid-area:img;
            }

            #map{
                grid-area:map;
            }

            #botonParticipar, #botonYaParticipa{
                font-size: 1.5rem;
                font-weight: bold;
                width: 100%;
                background-color: #FFED91;
                height: 3rem;
                font-size: 2rem;
                transition: 1s background ease;
                border-radius: 2rem;
                cursor: pointer;
            }

            #botonParticipar:hover, #botonYaParticipa:hover{
                background-color:#FFF578;
            }

        </style>
        <script>

            $(document).ready(function () {
                cargarEvento($("#idEvento").val());
            });

            function cargarEvento(evento) {
                var parametros = {
                    "accion": "mostrarEvento",
                    "evento": evento
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var evento = JSON.parse(respuesta);
                            pintarUnEvento(evento);

                        } else {
                            window.location.href = "vistaUsuario.php";
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            /*function initMap(map, lat, lng) {
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
             icon:'../controlador/img/marker.ico',
             map: maps
             });
             }*/

            function participarEvento(evento) {
                var parametros = {
                    "accion": "participarEvento",
                    "evento": evento
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);

                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function salirDeEvento(evento) {
                var parametros = {
                    "accion": "salirDeEvento",
                    "evento": evento
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);

                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

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
                //google.maps.event.addDomListener(window, 'load', initialize);
            }

        </script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
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
                <input type="text" id="idEvento" value="<?php echo $_REQUEST['evento'] ?>">
                <div id="menuEvento">
                </div>
                <!--<div id="comentariosPost">
                    <input type="text" id="comentario" maxlength="255" placeholder="Añadir comentario">
                    <button id="enviarComentario">Enviar Comentario </button>
                    <div id="comentariosCont">

                    </div>
                </div>-->

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
