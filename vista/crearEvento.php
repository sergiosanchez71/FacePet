<html>
    <head>
        <title>Crear Post - FacePet</title>
        <?php
        session_start();
        ?>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <style>

            #cuerpo{
                margin: auto;
                width: 70rem;
            }

            #crearPost{
                margin: auto;
                width: 40rem;
                background: #FFFBED;
                padding: 2rem;
                margin-top: 3.5rem;
            }
            
            h1{
                text-align: center;
            }
            
            .title{
                font-size: 1.3rem;
                font-weight: bold;
            }
            
            #titulo, #tipo{
                width: 100%;
                font-size: 1.2rem;
                transition: 1s background ease;
            }
            
            textarea{
                resize: none;
                width: 100%;
                height: 14rem;
                font-size: 1.1rem;
                transition: 1s background ease;
            }
            
            #info{
                font-size: 0.8rem;
            }
            
            #multimedia{
                font-size: 1.2rem;
            }
            
            #botonCrearPost{
                font-size: 1.5rem;
                font-weight: bold;
                width: 100%;
                background-color: #FFED91;
                height: 3rem;
                font-size: 2rem;
                transition: 1s background ease;
                border-radius: 2rem;
                cursor: pointer;
            }
            
            #botonCrearPost:hover, textarea:hover, #titulo:hover, #tipo:hover{
                background-color:#FFF578;
            }
            
            #pata{
                padding-left: 0.5rem;
                width: 2rem;
                position: relative;
                top: 3px;
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
                <div id="crearPost">
                    <h1>Crea un nuevo evento</h1>
                    <p class="title">Título</p> 
                    <input type="text" id="titulo" maxlength="30">
                    <p class="title">Contenido</p> 
                    <textarea type="text" id="contenido" maxlength="1000"></textarea>
                    <p class="title">Tipo</p>
                    <input type="text" id="tipo" maxlength="30"> 
                    <p id="info">(una promoción, zona de cría...)</p>
                    <p class="title">Añade una foto o vídeo</p>
                    <p><input type="file" class="form-control-file" name="multimedia" id="multimedia"></p>
                    <button id="botonCrearPost">Crear Post<img src="../controlador/img/pata.png" id="pata" class="pata"></button>
                </div>
            </div>
        </div>

    </body>
</html>