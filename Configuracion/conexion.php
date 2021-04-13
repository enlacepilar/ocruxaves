<?php
    include "config.php";
    
    try
    {
        $servidor="mysql:dbname=". BD . ";host=" . SERVIDOR;
        $base = new PDO($servidor, USUARIO, PASSWORD);
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
    }
    catch (Exception $e){
        die ("¡¡¡Error!!! <br> <b>" . $e->getMessage() . "</b>");
    };

