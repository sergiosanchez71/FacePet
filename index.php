<html>
    <head>
        <title>FacePet</title>
        <link rel="icon" href="controlador/img/favicon.ico">
        <script src="controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script>

            $(document).ready(function () {
                inicio();
            });

            function inicio() {
                $("#entrar").click(entrar);
            }

            function pulsar(e) {
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 13)
                    entrar();
            }

            function entrar() {
                var username = $("#username").val();
                var password = $("#password").val();
                var colorError = "#E95139";
                var campoVacio = false;
                var mensaje;

                if (username.trim() != "" || password.trim() != "") {

                    if (username.trim() == "") {
                        $("#username").css("background", colorError);
                        campoVacio = true;
                        mensaje = "No ha introducido el nombre de usuario";
                    } else {
                        $("#username").css("background", "white");
                    }

                    if (password.trim() == "") {
                        $("#password").css("background", colorError);
                        campoVacio = true;
                        mensaje = "No ha introducido la contraseña";
                    } else {
                        $("#password").css("background", "white");
                    }

                } else {
                    $("#username").css("background", colorError);
                    $("#password").css("background", colorError);
                    campoVacio = true;
                    mensaje = "No ha introducido el nombre de usuario ni la contraseña";
                }

                if (!campoVacio) {

                    var parametros = {
                        "accion": "entrar",
                        "username": username.toLowerCase(),
                        "password": password
                    };

                    $.ajax({
                        url: "controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) {
                            if (respuesta) {
                                if (respuesta == 1) {
                                    window.location.replace("vista/vistaOperador.php");
                                } else if(respuesta==0) {
                                    window.location.replace("vista/vistaUsuario.php");
                                } else {
                                    alert(respuesta);
                                }
                            } 
                        },
                        error: function (xhr, status) {
                            alert("Error en el logueo");
                        },
                        type: "POST",
                        dataType: "text"
                    });
                } else {
                    alert(mensaje);
                }
            }

        </script>
        <?php
        session_start();
        session_destroy();
        ?>
        <style>

            body{
                background-color: #EEEEEE;
            }

            #principal{
                margin: auto;
                width: 50rem;
                padding: 2rem;
                background-color: white;
                border-radius: 3rem;
            } 

            #principal #facepet{
                width: 30rem;
                display: block;
                margin: auto;
            }

            #principal p{
                font-size: 1.2rem;
            }

            #principal input{
                width: 100%;
                height: 2rem;
                font-size: 1.2rem;
            }

            #principal #entrar{
                width: 100%;
                background-color: #FFED91;
                height: 3rem;
                font-size: 2rem;
                transition: 1s background ease;
                border-radius: 2rem;
                cursor: pointer;
            }

            #imgPata{
                width: 2rem;
            }

            #username,#password{
                transition: 1s background ease;
            }

            #registro{
                text-decoration: none;
                color: black;
                font-size: 1.1rem;
                border-radius: 3rem;
                padding: 0.4rem;
                transition: 1s background ease;
            }

            #principal #entrar:hover, #registro:hover, #username:hover, #password:hover{
                background-color:#FFF578;
            }

            @media(max-width:1000px){
                #principal{
                    width: 82%;
                    margin-top: 20%;
                }

                #principal #facepet{
                    width: 50rem;
                }

                #principal p{
                    font-size: 4rem;
                }

                #principal #username, #principal #password{
                    height: 5rem;
                    font-size: 3rem;
                    border: 1px solid #DDDDDD;
                }

                #principal #entrar{
                    width: 100%;
                    background-color: #FFED91;
                    height: 7rem;
                    font-size: 5rem;
                    transition: 1s background ease;
                    border-radius: 2rem;
                    cursor: pointer;
                }

                #imgPata{
                    width: 4rem;
                }

                #registro{
                    font-size: 2.5rem;
                }

            }


        </style>
    </head>
    <body>
        <div id="principal">
            <p><a href="index.php"><img src="controlador/img/facepet.png" id="facepet"></a></p>
            <p>Username</p>
            <p><input type="text" id="username" maxlength="20" onkeypress="pulsar(event)"></p>
            <p>Password</p>
            <p><input type="password" id="password" onkeypress="pulsar(event)"></p>
            <p><button id="entrar">Entrar <img src="controlador/img/pata.png" id="imgPata" alt="pata"></button> </p>

            <a id="registro" href="vista/registro.php">¿Todavía no te has registrado?</a>

        </div>

    </body>
</html>