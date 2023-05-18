-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2023 a las 19:50:13
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_carros`
--

CREATE TABLE `lista_carros` (
  `id` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `ventas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_carros`
--

INSERT INTO `lista_carros` (`id`, `marca`, `ventas`) VALUES
(3, 'bmw', 123),
(4, 'Lambroghini carrera', 23),
(5, 'bugatti veyron', 18),
(6, 'Chevrolet Onix', 125),
(7, 'Suzuki Swift', 78),
(8, 'Kia Picanto', 100),
(9, 'Renault Duster', 8),
(10, 'Renault Logan', 456),
(11, 'Mazda 2', 65),
(12, 'Renault Stepway', 354),
(13, 'Renault Sandero', 99),
(14, 'Suzuki Vitara', 673),
(15, 'Renault Wind', 88),
(16, 'Foton', 32),
(17, 'BYD', 66),
(18, 'Great Wall', 78),
(19, 'JAC', 33),
(20, 'JMC', 77),
(21, 'DFSK', 234),
(22, 'Changan', 45),
(23, 'Tesla x', 87),
(24, 'Jeep Grand Wagoneer', 899);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lista_carros`
--
ALTER TABLE `lista_carros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lista_carros`
--
ALTER TABLE `lista_carros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
