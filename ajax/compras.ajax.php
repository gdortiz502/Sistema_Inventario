<?php

    require_once '../controllers/compras.controller.php';
    require_once '../models/compras.model.php';

    class AjaxCompras{

        public $idCompra;

        public function MostrarComprasAjax(){

            $item = 'idCompra';
            $valor = $this->idCompra;

            $respuesta = ComprasController::ctrMostrarCompras($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idCompra'])){

        $categoria = new AjaxCompras();
        $categoria -> idCompra = $_POST['idCompra'];
        $categoria -> MostrarComprasAjax();

    }