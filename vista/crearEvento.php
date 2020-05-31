<html>
    <head>
        <title>Crear Evento - FacePet</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comprobar login
        ?>
        <link rel="icon" href="../controlador/img/favicon.ico"> <!--Icon-->
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css"><!--Header CSS-->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <script src="../controlador/js/header.js" type="text/javascript"></script><!--Header Js-->
        <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE&callback=initMap"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOB1uBkwgJm9TNwVwCS8vu46eGhRCErYE&libraries=places&callback=initMap" async defer></script><!--Mapa-->

        <style>

            /*Cuerpo con fondo blanco y la mínima altura es de 40rem*/
            #cuerpo{
                margin: auto;
                width: 100%;
                background: white;
                min-height: 40rem;
            }

            /*Fondo y centrado para el div de menú de crear evento*/
            #crearEvento{
                margin: auto;
                width: 60rem;
                background: #FFFBED;
                padding: 2rem;
                margin-top: 3.5rem;
            }

            /*Título de h1*/
            h1{
                text-align: center;
            }

            /*Todos los títulos de cada campo*/
            .title{
                font-size: 1.3rem;
                font-weight: bold;
            }

            /*Los inputs*/
            #titulo, #tipo, #fechai, #fechaf{
                width: 100%;
                font-size: 1.5rem;
                transition: 1s background ease;
            }

            /*Texto de la fecha centrado*/
            #fechai, #fechaf{
                text-align: center;
            }

            /*La descripción del evento*/
            textarea{
                resize: none;
                width: 100%;
                height: 14rem;
                font-size: 1.1rem;
                transition: 1s background ease;
            }

            /*Texto pequeño*/
            #info{
                font-size: 0.8rem;
            }

            #multimedia{
                font-size: 1.2rem;
            }

            /*Estilo de los botones del formulario*/
            .botonCrearEvento{
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

            /*Mapa con una altura preterminada*/
            #map{
                height: 30rem;
                z-index: 1;
            }

            /*Buscar en el mapa*/
            #searchTextField{
                width: 100%;
                font-size: 1.75rem;
                height: 2rem;
                margin-top: -0.5rem;
                z-index: 2;
                transition: 1s background ease;
            }

            /*Fondo de la transación cuando el cursor esté encima*/
            #botonCrearEvento:hover, textarea:hover, #titulo:hover, #tipo:hover, #fechai:hover, #fechaf:hover, #searchTextField:hover{
                background-color:#FFF578;
            }

            /*Mostramos el paso1 y el 2 lo ocultamos*/
            #paso1{
                display: block;
            }

            #paso2,.invisible{
                display: none;
            }

            /*Vista de móvil*/
            @media (max-width:1000px){

                /*El div de crear evento ocupará toda la página*/
                #crearEvento{
                    width: 90%;
                    margin-bottom: 10rem;
                }

                /*Aumentamos los tamaños*/
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

                .fecha{
                    height: 5rem;
                }

                #fechaf, #fechai{
                    font-size: 3rem;
                }

                #participable{
                    width: 3rem;
                    height: 3rem;
                }

                #info{
                    font-size: 1.5rem;
                }

                #multimedia{
                    font-size: 2.5rem;
                }

                #searchTextField{
                    height: 4rem;
                    font-size: 3rem;
                }

                .botonCrearEvento{
                    margin-top: 2rem;
                    height: 5rem;
                    font-size: 4rem;
                }

            }

        </style>
        <script>
            $(document).ready(function () {
                getDate(); //Accedemos a la fecha actual
                $("#botonCrearEvento").click(crearEvento); //Procedemos a añadir imagen
                $("#botonCrearEvento2").click(function () { //Creamos el evento sin imagen
                    crearEvento(); 
                    //Almacenamos el valor de cada campo
                    var titulo = $("#titulo").val();
                    var contenido = $("#contenido").val();
                    var tipo = $("#tipo").val();
                    var fechai = $("#fechai").val();
                    var fechaf = $("#fechaf").val();
                    //Si ninguno está vacío nos redirige a nuestro perfil
                    if (titulo.trim() != "" && contenido.trim() != "" && tipo.trim() != "" && fechai.trim() != "" && fechaf.trim() != "") {
                          window.location.href = "miPerfil.php";
                    }
                });
            });

            function getDate() { //Accedemos a nuestra fecha
                var parametros = {
                    "accion": "getDateTime"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var fecha = JSON.parse(respuesta); 

                        var hora = parseInt(fecha.hour) + 1 ; //A la hora le sumamos 1

                        /*if (fecha.hour < 10) { //Si tiene menos de un caracter de longitud le introducimos un 0
                         hora = 0+""+hora;
                         }*/

                         //Escribimos el valor de fecha inicio para que no coincida con la actual ni sea menor
                        $("#fechai").val(fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                        $("#fechai").attr("min", fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                        $("#fechai").attr("max", "2099-12-31T23:59");

                        //Incrementamos el valor de hora en dos
                        var hora = parseInt(fecha.hour) + 2;
                        /*if (fecha.hour < 10) {
                         hora = 0+""+hora;
                         }*/

                         //Escribimos el valor de fecha final
                        $("#fechaf").val(fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                        $("#fechaf").attr("min", fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                        $("#fechaf").attr("max", "2099-12-31T23:59");

                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de Evento");
                    },
                    type: "post",
                    dataType: "text"
                });
            }

            //Mostramos mapa
            function initMap() {

                var map = new google.maps.Map(document.getElementById('map'), { //Creamos un nuevo mapa
                    center: {lat: 40.4378698, lng: -3.8196215},
                    zoom: 15,
                    streetViewControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    fullscreenControl: false
                });

                if (navigator.geolocation) { //Accedemos a nuestra posición del navegador
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(pos); //Centramos el mapa donde se encuentre el usuario
                    }, function (error) {
                        console.log(error);
                    });
                }

                /*Al pulsar el mapa creamos un marcador*/
                google.maps.event.addListener(map, 'click', function (event) {
                    setMark(event.latLng);
                    geocodeLatLng(geocoder, map, infowindow);
                });

                var input = document.getElementById('searchTextField'); //Cogemos el valor de nuestro buscador
                var options = {
                    //bounds: defaultBounds,
                    types: ['(cities)']
                };

                var autocomplete = new google.maps.places.Autocomplete(input, options); //Accedemos a Autocomplete de la api de maps "places"
                autocomplete.addListener('place_changed', function () { //Cuando cambia la ubicación

                    var place = autocomplete.getPlace(); //Autocompleta texto

                    var pos = {
                        lat: place.geometry.location.lat(), //Lat y lng de la ubicación
                        lng: place.geometry.location.lng()
                    };
                    map.setCenter(pos); //Centramos el mapa 

                });
                var marker = null; //El marcador se vuelve nulo
                var geocoder = new google.maps.Geocoder(); //Guardamos la información de la ruta
                var infowindow = new google.maps.InfoWindow; //Creamos una ventana

                function setMark(location) { //Creamos un marcador dada nuestra locacalización
                    if (marker) { //Si existe
                        marker.setPosition(location); //Cambiamos la ubicación
                    } else {
                        marker = new google.maps.Marker({ //Si aún no existe creamos uno nuevo
                            position: location,
                            map: map,
                            icon: '../controlador/img/marker.ico',
                            draggable: true
                        });
                    }
                    //Accedemos a los valores de lat y lng del marcador en el lugar que hemos clickado
                    $("#lat").val(marker.getPosition().lat().toString()); 
                    $("#lng").val(marker.getPosition().lng().toString());
                }

                //Función de geocode
                function geocodeLatLng(geocoder, map, infowindow) { //Accedemos al geocoder, le damos un mapa y una ventana de información
                    var latinp = $("#lat").val(); //Cogemos su latitud
                    var lnginp = $("#lng").val(); //Y longitud
                    var latlng = {lat: parseFloat(latinp), lng: parseFloat(lnginp)};
                    geocoder.geocode({'location': latlng}, function (results, status) {
                        if (status === 'OK') { //Si se hace correctamente
                            if (results[0]) { //Accedemos al contenido
                                var address = results[0].formatted_address.split(','); //Lo separamos por comas
                                infowindow.setContent(results[0].formatted_address); //Lo escribimos en la ventana
                                infowindow.open(map, marker); //Abrimos la ventana
                                if (address.length > 4) { //Depende de la longitud la calle, el estado y la provincia se encuentra en parte distinta
                                    $("#calle").val(address[0]);
                                    var estado = address[2].split(' ');
                                    $("#provincia").val(address[3]);
                                } else if (address.length > 3) {
                                    $("#calle").val(address[0]);
                                    var estado = address[1].split(' ');
                                    $("#provincia").val(address[2]);
                                } else {
                                    var estado = address[0].split(' ');
                                    $("#provincia").val(address[1]);
                                }
                                //Las almacenamos y cogemos el valor del estado 
                                $("#cp").val(estado[1]); //Guardamos nuestro cp
                                if (estado[2] != null) {
                                    removeItemFromArr(estado, estado[1]); //Borro los elementos no necesarios de nuestra ciudad
                                    var ciudad = estado.toString(); //La guardamos
                                    ciudad = ciudad.replace(',', ' ').trim(); //Y cambiamos las , por espacios en blanco
                                    var re = /,/g; 
                                    $("#estado").val(ciudad.replace(re, ' ')); //Reemplazamos las , por espacios en blanco
                                }
                            } else {
                                window.alert('No results found');
                            }
                        } else {
                            window.alert('Geocoder failed due to: ' + status);
                        }
                    });
                    function removeItemFromArr(arr, item) { //Eliminar elemento de un array
                        var i = arr.indexOf(item);
                        arr.splice(i, 1);
                    }
                }

            }

            //Creo un evento
            function crearEvento() {
                //Almacenamos el valor de cada input
                var titulo = $("#titulo").val();
                var contenido = $("#contenido").val();
                var tipo = $("#tipo").val();
                var fechai = $("#fechai").val();
                var fechaf = $("#fechaf").val();
                var direccion = $("#calle").val();
                var cp = $("#cp").val();
                var ciudad = $("#estado").val();
                var provincia = $("#provincia").val();
                var lat = $("#lat").val();
                var lng = $("#lng").val();
                //Si el evento es participable
                if ($("#participable").prop('checked')) {
                    //Se le almacena una "t" de "true"
                    var participable = "t";
                } else {
                    //Si no no se le almacena nada
                    var participable = "";
                }

                //Color de error por defecto
                var colorError = "#E95139";
                var campoVacio = false;

                //Comprueba cada campo para que no esté ninguno en blanco
                //Si lo está se le colorea el background y campoVacio es "true"
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

                if (fechai.trim() == "") {
                    $("#fechai").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#fechai").css("background", "white");
                }

                if (fechaf.trim() == "") {
                    $("#fechaf").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#fechaf").css("background", "white");
                }

                //Si campo vacío es false
                if (!campoVacio) {

                    var parametros = {
                        "accion": "crearEvento",
                        "titulo": titulo,
                        "contenido": contenido,
                        "tipo": tipo,
                        "fechai": fechai,
                        "fechaf": fechaf,
                        "direccion": direccion,
                        "cp": cp,
                        "ciudad": ciudad,
                        "provincia": provincia,
                        "lat": lat,
                        "lng": lng,
                        "participable": participable
                    };

                    $.ajax({
                        url: "../controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            //Mostramos el paso2
                            var paso2 = document.getElementById("paso2");
                            var p = document.createElement("input");
                            paso2.appendChild(p);
                            p.setAttribute("type", "text");
                            p.setAttribute("readonly", "readonly");
                            p.setAttribute("name", "idevento");
                            p.setAttribute("style", "display:none");
                            p.setAttribute("value", respuesta);

                            //Ocultamos el paso1
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
                        <p class="title">Título</p> 
                        <input type="text" id="titulo" name="titulo" maxlength="30">
                        <p class="title">Contenido</p> 
                        <textarea type="text" id="contenido" name="contenido" maxlength="1000"></textarea>
                        <p class="title">Tipo</p>
                        <input type="text" id="tipo" maxlength="30"> 
                        <p id="info">(una promoción, zona de cría...)</p>
                        <p class="title">Fecha y hora del inicio del evento</p>
                        <input type="datetime-local" id="fechai" class="fecha">
                        <p class="title">Fecha y hora del fin del evento</p>
                        <input type="datetime-local" id="fechaf" class="fecha">
                        <div id="ubicacion">
                            <p class="title">¿Donde se realizará el evento?</p>
                            <input type="text" id="searchTextField">
                            <div id="map"></div>
                            <input type="text" id="lat" class="invisible">
                            <input type="text" id="lng" class="invisible">
                            <input type="text" id="calle" class="invisible">
                            <input type="text" id="cp" class="invisible">
                            <input type="text" id="estado" class="invisible">
                            <input type="text" id="provincia" class="invisible">
                        </div>
                        <p class="title">¿Participable?
                            <input type="checkbox" id="participable" value="yes">
                        </p>
                        <p><input type="button" class="botonCrearEvento" id="botonCrearEvento" value="Añadir Multimedia">
                            <input type="button" class="botonCrearEvento" id="botonCrearEvento2" value="Publicar Evento"></p>
                    </form>
                    <form method="post" id="paso2" enctype="multipart/form-data">
                        <p class="title">Añade una foto (Opcional)</p>
                        <input type="file" name="userfile" id="multimedia">
                        <p><input type="submit" class="botonCrearEvento" id="subirImagen" name="subirImagenE" value="Publicar Evento"></p>
                    </form>

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
    </div>

</body>
</html>