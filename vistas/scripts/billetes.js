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

	//Cargamos los items al select agencia 
	$.post("../ajax/ajax_billete.php?op=selectAgencia", function(r){
	            $("#agencia").html(r);
	            $('#agencia').selectpicker('refresh');

	});
	//Cargamos los items al select ruta
	$.post("../ajax/ajax_billete.php?op=selectRuta", function(r){
	            $("#ruta").html(r);
	            $('#ruta').selectpicker('refresh');
	});

}

//Función limpiar
function limpiar()
{
	
	$("#idbillete").val("");
	$("#company").val("");
	$("#fechaemision").val("");
	$("#fesali").val("");
	$("#fevuel").val("");
	$("#numvuel").val("");
	$("#nompasa").val("");
	$("#DNIremitente").val("");
	$("#localiz").val("");
	$("#precio").val("");
	$("#descripcion").val("");
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
					url: '../ajax/ajax_billete.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 12, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ajax_billete.php?op=guardaryeditar",
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

function mostrar(idbillete)
{
	$.post("../ajax/ajax_billete.php?op=mostrar",{idbillete : idbillete}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idbillete").val(data.idbillete);
		$("#company").val(data.company);
		$("#fechaemision").val(data.fechaemision);
		$("#fesali").val(data.fesali);
		$("#fevuel").val(data.fevuel);
		$("#numvuel").val(data.numvuel);
		$("#DNIremitente").val(data.DNIremitente);
		$("#nompasa").val(data.nomcompleto);
		$("#ruta").val(data.ruta);
		$("#ruta").selectpicker('refresh');
		$("#agencia").val(data.agencia);
		$("#agencia").selectpicker('refresh');
		$("#localiz").val(data.localiz);
		$("#precio").val(data.precio);
		$("#descripcion").val(data.descripcion);

 	});
}


//Función para eliminar registros
function eliminar(idbillete)
{
	bootbox.confirm("¿Está Seguro de eliminar el billete?", function(result){
		if(result)
        {
        	$.post("../ajax/ajax_billete.php?op=eliminar", {idbillete : idbillete}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	});
}



init();