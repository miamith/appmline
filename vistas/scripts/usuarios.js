var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_usuarios.php?op=selectEmpleado", function(r) {
        $("#ap").html(r);
        $('#ap').selectpicker('refresh');


    });

    //Mostramos los permisos
    $.post("../ajax/ajax_usuarios.php?op=permisos&id=", function(r) {
        $("#permisos").html(r);

    });

}

//Función limpiar
function limpiar() {
    $("#apU").val("");
    $("#password").val("");
    $("#condicion").val("");
    $("#idempleado").val("");

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
            url: '../ajax/ajax_usuarios.php?op=listar',
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
        url: "../ajax/ajax_usuarios.php?op=guardaryeditar",
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

function mostrar(idempleado) {

    $.post("../ajax/ajax_usuarios.php?op=mostrar", { idempleado: idempleado }, function(data, status) {

        //idempleado,ap,password,condicion
        data = JSON.parse(data);
        mostrarform(true);

        $("#apU").val(data.ap);
        $("#password").val(data.password);
        $("#ap").val(data.idempleado);
        $("#ap").selectpicker('refresh');
        $("#condicion").val(data.condicion);
        $("#condicion").selectpicker('refresh');
        $("#idempleado").val(data.idempleado);

    });

    $.post("../ajax/ajax_usuarios.php?op=permisos&id=" + idempleado, function(r) {
        $("#permisos").html(r);
    });
}


//Función para eliminar registros
function eliminar(idempleado) {
    bootbox.confirm("¿Está Seguro de eliminar el usuario?", function(result) {
        if (result) {
            $.post("../ajax/ajax_usuarios.php?op=eliminar", { idempleado: idempleado }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();