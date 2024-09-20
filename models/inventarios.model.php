<?php

    require_once 'conexion.php';

    class InventariosModel{

        public static function mdlMostrarInventario($tabla, $item, $valor){

            if($item != null){

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

                $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

                $stmt -> execute();

                return $stmt -> fetchAll();
                
            }else{
                
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

                $stmt -> execute();

                return $stmt->fetchAll();

            }

            $stmt = null;

        }

        public static function mdlInsertarInventario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cantidad, producto) 
                                                   VALUES (:cantidad, :producto)");

            $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
            $stmt -> bindParam(":producto", $datos["producto"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlAgregarInventario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantidad = cantidad + :cantidad
                                                                 WHERE idInventario = :idInventario");

            $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
            $stmt -> bindParam(":idInventario", $datos["idInventario"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlRestarInventario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantidad = cantidad - :cantidad
                                                                 WHERE idInventario = :idInventario");

            $stmt -> bindParam(":idInventario", $datos["idInventario"], PDO::PARAM_INT);
            $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }