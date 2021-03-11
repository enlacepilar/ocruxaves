<?php

$clave = "Ramanegra197900";
$pass_cifrado=password_hash($clave, PASSWORD_DEFAULT, array("cost"=>12));

echo $pass_cifrado;