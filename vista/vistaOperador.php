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
        <link rel="icon" href="../controlador/img/favicon.ico"><!--Icono-->
        <link href="../controlador/css/header.css" rel="stylesheet" type="text/css"/><!--Header CSS-->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <script src="../controlador/js/header.js" type="text/javascript"></script><!--Header JS -->
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLoginOp();
        ?>
        <style>
            /*Cuerpo centrado con cada una de las opciones*/
            #cuerpo{
                width: 60%;
                background: white;
                display: block;
                margin: auto;
            }

            /*Cada uno de los botones con su transación*/
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

            /*Color del botón cuando pasemos el cursor*/
            .boton:hover{
                background-color:#FFF578;
            }


            /*Botoón para volver a la pantalla principal*/
            .atrasPrin{
                cursor: pointer;
                float: right;
            }

            .atrasPrin img{
                width: 4rem;
            }

            /*Cada uno de las secciones de nuestro menú*/
            .submenu{
                display: block;
                margin: auto;
                width: 100%;
            }

            #cuerpo .submenu{
                margin-top: 3rem;
            }


            /*Aumentamos tamaños*/
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

            /*Buscador de usuarios*/
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

            /*Cada uno de los usuarios*/
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

            /*Datos de los usuarios*/
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

            /*Colocado a la izquierda*/
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

            /*Botones*/
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

            /*Vista móvil*/
            @media (max-width: 1000px){

                /*Aumentamos tamaños*/
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
                $(".atrasPrin").click(volver); //Botón de volver al clickar
                mostrarRazas(); //Mostramos las razas (almacenamos los datos en el select)
                $("#botonCAnimal").click(function () { //Al pulsar el botón de crear animal
                    $("#crearAnimal").show();
                    $("#botones").hide();
                    mostrarAnimales();
                    $("#botonCrearAnimal").click(crearAnimal); //Crear animal click
                });

                $("#botonBAnimal").click(function () {//Al pulsar el botón de borrar animal
                    $("#borrarAnimal").show();
                    $("#botones").hide();
                    mostrarAnimales();
                    $("#botonBorrarAnimal").click(borrarAnimal); //Borrar animal click
                });

                $("#botonCRaza").click(function () { //Al pulsar botón de crear raza
                    $("#crearRaza").show();
                    $("#botones").hide();
                    mostrarAnimales();
                    $("#botonCrearRaza").click(crearRaza); //Botón para crear raza
                    $("#listadoSelectAnimales").change(mostrarRazas); //Lista de animales cambia y muestra razas
                });

                $("#botonBRaza").click(function () { //Botón de borrar raza
                    $("#borrarRaza").show();
                    $("#botones").hide();
                    mostrarAnimales(); //Mostramos animales
                    mostrarRazasBorrar(); //Mostramos las razas disponibles para borrar
                    $("#botonBorrarRaza").click(borrarRaza); //Botón borrar raza
                    $("#listadoSelectBAnimales").change(mostrarRazasBorrar); //Listado de animales
                });

                $("#botonSUsuario").click(function () { //Clickar a sancionar usuario
                    $("#sancionarUsuarios").show();
                    $("#botones").hide();
                    mostrarUsuarios(); //Mostramos todos los usuarios
                    $("#sancionarUsuarioText").on('input', function () { //Cuando el texto del buscador cambia
                        mostrarUsuarios(); //Muestra usuarios
                    });
                });
            });

            /*Volvemos a la pantalla principal de operador*/
            function volver() {
                location.reload(); 
            }

            /*Mostramos los usuarios*/
            function mostrarUsuarios() {
                var nombre = $("#sancionarUsuarioText").val();//Cogemos el nombre de nuestro buscador

                var parametros = {
                    "accion": "buscarUsuariosSancion",
                    "cadena": nombre
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        $("#usuariosSancionar").empty(); //Vaciamos nuestra lista de usuarios
                        if (respuesta) { //Si hay respuesta
                            console.log(respuesta)
                            var usuarios = JSON.parse(respuesta);
                            for (var i = 0; i < usuarios.length; i++) {
                                var usuario = document.createElement("div");
                                usuario.setAttribute("class", "usuario"); //div usuario

                                if (usuarios.length == 1) {
                                    usuario.setAttribute("style", " border-radius:3rem");
                                }

                                var datos = document.createElement("div");
                                datos.setAttribute("class", "datos"); //div datos

                                var imagenPerfil = document.createElement("img"); //img usuario
                                imagenPerfil.setAttribute("src", "../controlador/uploads/usuarios/" + usuarios[i].foto);
                                imagenPerfil.setAttribute("class", "imagenUsuario");
                                imagenPerfil.setAttribute("alt", "imagenPerfil");
                                imagenPerfil.setAttribute("data-value", usuarios[i].id);

                                imagenPerfil.onclick = function () { //Redirecciona a su perfil
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value; 
                                }

                                var p = document.createElement("p");

                                var nombreUsuario = document.createElement("p"); //Nombre de usuario
                                nombreUsuario.setAttribute("class", "nombreUsuario");
                                nombreUsuario.innerHTML += usuarios[i].nick;
                                nombreUsuario.setAttribute("data-value", usuarios[i].id);

                                nombreUsuario.onclick = function () { //Redirecciona a su perfil
                                    window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
                                }

                                var sexo = document.createElement("img"); //Sexo de usuario
                                sexo.setAttribute("src", "../controlador/img/" + usuarios[i].sexo + ".png");
                                sexo.setAttribute("class", "sexo");
                                sexo.setAttribute("alt", "sexo");

                                var animal = document.createElement("p"); //Animal de usuario
                                animal.setAttribute("class", "animal");
                                animal.innerHTML += "<strong>Animal</strong> " + usuarios[i].animal;

                                var raza = document.createElement("p"); //Raza de usuario
                                raza.setAttribute("class", "raza");
                                raza.innerHTML += "<strong>Raza</strong> " + usuarios[i].raza;

                                var localidad = document.createElement("p"); //Localidad de usuario (provincia y municipio)
                                localidad.setAttribute("class", "localidad");
                                localidad.innerHTML += "<strong>Localidad</strong> " + usuarios[i].provincia + ", " + usuarios[i].municipio;
                                console.log(usuarios[i].fechaH);

                                var sancionar = document.createElement("button"); //Botón de sancionar
                                sancionar.setAttribute("class", "sancionarB");
                                sancionar.setAttribute("value", usuarios[i].id);
                                sancionar.setAttribute("data-pos", i); //Posición
                                sancionar.innerHTML = "Sancionar";

                                sancionar.onclick = function () { //Al hacer click a sancionar
                                    this.setAttribute("style", "display:none"); //Ocultamos los botones
                                    $(".eliminarB:eq(" + this.dataset.pos + ")").hide(); //Ocultamos el botón de eliminar dada la posición
                                    var sancionarF = document.createElement("input"); //Fecha sancionar
                                    sancionarF.setAttribute("type", "datetime-local");
                                    sancionarF.setAttribute("class", "sancionarF");
                                    sancionarF.setAttribute("class", "fechaS");
                                    getDate(this.dataset.pos); //Cogemos los datos dada la posición del input de fecha
                                    var sancionarBoton = document.createElement("button"); //Botón de sancionar
                                    sancionarBoton.setAttribute("class", "sancionarBot");
                                    sancionarBoton.setAttribute("data-pos", this.dataset.pos);
                                    sancionarBoton.setAttribute("value", this.value);
                                    sancionarBoton.innerHTML = "Sancionar";
                                    var atras = document.createElement("button"); //Volver atrás
                                    atras.setAttribute("data-pos", this.dataset.pos);
                                    atras.setAttribute("class", "atras");
                                    atras.innerHTML = "Atrás";

                                    //Cambiamos los botones viejos por los nuevos
                                    $(".usuario:eq(" + this.dataset.pos + ")").append(sancionarF); 
                                    $(".usuario:eq(" + this.dataset.pos + ")").append(sancionarBoton);
                                    $(".usuario:eq(" + this.dataset.pos + ")").append(atras);

                                    sancionarBoton.onclick = function () { //Si pulsamos el botón de sancionar 
                                        var usuario = this.value; //Id usuario
                                        var fecha = $(".fechaS:eq(" + this.dataset.pos + ")").val(); //Fecha usuario

                                        $(".eliminarSancion:eq(" + this.dataset.pos + ")").show(); //Botón para quitar sanción
                                        $(".eliminarB:eq(" + this.dataset.pos + ")").show(); //Eliminar usuario
                                        this.setAttribute("style", "display:none"); //Ocultamos nuestro botón de sancionar
                                        $(".usuario:eq(" + this.dataset.pos + ") .fechaS").hide(); //Ocultamos la fecha de sanción
                                        $(".usuario:eq(" + this.dataset.pos + ") .atras").hide(); //Ocultamos el botón de volver

                                        sancionarUsuario(this.dataset.pos, fecha, usuario); //Sancionamos el usuario
                                    }

                                    atras.onclick = function () { //Botón de atrás click
                                        //Ocultamos todo la sección de sancionar
                                        $(".usuario:eq(" + this.dataset.pos + ") .fechaS").hide(); 
                                        $(".usuario:eq(" + this.dataset.pos + ") .sancionarBot").hide();
                                        $(".usuario:eq(" + this.dataset.pos + ") .atras").hide();
                                        //Mostramos los botones por defecto
                                        $(".usuario:eq(" + this.dataset.pos + ") .sancionarB").show();
                                        $(".usuario:eq(" + this.dataset.pos + ") .eliminarB").show();
                                    }

                                    function sancionarUsuario(pos, fecha, usuario) { //Sancionar usuario dada la posición, la fecha y el usuario
                                        var fechaL = $(".fechaS:eq(" + pos + ")").val(); //Fecha introducida
                                        var fechaH = $("#fechaH").val(); //Fecha actual
                                        if (fechaH <= fechaL) { //Si la fecha de sanción es mayor a la actual sancionamos usuario

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


                                    //Accedemos a nuestra fecha y la introducimos en nuestro div
                                    function getDate(pos) {
                                        var parametros = {
                                            "accion": "getDateTime"
                                        };

                                        $.ajax({
                                            url: "../controlador/acciones.php",
                                            data: parametros,
                                            success: function (respuesta) {
                                                var fecha = JSON.parse(respuesta);
                                                var hora = parseInt(fecha.hour) + 1; //Incrementamos una hora a la actual para inserarla
                                                if (fecha.hour < 10) { //Añadimos 0 si solo tiene un dígito
                                                    hora = 0 + "" + hora;
                                                }
                                                //Escribimos la fecha en el input sabiendo la posición
                                                $(".usuario:eq(" + pos + ") .fechaS").val(fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                                                $(".usuario:eq(" + pos + ") .fechaS").attr("min", fecha.year + "-" + fecha.month + "-" + fecha.day + "T" + hora + ":" + fecha.minutes);
                                                $(".usuario:eq(" + pos + ") .fechaS").attr("max", "2099-12-31T23:59");

                                                var fechaH = document.createElement("input");
                                                //Escribimos la fecha actual
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
                                //Botón de eliminar sanción
                                var eliminarSancion = document.createElement("button");
                                eliminarSancion.setAttribute("class", "eliminarSancion");
                                eliminarSancion.setAttribute("data-pos", i);
                                eliminarSancion.setAttribute("value", usuarios[i].id);
                                eliminarSancion.innerHTML = "Quitar Sanción";

                                eliminarSancion.onclick = function () { //Al pulsarlo
                                    eliminarSancionF(this.value); //Eliminamos la sanción dado la id de usuario
                                    this.setAttribute("style", "display:none");
                                    $(".sancionarB:eq(" + this.dataset.pos + ")").show(); //Mostramos de nuevo el menú como un principio

                                }

                                //Eliminar sanción
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
                                            alert("Error en la sanción de usuario");
                                        },
                                        type: "post",
                                        dataType: "text"
                                    });
                                }


                                if (!usuarios[i].baneado || usuarios[i].baneado < usuarios[i].fechaH) { //Si el usuario no está baneado
                                    eliminarSancion.setAttribute("style", "display:none"); //Ocultamos el botón de eliminar sanción
                                } else {
                                    sancionar.setAttribute("style", "display:none"); //Ocultamos el botón de sancionar
                                }

                                //Botón de eliminar usuario
                                var eliminar = document.createElement("button");
                                eliminar.setAttribute("class", "eliminarB");
                                eliminar.setAttribute("data-post", i);
                                eliminar.setAttribute("value", usuarios[i].id);
                                eliminar.innerHTML = "Eliminar";

                                eliminar.onclick = function () { //Al pulsarlo
                                    if (confirm("¿Esta seguro de eliminar a este usuario?" + this.value)) {
                                        eliminarUsuario(this.value, this.dataset.pos); //Eliminados el usuario dado el id y pos
                                        mostrarUsuarios();
                                    }
                                }

                                //Eliminamos el usuario
                                function eliminarUsuario(usuario, pos) {
                                    var parametros = {
                                        "accion": "eliminarUsuario",
                                        "usuario": usuario
                                    };

                                    $.ajax({
                                        url: "../controlador/acciones.php",
                                        data: parametros,
                                        success: function (respuesta) {
                                        },
                                        error: function (xhr, status) {
                                            alert("Error en la eliminación del usuario");
                                        },
                                        type: "post",
                                        dataType: "text"
                                    });
                                }

                                //Añadimos los datos al div de usuariosSancionar
                                $("#usuariosSancionar").append(usuario);
                                usuario.append(datos);

                                //Introducimos los datos del usuario en el div de datos
                                datos.append(imagenPerfil);
                                datos.append(p);
                                p.append(nombreUsuario);
                                p.append(sexo);
                                datos.append(animal);
                                datos.append(raza);
                                datos.append(localidad);
                                datos.append(sancionar);
                                datos.append(eliminarSancion);
                                datos.append(eliminar);

                            }
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error al mostrar usuarios");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Mostramos los animales
            function mostrarAnimales() {
                var parametros = {
                    "accion": "consultarAnimales"
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);

                        //Vaciamos el listado de animales
                        $("#listadoUlAnimales").empty();
                        for (var i = 0; i < resp.animal.length; i++) {
                            var li = document.createElement("li");
                            $("#listadoUlAnimales").append(li); //Introducimos los li en el ul
                            li.innerHTML = resp.animal[i];
                        }
                        //Vaciamos el listado de borrar animales
                        $("#listadoBAnimales").empty();
                        for (var i = 0; i < resp.animal.length; i++) {
                            var td = document.createElement("td");
                            var tr = document.createElement("tr");
                            var input = document.createElement("input");
                            $("#listadoBAnimales").append(tr); //Introducimos cada fila
                            tr.appendChild(td);
                            input.setAttribute("type", "checkbox");
                            input.setAttribute("class", "checkAnimal");
                            input.setAttribute("value", resp.id[i]); //Check id animal
                            td.appendChild(input);
                            td.innerHTML += resp.animal[i];
                        }

                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option");
                            option.setAttribute("value", resp.id[i]); //Valor del id de animal
                            $("#listadoSelectAnimales").append(option);
                            option.innerHTML = resp.animal[i];
                        }

                        for (var i = 0; i < resp.animal.length; i++) {
                            var option = document.createElement("option");
                            option.setAttribute("value", resp.id[i]); //Valor del id animal
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

            //Creamos animal
            function crearAnimal() {

                var nombre = $("#nombreCAnimal").val(); //Cogemos el nombre del animal

                var parametros = {
                    "accion": "crearAnimal",
                    "nombre": nombre
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        alert(respuesta); //Mensaje animal creado correctamente
                        mostrarAnimales(); //Mostramos los animales
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de animal");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Borrar animal
            function borrarAnimal() {

                var animales = new Array(), i = 0; //Array animales e i como contador

                $("input:checkbox:checked").each(function () { //Si está activo
                    animales[i] = $(this).val(); //Añadimos el animal al array
                    i++; //Incrementamos
                });

                if (i != 0) {
                    var r = false;
                    if (i == 1) { //Si es uno
                        r = confirm("¿Estás seguro de eliminar este animal?");
                    } else { //Si son varios
                        r = confirm("¿Estás seguro de eliminar estos animales?");
                    }

                    if (r) { //si hay respuesta
                        var parametros = {
                            "accion": "borrarAnimales",
                            "animales": animales
                        };

                        $.ajax({
                            url: "../controlador/acciones.php",
                            data: parametros,
                            success: function (respuesta) {
                                alert(respuesta); //Mostramos mensaje
                                mostrarAnimales(); //Mostramos los animales
                            },
                            error: function (xhr, status) {
                                alert("Error en eliminar animal");
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
                var entrada = $("#listadoSelectAnimales").val(); //Valor de animal
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
                        $("#listadoUlRazas").empty(); //Vaciamos la lista de razas
                        for (var i = 0; i < resp.raza.length; i++) {
                            var li = document.createElement("li");
                            $("#listadoUlRazas").append(li); //Añadimos cada raza al ul
                            li.setAttribute("class", "listaRaza");
                            if (resp.raza[i] != "Otro") { //Si la raza NO es "Otro"
                                li.innerHTML += resp.raza[i]; //Añade sus razas
                            } else { //No las añade, color rojo y mensaje
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

            //Mostrar las razas y seleccionarlas para borrarlas
            function mostrarRazasBorrar() {
                var entrada = $("#listadoSelectBAnimales").val(); //Cogemos el valor del animal

                var parametros = {
                    "accion": "consultarRazas",
                    "animal": entrada
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        var resp = JSON.parse(respuesta);
                        $("#listadoBRazas").empty(); //Vaciamos el ul de razas
                        for (var i = 0; i < resp.raza.length; i++) {
                            var td = document.createElement("td");
                            var tr = document.createElement("tr");
                            $("#listadoBRazas").append(tr); //Introducimos las filas
                            tr.appendChild(td);
                            if (resp.id[i] != 0) { //Si existen razas
                                var input = document.createElement("input");
                                input.setAttribute("type", "checkbox");
                                input.setAttribute("class", "checkRaza");
                                input.setAttribute("value", resp.id[i]);
                                td.appendChild(input);
                                td.innerHTML += resp.raza[i]; //Las escribimos
                            } else { //Si no tiene, mostramos el siguiente mensaje
                                td.innerHTML = "Este animal no tiene razas creadas";
                            }
                        }
                    },
                    error: function (xhr, status) {
                        alert("Error en eliminar razas");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Crear razas                                                                                                                
            function crearRaza() {

                var nombre = $("#nombreCRaza").val(); //Valor de raza introducida
                var animal = $("#listadoSelectAnimales").val(); //Valor de animal

                var parametros = {
                    "accion": "crearRaza",
                    "nombre": nombre,
                    "animal": animal
                };

                $.ajax({
                    url: "../controlador/acciones.php",
                    data: parametros,
                    success: function (respuesta) {
                        alert(respuesta); //Mostramos el mensaje que nos devuelve
                        mostrarRazas(animal); //Mostramos las razas
                    },
                    error: function (xhr, status) {
                        alert("Error en la creación de raza");
                    },
                    type: "POST",
                    dataType: "text"
                });
            }

            //Borrar razas
            function borrarRaza() {
                var razas = new Array(), i = 0; //Array de razas y i como contador

                $("input:checkbox:checked").each(function () { //Si está marcado
                    razas[i] = $(this).val(); //Almacenamos el valor
                    i++; //Incrementamos
                });

                if (i != 0) { //Si es 0
                    var r = false; //No hay respuesta
                    if (i == 1) { //Si es una
                        r = confirm("¿Estás seguro de eliminar esta raza?");
                    } else { //Si son varias
                        r = confirm("¿Estás seguro de eliminar estas razas?");
                    }

                    if (r) { //Si hay respuesta
                        var parametros = {
                            "accion": "borrarRazas",
                            "razas": razas
                        };

                        $.ajax({
                            url: "../controlador/acciones.php",
                            data: parametros,
                            success: function (respuesta) {
                                console.log(respuesta);
                                mostrarRazasBorrar(); //Mostramos las razas
                            },
                            error: function (xhr, status) {
                                alert("Error en eliminar raza");
                            },
                            type: "POST",
                            dataType: "text"
                        });
                    }
                } else {
                    alert("No has seleccionado ningún animal");
                }
            }

            //Pulsar enter
            function pulsar(e, accion) {
                var tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 13) {
                    if (accion == "crearraza") { //Si la acción es crear raza
                        crearRaza();  //Creamos raza
                    } else if (accion == "crearanimal") { //Si la acción es crear animal
                        crearAnimal(); //Creamos animal
                    }
                }
            }

        </script>
    </head>
    <body>
        <div id="principal">
            <header>
                <!--Header-->
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

               <!--Header Móvil-->
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

            <!--Cuerpo-->
            <div id="cuerpo">

                <!--Botones del menú-->
                <div id="botones">
                    <button id="botonCAnimal" class="boton">Crear Animal</button>
                    <button id="botonBAnimal" class="boton">Borrar Animal</button>
                    <button id="botonCRaza" class="boton">Crear Raza</button>
                    <button id="botonBRaza" class="boton">Borrar Raza</button>
                    <button id="botonSUsuario" class="boton">Sancionar Usuario</button>
                </div>
                
                <!--Submenú Crear Animal-->
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

                <!-- Submenú Borrar Animal-->
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

                <!-- Submenú Crear Raza-->
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

                <!-- Submenú Borrar Raza-->
                <div id="borrarRaza" style="display:none;" class="submenu">
                    <a class="atrasPrin">
                        <img src="../controlador/img/atras.png" alt="atras">
                    </a>
                    <h1>Borrar razas</h1>
                    <div>
                        <span>Animal:</span> <select id="listadoSelectBAnimales"></select>
                        <table id="listadoBRazas" ></table>
                        <button id="botonBorrarRaza">Borrar Razas</button>
                    </div>
                </div>

                <!-- Submenú Sancionar Usuarios-->
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
            <div id="sMenu">
                <!--Menú móvil-->
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
            </div>

        </div>

    </body>
</html>
