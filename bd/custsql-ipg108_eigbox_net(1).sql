-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: custsql-ipg108.eigbox.net
-- Generation Time: Sep 14, 2024 at 09:46 AM
-- Server version: 5.6.51-91.0-log
-- PHP Version: 7.0.33-0ubuntu0.16.04.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis_pos`
--
CREATE DATABASE IF NOT EXISTS `sis_pos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sis_pos`;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `descripcion`, `estatus`) VALUES
(1, 'Prefabricado', 1),
(2, 'Materiales de construcción', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nit`, `codigo`, `nombre`, `direccion`, `telefono`, `correo`, `estatus`) VALUES
(1, '7895561', '003', 'Allan Bravo', 'CIUDAD\r\n', '30772600', '', 1),
(2, 'C/F', '001', 'Misael Arrivillaga', 'Ciudad', '50020030', '', 1),
(3, '104595469', '004', 'Grupo Querencia, Sociedad Anónima', '', '', '', 1),
(4, 'C/F', '005', 'DISTRIBUIDORA CORDOBA', '', '57254437', 'HECTOR CORDOVA', 1),
(5, 'sin nit', '006', 'sin nombre', '', '', '', 1),
(6, '104130237', '007', 'Corporacion de Construcciones y Ferreteria, Sociedad Anónima', '', '', '', 1),
(7, '104130237', '005', 'CORPORACION DE CONSTRUCCION Y FERRETERIA, SOCIEDAD ANONIMA', 'Ciudad', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `idCompra` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `proveedor` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `noSat` text NOT NULL,
  `serie` text NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `fecha` date NOT NULL,
  `total` decimal(28,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `controlcheques`
--

CREATE TABLE `controlcheques` (
  `idControl` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `total` decimal(28,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `noCheque` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `idCotizacion` int(11) NOT NULL,
  `noCotizacion` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `total` decimal(28,2) NOT NULL,
  `envio` decimal(28,2) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `metodoPago` text NOT NULL,
  `comentarios` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detallecotizacion`
--

CREATE TABLE `detallecotizacion` (
  `idDetalle` int(11) NOT NULL,
  `codigoProducto` varchar(200) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(28,2) NOT NULL,
  `total` decimal(28,2) NOT NULL,
  `cotizacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idDetalle` int(11) NOT NULL,
  `codigoProducto` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(28,2) NOT NULL,
  `total` decimal(28,2) NOT NULL,
  `pedido` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detalleventa`
--

CREATE TABLE `detalleventa` (
  `idDetalle` int(11) NOT NULL,
  `factura` text NOT NULL,
  `codigo` varchar(60) NOT NULL,
  `producto` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(28,2) NOT NULL,
  `total` decimal(28,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detalleventa`
--

INSERT INTO `detalleventa` (`idDetalle`, `factura`, `codigo`, `producto`, `cantidad`, `precio`, `total`) VALUES
(1, '10001', 'TC30E', 'Tubo de concreto de 30 pulgadas estándar', 7, '335.00', '2345.00'),
(2, '10002', 'TC30E', 'Tubos de concreto de 30 pulgadas estándar', 1, '335.00', '335.00');

-- --------------------------------------------------------

--
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `idHistorial` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historial`
--

INSERT INTO `historial` (`idHistorial`, `descripcion`, `usuario`, `fecha`) VALUES
(6, 'Inserción del cliente Corporacion de Construcciones y Ferreteria, Sociedad Anónima', 4, '2021-09-13 18:02:58'),
(7, 'Inserción del cliente CORPORACION DE CONSTRUCCION Y FERRETERIA, SOCIEDAD ANONIMA', 4, '2021-09-27 12:47:40'),
(8, 'Creación de la venta No. 10003', 4, '2021-09-27 12:51:02'),
(9, 'Edición del usuario Nery Lemus', 4, '2023-05-25 12:11:44'),
(10, 'Edición del usuario Nery Lemus', 4, '2023-05-25 12:12:59'),
(11, 'La categoria Prefabricado', 1, '2024-09-05 23:35:24'),
(12, 'La categoria Prefabricado', 1, '2024-09-05 23:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `institucion`
--

CREATE TABLE `institucion` (
  `idInstitucion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `razonSocial` text NOT NULL,
  `nit` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `sitioWeb` varchar(100) NOT NULL,
  `logotipo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institucion`
--

INSERT INTO `institucion` (`idInstitucion`, `nombre`, `razonSocial`, `nit`, `direccion`, `telefono`, `correo`, `sitioWeb`, `logotipo`) VALUES
(1, 'Multiproyectos BBJ', 'Multiproyectos BBJ S.A.', '105056804', 'KM 18.5 Carretera a San Juan Sacatepéquez 41-65 Aldea el Naranjito, Zona 6 de Mixco, Guatemala', '2438-4685', 'gerencia@multiproyectosbbj.com', 'multiproyectosbbj.com', 'views/img/logotipo/532.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`idInventario`, `cantidad`, `producto`, `fecha`) VALUES
(1, 85, 1, '0000-00-00 00:00:00'),
(2, 137, 2, '0000-00-00 00:00:00'),
(3, 98, 3, '0000-00-00 00:00:00'),
(4, 109, 4, '0000-00-00 00:00:00'),
(5, 35, 5, '0000-00-00 00:00:00'),
(6, 124, 6, '0000-00-00 00:00:00'),
(7, 49, 7, '0000-00-00 00:00:00'),
(8, 45, 8, '0000-00-00 00:00:00'),
(9, 21, 9, '0000-00-00 00:00:00'),
(10, 27, 10, '0000-00-00 00:00:00'),
(11, 0, 12, '0000-00-00 00:00:00'),
(12, 0, 13, '0000-00-00 00:00:00'),
(13, 0, 21, '0000-00-00 00:00:00'),
(14, 0, 15, '0000-00-00 00:00:00'),
(15, 0, 16, '0000-00-00 00:00:00'),
(16, 0, 17, '0000-00-00 00:00:00'),
(17, 0, 19, '0000-00-00 00:00:00'),
(18, 0, 20, '0000-00-00 00:00:00'),
(19, 0, 14, '0000-00-00 00:00:00'),
(20, 19, 11, '0000-00-00 00:00:00'),
(21, 0, 18, '0000-00-00 00:00:00'),
(22, 52, 22, '0000-00-00 00:00:00'),
(23, 6, 23, '0000-00-00 00:00:00'),
(24, 13, 25, '0000-00-00 00:00:00'),
(25, 8, 26, '0000-00-00 00:00:00'),
(26, 7, 27, '0000-00-00 00:00:00'),
(27, 40, 28, '0000-00-00 00:00:00'),
(28, 800, 29, '0000-00-00 00:00:00'),
(29, 8, 30, '0000-00-00 00:00:00'),
(30, 83, 31, '0000-00-00 00:00:00'),
(31, 0, 32, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nivelusuarios`
--

CREATE TABLE `nivelusuarios` (
  `idNivel` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nivelusuarios`
--

INSERT INTO `nivelusuarios` (`idNivel`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `noPedido` varchar(100) NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaEntrega` date NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `total` decimal(28,2) NOT NULL,
  `envio` decimal(28,2) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `metodoPago` text NOT NULL,
  `comentarios` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precioCompra` decimal(28,2) NOT NULL,
  `precioVenta` decimal(28,2) NOT NULL,
  `categoria` int(11) NOT NULL,
  `proveedor` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `imagen` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`idProducto`, `codigo`, `descripcion`, `precioCompra`, `precioVenta`, `categoria`, `proveedor`, `estatus`, `imagen`, `fecha`) VALUES
(1, 'TC4E', 'Tubo de concreto de 4 pulgadas estándar', '20.00', '25.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-07-28 17:48:06'),
(2, 'TC6E', 'Tubo de concreto de 6 pulgadas estándar', '28.00', '32.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-07-28 17:48:53'),
(3, 'TC8E', 'Tubo de concreto de 8 pulgadas estándar', '25.00', '40.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 12:40:13'),
(4, 'TC10E', 'Tubo de concreto de 10 pulgadas estandar', '35.00', '50.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 12:46:29'),
(5, 'TC12E', 'Tubo de concreto de 12 pulgadas estándar', '46.00', '65.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 12:48:35'),
(6, 'TC16E', 'Tubo de concreto de 16 pulgadas estandar ', '67.00', '95.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 12:51:27'),
(7, 'TC18E', 'Tubo de concreto de 18 pulgadas estándar', '78.00', '112.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 12:53:28'),
(8, 'TC20E', 'Tubo de concreto de 20 pulgadas estándar ', '102.00', '145.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 12:56:22'),
(9, 'TC24E', 'Tubo de concreto de 24 pulgadas estándar', '140.00', '200.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 12:58:51'),
(10, 'TC30E', 'Tubo de concreto de 30 pulgadas estándar', '235.00', '335.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 13:01:31'),
(11, 'TC36E', 'Tubo de concreto de 36 pulgadas estándar', '308.00', '440.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 13:03:18'),
(12, 'TC42E', 'Tubo de concreto de 42 pulgadas estándar', '466.00', '665.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 13:04:49'),
(13, 'TC48E', 'Tubo de concreto de 48 estándar', '588.00', '840.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 13:06:06'),
(14, 'TC60E', 'Tubo de concreto de 60 pulgadas estándar', '1264.00', '1580.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:15:49'),
(15, 'TC66E', 'Tubo de concreto de 66 pulgadas estándar ', '1680.00', '2400.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:18:43'),
(16, 'TC24R', 'Tubo de concreto de 24 pulgadas reforzado', '260.00', '325.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:30:39'),
(17, 'TC30R', 'Tubo de concreto de 30 pulgadas reforzado', '420.00', '525.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:33:12'),
(18, 'TC36R', 'Tubo de concreto de 36 pulgadas reforzado', '552.00', '690.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:35:50'),
(19, 'TC42R', 'Tubo de concreto de 42 pulgadas reforzado', '712.00', '890.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:38:19'),
(20, 'TC48R', 'Tubo de concreto de 48 pulgadas reforzado', '924.00', '1155.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:45:22'),
(21, 'TC60R', 'Tubo de concreto de 60 pulgadas reforzado', '1264.00', '1660.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 14:52:22'),
(22, 'CC', 'Caja para Contador', '44.00', '55.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 15:54:53'),
(23, 'CLP', 'Caja llave de Paso', '32.00', '40.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 15:56:24'),
(24, 'TAP12', 'Tapaderas 12 pulgadas', '32.00', '40.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 15:58:57'),
(25, 'TAP10', 'Tapaderas 10 pulgadas', '24.00', '30.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 15:59:43'),
(26, 'TAP16', 'Tapadera 16 pulgadas', '36.00', '45.00', 1, 2, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 16:01:04'),
(27, 'LT', 'Ladrillo Tayuyo', '1.15', '1.75', 2, 4, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 16:03:17'),
(28, 'BL', 'Block ', '2.75', '3.80', 2, 5, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 16:10:09'),
(29, 'Cem', 'Cemento UGC', '77.00', '79.00', 2, 1, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 16:13:26'),
(30, 'CEMARI', 'Cemento AriBlock', '77.00', '85.00', 2, 1, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 16:14:32'),
(31, 'CAL', 'Horcalsa 20kg', '30.50', '32.50', 2, 1, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 16:29:19'),
(32, 'HR38', 'Hierro 3/8', '263.37', '292.63', 2, 1, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 16:43:10'),
(33, 'HR12', 'Hierro de 1/2', '263.37', '266.00', 2, 1, 1, 'views/img/productos/default/anonymous.png', '2021-08-10 17:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `codigo`, `nit`, `nombre`, `direccion`, `telefono`, `correo`, `estatus`) VALUES
(1, 'Ari Block', '7894561', 'Cementos Progreso', '', '', '', 1),
(2, '001', '105056804', 'Multiproyectos BBJ', '', '', '', 1),
(3, '002', '7896321', 'La Roca', '', '', '', 1),
(4, 'tejar', 'cf', 'El Tejar', '', '40080048', '', 1),
(5, 'Blocasa', '1026332-0', 'Blocasa', '', '31288935', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `nivel` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `codigo`, `nombre`, `usuario`, `password`, `direccion`, `telefono`, `correo`, `nivel`, `estatus`, `imagen`) VALUES
(1, 'VT001', 'Nery Lemus', 'nlemus', '$2a$07$asxx54ahjppf45sd87a5aunxs9bkpyGmGE/.vekdjFg83yRec789S', '', '', '', 1, 1, 'views/img/users/user_default.jpg'),
(2, 'VT002', 'Allan Bravo', 'abravo', '$2a$07$asxx54ahjppf45sd87a5auhqnJQl10saaorDca.aRGcQKnGbunafO', 'CIUDAD', '30772600', '	\r\nallanqbravo@gmail.com', 2, 1, 'views/img/users/user_default.jpg'),
(3, 'VT003', 'Sayra Andrino', 'sandrino', '$2a$07$asxx54ahjppf45sd87a5auAHee/ejKHo7RmEpSzTDTyu1JlsvIKhG', 'CIUDAD', '55517072', '	\r\nsandrino@multiproyectosbbj.com\r\n', 1, 1, 'views/img/users/user_default.jpg'),
(4, 'VT004', 'Nery Lemus', 'nilemusa', '$2a$07$asxx54ahjppf45sd87a5auBuiNCPQPwVohwjcQDuJuenC8lLDwP9K', 'CIUDAD', '46686391', 'nlemus@multiproyectosbbj.com', 2, 1, 'views/img/users/VT004/676.jpg'),
(5, 'VT007', 'Brandon Marroquin', 'bmarroquin', '$2a$07$asxx54ahjppf45sd87a5auPI9JzqZLPVcMGlyUFSIgBy6HEdzvHuK', '', '45363777', 'brandonemarroquin7@gmail.com\r\n', 1, 1, 'views/img/users/user_default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `noFactura` varchar(100) NOT NULL,
  `uuid` text NOT NULL,
  `serie` varchar(60) NOT NULL,
  `noSat` varchar(60) NOT NULL,
  `fecha` datetime NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `total` decimal(28,2) NOT NULL,
  `envio` decimal(28,2) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `metodoPago` text NOT NULL,
  `comentarios` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`idVenta`, `noFactura`, `uuid`, `serie`, `noSat`, `fecha`, `estatus`, `total`, `envio`, `usuario`, `cliente`, `metodoPago`, `comentarios`) VALUES
(1, '10001', '1027098786', 'B046D9E6', 'B046D9E6-3D38-48A2-BD1F-DAAAEBACE311', '2021-08-30 17:45:33', 1, '2495.00', '150.00', 4, 3, 'Deposito No. 900431634', ''),
(2, '10002', '00', '00', '00', '2021-08-30 17:48:38', 1, '335.00', '0.00', 4, 5, 'Efectivo', ''),
(3, '10003', 'A9555D8B-3056-4405-9135-59DB032E0D0F', 'A9555D8B', '810959877', '2021-09-13 15:56:13', 1, '650.00', '0.00', 4, 6, 'Efectivo', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `proveedor` (`proveedor`),
  ADD KEY `usuario` (`usuario`);

--
-- Indexes for table `controlcheques`
--
ALTER TABLE `controlcheques`
  ADD PRIMARY KEY (`idControl`),
  ADD KEY `usuario` (`usuario`);

--
-- Indexes for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`idCotizacion`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `cliente` (`cliente`);

--
-- Indexes for table `detallecotizacion`
--
ALTER TABLE `detallecotizacion`
  ADD PRIMARY KEY (`idDetalle`);

--
-- Indexes for table `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`idDetalle`);

--
-- Indexes for table `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`idDetalle`);

--
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idHistorial`),
  ADD KEY `usuario` (`usuario`);

--
-- Indexes for table `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`idInstitucion`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `producto` (`producto`);

--
-- Indexes for table `nivelusuarios`
--
ALTER TABLE `nivelusuarios`
  ADD PRIMARY KEY (`idNivel`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `cliente` (`cliente`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `proveedor` (`proveedor`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `nivel` (`nivel`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `cliente` (`cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `controlcheques`
--
ALTER TABLE `controlcheques`
  MODIFY `idControl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `idCotizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detallecotizacion`
--
ALTER TABLE `detallecotizacion`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `historial`
--
ALTER TABLE `historial`
  MODIFY `idHistorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `institucion`
--
ALTER TABLE `institucion`
  MODIFY `idInstitucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `nivelusuarios`
--
ALTER TABLE `nivelusuarios`
  MODIFY `idNivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`proveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Constraints for table `controlcheques`
--
ALTER TABLE `controlcheques`
  ADD CONSTRAINT `controlcheques_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Constraints for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`idCliente`);

--
-- Constraints for table `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`idProducto`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idCategoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`proveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`nivel`) REFERENCES `nivelusuarios` (`idNivel`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
