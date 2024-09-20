$(document).on('change', '#cargarXML', function(e){

    var tmpPath = URL.createObjectURL(e.target.files[0]);

    var xhttp = new XMLHttpRequest();

    xhttp.onload = function(){myFunction(this);}

    xhttp.open("GET", tmpPath);

    xhttp.send();

});

function myFunction(xml) {
    const xmlDoc = xml.responseXML;
    const x = xmlDoc.getElementsByTagName("dte:NumeroAutorizacion");
    const f = xmlDoc.getElementsByTagName("dte:FechaHoraCertificacion");
    $("#uuidVenta").val(x[0].innerHTML);
    $("#noFacturaSat").val($(x[0]).attr("Numero"));
    $("#serieVenta").val($(x[0]).attr("Serie"));
    $("#fechaVenta").val(f[0].innerHTML)
  }

  $(document).on("click", ".btnEliminarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	var datos = new FormData();
	datos.append("idVenta", idVenta);

	$.ajax({
		url: "ajax/ventas.ajax.php",
		method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
		success: function(respuesta){
			swal.fire({
				title: '¿Está que desaa anular la venta?',
				text: "¡Si no lo está puede cancelar la acción!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: 'Si, anular venta!'
			}).then(function(result){
		
				if(result.value){
		
					window.location = "index.php?ruta=ventas&idVenta="+idVenta+"&noFactura="+respuesta["noFactura"];
		
				}
		
			})
		},
		error: function(respuesta){
			console.log(respuesta);
		}
	})

});

$(document).on('click', ".btnImprimirVenta", function(){

	var codigoVenta = $(this).attr("idVenta");

	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+ codigoVenta, "_blank");

});