<html>
    <head>
        <title>Crear Post - FacePet</title>
        <?php
        
        session_start();
        
        ?>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
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
                            <li><a href="#">Crear Evento</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Buscar Amigos</a></li>
                    <li><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span class="alerta">1</span></li>
                    <li><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span class="alerta">1</span></li>
                    <li id="liUsuario"><img src="../controlador/img/gato.png" id="perfil"><span id="nombreUsuario"><?php echo $_SESSION['username']; ?></span>
                        <img src="../controlador/img/abajo.png" id="abajo" alt="abajo">
                        <ul>
                            <li><a href="../index.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </nav>
            </header>
            <div id="cuerpo">
                
            </div>
        </div>
        
    </body>
</html>