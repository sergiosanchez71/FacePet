function pintarPosts(posts, div) {
    for (var i = 0; i < posts.length; i++) {
        var cadPosts = $("#cadPosts").val();
        if ($("#cadPosts").val() === "") {
            $("#cadPosts").val(posts[i].id);
        } else {
            $("#cadPosts").val(cadPosts + "," + posts[i].id);
        }

        var post = document.createElement("div");
        post.setAttribute("class", "post");

        var postUsuario = document.createElement("p");
        postUsuario.setAttribute("class", "postUsuario");
        postUsuario.setAttribute("data-value", posts[i].usuario);

        postUsuario.onclick = function () {
            window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
        }
        
        /*if (posts[i].loginOperador == 1 || posts[i].login == usuario) {

                                    var a = document.createElement("button");
                                    a.setAttribute("value", posts[i].id);
                                    a.setAttribute("class", "botonEliminar");

                                    a.onclick = function () {
                                        if (confirm("Esta seguro de eliminar este post")) {
                                            eliminarPost(this.value);
                                        }
                                    }

                                    var postEliminar = document.createElement("img");
                                    postEliminar.setAttribute("class", "postEliminar");
                                    postEliminar.setAttribute("src", "../controlador/img/eliminar.png");

                                }*/

        var imgUsuario = document.createElement("img");
        imgUsuario.setAttribute("class", "imagenUsuario");
        imgUsuario.setAttribute("src", "../controlador/uploads/usuarios/" + posts[i].foto);
        var nombreUsuario = document.createElement("p");
        nombreUsuario.setAttribute("class", "nombreUsuario");
        nombreUsuario.innerHTML += posts[i].nick;

        var postFecha = document.createElement("p");
        postFecha.setAttribute("class", "postFecha");
        postFecha.innerHTML += posts[i].fecha_publicacion;

        var postCont = document.createElement("div");
        postCont.setAttribute("class", "postCont");

        var postTitulo = document.createElement("p");
        postTitulo.setAttribute("class", "postTitulo");
        postTitulo.innerHTML += posts[i].titulo;

        if (posts[i].multimedia != null) {

            var postImg = document.createElement("img");
            postImg.setAttribute("class", "postImg");
            postImg.setAttribute("src", "../controlador/uploads/posts/" + posts[i].multimedia);

        }

        var postContenido = document.createElement("p");
        postContenido.setAttribute("class", "postContenido");
        postContenido.innerHTML += posts[i].contenido;

        var postBottom = document.createElement("div");
        postBottom.setAttribute("class", "postBottom")

        var postLikes = document.createElement("p");
        postLikes.setAttribute("class", "postLikes");

        if (posts[i].likes != null) {

            var cadlikes = posts[i].likes;
            var likes = cadlikes.split(",");
            var slikes = document.createElement("span");
            slikes.setAttribute("class", "likes");
            slikes.innerHTML = likes.length;

        }

        var iconos = document.createElement("p");
        iconos.setAttribute("class", "iconos");
        var postCorazon = document.createElement("a");
        postCorazon.setAttribute("class", "postCorazon");

        var postCorazonImg = document.createElement("img");
        postCorazonImg.setAttribute("class", "postCorazonImg");
        postCorazonImg.setAttribute("alt", "Corazon");
        postCorazonImg.setAttribute("data-value", posts[i].id);
        postCorazonImg.setAttribute("data-pos", i);

        if (!posts[i].like) {
            postCorazonImg.setAttribute("src", "../controlador/img/nolike.png");

            postCorazonImg.onclick = function () {
                this.removeAttribute("src");
                this.setAttribute("src", "../controlador/img/Like.png");
                darLike(this.dataset.value);
                if (!this.dataset.like) {
                    var valor = $(".likes:eq(" + this.dataset.pos + ")").text();
                    var valor2 = parseInt(valor);
                    $(".likes:eq(" + this.dataset.pos + ")").text(parseInt(valor2 + 1));
                    this.setAttribute("data-like", true);
                }
            }
        } else {
            postCorazonImg.setAttribute("src", "../controlador/img/Like.png");
        }


        var postComentario = document.createElement("a");
        postComentario.setAttribute("class", "postComentario");

        var postComentarioImg = document.createElement("img");
        postComentarioImg.setAttribute("class", "postComentarioImg");
        postComentarioImg.setAttribute("src", "../controlador/img/comentario.png");
        postComentarioImg.setAttribute("alt", "Comentario");
        postComentarioImg.setAttribute("data-value", posts[i].id);

        postComentarioImg.onclick = function () {
            window.location.href = "verPost.php?post=" + this.dataset.value;
        }

        var comentarios = document.createElement("span");
        comentarios.setAttribute("class", "comentariosPost");
        comentarios.setAttribute("data-value", posts[i].id);
        if (posts[i].comentarios > 0) {
            if (posts[i].comentarios == 1) {
                comentarios.innerHTML = "Ver " + posts[i].comentarios + " comentario";
            } else {
                comentarios.innerHTML = "Ver " + posts[i].comentarios + " comentarios";
            }
        } else {
            comentarios.innerHTML = "Hacer un comentario...";
        }

        comentarios.onclick = function () {
            window.location.href = "verPost.php?post=" + this.dataset.value;
        }


        $("#" + div).append(post);
       /* if (posts[i].loginOperador == 1 || posts[i].login == usuario) {
                                    post.append(a);
                                    a.append(postEliminar);
                                }*/
        post.append(postUsuario);

        

        postUsuario.append(imgUsuario);
        postUsuario.append(nombreUsuario);

        post.append(postFecha);
        post.append(postCont);

        postCont.append(postTitulo);
        if (posts[i].multimedia != null) {
            postCont.append(postImg);
        }
        postCont.append(postContenido);

        postCont.append(postBottom);

        postBottom.append(postLikes);

        if (posts[i].likes != null) {
            if (likes.length > 1) {
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

function pintarEventos(eventos, div) {
    for (var i = 0; i < eventos.length; i++) {
        var evento = document.createElement("div");
        evento.setAttribute("class", "evento");

        var titulo = document.createElement("p");
        titulo.setAttribute("class", "eventoTitulo");
        titulo.innerHTML = eventos[i].titulo;
        titulo.setAttribute("data-value", eventos[i].id);

        titulo.onclick = function () {
            window.location.href = "verEvento.php?evento=" + this.dataset.value;
        }


        var textTipo = document.createElement("p");
        textTipo.setAttribute("class", "textTipo");

        var tipo = document.createElement("span");
        tipo.setAttribute("class", "eventoTipo");
        tipo.innerHTML = eventos[i].tipo;

        var textFechai = document.createElement("p");
        textFechai.setAttribute("class", "textFechai");

        var textFechaf = document.createElement("p");
        textFechaf.setAttribute("class", "textFechaf");

        var fechai = document.createElement("span");
        fechai.setAttribute("class", "eventoFecha");
        fechai.innerHTML = eventos[i].fechai;
        if (eventos[i].empezado) {
            fechai.setAttribute("style", "color:#126310");
            fechai.setAttribute("title", "Evento actualmente activo");
        }

        var fechaf = document.createElement("span");
        fechaf.setAttribute("class", "eventoFecha");
        fechaf.innerHTML = eventos[i].fechaf;

        var contenido = document.createElement("p");
        contenido.setAttribute("class", "eventoContenido");
        contenido.innerHTML = eventos[i].contenido;

        if (eventos[i].foto) {

            var img = document.createElement("img");
            img.setAttribute("class", "eventoImg");
            console.log(eventos[i].foto);
            img.setAttribute("src", "../controlador/uploads/eventos/" + eventos[i].foto);
            img.setAttribute("alt", "imgagenEvento");

        } else if (eventos[i].lat && eventos[i].lng) {
            var map = document.createElement("div");
            map.setAttribute("class", "map");
            //map.setAttribute("style", "height:20rem");
            initMap(map, eventos[i].lat, eventos[i].lng);
        }
        var textAutor = document.createElement("p");
        textAutor.setAttribute("class", "eventoAutor");

        var autor = document.createElement("span");
        autor.setAttribute("class", "eventoNombreAutor");
        autor.innerHTML = eventos[i].autor;
        autor.setAttribute("data-value", eventos[i].usuario);

        autor.onclick = function () {
            window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
        }

        if (eventos[i].participable) {
            var textParticipantes = document.createElement("p");
            var participantes = document.createElement("span");
            var part;
            if (eventos[i].participable == "t") {
                part = "0";
            } else {
                part = eventos[i].participantes.length;
            }
            participantes.innerHTML = part;
        }

        $("#" + div).append(evento);
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
        evento.append(contenido);
        if (eventos[i].foto) {
            evento.append(img);
        } else if (eventos[i].lat && eventos[i].lng) {
            evento.append(map);
        }
        evento.append(textAutor);
        textAutor.append("Autor del evento: ");
        textAutor.append(autor);
        if (eventos[i].participable) {
            evento.append(textParticipantes);
            textParticipantes.append("Participantes ");
            textParticipantes.append(participantes);
        }

    }
}

function pintarAmigos(amigos, div) {

    var titular = document.createElement("p");
    titular.setAttribute("class", "titularAmigosPerfil");
    $("#" + div).append(titular);

    for (var i = 0; i < amigos.length; i++) {

        var amigoPerfil = document.createElement("div");
        amigoPerfil.setAttribute("class", "amigoPerfil");

        var a = document.createElement("button");
        a.setAttribute("value", amigos[i].id);
        a.setAttribute("class", "botonEliminarA");

        a.onclick = function () {
            if (confirm("Esta seguro de eliminar este amigo")) {
                eliminarAmigo(this.value);
            }
        }

        var amigoEliminar = document.createElement("img");
        amigoEliminar.setAttribute("class", "amigoEliminar");
        amigoEliminar.setAttribute("src", "../controlador/img/eliminar.png");

        var img = document.createElement("img");
        img.setAttribute("src", "../controlador/uploads/usuarios/" + amigos[i].foto);
        img.setAttribute("class", "imagenAmigo");
        img.setAttribute("alt", "imagenAmigo");
        img.setAttribute("data-value", amigos[i].id);

        img.onclick = function () {
            window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
        }

        var divA = document.createElement("div");
        divA.setAttribute("class", "informacionAmigo");
        divA.setAttribute("data-value", amigos[i].id);

        divA.onclick = function () {
            window.location.href = "verPerfil.php?usuario=" + this.dataset.value;
        }

        var nombreAmigo = document.createElement("p");
        nombreAmigo.setAttribute("class", "nombreAmigo");
        nombreAmigo.innerHTML = amigos[i].nick;

        var p = document.createElement("p");

        var animalAmigo = document.createElement("span");
        animalAmigo.setAttribute("class", "animalAmigo");
        animalAmigo.innerHTML = amigos[i].animal;

        var razaAmigo = document.createElement("span");
        razaAmigo.setAttribute("class", "razaAmigo");
        razaAmigo.innerHTML = " " + amigos[i].raza;

        $("#" + div).append(amigoPerfil);
        amigoPerfil.append(a);
        a.append(amigoEliminar);
        amigoPerfil.append(img);
        amigoPerfil.append(divA);
        divA.append(nombreAmigo);
        divA.append(p);
        p.append(animalAmigo);
        p.append(razaAmigo);
    }

}