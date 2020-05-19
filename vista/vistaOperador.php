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
                width: 60%;
                background: white;
                display: block;
                margin: auto;
            }

            .boton{
                font-size: 1.5rem;
                font-weight: bold;
                width: 100%;
                background-color: #FFED91;
                height: 5rem;
                font-size: 2rem;
                transition: 1s background ease;
                border-radius: 2rem;
                cursor: pointer;
                margin-top: 2rem;
            }

            .boton:hover{
                background-color:#FFF578;
            }

            #cuerpo .submenu{
                margin-top: 3rem;
            }

            .atrasPrin{
                cursor: pointer;
                float: right;
            }

            .atrasPrin img{
                width: 4rem;
            }

            .submenu{
                display: block;
                margin: auto;
                width: 100%;
            }

            .submenu td{
                font-size: 1.5rem;
            }

            .submenu .checkAnimal, .submenu .checkRaza{
                width: 1rem;
                height: 1rem;
            }

            .submenu .listaRaza{
                font-size: 1.5rem;
            }

            .submenu input{
                font-size: 1.5rem;
            }

            .submenu h1 {
                font-size: 2.5rem;
            }

            .submenu h2{
                font-size: 2rem;
            }

            .submenu ul li{
                font-size: 1.5rem;
            }

            .submenu span{
                font-size: 1.5rem;
            }

            .submenu select{
                font-size: 1.5rem;
            }

            #listadoBAnimales tr{
                border: 1px solid red;
            }

            #usuarioSancionarText{
                font-size: 1.5rem;
            }

            #sancionarUsuarioText{
                font-size: 1.3rem;
                width: 80%;
                transition: 1s background ease;
            }

            #sancionarUsuarioText:hover{
                background: #FFF578;
            }

            .usuario:first-child{
                margin-top: 3rem;
            }

            .usuario{
                background: #fcf0c9;
                width: 100%;
                float: left;
                padding-bottom: 1rem;
                border-right:1px solid black;
                border-left:1px solid black;
                border-bottom:1px solid #BBBBBB;
                transition: 1s background ease;
            }

            .usuario:hover{
                background: #fff7dd;
            }

            .usuario:first-child{
                border-radius: 3rem 3rem 0 0;
                border-top:1px solid black;
            }

            .usuario:last-child{
                margin-bottom: 5rem;
                border-radius: 0 0 3rem 3rem;
                border-right:1px solid black;
                border-bottom:1px solid black;
            }

            .datos{
                padding-left: 2rem;
            }

            .nombreUsuario{
                font-weight: bold;
                font-size: 1.5rem;
                cursor: pointer;
                float: left;
                transition: 1s color ease;
            }

            .nombreUsuario:first-letter{
                text-transform: uppercase;
            }

            .nombreUsuario:hover{
                color: #f43333;
            }

            .sexo{
                width: 2.5rem;
                margin-left: 1rem;
                margin-top: 1rem;
                padding-bottom: 0.25rem;
            }

            .imagenUsuario{
                width: 10rem;
                height: 10rem;
                border-radius: 4rem;
                margin: 1rem;
                float: left;
                margin-right: 4rem;
                cursor: pointer;
                transition: 1s opacity ease;
            }

            .imagenUsuario:hover{
                opacity: 0.7;
            }

            .solicitud, .pendiente{
                font-size: 1.2rem;
                border-radius: 1rem;
                cursor: pointer;
                transition: 1s background ease;
            }

            .sancionarB,.sancionarBot, .eliminarB,.eliminarSancion,.atras, .submenu button{
                font-size: 1.4rem;
                width: 10rem;
                padding: 5px;
                cursor: pointer;
                transition: 1s background ease;
            }

            .sancionarB:hover, .sancionarBot:hover, .eliminarSancion:hover, .atras:hover{
                background: #FFF578;
            }

            .sancionarB,.sancionarBot,.atras,.submenu button{
                background-color: #fffcce;
            }

            .eliminarSancion{
                background-color: #fffcce;
            }

            .fechaS{
                font-size: 1.5rem;
            }

            .eliminarB{
                background-color: #f7a5a5;
            }

            .eliminarB:hover{
                background: #ff8989;
            }

            @media (max-width: 1000px){

                h1{
                    font-size: 4rem;
                }

                #buscador{
                    height: 4rem;
                    font-size: 3rem;
                }

                #lupa{
                    width: 4rem;
                }

                #buscadorUsuarios{
                    padding: 5%;
                }

                #buscarUsuarios{
                    width: 100%;
                    padding: 0;
                }

                .usuario:last-child{
                    margin-bottom: 10rem;
                }

                .imagenUsuario{
                    width: 14rem;
                    height: 14rem;
                    margin-top: 2rem;
                }

                .nombreUsuario{
                    font-size: 2.5rem;
                }

                .sexo{
                    padding-bottom: 1rem;
                    width: 4rem;
                    margin-top: 1.5rem;
                    margin-left: 2rem;
                }

                .animal, .raza, .localidad{
                    font-size: 1.5rem;
                }

                .solicitud, .pendiente{
                    font-size: 2.5rem;
                    font-weight: bold;
                }

                .imgPata{
                    width: 2.5rem;
                }

            }

        </style>

        <script>

            $(document).ready(function () {
                $(".atrasPrin").click(volver);
                $("#botonCAnimal").click(function () {
                    $("#crearAnimal").show();
                    $("#botones").hide();
                    mostrarAnimales();
                    $("#botonCrearAnimal").click(crearAnimal);
                });

                $("#botonBAnimal").click(function () {
                    $("#borrarAnimal").show();
                    $("#botones").hide();
                    mostrarAnimales();
                    $("#botonBorrarAnimal").click(borrarAnimal);
                });

                $("#botonCRaza").click(function () {
                    $("#crearRaza").show();
                    $("#botones").hide();
                    mostrarAnimales();
                    $("#botonCrearRaza").click(crearRaza);
                    $("#listadoSelectAnimales").change(mostrarRazas);
                });

                $("#botonBRaza").click(function () {
                    $("#borrarRaza").show();
                    $("#botones").hide();
                    mostrarAnimales();
                    mostrarRazas();
                    mostrarRazasBorrar();
                    $("#botonBorrarRaza").click(borrarRaza);
                    $("#listadoSelectBAnimales").change(mostrarRazasBorrar);
                });

                $("#botonSUsuario").click(function () {
                    $("#sancionarUsuarios").show();
                    $("#botones").hide();
                    mostrarUsuarios();
                    $("#sancionarUsuarioText").on('input', function () {
                        mostrarUsuarios();
                    });
                });
            });

            function volver() {
                location.reload();
            }

            function mostrarUsuarios() {
                var nombre = $("#sancionarUsuarioText").val();

                var parametros = {
                    "accion": "buscarUsuarios",
                    "cadena": nombre
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#usuariosSancionar").empty();
                        if (respuesta) {
                            var usuarios = JSON.parse(respuesta);
                            console.log(respuesta);
                            for (var i = 0; i < usuarios.length; i++) {
                                var usuario = document.createElement("div");
                                usuario.setAttribute("class", "usuario");

                                if (usuarios.length == 1) {
                                    usuario.setAttribute("style", " border-radius:3rem");
                                }

                                var datos = document.createElement("div");
                                datos.setAttribute("class", "datos");

                                var imagenPerfil = document.createElement("img");
                                imagenPerfil.setAttribute("src", "../controlador/uploads/usuarios/" + usuarios[i].foto);
                                imagenPerfil.setAttribute("class", "imagenUsuario");
                                imagenPerfil.setAttribute("alt", "imagenPerfil");
                                imagenPerfil.setAttribute("data-value", usuarios[i].id);

                                imagenPerfil.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var p = document.createElement("p");

                                var nombreUsuario = document.createElement("p");
                                nombreUsuario.setAttribute("class", "nombreUsuario");
                                nombreUsuario.innerHTML += usuarios[i].nick;
                                nombreUsuario.setAttribute("data-value", usuarios[i].id);

                                nombreUsuario.onclick = function () {
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var sexo = document.createElement("img");
                                sexo.setAttribute("src", "../controlador/img/" + usuarios[i].sexo + ".png");
                                sexo.setAttribute("class", "sexo");
                                sexo.setAttribute("alt", "sexo");

                                var animal = document.createElement("p");
                                animal.setAttribute("class", "animal");
                                animal.innerHTML += "<strong>Animal</strong> " + usuarios[i].animal;

                                var raza = document.createElement("p");
                                raza.setAttribute("class", "raza");
                                raza.innerHTML += "<strong>Raza</strong> " + usuarios[i].raza;

                                var localidad = document.createElement("p");
                                localidad.setAttribute("class", "localidad");
                                localidad.innerHTML += "<strong>Localidad</strong> " + usuarios[i].localidad;
                                console.log(usuarios[i].fechaH);

                                var sancionar = document.createElement("button");
                                sancionar.setAttribute("class", "sancionarB");
                                sancionar.setAttribute("value", usuarios[i].id);
                                sancionar.setAttribute("data-pos", i);
                                sancionar.innerHTML = "Sancionar";

                                sancionar.onclick = function () {
                                    this.setAttribute("style", "display:none");
                                    $(".eliminarB:eq(" + this.dataset.pos + ")").hide();
                                    var sancionarF = document.createElement("input");
                                    sancionarF.setAttribute("type", "datetime-local");
                                    sancionarF.setAttribute("class", "sancionarF");
                                    sancionarF.setAttribute("class", "fechaS");
                                    getDate(this.dataset.pos);
                                    var sancionarBoton = document.createElement("button");
                                    sancionarBoton.setAttribute("class", "sancionarBot");
                                    sancionarBoton.setAttribute("data-pos", this.dataset.pos);
                                    sancionarBoton.setAttribute("value", this.value);
                                    sancionarBoton.innerHTML = "Sancionar";
                                    var atras = document.createElement("button");
                                    atras.setAttribute("data-pos", this.dataset.pos);
                                    atras.setAttribute("class", "atras");
                                    atras.innerHTML = "Atrás";

                                    $(".usuario:eq(" + this.dataset.pos + ")").append(sancionarF);
                                    $(".usuario:eq(" + this.dataset.pos + ")").append(sancionarBoton);
                                    $(".usuario:eq(" + this.dataset.pos + ")").append(atras);

                                    sancionarBoton.onclick = function () {
                                        var usuario = this.value;
                                        var fecha = $(".fechaS:eq(" + this.dataset.pos + ")").val();

                                        $(".eliminarSancion:eq(" + this.dataset.pos + ")").show();
                                        $(".eliminarB:eq(" + this.dataset.pos + ")").show();
                                        this.setAttribute("style", "display:none");
                                        /*if (getDate(this.dataset.pos, true)) {
                                         alert(fecha);
                                         }*/
                                        $(".usuario:eq(" + this.dataset.pos + ") .fechaS").hide();
                                        $(".usuario:eq(" + this.dataset.pos + ") .atras").hide();

                                        sancionarUsuario(this.dataset.pos, fecha, usuario);
                                    }

                                    atras.onclick = function () {
                                        $(".usuario:eq(" + this.dataset.pos + ") .fechaS").hide();
                                        $(".usuario:eq(" + this.dataset.pos + ") .sancionarBot").hide();
                                        $(".usuario:eq(" + this.dataset.pos + ") .atras").hide();
                                        //$(".usuario:eq(" + this.dataset.pos + ") .sancionarB").show();
                                        $(".usuario:eq(" + this.dataset.pos + ") .sancionarB").show();
                                        $(".usuario:eq(" + this.dataset.pos + ") .eliminarB").show();
                                    }

                                    function sancionarUsuario(pos, fecha, usuario) {
                                        var fechaL = $(".fechaS:eq(" + pos + ")").val();
                                        var fechaH = $("#fechaH").val();
                                        if (fechaH <= fechaL) {

                                            var parametros = {
                                                "accion": "sancionarUsuario",
                                                "tiempo": fecha,
                                                "usuario": usuario
                                            };

                                            $.ajax({
                                                url: "../controlador/acciones.php",
                                                data: parametros,
                                                success: function (respuesta) {


                                                },
                                                error: function (xhr, status) {
                                                    alert("Error en la creación de Evento");
                                                },
                                                type: "post",
                                                dataType: "text"
                                            });
                                        } else {
                                            alert("La fecha de sanción no puede ser menor de una hora");
                                        }
                                    }


                                    function getDate(pos) {
                                        var parametros = {
                                            "accion": "getDateTime"
                                        };

                                        $.ajax({
                                            url: "../controlador/acciones.php",
                                            data: parametros,
                                            success: function (respuesta) {
                                                var fecha = JSON.parse(respuesta);


                                                var hora = parseInt(fecha.hour) + 1;
                                                if (fecha.hour < 10) {
                                                    hora = 0 + "" + hora;
                                                }

                                                console.log($(".fechaS:eq(" + pos + ")").val());

                                                $(".usuario:eq(" + pos + ") .fechaS").val(fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                                                $(".usuario:eq(" + pos + ") .fechaS").attr("min", fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                                                $(".usuario:eq(" + pos + ") .fechaS").attr("max", "2099-12-31T23:59");

                                                var fechaH = document.createElement("input");
                                                fechaH.setAttribute("type", "datetime-local");
                                                fechaH.setAttribute("value", fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                                                fechaH.setAttribute("id", "fechaH");
                                                fechaH.setAttribute("style", "display:none");
                                                $("#usuariosSancionar").append(fechaH);

                                            },
                                            error: function (xhr, status) {
                                                alert("Error en la creación de Evento");
                                            },
                                            type: "post",
                                            dataType: "text"
                                        });
                                    }
                                }

                                var eliminarSancion = document.createElement("button");
                                eliminarSancion.setAttribute("class", "eliminarSancion");
                                eliminarSancion.setAttribute("data-pos", i);
                                eliminarSancion.setAttribute("value", usuarios[i].id);
                                eliminarSancion.innerHTML = "Quitar Sanción";

                                eliminarSancion.onclick = function () {
                                    eliminarSancionF(this.value);
                                    this.setAttribute("style", "display:none");
                                    $(".sancionarB:eq(" + this.dataset.pos + ")").show();

                                }

                                function eliminarSancionF(usuario) {
                                    var parametros = {
                                        "accion": "eliminarSancion",
                                        "usuario": usuario
                                    };

                                    $.ajax({
                                        url: "../controlador/acciones.php",
                                        data: parametros,
                                        success: function (respuesta) {


                                        },
                                        error: function (xhr, status) {
                                            alert("Error en la creación de Evento");
                                        },
                                        type: "post",
                                        dataType: "text"
                                    });
                                }


                                if (!usuarios[i].baneado || usuarios[i].baneado < usuarios[i].fechaH) {
                                    eliminarSancion.setAttribute("style", "display:none");
                                } else {
                                    sancionar.setAttribute("style", "display:none");
                                }


                                var eliminar = document.createElement("button");
                                eliminar.setAttribute("class", "eliminarB");
                                eliminar.setAttribute("data-post", i);
                                eliminar.setAttribute("value", usuarios[i].id);
                                eliminar.innerHTML = "Eliminar";

                                eliminar.onclick = function () {
                                    if (confirm("¿Esta seguro de eliminar a este usuario?" + this.value)) {
                                        console.log(this.value);
                                        eliminarUsuario(this.value, this.dataset.pos);
                                    }
                                }

                                function eliminarUsuario(usuario, pos) {
                                    var parametros = {
                                        "accion": "eliminarUsuario",
                                        "usuario": usuario
                                    };

                                    $.ajax({
                                        url: "../controlador/acciones.php",
                                        data: parametros,
                                        success: function (respuesta) {
                                            console.log(respuesta);
                                        },
                                        error: function (xhr, status) {
                                            alert("Error en la creación de Evento");
                                        },
                                        type: "post",
                                        dataType: "text"
                                    });
                                }

                                $("#usuariosSancionar").append(usuario);
                                usuario.append(datos);

                                datos.append(imagenPerfil);
                                datos.append(p);
                                p.append(nombreUsuario);
                                p.append(sexo);
                                datos.append(animal);
                                datos.append(raza);
                                datos.append(localidad);
                                //if (!usuarios[i].baneado || usuarios[i].baneado < usuarios[i].fechaH) {
                                datos.append(sancionar);
                                //} else {
                                datos.append(eliminarSancion);
                                //}
                                datos.append(eliminar);

                            }
                        }
                        //}
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de animal");
                    },
                    type: "POST",
                    dataType: "text"
                });
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
                            input.setAttribute("type", "checkbox");
                            input.setAttribute("class", "checkAnimal");
                            input.setAttribute("value", resp.id[i]);
                            td.appendChild(input);
                            td.innerHTML += resp.animal[i];
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
                                var input = document.createElement("input");
                                input.setAttribute("type", "checkbox");
                                input.setAttribute("class", "checkRaza");
                                input.setAttribute("value", resp.id[i]);
                                console.log(resp.id[i]);
                                td.appendChild(input);
                                td.innerHTML += resp.raza[i];
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
                    } else if (accion == "crearanimal") {
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
                    <li><a href="buscarAmigos.php">Buscar Usuarios</a></li>
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
                            <a href="buscarAmigoss.php"><li>Buscar Amigos</li></a>
                        </ul>
                    </nav>
                </div>
            </header>

            <div id="cuerpo">

                <div id="botones">
                    <button id="botonCAnimal" class="boton">Crear Animal</button>
                    <button id="botonBAnimal" class="boton">Borrar Animal</button>
                    <button id="botonCRaza" class="boton">Crear Raza</button>
                    <button id="botonBRaza" class="boton">Borrar Raza</button>
                    <button id="botonSUsuario" class="boton">Sancionar Usuario</button>
                </div>

                <div id="crearAnimal" style="display: none;" class="submenu">
                    <a class="atrasPrin">
                        <img src="../controlador/img/atras.png" alt="atras">
                    </a>
                    <h1>Crear un nuevo animal</h1>
                    <span>Nombre:</span> <input type="text" id="nombreCAnimal" onkeypress="pulsar(event, 'crearanimal')">
                    <button id="botonCrearAnimal">Crear animal</button>
                    <div>
                        <h2>Animales ya disponibles</h2>
                        <ul id="listadoUlAnimales"></ul>
                    </div>
                </div>

                <div id="borrarAnimal" style="display:none;" class="submenu">
                    <a class="atrasPrin">
                        <img src="../controlador/img/atras.png" alt="atras">
                    </a>
                    <h1>Borrar animales</h1>
                    <div>
                        <table id="listadoBAnimales"></table>
                        <button id="botonBorrarAnimal">Borrar Animales</button>
                    </div>
                </div>

                <div id="crearRaza" style="display: none;" class="submenu">
                    <a class="atrasPrin">
                        <img src="../controlador/img/atras.png" alt="atras">
                    </a>
                    <h1>Crear una nueva raza</h1>
                    <span>Nombre:</span> <input type="text" id="nombreCRaza" onkeypress="pulsar(event, 'crearraza')">
                    <span>Animal:</span> <select id="listadoSelectAnimales"></select>
                    <button id="botonCrearRaza">Crear raza</button>
                    <div>
                        <h2>Razas ya disponibles</h2>
                        <ul id="listadoUlRazas"></ul>
                    </div>
                </div>

                <div id="borrarRaza" style="display:none;" class="submenu">
                    <a class="atrasPrin">
                        <img src="../controlador/img/atras.png" alt="atras">
                    </a>
                    <h1>Borrar razas</h1>
                    <div>
                        <span>Animal:</span> <select id="listadoSelectBAnimales"></select>
                        <table id="listadoBRazas"></table>
                        <button id="botonBorrarRaza">Borrar Razas</button>
                    </div>
                </div>

                <div id="sancionarUsuarios" style="display:none;">
                    <a href="vistaOperador.php" class="atrasPrin">
                        <img src="../controlador/img/atras.png" alt="atras">
                    </a>
                    <h1>Sancionar Usuarios</h1>
                    <div>
                        <span id="usuarioSancionarText">Usuario:</span> <input type="text" id="sancionarUsuarioText">
                        <div id="usuariosSancionar"></div>
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
