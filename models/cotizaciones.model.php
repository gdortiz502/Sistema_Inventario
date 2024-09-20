<?php

  require_once 'conexion.php';

  class CotizacionesModel{

    static public function mdlMostrarCotizaciones($tabla, $item, $valor){
      if($item != null){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
      }else{
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");
        $stmt -> execute();
        return $stmt -> fetchAll();
      }
      $stmt = null;
    }

    static public function mdlMostrarCotizacionesSinFecha($tabla, $item, $valor){
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

    static public function mdlMostrarDetalleCotizacion($tabla, $item, $valor){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      
      $stmt -> execute();
      
      return $stmt -> fetchAll();

      $stmt = null;

    }

    static public function mdlInsertarCotizacion($tabla, $datos){
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(noCotizacion, total, envio, usuario, cliente, metodoPago, comentarios) 
                                             VALUES (:noCotizacion, :total, :envio, :usuario, :cliente, :metodoPago, :comentarios)");
      $stmt -> bindParam(":noCotizacion", $datos["noCotizacion"], PDO::PARAM_STR);
      $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
      $stmt -> bindParam(":envio", $datos["envio"], PDO::PARAM_STR);
      $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
      $stmt -> bindParam(":cliente", $datos["cliente"], PDO::PARAM_INT);
      $stmt -> bindParam(":metodoPago", $datos["metodoPago"], PDO::PARAM_STR);
      $stmt -> bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
      if($stmt -> execute()){
        return "ok";
      }else{
        return $stmt -> errorInfo();
      }
    }

    static public function mdlInsertarDetalleCotizacion($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigoProducto, producto, cantidad, precio, total, cotizacion) 
                                             VALUES (:codigoProducto, :producto, :cantidad, :precio, :total, :cotizacion)");
        $stmt -> bindParam(":codigoProducto", $datos["codigoProducto"], PDO::PARAM_STR);
        $stmt -> bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt -> bindParam(":cotizacion", $datos["cotizacion"], PDO::PARAM_STR);
        if($stmt -> execute()){
            return "ok";
        }else{
            return $stmt -> errorInfo();
        }

    }

    static public function mdlEliminarCotizacion($tabla, $datos){
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = 0 WHERE idCotizacion = :idCotizacion");
      $stmt -> bindParam(":idCotizacion", $datos, PDO::PARAM_INT);
      if($stmt -> execute()){
        return "ok";
      }else{
        return "error";
      }
      $stmt = null;
    }
  }
