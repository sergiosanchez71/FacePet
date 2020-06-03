<html>
    <head>
        <title>Notificaciones</title>
        <link rel="icon" href="../controlador/img/favicon.ico"><!-- Icono -->
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css"> <!-- Header CSS -->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script> <!-- JQuery -->
        <script src="../controlador/js/header.js" type="text/javascript"></script> <!-- Header JS -->
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comprobamos el login
        ?>
        <style>
            /*Cuerpo con fondo blanco*/
            #cuerpo{
                background: white;
                margin: auto;
                min-height: 40rem;
                width: 100%;
            }

            /*La primera notificación margen de arriba*/
            .notificacion:first-child{
                margin-top: 1rem;
            }

            /*Cada notificación*/
            .notificacion{
                margin: 0rem 5rem 0 5rem;
                height: 100%;
            }
            
            /*Div de la notificación*/
            .datos{
                display: block;
                margin: auto;
                border-right: 2px solid black;
                border-left: 2px solid black;
                border-bottom: 1px solid #BBBBBB;
                padding: 1rem;
                background: white;
                width: 65%;
                min-height: 8rem;
                background: #fcf0c9;
                transition: 1s background ease;
            }
            
            /*Primera notificación*/
            .notificacion:first-child .datos{
                border-top: 2px solid black;
                margin-top: 5rem;
            }
            
            /*Última notificación*/
            .notificacion:last-child .datos{
                border-bottom: 2px solid black;
                margin-bottom: 10rem;
            }
            
            /*Color de fondo*/
            .datos:hover{
                background: #fff7dd;
            }

            /*Imagen de perfil*/
            .imagenNotificacion{
                width: 8rem;
                height: 8rem;
                border-radius: 4rem;
                float:left;
                margin-right: 5rem;
                transition: 1s opacity ease;
            }
            
            /*Animación*/
            .imagenNotificacion:hover{
                opacity: 0.7;
                cursor: pointer;
            }

            /*Usuario de la notificación */
            .usuarioNoti{
                font-family: "Comica","Arial",sans-serif;
                float: left;
                margin-right: 0.3rem;
                position: relative;
                bottom: 0.2rem;
                font-weight: bold;
                transition: 1s color ease;
            }
            
            .usuarioNoti:hover{
                color: #f43333;
                cursor:pointer;
            }

            .usuarioNoti:first-letter{
                text-transform: uppercase;
            }

            .mensajeNoti{
                font-size: 1rem;
            }

            .fechaNoti{
                font-size: 0.75rem;
            }

            .divOpciones{
                width: 12.57rem;
                margin-left: 13rem;
            }

            /*Texto de amigo*/
            .pA{
                color : #555555;
            }

            /*Botones de petición de amistad*/
            .aceptar,.rechazar{
                font-size: 1.4rem;
                padding: 5px;
                cursor: pointer;
                transition: 1s background ease;
            }

            .aceptar{
                background-color: #c1f4c7;
            }

            .rechazar{
                background-color: #f7a5a5;
            }

            .aceptar:hover, .rechazar:hover{
                background-color:#FFF578;
            }

            /*Vista de móvil*/
            @media(max-width: 1000px){

                /*Ocupa toda la pantalla*/
                .datos{
                    width: 100%;
                }

                /*Margen de abajo*/
                .notificacion:last-child{
                    margin-bottom: 10rem;
                }

                /*Imagen de usuario*/
                .imagenNotificacion{
                    width: 10rem;
                    height: 10rem;
                }

                /*Aumentamos los tamaños*/
                .usuarioNoti{
                    font-size: 2rem;
                    margin-right: 0.9rem;
                }

                .mensajeNoti, .pA{
                    font-size: 2rem;
                }

                .fechaNoti{
                    font-size: 1.5rem;
                }

                .divOpciones{
                    margin-left: 15rem;
                    width: 25.4rem;
                }

                .aceptar,.rechazar{
                    font-size: 3rem;
                    padding: 8px;
                    cursor: pointer;
                    transition: 1s background ease;
                }

            }



        </style>
        <script>

            $(document).ready(function () {
                mostrarNotificaciones();//Mostramos las notificaciones
                notificacionesVistas();//Marcamos las notificaciones como vistas
            });

            function notificacionesVistas() {
                var parametros = {
                    "accion": "notificacionesVistas"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        //Marcamos las notificaciones como vistas
                    },
                    error: function (xhr, status) {
                        alert("Error al ver notificaciones");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Aceptamos la solicitud dado el usuario
            function aceptarSolicitud(usuario) {
                var parametros = {
                    "accion": "aceptarAmistad",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        alert("Este usuario y tu ya sois amigos"); //Si se acepta correctamente se muestra mensaje

                    },
                    error: function (xhr, status) {
                        alert("Error al aceptar la petición de amistad");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Función de rechazar la solicitud dado el usuario
            function rechazarSolicitud(usuario) {
                var parametros = {
                    "accion": "cancelarSolicitud",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        //Se elimina la solicitud de amistad

                    },
                    error: function (xhr, status) {
                        alert("Error al rechazar la petición de amistad");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos las notificaciones
            function mostrarNotificaciones() {
                var parametros = {
                    "accion": "mostrarNotificaciones"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) { //Si hay respuesta
                            var notificaciones = JSON.parse(respuesta);
                            for (var i = 0; i < notificaciones.length; i++) {
                                var notificacion = document.createElement("div");
                                notificacion.setAttribute("class", "notificacion"); //Div de notificación

                                var datos = document.createElement("div");
                                datos.setAttribute("class", "datos"); //Div de datos

                                if(!notificaciones[i].visto){ //Si no se ha visto otro color
                                    datos.setAttribute("style","background:#ffeeba");
                                }

                                var img = document.createElement("img"); //Imagen de usuario
                                img.setAttribute("src", "../controlador/uploads/usuarios/" + notificaciones[i].fotoAmigo);
                                img.setAttribute("class", "imagenNotificacion");
                                img.setAttribute("alt", "imagenPerfil");
                                img.setAttribute("title","Ver perfil");
                                img.setAttribute("data-value",notificaciones[i].user1);

                                img.onclick = function(){//Redireccionamos a su perfil
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var contMensaje = document.createElement("p"); //Contenido del mensaje

                                var usuario = document.createElement("span"); //Nombre de usuario
                                usuario.setAttribute("class", "usuarioNoti");
                                usuario.setAttribute("title","Ver perfil");
                                usuario.setAttribute("data-value",notificaciones[i].user1);
                                usuario.innerHTML = notificaciones[i].nickAmigo;
                                
                                usuario.onclick = function(){ //Al clickar al nombre de usuario nos vamos a su perfil
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var mensaje = document.createElement("p"); //Mensaje de la  notificación
                                mensaje.setAttribute("class", "mensajeNoti");
                                if (notificaciones[i].tipo == "amistad") { //Si el tipo es de amistad
                                    mensaje.innerHTML = "te ha enviado una solicitud de amistad";
                                    if(notificaciones[i].elemento){ //Y si tiene mensaje lo mostramos
                                        mensaje.innerHTML += " con el mensaje: '"+notificaciones[i].elemento+"'";
                                    }
                                } else if (notificaciones[i].tipo == "comentarioP") { //Si es un comentario del post
                                    notificacion.setAttribute("data-value", notificaciones[i].elemento[0].id);
                                    notificacion.setAttribute("style", "cursor:pointer");
                                    notificacion.setAttribute("title","Ver post");
                                    notificacion.setAttribute("title", "Ver post");
                                    var comentario = notificaciones[i].elemento[1].contenido;
                                    if(comentario.length < 50){ //Si el comentario tiene menos de 50 caracteres
                                        mensaje.innerHTML = "ha comentado ' "+comentario+" ' en tu post con titulo " + notificaciones[i].elemento[0].titulo;
                                    } else{ //Si tiene más no se muestra completo
                                        mensaje.innerHTML = "ha comentado ' "+comentario.substring(0,50)+"... ' en tu post con titulo " + notificaciones[i].elemento[0].titulo;
                                    }

                                    notificacion.onclick = function () { //Al pulsar la notificación te manda al post
                                        window.location.href = "verPost.php?post=" + this.dataset.value;
                                    }

                                } else {
                                    mensaje.innerHTML = notificaciones[i].tipo;
                                }
                                
                                //Fecha de la notificación 
                                var fecha = document.createElement("p");
                                fecha.setAttribute("class", "fechaNoti");
                                fecha.innerHTML = notificaciones[i].fecha;


                                $("#cuerpo").append(notificacion);
                                notificacion.append(datos);
                                datos.append(img);
                                datos.append(contMensaje);
                                contMensaje.append(usuario);
                                contMensaje.append(mensaje);

                                if (notificaciones[i].tipo == "amistad") { //Si la notificación es de amistad
                                    var cadenaAmigos = notificaciones[i].amigosAmigo; 
                                    //Comprueba si es nuestro amigo
                                    if (cadenaAmigos != null) {
                                        var amigos = cadenaAmigos.split(","); //array separado por comas
                                        var amigo = false;
                                        for (var j = 0; j < amigos.length; j++) {
                                            if (amigos[j] == notificaciones[i].user2) {
                                                amigo = true; 
                                            }
                                        }
                                    } else {
                                        var amigo = false;
                                    }

                                    if (!amigo) { //Si no es amigo se muestran las opciones

                                        var divOpciones = document.createElement("div"); //Div con botones
                                        divOpciones.setAttribute("class", "divOpciones");

                                        divOpciones.onclick = function () { //Si lo pulsamos desaparece
                                            var texto = document.createElement("p");
                                            this.remove();
                                        }

                                        var aceptar = document.createElement("button"); //El botón de aceptar
                                        aceptar.setAttribute("class", "aceptar");
                                        aceptar.setAttribute("title","Aceptar solicitud");
                                        aceptar.setAttribute("value", notificaciones[i].user1);
                                        aceptar.innerHTML = "Aceptar";

                                        aceptar.onclick = function () { //Al pulsar el botón aceptar
                                            aceptarSolicitud(this.value);
                                        };

                                        var rechazar = document.createElement("button"); //Botón de rechazar solicitud
                                        rechazar.setAttribute("class", "rechazar");
                                        rechazar.setAttribute("title","Rechazar solicitud");
                                        rechazar.setAttribute("value", notificaciones[i].user1);
                                        rechazar.innerHTML = "Rechazar";

                                        rechazar.onclick = function () { //Al clickarlo se rechaza
                                            rechazarSolicitud(this.value);
                                        };

                                        datos.append(divOpciones);
                                        divOpciones.append(aceptar);
                                        divOpciones.append(rechazar);

                                    } else { //Si ya son amigos se muestra este texto
                                        var pA = document.createElement("p");
                                        pA.setAttribute("class", "pA");
                                        pA.innerHTML = "Este usuario y tú ya sois amigos"; 

                                        datos.append(pA);
                                    }

                                }
                                datos.append(fecha);

                            }
                        } else { //Si no tiene notificaciones
                            var h1 = document.createElement("h1");
                            h1.setAttribute("style","text-align:center");
                            h1.innerHTML += "No tienes notificaciones disponibles";
                            $("#cuerpo").append(h1);
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar notificaciones");
                    },
                    type: "POST",
                    dataType: "text"
                });
            

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