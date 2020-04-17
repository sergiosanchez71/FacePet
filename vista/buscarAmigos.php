<html>
    <head>
        <title>Buscar Amigos</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <?php
        session_start();
        ?>
        <style>

            #cuerpo{
                width: 100%;
                margin: auto;
                background: white;
            }

            #buscadorAmigos{
                padding: 2.5% 13% 5% 13%;
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

            @media (max-width: 1000px){

                h1{
                    font-size: 4rem;
                }

                #buscador{
                    height: 4rem;
                    font-size: 3rem;
                }

                #lupa{
                    width: 4rem;
                }

                #buscadorAmigos{
                    padding: 5%;
                }

                #buscarAmigos{
                    width: 100%;
                    padding: 0;
                }
                
                .amigo:last-child{
                    margin-bottom: 10rem;
                }

                .imagenAmigo{
                    width: 14rem;
                    margin-top: 2rem;
                }

                .nombreAmigo{
                    font-size: 2.5rem;
                }

                .animal, .raza, .localidad{
                    font-size: 1.5rem;
                }

                .solicitud{
                    background-color: #FFED91;
                    font-size: 2.5rem;
                    font-weight: bold;
                    border-radius: 1rem;
                    cursor: pointer;
                    transition: 1s background ease;
                }
                
                .imgPata{
                    width: 2.5rem;
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
                <div id="buscadorAmigos">
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
                                <p><span class="nombreAmigo">12345678901234567890</span>                            <img src="../controlador/img/masculino.png" class="sexo" alt="sexo">
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
            <footer>
                <ul id="segundoMenu">
                    <li class="icono"><a href="../index.php"><img src="../controlador/img/cerrar-sesion.png" id="cerrarsesion" alt="cerrarSesion"></a></li>
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span class="alerta">1</span></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span class="alerta">1</span></a></li>
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