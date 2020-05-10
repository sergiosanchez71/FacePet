<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link href="../controlador/css/eventos.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE" async defer></script>
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
                            var eventos = JSON.parse(respuesta);
                            var evento = document.createElement("div");
                            evento.setAttribute("class", "evento");

                            var titulo = document.createElement("p");
                            titulo.setAttribute("class", "eventoTitulo");
                            titulo.innerHTML = eventos.titulo;
                            titulo.setAttribute("data-value", eventos.id);

                            titulo.onclick = function () {
                                window.location.href = "verEvento.php?evento=" + this.dataset.value;
                            }

                            var textTipo = document.createElement("p");
                            textTipo.setAttribute("class", "textTipo");

                            var tipo = document.createElement("span");
                            tipo.setAttribute("class", "eventoTipo");
                            tipo.innerHTML = eventos.tipo;

                            var textFechai = document.createElement("p");
                            textFechai.setAttribute("class", "textFechai");

                            var textFechaf = document.createElement("p");
                            textFechaf.setAttribute("class", "textFechaf");

                            var fechai = document.createElement("span");
                            fechai.setAttribute("class", "eventoFecha");
                            fechai.innerHTML = eventos.fechai;
                            if (eventos.empezado) {
                                fechai.setAttribute("style", "color:#126310");
                                fechai.setAttribute("title","Evento actualmente activo");
                            }

                            var fechaf = document.createElement("span");
                            fechaf.setAttribute("class", "eventoFecha");
                            fechaf.innerHTML = eventos.fechaf;

                            var cont = document.createElement("div");
                            cont.setAttribute("class", "cont");


                            var contenido = document.createElement("p");
                            contenido.setAttribute("class", "eventoContenido");
                            contenido.innerHTML = eventos.contenido;

                            if (eventos.foto) {
                                var img = document.createElement("img");
                                img.setAttribute("class", "eventoImg");
                                img.setAttribute("src", "../controlador/uploads/eventos/" + eventos.foto);
                                img.setAttribute("alt", "imgagenEvento");
                            }


                            if (eventos.lat && eventos.lng) {
                                var map = document.createElement("div");
                                map.setAttribute("id", "map");
                                initMap(map, eventos.lat, eventos.lng);
                            }

                            var visual = document.createElement("div");
                            if (eventos.foto && eventos.lat && eventos.lng) {
                                visual.setAttribute("class", "visual");
                            } else if (eventos.foto) {
                                visual.setAttribute("class", "visualImg");
                            } else {
                                visual.setAttribute("class", "visualMap");
                                map.setAttribute("style", "height:20rem");
                            }

                            var textAutor = document.createElement("p");
                            textAutor.setAttribute("class", "eventoAutor");


                            var autor = document.createElement("span");
                            autor.setAttribute("class", "eventoNombreAutor");
                            autor.innerHTML = eventos.autor;
                            autor.setAttribute("data-value", eventos.usuario);

                            if (eventos.participable) {
                                var textParticipantes = document.createElement("p");
                                var participantes = document.createElement("span");
                                var part;
                                if (eventos.participable == "t") {
                                    part = "0";
                                } else {
                                    part = eventos.participantes.length;
                                }
                                participantes.innerHTML = part;


                                var botonParticipar = document.createElement("button");
                                botonParticipar.setAttribute("id", "botonParticipar");
                                botonParticipar.setAttribute("value", eventos.id);
                                botonParticipar.innerHTML = "Participar en este Evento";

                                var botonYaParticipa = document.createElement("button");
                                botonYaParticipa.setAttribute("id", "botonYaParticipa");
                                botonYaParticipa.setAttribute("value", eventos.id);
                                botonYaParticipa.innerHTML = "Ya participas en este evento";

                                if (!eventos.participa) {
                                    botonParticipar.onclick = function () {
                                        //this.innerHTML = "Ya participas en este evento";
                                        participarEvento(this.value);
                                        window.location.reload();
                                    }
                                } else {
                                    botonYaParticipa.onclick = function () {
                                       // this.innerHTML = "Participar en este Evento";
                                        salirDeEvento(this.value);
                                        window.location.reload();
                                    }
                                }
                            }

                            autor.onclick = function () {
                                window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                            }

                            $("#menuEvento").append(evento);
                            evento.append(cont);
                            cont.append(titulo);
                            cont.append(textTipo);
                            textTipo.append("Tipo de evento: ");
                            textTipo.append(tipo);
                            cont.append(textFechai);
                            textFechai.append("Fecha inicio: ");
                            textFechai.append(fechai);
                            cont.append(textFechaf);
                            textFechaf.append("Fecha fin: ");
                            textFechaf.append(fechaf);
                            cont.append(contenido);
                            cont.append(visual);
                            if (eventos.foto) {
                                visual.append(img);
                            }

                            if (eventos.lat && eventos.lng) {
                                visual.append(map);
                            }
                            cont.append(textAutor);
                            textAutor.append("Autor del evento: ");
                            textAutor.append(autor);
                            if (eventos.participable) {
                                if (!eventos.participa) {
                                    cont.append(botonParticipar);
                                } else {
                                    cont.append(botonYaParticipa);
                                }
                                cont.append(textParticipantes);
                                textParticipantes.append("Participantes ");
                                textParticipantes.append(participantes);
                            }

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
                    icon:'../controlador/img/marker.ico',
                    map: maps
                });
            }

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
            
            function salirDeEvento(evento){
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
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" class="mensajes" alt="mensajes"><p class="alerta">1</p></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" class="notificaciones" alt="notificaciones"><p class="alerta">1</p></a></li>
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
