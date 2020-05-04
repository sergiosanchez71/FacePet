<html>
    <head>
        <title>Crear Post - FacePet</title>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin();
        ?>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <style>

            #cuerpo{
                margin: auto;
                width: 100%;
                background: white;
                min-height: 40rem;
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

            #titulo{
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

            #multimedia{
                font-size: 1.2rem;
            }

            .botonCrearPost{
                font-weight: bold;
                width: 100%;
                background-color: #FFED91;
                height: 3rem;
                font-size: 2rem;
                transition: 1s background ease;
                border-radius: 2rem;
                cursor: pointer;
            }

            .botonCrearPost:hover, textarea:hover, #titulo:hover{
                background-color:#FFF578;
            }

            #pata{
                padding-left: 0.5rem;
                width: 2rem;
                position: relative;
                top: 3px;
            }

            #paso1{
                display: block;
            }

            #paso2{
                display: none;
            }


            @media (max-width:1000px){

                #crearPost{
                    width: 90%;
                    margin-bottom: 10rem;
                }

                h1{
                    font-size: 4rem;
                }
                
                .paso{
                    font-size: 3.5rem;
                }

                .title{
                    font-size: 3rem;
                }

                #titulo{
                    height: 4rem;
                    font-size: 3rem;
                }

                #contenido{
                    height: 40rem;
                    font-size: 2rem;
                }

                #multimedia{
                    font-size: 2.5rem;
                }

                .botonCrearPost{
                    margin-top: 2rem;
                    height: 5rem;
                    font-size: 4rem;
                }

                #pata{
                    width: 3.5rem;
                    padding-left: 2rem;
                }

            }



        </style>
        <script>

            $(document).ready(function () {
                $("#botonCrearPost").click(crearPost);
            });

            function crearPost() {
                var titulo = $("#titulo").val();
                var contenido = $("#contenido").val();
                var fecha = $("#fecha").val();
                var colorError = "#E95139";
                var campoVacio = false;

                if (titulo.trim() == "") {
                    $("#titulo").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#titulo").css("background", "white");
                }

                if (contenido.trim() == "") {
                    $("#contenido").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#contenido").css("background", "white");
                }


                if (!campoVacio) {

                    var parametros = {
                        "accion": "crearPost",
                        "titulo": titulo,
                        "contenido": contenido,
                        "fecha": fecha
                    };

                    $.ajax({
                        url: "../controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            var paso2 = document.getElementById("paso2");
                            var p = document.createElement("input");
                            paso2.appendChild(p);
                            p.setAttribute("type", "text");
                            p.setAttribute("readonly", "readonly");
                            p.setAttribute("name", "idpost");
                            p.setAttribute("style", "display:none");
                            p.setAttribute("value", respuesta);

                            $("#paso1").css("display", "none");
                            $("#paso2").css("display", "block");

                        },
                        error: function (xhr, status) {
                            alert("Error en la creación de post");
                        },
                        type: "POST",
                        dataType: "text"
                    });

                } else {
                    alert("No puedes dejar campos vacíos");
                }



            }

        </script>
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
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" class="mensajes" alt="mensajes"><p style="display:none;" class="alerta" id="mensaje"></p></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" class="notificaciones" alt="notificaciones"><p style="display:none;" class="alerta" id="notificacion"></p></a></li>
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
                <div id="crearPost">
                    <h1>Crea un nuevo post</h1>
                    <form id="paso1">
                        <h2 class="paso">Paso 1</h2>
                        <p class="title">Título</p> 
                        <input type="text" id="titulo" name="titulo" maxlength="30">
                        <p class="title">Contenido</p> 
                        <textarea type="text" id="contenido" name="contenido" maxlength="1000"></textarea>
                        <!--<p><input type="radio" id="multimedia" value="imagen"><input type="radio" id="multimedia" value="video"></p>-->
                            <!--<button id="botonCrearPost">Crear Post<img src="../controlador/img/pata.png" id="pata" class="pata"></button>-->
                        <p><input type="button" class="botonCrearPost" id="botonCrearPost" value="Paso 2"></p>
                    </form>
                    <form method="post" id="paso2" enctype="multipart/form-data">
                        <h2 class="paso">Paso 2</h2>
                        <p class="title">Añade una foto o vídeo (Opcional)</p>
                        <input type="file" name="userfile" id="multimedia">
                        <p><input type="submit" class="botonCrearPost" name="subirImagen" value="Subir Multimedia"></p>
                    </form>

                </div>
            </div>
            <footer>
                <ul id="segundoMenu">
                    <li class="icono"><a href="../index.php"><img src="../controlador/img/cerrar-sesion.png" class="cerrarsesion" alt="cerrarSesion"></a></li>
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" class="mensajes" alt="mensajes"><span class="alerta">1</span></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" class="notificaciones" alt="notificaciones"><p class="alerta">1</p></a></li>
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