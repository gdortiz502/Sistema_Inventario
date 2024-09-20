<?php

    require_once 'conexion.php';

    class ClientesModel{

        public static function mdlMostrarClientes($tabla, $item, $valor){

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

        public static function mdlBuscarClientes($tabla, $item1, $valor1, $item2, $valor2){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :$item1 OR $item2 = :$item2");

            $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
            $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();
                


            $stmt = null;

        }

        public static function mdlMostrarNombreClientes($tabla, $item, $valor){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE '%$valor%'");

            $stmt -> execute();

            return $stmt -> fetchAll();
                
           

        }

        public static function mdlInsertarClientes($tabla, $datos){

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

        public static function mdlEditarClientes($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, 
                                                                     direccion = :direccion, 
                                                                     telefono = :telefono, 
                                                                     correo = :correo WHERE idCliente = :idCliente");

            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $stmt -> bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlActualizarClientes($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = :estatus WHERE idCliente = :idCliente");

            $stmt -> bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_INT);
            $stmt -> bindParam(":estatus", $datos["estatus"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }