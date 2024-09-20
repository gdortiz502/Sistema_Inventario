<?php

    class HistorialController{

        public static function ctrMostrarHistorial(){

            $tabla = "historial";

            $respuesta = HistorialModel::mdlMostrarHistorial($tabla);

            return $respuesta;

        }

    }