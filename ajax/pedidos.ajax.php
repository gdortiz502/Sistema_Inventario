<?php

    require_once '../controllers/pedidos.controller.php';
    require_once '../models/pedidos.model.php';

    class AjaxPedidos{

        public $idPedido;

        public function MostrarPedidoAjax(){

            $item = 'idPedido';
            $valor = $this->idPedido;

            $respuesta = PedidosController::ctrMostrarPedidos($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idPedido'])){

        $categoria = new AjaxPedidos();
        $categoria -> idPedido = $_POST['idPedido'];
        $categoria -> MostrarPedidoAjax();

    }