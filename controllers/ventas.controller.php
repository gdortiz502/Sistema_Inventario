<?php

  class VentasController{

    static public function ctrMostrarVentas($item, $valor){

      $tabla = "ventas";

      $respuesta = VentasModel::mdlMostrarVentas($tabla, $item, $valor);

      return $respuesta;

    }

    static public function ctrMostrarVentasSinFecha($item, $valor){

        $tabla = "ventas";
  
        $respuesta = VentasModel::mdlMostrarVentasSinFecha($tabla, $item, $valor);
  
        return $respuesta;
  
      }

      static public function ctrMostrarVentasInicio(){

      $tabla = "ventas";

      $respuesta = VentasModel::mdlMostrarVentasInicio($tabla);

      return $respuesta;

  }
    
      static public function ctrMostrarDetalleVenta($item, $valor){

        $tabla = "detalleventa";
  
        $respuesta = VentasModel::mdlMostrarDetalleVenta($tabla, $item, $valor);
  
        return $respuesta;
  
      }

    static public function ctrInsertarVenta(){
      if(isset($_POST["idVendedorVenta"])){
        
        $tabla = "ventas";

        if($_POST["metodoPagoVenta"] == "efectivo"){
          $pago = "Efectivo";
        }else if($_POST["metodoPagoVenta"] == "deposito"){
          $pago = "Deposito No. " .$_POST["btnMetodoPago"];
        }elseif ($_POST["metodoPagoVenta"] == "credito") {
          $pago = "Credito a " . $_POST["btnMetodoPago"] . " coutas";
        }elseif ($_POST["metodoPagoVenta"] == "transferencia") {
          $pago = "Transferencia no. " . $_POST["btnMetodoPago"];
        }elseif ($_POST["metodoPagoVenta"] == "cheque") {
          $pago = "Cheque no. " . $_POST["btnMetodoPago"];
        }

        if($_POST["comentarioVenta"] == null){
          $comentario = "";
        }else{
          $comentario =$_POST["comentarioVenta"];
        }

        $datos = array(
          "uuid" => $_POST["uuidVenta"],
          "serie" => $_POST["serieVenta"],
          "noSat" => $_POST["noFacturaSat"],
          "noVenta" => $_POST["noFactura"],
          "fecha" => $_POST["fechaVenta"],
          "total" => $_POST["totalVenta"],
          "envio" => $_POST["envioVenta"],
          "usuario" => $_POST["idVendedorVenta"],
          "cliente" => $_POST["idClienteVenta"],
          "metodoPago" => $pago,
          "comentarios" => $comentario
        );

        $respuesta = VentasModel::mdlInsertarVenta($tabla, $datos);

        $listaProductos = json_decode($_POST["listaProductos"], true);

        var_dump($listaProductos);

        $tablaInventarios = "inventario";

        if($respuesta == "ok"){

            $listaProductos = json_decode($_POST["listaProductos"], true);


            $tablad = "detalleventa";

            foreach ($listaProductos as $key => $value) {
                $datosD = array(
                    "factura" => $_POST["noFactura"],
                    "codigo" => $value["codigo"],
                    "producto" => $value["descripcion"],
                    "cantidad" => $value["cantidad"],
                    "precio" => $value["precio"],
                    "total" => $value["total"]
                  );
                $respuestaPedido = VentasModel::mdlInsertarDetalleVenta($tablad, $datosD);
            }

            $tablaHistorial = "historial";

            $datosHistorial = array(
                "descripcion" => "Creación de la venta No. ".$_POST["noFactura"],
                "usuario" => $_SESSION["id"]
            );

            $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

          foreach ($listaProductos as $key => $value) {

            $datos = array(
                "idInventario" => $value["id"],
                "cantidad" => $value["cantidad"]
            );

            $respuetaPedido = InventariosModel::mdlRestarInventario($tablaInventarios, $datos);
          }
          echo '<script>
                      swal.fire({
                        icon: "success",
                        title: "¡La venta se ha creado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                          if (result.value) {
    
                          window.location = "ventas";
    
                          }
                      })
                    </script>';
        }else{

            var_dump($respuesta);

        }

      }
    }

    static public function ctrEliminarVenta(){

      if(isset($_GET["idVenta"])){
  
        $tabla = "ventas";
        $datos = $_GET["idVenta"];
  
        $respuesta = VentasModel::mdlEliminarVenta($tabla, $datos);
  
        if($respuesta == "ok"){
  
          $tablaHistorial = "historial";

          $datosHistorial = array(
              "descripcion" => "Anulación de la venta No. ".$_GET["noFactura"],
              "usuario" => $_SESSION["id"]
          );

          $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

          echo'<script>
  
            swal.fire({
                icon: "success",
                title: "La venta ha sido anulada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "ventas";
  
                    }
                  })
  
            </script>';
        }else{
          echo'<script>
  
            swal.fire({
                icon: "error",
                title: "La venta no ha sido anulada",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "ventas";
  
                    }
                  })
  
            </script>';
        }
      }
      
    }


  }