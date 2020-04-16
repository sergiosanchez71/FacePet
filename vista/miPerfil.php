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
        <?php
        session_start();
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
                border: 1px solid black;
                display: flex;
                flex-wrap: wrap;
                margin: 3rem;
            }

            #botones{
                grid-area:botones;
            }

            #imgPerfil{
                width: 15rem;
                border-radius: 8rem;
                padding: 1rem;
                transition: opacity 1.5s ease;
                z-index: 2;
            }

            #contenidoPerfil:hover > #imgPerfil {
                opacity: 0.5;
            }

            #contenidoPerfil:hover > #textCambiarAvatar{
                opacity: 0.9;
            }

            #textCambiarAvatar{
                position: relative;
                font-weight: bold;
                font-size: 1.4rem;
                top:10rem;
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

            #localidad{
                position: relative;
                bottom: 1rem;
            }

            /*#localidad{
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
                    "imagenAmigo informacionAmigo";

                border: 1px solid black;
                background: #fffbed;
                margin-bottom: 1rem;
            }

            .imagenAmigo{
                width: 6rem;
                border-radius: 4rem;
                margin: 1rem;
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

            @media (max-width:1000px){
                #cuerpo{
                    grid-template-areas: 
                        "cabeceraPerfil"
                        "botones"
                        "amigosPerfil"
                        "posts";
                    grid-template-columns: 100%;
                }
                
                #contenidoPerfil, #datos{
                    margin-left: 4rem;
                }

                #botones{
                    margin: 3rem;
                }

                .boton{
                    width: 49%;
                    margin: auto;
                    font-size: 1.5rem;
                    font-weight: bold;
                    background-color: #FFED91;
                    height: 3rem;
                    font-size: 2rem;
                    transition: 1s background ease;
                    border-radius: 2rem;
                    cursor: pointer;
                }

                .amigoPerfil{
                    width: 95%;
                }

                #posts{
                    margin-left: -7rem;
                }
                
            }

        </style>
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
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span class="alerta">1</span></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span class="alerta">1</span></a></li>
                    <li id="liUsuario">
                        <a href="miPerfil.php">
                            <img src="../controlador/img/gato.png" id="perfil">
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
                            <a id="mostrarEventos"><li>Eventos</li></a>
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
                        <span id="textCambiarAvatar">Cambiar Avatar</span>
                        <img src="../controlador/img/gato.png" id="imgPerfil" alt="imgPerfil">
                    </p>
                    <div id="datos">
                        <p id="nombrePerfilUsuario"><?php echo $_SESSION['username'] ?></p>
                        <p id="animalRaza"><span>Animal</span> <span>Raza</span></p>
                        <p id="localidad">Localidad</p>
                    </div>
                </div>
                <div id="botones">
                    <button id="botonAmigos" class="boton">Amigos</button>
                    <button id="botonPosts" class="boton">Posts</button>
                </div>
                <div id="amigosPerfil">
                    <p id="titularAmigosPerfil">Mis Amigos</p>
                    <div id="amigosPerfiles">
                        <div class="amigoPerfil">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <div class="informacionAmigo">
                                <p class="nombreAmigo">Nombre de usuario</p>
                                <p><span class="animalAmigo">Animal</span> <span class="razaAmigo">Raza</span></p>
                            </div>
                        </div>
                        <div class="amigoPerfil">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <div class="informacionAmigo">
                                <p class="nombreAmigo">Nombre de usuario</p>
                                <p><span class="animalAmigo">Animal</span> <span class="razaAmigo">Raza</span></p>
                            </div>
                        </div>
                        <div class="amigoPerfil">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <div class="informacionAmigo">
                                <p class="nombreAmigo">Nombre de usuario</p>
                                <p><span class="animalAmigo">Animal</span> <span class="razaAmigo">Raza</span></p>
                            </div>
                        </div>
                        <div class="amigoPerfil">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <div class="informacionAmigo">
                                <p class="nombreAmigo">Nombre de usuario</p>
                                <p><span class="animalAmigo">Animal</span> <span class="razaAmigo">Raza</span></p>
                            </div>
                        </div>
                        <div class="amigoPerfil">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <div class="informacionAmigo">
                                <p class="nombreAmigo">Nombre de usuario</p>
                                <p><span class="animalAmigo">Animal</span> <span class="razaAmigo">Raza</span></p>
                            </div>
                        </div>
                        <div class="amigoPerfil">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <div class="informacionAmigo">
                                <p class="nombreAmigo">Nombre de usuario</p>
                                <p><span class="animalAmigo">Animal</span> <span class="razaAmigo">Raza</span></p>
                            </div>
                        </div> <div class="amigoPerfil">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <div class="informacionAmigo">
                                <p class="nombreAmigo">Nombre de usuario</p>
                                <p><span class="animalAmigo">Animal</span> <span class="razaAmigo">Raza</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="posts">
                    <p id="titularPosts">Mis posts</p>
                    <div class="post">
                        <p class="postUsuario"><img src="../controlador/img/gato.png" class="imagenUsuario" alt="imagenUsuario"><span class="nombreUsuario">Sergio</span></p>
                        <p class="postFecha">05-04-2020 13:33</p>
                        <div class="postCont">
                            <p class="postTitulo">Titulo</p>
                            <img src="../controlador/img/gato.png" class="postImg" alt="postImg">
                            <p class="postContenido">Maecenas vel magna gravida, ullamcorper urna efficitur, condimentum massa. 
                                Etiam dui ex, venenatis in tortor eget, lobortis varius ante. Nullam tempor sapien sapien, venenatis feugiat est sagittis nec. 
                                Phasellus dignissim sem mauris, sed pulvinar magna volutpat eget. Sed interdum ante at urna feugiat, at iaculis ligula finibus.
                                Morbi congue lobortis lacus, id consectetur tellus congue eu. Aliquam ornare nisi erat, id malesuada tellus semper vitae. 
                                Praesent purus lorem, porta volutpat sollicitudin pretium, venenatis rhoncus magna. Praesent nec varius mauris. 
                                Quisque rutrum, eros nec vestibulum imperdiet, dui lectus molestie justo, porttitor blandit neque massa porttitor metus. Praesent pretium elementum est sed pretium. 
                                Curabitur nec ultricies ante. Etiam a orci mattis quam tristique pharetra. Nulla nec velit purus. Vestibulum luctus nulla id neque egestas, id ultrices purus eleifend.
                                lorem, porta volutpat sollicitudin pretium, venenatis rhoncus magna. Praesent nec varius mauris. 
                                Quisque rutrum, eros nec vestibulum imperdiet, dui lectus molestie justo, porttitor blandit neque massa porttitor metus. Praesent pretium elementum est sed pretium. 
                                Curabitur nec ultricies ante. vestibulum imperdiet, dui lectus molestie justo, porttitor blandit neque massa porttitor metus. Praesent pretium elementum est sed pretium. 
                                Curabitur nec ultricies ante.</p>
                            <p class="postLikes"><span>1</span> Me gusta</p>
                            <p class="iconos"><a class="postCorazon"><img src="../controlador/img/noLike.png" class="postCorazonImg" alt="NoLike"></a>
                                <a class="postComentario"><img src="../controlador/img/comentario.png" class="postComentarioImg" alt="Comentario"></a></p>
                        </div>
                    </div>
                    <div class="post">
                        <p class="postUsuario"><img src="../controlador/img/gato.png" class="imagenUsuario" alt="imagenUsuario"><span class="nombreUsuario">Sergio</span></p>
                        <p class="postFecha">05-04-2020 13:33</p>
                        <div class="postCont">
                            <p class="postTitulo">Titulo</p>
                            <img src="../controlador/img/gato.png" class="postImg" alt="postImg">
                            <p class="postContenido">Maecenas.</p>
                            <p class="postLikes"><span>1</span> Me gusta</p>
                            <p class="iconos"><a class="postCorazon"><img src="../controlador/img/noLike.png" class="postCorazonImg" alt="NoLike"></a>
                                <a class="postComentario"><img src="../controlador/img/comentario.png" class="postComentarioImg" alt="Comentario"></a></p>
                        </div>
                    </div>
                    <div class="post">
                        <p class="postUsuario"><img src="../controlador/img/gato.png" class="imagenUsuario" alt="imagenUsuario"><span class="nombreUsuario">Sergio</span></p>
                        <p class="postFecha">05-04-2020 13:33</p>
                        <div class="postCont">
                            <p class="postTitulo">Titulo</p>
                            <img src="../controlador/img/gato.png" class="postImg" alt="postImg">
                            <p class="postContenido">Maecenas vel magna gravida, ullamcorper urna efficitur, condimentum massa. 
                                Etiam dui ex, venenatis in tortor eget, lobortis varius ante. Nullam tempor sapien sapien, venenatis feugiat est sagittis nec. 
                                Phasellus dignissim sem mauris, sed pulvinar magna volutpat eget. Sed interdum ante at urna feugiat, at iaculis ligula finibus.
                                Morbi congue lobortis. dignissim sem mauris, sed pulvinar magna volutpat eget. Sed interdum ante at urna feugiat, at iaculis ligula finibus.
                                impassa porttitor metus. Praesent pretium elementum est sed pretium. 
                                .</p>
                            <p class="postLikes"><span>1</span> Me gusta</p>
                            <p class="iconos"><a class="postCorazon"><img src="../controlador/img/noLike.png" class="postCorazonImg" alt="NoLike"></a>
                                <a class="postComentario"><img src="../controlador/img/comentario.png" class="postComentarioImg" alt="Comentario"></a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
