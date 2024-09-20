<?php

  class PedidosController{

    static public function ctrMostrarPedidos($item, $valor){

      $tabla = "pedidos";

      $respuesta = PedidosModel::mdlMostrarPedidos($tabla, $item, $valor);

      return $respuesta;

    }

    static public function ctrMostrarPedidosSinFecha($item, $valor){

        $tabla = "pedidos";
  
        $respuesta = PedidosModel::mdlMostrarPedidosSinFecha($tabla, $item, $valor);
  
        return $respuesta;
  
    }

    static public function ctrMostrarPedidosInicio(){

      $tabla = "pedidos";

      $respuesta = PedidosModel::mdlMostrarPedidosInicio($tabla);

      return $respuesta;

    }

    static public function ctrMostrarDetallePedido($item, $valor){

      $tabla = "detallepedido";

      $respuesta = PedidosModel::mdlMostrarDetallePedido($tabla, $item, $valor);

      return $respuesta;

    }

    static public function ctrInsertarPedido(){
      if(isset($_POST["idVendedorPedido"])){
        
        $tabla = "pedidos";

        if($_POST["metodoPagoPedido"] == "efectivo"){
          $pago = "Efectivo";
        }else if($_POST["metodoPagoPedido"] == "deposito"){
          $pago = "Deposito No. " .$_POST["btnMetodoPago"];
        }elseif ($_POST["metodoPagoPedido"] == "credito") {
          $pago = "Credito a " . $_POST["btnMetodoPago"] . " coutas";
        }elseif ($_POST["metodoPagoPedido"] == "transferencia") {
          $pago = "Transferencia no. " . $_POST["btnMetodoPago"];
        }elseif ($_POST["metodoPagoPedido"] == "cheque") {
          $pago = "Cheque no. " . $_POST["btnMetodoPago"];
        }

        if($_POST["comentariosPedido"] == null){
          $comentario = "";
        }else{
          $comentario =$_POST["comentariosPedido"];
        }

        $datos = array(
          "noPedido" => $_POST["noPedido"],
          "fechaEntrega" => $_POST["fechEntrega"],
          "total" => $_POST["totalPedido"],
          "envio" => $_POST["envioPedido"],
          "usuario" => $_POST["idVendedorPedido"],
          "cliente" => $_POST["idClientePedido"],
          "metodoPago" => $pago,
          "comentarios" => $comentario
        );

        $respuesta = PedidosModel::mdlInsertarPedido($tabla, $datos);

        $listaProductos = json_decode($_POST["listaProductos"], true);

        $tablaInventarios = "inventario";

        $itemInventario = "idInventario";

        if($respuesta == "ok"){

            $listaProductos = json_decode($_POST["listaProductos"], true);

            $tablad = "detallepedido";

            foreach ($listaProductos as $key => $value) {
                $datosD = array(
                    "codigoProducto" => $value["descripcion"],
                    "producto" => $value["codigo"],
                    "cantidad" => $value["cantidad"],
                    "precio" => $value["precio"],
                    "total" => $value["total"],
                    "pedido" => $_POST["noPedido"]
                  );
                $respuestaPedido = PedidosModel::mdlInsertarDetallePedido($tablad, $datosD);

                
            }

          foreach ($listaProductos as $key => $value) {

            $datosInventario = array(
                "idInventario" => $value["id"],
                "cantidad" => $value["cantidad"]
            );

            $respuetaPedido = InventariosModel::mdlRestarInventario($tablaInventarios, $datosInventario);
          }

          $tablaHistorial = "historial";

            $datosHistorial = array(
                "descripcion" => "Creación del pedido No. ".$_POST["noPedido"],
                "usuario" => $_SESSION["id"]
            );

            $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);
          echo '<script>
                      swal.fire({
                        icon: "success",
                        title: "¡El pedido se ha creado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                          if (result.value) {
    
                          window.location = "pedidos";
    
                          }
                      })
                    </script>';
        }

      }
    }

    static public function ctrEliminarPedido(){

      if(isset($_GET["idPedido"])){
  
        $tabla = "pedidos";
        $datos = $_GET["idPedido"];
  
        $respuesta = PedidosModel::mdlEliminarPedido($tabla, $datos);
  
        if($respuesta == "ok"){
  
          $tablaHistorial = "historial";

            $datosHistorial = array(
                "descripcion" => "Anulación del pedido No. ".$_GET["noPedidos"],
                "usuario" => $_SESSION["id"]
            );

            $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

          echo'<script>
  
            swal.fire({
                icon: "success",
                title: "El pedido ha sido anulada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "pedidos";
  
                    }
                  })
  
            </script>';
        }else{
          echo'<script>
  
            swal.fire({
                icon: "error",
                title: "El pedido no ha sido anulada",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "pedidos";
  
                    }
                  })
  
            </script>';
        }
      }
      
    }


  }