var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });


    //Cargamos los items al select cliente
    $.post("../ajax/ajax_cliente.php?op=selectClientes", function(r) {
        $("#cliente").html(r);
        $('#cliente').selectpicker('refresh');


    });

    //Cargamos los items al select Agencia 
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agencialigada").html(r);
        $('#agencialigada').selectpicker('refresh');

    });

    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_cuentas.php?op=selectEmpleado", function(r) {
        $("#gestor").html(r);
        $('#gestor').selectpicker('refresh');

    });

}

//Función generar CUENTA CLIENTE
function generarCuentaClienteNCP(tipo_cuenta) {

    var cliente = $("#cliente").val();

    switch (tipo_cuenta) {
        case "CUENTA_CORRIENTE":
            ncp = '372' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_AHORRO":
            ncp = '373' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_COMISIONES":
            ncp = '999' + cliente + '02';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_AGENCIA":
            ncp = '371' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_IVA":
            ncp = '155' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_GASTOS":
            ncp = '888' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_CAPITAL":
            ncp = '999' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_PERDIDAS":
            ncp = '555' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;

    }

}



//Función limpiar
function limpiar() {

    $("#modif").val("");
    $("#numerocuenta").val("");
    $("#saldo").val("");

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
            url: '../ajax/ajax_cuentas.php?op=listar',
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
        url: "../ajax/ajax_cuentas.php?op=guardaryeditar",
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

function mostrar(numerocuenta) {
    var rolConnect = $("#rolConnect").val(); // captamos el rol conectado

    $.post("../ajax/ajax_cuentas.php?op=mostrar", { numerocuenta: numerocuenta }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#modif").val('1');
        $("#cliente").val(data.cliente);
        $("#cliente").attr('disabled', true);
        $("#cliente").selectpicker('refresh');
        $("#tipo_cuenta").val(data.tipo_cuenta);
        $("#tipo_cuenta").attr('disabled', true);
        $("#tipo_cuenta").selectpicker('refresh');
        $("#numerocuenta").val(data.numerocuenta);
        $("#agencialigada").val(data.agencialigada);
        $("#agencialigada").selectpicker('refresh');
        $("#gestor").val(data.gestor);
        $("#gestor").selectpicker('refresh');
        $("#saldo").val(data.saldo);
        $("#cuenta_cerrada").val(data.cuenta_cerrada);
        $("#cuenta_cerrada").selectpicker('refresh');

        if (rolConnect == 'Agencia' || rolConnect == 'CajeroUV') {
            $("#btnGuardar").hide();
        }

    });
}


//Función para eliminar registros
function eliminar(numerocuenta) {
    bootbox.confirm("¿Está Seguro de eliminar la cuenta?", function(result) {
        if (result) {
            $.post("../ajax/ajax_cuentas.php?op=eliminar", { numerocuenta: numerocuenta }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();