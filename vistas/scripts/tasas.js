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
    $.post("../ajax/ajax_tasas.php?op=selectPaises", function(r) {
        $("#pais_origen").html(r);
        $('#pais_origen').selectpicker('refresh');

    });
    //Cargamos los items al select pais
    $.post("../ajax/ajax_tasas.php?op=selectPaises", function(r) {
        $("#pais_destino").html(r);
        $('#pais_destino').selectpicker('refresh');

    });


}


//Función limpiar
function limpiar() {
    $("#idTasas").val("");
    $("#Descripcion").val("");
    $("#Monto1").val("");
    $("#Monto2").val("");
    $("#comisiont").val("");
    $("#MontoKILO").val("");
    $("#MontoSOBRE").val("");
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
            url: '../ajax/ajax_tasas.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [1, "asc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_tasas.php?op=guardaryeditar",
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

function mostrar(idTasas) {
    $.post("../ajax/ajax_tasas.php?op=mostrar", { idTasas: idTasas }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idTasas").val(data.idTasas);
        $("#pais_origen").val(data.pais_origen);
        $("#pais_origen").selectpicker('refresh');
        $("#pais_destino").val(data.pais_destino);
        $("#pais_destino").selectpicker('refresh');
        $("#Descripcion").val(data.Descripcion);
        $("#Monto1").val(data.Monto1);
        $("#Monto2").val(data.Monto2);
        $("#comisiont").val(data.comisiont);
        $("#MontoKILO").val(data.MontoKILO);
        $("#MontoSOBRE").val(data.MontoSOBRE);

    });
}


//Función para eliminar registros
function eliminar(idTasas) {
    bootbox.confirm("¿Está Seguro de eliminar la tasa?", function(result) {
        if (result) {
            $.post("../ajax/ajax_tasas.php?op=eliminar", { idTasas: idTasas }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();