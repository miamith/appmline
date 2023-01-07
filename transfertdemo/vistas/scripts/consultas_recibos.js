var tabla;

//Función que se ejecuta al inicio
function init(){
	listar();
	limpiar();

	//Cargamos los items al select Agencia Emisora
	$.post("../ajax/ajax_consultas.php?op=selectRemitente", function(r){
	            $("#DNIremitente").html(r);
	            $('#DNIremitente').selectpicker('refresh');

	});

}

//Función limpiar
function limpiar()
{
	$("#DNIremitente").val("");
}



//Función Listar, se llama arriba de este mismo archivo en la funcion init
function listar()
{
	
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_final = $("#fecha_final").val();
	var DNIremitente = $("#DNIremitente").val();

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/ajax_consultas.php?op=consultaReciboFechaCliente',
					data:{ fecha_inicio: fecha_inicio, fecha_final: fecha_final, DNIremitente: DNIremitente },
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


init();