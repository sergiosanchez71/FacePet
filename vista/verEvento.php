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

            /*.cont{
                display: grid;
                grid-template-areas: 
                    "titulo"
                    "tipo"
                    "fecha"
                    "contenido"
                    "img"
                    "autor";
                word-wrap: break-word;
                overflow: hidden;
                background: white;
            }

            .eventoTitulo{
                grid-area:titulo;
            }
            
            .eventoTipo{
                grid-area:tipo;
            }

            .eventoFecha{
                grid-area:fecha;
            }

            .eventoImg{
                grid-area:img;
            }

            .eventoContenido{
                grid-area:contenido;
            }

            .eventoAutor{
                grid-area:autor;
            }*/

            /* #menuPost,.comentario{
                 margin-left: 5%; 
                 margin-right: 5%;
             }
 
             #enviarComentario{
                 margin-right: 5%;
             }
 
             #comentario,#textoComentarios{
                 margin-left: 5%;
             }
 
             #comentario{
                 width: 74%;
                 height: 3rem;
                 font-size: 1.5rem;
             }
 
             #enviarComentario{
                 font-size: 1.5rem;
                 width: 15%;
                 height: 3.3rem;
                 float: right;
             }
 
             .comentario{
                 background: white;
                 padding: 1rem;
                 border-bottom: 1px solid #EEEEEE;
             }
 
             .comentario:last-child{
                 margin-bottom: 10rem;
             }
 
             .cImagenUsuario{
                 width: 3rem;
                 height: 3rem;
                 border-radius: 3rem;
                 float: left;
                 cursor: pointer;
                 transition: 1s opacity ease;
             }
 
             .cImagenUsuario:hover{
                 opacity: 0.7;
             }
 
             .cNombreUsuario{
                 font-weight: bold;
                 margin-left: 4rem;
                 position: relative;
                 top: 0.5rem;
                 transition: 1s color ease;
                 cursor: pointer;
             }
 
             .cNombreUsuario:hover{
                 color:#f43333;
             }
 
             .cNombreUsuario:first-letter,.cCont:first-letter{
                 text-transform: uppercase;
             }
 
             .cFecha{
                 font-size: 0.8rem;
                 margin-left: 4rem;
                 margin-bottom: 4rem;
             }
 
             .cCont{
                 text-align: justify;
                 font-size: 1rem;
             }
 
             .botonEliminarA{
                 grid-area: eliminarAmigo;
                 width: 4rem;
                 display: block;
                 float: right;
                 cursor: pointer;
             }
 
             .amigoEliminar{
                 width: 3rem;
             }*/

        </style>
        <script>

            $(document).ready(function () {
                cargarEvento($("#idEvento").val());
                /*mostrarComentarios($("#idEvento").val());
                 $("#enviarComentario").click(function () {
                 if ($("#comentario").val().trim() != "") {
                 publicarComentario($("#idEvento").val(), $("#comentario").val());
                 }
                 });*/
            });

            function publicarComentario(post, comentario) {
                var parametros = {
                    "accion": "publicarComentario",
                    "post": post,
                    "contenido": comentario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#comentario").val(" ");
                        mostrarComentarios(post);
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarComentarios(post) {
                var parametros = {
                    "accion": "mostrarComentarios",
                    "post": post
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var comentarios = JSON.parse(respuesta);
                            $("#comentariosCont").text(" ");
                            var textoComentarios = document.createElement("h1");
                            textoComentarios.setAttribute("id", "textoComentarios");
                            textoComentarios.innerHTML = "Comentarios";
                            $("#comentariosCont").append(textoComentarios);
                            for (var i = 0; i < comentarios.length; i++) {

                                var comentario = document.createElement("div");
                                comentario.setAttribute("class", "comentario");

                                var info = document.createElement("div");
                                info.setAttribute("data-value", comentarios[i].usuario);

                                info.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                if (comentarios[i].loginOperador == "1" || comentarios[i].login == comentarios[i].usuario) {

                                    var a = document.createElement("button");
                                    a.setAttribute("value", comentarios[i].id);
                                    a.setAttribute("class", "botonEliminarA");

                                    a.onclick = function () {
                                        if (confirm("Esta seguro de eliminar este amigo")) {
                                            eliminarComentario(this.value);
                                        }
                                    }

                                    var amigoEliminar = document.createElement("img");
                                    amigoEliminar.setAttribute("class", "amigoEliminar");
                                    amigoEliminar.setAttribute("src", "../controlador/img/eliminar.png");
                                }

                                var cImgUsuario = document.createElement("img");
                                cImgUsuario.setAttribute("class", "cImagenUsuario");
                                cImgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + comentarios[i].foto);

                                var cNombreUsuario = document.createElement("p");
                                cNombreUsuario.setAttribute("class", "cNombreUsuario");
                                cNombreUsuario.innerHTML += comentarios[i].nick;

                                var cFecha = document.createElement("p");
                                cFecha.setAttribute("class", "cFecha");
                                cFecha.innerHTML += comentarios[i].fecha;

                                var cCont = document.createElement("p");
                                cCont.setAttribute("class", "cCont");
                                cCont.innerHTML += comentarios[i].contenido;

                                $("#comentariosCont").append(comentario);
                                comentario.append(info);
                                if (comentarios[i].loginOperador == "1" || comentarios[i].login == comentarios[i].usuario) {
                                    comentario.append(a);
                                    a.append(amigoEliminar);
                                }
                                info.append(cImgUsuario);
                                info.append(cNombreUsuario);
                                info.append(cFecha);
                                comentario.append(cCont);

                                function eliminarComentario(comentario) {
                                    var parametros = {
                                        "accion": "eliminarComentario",
                                        "comentario": comentario
                                    };

                                    $.ajax({
                                        url: "../controlador/acciones.php",
                                        data: parametros,
                                        success: function (respuesta) {
                                        },
                                        error: function (xhr, status) {
                                            alert("Error en la eliminacion de post");
                                        },
                                        type: "POST",
                                        dataType: "text"
                                    });
                                }
                            }
                        } else {
                            $("#comentario").css("margin-bottom", "10rem");
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

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

                            var tipo = document.createElement("p");
                            tipo.setAttribute("class", "eventoTipo");
                            tipo.innerHTML = eventos.tipo;

                            var fecha = document.createElement("p");
                            fecha.setAttribute("class", "eventoFecha");
                            fecha.innerHTML = eventos.fecha;

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
                            if(eventos.foto && eventos.lat && eventos.lng){
                                visual.setAttribute("class","visual");
                            } else if(eventos.foto){
                                visual.setAttribute("class","visualImg");
                            } else {
                                visual.setAttribute("class","visualMap");
                                map.setAttribute("style","height:20rem");
                            }

                            var textAutor = document.createElement("p");
                            textAutor.setAttribute("class", "eventoAutor");


                            var autor = document.createElement("span");
                            autor.setAttribute("class", "eventoNombreAutor");
                            autor.innerHTML = eventos.autor;
                            autor.setAttribute("data-value", eventos.usuario);

                            autor.onclick = function () {
                                window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                            }



                            $("#menuEvento").append(evento);
                            evento.append(cont);
                            cont.append(titulo);
                            cont.append(tipo);
                            cont.append(fecha);
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
                    map: maps
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
                    <p id="name">Evento</p>
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
