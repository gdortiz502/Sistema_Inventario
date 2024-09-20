$(document).on('change', '#nuevoCodigoCliente', function(){

    var codigo = $(this).val();

    var datos = new FormData();
    datos.append("codigoCliente", codigo);

    $.ajax({
		url: "ajax/clientes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            if(respuesta[0]){

	    		toastr["warning"]("El código del cliente ya existe en la base de datos", "Advertencia")

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

                $("#nuevoCodigoCliente").val('');

	    	}

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});


$('.tablas').on('click', '.btnEditarCliente', function(){

    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({
		url: "ajax/clientes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $("#editarCodigoCliente").val(respuesta[0]["codigo"]);
            $("#editarIdCliente").val(respuesta[0]["idCliente"]);
            $("#editarNitCliente").val(respuesta[0]["nit"]);
            $("#editarNombreCliente").val(respuesta[0]["nombre"]);
            $("#editarTelefonoCliente").val(respuesta[0]["telefono"]);
            $("#editarCorreoCliente").val(respuesta[0]["correo"]);
            $("#editarDireccionCliente").val(respuesta[0]["direccion"]);

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$(document).on('click', '.btnEliminarCliente', function(){

    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({
		url: "ajax/clientes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de deshabilitar el cliente?',
                text: "¡Está acción no eliminara el cliente solo lo deshabilitara del sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, deshabilitar cliente!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=clientes&idCliente="+respuesta[0]["idCliente"]+"&nombre="+respuesta[0]["nombre"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});

$(document).on('click', '.btnActivarCliente', function(){

    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({
		url: "ajax/clientes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de habilitar el cliente?',
                text: "¡Está acción habilitara al cliente en el sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, habilitar cliente!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=clientes&idCliente="+respuesta[0]["idCliente"]+"&nombre="+respuesta[0]["nombre"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});