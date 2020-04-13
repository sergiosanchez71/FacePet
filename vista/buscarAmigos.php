<html>
    <head>
        <title>Buscar Amigos</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <?php
        session_start();
        ?>
        <style>

            #cuerpo{
                width: 40rem;
                margin: auto;
                background: white;
                padding: 2rem 2rem 2rem 2rem;
            }

            #buscador{
                width: 90%;
                height: 2rem;
                font-size: 1.3rem;
            }

            #lupa{
                width: 3rem;
                position: relative;
                top: 1rem;
                cursor: pointer;
            }
            
            .amigo{
                background: #fcf0c9;
                width: 100%;
                margin-top: 3rem;
                border:1.5px solid black;
                float: left;
                padding-bottom: 1rem;
            }

            .datos{
                padding-left: 2rem;
            }

            .nombreAmigo{
                font-weight: bold;
                font-size: 1.5rem;
            }

            .sexo{
                width: 2.5rem;
                position: relative;
                top: 0.5rem;
                left: 1rem;
            }

            .imagenAmigo{
                width: 10rem;
                border-radius: 4rem;
                margin: 1rem;
                float: left;
                margin-right: 4rem;
            }

            .solicitud{
                background-color: #FFED91;
                font-size: 1.2rem;
                border-radius: 1rem;
                cursor: pointer;
                transition: 1s background ease;
            }
            
            .solicitud:hover{
                background-color:#FFF578;
            }
            
            .imgPata{
                width: 1.5rem;
                position: relative;
                top: 2.5px;
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
                <h1>Buscar Amigos</h1>
                <input type="text" id="buscador">
                <img src="../controlador/img/lupa.png" id="lupa" alt="lupa">
                <div id="buscarAmigos">
                    <div class="amigo">
                        <div class="datos">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <p><span class="nombreAmigo">Nombre usuario</span>                            <img src="../controlador/img/masculino.png" class="sexo" alt="sexo">
                            </p>
                            <p class="animal">12345678901234567890</p>
                            <p class="raza">12345678901234567890</p>
                            <p class="localidad">123456789012345678901234567890</p>
                            <button class="solicitud">Enviar Solicitud <img src="../controlador/img/pata.png" class="imgPata" alt="pata"></button>
                        </div>
                    </div>
                    <div class="amigo">
                        <div class="datos">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <p><span class="nombreAmigo">Nombre usuario</span>                            <img src="../controlador/img/masculino.png" class="sexo" alt="sexo">
                            </p>
                            <p class="animal">12345678901234567890</p>
                            <p class="raza">12345678901234567890</p>
                            <p class="localidad">123456789012345678901234567890</p>
                            <button class="solicitud">Enviar Solicitud <img src="../controlador/img/pata.png" class="imgPata" alt="pata"></button>
                        </div>
                    </div>
                    <div class="amigo">
                        <div class="datos">
                            <img src="../controlador/img/gato.png" class="imagenAmigo" alt="imagenAmigo">
                            <p><span class="nombreAmigo">Nombre usuario</span>                            <img src="../controlador/img/masculino.png" class="sexo" alt="sexo">
                            </p>
                            <p class="animal">12345678901234567890</p>
                            <p class="raza">12345678901234567890</p>
                            <p class="localidad">123456789012345678901234567890</p>
                            <button class="solicitud">Enviar Solicitud <img src="../controlador/img/pata.png" class="imgPata" alt="pata"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>