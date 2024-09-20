<?php

  class CotizacionesController{

    static public function ctrMostrarCotizaciones($item, $valor){

      $tabla = "cotizaciones";

      $respuesta = CotizacionesModel::mdlMostrarCotizaciones($tabla, $item, $valor);

      return $respuesta;

    }

    static public function ctrMostrarCotizacionesSinFecha($item, $valor){

      $tabla = "cotizaciones";

      $respuesta = CotizacionesModel::mdlMostrarCotizacionesSinFecha($tabla, $item, $valor);

      return $respuesta;

    }

    static public function ctrMostrarDetalleCotizacion($item, $valor){

      $tabla = "detallecotizacion";

      $respuesta = CotizacionesModel::mdlMostrarDetalleCotizacion($tabla, $item, $valor);

      return $respuesta;

    }


    static public function ctrInsertarCotizacion(){
      if(isset($_POST["idVendedorCotizacion"])){
        
        $tabla = "cotizaciones";

        if($_POST["metodoPagoCotizacion"] == "efectivo"){
          $pago = "Efectivo";
        }else if($_POST["metodoPagoCotizacion"] == "deposito"){
          $pago = "Deposito No. " .$_POST["btnMetodoPago"];
        }elseif ($_POST["metodoPagoCotizacion"] == "credito") {
          $pago = "Credito a " . $_POST["btnMetodoPago"] . " coutas";
        }

        if($_POST["comentariosCotizacion"] == null){
          $comentario = "";
        }else{
          $comentario =$_POST["comentariosCotizacion"];
        }

        $datos = array(
          "noCotizacion" => $_POST["noCotizacion"],
          "total" => $_POST["totalCotizacion"],
          "envio" => $_POST["envioCotizacion"],
          "usuario" => $_POST["idVendedorCotizacion"],
          "cliente" => $_POST["idClienteCotizacion"],
          "metodoPago" => $pago,
          "comentarios" => $comentario
        );

        $respuesta = CotizacionesModel::mdlInsertarCotizacion($tabla, $datos);

        if($respuesta == "ok"){
          
            $listaProductos = json_decode($_POST["listaProductos"], true);

            $tablad = "detallecotizacion";

            foreach ($listaProductos as $key => $value) {
                $datosD = array(
                    "codigoProducto" => $value["descripcion"],
                    "producto" => $value["codigo"],
                    "cantidad" => $value["cantidad"],
                    "precio" => $value["precio"],
                    "total" => $value["total"],
                    "cotizacion" => $_POST["noCotizacion"]
                  );
                $respuestaCotizacion = CotizacionesModel::mdlInsertarDetalleCotizacion($tablad, $datosD);

                
            }

            $tablaHistorial = "historial";

            $datosHistorial = array(
                "descripcion" => "Creación de la cotizacion No. ".$_POST["noCotizacion"],
                "usuario" => $_SESSION["id"]
            );

            $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);


            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El Cliente ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "cotizaciones";
        
                                            }
                                        })
        
                            </script>';

        }

      }
    }

    static public function ctrEliminarEliminarCotizacion(){

      if(isset($_GET["idCotizacion"])){
  
        $tabla = "cotizaciones";
        $datos = $_GET["idCotizacion"];
  
        $respuesta = CotizacionesModel::mdlEliminarCotizacion($tabla, $datos);
  
        if($respuesta == "ok"){

          $tablaHistorial = "historial";

            $datosHistorial = array(
                "descripcion" => "Anulación de la cotizacion No. ".$_GET["noPedido"],
                "usuario" => $_SESSION["id"]
            );

            $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);
  
          echo'<script>
  
            swal.fire({
                icon: "success",
                title: "La cotización ha sido anulada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "cotizaciones";
  
                    }
                  })
  
            </script>';
        }else{
          echo'<script>
  
            swal.fire({
                icon: "error",
                title: "La cotizacion no ha sido anulada",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "cotizaciones";
  
                    }
                  })
  
            </script>';
        }
      }
      
    }


  }