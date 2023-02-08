var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $("#btnDebitar").hide(); // MANEJAR COMISIONES OCULTO AL INCIAR
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    $("#formularioOperarAgencia").on("submit", function(e) {
        debitarCreditarAgencia(e);
    });


    //Cargamos los items al select cliente
    $.post("../ajax/ajax_cliente.php?op=selectClientes", function(r) {
        $("#cliente").html(r);
        $('#cliente').selectpicker('refresh');
        $("#clienteremitente").html(r);
        $('#clienteremitente').selectpicker('refresh');
        $("#clientebeneficiario").html(r);
        $('#clientebeneficiario').selectpicker('refresh');

    });

    //Cargamos los items al select Agencia 
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agencia").html(r);
        $('#agencia').selectpicker('refresh');
        $("#agenciaremitente").html(r);
        $('#agenciaremitente').selectpicker('refresh');
        $("#agenciabeneficiaria").html(r);
        $('#agenciabeneficiaria').selectpicker('refresh');
        //alert(r);

    });



    //Cargamos los items al select pais
    $.post("../ajax/ajax_agencias.php?op=selectPaises", function(r) {
        $("#pais").html(r);
        $('#pais').selectpicker('refresh');

    });

    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_agencias.php?op=selectEmpleado", function(r) {
        $("#responsable").html(r);
        $('#responsable').selectpicker('refresh');

    });
    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_agencias.php?op=selectEmpleado", function(r) {
        $("#responsableMline").html(r);
        $('#responsableMline').selectpicker('refresh');

    });


}

function ponerNCPclienteRemitente() {
    var clienteremitente = $("#clienteremitente").val();
    var tipo = $("#tipo").val();
    $.post("../ajax/ajax_cajas.php?op=ponerNCPclienteRemitente", { clienteremitente: clienteremitente }, function(data, status) {
        data = JSON.parse(data);

        if (data) {
            $('#agenciaremitente').val(data.agencia_em);
            $('#agenciaremitente').selectpicker('refresh');

            $("#paisorigen").val(data.pais);

            //Popular la lista de cuentas de cada cliente seleccionado
            $.post("../ajax/ajax_cuentas.php?op=selectCuentasRemitente", { clienteremitente: clienteremitente }, function(r) {
                $("#ncpremitente").html(r);
                $('#ncpremitente').selectpicker('refresh');

            });
        }


    });
}

// Traer el saldo actual de la cuenta seleccionada del cliente
function traerSaldoActual(numerocuenta) {

    $.post("../ajax/ajax_cuentas.php?op=traerSaldoActual", { numerocuenta: numerocuenta }, function(data, status) {
        data = JSON.parse(data);
        $("#saldoremitente").val(data.saldo);

    })

}


function ponerNCPclienteBeneficiario() {
    var clientebeneficiario = $("#clientebeneficiario").val();
    var tipo = $("#tipo").val();
    $.post("../ajax/ajax_cajas.php?op=ponerNCPclienteBeneficiario", { clientebeneficiario: clientebeneficiario, tipo: tipo }, function(data, status) {
        data = JSON.parse(data);
        if (data) {
            $('#agenciabeneficiaria').val(data.agencia_em);
            $('#agenciabeneficiaria').selectpicker('refresh');

            $("#paisdestino").val(data.pais);

            //Popular la lista de cuentas de cada cliente seleccionado
            $.post("../ajax/ajax_cuentas.php?op=selectCuentasBeneficiaria", { clientebeneficiario: clientebeneficiario }, function(r) {
                $("#ncpbeneficiaria").html(r);
                $('#ncpbeneficiaria').selectpicker('refresh');


            });
        }

    });
}

//Función para verificar numeros de DNI a que no sean iguales
function verificarNCP() {
    var saldoremitente = 0;
    var monto = 0;
    var ncpremitente = $("#ncpremitente").val();
    var ncpbeneficiaria = $("#ncpbeneficiaria").val();
    saldoremitente = $("#saldoremitente").val();
    monto = $("#monto").val();

    if (ncpremitente == ncpbeneficiaria) {
        bootbox.alert("El beneficiario no puede ser el remitente");
    }

    if (parseInt(monto) > parseInt(saldoremitente)) {
        bootbox.alert("Saldo insuficiente");
    }


}


//Función para Operar en la CAJA
function debitarCreditarAgencia(e) {

    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardarOpeAgencia").prop("disabled", true);
    var formData = new FormData($("#formularioOperarAgencia")[0]);
    //for (var value of formData.values()) { console.log(value); }
    $.ajax({
        url: "../ajax/ajax_agencias.php?op=debitarCreditarAgencia",
        type: "POST",
        data: formData,
        //data: "mensaje="+mensaje+"&descripcionsms="+descripcionsms+"&idtransaccion="+idtransaccion,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            $("#MODALOperarAgencia").modal('hide');
            //tabla.ajax.reload();
            limpiarOpeAgencia();
        }

    });

}

//Función limpiar
function limpiarOpeAgencia() {

    $("#idAgenciaOP").val("");
    $("#ncpremitente").val("");
    $("#saldoremitente").val("");
    $("#ncpbeneficiaria").val("");
    $("#monto").val("");
    $("#descripcion").val("");

}



// Enviar mensaje de solicitud al administrador de modificar envio
function MODALOperarAgencia() {
    var idAgenciaOP = $("#idagencia").val();
    $("#idAgenciaOP").val(idAgenciaOP);
    $("#MODALOperarAgencia").modal(true);

}








//Función generar CUENTA AGENCIA Y VERIFICAR SI ES ROL AGENCIA EL USUARIO
function generarCuentaAgencia() {
    var responsable = $("#responsable").val();
    $.post("../ajax/ajax_agencias.php?op=generarNCPagencia", { responsable: responsable }, function(data, status) {
        data = JSON.parse(data);
        if (data != null) {

            const ncp = '372' + data.DNI + '01';
            const ncpCM = '999' + data.DNI + '02';
            $("#ncp").val(ncp);
            $("#ncpComisiones").val(ncpCM);
        } else {

            bootbox.alert("El usuario elegido no tiene ROL Gerente o Agencia M o S");
            $("#responsable").val("");



        }

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
    $("#ncpComisiones").val("");

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
        $("#btnDebitar").hide();
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
    var rolConnect = $("#rolConnect").val(); // captamos el rol conectado

    $.post("../ajax/ajax_agencias.php?op=mostrar", { idagencia: idagencia }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#btnDebitar").show();

        $("#idagencia").val(data.idagencia);
        $("#pais").val(data.idagencia);
        $("#pais").selectpicker('refresh');
        $("#ncp").val(data.ncp);
        $("#ncpComisiones").val(data.ncpComisiones);
        $("#responsable").val(data.responsable);
        $("#responsable").selectpicker('refresh');
        $("#responsableMline").val(data.responsableMline);
        $("#responsableMline").selectpicker('refresh');
        $("#nombre").val(data.nombre);
        $("#ciudad").val(data.ciudad);
        $("#descripcion").val(data.descripcion);
        $("#max_cajas").val(data.max_cajas);

        if (rolConnect == 'Agencia' || rolConnect == 'CajeroUV') {
            $("#btnGuardar").hide();

        }

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