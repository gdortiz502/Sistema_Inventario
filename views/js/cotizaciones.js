$(".nitCliente").change(function(){

	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("nitCliente", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

			console.log(respuesta);
    	
	    	if(!respuesta){

	    		toastr["error"]("El cliente no existe en la base de datos", "Error")

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "600",
                    "hideDuration": "600",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

	    		$(".nitCliente").val("");
                $(".nombreCliente").val("");
                $(".direccionCliente").val("");
                $(".idClienteCotizacion").val("");
                $(".cantidadProductoCotizacion").val("");

	    	}else{

                $(".nombreCliente").val(respuesta[0]["nombre"]);
                $(".direccionCliente").val(respuesta[0]["direccion"]);
                $(".idClienteCotizacion").val(respuesta[0]["idCliente"]);

            }

	    },
        error: function(res){
            console.log(res);
        }

	})
})

$(".codigoProductoCotizacion").change(function(){

	var producto = $(this).val();

	var datos = new FormData();
	datos.append("codigoProducto", producto);

	 $.ajax({
	    url:"ajax/inventarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(!respuesta){

	    		toastr["error"]("El producto no existe en la base de datos", "Error")

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "600",
                    "hideDuration": "600",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                $(".codigoProductoCotizacion").val("");
	    		$(".descripcionProductoCotizacion").text("-");
                $(".stockProductoCotizacion").text("-");
                $(".precioProductoCotizacion").text("-");
                $(".cantidadProductoCotizacion").text("-");

	    	}else{

                $(".descripcionProductoCotizacion").text(respuesta["descripcion"]);
                $(".stockProductoCotizacion").text(respuesta["cantidad"]);
                $(".precioProductoCotizacion").text(respuesta["precioVenta"]);
                $(".cantidadProductoCotizacion").attr("stockActual", respuesta["cantidad"]);

            }

	    },
        error: function(res){
            console.log(res);
        }

	})
});

$(".cantidadProductoCotizacion").on("change",function(){

    stockActual = $(this).attr("stockActual");

    precio = $(".precioProductoCotizacion").text();

    cantidad = $(this).val();

	var total = Number(cantidad) * Number(precio);

	$(".totalProductoCotizacion").text(total);
	$(".btnAñadirDetalle").attr("disabled", false);
	
	sumarTotales();


});

$(".btnAñadirDetalle").on("click", function(){

    codigo = $(".codigoProductoCotizacion").val();
    producto = $(".descripcionProductoCotizacion").text();
    cantidad = $(".cantidadProductoCotizacion").val();
    precio = $(".precioProductoCotizacion").text();
    total = $(".totalProductoCotizacion").text();
    stock = $(".stockProductoCotizacion").text();

    $(".tablaDetalle tbody").before().append(
        '<tr>'+
            '<td>'+codigo+'</td>'+
            '<td class="productoCotizacion">'+producto+'</td>'+
            '<td>'+cantidad+'</td>'+
            '<td>'+precio+'</td>'+
            '<td class="totalDetalle">'+total+'</td>'+
            '<td><button type="button" class="btn btn-xs btn-danger btnQuitarDetalle"><i class="fas fa-times"></i></button></td>'+
        '</tr>'
    );

    $(".codigoProductoCotizacion").val("");
    $(".descripcionProductoCotizacion").text("-");
    $(".cantidadProductoCotizacion").val("");
    $(".precioProductoCotizacion").text("-");
    $(".totalProductoCotizacion").text("-");
    $(".stockProductoCotizacion").text("-");

});

$("#tablaProductosVentas").on("click", ".agregarProducto", function(){

    var idInventario = $(this).attr("idProducto");
    $(this).removeClass("btn-success agregarProducto");
    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idInventario", idInventario);

    $.ajax({

        url : "ajax/inventarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){

			var datosProductos = new FormData();
		  	datosProductos.append("idProducto", respuesta[0]["producto"])

			var stock = respuesta[0]["cantidad"];

			if(stock < 0){

				stockreal = 0;

			}else{
				
				stockreal = respuesta[0]["cantidad"];

			}

			$.ajax({

				url:"ajax/productos.ajax.php",
				method: "POST",
				data: datosProductos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta){

                    var precio = respuesta[0]["precioVenta"];
					var descripcion = respuesta[0]["descripcion"];
					var codigo = respuesta[0]["codigo"];

                    var idProducto = respuesta[0]["idProducto"];

					

						$(".nuevoProducto .productos").append(					
							'<div class="row mb-3">'+
								'<div class="col-2" style="padding-right:0px">'+
								'<div class="input-group">'+
									'<span class="input-group-prepend">'+
									'<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idInventario+'"><i class="fas fa-times"></i></button>'+
									'</span>'+
									'<input type="text" class="form-control nuevoCodigoProducto" value="'+codigo+'" disabled>'+
								'</div>'+
								'</div>'+
								'<div class="col-2" style="padding-right:0px">'+
								'<div class="input-group">'+
									'<span class="input-group-prepend">'+
									'<button type="button" class="btn btn-default btn-xs"><i class="fas fa-times"></i></button>'+
									'</span>'+
									'<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idInventario+'" name="agregarProducto" value="'+descripcion+'" required readonly>'+
								'</div>'+
								'</div>'+

								'<div class="col-2">'+
								'<div class="input-group">'+
									'<input type="number" class="form-control" value="'+stockreal+'" disabled>'+
									'<span class="input-group-append">'+
									'<button class="btn btn-default" type="button"><i class="fas fa-hashtag"></i></button>'+
									'</span>'+
								'</div>'+
								'</div>'+

								'<div class="col-2">'+
								'<div class="input-group">'+
									'<input type="number" class="form-control" value="'+precio+'" disabled>'+
									'<span class="input-group-append">'+
									'<button class="btn btn-default" disabled type="button"><i class="fab fa-quora"></i></button>'+
									'</span>'+
								'</div>'+
								'</div>'+
								
								'<div class="col-2">'+
								'<div class="input-group">'+
									'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock -1)+'" required>'+
									'<span class="input-group-append">'+
									'<button class="btn btn-default" type="button"><i class="fas fa-hashtag"></i></button>'+
									'</span>'+
								'</div>'+
								'</div>'+
	
								'<div class="col-2 ingresoPrecio" style="padding-left:0px">'+
								'<div class="input-group">'+
									'<input type="text" readonly class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" min="1" step="0.01" value="'+precio+'" readonly>'+
									'<span class="input-group-append">'+
									'<button class="btn btn-default" type="button"><i class="fab fa-quora"></i></button>'+
									'</span>'+
								'</div>'+
								'</div>'+
							'</div>'
	
						)

						sumarTotalPrecios();

						listarProductos();
						$("#btnGuardarCotizacion").attr("disabled", false);

					
				}
	
			});

		}

    });

});

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$("#tablaProductosVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProducto = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProducto.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProducto[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProducto[i]["idProducto"]+"']").addClass('btn-success agregarProducto');

		}

	}

});

$(".nuevoProducto").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];

	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"));

	}

	idQuitarProducto.push({"idProducto": idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto))	;

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-success agregarProducto');

	if($(".productos").children().length == 0){

		$("#subTotalCotizacion").val(0);
		$("#ivaCotizacion").val(0);
		$("#totalCotizacion").val(0);
		$("#btnGuardarCotizacion").attr("disabled", true);

	}else{

		sumarTotalPrecios();

		listarProductos();

		$("#btnGuardarCotizacion").attr("disabled", false);

	}
		

});

$(".nuevoProducto").on("change", ".nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().parent().children('.ingresoPrecio').children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");

	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevostock", nuevoStock);

	sumarTotalPrecios();

	listarProductos();

});

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];
	

	for(var i = 0; i <precioItem.length ; i++){
		arraySumaPrecio.push(Number($(precioItem[i]).val()));
	}

	function sumarArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumarArrayPrecios);

	
	$("#subTotalCotizacion").val((sumaTotalPrecio / 1.12).toFixed(2));
	$("#ivaCotizacion").val(((sumaTotalPrecio / 1.12) * .12).toFixed(2));
    $("#totalCotizacion").val(Number($("#subTotalCotizacion").val()) + Number($("#ivaCotizacion").val()));

}

$("#descuentoCotizacion").on('change', function(){

	var descuento = Number($(this).val())/100 ;
	var total = Number($("#subTotalCotizacion").val()) + Number($("#ivaCotizacion").val());

	var nuevoTotal = total * descuento;

	var TotalTotal = Number($("#subTotalCotizacion").val()) + Number($("#ivaCotizacion").val()) - nuevoTotal;

	if($(this).val() == "")
	{
		$("#totalCotizacion").val(Number($("#subTotalCotizacion").val()) + Number($("#ivaCotizacion").val()));
	}else{

		$("#totalCotizacion").val(TotalTotal);

	}

});
$(document).on('change', "#envioCotizacion", function(){
	var envio = Number($(this).val());
	var total = Number($("#subTotalCotizacion").val()) + Number($("#ivaCotizacion").val());
	var nuevoTotal = total + envio;

	if($(this).val() == "")
	{
		$("#totalCotizacion").val(Number($("#subTotalCotizacion").val()) + Number($("#ivaCotizacion").val()));
	}else{

		$("#totalCotizacion").val(nuevoTotal);

	}
})

$("#metodoPagoCotizacion").change(function(){

	if($(this).val() == "efectivo"){
		$(this).parent().parent().children(".txtPagar").children().remove();
		$(this).parent().parent().children(".txtPagar").append(
			'<div class="d-flex pb-1">'+
			'<b class="col-4">Efectivo</b>'+
			'<input type="text" name="btnMetodoPago" id="btnMetodoPago" class="form-control required form-control-sm" placeholer="Efectivo">'+
			'</div>'+
			'<div class="d-flex pb-1">'+
			'<b class="col-4">Cambio</b>'+
			'<input type="text" id="totalCambio" readonly class="form-control form-control-sm" placeholder="Cambio">'+
			'</div>'
		);

	}else if($(this).val() == "deposito"){
		$(this).parent().parent().children(".txtPagar").children().remove();
		$(this).parent().parent().children(".txtPagar").append(
			'<div class="d-flex pb-1">'+
			'<b class="col-4">No. Deposito</b>'+
			'<input type="text" name="btnMetodoPago" class="form-control form-control-sm" required placeholder="No. de deposito">'+
			'</div>'
		);
	}else if($(this).val() == "credito"){
		$(this).parent().parent().children(".txtPagar").children().remove();
		$(this).parent().parent().children(".txtPagar").append(
			'<div class="d-flex pb-1">'+
			'<b class="col-4">Cuotas</b>'+
			'<input type="text" name="btnMetodoPago" class="form-control form-control-sm" required placeholder="Ingrese las coutas">'+
			'</div>'
		);	
	}else if($(this).val() == "transferencia"){
		$(this).parent().parent().children(".txtPagar").children().remove();
		$(this).parent().parent().children(".txtPagar").append(
			'<div class="d-flex pb-1">'+
			'<b class="col-4">Transferencia</b>'+
			'<input type="text" name="btnMetodoPago" class="form-control form-control-sm" required placeholder="Ingrese el no. de transferencia">'+
			'</div>'
		);	
	}else if($(this).val() == "cheque"){
		$(this).parent().parent().children(".txtPagar").children().remove();
		$(this).parent().parent().children(".txtPagar").append(
			'<div class="d-flex pb-1">'+
			'<b class="col-4">Cheque</b>'+
			'<input type="text" name="btnMetodoPago" class="form-control form-control-sm" required placeholder="Ingrese el no. de cheque">'+
			'</div>'
		);	
	}

});

$(document).on("change", "#btnMetodoPago", function(){

	var totalCotizacion = $("#totalCotizacion").val();
	var totalPagar = $(this).val();

	if(totalCotizacion > totalPagar){

		toastr["warning"]("La cantidad a pagar es menor al valor de la cotizacion", "Advertencia")

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "600",
                    "hideDuration": "600",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

				$("#btnMetodoPago").val("");
				$("#totalCambio").val("");

	}else{
		var cambioCotizacion = Number(totalPagar) - Number(totalCotizacion);

		$("#totalCambio").val(cambioCotizacion);
	}

});

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var codigo = $(".nuevoCodigoProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio  = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({"id": $(descripcion[i]).attr("idProducto"),
							 "codigo" : $(codigo[i]).val(),
							 "descripcion": $(descripcion[i]).val(),
							 "cantidad": $(cantidad[i]).val(),
							 "stock": $(cantidad[i]).attr("nuevoStock"),
							 "precio": $(precio[i]).attr("precioReal"),
							 "total": $(precio[i]).val()})

	}

	$("#listaProductos").val((JSON.stringify(listaProductos)));
}

$(document).on('click', ".btnImprimirCotizacion", function(){

	var codigoCotizacion = $(this).attr("idCotizacion");

	window.open("extensiones/tcpdf/pdf/cotizacion.php?codigo="+ codigoCotizacion, "_blank");

});

$(document).on("click", ".btnEliminarCotizacion", function(){

	var idCotizacion = $(this).attr("idCotizacion");

	var datos = new FormData();
	datos.append("idCotizacion", idCotizacion);

	$.ajax({
		url: "ajax/cotizaciones.ajax.php",
		method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
		success: function(respuesta){
			swal.fire({
				title: '¿Está que desaa anular la cotización?',
				text: "¡Si no lo está puede cancelar la acción!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: 'Si, anular cotizacion!'
			}).then(function(result){
		
				if(result.value){
		
					window.location = "index.php?ruta=cotizaciones&idCotizacion="+idCotizacion+"&noCotizacion="+respuesta["noCotizacion"];
		
				}
		
			})
		},
		error: function(respuesta){
			console.log(respuesta);
		}
	})

});