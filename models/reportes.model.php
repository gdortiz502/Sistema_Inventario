<?php

    require_once 'conexion.php';

    class ReportesModel{

        public static function mdlMostrarReportes($tabla, $item, $valor1, $valor2){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item BETWEEN :fecha1 AND :fecha2");

            $stmt -> bindParam(":fecha1", $valor1, PDO::PARAM_STR);
            
            $stmt -> bindParam(":fecha2", $valor2, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

            $stmt = null;

        }

    }