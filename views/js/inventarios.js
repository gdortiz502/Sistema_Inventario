$(document).on('click', '.btnAgregarInventario', function(){

    var idInventario = $(this).attr('idInventario');

	var datos = new FormData();
	datos.append("idInventario", idInventario);

	$.ajax({
		url: "ajax/inventarios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

           var producto = respuesta[0]["producto"];

            var datos = new FormData();
            datos.append("idProducto", producto);

            $.ajax({
                url: "ajax/productos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(respuesta){

                    $("#nuevoCodigoProductoInventario").val(respuesta[0]["codigo"]);
                    $("#nuevaDescripcionProductoInventario").val(respuesta[0]["descripcion"]);

                },
                error: function(respuesta){

                    console.log(respuesta);

                }

            });

            $("#idInventarioAgregar").val(respuesta[0]["idInventario"]);

            if(respuesta[0]["cantidad"] < 0){

                $("#nuevaCantidadActualProductoInventario").val(0);

            }else{
                $("#nuevaCantidadActualProductoInventario").val(respuesta[0]["cantidad"]);
            }

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$(document).on('click', '.btnRestarInventario', function(){

    var idInventario = $(this).attr('idInventario');

	var datos = new FormData();
	datos.append("idInventario", idInventario);

	$.ajax({
		url: "ajax/inventarios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

           var producto = respuesta[0]["producto"];

            var datos = new FormData();
            datos.append("idProducto", producto);

            $.ajax({
                url: "ajax/productos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(respuesta){

                    $("#editarCodigoProductoInventario").val(respuesta[0]["codigo"]);
                    $("#editarDescripcionProductoInventario").val(respuesta[0]["descripcion"]);

                },
                error: function(respuesta){

                    console.log(respuesta);

                }

            });

            $("#idInventarioRestar").val(respuesta[0]["idInventario"]);

            if(respuesta[0]["cantidad"] < 0){

                $("#editarCantidadActualProductoInventario").val(0);

            }else{
                $("#editarCantidadActualProductoInventario").val(respuesta[0]["cantidad"]);
            }

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$(document).on('change', '#editarCantidadProductoInventario', function(){

    var stockActual = $("#editarCantidadActualProductoInventario").val();
    var stock = $(this).val();

    if(stock >  stockActual){

        toastr["warning"]("El stock es demasiado grande.", "Advertencia")

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

                $("#editarCantidadProductoInventario").val(1);

    }

});