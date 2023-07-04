-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql.helpfibo.com
-- Generation Time: Jul 04, 2023 at 06:10 AM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3-4ubuntu2.18

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
  `monto_inicial` decimal(8,2) DEFAULT NULL,
  `monto_final` decimal(8,2) DEFAULT NULL,
  `total_ventas` decimal(8,2) DEFAULT NULL,
  `horario_inicio` datetime DEFAULT NULL,
  `horario_final` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `arqueo_caja`
--

INSERT INTO `arqueo_caja` (`idarqueo_caja`, `fkcaja`, `fk_usuario`, `monto_inicial`, `monto_final`, `total_ventas`, `horario_inicio`, `horario_final`) VALUES
(1, 1, 2, 100.00, NULL, NULL, '2023-07-01 21:19:41', NULL);

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
(1, 'CAJA UNO', 'caja uno                                              ', '2023-07-01 21:19:29', NULL, NULL);

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
(1, 'S/N', '2023-07-01 20:50:04', '2023-07-03 10:58:58', NULL),
(2, 'ASEO PERSONAL', '2023-07-01 20:50:10', NULL, NULL),
(3, 'DULCE', '2023-07-03 08:14:53', NULL, NULL),
(4, 'MATERIAL DE ESCRITORIO', '2023-07-03 08:15:07', NULL, NULL),
(5, 'BEBIDAS', '2023-07-03 08:15:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `fk_producto` int DEFAULT NULL,
  `fk_venta` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `total` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `idlogs` int NOT NULL,
  `usuario` int DEFAULT NULL,
  `evento` int DEFAULT NULL,
  `ip` varchar(250) DEFAULT NULL,
  `detalle` varchar(250) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(1, 'S/N', '2023-07-01 20:50:22', NULL, NULL),
(2, 'FIXER', '2023-07-01 20:50:29', NULL, NULL),
(3, 'COCA COLA', '2023-07-03 08:15:37', NULL, NULL),
(4, 'FANTA', '2023-07-03 08:15:50', NULL, NULL),
(5, 'ADES', '2023-07-03 08:16:03', NULL, NULL),
(6, 'ACRICOLOR', '2023-07-03 08:16:29', NULL, NULL),
(7, 'MALTA', '2023-07-03 08:18:38', NULL, NULL),
(8, 'AGUA VITA', '2023-07-03 08:29:22', NULL, NULL);

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
(1, 'nuevo', '2023-07-01 20:55:20', 2, '7774904402965', 100),
(2, 'nuevo', '2023-07-03 08:19:50', 2, '7772115420044', 100),
(3, 'nuevo', '2023-07-03 08:43:08', 7, '7770108930013', 100);

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
(1, 20),
(2, 1),
(2, 2);

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
(2, 'LEONARDO GUEVARA ', 'LGUEVARA2-ES@UDABOL.EDU.BO', '77346272', '9845916', '2023-07-01 21:20:13', NULL, NULL);

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
(1, '250 G', 2, '2023-07-01 20:51:20', '2023-07-01 20:53:44', NULL),
(2, 'ENVASE', 2, '2023-07-01 20:54:34', NULL, NULL),
(3, '350', 2, '2023-07-03 08:17:48', NULL, NULL),
(4, '500 ML', 4, '2023-07-03 08:30:05', NULL, NULL);

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
(1, 'gel fixer', '7774904402965', 'public/dist/img/vacio.png', '                        ver                      ', 99, 2, 7.00, 10.00, 2, 1, 2, 1, '2023-07-01 20:55:20', '2023-07-03 10:56:00', NULL),
(2, 'malta', '7772115420044', 'public/dist/img/vacio.png', 'malta real', 100, 10, 4.00, 6.00, 2, 5, 7, 3, '2023-07-03 08:19:50', NULL, NULL),
(3, 'agua de bolsa', '7770108930013', 'public/dist/img/vacio.png', 'agua de bolsa', 100, 10, 0.50, 1.00, 4, 5, 8, 4, '2023-07-03 08:43:08', NULL, NULL);

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
(1, 'administrador ', NULL, '2023-07-01 20:39:42', NULL, NULL),
(2, 'VENDEDOR', 'vendedor', '2023-07-01 22:29:44', '2023-07-03 11:00:33', NULL);

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
(1, 'PIEZA', '2023-07-01 20:50:50', NULL, NULL),
(2, 'ENVASE ', '2023-07-01 20:51:01', NULL, NULL),
(3, 'BOTELLA', '2023-07-03 08:17:20', NULL, NULL),
(4, 'BOLSA', '2023-07-03 08:29:36', NULL, NULL);

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
(2, 'admin', 'lguevara240@gmail.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', NULL, NULL, 1, '2023-07-01 20:41:52', NULL, NULL),
(6, 'fibo', 'lguevara2-es@udabol.edu.bo', 'e8bf890f4874aa9963604b75dbc2dba0ec1ed0a2695a82b75ffa7e3831c641898d8d682c6b530a7c30ef919f5b902ec7b600dbd04d6dfa99fbcea140ffe979ab', 'public/dist/img/vacio.png', '                        c147a39a5cfcc00d5139ca35091d7c7ad71c14a51afd0f00aafef0b1bb70612bf47b7ad53b914727dd32794a2b613a937d4975e5f930ae158d5dceefe3198793                                                                    ', 2, '2023-07-01 22:03:39', '2023-07-01 22:49:02', NULL),
(7, 'eduardo', 'rojasquispeeduardo473@gmail.com', 'fbb0e7c4d6737e8473ce4918b2bb79f9da48225290e17def2fb66688b3061241fbf602894a5850778bcf7f52f3543fd89abf56f3e3a270f17d66ce123d89f266', 'public/dist/img/vacio.png', 'vendedor auxiliar', 1, '2023-07-03 08:22:21', NULL, NULL);

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
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`idventas`, `fk_arqueo`, `fk_persona`, `created_at`, `total`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, NULL, NULL, NULL, NULL);

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
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD KEY `pk_producto` (`fk_producto`),
  ADD KEY `pk_venta` (`fk_venta`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idlogs`);

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
  ADD UNIQUE KEY `name` (`name`),
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
  MODIFY `idcategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `idlogs` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  MODIFY `iddetalle_movimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `idpresentacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unidad`
--
ALTER TABLE `unidad`
  MODIFY `idunidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `idventas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `pk_roles` FOREIGN KEY (`fkroles`) REFERENCES `roles` (`idroles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
