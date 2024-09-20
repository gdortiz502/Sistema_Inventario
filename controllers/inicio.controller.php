<?php

    class InicioController{

        public static function ctrMostrarCantidades(){

            $respuesta = InicioModel::mdlMostrarTotalCompras();

            return $respuesta;

        }

        public static function ctrMostrarInventarios(){

            $respuesta = InicioModel::mdlMostrarInventarios();

            $total = 0;

            for ($i=0; $i < count($respuesta); $i++) { 

                $itemProducto = "idProducto";

                $valorProducto = $respuesta[$i]["producto"];

                $respuestaProducto = ProductosController::ctrMostrarProductos($itemProducto, $valorProducto);

                $total += $respuesta[$i]['cantidad'] * $respuestaProducto[0]["precioVenta"];

            }

            return $total;

        }

        public static function ctrMostrarTotalCheques(){

            $respuesta = InicioModel::mdlMostrarTotalCheques();

            return $respuesta;

        }

        public static function ctrMostrarTotalVentas(){

            $respuesta = InicioModel::mdlMostrarTotalVentas();

            return $respuesta;

        }

        public static function ctrMostrarTotalesVentas(){

            $respuesta = InicioModel::mdlMostrarTotalesVentas();

            return $respuesta;

        }

        public static function ctrMostrarTotalProductos(){

            $respuesta = InicioModel::mdlMostrarTotalProductos();

            return $respuesta;

        }

        public static function ctrMostrarTotalCotizaciones(){

            $respuesta = InicioModel::mdlMostrarTotalCotizaciones();

            return $respuesta;

        }

        public static function ctrMostrarTotalPedidos(){

            $respuesta = InicioModel::mdlMostrarTotalPedidos();

            return $respuesta;

        }

    }