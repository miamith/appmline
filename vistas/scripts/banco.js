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

    $("#formularioOperarBanco").on("submit", function(e) {
        CrearSaldoUV(e);
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

    //Cargamos los items al select cliente
    $.post("../ajax/ajax_cliente.php?op=selectClientes", function(r) {
        $("#nombreBeneficiario").html(r);
        $('#nombreBeneficiario').selectpicker('refresh');

    });




}



// Traer el saldo actual de la cuenta seleccionada del cliente
function traerSaldoActual() {
    let numerocuenta = $("#ncp").val();

    $.post("../ajax/ajax_cuentas.php?op=traerSaldoActual", { numerocuenta: numerocuenta }, function(data, status) {

        data = JSON.parse(data);
        $("#saldoCapital").val(data.saldo);
        $("#nombreBeneficiario").val(data.cliente);
        $('#nombreBeneficiario').selectpicker('refresh');


    })

}





//Función para Operar en la CAJA
function CrearSaldoUV(e) {

    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardarOpeBanco").prop("disabled", true);
    var formData = new FormData($("#formularioOperarBanco")[0]);
    //for (var value of formData.values()) { console.log(value); }
    $.ajax({
        url: "../ajax/ajax_banco.php?op=CrearSaldoUV",
        type: "POST",
        data: formData,
        //data: "mensaje="+mensaje+"&descripcionsms="+descripcionsms+"&idtransaccion="+idtransaccion,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            $("#MODALOperarBanco").modal('hide');
            tabla.ajax.reload();
            limpiarOpeBanco();
        }

    });

}

//Función limpiar
function limpiarOpeBanco() {

    $("#idBancoOP").val("");
    $("#monto").val("");
    $("#descripcion").val("");
    $("#banco").val("");
    $("#nombreBeneficiario").val("");
    $("#ncpCREDITAR").val("");
}

/* 
function TestNom() {
    alert($("#nombreBeneficiario").val());
} */

// Enviar mensaje de solicitud al administrador de modificar envio
function MODALOperarBanco() {
    var idbancoOP = $("#idbanco").val();
    var nombreOP = $("#nombre").val();
    var ncpOP = $("#ncp").val();
    $("#idbancoOP").val(idbancoOP);
    $("#banco").val(nombreOP);
    $("#ncpCREDITAR").val(ncpOP);
    $("#nombreBeneficiario").attr('readonly', true);
    $("#MODALOperarBanco").modal(true);

}





//Función generar CUENTA AGENCIA
function generarNCPCreaBanco(responsable) {
    $.post("../ajax/ajax_banco.php?op=generarNCPCreaBanco", { responsable: responsable }, function(data, status) {
        data = JSON.parse(data);

        const ncpCAPITAL = '999' + data.DNI + '01';
        const ncpCOMISIONES = '999' + data.DNI + '02';
        const ncpIVA = '999' + data.DNI + '03';

        $("#ncp").val(ncpCAPITAL);
        $("#ncpComisiones").val(ncpCOMISIONES);
        $("#ncpIVA").val(ncpIVA);



    });

}

//Función limpiar
function limpiar() {

    $("#idbanco").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#max_agencias").val("");
    $("#ncp").val("");
    $("#ncpComisiones").val("");
    $("#ncpIVA").val("");

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
            url: '../ajax/ajax_banco.php?op=listar',
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
        url: "../ajax/ajax_banco.php?op=guardaryeditar",
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




function mostrar(idbanco) {
    var rolConnect = $("#rolConnect").val(); // captamos el rol conectado ESTA EN EL HEadeR

    $.post("../ajax/ajax_banco.php?op=mostrar", { idbanco: idbanco }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#btnDebitar").show();

        $("#idbanco").val(data.idbanco);
        $("#pais").val(data.idbanco);
        $("#pais").selectpicker('refresh');
        $("#ncp").val(data.ncp);
        $("#ncpComisiones").val(data.ncpComisiones);
        $("#ncpIVA").val(data.ncpIVA);
        $("#responsable").val(data.responsable);
        $("#responsable").selectpicker('refresh');
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#max_agencias").val(data.max_agencias);

        // Aqui mandamos el saldo actaul al campo del modal


        if (rolConnect == 'Agencia' || rolConnect == 'CajeroUV') {
            $("#btnGuardar").hide();

        }

    });
}


//Función para eliminar registros
function eliminar(idbanco) {
    bootbox.confirm("¿Está Seguro de eliminar la banco?", function(result) {
        if (result) {
            $.post("../ajax/ajax_banco.php?op=eliminar", { idbanco: idbanco }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();