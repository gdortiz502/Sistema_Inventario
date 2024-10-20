$(function () {
    $('.tablas').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language":{
        "sProcessing": "Cargando...",
        "sLengthMenu": "ver _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "No hay datos disponibles en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousand": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate":{
            "sFirst" : "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":":Activar para ordenar la columna de manera ascendente",
            "sSortDescending":":Activar para ordenar la columna de manera descendente",
        }
      }
    });

    var ruta = "localhost/inventarios";

    if(window.location.pathname.replace(ruta, "") == "ventas" ||
       window.location.pathname.replace(ruta, "") == "crearventa" ||
       window.location.pathname.replace(ruta, "") == "pedidos" ||
       window.location.pathname.replace(ruta, "") == "crearpedido" ||
       window.location.pathname.replace(ruta, "") == "cotizaciones" ||
       window.location.pathname.replace(ruta, "") == "crearcotizacion" ){
        $(".navegacion").find("[href='"+window.location.pathname.replace(ruta, "")+"']").parent().parent().parent().addClass("menu-open");
        $(".navegacion").find("[href='"+window.location.pathname.replace(ruta, "")+"']").parent().parent().parent().children(".nav-link").addClass("active");
        $(".navegacion").find("[href='"+window.location.pathname.replace(ruta, "")+"']").parent().parent().css({"display": "block"});
        $(".navegacion").find("[href='"+window.location.pathname.replace(ruta, "")+"']").addClass("active");
    }else{
        $(".navegacion").find("[href='"+window.location.pathname.replace(ruta, "")+"']").addClass("active");
    }
  });

  