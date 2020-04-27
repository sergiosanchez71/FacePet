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
        <link href="../controlador/css/posts.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <?php
        session_start();
        ?>
        <style>

            #idPost{
                display: none;
            }

            #menuPost,.comentario{
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
            }

            .cNombreUsuario{
                position: relative;
                bottom: 1.5rem;
                left: 1rem;
                font-weight: bold;
            }

            .cFecha{
                font-size: 0.8rem;
                position: relative;
                bottom: 2rem;
                left: 4rem;
            }

            .cCont{
                text-align: justify;
                font-size: 1rem;
            }

        </style>
        <script>

            $(document).ready(function () {
                cargarPost($("#idPost").val());
                mostrarComentarios($("#idPost").val());
                $("#enviarComentario").click(function () {
                    if ($("#comentario").val().trim() != "") {
                        publicarComentario($("#idPost").val(), $("#comentario").val());
                    }
                });
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
                            console.log(respuesta);
                            var comentarios = JSON.parse(respuesta);
                            $("#comentariosCont").text(" ");
                            var textoComentarios = document.createElement("h1");
                            textoComentarios.setAttribute("id", "textoComentarios");
                            textoComentarios.innerHTML = "Comentarios";
                            $("#comentariosCont").append(textoComentarios);
                            for (var i = 0; i < comentarios.length; i++) {



                                var comentario = document.createElement("div");
                                comentario.setAttribute("class", "comentario");

                                var cImgUsuario = document.createElement("img");
                                cImgUsuario.setAttribute("class", "cImagenUsuario");
                                cImgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + comentarios[i].foto);

                                var cNombreUsuario = document.createElement("span");
                                cNombreUsuario.setAttribute("class", "cNombreUsuario");
                                cNombreUsuario.innerHTML += comentarios[i].nick;

                                var cFecha = document.createElement("p");
                                cFecha.setAttribute("class", "cFecha");
                                cFecha.innerHTML += comentarios[i].fecha;

                                var cCont = document.createElement("p");
                                cCont.setAttribute("class", "cCont");
                                cCont.innerHTML += comentarios[i].contenido;

                                $("#comentariosCont").append(comentario);
                                comentario.append(cImgUsuario);
                                comentario.append(cNombreUsuario);
                                comentario.append(cFecha);
                                comentario.append(cCont);

                            }
                        } else {
                            $("#comentario").css("margin-bottom","10rem");
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function cargarPost(post) {
                var parametros = {
                    "accion": "mostrarPost",
                    "post": post
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var posts = JSON.parse(respuesta);
                            if (posts.amigo) {
                                var post = document.createElement("div");
                                post.setAttribute("class", "post");
                                var postUsuario = document.createElement("p");
                                postUsuario.setAttribute("class", "postUsuario");
                                var imgUsuario = document.createElement("img");
                                imgUsuario.setAttribute("class", "imagenUsuario");
                                imgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + posts.foto);
                                var nombreUsuario = document.createElement("span");
                                nombreUsuario.setAttribute("class", "nombreUsuario");
                                nombreUsuario.innerHTML += posts.nick;

                                var postFecha = document.createElement("p");
                                postFecha.setAttribute("class", "postFecha");
                                postFecha.innerHTML += posts.fecha_publicacion;

                                var postCont = document.createElement("div");
                                postCont.setAttribute("class", "postCont");

                                var postTitulo = document.createElement("p");
                                postTitulo.setAttribute("class", "postTitulo");
                                postTitulo.innerHTML += posts.titulo;

                                if (posts.multimedia != null) {

                                    var postImg = document.createElement("img");
                                    postImg.setAttribute("class", "postImg");
                                    postImg.setAttribute("src", "../controlador/uploads/posts/" + posts.multimedia);

                                }

                                var postContenido = document.createElement("p");
                                postContenido.setAttribute("class", "postContenido");
                                postContenido.innerHTML += posts.contenido;

                                var postBottom = document.createElement("div");
                                postBottom.setAttribute("class", "postBottom")

                                var postLikes = document.createElement("p");
                                postLikes.setAttribute("class", "postLikes");

                                if (posts.likes != null) {

                                    var cadlikes = posts.likes;
                                    var likes = cadlikes.split(",");
                                    if (likes.length > 1) {
                                        postLikes.innerHTML += likes.length + " Me gustas";
                                    } else {
                                        postLikes.innerHTML += likes.length + " Me gusta";
                                    }

                                } else {
                                    postLikes.innerHTML = "0 Me gustas";
                                }

                                var iconos = document.createElement("p");
                                iconos.setAttribute("class", "iconos");
                                var postCorazon = document.createElement("a");
                                postCorazon.setAttribute("class", "postCorazon");

                                var postCorazonImg = document.createElement("img");
                                postCorazonImg.setAttribute("class", "postCorazonImg");
                                postCorazonImg.setAttribute("alt", posts.id);

                                if (!posts.like) {
                                    postCorazonImg.setAttribute("src", "../controlador/img/nolike.png");

                                    postCorazonImg.onclick = function () {
                                        this.removeAttribute("src");
                                        this.setAttribute("src", "../controlador/img/Like.png");
                                        darLike(this.alt);
                                    }
                                } else {
                                    postCorazonImg.setAttribute("src", "../controlador/img/Like.png");

                                    /*  postCorazonImg.onclick = function () {
                                     this.removeAttribute("src");
                                     this.setAttribute("src", "../controlador/img/nolike.png");
                                     darLike(this.alt);
                                     }*/
                                }

                                /*  var postComentario = document.createElement("a");
                                 postComentario.setAttribute("class", "postComentario");
                                 
                                 var postComentarioImg = document.createElement("img");
                                 postComentarioImg.setAttribute("class", "postComentarioImg");
                                 postComentarioImg.setAttribute("src", "../controlador/img/comentario.png");*/
                                postCorazonImg.setAttribute("alt", posts.id);



                                $("#menuPost").append(post);
                                /*post.append(a);
                                 a.append(postEliminar);*/
                                post.append(postUsuario);

                                postUsuario.append(imgUsuario);
                                postUsuario.append(nombreUsuario);

                                post.append(postFecha);
                                post.append(postCont);

                                postCont.append(postTitulo);
                                if (posts.multimedia != null) {
                                    postCont.append(postImg);
                                }
                                postCont.append(postContenido);


                                postCont.append(postBottom);

                                postBottom.append(postLikes);
                                postBottom.append(iconos);
                                iconos.append(postCorazon);
                                // iconos.append(postComentario);
                                postCorazon.append(postCorazonImg);
                                //postComentario.append(postComentarioImg);

                                function darLike(post) {
                                    var parametros = {
                                        "accion": "darLike",
                                        "post": post
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

                            } else {
                                window.location.href = "vistaUsuario.php";
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
                <input type="text" id="idPost" value="<?php echo $_REQUEST['post'] ?>">
                <div id="menuPost">
                    <p id="name">Posts</p>
                </div>
                <div id="comentariosPost">
                    <input type="text" id="comentario" maxlength="255" placeholder="Añadir comentario">
                    <button id="enviarComentario">Enviar Comentario </button>
                    <div id="comentariosCont">
                        
                    </div>
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
