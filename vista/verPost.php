<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ver Post</title>
        <link rel="icon" href="../controlador/img/favicon.ico"><!--Icon-->
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css"><!--Header CSS-->
        <link href="../controlador/css/posts.css" rel="stylesheet" type="text/css"/><!--Posts CSS-->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <script src="../controlador/js/header.js" type="text/javascript"></script><!--Header JS-->
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comprobamos el login
        ?>
        <style>

            /*No se muestra el id de post*/
            #idPost{
                display: none;
            }

            /*Todo el post div*/
            #menuPost{
                margin-top: 3rem;
            }

            /*Margen de los lados de nuestro menú y comentarios*/
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

            /*Input tipo text con el contenido del comentario*/
            #comentario{
                width: 74%;
                height: 3rem;
                font-size: 1.5rem;
            }

            /*Botón en el que se envía el comentario*/
            #enviarComentario{
                font-size: 1.3rem;
                width: 15%;
                height: 3.3rem;
                float: right;
                margin-bottom: 10rem;
                font-weight: bold;
                background-color: #FFED91;
                transition: 1s background ease;
                cursor: pointer;
                transition: 1s ease background;
            }

            /*Background blanco*/
            .comentario{
                background: white;
                padding: 1rem;
                border-bottom: 1px solid #EEEEEE;
            }

            /*Margen abajo último mensaje*/
            .comentario:last-child{
                margin-bottom: 10rem;
            }

            /*Imagen del usuario*/
            .cImagenUsuario{
                width: 3rem;
                height: 3rem;
                border-radius: 3rem;
                float: left;
                cursor: pointer;
                transition: 1s opacity ease;
            }

            /*Imagen animación*/
            .cImagenUsuario:hover{
                opacity: 0.7;
            }

            /*Nombre de usuario*/
            .cNombreUsuario{
                font-weight: bold;
                margin-left: 4rem;
                position: relative;
                top: 0.5rem;
                transition: 1s color ease;
                cursor: pointer;
            }

            /*Nombre de usuario color animación*/
            .cNombreUsuario:hover{
                color:#f43333;
            }

            /*Nombre de usuario y contenido primera letra mayúscula*/
            .cNombreUsuario:first-letter,.cCont:first-letter{
                text-transform: uppercase;
            }

            .postImg{
                width: 60%;
            }

            .postContenido{
                margin: 2.5%;
            }

            /*Contenido de abajo likes,comentarios...*/
            .postBottom{
                margin-left: 1.2%;
            }

            /*Fecha*/
            .cFecha{
                font-size: 0.8rem;
                margin-left: 4rem;
                margin-bottom: 4rem;
            }

            /*Contenido del post*/
            .cCont{
                text-align: justify;
                font-size: 1rem;
            }

            /*Botón de eliminar comentario*/
            .botonEliminarA{
                width: 3rem;
                display: block;
                float: right;
                background: white;
                border: 0px solid black;
                cursor: pointer;
            }

            /*Eliminar contenido*/
            .comentarioEliminar{
                width: 1.5rem;
            }

            /*Vista Móvil*/
            @media (max-width: 1000px){

                /*Input tipo texto*/
                #comentario{
                    font-size: 3rem;
                    height: 5rem;
                    border: 1px solid grey;
                    width: 60%;
                }

                /*Aumentamos tamaños*/
                /*Botón de enviar comentario*/
                #enviarComentario{
                    height: 5rem;
                    font-size: 2rem;
                    width: 27.5%;
                }

                /*Imagen de usuario*/
                .cImagenUsuario{
                    width: 8rem;
                    height: 8rem;
                }

                /*Fecha del post*/
                .cFecha{
                    position: relative;
                    bottom:1rem;
                }

                /*Nombre de usuario y fecha del post*/
                .cNombreUsuario, .cFecha{
                    font-size: 2rem;
                    position: relative;
                    left: 1rem;
                }

                .nombreUsuario{
                    position: relative;
                    top: 1rem;
                }

                .postImg{
                    width: 96%;
                }

                .cCont{
                    font-size: 2rem;
                }

                .botonEliminarA{
                    width: 5rem;
                    height: 5rem;
                }

            }

        </style>
        <script>

            $(document).ready(function () {
                cargarPost($("#idPost").val()); //Cargar post dado una id
                mostrarComentarios($("#idPost").val()); //Mostrar comentarios de dicho post
                $("#enviarComentario").click(function () { //Al pulsar el botón
                    if ($("#comentario").val().trim() != "") {
                        publicarComentario($("#idPost").val(), $("#comentario").val());//Publicamos el comentario
                    }
                });
            });

            //Al pulsar intro
            function pulsar(e) {
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 13)
                    if ($("#comentario").val().trim() != "") { //Publicamos si no está vacío
                        publicarComentario($("#idPost").val(), $("#comentario").val());
                    }
            }

            //Publicar comentario
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
                        $("#comentario").val(" "); //Valor vacío del input text
                        mostrarComentarios(post); //Mostramos todos los comentarios
                    },
                    error: function (xhr, status) {
                        alert("Error en publicar comentario");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos todos los comentarios
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
                            $("#comentario").css("margin-bottom", "0");
                            $("#comentariosCont").empty(); //Vaciamos el div de comentarios
                            var textoComentarios = document.createElement("h1");
                            textoComentarios.setAttribute("id", "textoComentarios");
                            textoComentarios.innerHTML = "Comentarios";
                            $("#comentariosCont").append(textoComentarios); //Texto de comentarios
                            for (var i = 0; i < comentarios.length; i++) {

                                var comentario = document.createElement("div"); //Comentario
                                comentario.setAttribute("class", "comentario");

                                var info = document.createElement("div"); //Nombre usuario
                                info.setAttribute("title", "Ver perfil");
                                info.setAttribute("data-value", comentarios[i].usuario);

                                info.onclick = function () { //Enlace a la página de perfil del usuario
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                //Si es el dueño del comentario o es operador
                                if (comentarios[i].loginOperador == "1" || comentarios[i].login == comentarios[i].usuario || comentarios[i].login == comentarios[i].autorPost) {

                                    var a = document.createElement("button");
                                    a.setAttribute("value", comentarios[i].id);
                                    a.setAttribute("title", "Eliminar comentario");
                                    a.setAttribute("class", "botonEliminarA");

                                    a.onclick = function () { //Botón eliminar comentario
                                        if (confirm("Esta seguro de eliminar este comentario")) {
                                            eliminarComentario(this.value);
                                        }
                                    }

                                    //Img botón comentario

                                    var comentarioEliminar = document.createElement("img");
                                    comentarioEliminar.setAttribute("class", "comentarioEliminar");
                                    comentarioEliminar.setAttribute("src", "../controlador/img/eliminar.png");
                                    comentarioEliminar.setAttribute("alt","botonEliminar");
                                }

                                var cImgUsuario = document.createElement("img"); //Imagen de usuario
                                cImgUsuario.setAttribute("class", "cImagenUsuario");
                                cImgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + comentarios[i].foto);
                                cImgUsuario.setAttribute("alt","imgComentario");

                                var cNombreUsuario = document.createElement("p"); //Nombre de usuario
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
                                //Si es admin o el dueño del comentario
                                if (comentarios[i].loginOperador == "1" || comentarios[i].login == comentarios[i].usuario || comentarios[i].login == comentarios[i].autorPost) {
                                    comentario.append(a);
                                    a.append(comentarioEliminar);
                                }
                                info.append(cImgUsuario);
                                info.append(cNombreUsuario);
                                info.append(cFecha);
                                comentario.append(cCont);

                                //Eliminar comentario
                                function eliminarComentario(comentario) {
                                    var parametros = {
                                        "accion": "eliminarComentario",
                                        "comentario": comentario
                                    };

                                    $.ajax({
                                        url: "../controlador/acciones.php",
                                        data: parametros,
                                        success: function (respuesta) {
                                            mostrarComentarios(post); //Mostramos los comentarios
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
                            $("#comentario").css("margin-bottom", "0");
                            $("#comentariosCont").empty(); //Div de comentarios vaciado
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar comentarios");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Cargamos el post
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
                            //Si es amigo o es admin
                            if (posts.amigo || posts.loginOperador == "1") {
                                //Cargamos post
                                var post = document.createElement("div");
                                post.setAttribute("class", "post");
                                var postUsuario = document.createElement("p");
                                postUsuario.setAttribute("class", "postUsuario");
                                postUsuario.setAttribute("title", "Ver perfil");
                                postUsuario.setAttribute("data-value", posts.usuario);

                                postUsuario.onclick = function () { //Enlace al perfil
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var imgUsuario = document.createElement("img"); //Img usuario
                                imgUsuario.setAttribute("class", "imagenUsuario");
                                imgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + posts.foto);
                                imgUsuario.setAttribute("alt","imgUsuario");
                                var nombreUsuario = document.createElement("p"); //Nombre de usuario
                                nombreUsuario.setAttribute("class", "nombreUsuario");
                                nombreUsuario.innerHTML += posts.nick;

                                var postFecha = document.createElement("p"); //Fecha
                                postFecha.setAttribute("class", "postFecha");
                                postFecha.innerHTML += posts.fecha_publicacion;

                                var postCont = document.createElement("div"); //Contenido del post
                                postCont.setAttribute("class", "postCont");

                                var postTitulo = document.createElement("p"); //Titulo del post
                                postTitulo.setAttribute("class", "postTitulo");
                                postTitulo.innerHTML += posts.titulo;

                                if (posts.multimedia != null) { //Si no tiene imagen

                                    var postImg = document.createElement("img"); //Creamos imagen
                                    postImg.setAttribute("class", "postImg");
                                    postImg.setAttribute("alt","postImg");
                                    postImg.setAttribute("src", "../controlador/uploads/posts/" + posts.multimedia);

                                } else {
                                    post.setAttribute("style", "min-height:-20rem"); //Limitamos el min-height para que no queden huecos
                                }

                                var postContenido = document.createElement("p"); //Contenido post
                                postContenido.setAttribute("class", "postContenido");
                                postContenido.innerHTML += posts.contenido;

                                var postBottom = document.createElement("div"); //Parte de abajo
                                postBottom.setAttribute("class", "postBottom")

                                var postLikes = document.createElement("p");//Likes de posts
                                postLikes.setAttribute("class", "postLikes");

                                if (posts.likes != null) { //Si tiene likes
                                    var cadlikes = posts.likes; //Accedemos a los likes
                                    var likes = cadlikes.split(","); //Los separamos
                                    var slikes = document.createElement("span");
                                    slikes.setAttribute("class", "likes");
                                    slikes.innerHTML = likes.length; //Los contamos y escribimos
                                }

                                var iconos = document.createElement("p");//Iconos del evento
                                iconos.setAttribute("class", "iconos");

                                //Likes
                                var postCorazon = document.createElement("a");
                                postCorazon.setAttribute("class", "postCorazon");

                                var postCorazonImg = document.createElement("img");
                                postCorazonImg.setAttribute("class", "postCorazonImg");
                                postCorazonImg.setAttribute("title", "Dar me gusta");
                                postCorazonImg.setAttribute("alt", "Corazon");
                                postCorazonImg.setAttribute("data-value", posts.id); //Id post

                                if (!posts.like) { //Si no le has dado like
                                    postCorazonImg.setAttribute("src", "../controlador/img/nolike.png");

                                    postCorazonImg.onclick = function () { //Si le haces click
                                        this.removeAttribute("src");
                                        this.setAttribute("src", "../controlador/img/like.png"); //Cambias imagen
                                        darLike(this.dataset.value); //Das like
                                        var valor = $(".likes:eq(0)").text();  //Valor del like
                                        var valor2 = parseInt(valor);
                                        $(".likes:eq(0)").text(parseInt(valor2 + 1)); //Se le aumenta uno
                                    }
                                } else {
                                    postCorazonImg.setAttribute("src", "../controlador/img/like.png"); //Si ya le has dado like se pone la imagen like
                                }

                                $("#menuPost").append(post); //Div de todo el post
                                post.append(postUsuario);

                                postUsuario.append(imgUsuario);
                                postUsuario.append(nombreUsuario);

                                post.append(postFecha);
                                post.append(postCont);

                                postCont.append(postTitulo);
                                if (posts.multimedia != null) { //Si el post tiene imagen
                                    postCont.append(postImg);
                                }
                                postCont.append(postContenido);


                                postCont.append(postBottom);

                                postBottom.append(postLikes);

                                if (posts.likes != null) { //Si tiene likes
                                    if (likes.length > 1) { //Si tiene mas de uno
                                        postLikes.append(slikes);
                                        postLikes.append(" Me gustas");  //Mostramos likes
                                    } else { //Si tiene un like
                                        postLikes.append(slikes);
                                        postLikes.append(" Me gusta"); //Mostramos like
                                    }
                                } else { //Si no tiene likes
                                    postLikes.append("0 Me gustas");
                                }

                                postBottom.append(iconos);
                                iconos.append(postCorazon);
                                postCorazon.append(postCorazonImg);


                                //Dar like a post
                                function darLike(post) {
                                    var parametros = {
                                        "accion": "darLike",
                                        "post": post
                                    };

                                    $.ajax({
                                        url: "../controlador/acciones.php",
                                        data: parametros,
                                        success: function (respuesta) {
                                            if (respuesta) {
                                                var res = respuesta.split(",");
                                                $(".postLikes").text((res.length + 1) + " Me gustas");
                                            } else {
                                                $(".postLikes").text("1 Me gusta");
                                            }
                                            //Damos like
                                        },
                                        error: function (xhr, status) {
                                            alert("Error en dar like");
                                        },
                                        type: "POST",
                                        dataType: "text"
                                    });
                                }

                            } else { //Si no somos amigos ni admin volvemos
                                window.location.href = "vistaUsuario.php";
                            }
                        } else { //Si no existe volvemos
                            window.location.href = "vistaUsuario.php";
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar post");
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
                    <a href="vistaUsuario.php" id="facepetA"><img src="../controlador/img/facepet.png" id="facepet" alt="logo"></a>
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
                </div>
                <div id="comentariosPost">
                    <input type="text" id="comentario" onkeypress="pulsar(event)" maxlength="255" placeholder="Añadir comentario">
                    <button id="enviarComentario">Enviar Comentario </button>
                    <div id="comentariosCont">

                    </div>
                </div>

            </div>

            <div id="sMenu">
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
            </div>

        </div>
    </body>
</html>
