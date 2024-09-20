<?php

    require_once 'conexion.php';

    class InstitucionModel{

        public static function mdlMostrarInstitucion($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetch();

            $stmt = null;

        }

        public static function mdlEditarInstitucion($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, 
                                                                     razonSocial = :razonSocial, 
                                                                     nit = :nit, 
                                                                     telefono = :telefono, 
                                                                     correo = :correo, 
                                                                     sitioWeb = :sitioWeb,
                                                                     direccion = :direccion,
                                                                     logotipo = :logotipo 
                                                                     WHERE idInstitucion = :idInstitucion");

            $stmt -> bindParam(":idInstitucion", $datos["idInstitucion"], PDO::PARAM_INT);
            $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":razonSocial", $datos["razonSocial"], PDO::PARAM_STR);
            $stmt -> bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $stmt -> bindParam(":sitioWeb", $datos["sitioWeb"], PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt -> bindParam(":logotipo", $datos["logotipo"], PDO::PARAM_STR);

            if($stmt -> execute()){
                
                return "ok";
            
            }else{

                return $stmt -> errorInfo();

            }

            $stmt = null;

        }

    }