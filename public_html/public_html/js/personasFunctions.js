//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************

$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#enviar").click(function () {
        addOrUpdatePersonas();
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormPersonas();
        $("#typeAction").val("add_personas");
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

function addOrUpdatePersonas() {
    //Se envia la información por ajax
    if (validarp()) {
        $.ajax({
            url: '../backend/controller/personasController.php',
            data: {
                action:         $("#typeAction").val(),
                PK_cedula:      $("#txtPK_cedula").val(),
                nombre:         $("#txtnombre").val(),
                apellido1:      $("#txtapellido1").val(),
                apellido2:      $("#txtapellido2").val(),
                fecNacimiento:  $("#txtfecNacimiento").val(),
                Correo:         $("#txtCorreo").val(),
                Usu:            $("#txtUsu").val(),
                Contrasena:     $("#txtContrasena").val(),
                tel:            $("#txttel").val(),
                TipoUsuario:    "Pasajero"
                
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
function validarp() {
    var validacion = true;

    
    //valida cada uno de los campos del formulario
    //Nota: Solo si fueron digitados
    if ($("#txtPK_cedula").val() === "") {
        validacion = false;
    }

    if ($("#txtnombre").val() === "") {
        validacion = false;
    }

    if ($("#txtapellido1").val() === "") {
        validacion = false;
    }

    if ($("#txtapellido2").val() === "") {
        validacion = false;
    }

    if ($("#txtfecNacimiento").val() === "") {
        validacion = false;
    }

    if ($("#txtCorreo").val() === "") {
        validacion = false;
    }

    if ($("#txtUsu").val() === "") {
        validacion = false;
    }
    if ($("#txtContrasena").val() === "") {
        validacion = false;
    }
    if ($("#txttel").val() === "") {
        validacion = false;
    }

 



    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormPersonas() {
    $('#formPersonas').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormPersonas();
    $("#typeAction").val("add_personas");
    $("#myModalFormulario").modal("hide");
}



//*****************************************************************
//*****************************************************************

function showPersonasByID(PK_cedula) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/personasController.php',
        data: {
            action: "show_personas",
            PK_cedula: PK_cedula
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objPersonasJSon = JSON.parse(data);
            $("#txtPK_cedula").val(objPersonasJSon.PK_cedula);
            $("#txtnombre").val(objPersonasJSon.nombre);
            $("#txtapellido1").val(objPersonasJSon.apellido1);
            $("#txtapellido2").val(objPersonasJSon.apellido2);
            $("#txtfecNacimiento").val(objPersonasJSon.fecNacimiento);
            $("#txtCorreo").val(objPersonasJSon.Correo);
            $("#txtUsu").val(objPersonasJSon.Usu);
            $("#txtContraseña").val(objPersonasJSon.Contraseña);
            $("#txttel").val(objPersonasJSon.tel);
            $("#txtTipoUsuario").val(objPersonasJSon.TipoUsuario);
            $("#typeAction").val("update_personas");
            
            swal("Confirmacion", "Los datos de la persona fueron cargados correctamente", "success");
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deletePersonasByID(PK_cedula) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/personasController.php',
        data: {
            action: "delete_personas",
            PK_cedula: PK_cedula
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
                $("#dt_personas").DataTable().ajax.reload();
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



    var dataTablePersonas_const = function () {
        if ($("#dt_personas").length) {
            $("#dt_personas").DataTable({
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
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showPersonasByID(\''+row[0]+'\');">Cargar</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deletePersonasByID(\''+row[0]+'\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 2,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../backend/controller/personasController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showAll_personas"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_personas').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };



    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTablePersonas_const();
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
    $('#dt_personas').DataTable().columns.adjust().responsive.recalc();
};
