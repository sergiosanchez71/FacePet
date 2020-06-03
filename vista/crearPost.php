<html>
    <head>
        <title>Crear Post - FacePet</title>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comprobamos login
        ?>
        <link rel="icon" href="../controlador/img/favicon.ico"><!--Icono-->
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css"><!--Header CSS-->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <script src="../controlador/js/header.js" type="text/javascript"></script><!--Header JS-->
        <style>

            /*El cuerpo ocupa toda la página y su mínima altura es de 40rem background white*/
            #cuerpo{
                margin: auto;
                width: 100%;
                background: white;
                min-height: 40rem;
            }

            /*Div crear post, centrado background amarillento*/
            #crearPost{
                margin: auto;
                width: 40rem;
                background: #FFFBED;
                padding: 2rem;
                margin-top: 3.5rem;
            }

            /*Centramos h1*/
            h1{
                font-family: "Comica","Arial",sans-serif;
                text-align: center;
            }

            /*Aumentamos tamaños*/
            .title{
                font-size: 1.3rem;
                font-weight: bold;
            }

            #titulo{
                width: 100%;
                font-size: 1.2rem;
                transition: 1s background ease;
            }

            /*Contenido del post con transición*/
            textarea{
                resize: none;
                width: 100%;
                height: 14rem;
                font-size: 1.1rem;
                transition: 1s background ease;
            }

            /*Imagen del post*/
            #multimedia{
                font-size: 1.2rem;
            }

            /*Botón crear post con transición color amarillento*/
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

            /*Color con cursor encima*/
            .botonCrearPost:hover, textarea:hover, #titulo:hover{
                background-color:#FFF578;
            }

            /*Primer paso*/
            #paso1{
                display: block;
            }

            /*Segundo paso, multimedia*/
            #paso2{
                display: none;
            }


            /*Vista móvil*/
            @media (max-width:1000px){

                /*Toda la pantalla del móvil*/
                #crearPost{
                    width: 90%;
                    margin-bottom: 10rem;
                }

                /*Aumentamos tamaños*/
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

            }



        </style>
        <script>

            //Al cargar
            $(document).ready(function () {
                $("#botonCrearPost").click(crearPost); //Si hacemos click en boton de crear post creamos el post y añadimos imagen
                $("#botonCrearPost2").click(function () { //Si pulsamos el segundo creamos el post sin imagen
                    crearPost(); //Creamos post
                    var titulo = $("#titulo").val();
                    var contenido = $("#contenido").val();
                    if (titulo.trim() != "" && contenido.trim() != "") { //Si no están vaciíos
                        window.location.href = "miPerfil.php"; //Nos lleva a nuestro perfil
                    }
                });
                $("#subirImagen").click(function () {
                    window.location.href = "miPerfil.php";
                });
            });

            //Crear post
            function crearPost() {
                var titulo = $("#titulo").val(); //Cogemos el valor del título
                var contenido = $("#contenido").val(); //Cogemos el contenido
                var colorError = "#E95139"; //Color por defecto de error
                var campoVacio = false;

                if (titulo.trim() == "") { //Si titulo esta vacío
                    $("#titulo").css("background", colorError); //Lo pintamos
                    campoVacio = true;
                } else {
                    $("#titulo").css("background", "white"); //Lo pintamos en blanco
                }

                if (contenido.trim() == "") { //Si el contenido está vacío
                    $("#contenido").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#contenido").css("background", "white");
                }


                if (!campoVacio) { //Si NO hay ningún campo vacío

                    var parametros = {
                        "accion": "crearPost",
                        "titulo": titulo,
                        "contenido": contenido
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
                            //Mostramos paso2 y ocultamos paso1

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
                <div id="crearPost"> <!--Div crear post-->
                    <h1>Crea un nuevo post</h1>
                    <form id="paso1"> <!-- Paso 1 -->
                        <h2 class="paso">Paso 1</h2>
                        <p class="title">Título</p> 
                        <input type="text" id="titulo" name="titulo" maxlength="30">
                        <p class="title">Contenido</p> 
                        <textarea type="text" id="contenido" name="contenido" maxlength="1000"></textarea>
                        <p><input type="button" class="botonCrearPost" id="botonCrearPost" value="Añadir Imagen">
                            <input type="button" class="botonCrearPost" id="botonCrearPost2" value="Subir Post"></p>
                    </form>
                    <form method="post" id="paso2" enctype="multipart/form-data"> <!-- Paso 2 -->
                        <h2 class="paso">Paso 2</h2>
                        <p class="title">Añade una foto o vídeo (Opcional)</p>
                        <input type="file" name="userfile" id="multimedia">
                        <p><input type="submit" class="botonCrearPost" id="subirImagen" name="subirImagenP" value="Subir Post"></p>
                    </form>

                </div>
            </div>
            <div id="sMenu">
                <!--Menú móvil-->
                <ul id="segundoMenu">
                    <li class="icono"><a href="../index.php"><img src="../controlador/img/cerrar-sesion.png" class="cerrarsesion" alt="cerrarSesion"></a></li>
                    <li class="icono"><a href="mensajeria.php"><img src="../controlador/img/mensaje.png" class="mensajes" alt="mensajes"><p class="alerta" id="mensajeM">1</p></a></li>
                    <li class="icono"><a href="notificaciones.php"><img src="../controlador/img/notificacion.png" class="notificaciones" alt="notificaciones"><p class="alerta" id="notificacionM">1</p></a></li>
                    <li id="liUsuario">
                        <a href="miPerfil.php">
                            <img class="perfil" alt="imgPerfil">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </body>
</html>