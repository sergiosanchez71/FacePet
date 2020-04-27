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
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <?php
        session_start();
        include '../controlador/gestion.php';
        ?>
        <style>

            #cuerpo{
                display: grid;
                margin: auto;
                grid-template-areas: 
                    "cabeceraPerfil cabeceraPerfil"
                    "amigosPerfil posts";
                grid-template-columns: 30% 70%;
                grid-template-rows: 28rem;
                width: 100%;
                background: white;
            }

            #cabeceraPerfil{
                grid-area: cabeceraPerfil;
                margin-top: 1.5rem;
                background: #fffbed;
                border: 1px solid #999999;
                display: flex;
                flex-wrap: wrap;
                margin: 3rem;
            }

            #botones{
                grid-area:botones;
                display: none;
            }

            #imgPerfil{
                width: 15rem;
                height: 15rem;
                border-radius: 8rem;
                padding: 1rem;
                transition: opacity 1.5s ease;
                z-index: 2;
            }

            #contenidoPerfil:hover > #imgPerfil {
                opacity: 0.3;
            }

            #contenidoPerfil form{
                position: absolute;
            }

            #contenidoPerfil:hover > #textCambiarAvatar{
                opacity: 0.9;
            }

            #textCambiarAvatar{
                position: relative;
                font-weight: bold;
                font-size: 1.4rem;
                top:9.5rem;
                left: 3rem;
                opacity: 0;
                z-index: 1;
                transition: opacity 1.5s ease;
            }

            #contenidoPerfil{
                width: 15rem;
                margin-left: 15rem;
                cursor: pointer;
            }

            #datos{
                position: relative;
                top: 6.5rem;
                left: 3rem;
            }

            #animalRaza{
                position: relative;
                bottom: 1rem;
            }

            #localidadPerfilUsuario{
                position: relative;
                bottom: 1rem;
            }

            /*#localidadPerfilUsuario{
                position: relative;
                bottom: 3.2rem;
                left: 20rem;
            }*/

            #descripcion{
                padding: 2rem;
            }

            #nombrePerfilUsuario{
                font-weight: bold;
                font-size: 2rem;
            }

            #nombrePerfilUsuario:first-letter{
                text-transform: uppercase;
            }

            #amigosPerfil{
                grid-area: amigosPerfil;
                margin-left: 3rem;
            }

            .amigoPerfil{
                display: grid;
                grid-template-areas: 
                    "imagenAmigo informacionAmigo eliminarAmigo";
                grid-template-columns: 40% 60%;
                border: 1px solid #999999;
                background: #fffbed;
                margin-bottom: 1rem;
            }

            .imagenAmigo{
                width: 6rem;
                height: 6rem;
                border-radius: 4rem;
                margin: 1rem;
            }

            .nombreAmigo:first-letter{
                text-transform: uppercase;
            }

            .nombreAmigo{
                font-weight: bold;
            }

            .informacionAmigo{
                margin-top: 1.5rem;
                margin-right: 1rem;
            }

            #posts{
                grid-area:posts;
            }

            #titularAmigosPerfil,#titularPosts{
                text-align: center;
                font-weight: bold;
                font-size: 1.5rem;
            }

            .post{
                margin-left: 5rem;
            }

            #cambiarImagen{
                display: block;
                margin: auto;
            }

            #cambiarImagen{
                padding-bottom: 8rem;
                text-align: center;
                background: white;
                border: 1px solid #BBBBBB;
                position:fixed; 
                right:50%; 
                margin-right:-500px; 
                margin-top: 10rem;
                width:1000px;
            }

            #cambiarImagen h1{
                font-size: 3rem;
            }

            #cambiarImagen input{
                cursor: pointer;
                font-size: 1.5rem;
            }

            #cambiarImagen #enviarImagen{
                cursor: pointer;
                background-color: #FFED91;
                height: 3rem;
                font-size: 2rem;
                margin-top: 1.5rem;
            }

            #cambiarImagen #cerrarCambiarAvatar{
                padding-top: 1.5rem;
                width: 5rem;
                display: inline-block;
                margin-left: 85%;
                cursor: pointer;
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

            .botonEliminar, .botonEliminarA{
                background: #fffbed;
                float: right;
            }

            @media (max-width:1000px){
                #cuerpo{
                    grid-template-areas: 
                        "cabeceraPerfil"
                        "botones"
                        "amigosPerfil"
                        "posts";
                    grid-template-columns: 96%;
                }

                #contenidoPerfil, #datos{
                    margin-left: 4rem;
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

                .amigoPerfil{
                    margin: auto;
                    width: 90%;
                }

                .amigoPerfil .imagenAmigo{
                    width: 10rem;
                    height: 10rem;
                    margin-left: 20%;
                }

                .amigoPerfil p{
                    font-size: 2rem;
                }

                .amigoPerfil{
                    margin-top: 2rem;
                }

                #datos{
                    position: relative;
                    top: 4rem;
                }

                #nombrePerfilUsuario{
                    font-size: 3rem;
                    margin-top: 1rem;
                }

                #posts{
                    margin-left: -7rem;
                }

                #animalRaza, #localidadPerfilUsuario{
                    font-size: 1.75rem;
                }

            }

        </style>
        <script>
            $(document).ready(function () {
                $("#cambiarImagen").hide();
                getDatosMiPerfil();
                mostrarMisPosts();
                mostrarMisAmigos();
                $("#imgPerfil").click(cambiarAvatar);
                $("#textCambiarAvatar").click(cambiarAvatar);
                $("#cerrarCambiarAvatar").click(cerrarCambiarAvatar);
            });

            function cerrarCambiarAvatar() {
                $("#cambiarImagen").hide();
                $("header").css("opacity", "1");
                $("#cuerpo").css("opacity", "1");
            }

            function cambiarAvatar() {
                $("#cambiarImagen").show();
                $("header").css("opacity", "0.2");
                $("#cuerpo").css("opacity", "0.2");

                $("header").click(function () {
                    cerrarCambiarAvatar();
                });

                var parametros = {
                    "accion": "cambiarAvatar"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var cambiarImagen = document.getElementById("cambiarAvatar");
                        var p = document.createElement("input");
                        cambiarImagen.appendChild(p);
                        p.setAttribute("type", "text");
                        p.setAttribute("readonly", "readonly");
                        p.setAttribute("name", "idusu");
                        p.setAttribute("style", "display:none");
                        p.setAttribute("value", respuesta);
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
                        mostrarMisAmigos();
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }
            
            function eliminarAmigo(amigo){
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

            function getDatosMiPerfil() {
                var parametros = {
                    "accion": "getDatosUsuario"
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
                            for (var i = 0; i < amigos.length; i++) {

                                var amigoPerfil = document.createElement("div");
                                amigoPerfil.setAttribute("class", "amigoPerfil");

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

                                var img = document.createElement("img");
                                img.setAttribute("src", "../controlador/uploads/usuarios/" + amigos[i].foto);
                                img.setAttribute("class", "imagenAmigo");
                                img.setAttribute("alt", "imagenAmigo");

                                var divA = document.createElement("div");
                                divA.setAttribute("class", "informacionAmigo");

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
                                amigoPerfil.append(a);
                                a.append(amigoEliminar);
                                amigoPerfil.append(img);
                                amigoPerfil.append(divA);
                                divA.append(nombreAmigo);
                                divA.append(p);
                                p.append(animalAmigo);
                                p.append(razaAmigo);

                            }
                        } else {
                            var h1 = document.createElement("h1");
                            h1.innerHTML += "Aún no tienes posts, crea uno";
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

            function mostrarMisPosts() {
                var parametros = {
                    "accion": "mostrarMisPosts"
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


                                /* var postEliminarBoton = document.createElement("button");
                                 postEliminarBoton.setAttribute("class","postEliminarBoton");
                                 postEliminarBoton.innerHTML += postEliminar;*/

                                var postUsuario = document.createElement("p");
                                postUsuario.setAttribute("class", "postUsuario");
                                var imgUsuario = document.createElement("img");
                                imgUsuario.setAttribute("class", "imagenUsuario");
                                imgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + posts[i].foto);
                                var nombreUsuario = document.createElement("span");
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
                                postCorazonImg.setAttribute("alt", posts[i].id);

                                if (!posts[i].like) {
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
                                comentarios.setAttribute("title", posts[i].id);
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
                                    window.location.href = "verPost.php?post=" + this.title;
                                }

                                $("#posts").append(post);
                                post.append(a);
                                a.append(postEliminar);
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
                            h1.innerHTML += "Aún no tienes posts, crea uno";
                            $("#posts").append(h1);
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
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
                <div id="botones">
                    <button id="botonAmigos" class="boton"><span>Amigos</span></button>
                    <button id="botonPosts" class="boton"><span>Posts</span></button>
                </div>
                <div id="amigosPerfil">
                    <p id="titularAmigosPerfil">Mis Amigos</p>
                    <div id="amigosPerfiles">

                    </div>
                </div>

                <div id="posts">

                </div>
            </div>
            <footer>
                <ul id="segundoMenu">
                    <li class="icono"><a href="../index.php"><img src="../controlador/img/cerrar-sesion.png" class="cerrarsesion" alt="cerrarSesion"></a></li>
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" class="mensajes" alt="mensajes"><span class="alerta">1</span></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" class="notificaciones" alt="notificaciones"><p class="alerta">1</p></a></li>
                    <li id="liUsuario">
                        <a href="miPerfil.php">
                            <img class="perfil" alt="imgPerfil">
                        </a>
                    </li>
                </ul>
            </footer>
            <div id="cambiarImagen">
                <img src="../controlador/img/eliminar.png" id="cerrarCambiarAvatar" alt="cerrar">
                <form method="post" id="cambiarAvatar" enctype="multipart/form-data">
                    <h1>Cambiar imagen de perfil</h1>
                    <input type="file" name="userfile" id="foto">
                    <p><input type="submit" class="botonCrearPost" id="enviarImagen" name="cambiarAvatar" value="Cambiar foto de perfil"></p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
