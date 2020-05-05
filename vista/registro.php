

<html>
    <head>
        <title>Registro en FacePet</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script>

            $(document).ready(function () {
                mostrarAnimales();
                $("#animales").change(mostrarRazas);
                $("#registro").click(crearUsuario);
            });

            function mostrarAnimales() {
                var parametros = {
                    "accion": "consultarAnimales"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        console.log(respuesta);
                        var resp = JSON.parse(respuesta);
                        var animales = document.getElementById("animales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option");
                            animales.appendChild(option);
                            option.setAttribute("value", resp.id[i]);
                            option.innerHTML += resp.animal[i];
                        }
                        mostrarRazas();

                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar animales");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarRazas() {
                var entrada = $("#animales").val();

                var parametros = {
                    "accion": "consultarRazas",
                    "animal": entrada
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);
                        document.getElementById("razas").innerHTML = " ";
                        var razas = document.getElementById("razas");
                        for (var i = 0; i < resp.raza.length; i++) {
                            var option = document.createElement("option");
                            razas.appendChild(option);
                            option.setAttribute("value", resp.id[i]);
                            option.innerHTML += resp.raza[i];
                        }

                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar razas");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function crearUsuario() {
                var nick = $("#nick").val();
                var password = $("#password").val();
                var email = $("#email").val();
                var animal = $("#animales").val();
                var raza = $("#razas").val();
                var sexo = $("#sexo").val();
                var foto = $("#foto").val();
                var localidad = $("#localidad").val();

                var colorError = "#E95139";
                var campoVacio = false;

                if (nick.trim() == "") {
                    $("#nick").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#nick").css("background", "white");
                }

                if (password.trim() == "") {
                    $("#password").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#password").css("background", "white");
                }

                if (!validarEmail(email)) {
                    $("#email").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#email").css("background", "white");
                }

                if (sexo.trim() == "") {
                    $(".imgSexo").css("background", colorError);
                    campoVacio = true;
                } else {
                    $(".imgSexo").css("background", "white");
                }

                /*if (foto.trim() == "") {
                 $("#foto").css("background", colorError);
                 campoVacio = true;
                 } else {
                 $("#foto").css("background", "white");
                 }*/

                if (localidad.trim() == "") {
                    $("#localidad").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#localidad").css("background", "white");
                }

                if (!campoVacio) {

                    var parametros = {
                        "accion": "crearUsuario",
                        "nick": nick,
                        "password": password,
                        "email": email,
                        "animal": animal,
                        "raza": raza,
                        "sexo": sexo,
                        // "foto": foto,
                        "localidad": localidad
                    };

                    $.ajax({
                        url: "../controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            alert(respuesta);
                            if (respuesta == "Usuario registrado correctamente") {
                                window.location.replace("../index.php");
                            }
                        },
                        error: function (xhr, status) {
                            alert("Error en la creación de usuario");
                        },
                        type: "POST",
                        dataType: "text"
                    });

                } else {
                    if (!validarEmail(email)) {
                        alert("El formato del email no es correcto");
                    }
                    alert("No puedes dejar campos vacíos");

                }

            }

            function validarEmail(valor) {
                if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(valor)) {
                    return true;
                } else {
                    return false;
                }
            }

        </script>
        <style>

            body{
                background-color: #EEEEEE;
            }

            #principal{
                margin: auto;
                width: 32.5rem;
                padding: 2rem;
                background-color: white;
                border-radius: 3rem;
            } 

            #principal #facepet{
                width: 15rem;
                position: relative;
                top: 0.5rem;
            }

            #principal h1{
                font-size: 2.5rem;
                text-align: center;
                font-family: "Comic Sans MS";
                position: relative;
                bottom: 1rem;
            }

            #principal small p{
                text-align: center;
                font-size: 1rem;
                position: relative;
                bottom: 1rem;
            }

            #principal p{
                font-size: 1.3rem;
            }

            p span{
                color:red;
            }

            #principal .dato{
                float: right;
                margin-right: 8rem;
                width: 12rem;
                height: 1.5rem;
                transition: background 1s ease;
            }

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

            .imgSexo{
                width: 3rem;
                position: relative;
                top:1rem;
            }

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

            #login{
                text-decoration: none;
                color: black;
                font-size: 1.1rem;
                border-radius: 3rem;
                padding: 0.4rem;
                transition: 1s background ease;
            }

            #registro:hover, #login:hover, #principal .dato:hover{
                background-color:#FFF578;
            }

            @media (max-width: 1000px){
                #principal{
                    width: 90%;
                    margin-top: 5%;
                }

                #principal h1{
                    font-size: 6rem;
                }

                #principal #facepet{
                    width: 40rem;
                }

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
            <h1>Registro en <a href="../index.php"><img src="../controlador/img/facepet.png" id="facepet"></a></h1>
            <small><p>Complete el siguiente formulario con su correo electrónico y los datos de su mascota.</p></small>
            <p>Nick <span>*</span> <input type="text" id="nick" class="dato" maxlength="20" required></p>
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
                    <input type="radio" id="sexo" name="sexo" value="masculino" required>
                    <img src="../controlador/img/femenino.png" class="imgSexo" alt="femenino">
                    <input type="radio" id="sexo" name="sexo" value="femenino" required>
                </span>
            </p>
            <p>Localidad <span>*</span><input type="text" id="localidad" class="dato" required></p>
            <p><button id="registro">REGISTRAR <img src="../controlador/img/pata.png" id="imgPata" alt="pata"></button></p>
            <a id="login" href="../index.php">Ya estoy registrado</a>
        </div>
    </body>
</html>