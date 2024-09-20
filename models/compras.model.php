<?php

    require_once 'conexion.php';

    class ComprasModel{

        public static function mdlMostrarCompras($tabla, $item, $valor){

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

        public static function mdlInsertarCompra($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, proveedor, uuid, noSat, serie, fecha, total, usuario, comentario) VALUES
                                                                     (:descripcion, :proveedor, :uuid, :noSat, :serie, :fecha, :total, :usuario, :comentario)");

            $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt -> bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_INT);
            $stmt -> bindParam(":uuid", $datos["uuid"], PDO::PARAM_STR);
            $stmt -> bindParam(":noSat", $datos["noSat"], PDO::PARAM_STR);
            $stmt -> bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
            $stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
            $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
            $stmt -> bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);

            if($stmt -> execute()){

                return "ok";

            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlEditarCompra($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, 
                                                                     proveedor = :proveedor, 
                                                                     uuid = :uuid, 
                                                                     noSat = :noSat,  
                                                                     serie = :serie, 
                                                                     fecha = :fecha, 
                                                                     total = :total, 
                                                                     comentario = :comentario
                                                                     WHERE idCompra = :idCompra");

            $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt -> bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_INT);
            $stmt -> bindParam(":uuid", $datos["uuid"], PDO::PARAM_STR);
            $stmt -> bindParam(":noSat", $datos["noSat"], PDO::PARAM_STR);
            $stmt -> bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
            $stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
            $stmt -> bindParam(":idCompra", $datos["idCompra"], PDO::PARAM_INT);
            $stmt -> bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);

            if($stmt -> execute()){

                return "ok";

            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlActualizarCompra($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = :estatus WHERE idCompra = :idCompra");

            $stmt -> bindParam(":idCompra", $datos["idCompra"], PDO::PARAM_INT);
            $stmt -> bindParam(":estatus", $datos["estatus"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }