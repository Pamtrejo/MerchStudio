-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2019 a las 23:07:00
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `merch`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Categoria`, `Descripcion`) VALUES
(1, 'Camisetas', 'En la cstegoria camisetas tambien se encuentras los centros.'),
(2, 'Accesorios', 'Los accesorios pueden ser sticjers,llaveros y entre otros'),
(3, 'Tazas', 'No hay descripcion.'),
(4, 'Jarras', 'No hay descripcion.'),
(5, 'Squeeze', 'No hay descripcion.'),
(6, 'Yetis', 'No hay descripcion.'),
(7, 'Perrito', 'Son camisas para perritos.'),
(8, 'Gorras', 'No hay descripcion.'),
(9, 'Camisa niño', 'No hay descripcion.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `IdCliente` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL,
  `DUI` int(11) DEFAULT NULL,
  `Direccion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crear`
--

CREATE TABLE `crear` (
  `IdCrear` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `PosicionX` float NOT NULL,
  `PosicioY` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `Venta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menuxrol`
--

CREATE TABLE `menuxrol` (
  `IdMenuRol` int(11) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `IdMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `IdPago` int(11) NOT NULL,
  `TipoPago` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '$10.00 ', 1, '1821', '1821'),
(2, '$10.00 ', 1, 'always', 'Always Hungry'),
(3, '$10.00 ', 1, 'pasmado', 'Ando con un pasmado'),
(4, '$12.00 ', 1, 'basic', 'Basic Box'),
(5, '$15.00 ', 1, 'batallon', 'Batall?n Semita'),
(6, '$10.00 ', 1, 'bff', 'Best friends forever'),
(7, '$15.00 ', 1, 'billete', 'Billete'),
(8, '$10.00 ', 1, 'bolo', 'Bolo'),
(9, '$10.00 ', 1, 'cheat', 'Cheat day'),
(10, '$10.00 ', 1, 'ciudades1', 'Ciudades 1'),
(11, '$10.00 ', 1, 'ciudades2', 'Ciudades 2'),
(12, '$10.00 ', 1, 'copa', 'Copa mundial'),
(13, '$10.00 ', 1, 'costa', 'Costa del sol'),
(14, '$10.00 ', 1, 'desayuno', 'Desayunos t?picos'),
(15, '$10.00 ', 1, 'domingoma', 'Domingoma'),
(16, '$10.00 ', 1, 'ajolot', 'Do not Ajolot & relax the cake'),
(17, '$10.00 ', 1, 'dont ', 'Don\'t worry'),
(18, '$10.00 ', 1, 'einstein', 'Einstein '),
(19, '$15.00 ', 1, 'surf', 'El tunco surf club'),
(20, '$10.00 ', 1, 'estar ', 'Estar guars'),
(21, '$15.00 ', 1, 'dreams', 'Follow your dreams'),
(22, '$15.00 ', 1, 'fornite', 'Fortnite'),
(23, '$10.00 ', 1, 'torrejas', 'Game of Torrejas'),
(24, '$10.00 ', 1, 'genuine', 'Geniune paradise'),
(25, '$15.00 ', 1, 'greetings', 'Greetings'),
(26, '$15.00 ', 1, 'hakuna', 'Hakuna matata'),
(27, '$10.00 ', 1, 'hay pupusas', 'Hay pupusas'),
(28, '$20.00 ', 1, 'hoodie netflix', 'Hoodie Netflix & chill'),
(29, '$20.00 ', 1, 'hoodie tropics', 'Hoodie tropical paradise'),
(30, '$10.00 ', 1, 'horchata', 'Horchata y suspiros'),
(31, '$10.00 ', 1, 'instalega', 'Instalega'),
(32, '$15.00 ', 1, 'abuela', 'La abuela'),
(33, '$15.00 ', 1, 'centro la vida', 'La vida es playa (centro)'),
(34, '$15.00 ', 1, 'libertad', 'Libertad'),
(35, '$10.00 ', 1, 'made in', 'Made in'),
(36, '$10.00 ', 1, 'magico', 'M?gico'),
(37, '$10.00 ', 1, 'make pupusas', 'Make pupusas not war.'),
(38, '$5.00 ', 1, 'mini logo', 'Mini logo'),
(39, '$5.00 ', 1, 'centro mini logo', 'Mini logo (centro)'),
(40, '$15.00 ', 1, 'nambe', 'Nambe chele'),
(41, '$10.00 ', 1, 'netflix', 'Netflix & chill'),
(42, '$15.00 ', 1, 'nintendo', 'Nintendo 64'),
(43, '$15.00 ', 1, 'pilas', 'Nos ponemos las pilas'),
(44, '$15.00 ', 1, 'obligame', 'Obligame prro'),
(45, '$10.00 ', 1, 'panchita', 'Panchita'),
(46, '$10.00 ', 1, 'partners', 'Partners in crime'),
(47, '$15.00 ', 1, 'pilsener', 'Pilsener'),
(48, '$10.00 ', 1, 'barril', 'Pilsener barril'),
(49, '$15.00 ', 1, 'placas', 'Placas'),
(50, '$10.00 ', 1, 'pcn', 'Pupusas chocolate & netflix.'),
(51, '$10.00 ', 1, 'pupusa', 'Pupusa power'),
(52, '$15.00 ', 1, 'regia', 'Regia '),
(53, '$15.00 ', 1, 'centro regia', 'Regia (centro)'),
(54, '$15.00 ', 1, 'busito', 'Ruta 503 (Busito)'),
(55, '$10.00 ', 1, 'salvador 1', 'Salvador del mundo 1'),
(56, '$10.00 ', 1, 'salvador 2', 'Salvador del mundo 2'),
(57, '$10.00 ', 1, 'selena', 'Selena'),
(58, '$10.00 ', 1, 'sivar', 'Sivar is the shit'),
(59, '$15.00 ', 1, 'sorbete', 'Sorbete de carret?n'),
(60, '$10.00 ', 1, 'spanglish', 'Spanglish'),
(61, '$20.00 ', 1, 'Sudadera esa', 'Sudadera ESA'),
(62, '$10.00 ', 1, 'teikirisi', 'Teikirisi'),
(63, '$10.00 ', 1, 'tipicos', 'Platillos t?picos'),
(64, '$10.00 ', 1, 'tropics', 'Tropics'),
(65, '$15.00 ', 1, 'centro tunco', 'Tunco (centro)'),
(66, '$10.00 ', 1, 'vale v', 'Vale verga'),
(67, '$15.00 ', 1, 'ni le ocre', 'Ni le ocre'),
(68, '$15.00 ', 1, 'nacion', 'Naci?n Soya city'),
(69, '$7.00', 2, 'calcetines', 'Funky Sox'),
(70, '$1.00', 2, 'dinosaurio', 'Juguete Dinosaurio'),
(71, '$10.00', 2, 'fidget', 'Fidget Cube'),
(72, '$5.00', 2, 'iman', 'Destapador im?n\r'),
(73, '$0.50', 2, 'lapiz', 'L?piz'),
(74, '$5.00', 2, 'launcher', 'Cap Launcher'),
(75, '$5.00', 2, 'lentes', 'Lentes de sol'),
(76, '$3.00', 2, 'parche', 'Parche para ropa'),
(77, '$1.00', 2, 'pelotita', 'Pelotita'),
(78, '$1.00', 2, 'pin', 'Pin'),
(79, '$3.00', 2, 'pop', 'Pop Socket'),
(80, '$5.00', 2, 'porta lentes', 'Porta Lente'),
(81, '$5.00', 2, 'porta vaso', 'Porta Vaso'),
(82, '$10.00', 2, 'pulsera', 'Pulsera'),
(83, '$0.50', 2, 'ranita', 'Ranita Juguete'),
(84, '$1.00', 2, 'sorpresa', 'Sorpresita infantil'),
(85, '$1.00', 2, 'sticker', 'Sticker '),
(86, '$0.25', 2, 'sticker soya', 'Stciker Soya City'),
(87, '$0.25', 2, 'vinil', 'Vinil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoxsucursal`
--

CREATE TABLE `productoxsucursal` (
  `IdProductoxSucursal` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `IdTalla` int(11) NOT NULL,
  `IdSucursal` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdRol` int(11) NOT NULL,
  `TipoRol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `IdSucursal` int(11) NOT NULL,
  `NomSucursal` varchar(100) NOT NULL,
  `Direccion` varchar(1000) NOT NULL,
  `Telefono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Única'),
(2, 'XS'),
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
(17, '14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` int(20) NOT NULL,
  `NomUsuario` varchar(10) NOT NULL,
  `Contrasena` varchar(10) NOT NULL,
  `Correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `IdVendedor` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IdCliente`);

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
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`IdFactura`),
  ADD KEY `IdVendedor` (`IdVendedor`,`IdPago`),
  ADD KEY `IdPago` (`IdPago`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indices de la tabla `menuxrol`
--
ALTER TABLE `menuxrol`
  ADD PRIMARY KEY (`IdMenuRol`),
  ADD KEY `IdRol` (`IdRol`,`IdMenu`),
  ADD KEY `IdMenu` (`IdMenu`);

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
  ADD KEY `IdSucursal` (`IdSucursal`);

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
  ADD PRIMARY KEY (`IdVendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crear`
--
ALTER TABLE `crear`
  MODIFY `IdCrear` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `IdDetalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menuxrol`
--
ALTER TABLE `menuxrol`
  MODIFY `IdMenuRol` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `IdPago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT de la tabla `productoxsucursal`
--
ALTER TABLE `productoxsucursal`
  MODIFY `IdProductoxSucursal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `IdSucursal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `IdTalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `IdVendedor` int(11) NOT NULL AUTO_INCREMENT;
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
-- Filtros para la tabla `menuxrol`
--
ALTER TABLE `menuxrol`
  ADD CONSTRAINT `menuxrol_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `roles` (`IdRol`),
  ADD CONSTRAINT `menuxrol_ibfk_2` FOREIGN KEY (`IdMenu`) REFERENCES `menu` (`IdMenu`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
