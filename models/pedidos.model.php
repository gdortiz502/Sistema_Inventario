<?php

  require_once 'conexion.php';

  class PedidosModel{

    static public function mdlMostrarPedidos($tabla, $item, $valor){
      if($item != null){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
      }else{
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fechaCreacion DESC");
        $stmt -> execute();
        return $stmt -> fetchAll();
      }
      $stmt = null;
    }

    static public function mdlMostrarPedidosInicio($tabla){

      $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla ORDER BY fechaCreacion DESC LIMIT 7");

      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt = null;

  }

    static public function mdlMostrarPedidosSinFecha($tabla, $item, $valor){
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

    static public function mdlMostrarDetallePedido($tabla, $item, $valor){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      
      $stmt -> execute();
      
      return $stmt -> fetchAll();

      $stmt = null;

    }

    static public function mdlInsertarPedido($tabla, $datos){
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(noPedido, fechaEntrega, total, envio, usuario, cliente, metodoPago, comentarios) 
                                             VALUES (:noPedido, :fechaEntrega, :total, :envio, :usuario, :cliente, :metodoPago, :comentarios)");

      $stmt -> bindParam(":noPedido", $datos["noPedido"], PDO::PARAM_STR);
      $stmt -> bindParam(":fechaEntrega", $datos["fechaEntrega"], PDO::PARAM_STR);
      $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
      $stmt -> bindParam(":envio", $datos["envio"], PDO::PARAM_STR);
      $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
      $stmt -> bindParam(":cliente", $datos["cliente"], PDO::PARAM_INT);
      $stmt -> bindParam(":metodoPago", $datos["metodoPago"], PDO::PARAM_STR);
      $stmt -> bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
      if($stmt -> execute()){
        return "ok";
      }else{
        return "error";
      }
    }

    static public function mdlInsertarDetallePedido($tabla, $datos){

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigoProducto, descripcion, cantidad, precio, total, pedido) 
                                           VALUES (:codigoProducto, :descripcion, :cantidad, :precio, :total, :pedido)");
      $stmt -> bindParam(":codigoProducto", $datos["codigoProducto"], PDO::PARAM_STR);
      $stmt -> bindParam(":descripcion", $datos["producto"], PDO::PARAM_STR);
      $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
      $stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
      $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
      $stmt -> bindParam(":pedido", $datos["pedido"], PDO::PARAM_STR);
      if($stmt -> execute()){
          return "ok";
      }else{
          return $stmt -> errorInfo();
      }

    }

    

    static public function mdlEliminarPedido($tabla, $datos){
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estatus = 0 WHERE idPedido = :idPedido");
      $stmt -> bindParam(":idPedido", $datos, PDO::PARAM_INT);
      if($stmt -> execute()){
        return "ok";
      }else{
        return "error";
      }
      $stmt = null;
    }
  }
