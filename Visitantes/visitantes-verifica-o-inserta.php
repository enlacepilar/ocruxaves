<?php
require('../Configuracion/conexion.php');

$datos = json_decode(file_get_contents('php://input'));

 //Conversion de fecha para las consultas preparadas
 $fecha0 = date('Y-m-d H:i:s');
 $fecha = strtotime('-3 hour', strtotime($fecha0));
 $fecha = date('Y-m-d H:i:s', $fecha);


$ip = '';
$pais = '';
$provincia ='';
$empresa = 'Ocruxaves';




foreach ($datos as $clave=>$valor)
{
    if ($clave == 'ip')
    {
        $ip = $valor;
    };
    if ($clave == 'pais')
    {
        $pais = $valor;
    };
    if ($clave == 'provincia')
    {
        $provincia = $valor;
    };
};


$ubicacion = $pais . ", ". $provincia;

//Averigua el ultimo usuario y el pais conectado asi no agrega duplicados.
$averigua = "SELECT id, ip, pais, empresa FROM visitantes where id = (SELECT max(id) FROM visitantes)";
$traer =  $base->prepare($averigua);
$traer->execute();
$traeVisitante = $traer->fetchall(PDO::FETCH_ASSOC);
if (count($traeVisitante)>0)
{
    foreach ($traeVisitante as $datosBase)
    {
        if ($ip == $datosBase['ip'] && $ubicacion == $datosBase['pais'] && $empresa == "Ocruxaves"){

            echo json_encode(array("resultado"=>" Sin cambios", "idBase"=>$datosBase['id']));

        }else
        {
            $sql= "
                    INSERT into visitantes (
                    ip,
                    pais, 
                    empresa,
                    fecha
                    ) 
                    VALUES
                    (
                    :ip,
                    :pais, 
                    :empresa,
                    :fecha
                    )"; 
            $insertar= $base->prepare($sql);  
            $insertar->execute(array(
                    ':ip'=>$ip,
                    ':pais'=>$ubicacion,
                    ':empresa'=>$empresa,
                    ':fecha'=>$fecha
                    ));  


            $sql1 = "SELECT MAX(id) FROM visitantes";
            $insertar1 = $base->prepare($sql1);
            $insertar1->execute(array());
            $resultado = $insertar1->fetchall(PDO::FETCH_ASSOC);
            $insertar1->closeCursor();

            foreach ($resultado as $datos){
                $idFin = $datos['MAX(id)'];
            }

            echo json_encode(array("resultado"=>"Agregada la id: " . $idFin . " Y el pais: " . $ubicacion));
        }
    }
    
}else
{
    $sql= "
            INSERT into visitantes (
            ip,
            pais, 
            empresa,
            fecha
            ) 
            VALUES
            (
            :ip,
            :pais, 
            :empresa,
            :fecha
            )"; 
    $insertar= $base->prepare($sql);  
    $insertar->execute(array(
            ':ip'=>$ip,
            ':pais'=>$ubicacion,
            ':empresa'=>$empresa,
            ':fecha'=>$fecha
            ));  


    $sql1 = "SELECT MAX(id) FROM visitantes";
    $insertar1 = $base->prepare($sql1);
    $insertar1->execute(array());
    $resultado = $insertar1->fetchall(PDO::FETCH_ASSOC);
    $insertar1->closeCursor();

    foreach ($resultado as $datos){
        $idFin = $datos['MAX(id)'];
    }

    echo json_encode(array("resultado"=>"Agregada la id: " . $idFin));
};



