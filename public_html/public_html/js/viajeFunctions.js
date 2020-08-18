/* global a */

//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************

$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#enviar").click(function () {
        addOrUpdateViaje();
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormViaje();
        $("#typeAction").val("add_Viaje");
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

function addOrUpdateViaje() {
    //Se envia la información por ajax

    if (validar()) {
        $.ajax({
            url: '../backend/controller/viajeController.php',
            data: {
                action:             $("#typeAction").val(),
                PK_Viaje:           11,
                Personas_PK_cedula: 6,
                Chofer:             "Juan",
                Pasejero:           "Carlos",
                Km:                 $("#Dis").val(),
                LonIni:             $("#inputlong").val(),
                LatIni:             $("#inputlat").val(),
                LonFin:             $("#long").val(),
                LatFin:             $("#lat").val()
                
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
                    $("#dt_Viaje").DataTable().ajax.reload();
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
function validar() {
    var validacion = true;

    
    //valida cada uno de los campos del formulario
    //Nota: Solo si fueron digitados
    if ($("#Dis").val() === "") {
        validacion = false;
    }

    if ($("#inputlong").val() === "") {
        validacion = false;
    }

    if ($("#inputlat").val() === "") {
        validacion = false;
    }

    if ($("#long").val() === "") {
        validacion = false;
    }
    if ($("#lat").val() === "") {
        validacion = false;
    }



    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormPViaje() {
    $('#formViaje').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormViaje();
    $("#typeAction").val("add_Viaje");
    $("#myModalFormulario").modal("hide");
}



//*****************************************************************
//*****************************************************************

function showViajeByID(PK_Viaje) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/viajeController.php',
        data: {
            action: "show_Viaje",
            PK_Viaje: PK_Viaje
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objViajeJSon = JSON.parse(data);
            $("#txtPK_cedula").val(objViajeJSon.PK_cedula);
            $("#txtnombre").val(objViajeJSon.nombre);
            $("#txtapellido1").val(objViajeJSon.apellido1);
            $("#txtapellido2").val(objViajeJSon.apellido2);
            $("#txtfecNacimiento").val(objViajeJSon.fecNacimiento);
            $("#txtCorreo").val(objViajeJSon.Correo);
            $("#txtUsu").val(objViajeJSon.Usu);
            $("#txtContraseña").val(objViajeJSon.Contraseña);
            $("#txttel").val(objViajeJSon.tel);
            $("#typeAction").val("update_Viaje");
            
            swal("Confirmacion", "Los datos de la persona fueron cargados correctamente", "success");
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deleteViajeByID(PK_Viaje) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/viajeController.php',
        data: {
            action: "delete_Viaje",
            PK_Viaje: PK_Viaje
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al eliminar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.trim().substring(2);
            var typeOfMessage = data.trim().substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                swal("Confirmacion", responseText, "success");
                clearFormPersonas();
                $("#dt_Viaje").DataTable().ajax.reload();
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



    var dataTableViaje_const = function () {
        if ($("#dt_Viaje").length) {
            $("#dt_Viaje").DataTable({
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
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showViajeByID(\''+row[0]+'\');">Cargar</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deleteViajeByID(\''+row[0]+'\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 2,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../backend/controller/viajeController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showAll_Viaje"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_Viaje').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };



    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTableViaje_const();
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
    $('#dt_Viaje').DataTable().columns.adjust().responsive.recalc();
};
