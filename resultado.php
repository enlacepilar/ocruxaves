<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="Web Builder Description">
  
  
  <title>Ver Libros</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <!-- DATATABLES -->
  <link rel="stylesheet" href="assets/Datatables/jquery.dataTables.min.css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="assets/fontawesome-free-5.15.2-web/css/all.min.css">

  
  
</head>
<body>
  <section class="mbr-section content4 cid-s0IbZI7r5R" id="content4-e">

    

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-2">
                    Catalogo - resultados</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5">Ediciones Ocruxaves<br><br><a href="/">Volver</a>
                </h3>
                
            </div>
        </div>
    </div>
</section>
<div class="container">
<h2 <center> Resultado de la búsqueda </h2>
<table class="table table-info" id='tabla-datos' border=5>  
    <thead>  
        <td>Nro.</td>  
        <td>Año</td>  
        <td>Título</td>  
        <td>Género</td>
        <td>Autor</td>
        <td>Comentarios</td>  
    </thead>  
    <tbody>

<?php

require('Configuracion/conexion.php');

$año = $_POST['año'];
$titulo = $_POST['titulo'];
$genero = $_POST['genero'];
$autor = $_POST['autor'];



$sql="select * from libros where año LIKE '%".$año."%' and titulo like '%".$titulo."%' and genero LIKE '%".$genero."%' and autor LIKE '%".$autor."%'"; // el order by no funciona en DATATABLES
$resultado= $base->prepare($sql);
$resultado->execute();
$registro=$resultado->fetchall(PDO::FETCH_ASSOC);
$resultado->closeCursor();

foreach ($registro as $datos)
{
    echo "<tr><td>" . $datos['id'] . "</td> <td>" . $datos['año'] . 
    "</td><td>". $datos['titulo']. "</td> <td>". $datos['genero'] . 
     "</td> <td>". $datos['autor'] . "</td> <td>" . $datos['comentarios'] . "</td></tr>";
};

?>
</tbody>
</table>
    
</div>
<br><br>  

    <section class="engine"><a href="https://mobirise.info/k">develop free website</a></section><script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/tether/tether.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/theme/js/script.js"></script>

    <!-- DATATABLES -->
    <script src="assets/Datatables/jquery.dataTables.min.js"></script>
    <script src="assets/Datatables/dataTables.buttons.min.js"></script>
    <script src="assets/Datatables/jszip.min.js"></script>
    <script src="assets/Datatables/pdfmake.min.js"></script>
    <script src="assets/Datatables/vfs_fonts.js"></script>
    <script src="assets/Datatables/buttons.html5.min.js"></script>
    <script src="assets/Datatables/buttons.print.min.js"></script>

    <!-- FontAwesome -->
    <script src="assets/fontawesome-free-5.15.2-web/js/all.min.js"></script>

  
<a href="/">Volver</a>

<script>
    $(document).ready( function () 
    {
        $('#tabla-datos').DataTable(
        {
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
            },
            responsive: true,
				dom: 'Blfrtip', //la T es la tabla, si esta a la izquierda se van a ubicar arriba
				buttons: 
				[
					{
						extend: 'excelHtml5',
						text: '<i class="fas fa-file-excel"></i> ',
						titleAttr: 'Exportar a Excel',
						className: 'btn btn-success',
						title: 'Listado de tickets',
						exportOptions: 
						{
							columns: [0,1,2,3,4,5]
						},
						filename: 'tickets'
					},
					{
						extend: 'pdfHtml5',
						text: '<i class="fas fa-file-pdf"></i> ',
						titleAttr: 'Exportar a PDF',
						title: 'Listado de tickets',
						pageSize: 'A4',
						exportOptions: {
						columns: [0,1,2,3,4,5]
					},
						content: [ { table: {width: 'auto'}}],
						filename: 'tickets',
						className: 'btn btn-danger'
					},
					{
						extend: 'print',
						text: '<i class="fa fa-print"></i> ',
						titleAttr: 'Imprimir',
						className: 'btn btn-primary',
						exportOptions: {
							columns: [ 0,1,2,3,4,5 ]
						}
					}
				]
        });
    });
</script>
  
</body>
</html>