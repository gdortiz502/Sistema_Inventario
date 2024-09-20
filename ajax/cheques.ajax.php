<?php

    require_once '../controllers/cheques.controller.php';
    require_once '../models/cheques.model.php';

    class AjaxCheques{

        public $idCheque;

        public function MostrarChequeAjax(){

            $item = 'idControl';
            $valor = $this->idCheque;

            $respuesta = ChequesController::ctrMostrarCheques($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idCheque'])){

        $cheque = new AjaxCheques();
        $cheque -> idCheque = $_POST['idCheque'];
        $cheque -> MostrarChequeAjax();

    }