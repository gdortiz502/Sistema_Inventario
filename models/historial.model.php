<?php

    require_once 'conexion.php';

    class HistorialModel{

        public static function mdlMostrarHistorial($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha");

            $stmt -> execute();

            return $stmt -> fetchAll();

            $stmt = null;

        }

        public static function mdlInsertarHistorial($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, usuario) VALUES (:descripcion, :usuario)");

            $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

            $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }