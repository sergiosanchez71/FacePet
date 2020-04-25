<html>
    <head>
        <title>Notificaciones</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
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

            .notificacion:first-child{
                margin-top: 1rem;
            }

            .notificacion{
                margin: 0rem 5rem 0 5rem;
                height: 100%;
            }

            .datos{
                display: block;
                margin: auto;
                border: 2px solid black;
                padding: 1rem;
                background: white;
                width: 65%;
                min-height: 8rem;
            }

            .imagenNotificacion{
                width: 8rem;
                height: 8rem;
                border-radius: 4rem;
                float:left;
                margin-right: 5rem;
            }

            .usuarioNoti{
                float: left;
                margin-right: 0.3rem;
                font-weight: bold;
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
                background: red;
            }

            .pA{
                color : #555555;
            }
            
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

            @media(max-width: 1000px){

                .datos{
                    width: 100%;
                }

                .notificacion:last-child{
                    margin-bottom: 10rem;
                }

                .imagenNotificacion{
                    width: 10rem;
                    height: 10rem;
                }

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
                mostrarNotificaciones();
                notificacionesVistas();
            });
            
            function notificacionesVistas(){
                var parametros = {
                    "accion": "notificacionesVistas"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);

                    },
                    error: function (xhr, status) {
                        alert("Error al aceptar la petición de amistad");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function aceptarSolicitud(usuario) {
                var parametros = {
                    "accion": "aceptarAmistad",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        alert("Este usuario y tu ya sois amigos");

                    },
                    error: function (xhr, status) {
                        alert("Error al aceptar la petición de amistad");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }
            
            function rechazarSolicitud(usuario){
                var parametros = {
                    "accion": "cancelarSolicitud",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);

                    },
                    error: function (xhr, status) {
                        alert("Error al aceptar la petición de amistad");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }
            

            function mostrarNotificaciones() {
                var parametros = {
                    "accion": "mostrarNotificaciones"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        var notificaciones = JSON.parse(respuesta);
                        for (var i = 0; i < notificaciones.length; i++) {
                            var notificacion = document.createElement("div");
                            notificacion.setAttribute("class", "notificacion");

                            var datos = document.createElement("div");
                            datos.setAttribute("class", "datos");

                            var img = document.createElement("img");
                            img.setAttribute("src", "../controlador/uploads/usuarios/" + notificaciones[i].fotoAmigo);
                            img.setAttribute("class", "imagenNotificacion");
                            img.setAttribute("alt", "imagenPerfil");

                            var usuario = document.createElement("p");
                            usuario.setAttribute("class", "usuarioNoti");
                            usuario.innerHTML = notificaciones[i].nickAmigo;

                            var mensaje = document.createElement("p");
                            mensaje.setAttribute("class", "mensajeNoti");
                            if (notificaciones[i].tipo == "amistad") {
                                mensaje.innerHTML = "te ha enviado una solicitud de amistad";
                            } else {
                                mensaje.innerHTML = notificaciones[i].tipo;
                            }

                            var fecha = document.createElement("p");
                            fecha.setAttribute("class", "fechaNoti");
                            fecha.innerHTML = notificaciones[i].fecha;


                            $("#cuerpo").append(notificacion);
                            notificacion.append(datos);
                            datos.append(img);
                            datos.append(usuario);
                            datos.append(mensaje);

                            if (notificaciones[i].tipo == "amistad") {
                                var cadenaAmigos = notificaciones[i].amigosAmigo;
                                
                                if (cadenaAmigos != null) {
                                    var amigos = cadenaAmigos.split(",");
                                    for (var j = 0; j < amigos.length; j++) {
                                        var amigo = false;
                                        if (amigos[j] == notificaciones[i].user2) {
                                            amigo = true;
                                        }
                                    }
                                } else {
                                    var amigo = false;
                                }
                                
                                if (!amigo) {
                                    
                                    var divOpciones = document.createElement("div");
                                    divOpciones.setAttribute("class", "divOpciones");
                                    
                                    divOpciones.onclick = function (){
                                        //this.setAttribute("style","display:none");
                                        var texto = document.createElement("p");
                                        this.remove();
                                    }

                                    var aceptar = document.createElement("button");
                                    aceptar.setAttribute("class", "aceptar");
                                    aceptar.setAttribute("value", notificaciones[i].user1);
                                    aceptar.innerHTML = "Aceptar";

                                    aceptar.onclick = function (rechazar) {
                                        aceptarSolicitud(this.value);
                                    };

                                    var rechazar = document.createElement("button");
                                    rechazar.setAttribute("class", "rechazar");
                                    rechazar.setAttribute("value", notificaciones[i].user1);
                                    rechazar.innerHTML = "Rechazar";

                                    rechazar.onclick = function () {
                                        rechazarSolicitud(this.value);
                                    };

                                    datos.append(divOpciones);
                                    divOpciones.append(aceptar);
                                    divOpciones.append(rechazar);

                                } else {
                                    var pA = document.createElement("p");
                                    pA.setAttribute("class", "pA");
                                    pA.innerHTML = "Este usuario y tú ya sois amigos";

                                    datos.append(pA);
                                }

                            }
                            datos.append(fecha);

                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
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