//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************

$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#Registrarse").click(function () {
        addOrUpdatechofer();
    });
    //agrega los eventos las capas necesarias
    $("#cancela").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormchofer();
        $("#typeActi").val("add_chofer");
        $("#myModalFormulario").modal();
    });
    
    
    
});

//*********************************************************************
//cuando el documento esta cargado se procede a cargar la información
//*********************************************************************

$(document).ready(function () {
    cargarTablas();
    
});

//*********************************************************************
//Agregar o modificar la información
//*********************************************************************

function addOrUpdatechofer() {
    //Se envia la información por ajax
    if (validarc()) {
        $.ajax({
            url: '../backend/controller/choferController.php',
            data: {
                action:             $("#typeActi").val(),
                Pk_Chofer:          $("#PK_cedula").val(),
                Personas_PK_cedula: $("#PK_cedula").val(),
                Vencimiento:        $("#inputVEN").val(),
                licencia:           $("#inputli").val()
                
            },
            error: function () { //si existe un error en la respuesta del ajax
                swal("Error", "Se presento un error al enviar la informacion", "error");
            },
            success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
                var messageComplete = data.trim();
                var responseText = messageComplete.substring(2);
                var typeOfMessage = messageComplete.substring(0, 2);
                if (typeOfMessage === "M~") { //si todo esta corecto
                    swal("Confirmacion", responseText, "success");
                    clearFormPersonas();
                    $("#dt_chofer").DataTable().ajax.reload();
                } else {//existe un error
                    swal("Error", responseText, "error");
                }
            },
            type: 'POST'
        });
    }else{
        swal("Error de validación", "Los datos del formulario no fueron digitados, por favor verificar", "error");
    }
}

//*****************************************************************
//*****************************************************************
function validarc() {
    var validacion = true;

    
    //valida cada uno de los campos del formulario
    //Nota: Solo si fueron digitados
    if ($("#PK_cedula").val() === "") {
        validacion = false;
    }

   
    if ($("#inputVEN").val() === "") {
        validacion = false;
    }

    if ($("#inputli").val() === "") {
        validacion = false;
    }




    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormchofer() {
    $('#formchofer').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormchofer();
    $("#typeAction").val("add_chofer");
    $("#myModalFormulario").modal("hide");
}



//*****************************************************************
//*****************************************************************

function showchoferByID(Pk_Chofer) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/choferController.php',
        data: {
            action: "show_chofer",
            Pk_Chofer: Pk_Chofer
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objchoferJSon = JSON.parse(data);
            $("#txtPK_cedula").val(objchoferJSon.Pk_Chofer);
            $("#txtnombre").val(objchoferJSon.nombre);
            $("#txtapellido1").val(objchoferJSon.apellido1);
            $("#txtapellido2").val(objchoferJSon.apellido2);
            $("#typeAction").val("update_chofer");
            
            swal("Confirmacion", "Los datos de la persona fueron cargados correctamente", "success");
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deletechoferByID(Pk_Chofer) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/choferController.php',
        data: {
            action: "delete_chofer",
            Pk_Chofer: Pk_Chofer
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al eliminar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.trim().substring(2);
            var typeOfMessage = data.trim().substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                swal("Confirmacion", responseText, "success");
                clearFormchofer();
                $("#dt_chofer").DataTable().ajax.reload();
            } else {//existe un error
                swal("Error", responseText, "error");
            }
        },
        type: 'POST'
    });
}




//*******************************************************************************
//Metodo para cargar las tablas
//*******************************************************************************


function cargarTablas() {



    var dataTablechofer_const = function () {
        if ($("#dt_chofer").length) {
            $("#dt_chofer").DataTable({
                dom: "Bfrtip",
                bFilter: false,
                ordering: false,
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm",
                        text: "Copiar"
                    },
                    {
                        extend: "csv",
                        className: "btn-sm",
                        text: "Exportar a CSV"
                    },
                    {
                        extend: "print",
                        className: "btn-sm",
                        text: "Imprimir"
                    }

                ],
                "columnDefs": [
                    {
                        targets: 10,
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showchoferByID(\''+row[0]+'\');">Cargar</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deletechoferByID(\''+row[0]+'\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 2,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../backend/controller/choferController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showAll_chofer"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_chofer').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };



    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTablechofer_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

//*******************************************************************************
//evento que reajusta la tabla en el tamaño de la pantall
//*******************************************************************************

window.onresize = function () {
    $('#dt_chofer').DataTable().columns.adjust().responsive.recalc();
};
