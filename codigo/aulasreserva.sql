-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2016 a las 23:00:39
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aulasreserva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `AULA` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`AULA`) VALUES
('107 Althia'),
('112 Informática'),
('215'),
('221'),
('222'),
('Salón de actos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `NUMHORA` int(2) NOT NULL,
  `HORA` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`NUMHORA`, `HORA`) VALUES
(1, '08:30'),
(2, '09:20'),
(3, '10:15'),
(4, '11:45'),
(5, '12:35'),
(6, '13:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `EMAIL` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AULA` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NUMHORA` int(2) NOT NULL,
  `FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`EMAIL`, `AULA`, `NUMHORA`, `FECHA`) VALUES
('ernestorumo@gmail.com', '107 Althia', 1, '2016-02-12'),
('ernestorumo@gmail.com', '107 Althia', 2, '2016-02-12'),
('ernestorumo@gmail.com', '107 Althia', 3, '2016-02-12'),
('ernestorumo@gmail.com', '107 Althia', 4, '2016-02-12'),
('ernestorumo@gmail.com', '215', 1, '2016-02-10'),
('ernestorumo@gmail.com', '215', 2, '2016-02-10'),
('ernestorumo@gmail.com', '215', 3, '2016-02-10'),
('ernestorumo@gmail.com', '215', 4, '2016-02-10'),
('ernestorumo@gmail.com', '215', 5, '2016-02-10'),
('ernestorumo@gmail.com', '222', 3, '2016-02-10'),
('ernestorumo@gmail.com', '222', 4, '2016-02-10'),
('ernestorumo@gmail.com', '222', 5, '2016-02-10'),
('maria@gmail.com', '215', 1, '2016-02-11'),
('maria@gmail.com', '215', 2, '2016-02-11'),
('maria@gmail.com', '215', 3, '2016-02-11'),
('maria@gmail.com', '215', 4, '2016-02-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `EMAIL` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NOMBRE` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PASS` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ROL` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`EMAIL`, `NOMBRE`, `PASS`, `ROL`) VALUES
('ernestorumo@gmail.com', 'Ernesto', '$2y$10$3R6Lg7mFXOS4ng9DvmTZEO2CmYK5ZZKxwz73SjhxaBJ0Qm2gXI4Ve', 0),
('maria@gmail.com', 'Maria', '$2y$10$vmEFlKoFKsxfzaYj6rRx8O.psFRxJWcXFrFgdKhz7VV/VZ/CiuZ8m', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`AULA`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`NUMHORA`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`AULA`,`NUMHORA`,`FECHA`),
  ADD KEY `NUMHORA` (`NUMHORA`),
  ADD KEY `AULA` (`AULA`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`EMAIL`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`NUMHORA`) REFERENCES `horas` (`NUMHORA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`AULA`) REFERENCES `aulas` (`AULA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_4` FOREIGN KEY (`EMAIL`) REFERENCES `usuarios` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
