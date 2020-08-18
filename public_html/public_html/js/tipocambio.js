/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    consultarTipoCambio();

});

function consultarTipoCambio() {
    $.ajax({
        url: '../backend/controller/tipoCambio.php',
        type: 'POST',
        data: {
            action: "consultarTipoCambio"
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al enviar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var json  = JSON.parse(data.trim());
            
            $("#venta").html(json.venta);
            $("#compra").html(json.compra);
        }
    });
}


