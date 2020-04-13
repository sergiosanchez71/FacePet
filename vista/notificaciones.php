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
                width: 74rem;
            }
            
            .notificacion{
                
            }
            .imagenNotificacion{
                width: 5rem;
                border-radius: 4rem;
            }
            
            
            
        </style>
    </head>
    <body>
        <div id="principal">
            <header>
                <a href="vistaUsuario.php" id="facepetA"><img src="../controlador/img/facepet.png" id="facepet"></a>
                <nav>
                    <li><a href="vistaUsuario.php">Inicio</a></li>
                    <li><a href="miPerfil.php">Mi Perfil</a></li>
                    <li id="crear">Crear
                        <ul>
                            <li><a href="crearPost.php">Crear Post</a></li>
                            <li><a href="crearEvento.php">Crear Evento</a></li>
                        </ul>
                    </li>
                    <li><a href="buscarAmigos.php">Buscar Amigos</a></li>
                    <li><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span class="alerta">1</span></a></li>
                    <li><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span class="alerta">1</span></a></li>
                    <a><li id="liUsuario">
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
            </header>
            <div id="cuerpo">
                <div class="notificacion">
                    <img src="../controlador/img/gato.png" class="imagenNotificacion" alt="Perfil">
                </div>
            </div>
        </div>
    </body>
</html>