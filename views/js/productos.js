$(".nuevaImagen").change(function(){

	var imagen = this.files[0];

    console.log(imagen);
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal.fire({
		      icon: "error",
		      title: "¡La imagen debe estar en formato JPG o PNG!",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
});

$(document).on('change', '#nuevoCodigoProducto', function(){

	var codigo = $(this).val();

	var datos = new FormData();
	datos.append("codigoProducto", codigo);

	$.ajax({
		url: "ajax/productos.ajax.php",
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

                $("#nuevoCodigoProducto").val('');

	    	}

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


})

$(document).on("click", ".btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
		console.log(respuesta)
          
		var datosCategoria = new FormData();
		datosCategoria.append("idCategoria",respuesta[0]["categoria"]);

		 $.ajax({

			url:"ajax/categorias.ajax.php",
			method: "POST",
			data: datosCategoria,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){
				
				$("#editarCategoriaProducto").append('<option selected value="'+respuesta[0]["idCategoria"]+'">'+respuesta[0]["descripcion"]+'</option>');

			}

		})

		var datosProveedor = new FormData();
		datosProveedor.append("idProveedor",respuesta[0]["proveedor"]);

		 $.ajax({

			url:"ajax/proveedores.ajax.php",
			method: "POST",
			data: datosProveedor,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){
				
				$("#editarProveedorProducto").append('<option selected value="'+respuesta[0]["idProveedor"]+'">'+respuesta[0]["nombre"]+'</option>');

			}

		})

		$("#editarCodigoProducto").val(respuesta[0]["codigo"]);

		$("#editarIdProducto").val(respuesta[0]["idProducto"])

		 $("#editarDescripcionProducto").val(respuesta[0]["descripcion"]);

		 $("#editarPrecioCompraProducto").val(respuesta[0]["precioCompra"]);

		 $("#editarPrecioVentaProducto").val(respuesta[0]["precioVenta"]);

		 if(respuesta[0]["imagen"] != ""){

			 $("#imagenActualProducto").val(respuesta[0]["imagen"]);

			 $(".previsualizar").attr("src",  respuesta[0]["imagen"]);
		 }

        }

	 })

  })

  $(document).on('click', '.btnEliminarProducto', function(){

    var idProducto = $(this).attr("idProducto");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de deshabilitar el producto?',
                text: "¡Está acción no eliminara el producto solo la deshabilitara del sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, deshabilitar producto!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=productos&idProducto="+respuesta[0]["idProducto"]+"&nombre="+respuesta[0]["descripcion"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});

$(document).on('click', '.btnActivarProducto', function(){

    var idProducto = $(this).attr("idProducto");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de habilitar el producto?',
                text: "¡Está acción habilitara el producto en el sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, habilitar producto!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=productos&idProducto="+respuesta[0]["idProducto"]+"&nombre="+respuesta[0]["descripcion"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});
});

$(document).on('click', ".btnTrasladarInventario", function(){

	var idProducto = $(this).attr("idProducto");

	var datos = new FormData();
	datos.append("idProducto" , idProducto);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "post",
		data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

			$("#codigoInventarioProducto").val(respuesta[0]["codigo"]);
			$("#idInventarioProducto").val(respuesta[0]["idProducto"]);
			$("#descripcionInventarioProducto").val(respuesta[0]["descripcion"]);

     	},
        error: function(respuesta){

            console.log(respuesta);

        }
	})

})