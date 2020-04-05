<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            //echo $_SESSION['username'];
        } else {
            header("Location: ../index.php");
        }
        ?>
        <style>

            header{
                background: #FFF4C8;
                height: 4rem;
                width: 70rem;
                padding: 1rem;
                margin: auto;
            }

            #facepet{
                width: 15rem;
            }

            #facepetA{
                float:left;
            }

            #perfil, #mensajes, #notificaciones{
                width: 2rem;
                position: relative;
                bottom: 0.5rem;
            }

            nav li{
                list-style: none;
                float: left;
                padding: 1rem;
                position: relative;
                left: 1rem;
                top: 0.5rem;
                cursor: pointer;
                font-weight: bold;
            }
            
            nav li span{
                background: red;
                padding: 0.05rem 0.2rem 0.05rem 0.2rem;
                position: absolute;
                bottom: 2.7rem;
                left: 2.3rem;
                color: white;
            }
            
            ul li{
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
        // put your code here
        ?>

        <div id="principal">

            <header>
                <a href="../index.php" id="facepetA"><img src="../controlador/img/facepet.png" id="facepet"></a>
                <nav>
                    <li>Inicio</li>
                    <li>Mi Perfil</li>
                    <li>Crear
                        <ul>
                            <li>Crear Post</li>
                            <li>Crear Evento</li>
                        </ul>
                    </li>
                    <li>Buscar Amigos</li>
                    <li><img src="../controlador/img/mensaje.png" id="mensajes" alt="mensajes"><span>1</span></li>
                    <li><img src="../controlador/img/notificacion.png" id="notificaciones" alt="notificaciones"><span>1</span></li>
                    <li><img src="../controlador/img/pata.png" id="perfil">NombreUsuario</li>
                </nav>
            </header>

            <div id="contenido">

            </div>

            <footer>

            </footer>

        </div>


    </body>
</html>
