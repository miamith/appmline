var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });


    //Cargamos los items al select pais
    $.post("../ajax/ajax_agencias.php?op=selectPaises", function(r) {
        $("#pais").html(r);
        $('#pais').selectpicker('refresh');

    });

    //Cargamos los items al select Agencia Emisora
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agencia_cli").html(r);
        $('#agencia_cli').selectpicker('refresh');
        //alert(r);

    });

}

//Función generar CUENTA CLIENTE
function generarCuentaCliente(DNIremitente) {
    ncp = '372' + DNIremitente + '01';
    $("#ncp").val(ncp.replace(/[^\w]/gi, ''));
    $("#DNIremitente").val(DNIremitente.replace(/[^\w]/gi, ''));

}



//Función limpiar
function limpiar() {

    $("#mostrar").val("");
    $("#DNIremitente").val("");
    $("#nomcompleto").val("");
    $("#direccion").val("");
    $("#tel").val("");
    $("#ncp").val("");

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
            url: '../ajax/ajax_cliente.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [3, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_cliente.php?op=guardaryeditar",
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

function mostrar(DNIremitente) {
    $.post("../ajax/ajax_cliente.php?op=mostrar", { DNIremitente: DNIremitente }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#modif").val(data.DNIremitente);
        $("#nomcompleto").val(data.nomcompleto);
        $("#DNIremitente").val(data.DNIremitente);
        $("#DNIremitente").attr('readonly', true);
        $("#tel").val(data.tel);
        $("#pais").val(data.idagencia);
        $("#pais").selectpicker('refresh');
        $("#agencia_cli").val(data.agencia_cli);
        $("#agencia_cli").selectpicker('refresh');
        $("#direccion").val(data.direccion);
        $("#estado").val(data.estado);
        $("#estado").selectpicker('refresh');
        $("#ncp").val(data.numerocuenta);
        $("#ncp").attr('readonly', true);

    });
}



//Función para eliminar registros
function eliminar(DNIremitente) {
    bootbox.confirm("¿Está Seguro de eliminar el cliente?", function(result) {
        if (result) {
            $.post("../ajax/ajax_cliente.php?op=eliminar", { DNIremitente: DNIremitente }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();