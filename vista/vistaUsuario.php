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
        ?>
        <script>

        </script>
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/eventos.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE" async defer></script>
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
            
            .map{
                width: 100%;
                height: 20rem;
            }

            @media (max-width:1000px){

                #cuerpo{
                    grid-template-areas: 
                        "botones botones"
                        "posts eventos";
                }

                #botones{
                    display: block;
                    grid-area: botones;
                    margin: 3rem;
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

            }

        </style>
        <script>

            $(document).ready(function () {
                cargarPostsAmigos();
                mostrarEventos();
            });

            function cargarPostsAmigos() {
                var parametros = {
                    "accion": "mostrarPostsAmigos"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var posts = JSON.parse(respuesta);

                            for (var i = 0; i < posts.length; i++) {
                                var post = document.createElement("div");
                                post.setAttribute("class", "post");

                                var postUsuario = document.createElement("p");
                                postUsuario.setAttribute("class", "postUsuario");
                                postUsuario.setAttribute("data-value", posts[i].usuario);

                                postUsuario.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var imgUsuario = document.createElement("img");
                                imgUsuario.setAttribute("class", "imagenUsuario");
                                imgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + posts[i].foto);
                                var nombreUsuario = document.createElement("p");
                                nombreUsuario.setAttribute("class", "nombreUsuario");
                                nombreUsuario.innerHTML += posts[i].nick;

                                var postFecha = document.createElement("p");
                                postFecha.setAttribute("class", "postFecha");
                                postFecha.innerHTML += posts[i].fecha_publicacion;

                                var postCont = document.createElement("div");
                                postCont.setAttribute("class", "postCont");

                                var postTitulo = document.createElement("p");
                                postTitulo.setAttribute("class", "postTitulo");
                                postTitulo.innerHTML += posts[i].titulo;

                                if (posts[i].multimedia != null) {

                                    var postImg = document.createElement("img");
                                    postImg.setAttribute("class", "postImg");
                                    postImg.setAttribute("src", "../controlador/uploads/posts/" + posts[i].multimedia);

                                }

                                var postContenido = document.createElement("p");
                                postContenido.setAttribute("class", "postContenido");
                                postContenido.innerHTML += posts[i].contenido;

                                var postBottom = document.createElement("div");
                                postBottom.setAttribute("class", "postBottom")

                                var postLikes = document.createElement("p");
                                postLikes.setAttribute("class", "postLikes");

                                if (posts[i].likes != null) {

                                    var cadlikes = posts[i].likes;
                                    var likes = cadlikes.split(",");
                                    var slikes = document.createElement("span");
                                    slikes.setAttribute("class", "likes");
                                    slikes.innerHTML = likes.length;

                                }

                                var iconos = document.createElement("p");
                                iconos.setAttribute("class", "iconos");
                                var postCorazon = document.createElement("a");
                                postCorazon.setAttribute("class", "postCorazon");

                                var postCorazonImg = document.createElement("img");
                                postCorazonImg.setAttribute("class", "postCorazonImg");
                                postCorazonImg.setAttribute("alt", "Corazon");
                                postCorazonImg.setAttribute("data-value", posts[i].id);
                                postCorazonImg.setAttribute("data-pos", i);

                                if (!posts[i].like) {
                                    postCorazonImg.setAttribute("src", "../controlador/img/nolike.png");

                                    postCorazonImg.onclick = function () {
                                        this.removeAttribute("src");
                                        this.setAttribute("src", "../controlador/img/Like.png");
                                        darLike(this.dataset.value);
                                        if (!this.dataset.like) {
                                            var valor = $(".likes:eq(" + this.dataset.pos + ")").text();
                                            var valor2 = parseInt(valor);
                                            $(".likes:eq(" + this.dataset.pos + ")").text(parseInt(valor2 + 1));
                                            this.setAttribute("data-like", true);
                                        }
                                    }
                                } else {
                                    postCorazonImg.setAttribute("src", "../controlador/img/Like.png");
                                }


                                var postComentario = document.createElement("a");
                                postComentario.setAttribute("class", "postComentario");

                                var postComentarioImg = document.createElement("img");
                                postComentarioImg.setAttribute("class", "postComentarioImg");
                                postComentarioImg.setAttribute("src", "../controlador/img/comentario.png");
                                postComentarioImg.setAttribute("alt", "Comentario");
                                postComentarioImg.setAttribute("data-value", posts[i].id);

                                postComentarioImg.onclick = function () {
                                    window.location.href = "verPost.php?post=" + this.dataset.value;
                                }

                                var comentarios = document.createElement("span");
                                comentarios.setAttribute("class", "comentariosPost");
                                comentarios.setAttribute("data-value", posts[i].id);
                                if (posts[i].comentarios > 0) {
                                    if (posts[i].comentarios == 1) {
                                        comentarios.innerHTML = "Ver " + posts[i].comentarios + " comentario";
                                    } else {
                                        comentarios.innerHTML = "Ver " + posts[i].comentarios + " comentarios";
                                    }
                                } else {
                                    comentarios.innerHTML = "Hacer un comentario...";
                                }

                                comentarios.onclick = function () {
                                    window.location.href = "verPost.php?post=" + this.dataset.value;
                                }


                                $("#posts").append(post);
                                /*post.append(a);
                                 a.append(postEliminar);*/
                                post.append(postUsuario);

                                postUsuario.append(imgUsuario);
                                postUsuario.append(nombreUsuario);

                                post.append(postFecha);
                                post.append(postCont);

                                postCont.append(postTitulo);
                                if (posts[i].multimedia != null) {
                                    postCont.append(postImg);
                                }
                                postCont.append(postContenido);

                                postCont.append(postBottom);

                                postBottom.append(postLikes);

                                if (posts[i].likes != null) {
                                    if (likes.length > 1) {
                                        postLikes.append(slikes);
                                        postLikes.append(" Me gustas");
                                    } else {
                                        postLikes.append(slikes);
                                        postLikes.append(" Me gusta");
                                    }
                                } else {
                                    postLikes.append("0 Me gustas");
                                }

                                postBottom.append(iconos);
                                iconos.append(postCorazon);
                                iconos.append(postComentario);
                                postCorazon.append(postCorazonImg);
                                postComentario.append(postComentarioImg);
                                postCont.append(comentarios);

                                function darLike(post) {
                                    var parametros = {
                                        "accion": "darLike",
                                        "post": post
                                    };

                                    $.ajax({
                                        url: "../controlador/acciones.php",
                                        data: parametros,
                                        error: function (xhr, status) {
                                            alert("Error en la eliminacion de post");
                                        },
                                        type: "POST",
                                        dataType: "text"
                                    });
                                }

                                /* function verPost(post){
                                 var parametros = {
                                 "post":post
                                 }
                                 $.ajax({
                                 url: "verPost.php",
                                 data: parametros,
                                 success: function (respuesta) {
                                 window.location.href = "verPost.php";
                                 },
                                 error: function (xhr, status) {
                                 alert("Error en la eliminacion de post");
                                 },
                                 type: "POST",
                                 dataType: "text"
                                 });
                                 }*/
                            }
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
            }

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
                            var eventos = JSON.parse(respuesta);
                            for (var i = 0; i < eventos.length; i++) {
                                var evento = document.createElement("div");
                                evento.setAttribute("class", "evento");

                                var titulo = document.createElement("p");
                                titulo.setAttribute("class", "eventoTitulo");
                                titulo.innerHTML = eventos[i].titulo;
                                titulo.setAttribute("data-value", eventos[i].id);

                                titulo.onclick = function () {
                                    window.location.href = "verEvento.php?evento=" + this.dataset.value;
                                }


                                var tipo = document.createElement("p");
                                tipo.setAttribute("class", "eventoTipo");
                                tipo.innerHTML = eventos[i].tipo;

                                var fecha = document.createElement("p");
                                fecha.setAttribute("class", "eventoFecha");
                                fecha.innerHTML = eventos[i].fecha;

                                var contenido = document.createElement("p");
                                contenido.setAttribute("class", "eventoContenido");
                                contenido.innerHTML = eventos[i].contenido;

                                if (eventos[i].foto) {

                                    var img = document.createElement("img");
                                    img.setAttribute("class", "eventoImg");
                                    console.log(eventos[i].foto);
                                    img.setAttribute("src", "../controlador/uploads/eventos/" + eventos[i].foto);
                                    img.setAttribute("alt", "imgagenEvento");

                                } else if (eventos[i].lat && eventos[i].lng) {
                                    var map = document.createElement("div");
                                    map.setAttribute("class", "map");
                                    //map.setAttribute("style", "height:20rem");
                                    initMap(map, eventos[i].lat, eventos[i].lng);
                                }
                                var textAutor = document.createElement("p");
                                textAutor.setAttribute("class", "eventoAutor");


                                var autor = document.createElement("span");
                                autor.setAttribute("class", "eventoNombreAutor");
                                autor.innerHTML = eventos[i].autor;
                                autor.setAttribute("data-value", eventos[i].usuario);

                                autor.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }



                                $("#eventos").append(evento);
                                evento.append(titulo);
                                evento.append(tipo);
                                evento.append(fecha);
                                evento.append(contenido);
                                if (eventos[i].foto) {
                                    evento.append(img);
                                } else if (eventos[i].lat && eventos[i].lng){
                                    evento.append(map);
                                }
                                evento.append(textAutor);
                                textAutor.append("Autor del evento: ");
                                textAutor.append(autor);
                            }

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
                <div id="botones">
                    <button id="botonPosts" class="boton"><span>Posts</span></button>
                    <button id="botonEventos" class="boton"><span>Eventos</span></button>
                </div>
                <div id="posts">
                    <p id="name">Posts</p>

                </div>
                <div id="eventos">
                    <p id="name">Eventos</p>

                </div>
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
