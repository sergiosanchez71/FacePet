<html>
    <head>
        <title>Privacy</title>
        <?php
        session_start();
        include '../controlador/gestion.php';
        comprobarLogin(); //Comprobamos login
        ?>
        <link rel="icon" href="../controlador/img/favicon.ico"><!--Icono-->
        <link rel="stylesheet" type="text/css" href="../controlador/css/header.css"><!--Header CSS-->
        <script src="../controlador/js/libreriaJQuery.js" type="text/javascript"></script><!--JQuery-->
        <script src="../controlador/js/header.js" type="text/javascript"></script><!--Header JS-->
        <style>

            /*El cuerpo ocupa toda la página y su mínima altura es de 40rem background white*/
            #cuerpo{
                margin: auto;
                width: 100%;
                background: white;
            }

            .info{
                padding: 2rem 4rem 4rem 4rem;
                line-height: 1.5rem;
                text-align: justify;
            }

            #cuerpo h1,h2,h3{
                font-family: "Comica", "Arial", sans-serif;
                margin-bottom: 2rem;
                margin-top:2rem;
            }

            #cuerpo li{
                margin-top: 2rem;
                line-height: 1.75rem;
            }

            #cuerpo li strong{
                font-size: 1.2rem;
            }


        </style>
    </head>
    <script>

        $(document).ready(function () {
            var valor = $("#legal").val();
            if (valor === "privacidad") {
                $("#privacidad").show();
            } else if (valor === "condiciones") {
                $("#condiciones").show();
            } else if (valor === "cookies") {
                $("#cookies").show();
            } else {
                window.location.href = "vistaUsuario.php";
            }


        });

    </script>
    <body>
        <div id="principal">
            <header>
                <nav id="navpc">
                    <a href="vistaUsuario.php" id="facepetA"><img src="../controlador/img/facepet.png" id="facepet" alt="logo"></a>
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
                <input type="text" id="legal" style="display:none" value="<?php echo $_REQUEST['legal'] ?>">
                <div id="privacidad" style="display:none">
                    <div class="info">
                        <h1>¿Qué tipo de información recopilamos?</h1>
                        <p>Debemos tratar tu información a fin de proporcionarte los Productos de FacePet. El tipo de información que recopilamos depende de la forma en la que usas nuestros Productos. Puedes obtener información sobre cómo acceder a la información que recopilamos y cómo eliminarla en la configuración de FacePet</p>
                        <h2>Cosas que tú y otras personas hacéis y nos proporcionáis</h2>
                        <ul>
                            <li><strong>Información y contenido que nos proporcionas.</strong> Recopilamos el contenido, las comunicaciones y otros datos que proporcionas cuando usas nuestros Productos, por ejemplo, cuando te registras para crear una cuenta, creas o compartes contenido y envías mensajes a otras personas o te comunicas con ellas. Esta información puede corresponder a datos incluidos en el contenido que proporcionas (por ejemplo, los metadatos) o relacionados con este, como el lugar donde se hizo una foto o la fecha de creación de un archivo. También puede incluir el contenido que ves a través de las funciones que ponemos a tu disposición, como la cámara, de modo que podamos realizar acciones como sugerirte máscaras y filtros que quizá te interesen, así como darte consejos sobre cómo usar el modo vertical. Nuestros sistemas realizan automáticamente el tratamiento del contenido y las comunicaciones que tú y otras personas proporcionáis para analizar el contexto y lo que incluyen en relación con los propósitos que se describen a continuación. Obtén más información sobre cómo controlar quién puede ver el contenido que compartes.</li>
                            <li><strong>Datos de categorías especiales:</strong> Puedes optar por proporcionar información en los campos de tu perfil de FacePet o los acontecimientos importantes sobre tus opiniones religiosas o políticas, indicar cuáles son tus intereses o aspectos relacionados con tu salud. Esta y otra información (como el origen étnico o racial, las creencias filosóficas o la afiliación sindical) está sujeta a protección especial en virtud de la legislación de la UE.</li>
                            <li><strong>Redes y conexiones.</strong> Recopilamos información sobre las personas, las páginas, las cuentas, los hashtags y los grupos a los que estás conectado y cómo interactúas con ellos en nuestros Productos, por ejemplo, las personas con las que más te comunicas o los grupos de los que formas parte. También recopilamos información de contacto si eliges subirla, sincronizarla o importarla desde un dispositivo (como una libreta de direcciones, un registro de llamadas o un historial de SMS). Usamos estos datos para propósitos como ayudarte a ti y a otros a encontrar personas que quizá conoces, así como para las finalidades que se indican a continuación.</li>
                            <li><strong>Tu uso.</strong> Recopilamos información sobre cómo usas nuestros Productos, como los tipos de contenido que ves o con los que interactúas, las funciones que utilizas, las acciones que llevas a cabo, las personas o cuentas con las que interactúas y la hora, la frecuencia y la duración de tus actividades. Por ejemplo, registramos cuándo estás usando y cuándo has usado nuestros Productos por última vez, y qué publicaciones, vídeos y otro tipo de contenido ves en nuestros Productos. También recopilamos información sobre cómo usas funciones como nuestra cámara.</li>
                            <li><strong>Información sobre transacciones realizadas en nuestros Productos.</strong> Si usas nuestros Productos para efectuar compras u otras transacciones económicas (por ejemplo, cuando compras algo en un juego o haces una donación), recopilamos datos sobre dichas compras o transacciones. Esos datos incluyen la información del pago, como el número de tu tarjeta de crédito o débito y otra información sobre la tarjeta, así como datos sobre la cuenta y la autenticación, y detalles de facturación, envío y contacto.</li>
                            <li><strong>La actividad de otros usuarios y la información que proporcionan sobre ti.</strong> También recibimos y analizamos contenido, comunicaciones e información que nos proporcionan otras personas al usar nuestros Productos. Estos datos pueden incluir información sobre ti, como en caso de que otras personas compartan o comenten una foto tuya, te envíen un mensaje o suban, sincronicen o importen tu información de contacto.</li>
                        </ul>
                    </div>
                </div>
                <div id="condiciones" style="display:none">
                    <div class="info">
                        <h1>Condiciones del servicio</h1>
                        <h2>¡Te damos la bienvenida a FacePet!</h2>
                        <p>FacePet desarrolla tecnologías y servicios que permiten a las personas conectarse entre sí, establecer comunidades y hacer crecer sus empresas. Estas Condiciones rigen el uso de FacePet, Messenger y los productos, las funcionalidades, las aplicaciones, los servicios, las tecnologías y el software que ofrecemos (los Productos de FacePet o Productos), excepto cuando indiquemos expresamente que se aplican otras condiciones distintas de estas. FacePet Ireland Limited es quien te proporciona estos Productos.</p>
                        <p>No te cobramos por el uso de FacePet ni del resto de los productos y servicios que se incluyen en estas Condiciones. En su lugar, las empresas y organizaciones nos pagan por mostrarte publicidad sobre sus productos o servicios. Al usar nuestros Productos, aceptas que te mostremos anuncios que consideremos relevantes para ti y tus intereses. Para determinar estos anuncios, usamos tus datos personales.</p>
                        <p>No vendemos tus datos personales a los anunciantes ni compartimos ningún tipo de información que te identifique (como tu nombre, dirección de correo electrónico u otros datos de contacto) con ellos, a menos que nos des permiso específico. En su lugar, los anunciantes nos proporcionan información, como el tipo de audiencia a la que quieren llegar con sus anuncios, y nosotros los mostramos a las personas que puedan estar interesadas en ellos. Asimismo, ofrecemos a los anunciantes informes sobre el rendimiento de su publicidad a fin de que sepan de qué manera interactúan las personas con su contenido. Consulta la Sección 2 a continuación para obtener más información al respecto.</p>
                        <p>En nuestra Política de datos se detalla cómo recopilamos y usamos tus datos personales para determinar algunos de los anuncios que ves y ofrecer el resto de los servicios que se describen a continuación. En la configuración, también puedes revisar cuando quieras las opciones de privacidad de que dispones para determinar el uso que hacemos de tus datos.</p>
                    </div>
                </div>
                <div id="cookies" style="display:none">
                    <div class="info">
                        <h1>Cookies y otras tecnologías de almacenamiento</h1>
                        <p>Las cookies son pequeños fragmentos de texto que se utilizan para almacenar información sobre los navegadores web. Permiten almacenar y recibir identificadores e información adicional sobre ordenadores, teléfonos y otros dispositivos. También se utilizan con fines similares otras tecnologías, como los datos que almacenamos sobre los navegadores web o los dispositivos, los identificadores que se asocian a los dispositivos y otros tipos de software. A efectos de esta política, todas las tecnologías referidas reciben el nombre de “cookies”.</p>
                        <p>Utilizamos cookies en los siguientes casos: si tienes una cuenta de FacePet, usas los Productos de FacePet (incluidos nuestro sitio web y nuestras aplicaciones) o visitas otros sitios web y aplicaciones que utilizan dichos productos (incluidos el botón “Me gusta” o las tecnologías de FacePet). Las cookies permiten a FacePet ofrecerte sus productos y nos ayudan a comprender la información que recibimos de ti, incluidos los datos sobre el uso que realizas de otros sitios web y aplicaciones, independientemente de si estás o no registrado o si has iniciado sesión en la plataforma.</p>
                        <p>En esta política se explica el uso que hacemos de las cookies y las opciones de las que dispones. Salvo que se indique lo contrario en el presente documento, procesaremos los datos que recibamos a través de las cookies conforme a la Política de datos.</p>

                        <h2>¿Por qué utilizamos cookies?</h2>
                        <p>Las cookies nos ayudan a prestar, proteger y mejorar los Productos de FacePet; por ejemplo, nos permiten personalizar el contenido, adaptar los anuncios y medir su rendimiento, así como brindar una mayor seguridad. Aunque las cookies que utilizamos pueden cambiar en determinadas circunstancias durante la mejora y la actualización de los Productos de FacePet, suelen utilizarse para los fines siguientes:</p>
                        <h3>Autenticación</h3>
                        <p>Utilizamos cookies para verificar tu cuenta y determinar cuándo inicias sesión en la plataforma, con el objetivo de ayudarte a acceder a los Productos de FacePet y mostrarte la experiencia y las funciones adecuadas.</p>
                        <h3>Seguridad e integridad de los sitios web y los productos</h3>
                        <p>Utilizamos cookies para proteger tu cuenta, tus datos y los Productos de FacePet.
                        Asimismo, utilizamos cookies para luchar contra aquellas actividades que puedan infringir nuestras políticas o minar, de cualquier otro modo, nuestra capacidad para proporcionar los Productos de FacePet.</p>
                        <h3>Publicidad, recomendaciones, estadísticas y mediciones</h3>
                        <p>Utilizamos cookies para mostrar anuncios de empresas y organizaciones y recomendarlas a personas que pueden estar interesadas en los productos, los servicios o las causas que promocionan.
                        También utilizamos cookies para medir el rendimiento de las campañas publicitarias de empresas que utilizan los Productos de FacePet.
                        Las cookies nos ayudan a mostrar y medir anuncios en los diferentes navegadores y dispositivos que utiliza una persona.
                        Las cookies también nos permiten proporcionar estadísticas sobre las personas que usan los Productos de FacePet y aquellas que interactúan con los anuncios, los sitios web y las aplicaciones de nuestros anunciantes y de las empresas que utilizan dichos productos.
                        También utilizamos cookies para ayudarte a indicar que no quieres ver determinados anuncios de FacePet en función de tu actividad en sitios web de terceros. Obtén más información sobre los datos que recibimos, cómo decidimos qué anuncios mostrarte en los Productos de FacePet y en otros medios, y los controles de los que dispones.</p>
                        <h3>Funciones y servicios para sitios web</h3>
                        <p>Utilizamos cookies para habilitar las funciones que nos ayudan a proporcionar los Productos de FacePet.
                            También utilizamos cookies con el fin de proporcionar contenido relevante para tu configuración regional.</p>
                        <h3>Rendimiento</h3>
                        <p>Utilizamos cookies para ofrecerte la mejor experiencia posible.</p>
                        <h3>Análisis y estudios</h3>
                        <p>Utilizamos cookies para conocer mejor cómo se utilizan los Productos de FacePet, con el fin de mejorarlos.</p>

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