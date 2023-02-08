var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

}

//Función limpiar
function limpiar() {

    $("#idpais").val("");
    $("#nompais").val("");
    $("#descripcion").val("");
    $("#limienviolocal").val("");
    $("#limienvioint").val("");
    $("#moneda").val("");
    $("#iva").val("");
    $("#porcenenvio").val("");
    $("#porcenrecibir").val("");
    $("#porcenenviopaq").val("");
    $("#porcenrecibirpaq").val("");
    $("#partnerapi").val("");
    $("#prefijoTel").val("");

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
            url: '../ajax/ajax_pais.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [2, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_pais.php?op=guardaryeditar",
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

function mostrar(idpais) {
    $.post("../ajax/ajax_pais.php?op=mostrar", { idpais: idpais }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idpais").val(data.idPais);
        $("#nompais").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#limitenviolocal").val(data.limite_envioLOCAL);
        $("#limitenvioint").val(data.limite_envioINT);
        $("#moneda").val(data.moneda);
        $("#iva").val(data.IVA);
        $("#porcenenvio").val(data.porcenENVIO);
        $("#porcenrecibir").val(data.porcenRECIBIR);
        $("#porcenenviopaq").val(data.porcenENVIO_PAQ);
        $("#porcenrecibirpaq").val(data.porcenRECI_PAQ);
        $("#partnerapi").val(data.partnerAPI);
        $("#prefijoTel").val(data.prefijoTel);

    });
}


//Función para eliminar registros
function eliminar(idpais) {
    bootbox.confirm("¿Está Seguro de eliminar el pais?", function(result) {
        if (result) {
            $.post("../ajax/ajax_pais.php?op=eliminar", { idpais: idpais }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}



init();