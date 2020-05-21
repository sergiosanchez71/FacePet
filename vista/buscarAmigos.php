<html>
    <head>
        <title>Buscar Amigos</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <script src="../controlador/js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="../controlador/js/jquery-ui.js" type="text/javascript"></script>
        <link href="../controlador/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../controlador/css/jquery.modal.min.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/jquery.modal.min.js" type="text/javascript"></script>
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
                height: 100%;
                min-height: 50rem;
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

            .amigo:first-child{
                margin-top: 3rem;
            }

            .amigo{
                background: #fcf0c9;
                width: 100%;
                float: left;
                padding-bottom: 1rem;
                border-right:1px solid black;
                border-left:1px solid black;
                border-bottom:1px solid #BBBBBB;
                transition: 1s background ease;
            }

            .amigo:hover{
                background: #fff7dd;
            }

            .amigo:first-child{
                border-radius: 3rem 3rem 0 0;
                border-top:1px solid black;
            }

            .amigo:last-child{
                margin-bottom: 5rem;
                border-radius: 0 0 3rem 3rem;
                border-right:1px solid black;
                border-bottom:1px solid black;
            }

            .datos{
                padding-left: 2rem;
            }

            .nombreAmigo{
                font-weight: bold;
                font-size: 1.5rem;
                cursor: pointer;
                float: left;
                transition: 1s color ease;
            }

            .nombreAmigo:first-letter{
                text-transform: uppercase;
            }

            .nombreAmigo:hover{
                color: #f43333;
            }

            .sexo{
                width: 2.5rem;
                margin-left: 1rem;
                margin-top: 1rem;
                padding-bottom: 0.25rem;
            }

            .imagenAmigo{
                width: 10rem;
                height: 10rem;
                border-radius: 4rem;
                margin: 1rem;
                float: left;
                margin-right: 4rem;
                cursor: pointer;
                transition: 1s opacity ease;
            }

            .imagenAmigo:hover{
                opacity: 0.7;
            }

            .solicitud, .pendiente{
                font-size: 1.2rem;
                border-radius: 1rem;
                cursor: pointer;
                transition: 1s background ease;
            }

            .solicitud{
                background-color: #FFED91;
            }

            .pendiente{
                background-color: #EEEEEEE;
            }

            .solicitud:hover, .pendiente:hover{
                background-color:#FFF578;
            }
            
            #ventanaSolicitud *{
                display: block;
                margin: auto;
            }
            
            #ventanaSolicitud h1{
                text-align: center;
            }
            
            #mensajeSolicitud{
                width: 35rem;
                height: 5rem;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

           /* .imgPata{
                width: 1.5rem;
                position: relative;
                top: 2.5px;
            }*/

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
                    height: 14rem;
                    margin-top: 2rem;
                }

                .nombreAmigo{
                    font-size: 2.5rem;
                }

                .sexo{
                    padding-bottom: 1rem;
                    width: 4rem;
                    margin-top: 1.5rem;
                    margin-left: 2rem;
                }

                .animal, .raza, .localidad{
                    font-size: 1.5rem;
                }

                .solicitud, .pendiente{
                    font-size: 2.5rem;
                    font-weight: bold;
                }

                .imgPata{
                    width: 2.5rem;
                }

            }



        </style>
        <script>

            var nombres = [];

            $(document).ready(function () {
                mostrarTodosNombresUsuarios();
                buscarUsuarios();
                $("#buscador").autocomplete({
                    source: nombres,
                    minLength: 0,
                    change: function (event, ui) {
                        $("#buscador").val($(this).val());
                        console.log($("#buscador").val());
                        buscarUsuarios();
                        $('#d1').html(" <b>Triggered Change event:  </b> " + $(this).val());
                    }
                });
                $("#buscador").on('input', function () {
                    buscarUsuarios();
                });
                $("#enviarSolicitudB").click(function () {
                    mandarSolicitud();
                    window.location.reload();
                    //$("#ventanaSolicitud").modal().hide();
                });

            });

            function pulsar(e) {
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla === 13) {
                    buscarUsuarios();
                }
            }


            function mandarSolicitud() {

                var pos = $("#posicionID").val();
                var mensaje = $("#mensajeSolicitud").val();
                console.log(pos);

                $(".solicitud:eq(" + pos + ")").attr("class", "pendiente");
                $(".pendiente:eq(" + pos + ")").text("Pendiente");
                $("#mensajeSolicitud").val("");

                var parametros = {
                    "accion": "mandarSolicitud",
                    "usuario": $("#usuarioID").val(),
                    "mensaje": mensaje
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    succes: function (respuesta) {
                        console.log(respuesta);
                        //console.log("a");
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function cancelarSolicitud(usuario) {
                var parametros = {
                    "accion": "cancelarSolicitud",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    succes: function (respuesta) {
                        console.log(respuesta);
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarTodosNombresUsuarios() {
                console.log("a");
                var parametros = {
                    "accion": "mostrarTodosNombresUsuarios"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        var usuarios = JSON.parse(respuesta);
                        for (var i = 0; i < usuarios.length; i++) {
                            nombres[i] = usuarios[i];
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la eliminacion de post");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }



            function buscarUsuarios() {

                var buscador = $("#buscador").val();

                var parametros = {
                    "accion": "buscarUsuarios",
                    "cadena": buscador
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {

                        $("#buscarAmigos").empty();

                        if (respuesta) {
                            console.log(respuesta);
                            var usuarios = JSON.parse(respuesta);

                            for (var i = 0; i < usuarios.length; i++) {
                                if (usuarios[i].amigos != null) {
                                    var cadenaAmigos = usuarios[i].amigos;
                                    var amigosArray = cadenaAmigos.split(",");
                                    var amigos = false;

                                    for (var j = 0; j < amigosArray.length; j++) {
                                        if (amigosArray[j] == usuarios[i].buscador) {
                                            amigos = true;
                                        }
                                    }
                                } else {
                                    var amigos = false;
                                }

                                if (!amigos) {
                                    var usuario = document.createElement("div");
                                    usuario.setAttribute("class", "amigo");

                                    if (usuarios.length == 1) {
                                        usuario.setAttribute("style", " border-radius:3rem");
                                    }

                                    var datos = document.createElement("div");
                                    datos.setAttribute("class", "datos");

                                    var imagenPerfil = document.createElement("img");
                                    imagenPerfil.setAttribute("src", "../controlador/uploads/usuarios/" + usuarios[i].foto);
                                    imagenPerfil.setAttribute("class", "imagenAmigo");
                                    imagenPerfil.setAttribute("alt", "imagenPerfil");
                                    imagenPerfil.setAttribute("data-value", usuarios[i].id);

                                    imagenPerfil.onclick = function () {
                                        window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                    }

                                    var p = document.createElement("p");

                                    var nombreAmigo = document.createElement("p");
                                    nombreAmigo.setAttribute("class", "nombreAmigo");
                                    nombreAmigo.innerHTML += usuarios[i].nick;
                                    nombreAmigo.setAttribute("data-value", usuarios[i].id);

                                    nombreAmigo.onclick = function () {
                                        window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                    }

                                    var sexo = document.createElement("img");
                                    sexo.setAttribute("src", "../controlador/img/" + usuarios[i].sexo + ".png");
                                    sexo.setAttribute("class", "sexo");
                                    sexo.setAttribute("alt", "sexo");

                                    var animal = document.createElement("p");
                                    animal.setAttribute("class", "animal");
                                    animal.innerHTML += "<strong>Animal</strong> " + usuarios[i].animal;

                                    var raza = document.createElement("p");
                                    raza.setAttribute("class", "raza");
                                    raza.innerHTML += "<strong>Raza</strong> " + usuarios[i].raza;

                                    var localidad = document.createElement("p");
                                    localidad.setAttribute("class", "localidad");
                                    localidad.innerHTML += "<strong>Localidad</strong> " + usuarios[i].provincia + ", " + usuarios[i].municipio;

                                    var solicitud = document.createElement("button");
                                    solicitud.setAttribute("value", usuarios[i].id);

                                    if (usuarios[i].solicitud == "pendiente") {
                                        solicitud.setAttribute("class", "pendiente");
                                        solicitud.setAttribute("data-pos", i);
                                        solicitud.innerHTML += "Pendiente";
                                    } else {
                                        solicitud.setAttribute("class", "solicitud");
                                        solicitud.setAttribute("data-pos", i);
                                        solicitud.innerHTML += "Enviar Solicitud ";
                                    }


                                    solicitud.onclick = function () {
                                        if (this.innerHTML != "Pendiente") {
                                            //mandarSolicitud(this.value);

                                            $("#usuarioID").val(this.value);
                                            $("#posicionID").val(this.dataset.pos);
                                            $("#ventanaSolicitud").modal();
                                        } else {
                                            this.setAttribute("class", "solicitud");
                                            $("#usuarioID").val(this.value);
                                            $("#posicionID").val(this.dataset.pos);
                                            this.innerHTML = "";
                                            this.innerHTML += "Enviar Solicitud";
                                            cancelarSolicitud(this.value);
                                        }

                                    };
                                    $("#buscarAmigos").append(usuario);
                                    usuario.append(datos);

                                    datos.append(imagenPerfil);
                                    datos.append(p);
                                    p.append(nombreAmigo);
                                    p.append(sexo);
                                    datos.append(animal);
                                    datos.append(raza);
                                    datos.append(localidad);
                                    datos.append(solicitud);

                                }
                            }

                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en la busqueda de amigos");
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
                <div id="buscadorAmigos" class="ui-widget" onkeypress="pulsar(event)">
                    <h1>Buscar Amigos</h1>
                    <input type="text" id="buscador" placeholder="Busca a un amigo...">
                    <img src="../controlador/img/lupa.png" id="lupa" alt="lupa">
                    <div id="buscarAmigos">

                    </div>
                </div>
            </div>
            <footer>
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
            </footer>
            <div id="ventanaSolicitud" style="display:none">
                <h1>Enviar solicitud de amistad</h1>
                <input type="text" id="posicionID" style="display:none">
                <input type="text" id="usuarioID" style="display:none">
                <textarea id="mensajeSolicitud" maxlength="100" placeholder="Escriba aquí un mensaje de solicitud si lo desea..."></textarea>
                <button class="solicitud" id="enviarSolicitudB" >Enviar Solicitud</button>
            </div>
        </div>
    </body>
</html>