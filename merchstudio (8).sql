-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2019 a las 19:09:59
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `merchstudio`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultSucursal` ()  NO SQL
SELECT  NomSucursal FROM sucursal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DUI_Cliente` (IN `cliente` VARCHAR(11))  NO SQL
BEGIN
SELECT cliente.Nombre
FROM cliente
WHERE DUI=cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Grafico1PArametro` (IN `IdSucursal` INT(5))  READS SQL DATA
SELECT JSON_OBJECT(
  'x', b.Descripcion,
  'y', Count(a.Cantidad)
  
)
FROM productoxsucursal a
INNER JOIN producto b on a.IdProducto=b.IdProducto
where IdSucursal=@p0
group by a.IdProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pamela` (IN `l` VARCHAR(50))  NO SQL
SELECT producto.Descripcion, categoria.Categoria 
FROM producto INNER JOIN categoria ON categoria.IdCategoria = producto.IdCategoria
WHERE categoria.Categoria=@l$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductoxCategoria` (IN `p0` INT)  NO SQL
SELECT Descripcion 
FROM producto 
WHERE IdCategoria=@p0$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `IdBitacora` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Accion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`IdBitacora`, `Fecha`, `Accion`) VALUES
(1, '2019-05-01', 'Se ingreso'),
(2, '2019-06-12', 'Se ingreso'),
(3, '2019-06-12', 'Se ingreso'),
(4, '2019-06-13', 'Se ingreso'),
(5, '2019-06-13', 'Se ingreso'),
(6, '2019-06-13', 'Se ingreso'),
(7, '2019-06-13', 'Se ingreso'),
(8, '2019-06-14', 'Se ingreso'),
(9, '2019-06-14', 'Se ingreso'),
(10, '2019-09-14', 'Se ingreso'),
(11, '2019-09-28', 'Se ingreso'),
(12, '2019-09-28', 'Se ingreso'),
(13, '2019-09-28', 'Se ingreso'),
(14, '2019-09-28', 'Se ingreso'),
(15, '2019-09-28', 'Se ingreso'),
(16, '2019-09-28', 'Se ingreso'),
(17, '2019-09-28', 'Se ingreso'),
(18, '2019-09-28', 'Se ingreso'),
(19, '2019-09-28', 'Se ingreso'),
(20, '2019-09-28', 'Se ingreso'),
(21, '2019-09-28', 'Se ingreso'),
(22, '2019-09-28', 'Se ingreso'),
(23, '2019-09-29', 'Se ingreso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Categoria`, `Descripcion`) VALUES
(1, 'Camiseta', 'En la cstegoria camisetas tambien se encuentras los centros.'),
(2, 'Accesorio', 'Los accesorios pueden ser sticjers,llaveros y entre otros'),
(3, 'Tazas', 'No hay descripcion.'),
(4, 'Jarra', 'No hay descripcion.'),
(5, 'S', 'No hay descripcion.'),
(6, 'Yetis', 'No hay descripcion.'),
(7, 'Perrito', 'Son camisas para perritos.'),
(8, 'Gorras', 'No hay descripcion.'),
(9, 'Camisa nino', 'No hay descripcion.'),
(10, 'Centro', 'No hay descripcion.'),
(11, 'Sudadera', 'No hay descripcion.'),
(12, 'Hoodie', 'No hay descripcion.'),
(13, 'Zapatias', 'No hay'),
(14, 'Pantalones', 'No hay'),
(15, 'Blusas', 'No hay'),
(16, 'Piezas', 'No hay'),
(17, 'r', 'r'),
(18, 'E', 'e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `IdCliente` int(11) NOT NULL,
  `NombreCliente` varchar(100) NOT NULL,
  `DUI` varchar(11) DEFAULT NULL,
  `Direccion` varchar(1000) DEFAULT NULL,
  `Correo` varchar(100) NOT NULL,
  `NomUsuario` varchar(100) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `FechaVencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IdCliente`, `NombreCliente`, `DUI`, `Direccion`, `Correo`, `NomUsuario`, `Contrasena`, `FechaVencimiento`) VALUES
(1, 'ACIEN ZURUTA ROSA MARIA', '098767542', 'cal', '', '', '', '0000-00-00'),
(2, 'ALBUSAC TAMARGO DANIEL ', '12345456-7', 'AV. INDEPENDENCIA NO. 241 COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(3, 'ALONSO BECERRA JOSE', '09876543-3', 'AV. INDEPENDENCIA NO. 779	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(4, 'AMAT MENA SUSANA ', '09876543-2', 'AV. 20 DE NOVIEMBRE NO.1024	COL.CENTRO', '', '', '', '0000-00-00'),
(5, 'AMATE GARRIDO IRENE ', '29876543-1', 'CARRETERA A LOMA ALTA S/N.	LOMAS DEL PEDREGAL TUXTEPEC	', '', '', '', '0000-00-00'),
(6, 'APARICIO GARCIA MAGDALENA ', '39876542-1', 'AV. 20 DE NOVIEMBRE NO. 1060	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(7, 'BENAYAS PEREZ NATALIA', '49876532-1', 'CALLE ZARAGOZA NO. 1010	COL. LA PIRAGUA TUXTEPEC', '', '', '', '0000-00-00'),
(8, 'BERNABE CASANOVA FRANCISCO CESAR', '59876432-1', 'CALLE MATAMOROS NO. 310	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(9, 'BERNAL RUIZ ENCARNACION ', '69875432-1', 'AV. 20 DE NOVIEMBRE NO.859-B	COL. CENTRO', '', '', '', '0000-00-00'),
(10, 'CACERES CONTRERAS MARIA DEL MAR', '79865432-1', 'AV. 20 DE NOVIEMBRE NO 1053	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(11, 'CAMPOS VIQUE MARIA BELEN ', '89765432-1', 'BLVD. BENITO JUAREZ NO. 1466-A	FRACC. LOS ANGELES TUXTEPEC', '', '', '', '0000-00-00'),
(12, 'CARREÑO NAVARRO MONICA ', '98765432-1', 'CALLE MATAMOROS NO.280	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(13, 'CARRERA BENITEZ SUSANA ', '81234567-9', 'AV. INDEPENDENCIA NO. 545	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(14, 'CASAS GARCIA MARIA ESPERANZA ', '71234568-9', 'AV. INDEPENDENCIA NO. 1282-A	COL.CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(16, 'CASTILLO ALARCON ISABEL', '51234678-9', 'AV.INDEPENDENCIA NO.1010	COL.CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(17, 'CASTILLO GALDEANO ELENA MARIA ', '41235678-9', 'AV. 5 DE MAYO NO. 1652	LA PIRAGUA', '', '', '', '0000-00-00'),
(18, 'CASTILLO OLLER FRANCISCO JAVIER ', '31245678-9', 'AV. 5 DE MAYO NO. 1108	COL.CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(19, 'CONTRERAS CARREÑO ADOLFINA ', '21345678-9', 'AV. INDEPENDENCIA NO. 748	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(20, 'CORDOBA PASCUAL DOLORES MARIA ', '12345678-9', 'AV. INDEPENDENCIA NO. 985-A	COL. CENTRO TUXTEPEC', '', '', '', '0000-00-00'),
(21, 'Pamela', NULL, NULL, 'panayelyaguilar@gmail.com', 'Pam', '123456789', '2019-09-17'),
(22, 'Pamela', NULL, NULL, 'panayelyaguilar@gmail.com', 'Pam', '123456789', '2019-09-17'),
(23, 'Fernada Avendano', NULL, NULL, 'fer@gmail.com', 'Fer', '$2y$10$/Ce9zNbQNYLZ3rycgXyavO6.rvew/xJ8iVTxwAFgUPhl77ViIZhCq', '2019-09-17'),
(24, 'Pamela', NULL, NULL, 'panayelyaguilar@gmail.com', 'Pam', '$2y$10$M6yqf3y/H7h8niAXkxRGo.k/0NDC19gWNwffzAJJ.7yV0fJ8rS6AG', '2019-09-24'),
(25, 'Pamela', NULL, NULL, 'panayelyaguilar@gmail.com', 'Pame', '$2y$10$UMc07wbStdtD/8mTlVVXKO1L5Oy99627wBnqcLu0pWKB7.69vqBxq', '2019-09-24'),
(26, 'Pamela', NULL, NULL, 'panayeyaguilar@gmail.com', 'Pamelita', '$2y$10$91l3.mAPm37k4.L6vT1l7ORqvCr8YjBm1HOl7H4.wHB9/rZBPlGHO', '2019-09-27'),
(27, 'Pamela', NULL, NULL, 'panayelyaguilar@gmail.com', 'Pamee', '$2y$10$usv2td9QdvBWjQo3A68NrOYTZDsjJm/hNEOdHoev72RLaDRT4h9vm', '2019-09-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crear`
--

CREATE TABLE `crear` (
  `IdCrear` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `PosicionX` float NOT NULL,
  `PosicioY` float NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `crear`
--

INSERT INTO `crear` (`IdCrear`, `img`, `PosicionX`, `PosicioY`, `Fecha`) VALUES
(1, '', 12, 10, '2019-05-01'),
(2, '', 20, 10, '2019-04-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `IdDetalle` int(11) NOT NULL,
  `IdFactura` int(11) NOT NULL,
  `IdProductoxSucursal` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdVendedor` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`IdDetalle`, `IdFactura`, `IdProductoxSucursal`, `IdCliente`, `IdVendedor`, `Cantidad`, `Venta`) VALUES
(1, 1, 1, 1, 1, 1, 700),
(2, 2, 1, 2, 1, 1, 300),
(3, 3, 1, 3, 2, 1, 200),
(4, 4, 2, 4, 3, 2, 1000),
(5, 5, 2, 5, 4, 2, 708),
(6, 6, 2, 6, 5, 2, 100),
(7, 7, 2, 7, 6, 3, 250),
(8, 8, 3, 1, 7, 3, 360),
(10, 10, 1, 3, 7, 3, 800);

--
-- Disparadores `detalleventa`
--
DELIMITER $$
CREATE TRIGGER `Restar producto` AFTER INSERT ON `detalleventa` FOR EACH ROW UPDATE productoxsucursal SET Cantidad = Cantidad-New.Cantidad WHERE IdProductoxsucursal = new.IdProductoxsucursal
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doblefactor`
--

CREATE TABLE `doblefactor` (
  `IDFactor` int(11) NOT NULL,
  `Usuario` int(11) NOT NULL,
  `Codigo` float NOT NULL,
  `SesionActiva` int(11) NOT NULL,
  `Bloqueo` int(11) NOT NULL,
  `FechaDesbloqueo` datetime DEFAULT NULL,
  `FechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `doblefactor`
--

INSERT INTO `doblefactor` (`IDFactor`, `Usuario`, `Codigo`, `SesionActiva`, `Bloqueo`, `FechaDesbloqueo`, `FechaCreacion`) VALUES
(5, 11, 18917, 0, 0, NULL, '2019-10-23 00:08:12'),
(6, 15, 57135, 0, 0, NULL, '2019-10-23 00:09:28'),
(7, 16, 77330, 0, 0, NULL, '2019-10-23 00:22:39'),
(8, 17, 98531, 0, 0, NULL, '2019-10-23 01:06:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `IdFactura` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Iva` float NOT NULL,
  `Total` float NOT NULL,
  `TipoFactura` varchar(50) NOT NULL,
  `IdVendedor` int(11) NOT NULL,
  `IdPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`IdFactura`, `Fecha`, `Iva`, `Total`, `TipoFactura`, `IdVendedor`, `IdPago`) VALUES
(1, '2019-05-01', 10, 25, 'Credito', 1, 1),
(2, '2019-05-02', 10, 25, 'Credito', 1, 1),
(3, '2019-05-03', 10, 25, 'Credito', 1, 1),
(4, '2019-05-04', 10, 25, 'Credito', 1, 1),
(5, '2019-05-05', 10, 25, 'Credito', 1, 1),
(6, '2019-05-06', 10, 25, 'Credito', 1, 1),
(7, '2019-05-07', 10, 25, 'Credito', 4, 2),
(8, '2019-05-08', 10, 25, 'Credito', 5, 2),
(9, '2019-05-09', 10, 25, 'Credito', 6, 2),
(10, '2019-05-10', 10, 25, 'Credito', 2, 2),
(11, '2019-05-11', 10, 25, 'Credito', 2, 2),
(13, '2019-05-13', 10, 25, 'Credito', 10, 1),
(14, '2019-05-14', 10, 25, 'Credito', 7, 1),
(15, '2019-08-14', 10, 15, 'Credito', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `IdPago` int(11) NOT NULL,
  `TipoPago` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`IdPago`, `TipoPago`) VALUES
(1, 'Tarjeta'),
(2, 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `Precio` varchar(30) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Diseno` varchar(50) NOT NULL,
  `Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Precio`, `IdCategoria`, `Diseno`, `Descripcion`) VALUES
(1, '15.00', 11, '1821', 'hola'),
(2, '10.00 ', 1, 'always', 'Always Hungry'),
(4, '12.00 ', 1, 'basic', 'Basic Box'),
(5, '15.00 ', 1, 'batallon', 'Batall?n Semita'),
(6, '10.00 ', 1, 'bff', 'Best friends forever'),
(7, '15.00 ', 1, 'billete', 'Billete'),
(8, '10.00 ', 1, 'bolo', 'Bolo'),
(9, '10.00 ', 1, 'cheat', 'Cheat day'),
(10, '10.00 ', 1, 'ciudades1', 'Ciudades 1'),
(12, '10.00 ', 1, 'copa', 'Copa mundial'),
(13, '10.00 ', 1, 'costa', 'Costa del sol'),
(14, '10.00 ', 1, 'desayuno', 'Desayunos t?picos'),
(15, '10.00 ', 1, 'domingoma', 'Domingoma'),
(16, '10.00 ', 1, 'ajolot', 'Do not Ajolot & relax the cake'),
(17, '10.00 ', 1, 'dont ', 'Don\'t worry'),
(18, '10.00 ', 1, 'einstein', 'Einstein '),
(19, '15.00 ', 1, 'surf', 'El tunco surf club'),
(20, '10.00 ', 1, 'estar ', 'Estar guars'),
(21, '15.00 ', 1, 'dreams', 'Follow your dreams'),
(22, '15.00 ', 1, 'fornite', 'Fortnite'),
(23, '10.00 ', 1, 'torrejas', 'Game of Torrejas'),
(24, '10.00 ', 1, 'genuine', 'Geniune paradise'),
(25, '15.00 ', 1, 'greetings', 'Greetings'),
(26, '15.00 ', 1, 'hakuna', 'Hakuna matata'),
(27, '10.00 ', 1, 'hay pupusas', 'Hay pupusas'),
(28, '20.00 ', 1, 'hoodie netflix', 'Hoodie Netflix & chill'),
(29, '20.00 ', 1, 'hoodie tropics', 'Hoodie tropical paradise'),
(30, '10.00 ', 1, 'horchata', 'Horchata y suspiros'),
(31, '10.00 ', 1, 'instalega', 'Instalega'),
(32, '15.00 ', 1, 'abuela', 'La abuela'),
(33, '15.00 ', 1, 'centro la vida', 'La vida es playa (centro)'),
(34, '15.00 ', 1, 'libertad', 'Libertad'),
(35, '10.00 ', 1, 'made in', 'Made in'),
(36, '10.00 ', 1, 'magico', 'M?gico'),
(37, '10.00 ', 1, 'make pupusas', 'Make pupusas not war.'),
(38, '5.00 ', 1, 'mini logo', 'Mini logo'),
(39, '5.00 ', 1, 'centro mini logo', 'Mini logo (centro)'),
(40, '15.00 ', 1, 'nambe', 'Nambe chele'),
(41, '10.00 ', 1, 'netflix', 'Netflix & chill'),
(42, '15.00 ', 1, 'nintendo', 'Nintendo 64'),
(43, '15.00 ', 1, 'pilas', 'Nos ponemos las pilas'),
(44, '15.00 ', 1, 'obligame', 'Obligame prro'),
(45, '10.00 ', 1, 'panchita', 'Panchita'),
(46, '10.00 ', 1, 'partners', 'Partners in crime'),
(47, '15.00 ', 1, 'pilsener', 'Pilsener'),
(48, '10.00 ', 1, 'barril', 'Pilsener barril'),
(49, '15.00 ', 1, 'placas', 'Placas'),
(50, '10.00 ', 1, 'pcn', 'Pupusas chocolate & netflix.'),
(51, '10.00 ', 1, 'pupusa', 'Pupusa power'),
(52, '15.00 ', 1, 'regia', 'Regia '),
(53, '15.00 ', 1, 'centro regia', 'Regia (centro)'),
(54, '15.00 ', 1, 'busito', 'Ruta 503 (Busito)'),
(55, '10.00 ', 1, 'salvador 1', 'Salvador del mundo 1'),
(56, '10.00 ', 1, 'salvador 2', 'Salvador del mundo 2'),
(57, '10.00 ', 1, 'selena', 'Selena'),
(58, '10.00 ', 1, 'sivar', 'Sivar is the shit'),
(59, '15.00 ', 1, 'sorbete', 'Sorbete de carret?n'),
(60, '10.00 ', 1, 'spanglish', 'Spanglish'),
(61, '20.00 ', 1, 'Sudadera esa', 'Sudadera ESA'),
(62, '10.00 ', 1, 'teikirisi', 'Teikirisi'),
(63, '10.00 ', 1, 'tipicos', 'Platillos t?picos'),
(64, '10.00 ', 1, 'tropics', 'Tropics'),
(65, '15.00 ', 1, 'centro tunco', 'Tunco (centro)'),
(66, '10.00 ', 1, 'vale v', 'Vale verga'),
(67, '15.00 ', 1, 'ni le ocre', 'Ni le ocre'),
(68, '15.00 ', 1, 'nacion', 'Naci?n Soya city'),
(69, '7.00', 2, 'calcetines', 'Funky Sox'),
(70, '1.00', 2, 'dinosaurio', 'Juguete Dinosaurio'),
(71, '10.00', 2, 'fidget', 'Fidget Cube'),
(72, '5.00', 2, 'iman', 'Destapador im?n\r'),
(73, '0.50', 2, 'lapiz', 'L?piz'),
(74, '5.00', 2, 'launcher', 'Cap Launcher'),
(75, '5.00', 2, 'lentes', 'Lentes de sol'),
(76, '3.00', 2, 'parche', 'Parche para ropa'),
(77, '1.00', 2, 'pelotita', 'Pelotita'),
(78, '1.00', 2, 'pin', 'Pin'),
(79, '3.00', 2, 'pop', 'Pop Socket'),
(80, '5.00', 2, 'porta lentes', 'Porta Lente'),
(81, '5.00', 2, 'porta vaso', 'Porta Vaso'),
(82, '10.00', 2, 'pulsera', 'Pulsera'),
(84, '1.00', 2, 'sorpresa', 'Sorpresita infantil'),
(85, '1.00', 2, 'sticker', 'Sticker '),
(86, '0.25', 2, 'sticker soya', 'Stciker Soya City'),
(87, '0.25', 2, 'vinil', 'Vinil'),
(96, '7', 15, 'Camiseta mini', 'Solo camiseta'),
(97, '9', 9, 'Camisa pequeña', 'Camisa niño '),
(98, '10', 2, 'Nuevo nuevo', 'Nuevo'),
(99, '12', 4, 'New', 'Nuevo producto'),
(100, '12', 1, 'nueva', 'Camisa nueva');

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `llenar` AFTER INSERT ON `producto` FOR EACH ROW insert into bitacora values (null, (select now()),'Se ingreso un nuevo producto')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoxsucursal`
--

CREATE TABLE `productoxsucursal` (
  `IdProductoxSucursal` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `IdTalla` int(11) NOT NULL,
  `IdSucursal` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productoxsucursal`
--

INSERT INTO `productoxsucursal` (`IdProductoxSucursal`, `IdProducto`, `IdTalla`, `IdSucursal`, `IdCategoria`, `Cantidad`) VALUES
(1, 86, 11, 1, 3, 8),
(2, 87, 12, 2, 1, 1),
(3, 73, 13, 3, 2, 4),
(5, 78, 15, 2, 2, 10),
(6, 70, 16, 3, 1, 10),
(7, 84, 17, 1, 1, 10),
(8, 85, 10, 2, 1, 10),
(9, 77, 5, 3, 2, 10),
(10, 76, 4, 3, 2, 0),
(11, 79, 3, 1, 7, 10),
(12, 81, 8, 2, 2, 10),
(13, 80, 9, 3, 2, 10),
(14, 75, 6, 1, 1, 10),
(15, 74, 7, 3, 1, 10),
(16, 39, 1, 1, 2, 10),
(17, 38, 1, 3, 2, 10),
(18, 69, 7, 2, 2, 10),
(19, 71, 2, 1, 2, 10),
(20, 8, 6, 3, 2, 10),
(21, 2, 17, 3, 2, 12),
(22, 2, 17, 3, 2, 12),
(23, 1, 6, 1, 2, 10),
(24, 2, 10, 1, 3, 15),
(25, 2, 8, 1, 3, 15),
(27, 1, 11, 1, 2, 60),
(28, 1, 1, 1, 2, 75),
(29, 2, 7, 3, 2, 5),
(30, 2, 1, 1, 2, 5),
(32, 1, 17, 3, 0, -2),
(33, 87, 17, 1, 0, -5),
(34, 87, 16, 1, 0, 100),
(35, 86, 17, 2, 0, 5),
(36, 96, 7, 1, 0, 4),
(37, 4, 7, 2, 0, 4),
(38, 4, 7, 1, 0, 4),
(39, 97, 11, 1, 0, 8),
(40, 97, 14, 2, 0, 5),
(41, 98, 1, 1, 0, 3),
(42, 98, 1, 3, 0, 10),
(43, 98, 1, 3, 0, 10),
(44, 80, 17, 1, 0, 7),
(45, 99, 1, 1, 0, 2),
(46, 86, 15, 2, 0, 25),
(47, 100, 13, 1, 0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdRol` int(11) NOT NULL,
  `TipoRol` varchar(20) NOT NULL,
  `atributos` varchar(9) NOT NULL,
  `Activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRol`, `TipoRol`, `atributos`, `Activo`) VALUES
(1, 'Administrador', '111111111', 1),
(2, 'Gerente', '111001001', 1),
(3, 'Vendedor', '110000000', 1),
(8, 'X', '101000100', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `IdSucursal` int(11) NOT NULL,
  `NomSucursal` varchar(100) NOT NULL,
  `Direccion` varchar(1000) NOT NULL,
  `Telefono` int(8) NOT NULL,
  `EsBodega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`IdSucursal`, `NomSucursal`, `Direccion`, `Telefono`, `EsBodega`) VALUES
(1, 'Merch San Benito', 'Col. San Benito, Av. La Revolución, #159A San Salvador, San Benito', 25630852, 0),
(2, 'Merch Galerias', 'Centro Comercial Galeria 2Do nivel', 26609834, 0),
(3, 'Merch Plaza mundo', 'Centro Comercial Metrocentro', 23456534, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `IdTalla` int(11) NOT NULL,
  `Talla` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`IdTalla`, `Talla`) VALUES
(1, 'Unica'),
(2, 'XSS'),
(3, 'S'),
(4, 'M'),
(5, 'L'),
(6, 'XL'),
(7, 'XXL'),
(8, 'Snapback'),
(9, 'Trucker'),
(10, 'Dadhat'),
(11, '2'),
(12, '4'),
(13, '6'),
(14, '8'),
(15, '10'),
(16, '12'),
(17, '14'),
(18, 'l');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` varchar(20) NOT NULL,
  `NomUsuario` varchar(10) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `autenticacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `IdRol`, `Nombre`, `Apellido`, `NomUsuario`, `Contrasena`, `Correo`, `FechaVencimiento`, `autenticacion`) VALUES
(16, 1, 'Fer', 'Fernandiña', 'Fer', '$2y$10$rPWOQB4IiNJUTmazRjH0guogKYMGLGBBKhb6bex5aFcZRPOwXs1EC', 'panayelyaguilar@gmail.com', '2019-10-22', ''),
(17, 2, 'Nelson', 'Murcia', 'Nelson', '$2y$10$s68jhCGDKmSAln.nNO56Lu2fWHeCW5kJt8fbM9XLD8vhhjywDkYjK', 'nelson_murcia@ricaldone.edu.sv', '2019-10-22', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `IdVendedor` int(11) NOT NULL,
  `NombreVendedor` varchar(50) NOT NULL,
  `Telefono` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`IdVendedor`, `NombreVendedor`, `Telefono`) VALUES
(1, 'MATEO BENITEZ JUAN', 23351011),
(2, 'JOSEFINA ENRIQUEZ PEÑA', 13004189),
(3, 'Acevedo Mejía Enrique', 20202021),
(4, 'Acevedo Ruiz Carolina', 69897927),
(5, 'Acosta Gámez Celina', 88311123),
(6, 'Aguilar ?orantes', 74783415),
(7, 'María Ofelia', 72516285),
(9, 'Aguilar Pérez', 62130041),
(10, 'Licona Salomon', 65598761);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `IdVenta` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`IdVenta`, `IdCliente`, `fecha`) VALUES
(1, 1, '2019-08-01'),
(2, 1, '2019-08-01'),
(3, 1, '2019-08-01'),
(4, 2, '2019-08-01'),
(5, 2, '2019-08-02'),
(6, 1, '2019-08-03'),
(7, 8, '2019-08-03'),
(8, 3, '2019-08-03'),
(9, 19, '2019-08-03'),
(10, 8, '2019-08-04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`IdBitacora`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IdCliente`),
  ADD UNIQUE KEY `DUI` (`DUI`),
  ADD UNIQUE KEY `DUI_2` (`DUI`);

--
-- Indices de la tabla `crear`
--
ALTER TABLE `crear`
  ADD PRIMARY KEY (`IdCrear`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`IdDetalle`),
  ADD KEY `IdFactura` (`IdFactura`,`IdProductoxSucursal`,`IdCliente`,`IdVendedor`),
  ADD KEY `IdProductoxSucursal` (`IdProductoxSucursal`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdVendedor` (`IdVendedor`);

--
-- Indices de la tabla `doblefactor`
--
ALTER TABLE `doblefactor`
  ADD PRIMARY KEY (`IDFactor`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`IdFactura`),
  ADD KEY `IdVendedor` (`IdVendedor`,`IdPago`),
  ADD KEY `IdPago` (`IdPago`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`IdPago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdCategoria` (`IdCategoria`);

--
-- Indices de la tabla `productoxsucursal`
--
ALTER TABLE `productoxsucursal`
  ADD PRIMARY KEY (`IdProductoxSucursal`),
  ADD KEY `IdProducto` (`IdProducto`,`IdTalla`,`IdSucursal`),
  ADD KEY `IdTalla` (`IdTalla`),
  ADD KEY `IdSucursal` (`IdSucursal`),
  ADD KEY `IdCategoria` (`IdCategoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`IdSucursal`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`IdTalla`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdRol` (`IdRol`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`IdVendedor`),
  ADD UNIQUE KEY `Telefono` (`Telefono`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`IdVenta`),
  ADD KEY `IdCliente` (`IdCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `IdBitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `crear`
--
ALTER TABLE `crear`
  MODIFY `IdCrear` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `IdDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `doblefactor`
--
ALTER TABLE `doblefactor`
  MODIFY `IDFactor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `IdPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT de la tabla `productoxsucursal`
--
ALTER TABLE `productoxsucursal`
  MODIFY `IdProductoxSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `IdSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `IdTalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `IdVendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `IdVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `detalleventa_ibfk_1` FOREIGN KEY (`IdVendedor`) REFERENCES `vendedor` (`IdVendedor`),
  ADD CONSTRAINT `detalleventa_ibfk_2` FOREIGN KEY (`IdFactura`) REFERENCES `factura` (`IdFactura`),
  ADD CONSTRAINT `detalleventa_ibfk_3` FOREIGN KEY (`IdProductoxSucursal`) REFERENCES `productoxsucursal` (`IdProductoxSucursal`),
  ADD CONSTRAINT `detalleventa_ibfk_4` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`IdVendedor`) REFERENCES `vendedor` (`IdVendedor`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`IdPago`) REFERENCES `pago` (`IdPago`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`);

--
-- Filtros para la tabla `productoxsucursal`
--
ALTER TABLE `productoxsucursal`
  ADD CONSTRAINT `productoxsucursal_ibfk_1` FOREIGN KEY (`IdTalla`) REFERENCES `tallas` (`IdTalla`),
  ADD CONSTRAINT `productoxsucursal_ibfk_2` FOREIGN KEY (`IdSucursal`) REFERENCES `sucursal` (`IdSucursal`),
  ADD CONSTRAINT `productoxsucursal_ibfk_3` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `roles` (`IdRol`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
