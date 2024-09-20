<?php

    require_once 'conexion.php';

    class ChequesModel{

        public static function mdlMostrarCheques($tabla, $item, $valor){

            if($item != null){

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

                $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

                $stmt -> execute();

                return $stmt -> fetch();

            }else{

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

                $stmt -> execute();

                return $stmt -> fetchAll();

            }

            $stmt = null;

        }

        public static function mdlInsertarCheque($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, fecha, concepto, total, usuario, noCheque) 
                                                    VALUES (:descripcion, :fecha, :concepto, :total, :usuario, :noCheque)");

            $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt -> bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
            $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
            $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
            $stmt -> bindParam(":noCheque", $datos["noCheque"], PDO::PARAM_STR);

            if($stmt -> execute()){

                return "ok";

            }else{

                return $stmt -> errorInfo();

            }

        }

        public static function mdlEditarCheque($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, fecha = :fecha, concepto = :concepto, total = :total, noCheque = :noCheque 
                                                    WHERE idControl = :idControl");

            $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt -> bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
            $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
            $stmt -> bindParam(":idControl", $datos["idCheque"], PDO::PARAM_INT);
            $stmt -> bindParam(":noCheque", $datos["noCheque"], PDO::PARAM_STR);

            if($stmt -> execute()){

                return "ok";

            }else{

                return $stmt -> errorInfo();

            }

        }

        public static function mdlEliminarCheque($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idControl = :idControl");

            $stmt -> bindParam(":idControl", $datos, PDO::PARAM_INT);

            if($stmt -> execute()){

                return "ok";

            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }