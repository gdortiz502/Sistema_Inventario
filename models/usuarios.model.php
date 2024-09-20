<?php

    require_once 'conexion.php';

    class UsuariosModel{

        public static function mdlMostrarUsuarios($tabla, $item, $valor){

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

        public static function mdlInsertarUsuario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, nombre, usuario, password, direccion, telefono, correo, nivel, imagen) 
                                                          VALUES (:codigo, :nombre, :usuario, :password, :direccion, :telefono, :correo, :nivel, :imagen)");

            $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $stmt -> bindParam(":nivel", $datos["nivel"], PDO::PARAM_INT);
            $stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlEditarUsuario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, 
                                                                     password = :password, 
                                                                     direccion = :direccion, 
                                                                     telefono = :telefono, 
                                                                     correo = :correo, 
                                                                     nivel = :nivel, 
                                                                     imagen = :imagen 
                                                                     WHERE idUsuario = :idUsuario");

            $stmt -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $stmt -> bindParam(":nivel", $datos["nivel"], PDO::PARAM_INT);
            $stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

        public static function mdlActualizarUsuario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = :estatus WHERE idUsuario = :idUsuario");

            $stmt -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
            $stmt -> bindParam(":estatus", $datos["estatus"], PDO::PARAM_INT);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }