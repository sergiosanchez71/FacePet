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
        include '../controlador/gestion.php';
        comprobarLogin();
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
                            if (posts.amigo || posts.loginOperador == "1") {
                                var post = document.createElement("div");
                                post.setAttribute("class", "post");
                                var postUsuario = document.createElement("p");
                                postUsuario.setAttribute("class", "postUsuario");
                                postUsuario.setAttribute("data-value", posts.usuario);

                                postUsuario.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var imgUsuario = document.createElement("img");
                                imgUsuario.setAttribute("class", "imagenUsuario");
                                imgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + posts.foto);
                                var nombreUsuario = document.createElement("p");
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
                                postCorazonImg.setAttribute("data-value", posts.id);

                                if (!posts.like) {
                                    postCorazonImg.setAttribute("src", "../controlador/img/nolike.png");

                                    postCorazonImg.onclick = function () {
                                        this.removeAttribute("src");
                                        this.setAttribute("src", "../controlador/img/Like.png");
                                        darLike(this.dataset.value);
                                        if (!this.dataset.like) {
                                            var valor = $(".likes:eq(0)").text();
                                            var valor2 = parseInt(valor);
                                            $(".likes:eq(0)").text(parseInt(valor2 + 1));
                                            this.setAttribute("data-like", true);
                                        }
                                        //console.log(this.dataset.pos);
                                        //console.log($(".likes:eq(" + this.dataset.pos + ")").text());

                                    }
                                } else {
                                    postCorazonImg.setAttribute("src", "../controlador/img/Like.png");

                                    /*  postCorazonImg.onclick = function () {
                                     this.removeAttribute("src");
                                     this.setAttribute("src", "../controlador/img/nolike.png");
                                     darLike(this.alt);
                                     }*/
                                }

                                $("#menuPost").append(post);
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
                                
                                if (posts.likes != null) {
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
                                postCorazon.append(postCorazonImg);

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
                    <p id="name">Post</p>
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
