

<html>
    <head>
        <title>Registro en FacePet</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script>

            /*Al cargar la página*/
            $(document).ready(function () {
                mostrarAnimales();
                mostrarProvincias();
                $("#animales").change(mostrarRazas);//Al cambiar el select de animales mostramos sus razas
                $("#provincias").change(mostrarMunicipios); //Al cambiar el select de provincias mostramos sus municipios
                $("#registro").click(crearUsuario); //Al pulsar el botón de registro creamos el usuario
            });

            //Mostramos los animales
            function mostrarAnimales() {
                var parametros = {
                    "accion": "consultarAnimales"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta); //Transformamos la respuesta
                        var animales = document.getElementById("animales"); //Cogemos el select de animales
                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option"); //Creamos distintas opciones
                            animales.appendChild(option); //Llenamos el select de animales con cada una
                            option.setAttribute("value", resp.id[i]); //Añadimos como value el id
                            option.innerHTML += resp.animal[i]; //Escribimos el nombre del animal
                        }
                        mostrarRazas(); //Mostramos las razas del animal que este seleccionado

                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar animales");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos las razas dado un animal
            function mostrarRazas() {
                var entrada = $("#animales").val(); //Cogemos el valor del select animales

                var parametros = {
                    "accion": "consultarRazas",
                    "animal": entrada
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);
                        $("#razas").empty(); //Vaciamos la lista de razas
                        var razas = document.getElementById("razas"); //La seleccionamos
                        for (var i = 0; i < resp.raza.length; i++) {
                            var option = document.createElement("option"); //Creamos opciones
                            razas.appendChild(option);
                            option.setAttribute("value", resp.id[i]); //El value será su id
                            option.innerHTML += resp.raza[i]; //Escribimos los nombres de las razas
                        }

                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar razas");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos las provincias
            function mostrarProvincias() {
                var parametros = {
                    "accion": "consultarProvincias"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);
                        var provincias = document.getElementById("provincias"); //Seleccionamos el select de provincias
                        for (var i = 0; i < resp.length; i++) {
                            var option = document.createElement("option");
                            provincias.appendChild(option);
                            option.setAttribute("value", resp[i].id); //El value será su id
                            option.innerHTML += resp[i].provincia; //Escribimos el nombre de la provincia
                        }
                        mostrarMunicipios(); //Mostramos los municipios de esa provincia seleccionada

                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar provincias");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostrar municipios dada una provincia
            function mostrarMunicipios() {
                var entrada = $("#provincias").val(); //Seleccioanmos el valor de provincias

                var parametros = {
                    "accion": "consultarMunicipios",
                    "provincia": entrada
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);
                        $("#municipios").empty(); //Vaciamos el select de municipios
                        var municipios = document.getElementById("municipios"); //Lo seleccionamos
                        for (var i = 0; i < resp.length; i++) {
                            var option = document.createElement("option");
                            municipios.appendChild(option);
                            option.setAttribute("value", resp[i].id); //El value será el id de ese municipio
                            option.innerHTML += resp[i].municipio; //Escribimos el nombre del municipio
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar municipios");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Creamos usuario
            function crearUsuario() {
                //Seleccionamos los valores introducidos en el formulario por id
                var nick = $("#nick").val();
                var password = $("#password").val();
                var email = $("#email").val();
                var animal = $("#animales").val();
                var raza = $("#razas").val();
                var sexo = $('input[name=sexo]:checked').val(); //Selecciona el nombre del sexo que esté activo
                var provincia = $("#provincias").val();
                var municipio = $("#municipios").val();

                var colorError = "#ffd6d6"; //Color por que tendrá de background los inputs que no se introduzcan
                var campoVacio = false; //Si campovacio es true no se ejecutará la consulta

                if (nick.trim() == "") { //Si el nick está vacío
                    $("#nick").css("background", colorError);
                    campoVacio = true; //Error
                } else {
                    $("#nick").css("background", "white");
                }

                if (password.trim() == "") { //Si la contraseña está vacía
                    $("#password").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#password").css("background", "white");
                }

                if (!validarEmail(email)) { //Si el email no es válido
                    $("#email").css("background", colorError);
                } else {
                    $("#email").css("background", "white");
                }

                //Si todos los campos están completos
                if (!campoVacio && validarEmail(email)) {

                    var parametros = {
                        //Guardamos todos los datos
                        "accion": "crearUsuario",
                        "nick": nick,
                        "password": password,
                        "email": email,
                        "animal": animal,
                        "raza": raza,
                        "sexo": sexo,
                        "provincia": provincia,
                        "municipio": municipio
                    };

                    $.ajax({
                        url: "../controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            alert(respuesta);
                            if (respuesta == "Usuario registrado correctamente") { //Si la respuesta tiene ese valor
                                window.location.replace("../index.php"); //Nos manda a la pantalla de inicio
                            }
                        },
                        error: function (xhr, status) {
                            alert("Error en la creación de usuario");
                        },
                        type: "POST",
                        dataType: "text"
                    });

                } else {
                    if (!validarEmail(email) && campoVacio) { //Si el formato del email es incorrecto y se han dejado más campos vacíos
                        alert("No puedes dejar campos vacíos");
                    } else if (!validarEmail(email)) { //Si el formato de email no es correcto
                        alert("El formato del email no es correcto");
                    } else { //Si el formato de email es correcto pero hay campos vacíos
                        alert("No puedes dejar campos vacíos");
                    }

                }

            }

            //Función para comprobar si el formato del email es correcto
            function validarEmail(valor) {
                if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(valor)) {
                    return true;
                } else {
                    return false;
                }
            }

        </script>
        <style>

            /*Fondo gris en el body*/
            body{
                background-color: #EEEEEE;
            }

            /*La ventana de registro centrada, fondo blanco y borde redondo*/
            #principal{
                margin: auto;
                width: 32.5rem;
                padding: 2rem;
                background-color: white;
                border-radius: 3rem;
            } 

            /*La ventana de registro y el nombre/logo*/
            #principal #facepet{
                width: 15rem;
                position: relative;
                top: 0.5rem;
            }

            /*Cambiamos el formato de la letra de nuesstro h1 y los hacemos más grandes*/
            #principal h1{
                font-size: 2.5rem;
                text-align: center;
                font-family: "Comic Sans MS";
                position: relative;
                bottom: 1rem;
            }

            /*Letra pequeña bajo nuestro h1*/
            #principal small p{
                text-align: center;
                font-size: 1rem;
                position: relative;
                bottom: 1rem;
            }

            /*Aumentamos el tamaño de nuestros párrafos*/
            #principal p{
                font-size: 1.3rem;
            }

            /*Signo que indica que el campo es obligatorio*/
            p span{
                color:red;
            }

            /*Inputs del formulario*/
            #principal .dato{
                float: right;
                margin-right: 8rem;
                width: 12rem;
                height: 1.5rem;
                transition: background 1s ease;
            }

            /*Inputs type radio*/
            #principal #Sdato{
                float: right;
                margin-right: 9rem;
            }

            #pSexo{
                margin-bottom: 5rem;
            }

            #tSexo{
                position: relative;
                top: 2rem;
                color:black;
            }

            /*Imagen de cada uno de los sexos*/
            .imgSexo{
                width: 3rem;
                position: relative;
                top:1rem;
            }

            /*Botón de registro con transación*/
            #registro{
                background-color: #FFED91;
                font-size: 1.6rem;
                border-radius: 1rem;
                cursor: pointer;
                transition: 1s background ease;
            }

            #imgPata{
                width: 2rem;
            }

            /*Enlace para volver al login con una transación*/
            #login{
                text-decoration: none;
                color: black;
                font-size: 1.1rem;
                border-radius: 3rem;
                padding: 0.4rem;
                transition: 1s background ease;
            }

            /*Color cuando tenemos el ratón encima*/
            #registro:hover, #login:hover, #principal .dato:hover{
                background-color:#FFF578;
            }

            /*Vista móvil*/
            @media (max-width: 1000px){
                /*Ajustamos el tamaño de nuestra ventana de registro para que ocupe casi toda la pantalla*/
                #principal{
                    width: 90%;
                    margin-top: 5%;
                }

                /*Aumentamos el tamaño de nuestro h1*/
                #principal h1{
                    font-size: 6rem;
                }

                /*De nuestro nombre/logo*/
                #principal #facepet{
                    width: 40rem;
                }
                
                /*Aumentamos más tamaños*/

                #principal small p{
                    font-size: 1.5rem;
                }

                #principal p{
                    font-size: 3rem;
                }

                #principal .dato{
                    margin-right: 2rem;
                    width: 30rem;
                    height: 4rem;
                    border: 1px solid #CCCCCC;
                    font-size: 3rem;
                }

                #principal .imgSexo{
                    width: 6rem;
                }

                #principal #sexo{
                    width:2rem;
                    height:2rem;
                }

                #registro{
                    font-size: 4rem;
                }

                #imgPata{
                    width: 3.5rem;
                }

                #login{
                    font-size: 2rem;
                }

            }


        </style>

    </head>
    <body>
        <div id="principal">
            <h1>Registro en <a href="../index.php"><img src="../controlador/img/facepet.png" id="facepet" alt="logo"></a></h1>
            <small><p>Complete el siguiente formulario con su correo electrónico y los datos de su mascota.</p></small>
            <!--Comienzo del formulario-->
            <p>Nick <span>*</span> <input type="text" id="nick" class="dato" maxlength="10" required></p>
            <p>Password <span>*</span> <input type="password" id="password" class="dato" maxlength="20" required></p>
            <p>Email <span>*</span> <input type="email" id="email" class="dato" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" maxlength="50" required></p>
            <p>Animal <span>*</span> 
                <select id="animales" name="animal" class="dato" required>

                </select>
            </p>
            <p>Raza <span>*</span>
                <select id="razas" name="raza" class="dato" required></select>
            </p>
            <p id="pSexo"><span id="tSexo">Sexo <span>*</span></span>
                <span id="Sdato">
                    <img src="../controlador/img/masculino.png" class="imgSexo" alt="masculino">
                    <input type="radio" id="sexo" name="sexo" value="masculino" required checked>
                    <img src="../controlador/img/femenino.png" class="imgSexo" alt="femenino">
                    <input type="radio" id="sexo" name="sexo" value="femenino" required>
                </span>
            </p>
            <p>Provincia <span>*</span><select id="provincias" name="provincia" class="dato" required></select></p>
            <p>Municipio <span>*</span><select id="municipios" name="municipio" class="dato" required></select></p>
            <p><button id="registro">REGISTRAR <img src="../controlador/img/pata.png" id="imgPata" alt="pata"></button></p>
            <!--Fin del formulario-->
            <a id="login" href="../index.php">Ya estoy registrado</a>
        </div>
    </body>
</html>