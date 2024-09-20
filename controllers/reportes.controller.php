<?php

    class ReportesController{

        public static function ctrMostrarReportes($tabla, $item1, $valor1, $valor2){

            $respuesta = ReportesModel::mdlMostrarReportes($tabla, $item1, $valor1, $valor2);

            return $respuesta;

        }

    }