<html>
    <head>
        <title>Crear Evento - FacePet</title>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin();
        ?>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE&callback=initMap"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE&callback=initMap" async defer></script>

        <style>

            #cuerpo{
                margin: auto;
                width: 100%;
                background: white;
                min-height: 40rem;
            }

            #crearEvento{
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

            #botonCrearEvento, #botonCrearEvento2{
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

            #botonCrearEvento:hover, textarea:hover, #titulo:hover, #tipo:hover{
                background-color:#FFF578;
            }

            #pata{
                padding-left: 0.5rem;
                width: 2rem;
                position: relative;
                top: 3px;
            }

            #map{
                height: 30rem;
            }

            #paso1{
                display: block;
            }

            #paso2,#lat,#lng{
                display: none;
            }

            @media (max-width:1000px){

                #crearEvento{
                    width: 90%;
                    margin-bottom: 10rem;
                }

                h1{
                    font-size: 4rem;
                }

                .title{
                    font-size: 3rem;
                }

                #titulo, #tipo{
                    height: 4rem;
                    font-size: 3rem;
                }

                #contenido{
                    height: 40rem;
                    font-size: 2rem;
                }

                #info{
                    font-size: 1.5rem;
                }

                #multimedia{
                    font-size: 2.5rem;
                }

                #botonCrearEvento{
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
                $("#botonCrearEvento").click(crearEvento);
                $("#botonCrearEvento2").click(function () {
                    crearEvento();
                    var titulo = $("#titulo").val();
                    var contenido = $("#contenido").val();
                    var tipo = $("#tipo").val();
                    var fecha = $("#fecha").val();
                    if (titulo.trim() != "" && contenido.trim() != "" && tipo.trim() != "" && fecha.trim() != "" ) {
                        window.location.href = "miPerfil.php";
                    }
                });
                $("#subirImagen").click(function () {
                    window.location.href = "miPerfil.php";
                });
                cargarCrearEvento();
            });
            
            function cargarCrearEvento(){


                    var parametros = {
                        "accion": "cargarCrearEvento"
                    };

                    $.ajax({
                        url: "../controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            console.log(respuesta);
                            var fecha = document.createElement("input");
                            fecha.setAttribute("type","datetime-local");
                           // fecha.setAttribute("id",)
                            fecha.setAttribute("value",Date.parse(respuesta));
                            $("#cuerpo").append(fecha);

                        },
                        error: function (xhr, status) {
                            alert("Error en la creación de Evento");
                        },
                        type: "post",
                        dataType: "text"
                    });

                
            }

            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 40.4378698, lng: -3.8196215},
                    zoom: 15,
                    streetViewControl: false
                });

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(pos);
                    }, function (error) {
                        console.log(error);
                    });
                }

                google.maps.event.addListener(map, 'click', function (event) {
                    setMark(event.latLng);
                });

                var marker = null;

                function setMark(location) {
                    if (marker) {
                        marker.setPosition(location);                        
                    } else {
                        marker = new google.maps.Marker({
                            position: location,
                            map: map, 
                            draggable:true
                        });
                    }
                    $("#lat").val(marker.getPosition().lat().toString());
                    $("#lng").val(marker.getPosition().lng().toString());
                }

            }


            /* function añadirPunto(lat, long) {
             var accion = "añadirPunto";
             var ruta = $('#ruta').val();
             var xhr = new XMLHttpRequest();
             xhr.onreadystatechange = function () {
             if (this.readyState == 4 && this.status == 200) {
             //alert(this.responseText);
             }
             }
             xhr.open("POST", "../controlador/controladorPuntos.php", true);
             xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
             xhr.send("accion=" + accion + "&latitud=" + lat + "&longitud=" + long + "&ruta=" + ruta);
             }*/

            function crearEvento() {
                var titulo = $("#titulo").val();
                var contenido = $("#contenido").val();
                var tipo = $("#tipo").val();
                var fecha = $("#fecha").val();
                var lat = $("#lat").val();
                var lng = $("#lng").val();
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

                if (tipo.trim() == "") {
                    $("#tipo").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#tipo").css("background", "white");
                }
                
                if (fecha.trim() == "") {
                    $("#fecha").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#fecha").css("background", "white");
                }


                if (!campoVacio) {

                    var parametros = {
                        "accion": "crearEvento",
                        "titulo": titulo,
                        "contenido": contenido,
                        "tipo": tipo,
                        "fecha":fecha,
                        "lat": lat,
                        "lng": lng
                    };

                    $.ajax({
                        url: "../controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            console.log(respuesta);
                            var paso2 = document.getElementById("paso2");
                            var p = document.createElement("input");
                            paso2.appendChild(p);
                            p.setAttribute("type", "text");
                            p.setAttribute("readonly", "readonly");
                            p.setAttribute("name", "idevento");
                            p.setAttribute("style", "display:none");
                            p.setAttribute("value", respuesta);

                            $("#paso1").css("display", "none");
                            $("#paso2").css("display", "block");

                        },
                        error: function (xhr, status) {
                            alert("Error en la creación de Evento");
                        },
                        type: "post",
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
                <div id="crearEvento">
                    <h1>Crea un nuevo evento</h1>
                    <form id="paso1">
                        <h2 class="paso">Paso 1</h2>
                        <p class="title">Título</p> 
                        <input type="text" id="titulo" name="titulo" maxlength="30">
                        <p class="title">Contenido</p> 
                        <textarea type="text" id="contenido" name="contenido" maxlength="1000"></textarea>
                        <p class="title">Tipo</p>
                        <input type="text" id="tipo" maxlength="30"> 
                        <p id="info">(una promoción, zona de cría...)</p>
                            <!--<p><input type="radio" id="multimedia" value="imagen"><input type="radio" id="multimedia" value="video"></p>-->
                                <!--<button id="botonCrearEvento">Crear Evento<img src="../controlador/img/pata.png" id="pata" class="pata"></button>-->
                        <p class="title">Fecha y hora del evento</p>
                        <input type="datetime-local" id="fecha">
                        <div id="ubicacion">
                            <p class="title">¿Donde se realizará el evento?</p>
                            <div id="map"></div>
                            <input type="text" id="lat">
                            <input type="text" id="lng">
                        </div>
                        <p><input type="button" class="botonCrearEvento" id="botonCrearEvento" value="Añadir Multimedia">
                            <input type="button" class="botonCrearEvento" id="botonCrearEvento2" value="Publicar Evento"></p>
                    </form>
                    <form method="post" id="paso2" enctype="multipart/form-data">
                        <h2 class="paso">Paso 2</h2>
                        <p class="title">Añade una foto o vídeo (Opcional)</p>
                        <input type="file" name="userfile" id="multimedia">
                        <p><input type="submit" class="botonCrearEvento" id="subirImagen" name="subirImagenE" value="Publicar Evento"></p>
                    </form>

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