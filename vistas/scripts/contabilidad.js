var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
// Etiqueta y ejecucion del Formulario comun
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});


}

//Función limpiar
function limpiar()
{
	
	$("#iding_gas").val("");
	$("#monto").val("");
	$("#fecrea").val("");
	$("#observacion").val("");
	$("#concepto").val("");
	$("#sentido").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar, se llama arriba de este mismo archivo en la funcion init
function listar()
{
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
					url: '../ajax/ajax_contabilidad.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 7, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ajax_contabilidad.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(iding_gas)
{
	$.post("../ajax/ajax_contabilidad.php?op=mostrar",{iding_gas : iding_gas}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#iding_gas").val(data.iding_gas);
		$("#monto").val(data.monto);
		$("#fecrea").val(data.fecrea);
		$("#observacion").val(data.observacion);
		$("#concepto").val(data.concepto);
		$("#sentido").val(data.sentido);
		$("#sentido").selectpicker('refresh');
		

 	});
}


//Función para eliminar registros
function eliminar(iding_gas)
{
	bootbox.confirm("¿Está Seguro de eliminar el concepto?", function(result){
		if(result)
        {
        	$.post("../ajax/ajax_contabilidad.php?op=eliminar", {iding_gas : iding_gas}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	});
}



init();