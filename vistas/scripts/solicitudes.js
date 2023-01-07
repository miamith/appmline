var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
// Etiqueta y ejecucion del Formulario comun
	$("#formulario").on("submit",function(e)
	{
		editar(e);
		//cancelar(e);	
	});

}

//Función limpiar
function limpiar()
{
	
	$("#idtransaccion").val("");
	$("#idtransaccionh").val("");
	$("#idbkhis").val("");
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
		$("#btnGuardarCancelar").prop("disabled",false);
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
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
					url: '../ajax/ajax_solicitudes.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 8, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar

function editar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ajax_solicitudes.php?op=editar",
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



//Función para cancelar
function cancelar() 
{ 
    var idtransacciCAN=$("#idtransaccionh").val();
	var idbkhisCAN=$("#idbkhiss").val();
	var idbkhishCAN=$("#idbkhish").val();
   // $(".mensaje").html(loader2+'<span class="label label-success">Forma de Pago guardada</span>'); 
    $.ajax({ 
        type: "POST", 
        dataType: 'html', 
        url: "../ajax/ajax_solicitudes.php?op=cancelar",
        data: "idtransaccionh="+idtransacciCAN+"&idbkhiss="+idbkhisCAN+"&idbkhish="+idbkhishCAN,
	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    } 
    }); 
    	
    	limpiar();
}


// Funcion Para restaurar los datos cancelados al estado original.
function restaurar() 
{ 
    	var DNIremitenteh=$("#DNIremitente").html();
		var nomcompletoch=$("#nomcompletoc").html();
		var telch=$("#telc").html();
		var direccionch=$("#direccionc").html();
		var DNIreceptorh=$("#DNIreceptor").html();
		var nomcomplerh=$("#nomcompler").html();
		var idreceptorh=$("#idreceptorh").html();
		var telrh=$("#telr").html();
		var direccionrh=$("#direccionr").html();
		var ageenviah=$("#ageenviaR").val();
		var agerecibeh=$("#agerecibeR").val();
		var tipoh=$("#tipoR").val();
		var montoh=$("#monto").html();
		var comisionh=$("#comision").html();
		var estadoth=$("#estadot").html();
		var descripcion=$("#descripcion").html();
		var agentcreh=$("#agentcre").html();
		var fecrea=$("#fecrea").html();
		var fechavalidacion=$("#fechavalidacion").html();
		var idtransaccionh=$("#idtransac").val();

   // $(".mensaje").html(loader2+'<span class="label label-success">Forma de Pago guardada</span>'); 
    $.ajax({ 
        type: "POST", 
        dataType: 'html', 
        url: "../ajax/ajax_solicitudes.php?op=restaurar",
        data: "idtransaccionh="+idtransaccionh+"&fechavalidacion="+fechavalidacion
        +"&fecrea="+fecrea+"&agentcreh="+agentcreh+"&descripcion="+descripcion
        +"&estadoth="+estadoth+"&comisionh="+comisionh
        +"&montoh="+montoh+"&tipoh="+tipoh
        +"&agerecibeh="+agerecibeh+"&ageenviah="+ageenviah+"&direccionrh="+direccionrh
        +"&telrh="+telrh+"&nomcomplerh="+nomcomplerh+"&idreceptorh="+idreceptorh
        +"&DNIreceptorh="+DNIreceptorh+"&direccionch="+direccionch+"&telch="+telch
        +"&nomcompletoch="+nomcompletoch+"&DNIremitenteh="+DNIremitenteh,
	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    } 
    }); 
    	
}


function mostrarbkhis(idtransaccionh)
{
	$.post("../ajax/ajax_solicitudes.php?op=mostrarbkhisOri",{idtransaccionh : idtransaccionh}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#DNIremitente").html(data.DNIremitenteh);
		$("#nomcompletoc").html(data.nomcompletoch);
		$("#telc").html(data.telch);
		$("#direccionc").html(data.direccionch);
		$("#DNIreceptor").html(data.DNIreceptorh);
		$("#nomcompler").html(data.nomcomplerh);
		$("#telr").html(data.telrh);
		$("#direccionr").html(data.direccionrh);
		if (data.ageenviah==1) { $("#ageenvia").html('Semu');}else if (data.ageenviah==2){$("#ageenvia").html('Bata')}else if (data.ageenviah==2){$("#ageenvia").html('Ebibeyin')}
		if (data.agerecibeh==1) { $("#agerecibe").html('Semu');}else if (data.agerecibeh==2){$("#agerecibe").html('Bata')}else if (data.agerecibeh==2){$("#agerecibe").html('Ebibeyin')}
		if (data.tipoh==1) { $("#tipo").html('Divisas');}else{$("#tipo").html('Paquete')}
		$("#ageenviaR").val(data.ageenviah);
		$("#agerecibeR").val(data.agerecibeh);
		$("#tipoR").val(data.tipoh);
		$("#monto").html(data.montoh);
		$("#comision").html(data.comisionh);
		$("#codigo").html(data.codigoh);
		$("#estadot").html(data.estadoth);
		$("#descripcion").html(data.descripcion);
		$("#agentcre").html(data.agentcreh);
		$("#fecrea").html(data.fecrea);
		$("#fechavalidacion").html(data.fechavalidacion);
		$("#idbkhiss").val(data.idbkhis);
 	});

 		$.post("../ajax/ajax_solicitudes.php?op=mostrarbkhisCam",{idtransaccionh : idtransaccionh}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#DNIremitenteh").html(data.DNIremitenteh);
		$("#nomcompletoch").html(data.nomcompletoch);
		$("#telch").html(data.telch);
		$("#direccionch").html(data.direccionch);
		$("#DNIreceptorh").html(data.DNIreceptorh);
		$("#nomcomplerh").html(data.nomcomplerh);
		$("#telrh").html(data.telrh);
		$("#direccionrh").html(data.direccionrh);
		if (data.ageenviah==1) { $("#ageenviah").html('Semu');}else if (data.ageenviah==2){$("#ageenviah").html('Bata')}else if (data.ageenviah==2){$("#ageenviah").html('Ebibeyin')}
		if (data.agerecibeh==1) { $("#agerecibeh").html('Semu');}else if (data.agerecibeh==2){$("#agerecibeh").html('Bata')}else if (data.agerecibeh==2){$("#agerecibeh").html('Ebibeyin')}
		if (data.tipoh==1) { $("#tipoh").html('Divisas');}else{$("#tipoh").html('Paquete')}
		$("#montoh").html(data.montoh);
		$("#comisionh").html(data.comisionh);
		$("#codigoh").html(data.codigoh);
		$("#estadoth").html(data.estadoth);
		$("#descripcionh").html(data.descripcion);
		$("#agentcreh").html(data.agentcreh);
		$("#fecreah").html(data.fecrea);
		$("#fechavalidacionh").html(data.fechavalidacion);
		$("#idtransaccionh").val(data.idtransaccionh);
        $("#idbkhish").val(data.idbkhis);

        if (data.estadoth=="Rechazado" || data.estadoth=="Cancelado" || data.estadoth=="Pendiente") {
			$("#btnGuardar").prop("disabled",true);
			$("#btnRechazar").prop("disabled",true);
		}else {
			$("#btnGuardar").prop("disabled",false);
			$("#btnRechazar").prop("disabled",false);
		}
 	});
}


//Función para eliminar registros
function eliminar(idbkhish)
{

	bootbox.confirm("¿Está Seguro de eliminar la solicitud?", function(result){
		if(result)
        {
        	$.post("../ajax/ajax_solicitudes.php?op=eliminar", {idbkhish : idbkhish}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	});
}



init();