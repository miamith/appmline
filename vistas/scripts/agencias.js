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

    //Cargamos los items al select empleados de remitentes
    $.post("../ajax/ajax_agencias.php?op=selectEmpleado", function(r) {
        $("#responsable").html(r);
        $('#responsable').selectpicker('refresh');

    });

}


//Función generar CUENTA AGENCIA
function generarCuentaAgencia(responsable) {
    $.post("../ajax/ajax_agencias.php?op=generarNCPagencia", { responsable: responsable }, function(data, status) {
        data = JSON.parse(data);
        const ncp = '371' + data.DNI + '01';
        $("#ncp").val(ncp);
    });

}

//Función limpiar
function limpiar() {

    $("#idagencia").val("");
    $("#nombre").val("");
    $("#ciudad").val();
    $("#descripcion").val("");
    $("#max_cajas").val("");
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
            url: '../ajax/ajax_agencias.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [4, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_agencias.php?op=guardaryeditar",
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

function mostrar(idagencia) {
    $.post("../ajax/ajax_agencias.php?op=mostrar", { idagencia: idagencia }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idagencia").val(data.idagencia);
        $("#pais").val(data.idagencia);
        $("#pais").selectpicker('refresh');
        $("#ncp").val(data.ncp);
        $("#responsable").val(data.responsable);
        $("#responsable").selectpicker('refresh');
        $("#nombre").val(data.nombre);
        $("#ciudad").val(data.ciudad);
        $("#descripcion").val(data.descripcion);
        $("#max_cajas").val(data.max_cajas);

    });
}


//Función para eliminar registros
function eliminar(idagencia) {
    bootbox.confirm("¿Está Seguro de eliminar la agencia?", function(result) {
        if (result) {
            $.post("../ajax/ajax_agencias.php?op=eliminar", { idagencia: idagencia }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();