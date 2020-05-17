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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE" async defer></script>
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

            var cargando = 0;
            var cantidad = 5;

            $(window).scroll(function () {
                if ($(window).scrollTop() > $("#contenido").height() - 400 && ($("#contenido").height() > 1000)) {
                    console.log($("#contenido").height());
                    cargando += 1;
                    if (cargando == 1) {
                        cantidad += 5;
                        mostrarPosts($("#idUsuario").val(),cantidad);
                        console.log($("#cadPosts").val());
                    }
                    //}
                } else {
                    cargando = 0;
                }

                if ($("#contenido").height() > 600)
                    if ($(window).scrollTop() > 500 && $(window).width() > 1000) {
                        $("#amigosPerfil").css("position", "fixed");
                        $("#amigosPerfil").css("top", "0.5rem");
                        $("#amigosPerfil").css("width", "23%");
                    } else {
                        $("#amigosPerfil").css("position", "relative");
                        $("#amigosPerfil").css("width", "75%");
                    }
            });

            $(document).ready(function () {
                getDatosPerfil($("#idUsuario").val());
                mostrarPosts($("#idUsuario").val(), "5");
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
                    $("#cadPosts").val("");
                    mostrarPosts($("#idUsuario").val(), "5");
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

            function mostrarPosts(usuario, cantidad) {
                var parametros = {
                    "accion": "mostrarPosts",
                    "usuario": usuario,
                    "cantidad": cantidad,
                    "array": $("#cadPosts").val()
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            console.log(respuesta);
                            $("#textoPosts").show();
                            var posts = JSON.parse(respuesta);
                            pintarPosts(posts, "contenido");
                            console.log(respuesta);
                            console.log($("#cadPosts").val());
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
                            pintarEventos(eventos, "contenido");

                        } else {
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Aquí se mostraran los eventos, pero ahora mismo no hay ninguno";
                            $("#textoEventos").hide();
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
                <input type="text" id="cadPosts">
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
