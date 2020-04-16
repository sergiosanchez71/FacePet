<html>
    <head>
        <title>Notificaciones</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <?php
        session_start();
        ?>
        <style>
            #cuerpo{
                background: white;
                margin: auto;
                min-height: 40rem;
                width: 100%;
            }
            
            .notificacion{
                margin-bottom: 1rem;
                border: 1px solid black;
                padding: 1rem;
                margin: 1rem 5rem 0 5rem;
            }
            
            .imagenNotificacion{
                width: 5rem;
                border-radius: 4rem;
                float:left;
                margin-right: 5rem;
            }
            
            .usuarioNoti{
                float: left;
                margin-right: 1rem;
                font-weight: bold;
            }
            
            .mensajeNoti{
                font-size: 1rem;
            }
            
            .fechaNoti{
                font-size: 0.75rem;
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
                <div class="notificacion">
                    <img src="../controlador/img/gato.png" class="imagenNotificacion" alt="Perfil">
                    <p class="usuarioNoti">Usuario</p>
                    <p class="mensajeNoti">Mensaje de notificación</p>
                    <p class="fechaNoti">Fecha de notificación</p>
                </div>
                <div class="notificacion">
                    <img src="../controlador/img/gato.png" class="imagenNotificacion" alt="Perfil">
                    <p class="usuarioNoti">Usuario</p>
                    <p class="mensajeNoti">Mensaje de notificación</p>
                    <p class="fechaNoti">Fecha de notificación</p>
                </div>
                <div class="notificacion">
                    <img src="../controlador/img/gato.png" class="imagenNotificacion" alt="Perfil">
                    <p class="usuarioNoti">Usuario</p>
                    <p class="mensajeNoti">Mensaje de notificación</p>
                    <p class="fechaNoti">Fecha de notificación</p>
                </div>
                
            </div>
        </div>
    </body>
</html>