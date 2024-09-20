<?php

    require_once 'conexion.php';

    class InicioModel{

        public static function mdlMostrarTotalCompras(){

            $stmt = Conexion::conectar()->prepare("SELECT SUM(total) total FROM compras");

            $stmt -> execute();

            return $stmt -> fetch();

        }

        public static function mdlMostrarInventarios(){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM inventario");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        public static function mdlMostrarTotalCheques(){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) total FROM controlcheques");

            $stmt -> execute();

            return $stmt->fetch();

        }

        public static function mdlMostrarTotalVentas(){

            $stmt = Conexion::conectar()->prepare("SELECT SUM(total) total FROM ventas");

            $stmt -> execute();

            return $stmt->fetch();

        }

        public static function mdlMostrarTotalesVentas(){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) total FROM ventas");

            $stmt -> execute();

            return $stmt->fetch();

        }

        public static function mdlMostrarTotalProductos(){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) total FROM productos");

            $stmt -> execute();

            return $stmt->fetch();

        }

        public static function mdlMostrarTotalCotizaciones(){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) total FROM cotizaciones");

            $stmt -> execute();

            return $stmt->fetch();

        }

        public static function mdlMostrarTotalPedidos(){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) total FROM pedidos");

            $stmt -> execute();

            return $stmt->fetch();

        }

    }