<?php

  require_once 'conexion.php';

  class VentasModel{

    static public function mdlMostrarVentas($tabla, $item, $valor){
      if($item != null){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
      }else{
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY noFactura DESC");
        $stmt -> execute();
        return $stmt -> fetchAll();
      }
      $stmt = null;
    }

    static public function mdlMostrarVentasSinFecha($tabla, $item, $valor){

          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY noFactura ASC");
          $stmt -> execute();
          return $stmt -> fetchAll();
        
        $stmt = null;
      }

static public function mdlMostrarVentasInicio($tabla){

      $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla ORDER BY fecha DESC");

      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt = null;

  }

      static public function mdlMostrarDetalleVenta($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
        $stmt -> execute();
        
        return $stmt -> fetchAll();
  
        $stmt = null;
  
      }

    static public function mdlInsertarVenta($tabla, $datos){
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(noFactura, uuid, serie, noSat, fecha, total, envio, usuario, cliente, metodoPago, comentarios) 
                                             VALUES (:noFactura, :uuid, :serie, :noSat, :fecha, :total, :envio, :usuario, :cliente, :metodoPago, :comentarios)");
      $stmt -> bindParam(":noFactura", $datos["noVenta"], PDO::PARAM_STR);
      $stmt -> bindParam(":uuid", $datos["uuid"], PDO::PARAM_STR);
      $stmt -> bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
      $stmt -> bindParam(":noSat", $datos["noSat"], PDO::PARAM_STR);
      $stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
      $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
      $stmt -> bindParam(":envio", $datos["envio"], PDO::PARAM_STR);
      $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
      $stmt -> bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
      $stmt -> bindParam(":metodoPago", $datos["metodoPago"], PDO::PARAM_STR);
      $stmt -> bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
      if($stmt -> execute()){
        return "ok";
      }else{
        return $stmt -> errorInfo();
      }
    }

    static public function mdlInsertarDetalleVenta($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(factura, codigo, producto, cantidad, precio, total) 
                                             VALUES (:factura, :codigo, :producto, :cantidad, :precio, :total)");
        $stmt -> bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt -> bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
        if($stmt -> execute()){
            return "ok";
        }else{
            return $stmt -> errorInfo();
        }
  
    }

    static public function mdlEliminarVenta($tabla, $datos){
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = 0 WHERE idVenta = :idVenta");
      $stmt -> bindParam(":idVenta", $datos, PDO::PARAM_INT);
      if($stmt -> execute()){
        return "ok";
      }else{
        return "error";
      }
      $stmt = null;
    }
  }
