<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ver Perfil</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css">
        <link href="../controlador/css/perfil.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
                <script src="../controlador/js/pintarObjetos.js" type="text/javascript"></script>

        <link href="../controlador/css/eventos.css" rel="stylesheet" type="text/css"/>

        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin();
        ?>
        <style>
            .evento{
                margin-left: 4rem;
            }

        </style>
        <script>
            $(document).ready(function () {
                getDatosPerfil($("#idUsuario").val());
                mostrarPosts($("#idUsuario").val());
                mostrarAmigos($("#idUsuario").val());
                $("#botonPosts").hide();
                $("#textoEventos").hide();
                $("#idUsuario").hide();
                $("#textoPosts").hide();

                $("#botonEventos").click(function () {
                    $("#botonPosts").show();
                    $("#botonEventos").hide();
                    $("#textoPosts").hide();
                    $("#contenido").empty();
                    mostrarEventos($("#idUsuario").val());
                });

                $("#botonPosts").click(function () {
                    $("#botonPosts").hide();
                    $("#botonEventos").show();
                    $("#textoEventos").hide();
                    $("#contenido").empty();
                    mostrarPosts($("#idUsuario").val());
                });
            });

            function eliminarPost(post) {
                var parametros = {
                    "accion": "eliminarPost",
                    "post": post
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        mostrarMisAmigos();
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function eliminarAmigo(amigo) {
                var parametros = {
                    "accion": "eliminarAmigo",
                    "amigo": amigo
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $(".post").remove();
                        mostrarMisPosts();
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function getDatosPerfil(usuario) {
                var parametros = {
                    "accion": "getDatosUsuario",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var usuario = JSON.parse(respuesta);
                        $("#imgPerfil").attr("src", "../controlador/uploads/usuarios/" + usuario.foto);
                        $("#nombrePerfilUsuario").text(usuario.nick);
                        $("#animalPerfilUsuario").text(usuario.animal);
                        $("#razaPerfilUsuario").text(usuario.raza);
                        $("#localidadPerfilUsuario").text(usuario.localidad);


                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarAmigos(usuario) {
                var parametros = {
                    "accion": "mostrarAmigos",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var amigos = JSON.parse(respuesta);
                            var titular = document.createElement("p");
                            titular.setAttribute("class", "titularAmigosPerfil");
                            $("#amigosPerfiles").append(titular);

                            for (var i = 0; i < amigos.length; i++) {

                                var amigoPerfil = document.createElement("div");
                                amigoPerfil.setAttribute("class", "amigoPerfil");

                                if (amigos[i].loginOperador == "1" || amigos[i].login == usuario) {

                                    var a = document.createElement("button");
                                    a.setAttribute("value", amigos[i].id);
                                    a.setAttribute("class", "botonEliminarA");

                                    a.onclick = function () {
                                        if (confirm("Esta seguro de eliminar este amigo")) {
                                            eliminarAmigo(this.value);
                                        }
                                    }

                                    var amigoEliminar = document.createElement("img");
                                    amigoEliminar.setAttribute("class", "amigoEliminar");
                                    amigoEliminar.setAttribute("src", "../controlador/img/eliminar.png");

                                }

                                var img = document.createElement("img");
                                img.setAttribute("src", "../controlador/uploads/usuarios/" + amigos[i].foto);
                                img.setAttribute("class", "imagenAmigo");
                                img.setAttribute("alt", "imagenAmigo");
                                img.setAttribute("data-value", amigos[i].id);

                                img.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var divA = document.createElement("div");
                                divA.setAttribute("class", "informacionAmigo");
                                divA.setAttribute("data-value", amigos[i].id);

                                divA.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }
                                var nombreAmigo = document.createElement("p");
                                nombreAmigo.setAttribute("class", "nombreAmigo");
                                nombreAmigo.innerHTML = amigos[i].nick;

                                var p = document.createElement("p");

                                var animalAmigo = document.createElement("span");
                                animalAmigo.setAttribute("class", "animalAmigo");
                                animalAmigo.innerHTML = amigos[i].animal;

                                var razaAmigo = document.createElement("span");
                                razaAmigo.setAttribute("class", "razaAmigo");
                                razaAmigo.innerHTML = " " + amigos[i].raza;

                                $("#amigosPerfiles").append(amigoPerfil);
                                if (amigos[i].loginOperador == 1 || amigos[i].login == usuario) {
                                    amigoPerfil.append(a);
                                    a.append(amigoEliminar);
                                }
                                amigoPerfil.append(img);
                                amigoPerfil.append(divA);
                                divA.append(nombreAmigo);
                                divA.append(p);
                                p.append(animalAmigo);
                                p.append(razaAmigo);

                            }
                        } else {
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Este usuario aún no tiene amigos";
                            $("#amigosPerfiles").append(h1);
                        }


                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarPosts(usuario) {
                var parametros = {
                    "accion": "mostrarPosts",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            $("#textoPosts").show();
                            var posts = JSON.parse(respuesta);
                            for (var i = 0; i < posts.length; i++) {
                                var post = document.createElement("div");
                                post.setAttribute("class", "post");

                                if (posts[i].loginOperador == 1 || posts[i].login == usuario) {

                                    var a = document.createElement("button");
                                    a.setAttribute("value", posts[i].id);
                                    a.setAttribute("class", "botonEliminar");

                                    a.onclick = function () {
                                        if (confirm("Esta seguro de eliminar este post")) {
                                            eliminarPost(this.value);
                                        }
                                    }

                                    var postEliminar = document.createElement("img");
                                    postEliminar.setAttribute("class", "postEliminar");
                                    postEliminar.setAttribute("src", "../controlador/img/eliminar.png");

                                }


                                /* var postEliminarBoton = document.createElement("button");
                                 postEliminarBoton.setAttribute("class","postEliminarBoton");
                                 postEliminarBoton.innerHTML += postEliminar;*/

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
                                postCorazonImg.setAttribute("alt", posts[i].id);
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

                                    /*  postCorazonImg.onclick = function () {
                                     this.removeAttribute("src");
                                     this.setAttribute("src", "../controlador/img/nolike.png");
                                     darLike(this.alt);
                                     }*/
                                }

                                var postComentario = document.createElement("a");
                                postComentario.setAttribute("class", "postComentario");

                                var postComentarioImg = document.createElement("img");
                                postComentarioImg.setAttribute("class", "postComentarioImg");
                                postComentarioImg.setAttribute("src", "../controlador/img/comentario.png");
                                postComentarioImg.setAttribute("alt", posts[i].id);

                                postComentarioImg.onclick = function () {
                                    window.location.href = "verPost.php?post=" + this.alt;
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

                                $("#contenido").append(post);
                                if (posts[i].loginOperador == 1 || posts[i].login == usuario) {
                                    post.append(a);
                                    a.append(postEliminar);
                                }
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

                            }
                        } else {
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Este usuario aún no tiene posts creados";
                            h1.setAttribute("class", "noHay");
                            $("#contenido").append(h1);
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarEventos(usuario) {
                var parametros = {
                    "accion": "mostrarEventosId",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta) {
                            $("#textoEventos").show();
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


                                var textTipo = document.createElement("p");
                                textTipo.setAttribute("class", "textTipo");

                                var tipo = document.createElement("span");
                                tipo.setAttribute("class", "eventoTipo");
                                tipo.innerHTML = eventos[i].tipo;

                                var textFechai = document.createElement("p");
                                textFechai.setAttribute("class", "textFechai");

                                var textFechaf = document.createElement("p");
                                textFechaf.setAttribute("class", "textFechaf");

                                var fechai = document.createElement("span");
                                fechai.setAttribute("class", "eventoFecha");
                                fechai.innerHTML = eventos[i].fechai;
                                if (eventos[i].empezado) {
                                    fechai.setAttribute("style", "color:#126310");
                                    fechai.setAttribute("title", "Evento actualmente activo");
                                }

                                var fechaf = document.createElement("span");
                                fechaf.setAttribute("class", "eventoFecha");
                                fechaf.innerHTML = eventos[i].fechaf;

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

                                if (eventos[i].participable) {
                                    var textParticipantes = document.createElement("p");
                                    var participantes = document.createElement("span");
                                    var part;
                                    if (eventos[i].participable == "t") {
                                        part = "0";
                                    } else {
                                        part = eventos[i].participantes.length;
                                    }
                                    participantes.innerHTML = part;
                                }

                                $("#contenido").append(evento);
                                evento.append(titulo);
                                evento.append(textTipo);
                                textTipo.append("Tipo de evento: ");
                                textTipo.append(tipo);
                                evento.append(textFechai);
                                textFechai.append("Fecha inicio: ");
                                textFechai.append(fechai);
                                evento.append(textFechaf);
                                textFechaf.append("Fecha fin: ");
                                textFechaf.append(fechaf);
                                evento.append(contenido);
                                if (eventos[i].foto) {
                                    evento.append(img);
                                } else if (eventos[i].lat && eventos[i].lng) {
                                    evento.append(map);
                                }
                                evento.append(textAutor);
                                textAutor.append("Autor del evento: ");
                                textAutor.append(autor);
                                if (eventos[i].participable) {
                                    evento.append(textParticipantes);
                                    textParticipantes.append("Participantes ");
                                    textParticipantes.append(participantes);
                                }

                            }

                        } else {
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Este usuario aún no tiene eventos creados";
                            h1.setAttribute("class", "noHay");
                            $("#contenido").append(h1);
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
        <?php
        ?>
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
                <input type="text" id="idUsuario" value="<?php echo $_REQUEST['usuario'] ?>">
                <div id="cabeceraPerfil">
                    <p id="contenidoPerfil">
                        <img id="imgPerfil" alt="imgPerfil">
                    </p>
                    <div id="datos">
                        <p id="nombrePerfilUsuario"></p>
                        <p id="animalRaza"><span id="animalPerfilUsuario"></span> <span id="razaPerfilUsuario"></span></p>
                        <p id="localidadPerfilUsuario"></p>
                    </div>
                </div>
                <div id="botonesM">
                    <button id="botonAmigosM" class="boton">Amigos</button>
                    <button id="botonPostsM" class="boton">Posts</button>
                    <button id="botonEventosM" class="boton">Eventos</button>
                </div>
                <div id="amigosPerfil">
                    <div id="amigosPerfiles">

                    </div>
                </div>

                <div id="botones">
                    <button id="botonPosts" class="boton">Ver Posts</button>
                    <button id="botonEventos" class="boton">Ver Eventos</button>
                    <h1 id="textoPosts" class="texto">Posts</h1>
                    <h1 id="textoEventos" class="texto">Eventos</h1>
                </div>

                <div id="contenido">

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
    </div>

</body>
</html>
