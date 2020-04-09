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

            function entrar() {
                var username = $("#username").val();
                var password = $("#password").val();

                var parametros = {
                    "accion": "entrar",
                    "username": username,
                    "password": password
                };

                $.ajax({
                    url: "controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        if (respuesta == 1) {
                            window.location.replace("vista/vistaOperador.php");
                        } else {
                            window.location.replace("vista/vistaUsuario.php");
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en el logueo");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

        </script>
        <style>

            body{
                background-color: #EEEEEE;
            }
            
            #principal{
                margin: auto;
                width: 20rem;
                padding: 2rem;
                background-color: white;
                border-radius: 3rem;
            } 
            
            #principal #facepet{
                width: 20rem;
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
            

        </style>
    </head>
    <body>
        <div id="principal">
            <p><a href="index.php"><img src="controlador/img/facepet.png" id="facepet"></a></p>
            <p>Username</p>
            <p><input type="text" id="username"></p>
            <p>Password</p>
            <p><input type="password" id="password"></p>
            <p><button id="entrar">Entrar <img src="controlador/img/pata.png" id="imgPata" alt="pata"></button> </p>

            <a id="registro" href="vista/registro.php">¿Todavía no te has registrado?</a>

        </div>

    </body>
</html>