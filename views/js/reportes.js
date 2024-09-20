$(document).on('change', '#fechaInicialReporte', function(){

    $("#fechaFinalReporte").attr('disabled', false);

});

$(document).on('change', '#fechaFinalReporte', function(){

    var fechaInicial = $("#fechaInicialReporte").val();
    var fechaFinal = $("#fechaFinalReporte").val();
    var tabla = "ventas";
    var item = "fecha";

    var datos = new FormData();
    datos.append("tabla", tabla);
    datos.append("item", item);
    datos.append("fechaInicial", fechaFinal);
    datos.append("fechaFinal", fechaInicial);

    $.ajax({
        url: "ajax/reportes.ajax.php",
        method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
            console.log(respuesta);
        },
        error: function(respuesta){
            console.log(respuesta);
        }
    })

});