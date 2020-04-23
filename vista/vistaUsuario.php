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
        if (isset($_SESSION['username'])) {
            //echo $_SESSION['username'];
        } else {
            header("Location: ../index.php");
        }
        ?>
        <script>

        </script>
        <link  rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <link  rel="stylesheet" type="text/css" href="../controlador/css/posts.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
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
                padding: 3.7% 10% 5% 5%;
            }

            .evento{
                background: white;
                padding: 1rem;
                background-color: #fffbed;
                border: 1px solid black;
                margin-bottom: 3rem;
            }

            .eventoTitulo{
                font-weight: bold;
                text-align: center;
                font-size: 1.5rem;

            }

            .eventoFecha{
                font-size: 0.8rem;
            }

            .eventoImg{
                width: 15rem;;
                display: block;
                margin: auto;
            }

            .eventoContenido{
                font-size: 1rem;
                text-align: justify;
            }

            .eventoAutor{
                font-size: 0.8rem;
            }

            .eventoNombreAutor{
                font-weight: bold;
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

                                /*var a = document.createElement("button");
                                a.setAttribute("value", posts[i].id);
                                a.setAttribute("class", "botonEliminar");

                                a.onclick = function () {
                                    if (confirm("Esta seguro de eliminar este post")) {
                                        eliminarPost(this.value);
                                    }
                                }

                                var postEliminar = document.createElement("img");
                                postEliminar.setAttribute("class", "postEliminar");
                                postEliminar.setAttribute("src", "../controlador/img/eliminar.png");*/


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
                                postLikes.innerHTML += posts[i].likes + " Me gustas";

                                var iconos = document.createElement("p");
                                iconos.setAttribute("class", "iconos");
                                var postCorazon = document.createElement("a");
                                postCorazon.setAttribute("class", "postCorazon");

                                var postCorazonImg = document.createElement("img");
                                postCorazonImg.setAttribute("class", "postCorazonImg");
                                postCorazonImg.setAttribute("src", "../controlador/img/nolike.png");

                                var postComentario = document.createElement("a");
                                postComentario.setAttribute("class", "postComentario");

                                var postComentarioImg = document.createElement("img");
                                postComentarioImg.setAttribute("class", "postComentarioImg");
                                postComentarioImg.setAttribute("src", "../controlador/img/comentario.png");

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
                                postBottom.append(iconos);
                                iconos.append(postCorazon);
                                iconos.append(postComentario);
                                postCorazon.append(postCorazonImg);
                                postComentario.append(postComentarioImg);
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
                    <div class="evento">
                        <p class="eventoTitulo">Titulo</p>
                        <p class="eventoTipo">tipo</p>
                        <p class="eventoFecha">05-04-2020 13:33</p>
                        <p class="eventoContenido">
                            Maecenas vel magna gravida, ullamcorper urna efficitur, condimentum massa. 
                            Etiam dui ex, venenatis in tortor eget, lobortis varius ante. Nullam tempor sapien sapien, venenatis feugiat est sagittis nec. 
                            Phasellus dignissim sem mauris, sed pulvinar magna volutpat eget. Sed interdum ante at urna feugiat, at iaculis ligula finibus.
                            Morbi congue lobortis. digniss
                        </p>
                        <img src="../controlador/img/gato.png" class="eventoImg" alt="eventoImg">
                        <p class="eventoAutor">Autor del evento: <span class="eventoNombreAutor">NombreAutor</span></p>
                    </div>

                    <div class="evento">
                        <p class="eventoTitulo">Titulo</p>
                        <p class="eventoTipo">tipo</p>
                        <p class="eventoFecha">05-04-2020 13:33</p>
                        <p class="eventoContenido">
                            Maecenas vel magna gravida, ullamcorper urna efficitur, condimentum massa. 
                            Etiam dui ex, venenatis in tortor eget, lobortis varius ante. Nullam tempor sapien sapien, venenatis feugiat est sagittis nec. 
                            Phasellus dignissim sem mauris, sed pulvinar magna volutpat eget. Sed interdum ante at urna feugiat, at iaculis ligula finibus.
                            Morbi congue lobortis. digniss
                        </p>
                        <img src="../controlador/img/gato.png" class="eventoImg" alt="eventoImg">
                        <p class="eventoAutor">Autor del evento: <span class="eventoNombreAutor">NombreAutor</span></p>
                    </div>

                    <div class="evento">
                        <p class="eventoTitulo">Titulo</p>
                        <p class="eventoTipo">tipo</p>
                        <p class="eventoFecha">05-04-2020 13:33</p>
                        <p class="eventoContenido">
                            Maecenas vel magna gravida, ullamcorper urna efficitur, condimentum massa. 
                            Etiam dui ex, venenatis in tortor eget, lobortis varius ante. Nullam tempor sapien sapien, venenatis feugiat est sagittis nec. 
                            Phasellus dignissim sem mauris, sed pulvinar magna volutpat eget. Sed interdum ante at urna feugiat, at iaculis ligula finibus.
                            Morbi congue lobortis. digniss
                        </p>
                        <img src="../controlador/img/gato.png" class="eventoImg" alt="eventoImg">
                        <p class="eventoAutor">Autor del evento: <span class="eventoNombreAutor">NombreAutor</span></p>
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
