<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vista de Operador</title>
        <link rel="icon" href="../controlador/img/favicon.ico">
        <link href="../controlador/css/header.css" rel="stylesheet" type="text/css"/>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
        <script src="../controlador/js/header.js" type="text/javascript"></script>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLoginOp();
        ?>
        <style>

            #cuerpo{
                width: 100%;
                background: white;
            }

            #listadoBAnimales tr{
                border: 1px solid red;
            }



        </style>

        <script>

            $(document).ready(function () {
                $(".volver").click(volver);
                $("#botonCAnimal").click(verCAnimal);
                $("#botonBAnimal").click(verBAnimal);
                $("#botonCRaza").click(verCRaza);
                $("#botonBRaza").click(verBRaza);
            });

            function volver() {
                location.reload();
            }

            function verCAnimal() {
                $("#crearAnimal").show();
                $("#botones").hide();
                mostrarAnimales();
                $("#botonCrearAnimal").click(crearAnimal);
            }

            function verBAnimal() {
                $("#borrarAnimal").show();
                $("#botones").hide();
                mostrarAnimales();
                $("#botonBorrarAnimal").click(borrarAnimal);
            }

            function verCRaza() {
                $("#crearRaza").show();
                $("#botones").hide();
                mostrarAnimales();
                mostrarRazas();
                $("#botonCrearRaza").click(crearRaza);
                $("#listadoSelectAnimales").change(mostrarRazas);
            }

            function verBRaza() {
                $("#borrarRaza").show();
                $("#botones").hide();
                mostrarAnimales();
                mostrarRazasBorrar();
                $("#botonBorrarRaza").click(borrarRaza);
                $("#listadoSelectBAnimales").change(mostrarRazasBorrar);
            }

            function mostrarAnimales() {
                var parametros = {
                    "accion": "consultarAnimales"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);

                        $("#listadoUlAnimales").empty();
                        //var animalesUl = document.getElementById("listadoUlAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var li = document.createElement("li");
                            $("#listadoUlAnimales").append(li);
                            li.innerHTML = resp.animal[i];
                        }

                        $("#listadoBAnimales").empty();
                        //var animalesTable = document.getElementById("listadoBAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var td = document.createElement("td");
                            var tr = document.createElement("tr");
                            var input = document.createElement("input");
                            $("#listadoBAnimales").append(tr);
                            tr.appendChild(td);
                            td.innerHTML += resp.animal[i];
                            input.setAttribute("type", "checkbox");
                            input.setAttribute("class", "checkAnimal");
                            input.setAttribute("value", resp.id[i]);
                            td.appendChild(input);
                        }

                        //document.getElementById("listadoSelectAnimales").innerHTML = " ";
                        //var animalesSelect = document.getElementById("listadoSelectAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option");
                            option.setAttribute("value", resp.id[i]);
                            $("#listadoSelectAnimales").append(option);
                            option.innerHTML = resp.animal[i];
                        }

                        //var animalesSelect = document.getElementById("listadoSelectBAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option");
                            option.setAttribute("value", resp.id[i]);
                            $("#listadoSelectBAnimales").append(option);
                            option.innerHTML += resp.animal[i];
                        }

                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar animales");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function crearAnimal() {

                var nombre = $("#nombreCAnimal").val();

                var parametros = {
                    "accion": "crearAnimal",
                    "nombre": nombre
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        alert(respuesta);
                        mostrarAnimales();
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de animal");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function borrarAnimal() {

                var animales = new Array(), i = 0;

                $("input:checkbox:checked").each(function () {
                    animales[i] = $(this).val();
                    i++;
                });

                if (i != 0) {
                    var r = false;
                    if (i == 1) {
                        r = confirm("¿Estás seguro de eliminar este animal?");
                    } else {
                        r = confirm("¿Estás seguro de eliminar estos animales?");
                    }

                    if (r) {
                        var parametros = {
                            "accion": "borrarAnimales",
                            "animales": animales
                        };

                        $.ajax({
                            url: "../controlador/acciones.php",
                            data: parametros,
                            success: function (respuesta) {
                                alert(respuesta);
                                mostrarAnimales();
                            },
                            error: function (xhr, status) {
                                alert("Error en la creación de animal");
                            },
                            type: "POST",
                            dataType: "text"
                        });
                    }
                } else {
                    alert("No has seleccionado ningún animal");
                }



            }

            function mostrarRazas() {
                var entrada = $("#listadoSelectAnimales").val();
                //$("#animalRD").val(entrada);

                var parametros = {
                    "accion": "consultarRazas",
                    "animal": entrada
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);
                        $("#listadoUlRazas").empty();
                        //var razasUl = document.getElementById("listadoUlRazas");
                        for (var i = 0; i < resp.raza.length; i++) {

                            var li = document.createElement("li");
                            $("#listadoUlRazas").append(li);
                            li.setAttribute("class", "listaRaza");
                            if (resp.raza[i] != "Otro") {
                                li.innerHTML += resp.raza[i];
                            } else {
                                li.innerHTML += "Este animal no tiene razas disponibles";
                                $(".listaRaza").css("color", "red");
                            }
                        }


                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar razas");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function mostrarRazasBorrar() {
                var entrada = $("#listadoSelectBAnimales").val();
                console.log($("#listadoSelectBAnimales").val());
                //$("#animalRD").val(entrada);

                var parametros = {
                    "accion": "consultarRazas",
                    "animal": entrada
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);
                        console.log(respuesta);

                        $("#listadoBRazas").empty();
                        // var razasTable = document.getElementById("listadoBRazas");
                        for (var i = 0; i < resp.raza.length; i++) {
                            var td = document.createElement("td");
                            var tr = document.createElement("tr");
                            $("#listadoBRazas").append(tr);
                            tr.appendChild(td);
                            if (resp.id[i] != 0) {
                                td.innerHTML = resp.raza[i];
                                var input = document.createElement("input");
                                input.setAttribute("type", "checkbox");
                                input.setAttribute("class", "checkRaza");
                                input.setAttribute("value", resp.id[i]);
                                console.log(resp.id[i]);
                                td.appendChild(input);
                            } else {
                                td.innerHTML = "Este animal no tiene razas creadas";
                            }

                        }


                    },
                    error: function (xhr, status) {
                        alert("Error en mostrar razas");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function crearRaza() {

                var nombre = $("#nombreCRaza").val();
                var animal = $("#listadoSelectAnimales").val();

                var parametros = {
                    "accion": "crearRaza",
                    "nombre": nombre,
                    "animal": animal
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        alert(respuesta);
                        mostrarRazas(animal);
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de animal");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            function borrarRaza() {
                var razas = new Array(), i = 0;

                $("input:checkbox:checked").each(function () {
                    razas[i] = $(this).val();
                    i++;
                });

                if (i != 0) {
                    var r = false;
                    if (i == 1) {
                        r = confirm("¿Estás seguro de eliminar esta raza?");
                    } else {
                        r = confirm("¿Estás seguro de eliminar estas razas?");
                    }

                    if (r) {
                        var parametros = {
                            "accion": "borrarRazas",
                            "razas": razas
                        };

                        $.ajax({
                            url: "../controlador/acciones.php",
                            data: parametros,
                            success: function (respuesta) {
                                console.log(respuesta);
                                // alert(respuesta);
                                mostrarRazasBorrar();
                            },
                            error: function (xhr, status) {
                                alert("Error en la creación de animal");
                            },
                            type: "POST",
                            dataType: "text"
                        });
                    }
                } else {
                    alert("No has seleccionado ningún animal");
                }
            }

            function pulsar(e, accion) {
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 13) {
                    if (accion == "crearraza") {
                        crearRaza();
                    } else if (accion == "crearanimal"){
                        crearAnimal();
                    }
                }
            }

        </script>
    </head>
    <body>
        <?php
// put your code here
        ?>
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

                <div id="botones">
                    <button id="botonCAnimal">Crear Animal</button>
                    <button id="botonBAnimal">Borrar Animal</button>
                    <button id="botonCRaza">Crear Raza</button>
                    <button id="botonBRaza">Borrar Raza</button>
                </div>

                <div id="crearAnimal" style="display: none;">
                    <h1>Crear un nuevo animal</h1>
                    Nombre: <input type="text" id="nombreCAnimal" onkeypress="pulsar(event, 'crearanimal')">
                    <button id="botonCrearAnimal">Crear animal</button>
                    <button class="volver" >Volver</button>
                    <div>
                        <h2>Animales ya disponibles</h2>
                        <ul id="listadoUlAnimales"></ul>
                    </div>
                </div>

                <div id="borrarAnimal" style="display:none;">
                    <h1>Borrar animales</h1>
                    <div>
                        <table id="listadoBAnimales"></table>
                        <button id="botonBorrarAnimal">Borrar Animales</button>
                        <button class="volver" >Volver</button>
                    </div>
                </div>

                <div id="crearRaza" style="display: none;">
                    <h1>Crear una nueva raza</h1>
                    Nombre: <input type="text" id="nombreCRaza" onkeypress="pulsar(event, 'crearraza')">
                    Animal: <select id="listadoSelectAnimales"></select>
                    <button id="botonCrearRaza">Crear raza</button>
                    <button class="volver" >Volver</button>
                    <div>
                        <h2>Razas ya disponibles</h2>
                        <ul id="listadoUlRazas"></ul>
                    </div>
                </div>

                <div id="borrarRaza" style="display:none;">
                    <h1>Borrar razas</h1>
                    <div>
                        Animal: <select id="listadoSelectBAnimales"></select>
                        <table id="listadoBRazas"></table>
                        <button id="botonBorrarRaza">Borrar Razas</button>
                        <button class="volver" >Volver</button>
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
