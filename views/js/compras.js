$(document).on('click', ".btnEditarCompra", function(){

    var idCompra = $(this).attr("idCompra");
    var datos = new FormData();
    datos.append("idCompra", idCompra);

    $.ajax({

        url: "ajax/compras.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $("#editarUuidCompra").val(respuesta["uuid"]);
            $("#editarIdCompra").val(respuesta["idCompra"]);
            $("#editarNoFacturaCompra").val(respuesta["noSat"]);
            $("#editarNoSerieCompra").val(respuesta["serie"]);
            $("#editarFechaCompra").val(respuesta["fecha"]);
            $("#editarTotalCompra").val(respuesta["total"]);
            $("#editarDescripcionCompra").text(respuesta["descripcion"]);
            $("#editarComentarioCompra").text(respuesta["comentario"]);

            var idProveedor = respuesta["proveedor"];
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

                    $("#editarProveedorCompra").append("<option selected value='"+respuesta[0]["idProveedor"]+"'>"+respuesta[0]["nombre"]+"</option>")

                },
                error: function(respuesta){

                    console.log(respuesta);

                }
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

    })

});

$(document).on('click', '.btnEliminarCompra', function(){

    var idCompra = $(this).attr("idCompra");
    var datos = new FormData();
    datos.append("idCompra", idCompra);

    $.ajax({

        url: "ajax/compras.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            swal.fire({
                title: '¿Está seguro de cancelar la compra?',
                text: "¡Está acción no eliminara la compra solo la cancelara en el sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, cancelar compra!'
            }).then(function(result){
            
                if(result.value){
        
                    window.location = "index.php?ruta=compras&idCompra="+respuesta["idCompra"]+"&noFactura="+respuesta["noSat"]+"&estatus="+respuesta["estatus"];
        
                }
            
            })

     	},
        error: function(respuesta){

            console.log(respuesta);

        }

    })

});