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
        <?php
        session_start();
        if (isset($_SESSION['username']) && $_SESSION['operador'] == 1) {
            //echo $_SESSION['username'];
        } else {
            header("Location: ../index.php");
        }
        ?>
        <style>
            #listadoBAnimales tr{
                border: 1px solid red;
            }
        </style>
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script>
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
                $("#botonBorrarRaza").click(borrarRaza);
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

                        document.getElementById("listadoUlAnimales").innerHTML = " ";
                        var animalesUl = document.getElementById("listadoUlAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var li = document.createElement("li");
                            animalesUl.appendChild(li);
                            li.innerHTML += resp.animal[i];
                        }

                        document.getElementById("listadoBAnimales").innerHTML = " ";
                        var animalesTable = document.getElementById("listadoBAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var td = document.createElement("td");
                            var tr = document.createElement("tr");
                            var input = document.createElement("input");
                            animalesTable.appendChild(tr);
                            tr.appendChild(td);
                            td.innerHTML += resp.animal[i];
                            input.setAttribute("type", "checkbox");
                            input.setAttribute("class", "checkAnimal");
                            input.setAttribute("value", resp.id[i]);
                            td.appendChild(input);
                        }

                        //document.getElementById("listadoSelectAnimales").innerHTML = " ";
                        var animalesSelect = document.getElementById("listadoSelectAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option");
                            option.setAttribute("value", resp.id[i]);
                            animalesSelect.appendChild(option);
                            option.innerHTML += resp.animal[i];
                        }

                        var animalesSelect = document.getElementById("listadoSelectBAnimales");
                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option");
                            option.setAttribute("value", resp.id[i]);
                            animalesSelect.appendChild(option);
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
                var animalB = $("#listadoSelectBAnimales").val();
                $("#animalRD").val(entrada);

                var parametros = {
                    "accion": "consultarRazas",
                    "animal": entrada,
                    "animalB": animalB
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        mostrarRazas();
                        var resp = JSON.parse(respuesta);
                        document.getElementById("listadoUlRazas").innerHTML = " ";
                        var razasUl = document.getElementById("listadoUlRazas");
                        for (var i = 0; i < resp.raza.length; i++) {

                            var li = document.createElement("li");
                            razasUl.appendChild(li);
                            li.setAttribute("class", "listaRaza");
                            if (resp.raza[i] != "Otro") {
                                li.innerHTML += resp.raza[i];
                            } else {
                                li.innerHTML += "Este animal no tiene razas disponibles";
                                $(".listaRaza").css("color", "red");
                            }
                        }

                        document.getElementById("listadoBRazas").innerHTML = " ";
                        var razasTable = document.getElementById("listadoBRazas");
                        for (var i = 0; i < resp.raza.length; i++) {
                            var td = document.createElement("td");
                            var tr = document.createElement("tr");
                            var input = document.createElement("input");
                            razasTable.appendChild(tr);
                            tr.appendChild(td);
                            td.innerHTML += resp.raza[i];
                            input.setAttribute("type", "checkbox");
                            input.setAttribute("class", "checkRaza");
                            input.setAttribute("value", resp.id[i]);
                            td.appendChild(input);
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

            }

        </script>
    </head>
    <body>
        <?php
// put your code here
        ?>
        <div id="botones">
            <button id="botonCAnimal">Crear Animal</button>
            <button id="botonBAnimal">Borrar Animal</button>
            <button id="botonCRaza">Crear Raza</button>
            <button id="botonBRaza">Borrar Raza</button>
        </div>

        <div id="crearAnimal" style="display: none;">
            <h1>Crear un nuevo animal</h1>
            Nombre: <input type="text" id="nombreCAnimal">
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
            Nombre: <input type="text" id="nombreCRaza">
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

    </body>
</html>
