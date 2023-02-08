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
        $("#pais").html(r);
        $('#pais').selectpicker('refresh');
        //alert(r);

    });


    //Cargamos los items al select Agencia Emisora
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agenciaA").html(r);
        $('#agenciaA').selectpicker('refresh');
        //alert(r);

    });
}

//Función limpiar
function limpiar() {

    $("#idempleado").val("");

    $("#ap").val("");
    $("#DNIremitente").val("");
    $("#cargo").val("");
    $("#salario").val("");
    $("#nomcompleto").val("");
    $("#tel").val("");
    $("#ciudad").val("");
    $("#direccion").val("");
    $("#feinicioempleo").val("");
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
            url: '../ajax/ajax_empleado.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [1, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_empleado.php?op=guardaryeditar",
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
    $.post("../ajax/ajax_empleado.php?op=mostrar", { idempleado: idempleado }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#idempleado").val(data.idempleado);
        $("#ap").val(data.ap);
        $("#DNIremitente").val(data.DNI);
        $("#DNIremitente").attr('readonly', true);
        $("#cargo").val(data.cargo);
        $("#salario").val(data.salario);
        $("#nomcompleto").val(data.nomcompleto);
        $("#tel").val(data.tel);
        $("#direccion").val(data.direccion);
        $("#feinicioempleo").val(data.feinicioempleo);
        $("#pais").val(data.pais);
        $("#pais").selectpicker('refresh');
        $("#ciudad").val(data.ciudad);
        $("#interno").val(data.interno);
        $("#interno").selectpicker('refresh');
        $("#agenciaA").val(data.agencia_em);
        $("#agenciaA").selectpicker('refresh');

    });
}


//Función para eliminar registros
function eliminar(idempleado) {
    bootbox.confirm("¿Está seguro de eliminar el empleado?", function(result) {
        if (result) {
            $.post("../ajax/ajax_empleado.php?op=eliminar", { idempleado: idempleado }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}


// Buscar el el DIP y evitar repetirse
function validarDIP() {
    var DNIremitente = $("#DNIremitente").val();

    $.post("../ajax/ajax_empleado.php?op=validarDIP", { DNIremitente: DNIremitente }, function(data, status) {
        if (data != null & DNIremitente != "" & DNIremitente != " ") {
            data = JSON.parse(data);
            $("#DNIremitente").val("");
            bootbox.alert('Numero de DIP ya en uso, no se puede repetir, si es AGENTE SIMPLE añade 15 al final');

            //$("#DNIremitente").attr('readonly', true)
        }

    })

}

// Buscar el AP y evitar repetirse
function validarAP() {
    var ap = $("#ap").val();

    $.post("../ajax/ajax_empleado.php?op=validarAP", { ap: ap }, function(data, status) {
        if (data != null & ap != "" & ap != " ") {
            data = JSON.parse(data);
            $("#ap").val("");
            bootbox.alert('Login ya en uso, no se puede repetir, revisa la serie en empleados buscando');

            //$("#DNIremitente").attr('readonly', true)
        }

    })

}



init();