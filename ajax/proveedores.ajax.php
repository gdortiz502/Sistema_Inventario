<?php

    require_once '../controllers/proveedores.controller.php';
    require_once '../models/proveedores.model.php';

    class AjaxProveedores{

        public $idProveedor;

        public function MostrarProveedorAjax(){

            $item = 'idProveedor';
            $valor = $this->idProveedor;

            $respuesta = ProveedoresController::ctrMostrarProveedores($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idProveedor'])){

        $proveedor = new AjaxProveedores();
        $proveedor -> idProveedor = $_POST['idProveedor'];
        $proveedor -> MostrarProveedorAjax();

    }