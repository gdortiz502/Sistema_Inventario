<?php

    require_once '../controllers/inventarios.controller.php';
    require_once '../models/inventarios.model.php';

    class AjaxInventarios{

        public $idInventario;

        public function MostrarInventarioAjax(){

            $item = 'idInventario';
            $valor = $this->idInventario;

            $respuesta = InventariosController::ctrMostrarInventario($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idInventario'])){

        $categoria = new AjaxInventarios();
        $categoria -> idInventario = $_POST['idInventario'];
        $categoria -> MostrarInventarioAjax();

    }