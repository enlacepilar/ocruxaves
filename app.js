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