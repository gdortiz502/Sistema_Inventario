<?php

    require_once '../controllers/usuarios.controller.php';
    require_once '../models/usuarios.model.php';

    class AjaxUsuarios{

        public $idUsuario;

        public function MostrarUsuariosAjax(){

            $item = 'idUsuario';
            $valor = $this->idUsuario;

            $respuesta = UsuariosController::ctrMostrarUsuarios($item, $valor);

            echo json_encode($respuesta);


        }

    }

    if(isset($_POST['idUsuario'])){

        $categoria = new AjaxUsuarios();
        $categoria -> idUsuario = $_POST['idUsuario'];
        $categoria -> MostrarUsuariosAjax();

    }