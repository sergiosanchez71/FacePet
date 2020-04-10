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
                width: 70rem;
                margin: auto;
                background: white;
                padding: 2rem 2rem 2rem 2rem;
            }
            
            #buscador{
                width: 30rem;
                height: 2rem;
                font-size: 1.3rem;
            }
            
            #buscarAmigos{
                
            }
            
            #lupa{
                width: 3rem;
                position: relative;
                top: 1rem;
                cursor: pointer;
            }
            
            #buscarAmigos{
                display: flex;
                flex: wrap;
            }
            
            .amigo{
                background: red;
                width: 30rem;
                margin-top: 2rem;
            }
            
            .datos{
                padding-left: 3rem;
            }
            
            .nombreAmigo{
                float: left;
            }
            
            .sexo{
                width: 2.5rem;
                position: relative;
                left: 1rem;
                top: 2.5rem;
            }
            
            .imagenAmigo{
                width: 6rem;
                border-radius: 4rem;
                margin: 1rem;
                float: left;
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
                    <li><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span class="alerta">1</span></li>
                    <li><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span class="alerta">1</span></li>
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
                            <p class="nombreAmigo">Nombre Amigo</p>
                            <img src="../controlador/img/masculino.png" class="sexo" alt="sexo">
                            <p class="animal">12345678901234567890</p>
                            <p class="raza">12345678901234567890</p>
                            <p>123456789012345678901234567890</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>