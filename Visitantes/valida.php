<?php

require('../Configuracion/conexion.php');

$usuario=htmlentities(addslashes($_POST['usuario']));
$clave = htmlentities(addslashes($_POST['clave']));

$sql= "SELECT nombre_usuario, password FROM usuarios WHERE nombre_usuario=:usu"; 
$resultado= $base->prepare($sql);
$resultado->execute(array(':usu'=>$usuario));
$registro=$resultado->fetchall(PDO::FETCH_ASSOC);
$resultado->closeCursor();

if (count($registro) >0)
{
    foreach ($registro as $dato)
    {
        if($dato['nombre_usuario'] ==$usuario && password_verify($clave, $dato['password']) )
        //if($dato['nombre_usuario'] ==$usuario && $clave == $dato['password'])
        {
            session_start();
            $_SESSION["el-user"]=$usuario; 
            header("location:00-panel-visitas.php");
        }else
        {
            echo "<script>alert('Usuario y/o clave incorrectas');</script>";
            echo "<script>  window.location.href = 'index.html'</script>";
            //header("location:index.html");
        }
    }
}else
{
    echo "<script>alert('Usuario y/o clave incorrectas');</script>";
    echo "<script>  window.location.href = 'index.html'</script>";
    //header("location:index.html");
}

