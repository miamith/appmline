var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardarRecibir(e);
    });

    //Cargamos los items al select Agencia Emisora
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agenciaA").html(r);
        $('#agenciaA').selectpicker('refresh');

    });
    //Cargamos los items al select Agencia Receptora
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agenciaB").html(r);
        $('#agenciaB').selectpicker('refresh');
    });

}

//Función limpiar
function limpiar() {

    $("#idtransaccion").val("");
    $("#idreceptor").val("");
    $("#nombreremitente").val("");
    $("#nombrereceptor").val("");
    $("#telefonorem").val("");
    $("#telefonorec").val("");
    $("#dirremitente").val("");
    $("#dirreceptor").val("");
    $("#DNIremitente").val("");
    $("#DNIreceptor").val("");
    $("#monto").val("");
    $("#descripcion").val("");
    $("#codigo").val("");
    $("#cobrar").val("");
    $("#comi_benef").val("");
    $("#comision").val("");
    $("#idbkhis").val("");


}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función Listar, se llama arriba de este mismo archivo en la funcion init
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/ajax_persona.php?op=listarRecibos',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [8, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardarRecibir(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_persona.php?op=guardarRecibir",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(idtransaccion, numero) {
    $.post("../ajax/ajax_persona.php?op=mostrarRecibo", { idtransaccion: idtransaccion }, function(data, status) {
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
        $("#comi_benef").val(data.comi_benef);
        $("#cobrar").val(data.cobrar);
        $("#monto").val(data.monto);
        $("#comision").val(data.comision);
        $("#descripcion").val(data.descripcion);
        $("#idtransaccion").val(data.idtransaccion);
        $("#idreceptor").val(data.idreceptor);
        $("#idbkhis").val(data.idbkhis);

        if (numero == 0) {
            $("#btnGuardar").prop("disabled", true);
            $("#DNIreceptor").attr('disabled', true);
        } else {
            //btnGuardar
        }



    });
}


// Buscar el codigo de un envio y rellenar el formulario mostrando el boton de Cobrar
function buscarEnvioClas() {
    var codigo = $("#codigo").val();
    $.post("../ajax/ajax_persona.php?op=buscarEnvio", { codigo: codigo }, function(data, status) {

        if (data != "null" & codigo != "" & codigo != " ") {
            data = JSON.parse(data);
            // console.log(data);
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
            //$("#comi_benef").val(data.comi_benef);
            //$("#cobrar").val(data.cobrar);
            //$("#monto").val(data.monto);
            //$("#comision").val(data.comision);
            $("#descripcion").val(data.descripcion);
            $("#idtransaccion").val(data.idtransaccion);
            $("#idreceptor").val(data.idreceptor);
            $("#idbkhis").val(data.idbkhis);
            $("#btnGuardar").prop("disabled", true);

            //$("#DNIremitente").attr('readonly', true)
        } else {
            limpiar();
            bootbox.alert('Codigo inexistente');
            $("#btnGuardar").prop("disabled", true);

        }
    })


}


// Buscar el MONTO A COBRAR y rellenar el formulario: monto, comision, comi_benef, cobrar
function verificarMontoCOBRAR() {
    var codigo = $("#codigo").val();
    var cobrar = $("#cobrar").val();

    $.post("../ajax/ajax_persona.php?op=verificarMontoCOBRAR", { codigo: codigo, cobrar: cobrar }, function(data, status) {

        if (data != "null" & codigo != "" & codigo != " ") {
            data = JSON.parse(data);
            $("#comi_benef").val(data.comi_benef);
            $("#cobrar").val(data.cobrar);
            $("#monto").val(data.monto);
            $("#comision").val(data.comision);
            $("#btnGuardar").prop("disabled", false);


            //$("#DNIremitente").attr('readonly', true)
        } else {
            //limpiar();
            $("#cobrar").val("");
            bootbox.alert('Monto no coincide, quedan 3 intentos posible bloqueo al fallar');
            $("#btnGuardar").prop("disabled", true);

        }
    })


}

// Buscar el codigo SECRETO de un envio y rellenar el formulario mostrando el boton de Cobrar
function verificarCodigoSECRETO() {
    var codigo = $("#codigo").val();
    var secreto = $("#secreto").val();

    $.post("../ajax/ajax_persona.php?op=verificarCodigoSECRETO", { codigo: codigo, secreto: secreto }, function(data, status) {

        if (data != "null" & codigo != "" & codigo != " ") {
            data = JSON.parse(data);
            $("#secretoOK").val(data.secreto);
            $("#btnGuardar").prop("disabled", false);

            //$("#DNIremitente").attr('readonly', true)
        } else {
            //limpiar();
            $("#secreto").val("");
            bootbox.alert('Codigo secreto invalido, quedan 3 intentos posible bloqueo al fallar');

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
	});
}
*/

init();