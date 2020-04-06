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
        <style>

            #cuerpo{
                grid-area: cuerpo;
                display: grid;
                grid-template-areas: 
                    "menuL posts";
                width: 70rem;
                margin: auto;
            }

            #posts{
                grid-area: posts;
                margin: auto;
                width: 50rem;
                margin-top: 2rem;
            }

            .post{
                min-height: 29rem;
                background-color: #FFFFC8;
                width: 40rem;
                margin: 1rem;
                padding: 1rem;
                border: 1px solid black;
            }

            .imagenUsuario{
                width: 3rem;
                border-radius: 3rem;
            }

            .nombreUsuario{
                position: relative;
                bottom: 1.5rem;
                left: 1rem;
                font-weight: bold;
            }

            .postFecha{
                font-size: 0.8rem;
                position: relative;
                bottom: 2rem;
                left: 4rem;
            }

            .postCont{
                position: relative;
                bottom: 3rem;
            }

            .postTitulo{
                grid-area: titulo;
                font-size: 2rem;
                font-weight: bold;
                text-align: center;
            }

            .postContenido{
                text-align: justify;
                margin: 1rem;
            }

            .postImg{
                width: 15rem;
                width: 15rem;
                float:left;
                margin: 0 1rem 1rem 1rem;
            }

            .postLikes{
                font-weight: bold;
                margin: 1rem;
            }
            
            .iconos{
                margin: 1rem;
            }

            .postCorazonImg, .postComentarioImg{
                width: 2rem;
                padding-right: 1rem;
            }

            #menuL{
                grid-area: menuL;
                width: 20rem;
                display: none;
            }


        </style>
    </head>
    <body>
        <?php
        // put your code here
        ?>

        <div id="principal">

            <header>
                <a href="../index.php" id="facepetA"><img src="../controlador/img/facepet.png" id="facepet"></a>
                <nav>
                    <li><a href="vistaUsuario.php">Inicio</a></li>
                    <li><a href="#">Mi Perfil</a></li>
                    <li id="crear">Crear
                        <ul>
                            <li><a href="#">Crear Post</a></li>
                            <li><a href="#">Crear Evento</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Buscar Amigos</a></li>
                    <li><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span class="alerta">1</span></li>
                    <li><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span class="alerta">1</span></li>
                    <li id="liUsuario"><img src="../controlador/img/gato.png" id="perfil"><span id="nombreUsuario"><?php echo $_SESSION['username']; ?></span></li>
                </nav>
            </header>

            <div id="cuerpo">
                <div id="posts">
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
                <div id="menuL">
                    <ul>
                        <li>Hola</li>
                    </ul>
                </div>
            </div>

            <footer>

            </footer>

        </div>


    </body>
</html>
