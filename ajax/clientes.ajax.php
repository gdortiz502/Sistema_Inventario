<?php

    require_once '../controllers/clientes.controller.php';
    require_once '../models/clientes.model.php';

    class AjaxClientes{

        public $idCliente;

        public function MostrarClienteAjax(){

            $item = 'idCliente';
            $valor = $this->idCliente;

            $respuesta = ClientesController::ctrMostrarClientes($item, $valor);

            echo json_encode($respuesta);


        }

        public $nitCliente;

        public function MostrarClienteAjaxNit(){

            $item = 'nit';
            $valor = $this->nitCliente;

            $respuesta = ClientesController::ctrMostrarClientes($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idCliente'])){

        $cliente = new AjaxClientes();
        $cliente -> idCliente = $_POST['idCliente'];
        $cliente -> MostrarClienteAjax();

    }

    if(isset($_POST['nitCliente'])){

        $cliente = new AjaxClientes();
        $cliente -> nitCliente = $_POST['nitCliente'];
        $cliente -> MostrarClienteAjaxNit();

    }