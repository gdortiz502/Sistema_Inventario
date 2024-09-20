<?php

    class Conexion{

        public static function conectar(){

            $link = new PDO("mysql:host=nerylemus84229.ipagemysql.com;dbname=sis_pos",
							"multibb",
							"innova.12");

			$link -> exec("set names utf8");

			return $link;


        }

    }