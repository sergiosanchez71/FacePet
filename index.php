<html>
    <head>
        <title>FacePet</title>
        <script src="controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script>

            alert("Borrar este mensaje");

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
                        if(respuesta == 1){
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
    </head>
    <body>
        <h2>FacePet</h2>
        <p>Username</p>
        <p><input type="text" id="username"></p>
        <p>Password</p>
        <p><input type="password" id="password"></p>
        <p><input type="button" id="entrar" value="Entrar"> </p>
        
        <a href="vista/registro.php">¿Todavía no te has registrado?</a>
        
    </body>
</html>