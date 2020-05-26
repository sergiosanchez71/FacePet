<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi Perfil</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE" async defer></script>
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css">
        <link href="../controlador/css/jquery.modal.min.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/jquery.modal.min.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <script src="../controlador/js/pintarObjetos.js" type="text/javascript"></script>
        <link href="../controlador/css/perfil.css" rel="stylesheet" type="text/css"/>
        <link href="../controlador/css/eventos.css" rel="stylesheet" type="text/css"/>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin();
        ?>
        <style>
        </style>
        <script>

            var cargando = 0;
            var cantidad = 5;
            var cantidadEventos = 5;
            var pest = 0;

            $(window).scroll(function () {
                if ($("#contenido").height() > 600 && $(window).width() > 1000) {
                    /*cargando += 1;
                     if (cargando == 1) {
                     if (pest == 0) {
                     cantidad += 5;
                     mostrarMisPosts(cantidad);
                     }
                     if (pest == 1) {
                     console.log("a");
                     cantidadEventos += 5;
                     mostrarMisEventos();
                     }
                     }*/
                    if ($(window).scrollTop() > 600 && $(window).width() > 1000) {
                        $("#amigosPerfil").css("position", "fixed");
                        $("#amigosPerfil").css("top", "0.5rem");
                        $("#amigosPerfil").css("width", "23%");
                    } else {
                        $("#amigosPerfil").css("position", "relative");
                        $("#amigosPerfil").css("width", "75%");
                    }

                    if ($(window).scrollTop() > $("#cuerpo").height() - 800) {
                        cargando += 1;
                        if (cargando == 1) {
                            if (pest == 0) {
                                cantidad += 5;
                                mostrarMisPosts(cantidad);
                            }
                            if (pest == 1) {
                                cantidadEventos += 5;
                                mostrarMisEventos();
                            }
                        }
                    } else {
                        cargando = 0;
                    }

                } else if ($(window).scrollTop() > $("#cuerpo").height() - 2000) {
                    cargando += 1;
                    if (cargando == 1) {
                        if (pest == 0) {
                            cantidad += 5;
                            mostrarMisPosts(cantidad);
                        }
                        if (pest == 1) {
                            console.log("a");
                            cantidadEventos += 5;
                            mostrarMisEventos();
                        }
                    }
                } else {
                    cargando = 0;
                }

            });

            $(document).ready(function () {
                $("#cambiarImagen").hide();
                getDatosMiPerfil();
                mostrarMisPosts("5");
                mostrarMisAmigos();
                $("#botonPosts").hide();
                $("#textoEventos").hide();
                $("#textoPosts").hide();

                $("#botonEventos").click(function () {
                    pest = 1;
                    cantidad = 5;
                    cantidadEventos = 5;
                    $("#botonPosts").show();
                    $("#botonEventos").hide();
                    $("#textoPosts").hide();
                    $("#contenido").empty();
                    $("#cadEventos").val("");
                    mostrarMisEventos();
                });

                $("#botonPosts").click(function () {
                    pest = 0;
                    cantidad = 5;
                    cantidadEventos = 5;
                    $("#botonPosts").hide();
                    $("#textoEventos").hide();
                    $("#botonEventos").show();
                    $("#textoPosts").show();
                    $("#contenido").empty();
                    $("#cadPosts").val("");
                    mostrarMisPosts("5");
                });

                if ($(window).width() < 1000) {

                    $("#botonEventosM").click(function () {
                        pest = 1;
                        cantidad = 5;
                        cantidadEventos = 5;
                        $("#botonPostsM").show();
                        $("#botonAmigosM").show();
                        $("#botonEventosM").hide();
                        $("#textoPosts").hide();
                        $("#amigosPerfiles").hide();
                        $("#posts").hide();
                        $("#contenido").empty();
                        $("#cadPosts").val("");
                        mostrarMisEventos();
                    });

                    $("#botonPostsM").click(function () {
                        pest = 0;
                        cantidad = 5;
                        cantidadEventos = 5;
                        $("#botonPostsM").hide();
                        $("#botonEventosM").show();
                        $("#botonAmigosM").show();
                        $("#textoEventos").hide();
                        $("#amigosPerfiles").hide();
                        $("#contenido").empty();
                        $("#cadPosts").val("");
                        mostrarMisPosts("5");
                    });

                    $("#botonAmigosM").click(function () {
                        pest = 2;
                        cantidad = 5;
                        cantidadEventos = 5;
                        $("#botonAmigosM").hide();
                        $("#botonEventosM").show();
                        $("#botonPostsM").show();
                        $("#contenido").empty();
                        $("#amigosPerfiles").show();

                    });

                }

                $("#textCambiarAvatar").click(function () {
                    getId();
                    $("#cambiarImagen").modal();
                });

                $("#imgPerfil").click(function () {
                    getId();
                    $("#cambiarImagen").modal();
                });
            });

            function getId() {
                var parametros = {
                    "accion": "cambiarAvatar"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        $("#idusu").attr("value", respuesta);
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });

            }

            function eliminarPost(post) {
                var parametros = {
                    "accion": "eliminarPost",
                    "post": post
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        $("#cadPosts").val("");
                        $("#contenido").empty();
                        mostrarMisPosts("5");
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
                        console.log(respuesta);
                        $("#amigosPerfiles").text("");
                        mostrarMisAmigos();
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function getDatosMiPerfil() {
                var parametros = {
                    "accion": "getDatosMiUsuario"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        var usuario = JSON.parse(respuesta);
                        $("#imgPerfil").attr("src", "../controlador/uploads/usuarios/" + usuario.foto);
                        $("#nombrePerfilUsuario").text(usuario.nick);
                        $("#animalPerfilUsuario").text(usuario.animal);
                        $("#razaPerfilUsuario").text(usuario.raza);
                        $("#localidadPerfilUsuario").text(usuario.provincia + ", " + usuario.municipio);


                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarMisAmigos() {
                var parametros = {
                    "accion": "mostrarMisAmigos"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var amigos = JSON.parse(respuesta);
                            pintarAmigos(amigos, "amigosPerfiles");

                        } else {
                            var h1 = document.createElement("h1");
                            h1.setAttribute("style", "text-align:center");
                            h1.innerHTML += "Aún no tienes amigos, busca nuevos ";
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

            function mostrarMisPosts(cantidad) {
                var parametros = {
                    "accion": "mostrarMisPosts",
                    "cantidad": cantidad,
                    "array": $("#cadPosts").val()
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var posts = JSON.parse(respuesta);
                            pintarPosts(posts, "contenido");
                            console.log(respuesta);
                        } else {
                            if (cantidad == "5") {
                                var h1 = document.createElement("h1");
                                h1.innerHTML += "Aquí se mostraran los posts, pero ahora mismo no tienes ninguno";
                                $("#textoEventos").hide();
                                h1.setAttribute("class", "noHay");
                                $("#contenido").append(h1);
                            }
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarMisEventos() {
                console.log(cantidadEventos);
                var parametros = {
                    "accion": "mostrarEventosId",
                    "cantidad": cantidadEventos
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

            function eliminarEvento(evento) {
                var parametros = {
                    "accion": "eliminarEvento",
                    "evento": evento
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        //$("#cadEventos").val("");
                        $("#contenido").empty();
                        //mostrarMisPosts("5");
                        mostrarMisEventos();
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de evento");
                    },
                    type: "POST",
                    dataType: "text"
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
                <input type="text" id="cadPosts">
                <input type="text" id="cadEventos" style="display:none">
                <div id="cabeceraPerfil">
                    <p id="contenidoPerfil">
                        <!--<form method="post" enctype="multipart/form-data">-->
                        <span id="textCambiarAvatar">Cambiar Avatar</span>
                        <!--</form>-->
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
                    <button id="botonPosts" class="boton">Ver mis Posts</button>
                    <button id="botonEventos" class="boton">Ver mis Eventos</button>
                    <h1 id="textoPosts" class="texto">Mis Posts</h1>
                    <h1 id="textoEventos" class="texto">Mis Eventos</h1>
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
            <div id="cambiarImagen">
               <!-- <img src="../controlador/img/eliminar.png" id="cerrarCambiarAvatar" alt="cerrar">-->
                <form method="post" id="cambiarAvatar" enctype="multipart/form-data">
                    <h1>Cambiar foto de perfil</h1>
                    <input type="file" name="userfile" id="foto">
                    <p><input type="submit" class="botonCrearPost" id="enviarImagen" name="cambiarAvatar" value="Cambiar foto de perfil"></p>
                    <input type="text" id="idusu" name="idusu">
                </form>
            </div>
        </div>
    </div>

</body>
</html>
