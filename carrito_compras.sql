-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-11-2022 a las 08:32:07
-- Versión del servidor: 5.7.36
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrito_compras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `idCompra` bigint(20) NOT NULL AUTO_INCREMENT,
  `coFecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` bigint(20) NOT NULL,
  PRIMARY KEY (`idCompra`),
  UNIQUE KEY `idcompra` (`idCompra`),
  KEY `fkcompra_1` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

DROP TABLE IF EXISTS `compraestado`;
CREATE TABLE IF NOT EXISTS `compraestado` (
  `idCompraEstado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCompra` bigint(11) NOT NULL,
  `idCompraEstadoTipo` int(11) NOT NULL,
  `ceFechaIni` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ceFechaFin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idCompraEstado`),
  UNIQUE KEY `idcompraestado` (`idCompraEstado`),
  KEY `fkcompraestado_1` (`idCompra`),
  KEY `fkcompraestado_2` (`idCompraEstadoTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

DROP TABLE IF EXISTS `compraestadotipo`;
CREATE TABLE IF NOT EXISTS `compraestadotipo` (
  `idCompraEstadoTipo` int(11) NOT NULL,
  `cetDescripcion` varchar(50) NOT NULL,
  `cetDetalle` varchar(256) NOT NULL,
  PRIMARY KEY (`idCompraEstadoTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idCompraEstadoTipo`, `cetDescripcion`, `cetDetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

DROP TABLE IF EXISTS `compraitem`;
CREATE TABLE IF NOT EXISTS `compraitem` (
  `idCompraItem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idProducto` bigint(20) NOT NULL,
  `idCompra` bigint(20) NOT NULL,
  `ciCantidad` int(11) NOT NULL,
  PRIMARY KEY (`idCompraItem`),
  UNIQUE KEY `idcompraitem` (`idCompraItem`),
  KEY `fkcompraitem_1` (`idCompra`),
  KEY `fkcompraitem_2` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `idMenu` bigint(20) NOT NULL AUTO_INCREMENT,
  `meNombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `meDescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idPadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `meDeshabilitado` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez',
  PRIMARY KEY (`idMenu`),
  UNIQUE KEY `idmenu` (`idMenu`),
  KEY `fkmenu_1` (`idPadre`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idMenu`, `meNombre`, `meDescripcion`, `idPadre`, `meDeshabilitado`) VALUES
(7, 'Productos', '../Cliente/productos.php', NULL, NULL),
(8, 'Mis Compras', '../Cliente/compras.php', NULL, NULL),
(9, 'Usuarios', '../Admin/listaUsuarios.php', NULL, NULL),
(10, 'Permisos', '../Admin/gestionarPermisos.php', NULL, NULL),
(11, 'Estado de Compras', '../Deposito/gestionarCompras.php', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

DROP TABLE IF EXISTS `menurol`;
CREATE TABLE IF NOT EXISTS `menurol` (
  `idMenu` bigint(20) NOT NULL,
  `idRol` bigint(20) NOT NULL,
  PRIMARY KEY (`idMenu`,`idRol`),
  KEY `fkmenurol_2` (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menurol`
--

INSERT INTO `menurol` (`idMenu`, `idRol`) VALUES
(9, 1),
(10, 1),
(7, 2),
(8, 2),
(11, 3);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `proNombre` varchar(30) NOT NULL,
  `proDetalle` varchar(512) NOT NULL,
  `proCantStock` int(11) NOT NULL,
  `proPrecio` int(11) NOT NULL,
  `urlImagen` varchar(200) NOT NULL,
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY `idproducto` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `idRol` bigint(20) NOT NULL AUTO_INCREMENT,
  `rolDescripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idRol`),
  UNIQUE KEY `idrol` (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rolDescripcion`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_USER'),
(3, 'ROLE_DEPOSITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `usNombre` varchar(50) NOT NULL,
  `usPass` varchar(150) NOT NULL,
  `usMail` varchar(50) NOT NULL,
  `usDeshabilitado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `idusuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

DROP TABLE IF EXISTS `usuariorol`;
CREATE TABLE IF NOT EXISTS `usuariorol` (
  `idUsuario` bigint(20) NOT NULL,
  `idRol` bigint(20) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idRol`),
  KEY `idusuario` (`idUsuario`),
  KEY `idrol` (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idCompra`) REFERENCES `compra` (`idCompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idCompraEstadoTipo`) REFERENCES `compraestadotipo` (`idCompraEstadoTipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idCompra`) REFERENCES `compra` (`idCompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idPadre`) REFERENCES `menu` (`idMenu`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`idMenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
