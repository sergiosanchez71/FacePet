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
                            <div class="postBottom">
                                <p class="postLikes"><span>1</span> Me gusta</p>
                                <p class="iconos">
                                    <a class="postCorazon"><img src="../controlador/img/noLike.png" class="postCorazonImg" alt="NoLike"></a>
                                    <a class="postComentario"><img src="../controlador/img/comentario.png" class="postComentarioImg" alt="Comentario"></a>
                            </div>
                        </div>
                    </div>
                    <div class="post">
                        <p class="postUsuario"><img src="../controlador/img/gato.png" class="imagenUsuario" alt="imagenUsuario"><span class="nombreUsuario">Sergio</span></p>
                        <p class="postFecha">05-04-2020 13:33</p>
                        <div class="postCont">
                            <p class="postTitulo">Titulo</p>
                            <img src="../controlador/img/gato.png" class="postImg" alt="postImg">
                            <p class="postContenido">Maecenas.</p>
                            <div class="postBottom">
                                <p class="postLikes"><span>1</span> Me gusta</p>
                                <p class="iconos">
                                    <a class="postCorazon"><img src="../controlador/img/noLike.png" class="postCorazonImg" alt="NoLike"></a>
                                    <a class="postComentario"><img src="../controlador/img/comentario.png" class="postComentarioImg" alt="Comentario"></a>
                            </div>
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
                            <div class="postBottom">
                                <p class="postLikes"><span>1</span> Me gusta</p>
                                <p class="iconos">
                                    <a class="postCorazon"><img src="../controlador/img/noLike.png" class="postCorazonImg" alt="NoLike"></a>
                                    <a class="postComentario"><img src="../controlador/img/comentario.png" class="postComentarioImg" alt="Comentario"></a>
                            </div>
                            </p>
                        </div>
                    </div>
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
                    <li class="icono"><a href="../index.php"><img src="../controlador/img/cerrar-sesion.png" id="cerrarsesion" alt="cerrarSesion"></a></li>
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span class="alerta">1</span></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span class="alerta">1</span></a></li>
                    <li id="liUsuario">
                        <a href="miPerfil.php">
                            <img src="../controlador/img/gato.png" id="perfil" alt="imgPerfil">
                        </a>
                    </li>
                </ul>
            </footer>

        </div>


    </body>
</html>
