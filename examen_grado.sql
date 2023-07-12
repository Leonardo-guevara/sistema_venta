-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql.helpfibo.com
-- Generation Time: Jul 12, 2023 at 06:25 AM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examen_grado`
--

-- --------------------------------------------------------

--
-- Table structure for table `arqueo_caja`
--

CREATE TABLE `arqueo_caja` (
  `idarqueo_caja` int NOT NULL,
  `fkcaja` int DEFAULT NULL,
  `fk_usuario` int DEFAULT NULL,
  `monto_inicial` decimal(8,2) DEFAULT '0.00',
  `monto_final` decimal(8,2) DEFAULT '0.00',
  `total_ventas` decimal(8,2) DEFAULT '0.00',
  `horario_inicio` datetime DEFAULT NULL,
  `horario_final` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `arqueo_caja`
--

INSERT INTO `arqueo_caja` (`idarqueo_caja`, `fkcaja`, `fk_usuario`, `monto_inicial`, `monto_final`, `total_ventas`, `horario_inicio`, `horario_final`) VALUES
(1, 1, 1, 100.00, 1.00, 3.00, '2023-07-12 05:53:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `caja`
--

CREATE TABLE `caja` (
  `idcaja` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `detalle` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `caja`
--

INSERT INTO `caja` (`idcaja`, `name`, `detalle`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CAJA UNO', 'caja del frente', '2023-07-12 05:52:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S/N	', '2023-07-11 19:33:33', '2023-07-11 19:33:41', NULL),
(2, 'ASEO PERSONAL', '2023-07-11 19:33:48', NULL, NULL),
(3, 'DULCE', '2023-07-11 19:33:54', NULL, NULL),
(4, 'MATERIAL DE ESCRITORIO', '2023-07-11 19:34:02', NULL, NULL),
(5, 'BEBIDAS', '2023-07-11 19:34:09', NULL, NULL),
(6, 'INSENTISIDA', '2023-07-11 19:34:19', NULL, NULL),
(7, 'MATERIAL DE BIOSEGURIDAD', '2023-07-11 19:34:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `idcompra` int NOT NULL,
  `producto` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `cantidad` int NOT NULL,
  `precio_compra` decimal(8,2) NOT NULL,
  `precio_venta` decimal(8,2) NOT NULL,
  `usuario` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`idcompra`, `producto`, `name`, `cantidad`, `precio_compra`, `precio_venta`, `usuario`, `created_at`) VALUES
(1, '7791293008141', 'nuevo', 100, 100.00, 130.00, 1, '2023-07-12 12:59:25'),
(2, '7791293008141', 'actualizo', 0, 10.00, 13.00, 1, '2023-07-12 12:59:27'),
(3, '7791293008141', 'agregar', 4, 10.00, 13.00, 1, '2023-07-12 12:59:32'),
(4, '7791293008141', 'ajuste', -4, 10.00, 13.00, 1, '2023-07-12 12:59:44'),
(5, '1237791293008141', 'agregar', 3, 10.00, 13.00, 1, '2023-07-12 12:59:49'),
(6, '7892725444', 'nuevo', 25, 8.00, 10.00, 1, '2023-07-12 13:00:14'),
(7, '7774904402965', 'nuevo', 100, 7.00, 10.00, 1, '2023-07-12 13:00:32'),
(8, '7772115420044', 'nuevo', 120, 4.00, 6.00, 1, '2023-07-12 13:00:49'),
(9, '7770108930013', 'nuevo', 100, 0.50, 1.00, 1, '2023-07-12 13:01:00'),
(10, '7776501000414', 'nuevo', 50, 2.00, 4.00, 1, '2023-07-12 13:01:16'),
(11, '7776501000414', 'nuevo', 36, 8.00, 10.00, 1, '2023-07-12 13:01:41'),
(12, '7771620590020', 'nuevo', 40, 4.00, 5.00, 1, '2023-07-12 13:01:59'),
(13, '2147483647', 'nuevo', 40, 5.00, 8.00, 1, '2023-07-12 12:08:39'),
(14, '7771605000124', 'nuevo', 36, 4.00, 6.00, 1, '2023-07-12 13:02:18'),
(15, '7909189047895', 'nuevo', 10, 8.00, 10.00, 1, '2023-07-12 13:03:15'),
(16, '7791293008141', 'actualizo', -83, 13.00, 18.00, 1, '2023-07-12 13:03:34'),
(17, '7778608000441', 'nuevo', 12, 8.00, 10.00, 1, '2023-07-12 13:03:58'),
(18, '7791293040950', 'nuevo', 20, 12.00, 20.00, 1, '2023-07-12 13:04:22'),
(19, '7771259756019', 'nuevo', 0, 0.80, 1.00, 1, '2023-07-12 13:04:59'),
(20, '7771609003268', 'nuevo', 0, 8.00, 10.00, 1, '2023-07-12 13:05:02'),
(21, '7509552800258', 'nuevo', 0, 12.00, 18.00, 1, '2023-07-12 13:05:23'),
(22, '7774904402996', 'nuevo', 0, 8.00, 10.00, 1, '2023-07-12 13:05:34'),
(23, '8992929754015', 'nuevo', 0, 5.00, 10.00, 1, '2023-07-12 13:05:45'),
(24, '705632789735', 'nuevo', 25, 2.00, 3.00, 1, '2023-07-12 13:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `fk_producto` int DEFAULT NULL,
  `fk_venta` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `ganancia` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`fk_producto`, `fk_venta`, `cantidad`, `subtotal`, `total`, `ganancia`) VALUES
(19, 1, 1, 3.00, 3.00, 1.00),
(1, 2, 1, 18.00, 18.00, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `idmarca` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`idmarca`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S/N', '2023-07-11 19:30:10', NULL, NULL),
(2, 'FIXER', '2023-07-11 19:30:17', NULL, NULL),
(3, 'COCA COLA	', '2023-07-11 19:30:25', NULL, NULL),
(4, 'FANTA', '2023-07-11 19:30:32', NULL, NULL),
(5, 'ADES', '2023-07-11 19:30:43', NULL, NULL),
(6, 'ACRICOLOR', '2023-07-11 19:30:51', NULL, NULL),
(7, 'MALTA', '2023-07-11 19:30:58', NULL, NULL),
(8, 'AGUA VITA	', '2023-07-11 19:31:09', NULL, NULL),
(9, 'LA CABALLA	', '2023-07-11 19:31:20', NULL, NULL),
(10, 'REXONA', '2023-07-11 19:31:30', NULL, NULL),
(11, 'SCOTT', '2023-07-11 19:31:41', NULL, NULL),
(12, 'PIL	', '2023-07-11 19:31:48', NULL, NULL),
(13, 'DOVE', '2023-07-11 19:32:03', NULL, NULL),
(14, 'UNAGRO', '2023-07-11 19:32:10', NULL, NULL),
(15, 'ECODIN', '2023-07-11 19:32:23', NULL, NULL),
(16, 'LOREAL', '2023-07-11 19:32:33', NULL, NULL),
(17, 'AVON', '2023-07-11 19:32:40', NULL, NULL),
(18, 'POWER', '2023-07-11 19:32:47', NULL, NULL),
(19, 'SCJOHNSON', '2023-07-11 19:32:53', NULL, NULL),
(20, 'VITAL', '2023-07-11 19:33:04', NULL, NULL),
(21, 'NAX', '2023-07-11 19:33:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movimiento_inventario`
--

CREATE TABLE `movimiento_inventario` (
  `iddetalle_movimiento` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `fk_usuario` int DEFAULT NULL,
  `producto` varchar(250) DEFAULT NULL,
  `cantidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `movimiento_inventario`
--

INSERT INTO `movimiento_inventario` (`iddetalle_movimiento`, `name`, `fecha`, `fk_usuario`, `producto`, `cantidad`) VALUES
(1, 'nuevo', '2023-07-11 19:37:47', 1, '123', 100),
(2, 'update', '2023-07-11 19:44:34', 1, '123', 0),
(3, 'agregar', '2023-07-11 19:45:14', 1, '123', 4),
(4, 'ajuste', '2023-07-11 19:45:28', 1, '123', -4),
(5, 'agregar', '2023-07-11 19:45:52', 1, '123', 3),
(6, 'nuevo', '2023-07-12 04:39:31', 1, '7892725444', 25),
(7, 'nuevo', '2023-07-12 04:42:05', 1, '7774904402965', 100),
(8, 'nuevo', '2023-07-12 04:43:59', 1, '7772115420044', 120),
(9, 'nuevo', '2023-07-12 05:00:27', 1, '7770108930013', 100),
(10, 'nuevo', '2023-07-12 05:03:43', 1, '7776501000414', 50),
(11, 'nuevo', '2023-07-12 05:05:08', 1, '7776501001787', 36),
(12, 'nuevo', '2023-07-12 05:07:41', 1, '7771620590020', 40),
(13, 'nuevo', '2023-07-12 05:08:39', 1, '7771620590273', 40),
(14, 'nuevo', '2023-07-12 05:09:49', 1, '7771605000124', 36),
(15, 'nuevo', '2023-07-12 05:10:50', 1, '7909189047895', 10),
(16, 'update', '2023-07-12 05:12:41', 1, '7791293008141', -83),
(17, 'nuevo', '2023-07-12 05:16:24', 1, '7778608000441', 12),
(18, 'nuevo', '2023-07-12 05:21:11', 1, '7791293040950', 20),
(19, 'nuevo', '2023-07-12 05:25:20', 1, '7771259756019', 0),
(20, 'nuevo', '2023-07-12 05:27:28', 1, '7771609003268', 0),
(21, 'nuevo', '2023-07-12 05:45:40', 1, '7509552800258', 0),
(22, 'nuevo', '2023-07-12 05:46:33', 1, '7774904402996', 0),
(23, 'nuevo', '2023-07-12 05:49:34', 1, '8992929754015', 0),
(24, 'nuevo', '2023-07-12 05:51:53', 1, '705632789735', 25),
(25, 'venta', '2023-07-12 05:53:33', 1, '705632789735', -1);

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int NOT NULL,
  `nombre` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `permsio_roles`
--

CREATE TABLE `permsio_roles` (
  `fk_roles` int DEFAULT NULL,
  `fk_permiso` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permsio_roles`
--

INSERT INTO `permsio_roles` (`fk_roles`, `fk_permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `idpersona` int NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(200) DEFAULT NULL,
  `cedula` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`idpersona`, `nombre`, `email`, `telefono`, `cedula`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cliente general', NULL, NULL, 's/n', '2023-07-01 21:20:40', NULL, NULL),
(2, 'LEONARDO GUEVARA ', 'LGUEVARA2-ES@UDABOL.EDU.BO', '77346272', '9845916', '2023-07-01 21:20:13', NULL, NULL),
(4, 'PERSONA ', '', '', '123', '2023-07-10 00:57:30', '2023-07-10 01:29:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presentacion`
--

CREATE TABLE `presentacion` (
  `idpresentacion` int NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `fk_unidad` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `presentacion`
--

INSERT INTO `presentacion` (`idpresentacion`, `name`, `fk_unidad`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '250 G', 2, '2023-07-11 19:26:10', NULL, NULL),
(2, 'ENVASE', 2, '2023-07-11 19:26:21', NULL, NULL),
(3, '350', 2, '2023-07-11 19:26:30', '2023-07-11 19:26:36', NULL),
(4, '400 ML	', 2, '2023-07-11 19:26:57', '2023-07-11 19:27:03', NULL),
(5, '100 ML', 2, '2023-07-11 19:27:14', NULL, NULL),
(6, '170 G	', 2, '2023-07-11 19:27:22', NULL, NULL),
(7, '500 ML	', 4, '2023-07-11 19:27:44', NULL, NULL),
(8, '190 ML	', 4, '2023-07-11 19:27:52', NULL, NULL),
(9, 'PEQUENHA	', 4, '2023-07-11 19:28:01', NULL, NULL),
(10, 'MEDIANA', 4, '2023-07-11 19:28:10', NULL, NULL),
(11, '50G	', 4, '2023-07-11 19:28:18', NULL, NULL),
(12, '100ML', 1, '2023-07-11 19:28:40', NULL, NULL),
(13, '130GRAMO', 1, '2023-07-11 19:28:55', NULL, NULL),
(14, 'S/N', 1, '2023-07-11 19:36:41', NULL, NULL),
(15, '500 ML', 3, '2023-07-12 05:06:27', NULL, NULL),
(16, '2 LITROS	', 3, '2023-07-12 05:06:40', NULL, NULL),
(17, '1 LITRO	', 3, '2023-07-12 05:06:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idproducto` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `stocks` int DEFAULT NULL,
  `minimo` int DEFAULT NULL,
  `precio_compra` decimal(8,2) DEFAULT NULL,
  `precio_venta` decimal(8,2) DEFAULT NULL,
  `fk_unidad` int DEFAULT NULL,
  `fk_categoria` int DEFAULT NULL,
  `fk_marca` int DEFAULT NULL,
  `fk_presentacion` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idproducto`, `name`, `codigo`, `foto`, `description`, `stocks`, `minimo`, `precio_compra`, `precio_venta`, `fk_unidad`, `fk_categoria`, `fk_marca`, `fk_presentacion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DESODORANTE AEROSOL DOVE ORIGINAL', '7791293008141', 'public/file/producto/user2023_07_12_08_12_41.jpeg', '                                                esto es una prueba                                            ', 19, 2, 13.00, 18.00, 2, 2, 13, 2, '2023-07-11 19:37:47', '2023-07-12 05:12:41', NULL),
(2, 'Men+Care Clean Comfort Antitranspirante Roll On - Dove', '7892725444', 'public/dist/img/vacio.png', 'Men+Care Clean Comfort Antitranspirante Roll On - Dove                                              ', 25, 2, 8.00, 10.00, 2, 2, 13, 2, '2023-07-12 04:39:31', NULL, NULL),
(3, 'gel fixer super extra fuerte 250g', '7774904402965', 'public/dist/img/vacio.png', 'gel fixer super extra fuerte 250g                                              ', 100, 3, 7.00, 10.00, 2, 2, 2, 1, '2023-07-12 04:42:05', NULL, NULL),
(4, 'MALTA REAL LATA 350ML', '7772115420044', 'public/dist/img/vacio.png', '<h3 class=\"LC20lb MBeuO DKV0Md\" style=\"color: rgb(26, 13, 171); text-decoration-line: underline; -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1); outline: 0px; font-family: arial, sans-serif; font-size: 20px; background-color: rgb(255, 255, 255); margin: 18px 0px 3px; padding: 5px 0px 0px; line-height: 1.3; display: inline-block;\">MALTA REAL LATA 350ML</h3>                                              ', 120, 10, 4.00, 6.00, 2, 5, 7, 3, '2023-07-12 04:43:59', NULL, NULL),
(5, 'agua de bolsa', '7770108930013', 'public/dist/img/vacio.png', '7770108930013                                              ', 100, 5, 0.50, 1.00, 4, 5, 8, 7, '2023-07-12 05:00:27', NULL, NULL),
(6, 'SCOTT SERVILLETA DIA A DIA ', '7776501000414', 'public/dist/img/vacio.png', 'SCOTT SERVILLETA DIA A DIA&nbsp;                                                                                            ', 50, 5, 2.00, 4.00, 4, 2, 11, 9, '2023-07-12 05:03:43', NULL, NULL),
(7, 'SCOTT EXTRA X6 VERDE', '7776501001787', 'public/dist/img/vacio.png', 'SCOTT EXTRA X6 VERDE                                              ', 36, 3, 8.00, 10.00, 4, 2, 11, 10, '2023-07-12 05:05:08', NULL, NULL),
(8, 'Limonada Con Gas 500ml', '7771620590020', 'public/dist/img/vacio.png', '                        Limonada Con Gas 500ml                                                                    ', 40, 5, 4.00, 5.00, 3, 5, 9, 15, '2023-07-12 05:07:41', NULL, NULL),
(9, 'Limonada Con Gas  1 litro', '7771620590273', 'public/dist/img/vacio.png', 'Limonada Con Gas&nbsp; 1 litro                                              ', 40, 4, 5.00, 8.00, 3, 5, 9, 17, '2023-07-12 05:08:39', NULL, NULL),
(10, 'fanta personal', '7771605000124', 'public/dist/img/vacio.png', 'fanta personal                                              ', 36, 5, 4.00, 6.00, 3, 5, 4, 15, '2023-07-12 05:09:49', NULL, NULL),
(11, 'KB ROLL ON AVON X SERIES 50ML - Bluesoft Cosmos', '7909189047895', 'public/dist/img/vacio.png', 'KB ROLL ON AVON X SERIES 50ML - Bluesoft Cosmos                                              ', 10, 2, 8.00, 10.00, 2, 2, 17, 2, '2023-07-12 05:10:50', NULL, NULL),
(12, 'Alcohol etilico 1 litro unagro', '7778608000441', 'public/dist/img/vacio.png', 'Alcohol etilico 1 litro unagro                                              ', 12, 2, 8.00, 10.00, 3, 7, 14, 17, '2023-07-12 05:16:24', NULL, NULL),
(13, 'Talco Pedico Efficient Original x100gr', '7791293040950', 'public/dist/img/vacio.png', 'Talco Pedico Efficient Original x100gr                                              ', 20, 2, 12.00, 20.00, 2, 2, 10, 5, '2023-07-12 05:21:11', NULL, NULL),
(14, 'Pilfrut Sabor Manzana Bolsa X 190Ml', '7771259756019', 'public/dist/img/vacio.png', 'Pilfrut Sabor Manzana Bolsa X 190Ml                                              ', 0, 0, 0.80, 1.00, 4, 5, 12, 8, '2023-07-12 05:25:20', NULL, NULL),
(15, 'powerade mora azul 1 Litro', '7771609003268', 'public/dist/img/vacio.png', 'powerade mora azul 1 Litro                                              ', 0, 0, 8.00, 10.00, 3, 5, 18, 17, '2023-07-12 05:27:28', NULL, NULL),
(16, 'Shampoo Anti-Caspa Arcilla Purificante 400 ml', '7509552800258', 'public/dist/img/vacio.png', 'Shampoo Anti-Caspa Arcilla Purificante 400 ml                                              ', 0, 0, 12.00, 18.00, 2, 2, 16, 4, '2023-07-12 05:45:40', NULL, NULL),
(17, 'Fixer efecto humedo 250Gr', '7774904402996', 'public/dist/img/vacio.png', 'Fixer efecto humedo 250Gr                                              ', 0, 3, 8.00, 10.00, 2, 2, 2, 1, '2023-07-12 05:46:33', NULL, NULL),
(18, 'Medi-soft Mosquitoe Repellant Lemon Green 100ml', '8992929754015', 'public/dist/img/vacio.png', 'Medi-soft Mosquitoe Repellant Lemon Green 100ml                                              ', 0, 2, 5.00, 10.00, 1, 7, 1, 14, '2023-07-12 05:49:34', NULL, NULL),
(19, 'nacho max 50g', '705632789735', 'public/dist/img/vacio.png', 'nacho max 50g                                              ', 24, 5, 2.00, 3.00, 4, 3, 21, 11, '2023-07-12 05:51:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `idroles` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idroles`, `name`, `detalle`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'administrador', 's/n', '2023-07-11 18:56:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unidad`
--

CREATE TABLE `unidad` (
  `idunidad` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `unidad`
--

INSERT INTO `unidad` (`idunidad`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PIEZA', '2023-07-11 19:25:11', NULL, NULL),
(2, 'ENVASE', '2023-07-11 19:25:20', NULL, NULL),
(3, 'BOTELLA', '2023-07-11 19:25:29', NULL, NULL),
(4, 'BOLSA', '2023-07-11 19:25:35', NULL, NULL),
(5, 'PAQUETE', '2023-07-11 19:25:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int NOT NULL,
  `usuario` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `detalle` text,
  `fkroles` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `email`, `password`, `foto`, `detalle`, `fkroles`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'lguevara240@gmail.com', '58b5444cf1b6253a4317fe12daff411a78bda0a95279b1d5768ebf5ca60829e78da944e8a9160a0b6d428cb213e813525a72650dac67b88879394ff624da482f', 'public/file/usuario/user2023_07_11_22_15_20.jpg', 'sn&nbsp;', 1, '2023-07-01 20:41:52', '2023-07-11 19:15:20', NULL),
(2, 'jurado', 'caalvarez@udabol.edu.bo', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'public/dist/img/vacio.png', '                                                jurado                                            ', 1, '2023-07-07 11:29:22', '2023-07-07 11:40:28', NULL),
(3, 'eduardo', 'rojasquispeeduardo473@gmail.com', 'fbb0e7c4d6737e8473ce4918b2bb79f9da48225290e17def2fb66688b3061241fbf602894a5850778bcf7f52f3543fd89abf56f3e3a270f17d66ce123d89f266', 'public/dist/img/vacio.png', 'vendedor auxiliar', 1, '2023-07-03 08:22:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `idventas` int NOT NULL,
  `fk_arqueo` int DEFAULT NULL,
  `fk_persona` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `ganancia` decimal(8,2) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`idventas`, `fk_arqueo`, `fk_persona`, `created_at`, `total`, `ganancia`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2023-07-12 05:53:33', 3.00, 1.00, NULL, NULL),
(2, 1, 1, NULL, 18.00, 0.00, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arqueo_caja`
--
ALTER TABLE `arqueo_caja`
  ADD PRIMARY KEY (`idarqueo_caja`),
  ADD KEY `pk_caja` (`fkcaja`),
  ADD KEY `pk_usuario` (`fk_usuario`);

--
-- Indexes for table `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idcaja`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD KEY `pk_producto` (`fk_producto`),
  ADD KEY `pk_venta` (`fk_venta`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Indexes for table `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD PRIMARY KEY (`iddetalle_movimiento`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_producto` (`producto`) USING BTREE;

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indexes for table `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`idpresentacion`),
  ADD KEY `pk_unidad` (`fk_unidad`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `pk_categoria` (`fk_categoria`),
  ADD KEY `pk_marca` (`fk_marca`),
  ADD KEY `pk_presentacion` (`fk_presentacion`),
  ADD KEY `pk_unidad` (`fk_unidad`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`),
  ADD UNIQUE KEY `nombre` (`name`);

--
-- Indexes for table `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`idunidad`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `pk_roles` (`fkroles`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arqueo_caja`
--
ALTER TABLE `arqueo_caja`
  MODIFY `idarqueo_caja` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `caja`
--
ALTER TABLE `caja`
  MODIFY `idcaja` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  MODIFY `iddetalle_movimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `idpresentacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unidad`
--
ALTER TABLE `unidad`
  MODIFY `idunidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `idventas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arqueo_caja`
--
ALTER TABLE `arqueo_caja`
  ADD CONSTRAINT `pk_caja` FOREIGN KEY (`fkcaja`) REFERENCES `caja` (`idcaja`),
  ADD CONSTRAINT `pk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`idusuario`);

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `pk_producto` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `pk_venta` FOREIGN KEY (`fk_venta`) REFERENCES `venta` (`idventas`);

--
-- Constraints for table `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD CONSTRAINT `movimiento_inventario_ibfk_2` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presentacion`
--
ALTER TABLE `presentacion`
  ADD CONSTRAINT `pk_unidad` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`idunidad`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `pk_categoria` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `pk_marca` FOREIGN KEY (`fk_marca`) REFERENCES `marca` (`idmarca`),
  ADD CONSTRAINT `pk_presentacion` FOREIGN KEY (`fk_presentacion`) REFERENCES `presentacion` (`idpresentacion`),
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`idunidad`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
