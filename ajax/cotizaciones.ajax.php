<?php

    require_once '../controllers/cotizaciones.controller.php';
    require_once '../models/cotizaciones.model.php';

    class AjaxCotizaciones{

        public $idCotizacion;

        public function MostrarCotizacionAjax(){

            $item = 'idCotizacion';
            $valor = $this->idCotizacion;

            $respuesta = CotizacionesController::ctrMostrarCotizaciones($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idCotizacion'])){

        $categoria = new AjaxCotizaciones();
        $categoria -> idCotizacion = $_POST['idCotizacion'];
        $categoria -> MostrarCotizacionAjax();

    }