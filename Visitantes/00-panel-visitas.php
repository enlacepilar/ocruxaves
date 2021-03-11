<?php
session_start();
if (!isset($_SESSION["el-user"]))
{
  echo "No está logueado";
  header("location:index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Bootstrap y Datatables -->
    <link rel="stylesheet" href="../00-Recursos/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="../00-Recursos/Datatables/jquery.dataTables.min.css">

    <title>Lista de ingresos</title>

<style>
    td{
        border: solid 2px;
    }
    th{
        font-weight: bold;
        text-align: center;
    }


</style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Lista de ingresos</h1>
        <a href="cierre.php"> <button class="btn btn-warning mb-3" style="float:right;">Cerra sesión</button></a>
    <table class="table table-info" id="tabla-datos">
        <thead>
            <th>id</th><th>IP</th><th>PAIS</th><th>Empresa</th><th>Fecha de Ingreso</th>
            </thead>
        

            <tbody>

    <?php

    require('../Configuracion/conexion.php');
    require('../Configuracion/conexion-GPS.php');
    $sql= "SELECT id, ip, pais, empresa, fecha FROM visitantes ORDER BY fecha DESC "; // el order by no funciona en DATATABLES
    $resultado= $base->prepare($sql);
    $resultado->execute();
    $registro=$resultado->fetchall(PDO::FETCH_ASSOC);
    $resultado->closeCursor();
    
    foreach ($registro as $datos)
    {
        echo "<tr><td>" . $datos['id'] . "</td> <td>" . $datos['ip'] . 
        "</td><td>". $datos['pais']. "</td> <td>". $datos['empresa'] . 
        "</td> <td>" . $datos['fecha'] . "</td></tr>";
    };
    $sqlgps= "SELECT id, ip, pais, empresa, fecha FROM visitantes ORDER BY fecha DESC "; // el order by no funciona en DATATABLES
    $resultadogps= $basegps->prepare($sqlgps);
    $resultadogps->execute();
    $registrogps=$resultadogps->fetchall(PDO::FETCH_ASSOC);
    $resultadogps->closeCursor();
    
    foreach ($registrogps as $datosgps)
    {
        echo "<tr><td>" . $datosgps['id'] . "</td> <td>" . $datosgps['ip'] . 
        "</td><td>". $datosgps['pais']. "</td> <td>". $datosgps['empresa'] . 
        "</td> <td>" . $datosgps['fecha'] . "</td></tr>";
    };
    ?>
    </tbody>
    </table>

    </div>

<!-- JQUERY  y Bootstrap-->
<script src="../00-Recursos/jquery-3.5.1.min.js"></script>
<script src="../00-Recursos/bootstrap4/js/bootstrap.min.js"></script>

<!-- DATATABLES -->
<script src="../00-Recursos/Datatables/jquery.dataTables.min.js"></script>
<script src="../00-Recursos/Datatables/dataTables.buttons.min.js"></script>
<script src="../00-Recursos/Datatables/jszip.min.js"></script>
<script src="../00-Recursos/Datatables/pdfmake.min.js"></script>
<script src="../00-Recursos/Datatables/vfs_fonts.js"></script>
<script src="../00-Recursos/Datatables/buttons.html5.min.js"></script>
<script src="../00-Recursos/Datatables/buttons.print.min.js"></script>


<script>
    $(document).ready( function () 
    {
        $('#tabla-datos').DataTable({
            "order": [0, 'desc'],
            'ordering': true,
            pageLength : 20,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'Todos']],
            language: 
            {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Datos del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Datos del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar por columna",
            //"searchPlaceholder": "Buscar por  ",
            "oPaginate": 
                {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
                },
            "sProcessing": "Procesando..."
            }
        });
    });
</script>
</body>
</html>





