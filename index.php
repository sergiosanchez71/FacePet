<html>
    <head>
        <title>FacePet</title>
        <link rel="icon" href="controlador/img/favicon.ico"><!--Favicon-->
        <script src="controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <?php
        session_start();
        session_destroy(); //En el momento que estemos en esta página la sessión se destruirá
        ?>
        <script>

            $(document).ready(function () {
                inicio();
            });


            function inicio() {
                $("#entrar").click(entrar); //Cuando pulsemos entrar intentará acceder
            }

            function pulsar(e) { //Al pulsar el botón de enter intentará acceder
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 13)
                    entrar();
            }

            function entrar() { //Acceso a la página
                var username = $("#username").val();
                var password = $("#password").val();
                var colorError = "#E95139"; //Color del background cuando haya un error
                var campoVacio = false; //Si este es falso no podremos acceder a la página
                var mensaje; //Mensaje mostrado en la consola

                if (username.trim() != "" || password.trim() != "") { //Si no están vacíos

                    if (username.trim() == "") { //Si está el campo usuario vacío
                        $("#username").css("background", colorError);
                        campoVacio = true;
                        mensaje = "No ha introducido el nombre de usuario";
                    } else {
                        $("#username").css("background", "white");
                    }

                    if (password.trim() == "") { //Si está el campo contraseña vacío
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

                if (!campoVacio) { //Si el campo vacío es true

                    var parametros = {
                        "accion": "entrar",
                        "username": username.toLowerCase(), //Guardamos el nombre sin diferenciar entre mayúsculas y minúsculas
                        "password": password //Su contraseña
                    };

                    $.ajax({
                        url: "controlador/acciones.php",
                        data: parametros,
                        success: function (respuesta) { //Devuelve el valor de operador
                            if (respuesta) {
                                if (respuesta == 1) { //Si el valor de operador es 1 entramos en la vista de operador
                                    window.location.replace("vista/vistaOperador.php");
                                } else if (respuesta == 0) { //Si el valor de operador es 0 entramos en la vista de usuario
                                    window.location.replace("vista/vistaUsuario.php");
                                } else { //En el caso que la respuesta sea distinta deberá ser porque ha surjido algún error
                                    alert(respuesta);
                                }
                            }
                        },
                        error: function (xhr, status) {
                            alert("Error en el logueo"); //El mensaje que se muestra en el caso de que haya un error en la consulta
                        },
                        type: "POST",
                        dataType: "text"
                    });
                } else {
                    alert(mensaje); //Mostramos el mensaje de error si algún campo no es válido
                }
            }

        </script>

        <style>

            body{ 
                background-color: #EEEEEE; /*Fondo gris del body*/
            }

            /*Ventana principal, está centrado fondo blanco y borde redondo*/
            #principal{
                margin: auto;
                width: 50rem;
                padding: 2rem;
                background-color: white;
                border-radius: 3rem;
            } 

            /*Ventana principal y nombre con logo está centrado*/
            #principal #facepet{
                width: 30rem;
                display: block;
                margin: auto;
            }

            #principal p{
                font-size: 1.2rem;
            }

            /*Campos en los que insertaremos nuestro usuario y contraseña, ocupan toda la ventana y aumento de tamaño de letra*/
            #principal input{
                width: 100%;
                height: 2rem;
                font-size: 1.2rem;
            }

            /*Botón de entrar*/
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

            /*Transición de los inputs*/
            #username,#password{
                transition: 1s background ease;
            }

            /*Enlace de registro con su transación de fondo*/
            #registro{
                text-decoration: none;
                color: black;
                font-size: 1.1rem;
                border-radius: 3rem;
                padding: 0.4rem;
                transition: 1s background ease;
            }

            /*Color de fondo de cada campo*/
            #principal #entrar:hover, #registro:hover, #username:hover, #password:hover{
                background-color:#FFF578;
            }

            /*Vista de teléfono*/
            @media(max-width:1000px){
                /*Reducimos el tamaño de la ventana principal*/
                #principal{
                    width: 82%;
                    margin-top: 20%;
                }
                
                #principal #facepet{
                    width: 50rem;
                }
                
                /*Aumentamos el tamaño del texto*/
                #principal p{
                    font-size: 4rem;
                }

                /*Aumentamos el tamaño de los inputs*/
                #principal #username, #principal #password{
                    height: 5rem;
                    font-size: 3rem;
                    border: 1px solid #DDDDDD;
                }

                /*Botón de entrar con mayor tamaño*/
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