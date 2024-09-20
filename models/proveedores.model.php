<?php

    require_once 'conexion.php';

    class ProveedoresModel{

        public static function mdlMostrarProveedores($tabla, $item, $valor){

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

        public static function mdlInsertarProveedores($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, nit, nombre, direccion, telefono, correo) 
                                                   VALUES (:codigo, :nit, :nombre,:direccion, :telefono, :correo)");

            $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt -> bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlEditarProveedores($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, 
                                                                     direccion = :direccion, 
                                                                     telefono = :telefono, 
                                                                     correo = :correo WHERE idProveedor = :idProveedor");

            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $stmt -> bindParam(":idProveedor", $datos["idProveedor"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlActualizarProveedores($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = :estatus WHERE idProveedor = :idProveedor");

            $stmt -> bindParam(":idProveedor", $datos["idProveedor"], PDO::PARAM_INT);
            $stmt -> bindParam(":estatus", $datos["estatus"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }