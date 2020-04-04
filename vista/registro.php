
<html>
    <head>
        <title>FacePet</title>
        <style>

            #imgSexo{
                width: 3rem;
                position: relative;
                top:1rem;
            }
        </style>
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
                    $("#imgSexo").css("background", colorError);
                    campoVacio = true;
                } else {
                    $("#imgSexo").css("background", "white");
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
                            window.location.replace("../index.php");
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
        <?php
        include '../controlador/gestion.php';
        ?>
    </head>
    <body>
        <h1>Registro en FacePet</h1>
        <p>Nick <input type="text" id="nick" maxlength="20" required></p>
        <p>Password <input type="password" id="password" maxlength="20" required></p>
        <p>Email <input type="email" id="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" maxlength="50" required></p>
        <p>Animal 
            <select id="animales" name="animal" required>
                
            </select>
        </p>
        <p>Raza
            <select id="razas" name="raza" required></select>
        </p>
        <p>Sexo
            <img src="../controlador/img/masculino.png" id="imgSexo" alt="masculino">
            <input type="radio" id="sexo" name="sexo" value="masculino" required>
            <img src="../controlador/img/femenino.png" id="imgSexo" alt="femenino">
            <input type="radio" id="sexo" name="sexo" value="femenino" required>
        </p>
        <!--<p>Foto de perfil <input type="file" id="foto" required></p>-->
        <p>Localidad <input type="text" id="localidad" required></p>
        <p><button id="registro">Registrar</button></p>
    </body>
</html>