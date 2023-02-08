var tabla;

//Función que se ejecuta al inicio
function init() {
    listar();
    limpiar();

    //Cargamos los items al select Agencia 
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agencia").html(r);
        $('#agencia').selectpicker('refresh');

    });

    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_usuarios.php?op=selectEmpleadoAP", function(r) {
        $("#ap").html(r);
        $('#ap').selectpicker('refresh');


    });

}

//Función limpiar
function limpiar() {
    $("#agencia").val("");
    $("#tipo").val("");
    $("#ap").val("");

}



//Función Listar, se llama arriba de este mismo archivo en la funcion init
function listar() {

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_final = $("#fecha_final").val();
    var codigo_ope = $("#codigo_ope").val();
    var agencia = $("#agencia").val();
    var ap = $("#ap").val();
    //var sumatoria = tabla.column(2).data().sum();

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
            url: '../ajax/ajax_consultas.php?op=consultaOperacionesFechaTipoAgenciaAP',
            data: { fecha_inicio: fecha_inicio, fecha_final: fecha_final, codigo_ope: codigo_ope, agencia: agencia, ap: ap },
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();


}


init();