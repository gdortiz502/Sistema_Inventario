$(document).on("click", ".btnEliminarPedido", function(){

	var idPedido = $(this).attr("idPedido");

	var datos = new FormData();
	datos.append("idPedido", idPedido);

	$.ajax({
		url: "ajax/pedidos.ajax.php",
		method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
		success: function(respuesta){
			swal.fire({
				title: '¿Está que desaa anular el pedido?',
				text: "¡Si no lo está puede cancelar la acción!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: 'Si, anular pedido!'
			}).then(function(result){
		
				if(result.value){
		
					window.location = "index.php?ruta=pedidos&idPedido="+idPedido+"&noPedido="+respuesta["noPedido"];
		
				}
		
			})
		},
		error: function(respuesta){
			console.log(respuesta);
		}
	})

});

$(document).on('click', ".btnImprimirPedido", function(){

	var codigoPedido = $(this).attr("idPedido");

	window.open("extensiones/tcpdf/pdf/pedido.php?codigo="+ codigoPedido, "_blank");

});