$(document).on('click', '.btnEditarCheque', function(){

    var idCheque = $(this).attr("idCheque");

    var datos = new FormData();
    datos.append("idCheque", idCheque);

    $.ajax({
		url: "ajax/cheques.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $("#editarIdCheque").val(respuesta["idControl"]);
            $("#editarNoCheque").val(respuesta["noCheque"]);
            $("#editarFechaCheque").val(respuesta["fecha"]);
            $("#editarTotalCheque").val(respuesta["total"]);
            $("#editarDescripcionCheque").val(respuesta["descripcion"]);
            $("#editarConceptoCheque").text(respuesta["concepto"]);

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});

$(document).on('click', '.btnEliminarCheque', function(){

    var idCheque = $(this).attr("idCheque");

    var datos = new FormData();
    datos.append("idCheque", idCheque);

    $.ajax({
		url: "ajax/cheques.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de eliminar el registro?',
                text: "¡Está acción eliminara el registro del sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar registro!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=cheques&idControl="+respuesta["idControl"]+"&noCheque="+respuesta["noCheque"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

	});

});