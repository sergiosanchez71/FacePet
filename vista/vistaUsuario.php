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
        <script>

        </script>
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/eventos.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <script src="../controlador/js/pintarObjetos.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE&callback=initMap" async defer></script>
        <style>

            #cuerpo{
                grid-area: cuerpo;
                display: grid;
                width: 100%;
                grid-template-areas: 
                    "posts eventos";
                grid-template-columns: 60% 40%;
                margin: auto;
                background: white;
            }

            #botones{
                display: none;
            }

            #posts{
                grid-area:posts;
            }

            #menuL{
                grid-area: eventos;
                display: none;
            }

            #eventos{
                max-width: 40rem;
            }

            .eventoImg{
                width: 10rem;
                display: block;
                margin: auto;
            }

            @media (max-width:1000px){

                #cuerpo{
                    grid-template-areas: 
                        "botones"
                        "contenido";
                    grid-template-columns: 100%;
                }

                #posts{
                    grid-area:contenido;
                }

                #botones{
                    display: block;
                    grid-area: botones;
                    margin: 3rem;
                    padding-bottom: 3rem;
                }

                .boton{
                    width: 49%;
                    margin: auto;
                    font-size: 3rem;
                    font-weight: bold;
                    background-color: #FFED91;
                    height: 5rem;
                    font-size: 2rem;
                    transition: 1s background ease;
                    border-radius: 2rem;
                    cursor: pointer;
                }

                .boton span{
                    font-size: 3rem;
                }

                .post{
                    padding-bottom: 2rem;
                    border-radius: 0;
                    border: 0px solid black;
                    margin-top: -3rem;
                    border-bottom: 1px solid grey;
                }

                .tituloseccion{
                    display: none;
                }

                .post:last-child{
                    margin-bottom: 10rem;
                }

                #eventos{
                    max-width: 100%;
                    grid-area:contenido;
                    margin: 0;
                    padding: 0;
                    display: none;
                }

                .evento{
                    border-radius: 0;
                    border: 0px solid black;
                    margin-top: -3rem;
                    border-bottom: 1px solid grey;
                }
                .eventoTitulo, .textTipo, .textFechai, .textFechaf, .direccioncompleta, .eventoAutor, .participantes{
                    margin-left: 0;
                }

                .map{
                    height: 20rem;
                    margin-left: 0;

                }

                .evento:last-child{                   
                    margin-bottom: 15rem;
                }

            }

        </style>
        <script>


            var cargando = 0;
            var cantidad = 5;

            $(window).scroll(function () {
                console.log($(window).width());
                if ($(window).scrollTop() > $("#cuerpo").height() - 800 && $(window).width() > 1000) {
                    cargando += 1;
                    if (cargando == 1) {
                        cantidad += 5;
                        cargarPostsAmigos(cantidad);
                    }

                } else if ($(window).scrollTop() > $("#cuerpo").height() - 2000) {
                    cargando += 1;
                    console.log($(window).scrollTop());
                    if (cargando == 1) {
                        cantidad += 5;
                        cargarPostsAmigos(cantidad);
                    }
                } else {
                    cargando = 0;
                }

            }
            );

            $(document).ready(function () {
                cargarPostsAmigos("5");
                mostrarEventos();
                $("#botonPosts").css("background", "#ffe45e");
                $("#botonEventos").click(function () {
                    $("#eventos").show();
                    $("#posts").hide();
                    $("#botonEventos").css("background", "#ffe45e");
                    $("#botonPosts").css("background", "#FFED91");
                });
                $("#botonPosts").click(function () {
                    $("#eventos").hide();
                    $("#posts").show();
                    $("#botonPosts").css("background", "#ffe45e");
                    $("#botonEventos").css("background", "#FFED91");
                });
                //google.maps.event.addDomListener(window, 'load', initMap);

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

            function cargarPostsAmigos(cantidad) {
                var parametros = {
                    "accion": "mostrarPostsAmigos",
                    "cantidad": cantidad,
                    "array": $("#cadPosts").val()
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            console.log(respuesta);
                            var posts = JSON.parse(respuesta);
                            pintarPosts(posts, "posts");

                        } else {
                            if (cantidad == "5") {
                                var h1 = document.createElement("h1");
                                h1.innerHTML += "Aquí se mostraran los posts de tus amigos, cuando los haya";
                                $("#posts").append(h1);
                            }
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            /* function cargarPostsAmigosInicio(cantidad) {
             var parametros = {
             "accion": "mostrarPostsAmigosInicio",
             "cantidad": cantidad
             };
             
             $.ajax({
             url: "../controlador/acciones.php",
             data: parametros,
             success: function (respuesta) {
             if (respuesta) {
             //console.log(respuesta);
             var posts = JSON.parse(respuesta);
             pintarPosts(posts, "posts");
             
             } else {
             var h1 = document.createElement("h1");
             h1.innerHTML += "Aquí se mostraran los posts de tus amigos, cuando los haya";
             $("#posts").append(h1);
             }
             },
             error: function (xhr, status) {
             alert("Error en la eliminacion de post");
             },
             type: "POST",
             dataType: "text"
             });
             }*/

            function mostrarEventos() {
                var parametros = {
                    "accion": "mostrarEventos"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta) {
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
                <div id="botones">
                    <button id="botonPosts" class="boton"><span>Posts</span></button>
                    <button id="botonEventos" class="boton"><span>Eventos</span></button>
                </div>
                <div id="posts">
                    <input type="text" id="cadPosts">
                    <p class="tituloseccion">Posts</p>

                </div>
                <div id="eventos">
                    <p  class="tituloseccion">Eventos</p>

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
