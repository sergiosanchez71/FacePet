<html>
    <head>
        <title>Buscar Amigos</title>
        <link rel="icon" href="../controlador/img/favicon.ico"><!--Icono-->
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css"><!--Header CSS-->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <script src="../controlador/js/header.js" type="text/javascript"></script><!--Header JS-->
        <!--Librerias de estilo y de js de Modales y de autocompletar y sugerencias de usuario-->
        <script src="../controlador/js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="../controlador/js/jquery-ui.js" type="text/javascript"></script>
        <link href="../controlador/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../controlador/css/jquery.modal.min.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/jquery.modal.min.js" type="text/javascript"></script>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comprobamos el login de usuario
        ?>
        <style>

            /*Cuerpo con el fondo blanco y máxima altura de 50rem*/
            #cuerpo{
                width: 100%;
                margin: auto;
                background: white;
                height: 100%;
                min-height: 50rem;
            }

            /*Div de buscar amigos (buscador)*/
            #buscadorAmigos{
                padding: 2.5% 13% 5% 13%;
            }

            /*Input para buscar*/
            #buscador{
                width: 90%;
                height: 2rem;
                font-size: 1.3rem;
            }

            /*Elemento estético imagen lupa*/
            #lupa{
                width: 3rem;
                position: relative;
                top: 1rem;
                cursor: pointer;
            }

            /*Div de los checkboxs*/
            #checks{
                margin-top: 2rem;
                margin-bottom: -1rem;
            }

            /*Primer amigo margen del buscador*/
            .amigo:first-child{
                margin-top: 3rem;
            }

            /*Cada uno de los amigos con fondo y anchura 100%*/
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

            /*Color de fondo amigo*/
            .amigo:hover{
                background: #fff7dd;
            }

            /*Borde primer amigo*/
            .amigo:first-child{
                border-radius: 3rem 3rem 0 0;
                border-top:1px solid black;
            }

            /*Borde último amigo*/
            .amigo:last-child{
                margin-bottom: 5rem;
                border-radius: 0 0 3rem 3rem;
                border-right:1px solid black;
                border-bottom:1px solid black;
            }

            /*Datos de usuario margen*/
            .datos{
                padding-left: 2rem;
            }

            /*Nombre de amigo tamaño y transación*/
            .nombreAmigo{               
                font-family: "Comica","Arial",sans-serif;
                font-weight: bold;
                font-size: 1.3rem;
                cursor: pointer;
                float: left;
                transition: 1s color ease;
            }

            /*Primera letra mayúscula*/
            .nombreAmigo:first-letter{
                text-transform: uppercase;
            }

            /*Color de letra amigo*/
            .nombreAmigo:hover{
                color: #f43333;
            }

            /*Cada uno de los elementos de tipo sexo*/
            .sexo{
                width: 2.5rem;
                margin-left: 1rem;
                margin-top: 1rem;
                padding-bottom: 0.25rem;
            }

            /*Imagen de cada amigo*/
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

            /*Animación imagen opacidad*/
            .imagenAmigo:hover{
                opacity: 0.7;
            }

            /*Botones de solicitud y pendiente para solicitudes*/
            .solicitud, .pendiente{
                border-radius: 1rem;
                cursor: pointer;
                transition: 1s background ease;
            }

            /*Colores para los botones*/
            .solicitud{
                background-color: #FFED91;
            }

            .pendiente{
                background-color: #EEEEEE;
            }

            .solicitud:hover, .pendiente:hover{
                background-color:#FFF578;
            }

            /*Todo el contenido de la ventana modal*/
            #ventanaSolicitud *{
                display: block;
                margin: auto;
            }

            /*Texto centrado de la ventana modal*/
            #ventanaSolicitud h1{
                text-align: center;
            }

            /*Textarea en el que introduciremos nuestro mensaje*/
            #mensajeSolicitud{
                width: 35rem;
                height: 5rem;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            /*Vista de móvil*/
            @media (max-width: 1000px){
                
                /*Aumentamos los tamaños*/
                h1{
                    font-size: 4rem;
                }

                /*Buscador*/
                #buscador{
                    height: 4rem;
                    font-size: 3rem;
                    border: 1px solid grey;
                }

                #lupa{
                    width: 4rem;
                }

                /*Pequeño padding*/
                #buscadorAmigos{
                    padding: 5%;
                }

                /*Toda la pantalla*/
                #buscarAmigos{
                    width: 100%;
                    padding: 0;
                }


                /*Aumentamos tamños*/
                .check{
                    width: 3rem;
                    height: 3rem;
                }

                .textcheck{
                    font-size: 2.5rem;
                    position: relative;
                    bottom: 0.75rem;
                }

                .textcheck:last-child{
                    padding-right: 3rem;
                }

                .amigo:last-child{
                    margin-bottom: 10rem;
                }

                .imagenAmigo{
                    width: 17rem;
                    height: 17rem;
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
                    font-size: 2rem;
                }

                .solicitud, .pendiente{
                    font-weight: bold;
                    width: 10rem;
                    height: 3rem;
                    font-size: 2rem;
                    width: 20rem;
                }
                
                .solicitud span, .pendiente span{
                    font-size: 2rem;
                }

                #mensajeSolicitud{
                    height: 15rem;
                    font-size: 2rem;
                    border: 1px solid grey;
                }

            }



        </style>
        <script>

            var nombres = []; //Array de nombres
            var ciudad = true; //Check ciudad
            var animal = true; //Check animal

            $(document).ready(function () {
                mostrarTodosNombresUsuarios(); //Mostramos todos los nombres de los usuarios disponibles
                buscarUsuarios(); //Buscamos los usuarios
                $("#buscador").autocomplete({//Si clickamos lo autocompletamos
                    source: nombres,
                    minLength: 2,
                    change: function (event, ui) {
                        $("#buscador").val($(this).val()); //Cogemos el valor introducido
                        buscarUsuarios(); //Volvemos a buscar usuarios
                    }
                });
                $("#buscador").on('input', function () { //Cuando buscador cambie
                    buscarUsuarios(); //Buscamos usuarios
                });
                $("#enviarSolicitudB").click(function () { //Si pulsamos el botón de enviar Solicitud
                    mandarSolicitud(); //Enviamos la solicitud
                    window.location.reload(); //Actualizamos la página
                });

                $("#checkAnimal").click(function () { //Si pulsamos el check de animal
                    if ($('#checkAnimal').is(':checked')) { //Comprobamos si está checkeado
                        $("#checkAnimal:checked").each(function () { //Si lo está
                            if ($(this).val() === "animal") { //Yel valor de animal
                                animal = true; //El check es true
                            }
                        });
                    } else { //Si no es falso
                        animal = false;
                    }
                    buscarUsuarios(); //Volvemos a buscar usuarios
                });

                $("#checkCiudad").click(function () { //Si clickamos en el check de ciudad
                    if ($('#checkCiudad').is(':checked')) { //Comprobamos si es este el que ha sido clickado
                        $("#checkCiudad:checked").each(function () { //Si lo está
                            if ($(this).val() === "ciudad") { //Y el valor es de ciudad
                                ciudad = true; //Ciudad es true
                            }
                        });
                    } else { //Si este no está seleccionado el valor es falso
                        ciudad = false;
                    }
                    buscarUsuarios(); //Volvemos a buscar usuarios
                });

            });

            //Al pulsar la tecla enter
            function pulsar(e) {
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla === 13) {
                    buscarUsuarios(); //Buscamos usuarios
                }
            }


            //Mandar Solicitud
            function mandarSolicitud() {

                var pos = $("#posicionID").val(); //Vemos la posición del usuario
                var mensaje = $("#mensajeSolicitud").val(); //Mensaje que se ha escrito

                $(".solicitud:eq(" + pos + ")").attr("class", "pendiente"); //Cambiamos de clase
                $(".pendiente:eq(" + pos + ")").text("Pendiente"); //Lo volvemos pendiente
                $("#mensajeSolicitud").val(""); //Borramos el mensaje

                var parametros = {
                    "accion": "mandarSolicitud",
                    "usuario": $("#usuarioID").val(),
                    "mensaje": mensaje
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    succes: function (respuesta) {
                        //Mandamos solicitud
                    },
                    error: function (xhr, status) {
                        alert("Error en mandar soliciutd");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Cancelar solicitud dado un uusario
            function cancelarSolicitud(usuario) {
                var parametros = {
                    "accion": "cancelarSolicitud",
                    "usuario": usuario
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    succes: function (respuesta) {
                        //Cancelamos la solicitud con dicho usuario
                    },
                    error: function (xhr, status) {
                        alert("Error en cancelar solicitud");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos los nombres de usuarios disponibles
            function mostrarTodosNombresUsuarios() {
                var parametros = {
                    "accion": "mostrarTodosNombresUsuarios"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var usuarios = JSON.parse(respuesta);
                        for (var i = 0; i < usuarios.length; i++) {
                            nombres[i] = usuarios[i]; //Almacenamos en el array de nombres cada nombre de la BD
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar todos los nombres de usuarios");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }


            //Buscar usuarios
            function buscarUsuarios() {

                var buscador = $("#buscador").val(); //Cogemos el valor del buscador
                var parametros = {
                    "accion": "buscarUsuarios",
                    "cadena": buscador,
                    "animal": animal,
                    "ciudad": ciudad
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {

                        $("#buscarAmigos").empty(); //Vaciamos los amigos

                        if (respuesta) {
                            var usuarios = JSON.parse(respuesta);

                            for (var i = 0; i < usuarios.length; i++) { //Recorremos
                                if (usuarios[i].amigos != null) { //El usuario tiene amigos
                                    var cadenaAmigos = usuarios[i].amigos; //Lo almacenamos en una cadena
                                    var amigosArray = cadenaAmigos.split(","); //Creamos un array separado por comas
                                    var amigos = false; //Por defecto no son amigos

                                    for (var j = 0; j < amigosArray.length; j++) {
                                        if (amigosArray[j] == usuarios[i].buscador) { //Si el nombre coincide con el tuyo
                                            amigos = true; //Son amigos
                                        }
                                    }
                                } else {
                                    var amigos = false; //Si el usuario no tiene amigos, él y tú no sois amigos
                                }

                                if (!amigos) { //Si no sois amigos
                                    var usuario = document.createElement("div");
                                    usuario.setAttribute("class", "amigo"); //Le añadimos la clase amigo al div

                                    if (usuarios.length == 1) { //Si solo se muestra un usuario
                                        usuario.setAttribute("style", " border-radius:3rem");
                                    }

                                    var datos = document.createElement("div");
                                    datos.setAttribute("class", "datos"); //Clase datos

                                    var imagenPerfil = document.createElement("img"); //Imagen de perfil del usuario
                                    imagenPerfil.setAttribute("src", "../controlador/uploads/usuarios/" + usuarios[i].foto); //Ruta
                                    imagenPerfil.setAttribute("class", "imagenAmigo");
                                    imagenPerfil.setAttribute("alt", "imagenPerfil");
                                    imagenPerfil.setAttribute("title","Ver perfil");
                                    imagenPerfil.setAttribute("data-value", usuarios[i].id); //Id usuario

                                    imagenPerfil.onclick = function () { //Al clickear redirecciona al perfil de usuario
                                        window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                    }

                                    var p = document.createElement("p"); //Creamos un p

                                    var nombreAmigo = document.createElement("p"); //Nombre de amigo
                                    nombreAmigo.setAttribute("class", "nombreAmigo");
                                    nombreAmigo.setAttribute("title","Ver perfil");
                                    nombreAmigo.innerHTML += usuarios[i].nick;
                                    nombreAmigo.setAttribute("data-value", usuarios[i].id);

                                    nombreAmigo.onclick = function () { //Al clickearlo nos lleva a su perfil
                                        window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                    }

                                    var sexo = document.createElement("img"); //Mostramos su sexo
                                    sexo.setAttribute("src", "../controlador/img/" + usuarios[i].sexo + ".png");
                                    sexo.setAttribute("class", "sexo");
                                    sexo.setAttribute("alt", "sexo");

                                    var animal = document.createElement("p"); //Mostamos su animal
                                    animal.setAttribute("class", "animal");
                                    animal.innerHTML += "<strong>Animal</strong> " + usuarios[i].animal;

                                    var raza = document.createElement("p"); //Su raza
                                    raza.setAttribute("class", "raza");
                                    raza.innerHTML += "<strong>Raza</strong> " + usuarios[i].raza;

                                    var localidad = document.createElement("p");//Su provincia y municipio
                                    localidad.setAttribute("class", "localidad");
                                    localidad.innerHTML += "<strong>Localidad</strong> " + usuarios[i].provincia + ", " + usuarios[i].municipio;

                                    var solicitud = document.createElement("button"); //Y el botón de solicitud
                                    solicitud.setAttribute("value", usuarios[i].id);

                                    if (usuarios[i].solicitud == "pendiente") { //Si es pediente se le aplica la clase pendiente
                                        solicitud.setAttribute("class", "pendiente");
                                        solicitud.setAttribute("title","Cancelar Solicitud");
                                        solicitud.setAttribute("data-pos", i);
                                        solicitud.innerHTML += "Pendiente";
                                    } else { //Si no la clase solicitud
                                        solicitud.setAttribute("class", "solicitud");
                                        solicitud.setAttribute("title","Enviar Solicitud");
                                        solicitud.setAttribute("data-pos", i);
                                        solicitud.innerHTML += "Enviar Solicitud ";
                                    }


                                    solicitud.onclick = function () { //Si haces click en el botón de solicitud
                                        if (this.innerHTML != "Pendiente") { //Si no es pendiente
                                            //Se cogen el valor de la id de usuario y su posición
                                            $("#usuarioID").val(this.value);
                                            $("#posicionID").val(this.dataset.pos);
                                            //Mostramos una ventana modal
                                            $("#ventanaSolicitud").modal();
                                        } else { //Si es pendiente
                                            //Lo volvemos a convertir en botón "Mandar Solicitud"
                                            this.setAttribute("class", "solicitud");
                                            $("#usuarioID").val(this.value);
                                            $("#posicionID").val(this.dataset.pos);
                                            this.innerHTML = "";
                                            this.innerHTML += "Enviar Solicitud";
                                            //Cancelamos la solicitud pues ya estaba enviada
                                            cancelarSolicitud(this.value);
                                        }

                                    };
                                    //Div general todos los usuarios
                                    $("#buscarAmigos").append(usuario);
                                    //En cada usuario los datos
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
                    <a href="vistaUsuario.php" id="facepetA"><img src="../controlador/img/facepet.png" id="facepet" alt="logo"></a>
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
                    <h1 class="titleSeccion">Buscar Amigos</h1>
                    <input type="text" id="buscador" placeholder="Busca a un amigo...">
                    <img src="../controlador/img/lupa.png" id="lupa" alt="lupa">
                    <div id="checks">
                        <input type="checkbox" id="checkAnimal" class="check" value="animal" checked><span class="textcheck">Ordenar por Animal</span>
                        <input type="checkbox" id="checkCiudad" class="check" value="ciudad" checked><span class="textcheck">Ordenar por Ciudad</span>
                    </div>
                    <div id="buscarAmigos">

                    </div>
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