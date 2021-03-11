<?php 

function getRealIP()
{

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }

}


//$ip = getRealIP();
$ip = $_SERVER["REMOTE_ADDR"];


// Contiene el texto como JSON que retorna geoplugin a partir de la IP
// Puedes usar un método más sofisticado para hacer un llamado a geoplugin 
// usando librerias como UNIREST etc
$informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);

// Convertir el texto JSON en un array
$dataSolicitud = json_decode($informacionSolicitud);

// Ver contenido del array
foreach ($dataSolicitud as $clave=>$valor)
{
    if ($clave == 'geoplugin_countryName')
    {
        $pais = $valor;
    }
    if ($clave == 'geoplugin_regionName')
    {
        $provincia = $valor;
    }
}

echo json_encode(array("ip"=>$ip, "pais"=>$pais, "provincia"=>$provincia));
