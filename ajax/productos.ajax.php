<?php

    require_once '../controllers/productos.controller.php';
    require_once '../models/productos.model.php';

    class AjaxProductos{

        public $idProducto;

        public function MostrarProductosAjax(){

            $item = 'idProducto';
            $valor = $this->idProducto;

            $respuesta = ProductosController::ctrMostrarProductos($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idProducto'])){

        $categoria = new AjaxProductos();
        $categoria -> idProducto = $_POST['idProducto'];
        $categoria -> MostrarProductosAjax();

    }