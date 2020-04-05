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
            #perfil{
                width: 2rem;
            }
        </style>
    </head>
    <body>
        <?php
        // put your code here
        ?>

        <div id="principal">
            
            <header>
                <h1>FacePet</h1>
                <p><img src="../controlador/img/pata.png" id="perfil">NombreUsuario</p>
            </header>
            
            <nav>
                <ul>
                    <li>Mi Perfil</li>
                    <li>Ver Posts</li>
                    <li>Buscar Amigos</li>
                    <li>(Mensajes)</li>
                    <li>(Notificaciones)</li>

                </ul>
            </nav>
            
            <div id="contenido">
                
            </div>
           
            <footer>
                
            </footer>
            
        </div>


    </body>
</html>
