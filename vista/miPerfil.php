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
        <link rel="icon" href="../controlador/img/favicon.ico"><!--Icon-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE" async defer></script><!--Map-->
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css"><!--Header CSS-->
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css"><!--Posts CSS-->
        <!--Librerias de estilo y de js de Modales y de autocompletar y sugerencias de usuario-->
        <link href="../controlador/css/jquery.modal.min.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <script src="../controlador/js/jquery.modal.min.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script><!-- Header JS-->
        <script src="../controlador/js/pintarObjetos.js" type="text/javascript"></script><!--Pintar Objetos JS-->
        <link href="../controlador/css/perfil.css" rel="stylesheet" type="text/css"/><!--Perfil CSS-->
        <link href="../controlador/css/eventos.css" rel="stylesheet" type="text/css"/><!--Eventos CSS-->
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comprobamos login
        ?>
        <style>
        </style>
        <script>

            var cargando = 0; //Variable cargando 
            var cantidad = 5; //Cantidad de post mostramos
            var cantidadEventos = 5; //Cantidad de eventos mostrados
            var pest = 0; //Número de pestaña en la que nos encontramos
            //0 Posts, 1 Eventos y 2 Amigos

            $(window).scroll(function () {
                if ($("#contenido").height() > 600 && $(window).width() > 1000) { //Scroll de pc para actualizar
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
                    if ($(window).scrollTop() > 600 && $(window).width() > 1000) { //Scroll de pc para amigos
                        $("#amigosPerfil").css("position", "fixed");
                        $("#amigosPerfil").css("top", "0.5rem");
                        $("#amigosPerfil").css("width", "23%");
                    } else {
                        $("#amigosPerfil").css("position", "relative");
                        $("#amigosPerfil").css("width", "75%");
                    }

                    if ($(window).scrollTop() > $("#cuerpo").height() - 800) { //Scroll para actualizar en pc
                        cargando += 1;
                        if (cargando == 1) { //Si ha cargado
                            if (pest == 0) { //Si la pestaña es 0 mostramos los posts
                                cantidad += 5; //Sumamos la cantidad que queremos mostrar
                                mostrarMisPosts(cantidad); //La mostramos
                            }
                            if (pest == 1) { //Si la pestaña es 1 mostramos los eventos
                                cantidadEventos += 5; //Subammos la cantidad
                                mostrarMisEventos(); //La mostramos
                            }
                        }
                    } else {
                        cargando = 0; //Reseteamos cantidad
                    }

                } else if ($(window).scrollTop() > $("#cuerpo").height() - 2000) { //Scroll para actualizar en móvil
                    cargando += 1;
                    if (cargando == 1) { //Si ha cargado
                        if (pest == 0) { 
                            cantidad += 5;
                            mostrarMisPosts(cantidad); //Mostramos posts
                        }
                        if (pest == 1) {
                            cantidadEventos += 5;
                            mostrarMisEventos(); //Mostramos eventos
                        }
                    }
                } else {
                    cargando = 0; //Reseteamos la cantidad
                }

            });

            $(document).ready(function () {
                $("#cambiarImagen").hide(); //Ocultamos el div de cambiar la imagen
                getDatosMiPerfil(); //Accedemos a los datos del perfil
                mostrarMisPosts(cantidad); //Mostramos mis posts
                mostrarMisAmigos(); //Mostramos mis amigos
                $("#botonPosts").hide();
                $("#textoEventos").hide();
                $("#textoPosts").hide();

                $("#botonEventos").click(function () { //Si hacemos click en el botón de eventos
                    pest = 1; //Pest ahora vale uno
                    cantidad = 5; //Reseteamos la cantidad de posts
                    cantidadEventos = 5; //Y la cantidad de eventos
                    //Ocultamos el botón de eventos y mostramos los demás
                    $("#botonPosts").show();
                    $("#botonEventos").hide();
                    $("#textoPosts").hide();
                    $("#contenido").empty(); //Vaciamos el contenido
                    $("#cadEventos").val(""); //Cadena de eventos ahora se vacía
                    mostrarMisEventos(); //Mostramos los eventos
                });

                $("#botonPosts").click(function () { //Si hacemos click en el botón de eventos
                    pest = 0; //Pest ahora vale cero
                    cantidad = 5; //Reseteamos cantidad de posts y eventos
                    cantidadEventos = 5;
                    //Ocultamos el botón de los posts y mostramos los demás
                    $("#botonPosts").hide();
                    $("#textoEventos").hide();
                    $("#botonEventos").show();
                    $("#textoPosts").show();
                    $("#contenido").empty(); //Vaciamos contenido
                    $("#cadPosts").val(""); //Cadena de posts se vacia
                    mostrarMisPosts(cantidad); //Mostramos los posts
                });

                if ($(window).width() < 1000) { //Si estamos en la vista de móvil

                    $("#botonEventosM").click(function () { //Al hacer click en el botón de eventos
                        //Igual que el anterior 
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

                    $("#botonPostsM").click(function () { //Al hacer click en el botón de posts
                        //Igual que el anterior
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
                        mostrarMisPosts(cantidad);
                    });

                    $("#botonAmigosM").click(function () { //Aquí dispondremos del botón de amigos, que en la vista de pc no está
                        //AL hacer click en él
                        pest = 2; //Pest ahora vale 2
                        cantidad = 5; //Reseteamos la cantidad de post y eventos
                        cantidadEventos = 5;
                        //Ocultamos el botón de amigos y los demás los mostramos
                        $("#botonAmigosM").hide();
                        $("#botonEventosM").show();
                        $("#botonPostsM").show();
                        $("#contenido").empty();
                        $("#amigosPerfiles").show();

                    });

                }

                $("#textCambiarAvatar").click(function () { //Al hacer click en el texto de cambiar avatar
                    getId(); //Cogemos el id de nuestro usuario
                    $("#cambiarImagen").modal();  //Mostramos el modal de cambiar imagen de perfil
                });

                $("#imgPerfil").click(function () { //O si hacemos click en la imagen de perfil
                    getId();
                    $("#cambiarImagen").modal();
                });
            });

            //Función para saber nuestro id
            function getId() {
                var parametros = {
                    "accion": "cambiarAvatar"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#idusu").attr("value", respuesta); //El id de usuario le damos como value nuesttro id
                    },
                    error: function (xhr, status) {
                        alert("Error en get id");
                    },
                    type: "POST",
                    dataType: "text"
                });

            }

            //Función para eliminar post dado su id
            function eliminarPost(post) {
                var parametros = {
                    "accion": "eliminarPost",
                    "post": post
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#cadPosts").val(""); //Vaciamos la cadena de posts
                        $("#contenido").empty(); //Vaciamos el div de contenido
                        mostrarMisPosts(cantidad); //Mostramos los posts
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Función para eliminar amigo dado su id
            function eliminarAmigo(amigo) {
                var parametros = {
                    "accion": "eliminarAmigo",
                    "amigo": amigo
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#amigosPerfiles").empty() //Vaciamos el div de amigos
                        mostrarMisAmigos(); //Mostramos nuestros amigos
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de amigo");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Accedemos a mis datos
            function getDatosMiPerfil() {
                var parametros = {
                    "accion": "getDatosMiUsuario"
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
                        $("#localidadPerfilUsuario").text(usuario.provincia + ", " + usuario.municipio);


                    },
                    error: function (xhr, status) {
                        alert("Error en coger datos de mi perfil");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos nuestros amigos
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
                            pintarAmigos(amigos, "amigosPerfiles","miPerfil"); //Los pintamos desde esta función

                        } else { //Si no se encuentra se muestra el siguiente texto
                            var h1 = document.createElement("h1");
                            h1.setAttribute("style", "text-align:center");
                            h1.innerHTML += "Aún no tienes amigos, busca nuevos ";
                            $("#amigosPerfiles").append(h1);
                        }


                    },
                    error: function (xhr, status) {
                        alert("Error mostrar amigos");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos mis posts dada una cantidad
            function mostrarMisPosts(cantidad) {
                var parametros = {
                    "accion": "mostrarMisPosts",
                    "cantidad": cantidad,
                    "array": $("#cadPosts").val() //cogemos el valor de nuestra cadena de posts
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) { //Si tenemos respuesta
                            var posts = JSON.parse(respuesta);
                            pintarPosts(posts, "contenido"); //Pintamos nuestros posts
                        } else { //Si no hay respuesta
                            if (cantidad == "5") { //y si la cantidad es 5 (por defecto)
                                var h1 = document.createElement("h1"); //Mostramos el siguiente texto
                                h1.innerHTML += "Aquí se mostraran los posts, pero ahora mismo no tienes ninguno";
                                $("#textoEventos").hide();
                                h1.setAttribute("class", "noHay");
                                $("#contenido").append(h1);
                            }
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar mis posts");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }
            
            //Función para mostrar los eventos
            function mostrarMisEventos() {
                var parametros = {
                    "accion": "mostrarEventosId",
                    "cantidad": cantidadEventos //Dada una cantidad
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) { //Si hay respuesta
                            $("#textoEventos").show(); //Mostramos su texto
                            var eventos = JSON.parse(respuesta);
                            pintarEventos(eventos, "contenido"); //Los pintamos

                        } else { //si no mostramos el siguiente texto
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Aquí se mostraran los eventos, pero ahora mismo no hay ninguno";
                            $("#textoEventos").hide();
                            h1.setAttribute("class", "noHay");
                            $("#contenido").append(h1);
                        }

                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar mis eventos");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Función de eliminar evento dado su id
            function eliminarEvento(evento) {
                var parametros = {
                    "accion": "eliminarEvento",
                    "evento": evento
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) { 
                        $("#contenido").empty(); //Vaciamos el contenido 
                        mostrarMisEventos(); //Mostramos nuestros eventos
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
