$(document).on('change', '#nuevoCodigoProveedor', function(){

    var codigo = $(this).val();

    var datos = new FormData();
    datos.append("codigoProveedor", codigo);

    $.ajax({
		url: "ajax/proveedores.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            if(respuesta[0]){

	    		toastr["warning"]("El código del proveedor ya existe en la base de datos", "Advertencia")

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

                $("#nuevoCodigoProveedor").val('');

	    	}

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$(document).on('change', '#nuevoNitProveedor', function(){

    var nit = $(this).val();

    var datos = new FormData();
    datos.append("nitProveedor", nit);

    $.ajax({
		url: "ajax/proveedores.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            if(respuesta[0]){

	    		toastr["warning"]("El nit del proveedor ya existe en la base de datos", "Advertencia")

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

                $("#nuevoNitProveedor").val('');

	    	}

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$('.tablas').on('click', '.btnEditarProveedor', function(){

    var idProveedor = $(this).attr("idProveedor");

    var datos = new FormData();
    datos.append("idProveedor", idProveedor);

    $.ajax({
		url: "ajax/proveedores.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $("#editarCodigoProveedor").val(respuesta[0]["codigo"]);
            $("#editarIdProveedor").val(respuesta[0]["idProveedor"]);
            $("#editarNitProveedor").val(respuesta[0]["nit"]);
            $("#editarNombreProveedor").val(respuesta[0]["nombre"]);
            $("#editarTelefonoProveedor").val(respuesta[0]["telefono"]);
            $("#editarCorreoProveedor").val(respuesta[0]["correo"]);
            $("#editarDireccionProveedor").val(respuesta[0]["direccion"]);

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$(document).on('click', '.btnEliminarProveedor', function(){

    var idProveedor = $(this).attr("idProveedor");

    var datos = new FormData();
    datos.append("idProveedor", idProveedor);

    $.ajax({
		url: "ajax/proveedores.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de deshabilitar el proveedor?',
                text: "¡Está acción no eliminara el proveedor solo lo deshabilitara del sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, deshabilitar proveedor!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=proveedores&idProveedor="+respuesta[0]["idProveedor"]+"&nombre="+respuesta[0]["nombre"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});

$(document).on('click', '.btnActivarProveedor', function(){

    var idProveedor = $(this).attr("idProveedor");

    var datos = new FormData();
    datos.append("idProveedor", idProveedor);

    $.ajax({
		url: "ajax/proveedores.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de habilitar el proveedor?',
                text: "¡Está acción habilitara al proveedor en el sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, habilitar proveedor!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=proveedores&idProveedor="+respuesta[0]["idProveedor"]+"&nombre="+respuesta[0]["nombre"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});