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


	//Cargamos los items al select Agencia Emisora
	$.post("../ajax/ajax_persona.php?op=selectAgenciaEmpleado", function(r){
	            $("#agenciaA").html(r);
	            $('#agenciaA').selectpicker('refresh');

	});
	//Cargamos los items al select Agencia Receptora
	$.post("../ajax/ajax_persona.php?op=selectAgenciaReceptora", function(r){
	            $("#agenciaB").html(r);
	            $('#agenciaB').selectpicker('refresh');

	});

}

//Función limpiar
function limpiar()
{
	
	$("#idtransaccion").val("");
	$("#idreceptor").val("");
	$("#nombreremitente").val("");
	$("#nombrereceptor").val("");
	$("#telefonorem").val("");
	$("#telefonorec").val("");
	$("#dirremitente").val("");
	$("#dirreceptor").val("");
	$("#DNIremitente").val("");
	$("#DNIremitente").attr('readonly', true);
	$("#DNIreceptor").val("");
	$("#monto").val("");
	$("#comision").val("");
	$("#descripcion").val("");
	$("#existeR").val("");
    $("#existeC").val("");
    $("#codigo").val("");
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
		$("#DNIremitente").attr('readonly', false);
		$("#monto").attr('readonly', false);
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
					url: '../ajax/ajax_persona.php?op=listarEnvios',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 9, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ajax_persona.php?op=guardaryeditar",
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


/*/////////////////// INSERCION COPIA SOLO ENVIO /////////////////////////
function insertarCopia() 
{ 
	//alert("Hola");
   $("#btnGuardarcopiaE").prop("disabled",true);
   var formData = new FormData($("#formulario")[0]);

	var igual = $("#idreceptor").val();
	var igual = $("#nombreremitente").val();
	var igual = $("#nombrereceptor").val();
	var igual = $("#telefonorem").val();
	var igual = $("#telefonorec").val();
	var igual = $("#dirremitente").val();
	var igual = $("#dirreceptor").val();
	var igual = $("#DNIremitente").val();
	var igual = $("#DNIreceptor").val();
	var igual = $("#monto").val();
	var igual = $("#comision").val();
	var igual = $("#descripcion").val();
	var agenciaA = $("select#agenciaA").val();
	var agenciaB = $("select#agenciaB").val();

     $.ajax({ 
        type: "POST", 
        dataType: 'html', 
       url: "../ajax/ajax_persona.php?op=guardarcopia",
       data:formData,
       contentType: false,
	   processData: false,
       //data: "cuenta="+plaCuent+"&FD="+plaFD+"&analista="+plaAnalis+"&FIni="+plaFIni+"&FVA="+plaFVA+"&FVRes="+plaFVRes+"&FCDCC="+plaFCDCC+"&NumDCC="+plaNumDCC+"&FNotif="+plaFNotif+"&FEchea="+plaFEchea+"&ValFin="+plaValFin+"&operador="+plaOperador+"&comenta="+plaComentario,
        success: function(resp){
	          bootbox.alert(resp);	          
	          mostrarform(false);
	          tabla.ajax.reload();
        } 
    }); 
  limpiar();
}
*/


function mostrar(idtransaccion)
{
	$.post("../ajax/ajax_persona.php?op=mostrar",{idtransaccion : idtransaccion}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombreremitente").val(data.nombreremitente);
		$("#nombrereceptor").val(data.nombrereceptor);
		$("#telefonorem").val(data.telefonorem);
		$("#telefonorec").val(data.telefonorec);
		$("#dirremitente").val(data.dirremitente);
		$("#dirreceptor").val(data.dirreceptor);
		$("#DNIremitente").val(data.DNIremitente);
		$("#DNIremitente").attr('readonly', true);
		$("#DNIreceptor").val(data.DNIreceptor);
		$("#tipo").val(data.tipo);
		$("#tipo").selectpicker('refresh');
		$("#agenciaA").val(data.agenciaA);
		$("#agenciaA").selectpicker('refresh');
		$("#agenciaB").val(data.agenciaB);
		$("#agenciaB").selectpicker('refresh');
		$("#monto").val(data.monto);
		$("#comision").val(data.comision);
		$("#monto").attr('readonly', true);
		$("#descripcion").val(data.descripcion);
		$("#idtransaccion").val(data.idtransaccion);
		$("#idreceptor").val(data.idreceptor);
		$("#codigoAc").val(data.codigo);
		$("#nombreRSINO").html(''); // En el buscador de nombres
		$("#nombreSINO").html(''); // En el buscador

		 if (data.estadot=="Recibido" || data.estadot=="Cancelado" || data.estadot=="Revalidar"  ) {
			$("#btnGuardar").prop("disabled",true);
		}else {
			$("#btnGuardar").prop("disabled",false);}
 	})
}

// Ponerle la comision recibida en el input directamente en tiempo real
function comisiones(monto) {
	$.post("../ajax/ajax_persona.php?op=ponerComisiones",{monto : monto}, function(data, status)
	{
		
		data = JSON.parse(data);
			$("#comision").val(data.comisiont);	  
 	})


}

// Ponerle la comision recibida en el input directamente en tiempo real // nomcompleto,tel,direccion,DNIremitente
function buscarRemitenteRellenarNuevo(nomcompleto) {

	$.post("../ajax/ajax_persona.php?op=buscarRemitenteRellenarNuevo",{nomcompleto : nomcompleto}, function(data, status)
	{
		
		if (data!="null" & nomcompleto!="" & nomcompleto!=" ") {
			data = JSON.parse(data);
						$("#telefonorem").val(data.tel);
						$("#dirremitente").val(data.direccion);
						$("#DNIremitente").val(data.DNIremitente);
						$("#DNIremitente").attr('readonly', true);
						$("#nombreSINO").html(data.nomcompleto);
						$("#existeR").val("1");
			} else{
					data = JSON.parse(data);
					$("#telefonorem").val("");
					$("#dirremitente").val("");
					$("#DNIremitente").val("");
					$("#DNIremitente").attr('readonly', false);
					$("#nombreSINO").html('<i class="label label-danger">No existe</i>');
					$("#existeR").val("");

			}		  
 	})


}

// Poner datos receptor directamente en tiempo real // nomcompler,tel,direccion,DNIremitente
function buscarReceptorRellenarNuevo(nomcompler) {

	$.post("../ajax/ajax_persona.php?op=buscarReceptorRellenarNuevo",{nomcompler : nomcompler}, function(data, status)
	{
		
		if (data!="null" & nomcompler!="" & nomcompler!=" ") {
			data = JSON.parse(data);
						$("#telefonorec").val(data.telr);
						$("#idreceptor").val(data.idreceptor);
						$("#dirreceptor").val(data.direccionr);
						$("#DNIreceptor").val(data.DNIreceptor);
						$("#DNIreceptor").attr('readonly', true);
						$("#nombreRSINO").html(data.nomcompler);
						$("#existeC").val("1");
			} else{
					data = JSON.parse(data);
					$("#telefonorec").val("");
					$("#dirreceptor").val("");
					$("#DNIreceptor").val("");
					$("#DNIreceptor").attr('readonly', false);
					$("#nombreRSINO").html('<i class="label label-danger">No existe</i>');
					$("#existeC").val("");

			}		  
 	})


}
//Función para eliminar registros
/*function eliminar(idtransaccion)
{
	bootbox.confirm("¿Está Seguro de eliminar o cancelar el envio?", function(result){
		if(result)
        {
        	$.post("../ajax/ajax_persona.php?op=eliminar", {idtransaccion : idtransaccion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}*/

//Función limpiar sms modal
function limpiarsms()
{
	
	$("#mensaje").val("");
	$("#descripcionsms").val("");
	$("#idsolicitud").val("");
	$("#monantes").val("");
	$("#idtransaccionsms").val("");
}


//Función para verificar numeros de DNI a que no sean iguales
function verificarDNI() {

	var DNIreceptor=$("#DNIreceptor").val();
	var DNIremitente=$("#DNIremitente").val();

	if (DNIremitente==DNIreceptor) {
      alert("El DNI del remitente no puede ser igual al del receptor");
      $("#DNIreceptor").val("");
	}

}

//Función para guardar o editar
/*function smsSolicitudValidacion()
{

	var formData = new FormData($("#formulariosms")[0]);
	$.ajax({
		url: "../ajax/ajax_persona.php?op=smsSolicitudValidar",
	    type: "POST",
	    data:formData,
	    //data: "mensaje="+mensaje+"&descripcionsms="+descripcionsms+"&idtransaccion="+idtransaccion,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);
	          limpiarsms();
	          $("#myModal").modal('hide');
	          tabla.ajax.reload();
	    }

	});

}*/


// Enviar mensaje de solicitud al administrador de modificar envio
/*function enviarsms(idtransaccion,monantes) {
		$("#idtransaccionsms").val(idtransaccion);
		$("#monantes").val(monantes);
		//$("#myModal").modal(true);

}*/

init();