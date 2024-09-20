<?php

    require_once '../controllers/categorias.controller.php';
    require_once '../models/categorias.model.php';

    class AjaxCategorias{

        public $idCategoria;

        public function MostrarCategoriasAjax(){

            $item = 'idCategoria';
            $valor = $this->idCategoria;

            $respuesta = CategoriasController::ctrMostrarCategorias($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idCategoria'])){

        $categoria = new AjaxCategorias();
        $categoria -> idCategoria = $_POST['idCategoria'];
        $categoria -> MostrarCategoriasAjax();

    }