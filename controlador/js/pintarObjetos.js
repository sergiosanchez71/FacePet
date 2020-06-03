function pintarPosts(posts, div) { //Pintamos los posts dados un array de posts y el div donde se pintarán
    for (var i = 0; i < posts.length; i++) {
        var cadPosts = $("#cadPosts").val(); //Vemos el valor de nuestra cadena de posts

        var arrayPosts = cadPosts.split(","); //Lo separamos por ,

        var existe = false; 

        for (var j = 0; j < arrayPosts.length; j++) {
            if (arrayPosts[j] == posts[i].id) { //Si el post que vamos a pintar ya existe no se pinta
                existe = true;
            }
        }

        if (!existe) { //Si no existe se pinta

            if ($("#cadPosts").val() === "") { //Si está en blanco se almacena el id del primer post
                $("#cadPosts").val(posts[i].id);
            } else { //Si ya hay posts escritos se almacenan concatenados con una coma
                $("#cadPosts").val(cadPosts + "," + posts[i].id);
            }

            var post = document.createElement("div"); //Cremos un div en el que se almacenará un post
            post.setAttribute("class", "post");

            var postUsuario = document.createElement("p"); //Nombre del autor del post
            postUsuario.setAttribute("class", "postUsuario");
            postUsuario.setAttribute("title","Ver perfil");
            postUsuario.setAttribute("data-value", posts[i].usuario);

            postUsuario.onclick = function () { //Si le hacemos click nos lleva a su perfil
                window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
            }

            if (posts[i].loginOperador == 1 || posts[i].login == posts[i].usuario) { //Si es administrador o el dueño del post

                var a = document.createElement("button"); //Creamos el botón de eliminar post
                a.setAttribute("value", posts[i].id);
                a.setAttribute("title","Eliminar post");
                a.setAttribute("class", "botonEliminar");

                a.onclick = function () { //Al hacer click eliminamos el post
                    if (confirm("Esta seguro de eliminar este post")) {
                        eliminarPost(this.value); //Eliminar
                    }
                }

                var postEliminar = document.createElement("img"); //Img de eliminar post
                postEliminar.setAttribute("class", "postEliminar");
                postEliminar.setAttribute("src", "../controlador/img/eliminar.png");

            }

            var imgUsuario = document.createElement("img"); //Imagen de usuario
            imgUsuario.setAttribute("class", "imagenUsuario");
            imgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + posts[i].foto);
            var nombreUsuario = document.createElement("p"); //Nombre de usuario
            nombreUsuario.setAttribute("class", "nombreUsuario");
            nombreUsuario.innerHTML += posts[i].nick;

            var postFecha = document.createElement("p"); //echa del post
            postFecha.setAttribute("class", "postFecha");
            postFecha.innerHTML += posts[i].fecha_publicacion;

            var postCont = document.createElement("div"); //Contenido del post
            postCont.setAttribute("class", "postCont");

            var postTitulo = document.createElement("p"); //Título del post
            postTitulo.setAttribute("class", "postTitulo");
            postTitulo.innerHTML += posts[i].titulo;

            if (posts[i].multimedia != null) { //Si tiene imagen

                var postImg = document.createElement("img");  //La insertamos en el post
                postImg.setAttribute("class", "postImg");
                postImg.setAttribute("src", "../controlador/uploads/posts/" + posts[i].multimedia);

            }

            var postContenido = document.createElement("p"); //Escribimos el contenido
            postContenido.setAttribute("class", "postContenido");
            postContenido.innerHTML += posts[i].contenido;

            var postBottom = document.createElement("div"); //Parte de abajo donde se encuentran botón de likes y comentarios
            postBottom.setAttribute("class", "postBottom")

            var postLikes = document.createElement("p"); //Likes del posts
            postLikes.setAttribute("class", "postLikes");

            if (posts[i].likes != null) { //Si hay likes

                var cadlikes = posts[i].likes;
                var likes = cadlikes.split(",");
                var slikes = document.createElement("span");
                slikes.setAttribute("class", "likes");
                slikes.innerHTML = likes.length; //Los contamos y los escribimos

            }

            var iconos = document.createElement("p"); //P con iconos
            iconos.setAttribute("class", "iconos");
            var postCorazon = document.createElement("a"); 
            postCorazon.setAttribute("class", "postCorazon");

            var postCorazonImg = document.createElement("img"); //Imagen del corazón para los likes
            postCorazonImg.setAttribute("class", "postCorazonImg");
            postCorazonImg.setAttribute("alt", "Corazon");
            postCorazonImg.setAttribute("data-value", posts[i].id);
            postCorazonImg.setAttribute("data-pos", i);

            if (!posts[i].like) { //Si no tiene like
                postCorazonImg.setAttribute("src", "../controlador/img/nolike.png"); //img no like
                postCorazonImg.setAttribute("title","Dar me gusta");

                postCorazonImg.onclick = function () { //Al pulsarlo
                    this.removeAttribute("src");
                    this.setAttribute("src", "../controlador/img/Like.png"); //Img like
                    darLike(this.dataset.value); //Damos like
                }
            } else {
                postCorazonImg.setAttribute("src", "../controlador/img/Like.png"); //img like
            }


            var postComentario = document.createElement("a"); 
            postComentario.setAttribute("class", "postComentario");

            var postComentarioImg = document.createElement("img"); //Post comentario img
            postComentarioImg.setAttribute("class", "postComentarioImg");
            postComentarioImg.setAttribute("src", "../controlador/img/comentario.png");
            postComentarioImg.setAttribute("title","Ver comentarios");
            postComentarioImg.setAttribute("alt", "Comentario");
            postComentarioImg.setAttribute("data-value", posts[i].id);

            postComentarioImg.onclick = function () { //Al pulsarlo nos lleva a la vista de post
                window.location.href = "verPost.php?post=" + this.dataset.value;
            }

            var comentarios = document.createElement("span"); //texto de comentarios
            comentarios.setAttribute("class", "comentariosPost");
            comentarios.setAttribute("data-value", posts[i].id);
            comentarios.setAttribute("title","Ver comentarios");
            if (posts[i].comentarios > 0) { //Depende de cuantos haya muestra un mensaje u otro
                if (posts[i].comentarios == 1) {
                    comentarios.innerHTML = "Ver " + posts[i].comentarios + " comentario";
                } else {
                    comentarios.innerHTML = "Ver " + posts[i].comentarios + " comentarios";
                }
            } else {
                comentarios.innerHTML = "Hacer un comentario...";
            }

            comentarios.onclick = function () { //Al hacer click nos lleva a la vista de post
                window.location.href = "verPost.php?post=" + this.dataset.value;
            }


            $("#" + div).append(post); 
            if (posts[i].loginOperador == 1 || posts[i].login == posts[i].usuario) { //Si somos operador y somos el dueño
                post.append(a);
                a.append(postEliminar); //Vemos el botón de eliminar
            }
            post.append(postUsuario);



            postUsuario.append(imgUsuario);
            postUsuario.append(nombreUsuario);

            post.append(postFecha);
            post.append(postCont); //Contenido del post

            postCont.append(postTitulo);
            if (posts[i].multimedia != null) { //Si hay imagen
                postCont.append(postImg); //La insertamos
            }
            postCont.append(postContenido);

            postCont.append(postBottom);

            postBottom.append(postLikes);

            if (posts[i].likes != null) { //Si es distinto a null
                if (likes.length > 1) { //Mensaje personalizado según el número
                    postLikes.append(slikes);
                    postLikes.append(" Me gustas");
                } else {
                    postLikes.append(slikes);
                    postLikes.append(" Me gusta");
                }
            } else {
                postLikes.append("0 Me gustas");
            }

            postBottom.append(iconos);
            iconos.append(postCorazon);
            iconos.append(postComentario);
            postCorazon.append(postCorazonImg);
            postComentario.append(postComentarioImg);
            postCont.append(comentarios);
        }

    }
}

//Dar like dado un post
function darLike(post) { 
    var parametros = {
        "accion": "darLike",
        "post": post
    };

    $.ajax({
        url: "../controlador/acciones.php",
        data: parametros,
        error: function (xhr, status) {
            alert("Error en la eliminacion de post");
        },
        type: "POST",
        dataType: "text"
    });
}

//Pintar eventos dado el array de eventos y el div donde pintarlos
function pintarEventos(eventos, div) {
    for (var i = 0; i < eventos.length; i++) {

        var cadEventos = $("#cadEventos").val(); //Valor de la cadena de eventos

        var arrayEventos = cadEventos.split(","); //Lo separamos por comas

        var existe = false; 

        for (var j = 0; j < arrayEventos.length; j++) {
            if (arrayEventos[j] == eventos[i].id) { //Si coinciden
                existe = true; //Ya sabemos que existen
            }
        }

        if (!existe) { //Si no existen se pintan

        //Se almacenan en la cadena de eventos
            if ($("#cadEventos").val() === "") {
                $("#cadEventos").val(eventos[i].id);
            } else {
                $("#cadEventos").val(cadEventos + "," + eventos[i].id);
            }

            var evento = document.createElement("div"); //Div de evento
            evento.setAttribute("class", "evento");

            if (eventos[i].loginOperador == 1 || eventos[i].login == eventos[i].usuario) { //Si somos operadores o el dueño del evento

                var a = document.createElement("button"); //creamos el botón de borrar
                a.setAttribute("value", eventos[i].id);
                a.setAttribute("title","Eliminar evento");
                a.setAttribute("class", "botonEliminar");

                a.onclick = function () { //Si le pulsamos se elimina el evento
                    if (confirm("Esta seguro de eliminar este evento")) {
                        eliminarEvento(this.value);
                    }
                }

                var eventoEliminar = document.createElement("img"); //Img cruz de eliminar evento
                eventoEliminar.setAttribute("class", "postEliminar");
                eventoEliminar.setAttribute("src", "../controlador/img/eliminar.png");

                a.append(eventoEliminar);

            }

            var titulo = document.createElement("p"); //Título del evento
            titulo.setAttribute("class", "eventoTitulo");
            titulo.setAttribute("title","Ver Evento");
            titulo.innerHTML = eventos[i].titulo; 
            titulo.setAttribute("data-value", eventos[i].id);

            titulo.onclick = function () { //Al hacer click nos lleva al evento
                window.location.href = "verEvento.php?evento=" + this.dataset.value;
            }


            var textTipo = document.createElement("p"); //Tipo de evento
            textTipo.setAttribute("class", "textTipo");

            var tipo = document.createElement("span");
            tipo.setAttribute("class", "eventoTipo");
            tipo.innerHTML = eventos[i].tipo;

            var textFechai = document.createElement("p");
            textFechai.setAttribute("class", "textFechai");

            var textFechaf = document.createElement("p");
            textFechaf.setAttribute("class", "textFechaf");

            var fechai = document.createElement("span"); //Fecha inicio
            fechai.setAttribute("class", "eventoFecha");
            fechai.innerHTML = eventos[i].fechai;
            if (eventos[i].empezado) { //Si está empezado que salga con color verde
                fechai.setAttribute("style", "color:#126310");
                fechai.setAttribute("title", "Evento actualmente activo");
            }

            var fechaf = document.createElement("span"); //Fecha Fin
            fechaf.setAttribute("class", "eventoFecha");
            fechaf.innerHTML = eventos[i].fechaf;

            var direccioncompleta = document.createElement("p"); //Dirección
            direccioncompleta.setAttribute("class", "direccioncompleta");

            var direccion = document.createElement("span");
            direccion.setAttribute("class", "direccion");
            direccion.innerHTML = eventos[i].direccion;

            var cp = document.createElement("span");
            cp.setAttribute("class", "cp");
            cp.innerHTML = eventos[i].cp;

            var ciudad = document.createElement("span");
            ciudad.setAttribute("class", "ciudad");
            ciudad.innerHTML = eventos[i].ciudad;

            var provincia = document.createElement("span");
            provincia.setAttribute("class", "provincia");
            provincia.innerHTML = eventos[i].provincia;

            if (eventos[i].foto) { //Si tiene foto

                var img = document.createElement("img"); //la pinta
                img.setAttribute("class", "eventoImg");
                console.log(eventos[i].foto);
                img.setAttribute("src", "../controlador/uploads/eventos/" + eventos[i].foto);
                img.setAttribute("alt", "imgagenEvento");

            } else if (eventos[i].lat && eventos[i].lng) { //Si no tiene foto y tiene lat y lng pinta el mapa

                var map = document.createElement("div");

            }
            var textAutor = document.createElement("p"); //Autor
            textAutor.setAttribute("class", "eventoAutor");

            var autor = document.createElement("span"); //Nombre de autor
            autor.setAttribute("class", "eventoNombreAutor");
            autor.setAttribute("title","Ver Perfil");
            autor.innerHTML = eventos[i].autor;
            autor.setAttribute("data-value", eventos[i].usuario);

            autor.onclick = function () { //Al hacer click en el nombre del autor podemos ver su perfil
                window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
            }

            if (eventos[i].participable) { //Si es participable
                var textParticipantes = document.createElement("p"); //Vemos participantes
                textParticipantes.setAttribute("class", "participantes");
                var participantes = document.createElement("span");
                var part;
                if (eventos[i].participable == "t") { //Si es participable pero no tiene aún participantes
                    part = "0"; //participantes = 0
                } else {//Si ya hay gente participando
                    part = eventos[i].participantes.length; //Se van incrementando
                }
                participantes.innerHTML = part; 
            }

            $("#" + div).append(evento);
            if (eventos[i].loginOperador == 1 || eventos[i].login == eventos[i].usuario) { //Si es operador o dueño del evento les sale el botón de eliminar evento
                evento.append(a);
            }
            evento.append(titulo);
            evento.append(textTipo);
            textTipo.append("Tipo de evento: ");
            textTipo.append(tipo);
            evento.append(textFechai);
            textFechai.append("Fecha inicio: ");
            textFechai.append(fechai);
            evento.append(textFechaf);
            textFechaf.append("Fecha fin: ");
            textFechaf.append(fechaf);
            //Si la dirección tiene los campos completos la escribe
            if (eventos[i].direccion.trim() != "") {
                direccioncompleta.append(direccion);
                direccioncompleta.append(", ");
            }
            if (eventos[i].cp.trim() != "") {
                direccioncompleta.append(cp);
                direccioncompleta.append(", ");
            }
            if (eventos[i].ciudad.trim() != "") {
                direccioncompleta.append(ciudad);
                direccioncompleta.append(", ");
            }
            direccioncompleta.append(provincia);
            evento.append(direccioncompleta);
            if (eventos[i].foto) { //Si el evento tiene foto
                evento.append(img);  //Insertamos foto
            } else if (eventos[i].lat && eventos[i].lng) { //O si el evento tiene mapa
                map.setAttribute("class", "map");
                initMap(map, eventos[i].lat, eventos[i].lng); //Pintamos mapa
                evento.append(map);
            }
            evento.append(textAutor);
            textAutor.append("Autor del evento: ");
            textAutor.append(autor);
            if (eventos[i].participable) { //Si el evento es participable
                evento.append(textParticipantes);
                textParticipantes.append("Participantes ");
                textParticipantes.append(participantes);
            }
        }


    }
}

function pintarUnEvento(eventos) { //Pintamos un evento
    var evento = document.createElement("div");
    evento.setAttribute("class", "evento");

    var titulo = document.createElement("p"); //Título del post
    titulo.setAttribute("class", "eventoTitulo");
    titulo.setAttribute("title","Ver Evento");
    titulo.innerHTML = eventos.titulo;
    titulo.setAttribute("data-value", eventos.id);

    titulo.onclick = function () { //Al clickar en el titulo te lleva a ver el evento
        window.location.href = "verEvento.php?evento=" + this.dataset.value;
    }

    var textTipo = document.createElement("p"); //Tipo de evento
    textTipo.setAttribute("class", "textTipo");

    var tipo = document.createElement("span");
    tipo.setAttribute("class", "eventoTipo");
    tipo.innerHTML = eventos.tipo;

    var textFechai = document.createElement("p");
    textFechai.setAttribute("class", "textFechai");

    var textFechaf = document.createElement("p");
    textFechaf.setAttribute("class", "textFechaf");

    var fechai = document.createElement("span"); //Fecha Inicio
    fechai.setAttribute("class", "eventoFecha");
    fechai.innerHTML = eventos.fechai;
    if (eventos.empezado) {//Si está empezado que salga con color verde
        fechai.setAttribute("style", "color:#126310");
        fechai.setAttribute("title", "Evento actualmente activo");
    }
 
    var fechaf = document.createElement("span"); //Fecha final
    fechaf.setAttribute("class", "eventoFecha");
    fechaf.innerHTML = eventos.fechaf;

    var direccioncompleta = document.createElement("p"); //Dirección completa
    direccioncompleta.setAttribute("class", "direccioncompleta");

    var direccion = document.createElement("span");
    direccion.setAttribute("class", "direccion");
    direccion.innerHTML = eventos.direccion;

    var cp = document.createElement("span");
    cp.setAttribute("class", "cp");
    cp.innerHTML = eventos.cp;

    var ciudad = document.createElement("span");
    ciudad.setAttribute("class", "ciudad");
    ciudad.innerHTML = eventos.ciudad;

    var provincia = document.createElement("span");
    provincia.setAttribute("class", "provincia");
    provincia.innerHTML = eventos.provincia;

    var cont = document.createElement("div"); //Contenido
    cont.setAttribute("class", "cont");


    var contenido = document.createElement("p");
    contenido.setAttribute("class", "eventoContenido");
    contenido.innerHTML = eventos.contenido;

    if (eventos.foto) { //Si tiene foto el evento se pinta
        var img = document.createElement("img");
        img.setAttribute("class", "eventoImg");
        img.setAttribute("src", "../controlador/uploads/eventos/" + eventos.foto);
        img.setAttribute("alt", "imgagenEvento");
    }


    if (eventos.lat && eventos.lng) { //Si tiene mapa se pinta
        var map = document.createElement("div");
        map.setAttribute("id", "map");
        initMap(map, eventos.lat, eventos.lng);
    }

    var visual = document.createElement("div"); //Div en el que se muestran img y map
    if (eventos.foto && eventos.lat && eventos.lng) {
        visual.setAttribute("class", "visual"); //Clase de ambos
    } else if (eventos.foto) {
        visual.setAttribute("class", "visualImg"); //img
    } else if (eventos.lat) {
        visual.setAttribute("class", "visualMap");//map
        map.setAttribute("style", "height:20rem");
    }

    var textAutor = document.createElement("p"); //Autor del evento
    textAutor.setAttribute("class", "eventoAutor");


    var autor = document.createElement("span"); //Nombre del autor
    autor.setAttribute("class", "eventoNombreAutor");
    autor.innerHTML = eventos.autor;
    autor.setAttribute("data-value", eventos.usuario);

    if (eventos.participable) { //Si es participable
        var textParticipantes = document.createElement("p");
        var participantes = document.createElement("span");
        var part;
        if (eventos.participable == "t") { //Si no tiene aún participantes, los participantes se reducen a 0
            part = "0";
        } else { //Si hay ya participantes, se cuenta cuantos hay
            part = eventos.participantes.length;
        }
        participantes.innerHTML = part;


        var botonParticipar = document.createElement("button"); //Botón para participar del evento
        botonParticipar.setAttribute("id", "botonParticipar");
        botonParticipar.setAttribute("title","Dejar de participar en el evento");
        botonParticipar.setAttribute("value", eventos.id);
        botonParticipar.innerHTML = "Participar en este Evento";

        var botonYaParticipa = document.createElement("button"); //Botón para dejar de participar en el evento
        botonYaParticipa.setAttribute("id", "botonYaParticipa");
        botonYaParticipa.setAttribute("title","Dejar de participar en el evento");
        botonYaParticipa.setAttribute("value", eventos.id);
        botonYaParticipa.innerHTML = "Ya participas en este evento";

        if (!eventos.participa) { //Si no participa
            botonParticipar.onclick = function () {
                participarEvento(this.value); //Aparece el botón de participar
                window.location.reload();
            }
        } else {
            botonYaParticipa.onclick = function () {
                salirDeEvento(this.value); //Aparaece el botón de dejar de participar
                window.location.reload();
            }
        }
    }

    autor.onclick = function () { //Si pulsamos en el autor nos lleva a su perfil
        window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
    }

    $("#menuEvento").append(evento);
    evento.append(cont);
    cont.append(titulo);
    cont.append(textTipo);
    textTipo.append("Tipo de evento: ");
    textTipo.append(tipo);
    cont.append(textFechai);
    textFechai.append("Fecha inicio: ");
    textFechai.append(fechai);
    cont.append(textFechaf);
    textFechaf.append("Fecha fin: ");
    textFechaf.append(fechaf);
    //Si están vacíos no se pintan
    if (eventos.direccion.trim() != "") {
        direccioncompleta.append(direccion);
        direccioncompleta.append(", ");
    }
    if (eventos.cp.trim() != "") {
        direccioncompleta.append(cp);
        direccioncompleta.append(", ");
    }
    //console.log(ciudad.val());
    if (eventos.ciudad.trim() != "") {
        direccioncompleta.append(ciudad);
        direccioncompleta.append(", ");
    }
    direccioncompleta.append(provincia);
    cont.append(direccioncompleta);
    cont.append(contenido);
    cont.append(visual);
    if (eventos.foto) { //Si tiene foto se pinta
        visual.append(img);
    }

    if (eventos.lat && eventos.lng) { //Si tiene mapa se pinta
        visual.append(map);
    }
    cont.append(textAutor);
    textAutor.append("Autor del evento: ");
    textAutor.append(autor);
    if (eventos.participable) { //Si es participable
        if (!eventos.participa) { //Vemos si este participa
            cont.append(botonParticipar); //Si no participa le pintamos el botón para participar
        } else { 
            cont.append(botonYaParticipa); //Si ya participa le pintamos el botón para dejar de participar
        }
        cont.append(textParticipantes);
        textParticipantes.append("Participantes ");
        textParticipantes.append(participantes);
    }
}

function initMap(map, lat, lng) { //Inicializamos el mapa dado el mapa la latitud y la longitud
    var maps = new google.maps.Map(map, {
        center: {lat: parseFloat(lat), lng: parseFloat(lng)},
        zoom: 16,
        streetViewControl: false,
        mapTypeControl: false,
        scaleControl: false,
        zoomControl: false,
        scrollwheel: false,
        fullscreenControl: false
    });
    new google.maps.Marker({ //Marcador en la ubicación de la latitud y longitud
        position: {lat: parseFloat(lat), lng: parseFloat(lng)},
        icon: '../controlador/img/marker.ico', //Icono personalizado
        map: maps
    });
}

//Pintamos los amigos de un usuario dado el aray de amigos, el div donde quiero pintarlos y el usuario con el que estamos logueado
function pintarAmigos(amigos, div, usuario) { 

    var titular = document.createElement("p");
    titular.setAttribute("class", "titularAmigosPerfil");
    $("#" + div).append(titular);

    for (var i = 0; i < amigos.length; i++) {

        var amigoPerfil = document.createElement("div"); //Div del usuario
        amigoPerfil.setAttribute("class", "amigoPerfil");

        //Si somos operador o somos el dueño del perfil 
        if (amigos[i].loginOperador == "1" || amigos[i].login == usuario || usuario == "miPerfil") { 

            var a = document.createElement("button"); //Tenemos el botón eliminar amigos
            a.setAttribute("value", amigos[i].id);
            a.setAttribute("title","Eliminar amigo");
            a.setAttribute("class", "botonEliminarA");

            a.onclick = function () { //Click para eliminar
                if (confirm("Esta seguro de eliminar este amigo")) {
                    eliminarAmigo(this.value);
                }
            }
        }

        var amigoEliminar = document.createElement("img"); //Img para eliminar amigo
        amigoEliminar.setAttribute("class", "amigoEliminar");
        amigoEliminar.setAttribute("src", "../controlador/img/eliminar.png");

        var img = document.createElement("img"); //Img amigo
        img.setAttribute("src", "../controlador/uploads/usuarios/" + amigos[i].foto);
        img.setAttribute("class", "imagenAmigo");
        img.setAttribute("alt", "imagenAmigo");
        img.setAttribute("title","Ver perfil");
        img.setAttribute("data-value", amigos[i].id);

        img.onclick = function () { //Al hacer click en la imagen de cada amigo nos lleva a su perfil
            window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
        }

        var divA = document.createElement("div"); //Información del amigo
        divA.setAttribute("class", "informacionAmigo");
        divA.setAttribute("title","Ver perfil");
        divA.setAttribute("data-value", amigos[i].id);

        divA.onclick = function () { //Al hacer click nos lleva a su perfil
            window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
        }

        var nombreAmigo = document.createElement("p"); //El nombre del amigo 
        nombreAmigo.setAttribute("class", "nombreAmigo");
        nombreAmigo.innerHTML = amigos[i].nick;

        var p = document.createElement("p");

        var animalAmigo = document.createElement("span"); //El animal del amigo
        animalAmigo.setAttribute("class", "animalAmigo");
        animalAmigo.innerHTML = amigos[i].animal;

        var razaAmigo = document.createElement("span"); //Raza
        razaAmigo.setAttribute("class", "razaAmigo");
        razaAmigo.innerHTML = " " + amigos[i].raza;

        $("#" + div).append(amigoPerfil);//metemos amigoPerfil dentro de nuestro div
        //Si somos operador o dueños del perfil
        if (amigos[i].loginOperador == "1" || amigos[i].login == usuario || usuario == "miPerfil") {
            amigoPerfil.append(a);
            a.append(amigoEliminar);
        }
        amigoPerfil.append(img);
        amigoPerfil.append(divA);
        divA.append(nombreAmigo);
        divA.append(p);
        p.append(animalAmigo);
        p.append(razaAmigo);
    }

}