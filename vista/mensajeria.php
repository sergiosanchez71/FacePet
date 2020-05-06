<html>
    <head>
        <title>Mensajería</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin();
        ?>

        <style>
            #cuerpo{
                width: 100%;
                margin: auto;
                background: white;
                display: grid;
                grid-template-areas:
                    "listaAmigos mensajes";
                grid-template-columns: 30% 70%;
                height: 100%;
            }

            #listaAmigos{
                grid-area: listaAmigos;
                border: 1px solid black;
                padding: 1rem;
                overflow-y: auto;
            }

            #chatear{
                font-weight: bold;
                font-size: 1.25rem;
            }

            #buscador{
                width: 100%;
                border-radius: 0.5rem;
            }

            .amigo{
                display: grid;
                grid-template-areas: 
                    "imagen datos mensajesAmigos";
                grid-template-columns: auto auto 15%;
                width: 20rem;
                margin: auto;
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 3rem;
                cursor:pointer;
                transition: 1s background ease;
            }

            .amigo:hover{
                background: lightgrey;
            }

            .imgAmigo{
                grid-area: imagen;
                width: 60%;
                height: 7rem;
                border-radius: 4rem;
            }

            .datos{
                grid-area:datos;
            }

            .nombreAmigo{
                font-weight: bold;
                font-size: 1rem;
            }

            .nombreAmigo:first-letter, #nombreAmigoCM:first-letter{
                text-transform: uppercase;
            }

            .animalAmigo, .razaAmigo{
                font-size: 0.8rem;
                line-height: 0.6;
            }

            .divMensajesAmigo{
                grid-area: mensajesAmigos;
            }

            .mensajesAmigo{
                font-size: 1.5rem;
                font-weight: bold;
                width: 2rem;
                height: 1.75rem;
                margin: 1rem;
                color: white;
                text-align: center;
                border-radius: 3rem;
            }

            #Cmensajes{
                grid-area: mensajes;
                border: 1px solid black;
                display: grid;
                grid-template-areas: 
                    "cabeceraCM"
                    "cuerpoCM"
                    "pieCM";
                grid-template-rows: 7rem 45rem 5rem;
            }

            #cabeceraCM{
                display: grid;
                grid-template-areas:
                    "imgAmigoCM nombreAmigoCM";
                border-bottom: 1px solid black;
                grid-area:cabeceraCM;
            }
            
            #selecciona{
                text-align: center;
                padding: 1rem;
            }

            #imgAmigoCM{
                grid-area: imgAmigoCM;
                width: 5rem;
                height: 5rem;
                border-radius: 5rem;
                float:left;
                padding: 1rem;
            }

            #nombreAmigoCM{
                grid-area: nombreAmigoCM;
                font-weight: bold;
                margin-top: 3rem;
                margin-right: 3rem;
            }

            #idUsuario{
                display: none;
            }

            #cuerpoCM{
                grid-area:cuerpoCM;
                padding:1rem;
                overflow: auto;
            }

            .mUser1, .mUser2{
                max-width: 100%;
                margin-bottom: 1rem;
                padding: 2rem 2rem 0.1px 2rem;
                border-radius: 8rem;
                word-break: break-all; 
                font-size: 1rem;
            }

            .mUser1{
                margin-left: 10rem;
                background-color: #d5edda;
            }

            .mUser2{
                margin-right: 10rem;
                background-color: #eeeeee;
            }

            .mUser1 .fecha, .mUser2 .fecha{
                color: grey;
                font-size: 0.75rem;
                text-align: right;
            }

            #pieCM{
                grid-area: pieCM;
                border-top: 1px solid black;
            }

            #mensajeEscrito{
                border-radius: 1rem;
                margin: 1rem 1rem 0.5rem 1rem;
                width: 95%;
            }

            #enviarMensaje{
                float: right;
                background-color: #FFED91;
                font-size: 1.2rem;
                border-radius: 1rem;
                margin-right: 1rem;
                cursor: pointer;
                transition: 1s background ease;
            }

            @media (max-width:1200px){

                #cuerpo{
                    grid-template-columns: 40% 60%;
                    padding-bottom: 15rem;
                }

                #buscador, #mensajeEscrito{
                    height: 4rem;
                    font-size: 2rem;
                }

                .imgAmigo{
                    width: 7rem;
                    height: 7rem;
                }

                .nombreAmigo{
                    font-size: 1.5rem;
                }

                .animalAmigo, .razaAmigo{
                    font-size: 1.2rem;
                }

                #cabeceraCM{
                    grid-template-columns: 20% 80%;
                    grid-template-rows: 20% 50% 30%;
                }

                #enviarMensaje{
                    font-size: 3rem;
                }

            }


        </style>

        <script>

            $(document).ready(function () {
                mostrarMisAmigos();
                $('#buscador').on('input', function () {
                    mostrarMisAmigos();
                });
                $("#enviarMensaje").click(function () {
                    enviarMensaje($("#mensajeEscrito").val(), $("#idUsuario").val());
                });
                if ($("#idUsuario").length > 0) {
                    //mostrarChat($("#idUsuario").val());
                    /*setInterval(function () {
                     mostrarChat($("#idUsuario").val());
                     $("#cuerpoCM").animate({scrollTop: $('#cuerpoCM')[0].scrollHeight})
                     }, 500);*/
                }

                $("#imgAmigoCM").css("display", "none");
                $("#enviarMensaje").css("display", "none");
                $("#mensajeEscrito").css("display", "none");
                $("#cabeceraCM").append(h1);

                /* mostrarCabeceraChat(amigos[i].id);
                 mostrarChat(amigos[i].id);
                 mensajesLeidos(amigos[i].id);*/
            });


            function pulsar(e) {
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 13)
                    enviarMensaje($("#mensajeEscrito").val(), $("#idUsuario").val());
            }

            function mostrarMisAmigos() {

                var buscador = $("#buscador").val();

                var parametros = {
                    "accion": "mostrarMisAmigosyMensajes",
                    "cadena": buscador
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#amigos").empty();
                        if (respuesta) {
                            console.log(respuesta);

                            var amigos = JSON.parse(respuesta);
                            for (var i = 0; i < amigos.length; i++) {

                                var amigoPerfil = document.createElement("div");
                                amigoPerfil.setAttribute("data-value", amigos[i].id);
                                amigoPerfil.setAttribute("class", "amigo");
                                /*  if (amigos[i].visto) {
                                 console.log(getMensajesNoVistos(amigos[i].visto));
                                 }*/

                                amigoPerfil.onclick = function () {
                                    mostrarCabeceraChat(this.dataset.value);
                                    mostrarChat(this.dataset.value);
                                    mensajesLeidos(this.dataset.value);
                                    this.setAttribute("style", "background:white");
                                    this.removeChild(divMensajesAmigo);
                                }

                                var img = document.createElement("img");
                                img.setAttribute("src", "../controlador/uploads/usuarios/" + amigos[i].foto);
                                img.setAttribute("class", "imgAmigo");
                                img.setAttribute("alt", "imagenAmigo");

                                var datos = document.createElement("div");
                                datos.setAttribute("class", "datos");

                                var nombreAmigo = document.createElement("p");
                                nombreAmigo.setAttribute("class", "nombreAmigo");
                                nombreAmigo.innerHTML = amigos[i].nick;

                                var animalAmigo = document.createElement("span");
                                animalAmigo.setAttribute("class", "animalAmigo");
                                animalAmigo.innerHTML = amigos[i].animal;

                                var razaAmigo = document.createElement("span");
                                razaAmigo.setAttribute("class", "razaAmigo");
                                razaAmigo.innerHTML = " " + amigos[i].raza;

                                var divMensajesAmigo = document.createElement("div");
                                divMensajesAmigo.setAttribute("class", "divMensajesAmigo");

                                var mensajes = document.createElement("p");
                                mensajes.setAttribute("class", "mensajesAmigo");
                                /*mensajes.setAttribute("onload", setInterval(function(){
                                 comprobarMensajes(this);
                                 },500));*/

                                if (amigos[i].mensajes > 0) {
                                    amigoPerfil.setAttribute("style", "background:#ffb5b5");
                                    mensajes.setAttribute("style", "background:red");
                                    mensajes.innerHTML = amigos[i].mensajes;
                                }

                                /* function comprobarMensajes(m) {
                                 //this.setAttribute("style", "background:red");
                                 //this.value(m);
                                 console.log(m);
                                 }*/

                                $("#amigos").append(amigoPerfil);
                                amigoPerfil.append(img);
                                amigoPerfil.append(datos);
                                datos.append(nombreAmigo);
                                datos.append(animalAmigo);
                                datos.append(razaAmigo);
                                amigoPerfil.append(divMensajesAmigo);
                                divMensajesAmigo.append(mensajes);

                                setInterval(function () {
                                    // $("#cuerpoCM").animate({scrollTop: $('#cuerpoCM')[0].scrollHeight})
                                }, 2000);

                            }
                        } else {
                            var h1 = document.createElement("h1");
                            h1.setAttribute("style", "text-align:center");
                            if (buscador.length < 1) {
                                h1.innerHTML += "Aún no tienes amigos, busca nuevos";
                            }
                            /* $("#chatear").css("display","none");
                             $("#buscador").css("display","none");
                             $("#imgAmigoCM").css("display","none");*/
                            $("#listaAmigos").append(h1);
                        }


                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarCabeceraChat(usuario) {
                var parametros = {
                    "accion": "mostrarCabeceraChat",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var amigo = JSON.parse(respuesta);
                        $("#imgAmigoCM").css("display", "block");
                        $("#enviarMensaje").css("display", "block");
                        $("#mensajeEscrito").css("display", "block");
                        $("#selecciona").css("display", "none");

                        $("#imgAmigoCM").attr("src", "../controlador/uploads/usuarios/" + amigo.foto);
                        $("#nombreAmigoCM").text(amigo.nick);
                        $("#idUsuario").attr("value", amigo.id);
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarChat(usuario) {
                var parametros = {
                    "accion": "mostrarChat",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#cuerpoCM").text("");
                        if (respuesta) {
                            var mensajes = JSON.parse(respuesta);
                            for (var i = 0; i < mensajes.length; i++) {

                                var div = document.createElement("div");
                                if (mensajes[i].user1 == usuario) {
                                    div.setAttribute("class", "mUser2");
                                } else {
                                    div.setAttribute("class", "mUser1");
                                }

                                var contenido = document.createElement("span");
                                contenido.innerHTML = mensajes[i].mensaje;

                                var fecha = document.createElement("p");
                                fecha.setAttribute("class", "fecha");
                                fecha.innerHTML = mensajes[i].fecha;

                                $("#cuerpoCM").append(div);
                                div.append(contenido);
                                div.append(fecha);
                            }
                        }
                        $("#cuerpoCM").animate({scrollTop: $('#cuerpoCM')[0].scrollHeight});
                        setInterval(function () {
                            comprobarMensajesNuevos(usuario);
                        }, 500);


                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function comprobarMensajesNuevos(usuario) {
                var parametros = {
                    "accion": "mensajesUsuarioNoVistos",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta) {
                            var mensajes = JSON.parse(respuesta);
                            for (var i = 0; i < mensajes.length; i++) {

                                var div = document.createElement("div");
                                if (mensajes[i].user1 == usuario) {
                                    div.setAttribute("class", "mUser2");
                                } else {
                                    div.setAttribute("class", "mUser1");
                                }

                                var contenido = document.createElement("span");
                                contenido.innerHTML = mensajes[i].mensaje;

                                var fecha = document.createElement("p");
                                fecha.setAttribute("class", "fecha");
                                fecha.innerHTML = mensajes[i].fecha;

                                $("#cuerpoCM").append(div);
                                div.append(contenido);
                                div.append(fecha);

                                mensajesLeidos(usuario);
                            }
                        }


                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });

            }


            function enviarMensaje(mensaje, usuario) {
                if (mensaje.trim() != "" && usuario.length > 0) {
                    var parametros = {
                        "accion": "enviarMensaje",
                        "mensaje": mensaje,
                        "usuario": usuario
                    };

                    $.ajax({
                        url: "../controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            $("#mensajeEscrito").val(" ");
                            var div = document.createElement("div");
                            div.setAttribute("class", "mUser1");

                            var contenido = document.createElement("span");
                            contenido.innerHTML = mensaje;

                            var fecha = document.createElement("p");
                            fecha.setAttribute("class", "fecha");
                            var f = new Date();
                            //var fecha = dateFormat(f, "yyyy, mm, dd h:MM:ss");
                            fecha.innerHTML = f;

                            $("#cuerpoCM").append(div);
                            div.append(contenido);
                            div.append(fecha);

                            $("#cuerpoCM").animate({scrollTop: $('#cuerpoCM')[0].scrollHeight})
                        },
                        error: function (xhr, status) {
                            alert("Error en la eliminacion de post");
                        },
                        type: "POST",
                        dataType: "text"
                    });

                } else {
                    alert("Mensaje vacío");
                }

            }

            function mensajesLeidos(usuario) {
                var parametros = {
                    "accion": "mensajesLeidos",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: $("#cuerpoCM").animate({scrollTop: $('#cuerpoCM')[0].scrollHeight}),
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
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
                <div id="listaAmigos">
                    <p id="chatear">Chatea con tus amigos</p>
                    <input type="text" id="buscador" placeholder="Busca a un amigo">
                    <div id="amigos"></div>

                </div>
                <div id="Cmensajes">
                    <div id="cabeceraCM">
                        <h1 id="selecciona">Selecciona un chat</h1>
                        <img id="imgAmigoCM" alt="imgAmigo">
                        <p id="nombreAmigoCM"></p>
                        <input type="text" id="idUsuario">
                    </div>
                    <div id="cuerpoCM">

                    </div>
                    <div id="pieCM">
                        <input type="text" id="mensajeEscrito" onkeypress="pulsar(event)" placeholder="Escribe un mensaje">
                        <button id="enviarMensaje">Enviar</button>
                    </div>
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