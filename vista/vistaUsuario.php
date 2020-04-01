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
        if(isset($_SESSION['username'])){
            echo $_SESSION['username'];
        } else {
            header("Location: ../index.php");
        }
        
        ?>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
