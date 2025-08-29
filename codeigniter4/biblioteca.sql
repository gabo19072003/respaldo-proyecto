-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2025 a las 19:29:43
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(255) NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `detalles` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `estado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `start`, `end`, `color`, `lugar`, `detalles`, `responsable`, `estado`) VALUES
(1, 'hola', '2024-06-17 03:30:16', '2024-06-18 03:30:16', '#ffff00', 'dsdsds', 'fsdsdfsf', '27371854', '0000-00-00 00:00:00'),
(3, 'l', '2024-06-20 16:37:27', '2024-06-24 16:37:27', '#800040', 'hjh', 'hola', 'hjh', '0000-00-00 00:00:00'),
(5, 'hopl', '2024-06-12 02:02:00', '2024-06-26 02:02:00', '#400080', 'dsdd', '2121', '27371854', '0000-00-00 00:00:00'),
(6, 'saaaaaaa', '2024-06-21 22:22:00', '2024-06-26 02:22:00', '#ff80ff', 'aaaaaaaa', 'asa', 'aaa', '0000-00-00 00:00:00'),
(7, 'dddddddd', '2024-06-21 08:08:00', '2024-06-27 08:08:00', '#27720e', 'ddddddddd', 'ddddddddd', 'ddddddd', '2024-06-25 21:57:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `lib_id` int(11) NOT NULL,
  `cota` varchar(20) NOT NULL,
  `lib_nombre` varchar(255) NOT NULL,
  `lib_editorial` varchar(150) NOT NULL,
  `lib_autor` varchar(150) NOT NULL,
  `ocupado` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`lib_id`, `cota`, `lib_nombre`, `lib_editorial`, `lib_autor`, `ocupado`, `user_id`) VALUES
(33, '234333', 'Matematica', 'santillana', 'pedro garcia', '0000-00-00 00:00:00', 0),
(34, '8578', 'castellano', 'Aguilar', 'maria borger', '0000-00-00 00:00:00', 0),
(35, '232', 'biologia', 'Joaquín Mortiz', 'ronald ', '0000-00-00 00:00:00', 0),
(36, '423', 'programacion', 'Gustavo Gili', 'luis perez', '0000-00-00 00:00:00', 0),
(37, '5535', 'cien años de soledad', 'Paidós', 'angel lopez', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `user_passwd` varchar(130) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_active` tinyint(4) NOT NULL DEFAULT 0,
  `persona_id` int(11) NOT NULL,
  `user_token` varchar(100) DEFAULT NULL,
  `user_reset_token` varchar(100) DEFAULT NULL,
  `user_reset_expires_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user`, `user_passwd`, `rol_id`, `user_name`, `user_lastname`, `user_email`, `user_active`, `persona_id`, `user_token`, `user_reset_token`, `user_reset_expires_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(36, 'antahony', '$2y$10$.YuSczncw.gWY2BNRJAt3e6w/UvcykxVB31CsqTPAcSusH2hRM3vC', 1, 'anthony', 'osorio', 'antahony@gmail.com', 1, 25, '', '370bdb27c0ed98529e51d7095c63a2d44c8f5ed7', '2025-03-15 15:04:51', '2024-06-15 10:11:35', '2025-03-15 14:04:51', '0000-00-00 00:00:00'),
(37, 'caballo', '$2y$10$YJX.EmcejtLZEi1J.fH0XOw3xOfWjdpxuaqWgoH6CBM6FzIYsJ5DO', 1, 'brayan', 'ustariz', 'brayan17enrique@gmail.com', 1, 27, '', NULL, NULL, '2024-06-15 15:20:40', '2025-03-15 13:39:32', '2025-03-15 13:39:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`lib_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `lib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
