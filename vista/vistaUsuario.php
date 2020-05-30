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
        <link rel="icon" href="../controlador/img/favicon.ico"><!--Favicon-->
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comrpobamos si está logueado
        ?>
        <script>

        </script>
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css"> <!--Css de header-->
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css"> <!--Css de posts -->
        <link  rel="stylesheet" type="text/css" href="../controlador/css/eventos.css"> <!--Css de eventos-->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script> <!--JQuery-->
        <script src="../controlador/js/header.js" type="text/javascript"></script> <!--Header js-->
        <script src="../controlador/js/pintarObjetos.js" type="text/javascript"></script> <!--Pintar objetos js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE&callback=initMap" async defer></script>
        <!--Libreria maps-->
        <style>

            /*El cuerpo dividido entre posts y eventos, los posts ocuparán mayor parte*/
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

            /*Botones ocultos*/
            #botones{
                display: none;
            }

            /*Posts*/
            #posts{
                grid-area:posts;
            }

            /*Eventos*/
            #menuL{
                grid-area: eventos;
                display: none;
            }

            /*Conjunto de eventos*/
            #eventos{
                max-width: 40rem;
            }

            /*Imágenes de los eventos centradas*/
            .eventoImg{
                width: 10rem;
                display: block;
                margin: auto;
            }

            /*Vista móvil*/
            @media (max-width:1000px){

                /*Los botones van arriba y abajo el contenido, que podrá ser posts o eventos*/
                #cuerpo{
                    grid-template-areas: 
                        "botones"
                        "contenido";
                    grid-template-columns: 100%;
                }

                /*Posts*/
                #posts{
                    grid-area:contenido;
                }

                /*Botones*/
                #botones{
                    display: block;
                    grid-area: botones;
                    margin: 3rem;
                    padding-bottom: 3rem;
                }

                /*Tamaño de cada botón fondo y transación*/
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

                /*Texto de nuestro botón*/
                .boton span{
                    font-size: 3rem;
                }

                /*Cada uno de nuestros posts, les quitamos borde y los juntamos*/
                .post{
                    padding-bottom: 2rem;
                    border-radius: 0;
                    border: 0px solid black;
                    margin-top: -3rem;
                    border-bottom: 1px solid grey;
                }

                /*Ocultamos el h1 de "posts"*/
                .tituloseccion{
                    display: none;
                }

                /*En el último dejamos un margen*/
                .post:last-child{
                    margin-bottom: 10rem;
                }

                /*Los eventos ocupan toda la página*/
                #eventos{
                    max-width: 100%;
                    grid-area:contenido;
                    margin: 0;
                    padding: 0;
                    display: none;
                }

                /*Quitamos su espacio*/
                .evento{
                    border-radius: 0;
                    border: 0px solid black;
                    margin-top: -3rem;
                    border-bottom: 1px solid grey;
                }
                /*Todos en el mismo margen*/
                .eventoTitulo, .textTipo, .textFechai, .textFechaf, .direccioncompleta, .eventoAutor, .participantes{
                    margin-left: 0;
                }

                /*Tamaño mapa*/
                .map{
                    height: 20rem;
                    margin-left: 0;

                }

                /*Margen en el último evento*/
                .evento:last-child{                   
                    margin-bottom: 15rem;
                }

            }

        </style>
        <script>


            var cargando = 0; //La variable cargando permitirá que no ejecutemos más de una vez una acción
            var cantidad = 5; //Cantidad de posts que se mostrarán

            //Cogemos la acción de mover nuestro scroll
            $(window).scroll(function () {
                //Si nuestro scroll verticual es mayor al height del cuerpo - 800 y estamos en ordenador
                if ($(window).scrollTop() > $("#cuerpo").height() - 800 && $(window).width() > 1000) {
                    //Sumamos uno a nuestra carga
                    cargando += 1;
                    if (cargando == 1) { //Ejecutamos
                        cantidad += 5; //Sumamos la cantidad que queremos mostrar de nuevos posts
                        cargarPostsAmigos(cantidad); //Mostramos los posts de nuestros amigos dada la cantidad
                    }

                } else if ($(window).scrollTop() > $("#cuerpo").height() - 2000) { //Si estamos en teléfono aumentamos el margen de height
                    cargando += 1;
                    if (cargando == 1) {
                        cantidad += 5;
                        cargarPostsAmigos(cantidad);
                    }
                } else {
                    if (cargando != 0) {
                        cargando = 0; //Volvemos a poner cargando a 0 si no se ejecuta nada
                    }
                }

            });

            $(document).ready(function () {
                cargarPostsAmigos(cantidad); //Mostramos "cantidad" de posts
                mostrarEventos(); //Mostramos eventos (3)
                //En teléfono
                $("#botonPosts").css("background", "#ffe45e");//Background button
                $("#botonEventos").click(function () {
                    //Si cambiamos a eventos ocultamos los posts y mostramos eventos 
                    $("#eventos").show();
                    $("#posts").hide();
                    //Y el background cambia
                    $("#botonEventos").css("background", "#ffe45e");
                    $("#botonPosts").css("background", "#FFED91");
                });
                $("#botonPosts").click(function () {
                    //Igual que el anterior pero invertido
                    $("#eventos").hide();
                    $("#posts").show();
                    $("#botonPosts").css("background", "#ffe45e");
                    $("#botonEventos").css("background", "#FFED91");
                });
            });

            /*Mostrar mapas dado el div, lat y lng*/
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
                    position: {lat: parseFloat(lat), lng: parseFloat(lng)}, //Posición mapa
                    icon: '../controlador/img/marker.ico', //Nuestro marker personalizado
                    map: maps
                });

                google.maps.event.addDomListener(window, 'load', initMap);
            }

            /*Cargamos los posts de nuestros amigos dada una cantidad*/
            function cargarPostsAmigos(cantidad) {
                var parametros = {
                    "accion": "mostrarPostsAmigos",
                    "cantidad": cantidad, //Recogemos cantidad
                    "array": $("#cadPosts").val() //Posts que ya se han mostrado
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) { //Si hemos recibido respuesta
                            var posts = JSON.parse(respuesta); 
                            pintarPosts(posts, "posts"); //Pintamos nuestros posts

                        } else {
                            if (cantidad == "5") { //Si la cantidad es 5 y no recibimos respuesta
                                var h1 = document.createElement("h1");
                                h1.innerHTML += "Aquí se mostraran los posts de tus amigos, cuando los haya"; 
                                $("#posts").append(h1); //Mostramos este mensaje en un h1
                            }
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la carga de posts");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostrar eventos
            function mostrarEventos() {
                var parametros = {
                    "accion": "mostrarEventos",
                    "cantidad": 3 //cantidad de eventos que mostraremos
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) { //Si obtenemos resputa
                            var eventos = JSON.parse(respuesta);
                            pintarEventos(eventos, "eventos"); //Pintamos eventos
                        } else { //Si no recibimos respuesta
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Aquí se mostraran los eventos, pero ahora mismo no hay ninguno";
                            $("#eventos").append(h1); //Mostramos el mensaje anterior en un h1
                        }

                    },
                    error: function (xhr, status) {
                        alert("Error en la muestra de eventos");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }



        </script>
    </head>
    <body>
        <!--Div principal-->
        <div id="principal">

            <!--Cabecera-->
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

                <!--Header móvil-->
                
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

            <!--Cuerpo-->
            
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
                    <input type="text" id="cadEventos" style="display:none">
                    <p  class="tituloseccion"><a href="verEventos.php">Eventos</a></p>

                </div>
            </div>

            <footer>
                <!--Menú móvil-->
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
