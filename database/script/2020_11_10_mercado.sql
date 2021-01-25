-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-11-2020 a las 14:06:48
-- Versión del servidor: 8.0.21-0ubuntu0.20.04.4
-- Versión de PHP: 7.2.33-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_paterno` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `a_materno` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `imagen` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rol` enum('Supervisor','Encargado','Contador','Cliente') COLLATE utf8_bin NOT NULL DEFAULT 'Cliente',
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `a_paterno`, `a_materno`, `imagen`, `rol`, `activo`, `password`) VALUES
(3, 'Jorge Octavio', 'Guzmán', 'Sánchez', 'fotogit.jpg', 'Supervisor', 0, '$2y$10$yyXJqXRqSEfOscVNBS8Jm.uovr8x1OzuE.DpXlwQmvoAA7dai1csm'),
(4, 'Encargado', NULL, NULL, NULL, 'Encargado', 0, '$2y$10$pfwFtyBI0Y16g.sWaItlT.w8jw3n1.maj8N/r9epXHm202VV7A.fK'),
(5, 'Contador', NULL, NULL, NULL, 'Contador', 0, '$2y$10$QyyvHNu86kl/HmBldU0GP.A6Z.inalQcsLWAFXltCMDBk4Bb/JHse'),
(6, 'Cliente', NULL, NULL, NULL, 'Supervisor', 0, '$2y$10$9zASZK6DwWbNyiODmr2X/up8SpNuQ.H2EkkPJhg58fipb8B6pVGo2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
