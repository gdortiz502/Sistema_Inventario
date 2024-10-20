<?php

    require_once '../controllers/ventas.controller.php';
    require_once '../models/ventas.model.php';

    class AjaxVentas{

        public $idVenta;

        public function MostrarVentaAjax(){

            $item = 'idVenta';
            $valor = $this->idVenta;

            $respuesta = VentasController::ctrMostrarVentas($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idVenta'])){

        $cheque = new AjaxVentas();
        $cheque -> idVenta = $_POST['idVenta'];
        $cheque -> MostrarVentaAjax();

    }