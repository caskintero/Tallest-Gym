-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2020 a las 15:15:57
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tallesgym`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(3) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_asistencia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_cliente`, `fecha_asistencia`) VALUES
(1, 4, '0003-03-00'),
(2, 3, '2020-03-07'),
(3, 4, '2020-03-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `cedula` varchar(8) NOT NULL,
  `nombre_client` varchar(30) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `fecha_nac` varchar(11) NOT NULL,
  `fecha_reg` varchar(11) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cedula`, `nombre_client`, `telefono`, `direccion`, `fecha_nac`, `fecha_reg`, `status`) VALUES
(1, '25889798', 'jose Garcia', '04266797076', 'Rubio', '2-26-0--20', '2020-03-01', 'A'),
(2, '26892757', 'Yexibel perez', '04247448764', 'San antonio', '3-17-0--20', '2020-03-01', 'A'),
(3, '11107168', 'Nubia Quintero', '04168742952', 'tachira san cristobal', '3-24-0--20', '2020-03-01', 'A'),
(4, '12826398', 'Miguel Garcia', '04266797076', 'La colina', '2-26-0--20', '2020-03-01', 'A'),
(5, '11107169', 'josjaosa', '312313', 'dasdad', '2-23-1--21', '2020-03-06', 'A'),
(6, '31231412', 'sadada', '31231', 'Rubio Tachira Venezuela', '3-24-0--20', '2020-03-06', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensualidad`
--

CREATE TABLE `mensualidad` (
  `id_pago` int(100) NOT NULL,
  `id_cliente` int(100) NOT NULL,
  `pago` varchar(20) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `referencia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensualidad`
--

INSERT INTO `mensualidad` (`id_pago`, `id_cliente`, `pago`, `fecha_inicio`, `fecha_final`, `referencia`) VALUES
(3, 4, 'Cancelado', '2020-03-03', '2020-03-08', '312312'),
(5, 2, 'Cancelado', '2020-03-07', '2020-04-04', '25884');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id_pago` int(100) NOT NULL,
  `id_cliente` int(100) NOT NULL,
  `pago` varchar(20) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `referencia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id_pago`, `id_cliente`, `pago`, `fecha_inicio`, `fecha_final`, `referencia`) VALUES
(2, 2, 'Finalizado', '2020-03-03', '2020-03-04', '5534'),
(4, 3, 'Finalizado', '2020-03-03', '2020-03-07', '141515'),
(5, 2, 'Finalizado', '2020-03-07', '2020-04-07', '258847');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(3) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nivel` varchar(2) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `user`, `pass`, `nombre`, `nivel`, `status`) VALUES
(1, 'admin', '12345', 'Jairo', '1', 'A'),
(2, 'jose', 'josejose', 'Jose Miguel', '2', 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_cliente2` (`id_cliente`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk3_cliente` (`id_cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  MODIFY `id_pago` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id_pago` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  ADD CONSTRAINT `fk_cliente2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `fk3_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
