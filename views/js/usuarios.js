$(document).on('change', '#nuevoCodigoUsuario', function(){

	var codigo = $(this).val();

	var datos = new FormData();
	datos.append("codigoUsuario", codigo);

	$.ajax({
		url: "ajax/usuarios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            if(respuesta[0]){

	    		toastr["warning"]("El codigo del usuario ya existe en la base de datos", "Advertencia")

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

                $("#nuevoCodigoUsuario").val('');

	    	}

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


})

$(document).on('change', '#nuevoUsuarioUsuario', function(){

	var codigo = $(this).val();

	var datos = new FormData();
	datos.append("usuarioUsuario", codigo);

	$.ajax({
		url: "ajax/usuarios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            if(respuesta[0]){

	    		toastr["warning"]("El usuario ya existe en la base de datos", "Advertencia")

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

                $("#nuevoUsuarioUsuario").val('');

	    	}

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


})

$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
    datos.append("idUsuario", idUsuario);

     $.ajax({

      url:"ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
		
        $("#editarCodigoUsuario").val(respuesta["codigo"]);
        $("#editarIdUsuario").val(respuesta["idUsuario"]);
        $("#editarNombreUsuario").val(respuesta["nombre"]);
        $("#editarUsuarioUsuario").val(respuesta["usuario"]);
        $("#passwordActual").val(respuesta["password"]);
        $("#editarTelefonoUsuario").val(respuesta["telefono"]);
        $("#editarCorreoUsuario").val(respuesta["correo"]);
        $("#editarDireccionUsuario").val(respuesta["dirreccion"]);
        $("#editarImagenActualUsuario").val(respuesta["imagen"]);
        $(".previsualizar").attr("src", respuesta["imagen"]);        

		var datosNivel = new FormData();
		datosNivel.append("idNivel",respuesta["nivel"]);

		 $.ajax({

			url:"ajax/usuarios.ajax.php",
			method: "POST",
			data: datosNivel,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){
				
                $("#editarNivelUsuario").append("<option selected value='"+respuesta["idNivel"]+"'>"+respuesta["descripcion"]+"</option>")

			}

		})

        }

	 })

  })

  $(document).on('click', '.btnEliminarUsuario', function(){

    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
		url: "ajax/usuarios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            console.log(respuesta);

            swal.fire({
                title: '¿Está seguro de deshabilitar el usuario?',
                text: "¡Está acción no eliminara el usuario solo la deshabilitara del sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, deshabilitar usuario!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=usuarios&idUsuario="+respuesta["idUsuario"]+"&nombre="+respuesta["nombre"]+"&estatus="+respuesta["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});

$(document).on('click', '.btnActivarUsuario', function(){

    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
		url: "ajax/usuarios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            console.log(respuesta);

            swal.fire({
                title: '¿Está seguro de habilitar el usuario?',
                text: "¡Está acción habilitara el usuario en el sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, habilitar usuario!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=usuarios&idUsuario="+respuesta["idUsuario"]+"&nombre="+respuesta["nombre"]+"&estatus="+respuesta["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});
});
