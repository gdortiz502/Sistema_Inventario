<?php

    require_once 'conexion.php';

    class ProductosModel{

        public static function mdlMostrarProductos($tabla, $item, $valor){

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

        public static function mdlInsertarProducto($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, descripcion, precioCompra, precioVenta, categoria, proveedor, imagen) 
                                                   VALUES (:codigo, :descripcion, :precioCompra, :precioVenta, :categoria, :proveedor, :imagen)");

            $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt -> bindParam(":precioCompra", $datos["precioCompra"], PDO::PARAM_STR);
            $stmt -> bindParam(":precioVenta", $datos["precioVenta"], PDO::PARAM_STR);
            $stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_INT);
            $stmt -> bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_INT);
            $stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlEditarProductos($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, 
                                                                     precioCompra = :precioCompra, 
                                                                     precioVenta = :precioVenta,
                                                                     categoria = :categoria,
                                                                     proveedor = :proveedor,
                                                                     imagen = :imagen WHERE idProducto = :idProducto");

            $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt -> bindParam(":precioCompra", $datos["precioCompra"], PDO::PARAM_STR);
            $stmt -> bindParam(":precioVenta", $datos["precioVenta"], PDO::PARAM_STR);
            $stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_INT);
            $stmt -> bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_INT);
            $stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
            $stmt -> bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlActualizarProducto($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = :estatus WHERE idProducto = :idProducto");

            $stmt -> bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);
            $stmt -> bindParam(":estatus", $datos["estatus"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }