$('.tablas').on('click', '.btnEditarCategoria', function(){

    var idCategoria = $(this).attr("idCategoria");

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $('#editarDescripcionCategoria').val(respuesta[0]["descripcion"]);
            $('#editarIdCategoria').val(respuesta[0]["idCategoria"]);

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$(document).on('click', '.btnEliminarCategoria', function(){

    var idCategoria = $(this).attr("idCategoria");

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de deshabilitar la categoría?',
                text: "¡Está acción no eliminara la categoría solo la deshabilitara del sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, deshabilitar categoría!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=categorias&idCategoria="+respuesta[0]["idCategoria"]+"&categoria="+respuesta[0]["descripcion"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});

$(document).on('click', '.btnActivarCategoria', function(){

    var idCategoria = $(this).attr("idCategoria");

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de habilitar la categoría?',
                text: "¡Está acción habilitara la categoría en el sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, habilitar categoría!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=categorias&idCategoria="+respuesta[0]["idCategoria"]+"&categoria="+respuesta[0]["descripcion"]+"&estatus="+respuesta[0]["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});


});