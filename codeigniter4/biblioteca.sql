-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-08-2025 a las 02:09:01
-- Versión del servidor: 10.4.32-MariaDB
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
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `bitacora_id` int(11) NOT NULL,
  `bitacora_ip` varchar(100) NOT NULL,
  `bitacora_detalles` varchar(255) NOT NULL,
  `bitacora_fecha` date NOT NULL DEFAULT current_timestamp(),
  `bitacora_hora` time NOT NULL DEFAULT current_timestamp(),
  `user` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`bitacora_id`, `bitacora_ip`, `bitacora_detalles`, `bitacora_fecha`, `bitacora_hora`, `user`) VALUES
(64, '127.0.0.1', 'Inició sesión', '2025-06-10', '15:31:00', 'gabriel'),
(65, '127.0.0.1', 'Inició sesión', '2025-06-10', '16:54:05', 'gabriel'),
(66, '127.0.0.1', 'Inició sesión', '2025-06-20', '16:07:29', 'gabriel'),
(67, '127.0.0.1', 'Inició sesión', '2025-06-20', '18:20:24', 'gabriel'),
(68, '127.0.0.1', 'Inició sesión', '2025-06-20', '19:07:40', 'gabriel'),
(69, '127.0.0.1', 'Inició sesión', '2025-06-20', '19:29:08', 'gabriel'),
(70, '127.0.0.1', 'Inició sesión', '2025-06-20', '19:33:05', 'gabriel'),
(71, '127.0.0.1', 'Inició sesión', '2025-06-22', '18:43:56', 'gabriel'),
(72, '127.0.0.1', 'Inició sesión', '2025-06-24', '12:46:13', 'gabriel'),
(73, '127.0.0.1', 'Inició sesión', '2025-06-24', '17:43:30', 'yeliant'),
(74, '127.0.0.1', 'Inició sesión', '2025-07-03', '21:12:45', 'gabriel'),
(75, '127.0.0.1', 'Inició sesión', '2025-07-03', '21:12:57', 'gabriel'),
(76, '127.0.0.1', 'Inició sesión', '2025-07-04', '13:17:20', 'gabriel'),
(77, '127.0.0.1', 'Inició sesión', '2025-07-04', '13:17:28', 'gabriel'),
(78, '127.0.0.1', 'Inició sesión', '2025-07-04', '13:24:31', 'gabriel'),
(79, '127.0.0.1', 'Inició sesión', '2025-08-12', '17:57:37', 'yeliant'),
(80, '127.0.0.1', 'Inició sesión', '2025-08-12', '17:57:54', 'gabriel'),
(81, '127.0.0.1', 'Inició sesión', '2025-08-28', '20:08:26', 'gabriel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `cargo_id` int(11) NOT NULL,
  `cargo_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`cargo_id`, `cargo_name`) VALUES
(1, 'recepcionista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casilleros`
--

CREATE TABLE `casilleros` (
  `casillero_id` int(11) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `casillero_detalles` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `ocupado` datetime DEFAULT NULL,
  `libro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `casilleros`
--

INSERT INTO `casilleros` (`casillero_id`, `cedula`, `nombre`, `casillero_detalles`, `created_at`, `updated_at`, `ocupado`, `libro_id`) VALUES
(1, '5', '', 'gabriel', '0000-00-00 00:00:00', '2025-06-22 08:21:39', '2025-06-22 08:21:39', NULL),
(3, '29923258', 'Gabriel', 'dsfgnsdknvksdnvsd', '0000-00-00 00:00:00', '2025-06-22 09:00:50', '2025-06-22 09:00:50', NULL),
(4, '31944662', 'otro', 'sadsdasdasdas', '2024-06-21 17:28:58', '2025-06-22 13:49:55', NULL, 35),
(5, '32233333', 'jose', '', '2025-06-22 09:01:18', '2025-06-22 13:30:11', NULL, 36),
(6, '31666944', 'yrli', '', '2025-06-22 13:29:06', '2025-06-22 13:29:06', NULL, 37),
(7, '11471544', 'rey', '', '2025-06-22 13:29:53', '2025-06-22 13:29:53', NULL, 35),
(8, '6965051', 'gui', '', '2025-06-22 13:35:31', '2025-06-22 13:35:31', NULL, 38),
(9, '7894563', 'fcv', '', '2025-06-22 13:35:54', '2025-06-22 13:51:20', '2025-06-22 13:51:20', 38),
(10, '30666972', 'yeliant', '', '2025-06-22 13:50:14', '2025-06-22 13:50:14', NULL, 33),
(11, '31944663', 'ana', '', '2025-07-04 07:26:17', '2025-07-04 07:45:07', '2025-07-04 07:45:07', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cubiculos`
--

CREATE TABLE `cubiculos` (
  `cubiculo_id` int(11) NOT NULL,
  `cubiculo_nro` int(10) NOT NULL,
  `cubiculo_ubicacion` int(4) NOT NULL,
  `cubiculo_escritorio` varchar(255) NOT NULL,
  `cubiculo_silla` int(80) NOT NULL,
  `cubiculo_ventana` int(4) NOT NULL,
  `cubiculo_redes` int(4) NOT NULL,
  `cubiculo_espacioso` int(4) NOT NULL,
  `cubiculo_detalles` varchar(255) NOT NULL,
  `ocupado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cubiculos`
--

INSERT INTO `cubiculos` (`cubiculo_id`, `cubiculo_nro`, `cubiculo_ubicacion`, `cubiculo_escritorio`, `cubiculo_silla`, `cubiculo_ventana`, `cubiculo_redes`, `cubiculo_espacioso`, `cubiculo_detalles`, `ocupado`) VALUES
(3, 43, 1, '1719005374_6f6f737391f5afb46eb6.jpg', 6, 1, 1, 0, 'salon infantill', '0000-00-00 00:00:00'),
(4, 2, 1, '1718208536_f5762bcb1a0adad28bcb.jpg', 10, 1, 1, 0, 'Prestamo de cec', '0000-00-00 00:00:00'),
(5, 22, 0, '1718208569_25f73acf0d3c9f16393b.png', 8, 1, 1, 0, 'Ventana dañada', '0000-00-00 00:00:00'),
(7, 32, 0, '1718215154_b61a27797523c985707a.png', 5, 1, 1, 1, 'espacioso', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `start`, `end`, `color`, `lugar`, `detalles`, `responsable`, `estado`) VALUES
(1, 'hola', '2024-06-17 03:30:16', '2024-06-18 03:30:16', '#ffff00', 'dsdsds', 'fsdsdfsf', '27371854', '0000-00-00 00:00:00'),
(3, 'l', '2024-06-20 16:37:27', '2024-06-24 16:37:27', '#800040', 'hjh', 'hola', 'hjh', '0000-00-00 00:00:00'),
(5, 'hopl', '2024-06-12 02:02:00', '2024-06-26 02:02:00', '#400080', 'dsdd', '2121', '27371854', '0000-00-00 00:00:00'),
(6, 'saaaaaaa', '2024-06-21 22:22:00', '2024-06-26 02:22:00', '#ff80ff', 'aaaaaaaa', 'asa', 'aaa', '0000-00-00 00:00:00'),
(7, 'dddddddd', '2024-06-21 08:08:00', '2024-06-27 08:08:00', '#27720e', 'ddddddddd', 'ddddddddd', 'ddddddd', '2024-06-25 21:57:37'),
(8, 'sadsda', '2025-06-20 02:10:00', '2025-06-20 02:02:00', '#000000', 'sdadsa', 'asddasdasd', 'dasda', '0000-00-00 00:00:00'),
(9, 'gabriel', '2025-06-22 15:05:00', '2025-06-24 15:05:00', '#ff0000', 'biblioteca', 'prestamo de libro', '29923258', '0000-00-00 00:00:00'),
(10, 'yeliant', '2025-07-04 13:34:00', '2025-07-17 13:04:00', '#000000', 'salom infantil', 'se kkevbii el libro', 'yeliant', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`lib_id`, `cota`, `lib_nombre`, `lib_editorial`, `lib_autor`, `ocupado`, `user_id`) VALUES
(33, '234333', 'Matematica', 'santillana', 'pedro garcia', '0000-00-00 00:00:00', 0),
(36, '423', 'programacion', 'Gustavo Gili', 'luis perez', '0000-00-00 00:00:00', 0),
(37, '5535', 'cien años de soledad', 'Paidós', 'angel lopez', '0000-00-00 00:00:00', 0),
(38, '1234', 'windows', 'bibliografico', 'bill gates', '0000-00-00 00:00:00', 0),
(39, '1552', 'el principito', 'santillana', 'carlos superrique', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidades`
--

CREATE TABLE `modalidades` (
  `modalidad_id` int(11) NOT NULL,
  `modalidad_detalles` varchar(255) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `ocupado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modalidades`
--

INSERT INTO `modalidades` (`modalidad_id`, `modalidad_detalles`, `servicio_id`, `created_at`, `updated_at`, `ocupado`) VALUES
(1, 'holas', 5, '2024-06-14 02:24:16', '2024-06-13 20:57:07', '2024-06-13 20:57:07'),
(2, 'holaaaa', 5, '2024-06-14 02:24:16', '2024-06-13 22:13:51', '2024-06-13 22:13:51'),
(3, 'dafesdfgesawf', 0, '2024-06-13 21:06:39', '2024-06-13 21:06:39', '0000-00-00 00:00:00'),
(4, 'tfrewtfew4rft', 0, '2024-06-13 21:06:45', '2024-06-13 21:06:45', '0000-00-00 00:00:00'),
(5, 'dfgrdtgtgfd', 0, '2024-06-13 21:16:27', '2024-06-13 21:16:27', '0000-00-00 00:00:00'),
(6, 'sdfersttr', 0, '2024-06-13 21:26:14', '2024-06-13 21:26:14', '0000-00-00 00:00:00'),
(7, 'fdgsertwt', 0, '2024-06-13 21:26:58', '2024-06-13 21:26:58', '0000-00-00 00:00:00'),
(8, 'hrtdhy', 0, '2024-06-13 22:04:50', '2024-06-13 22:04:50', '0000-00-00 00:00:00'),
(9, 'tyrytrt', 0, '2024-06-13 22:10:41', '2024-06-13 22:10:41', '0000-00-00 00:00:00'),
(10, 'locols', 5, '2024-06-13 22:13:00', '2024-06-13 22:13:00', '0000-00-00 00:00:00'),
(11, 'asdfsafes', 5, '2024-06-13 22:13:41', '2024-06-13 22:13:41', '0000-00-00 00:00:00'),
(12, 'salas de referencia', 3, '2024-06-13 22:43:01', '2024-06-19 18:12:27', '0000-00-00 00:00:00'),
(13, 'prestamo en sala', 4, '2024-06-13 22:50:34', '2024-06-18 11:14:30', '0000-00-00 00:00:00'),
(14, 'sala  maruja roche', 3, '2024-06-18 11:11:32', '2024-06-18 11:11:32', '0000-00-00 00:00:00'),
(15, 'sala de lectura piso 1', 3, '2024-06-18 11:12:00', '2024-06-18 11:12:00', '0000-00-00 00:00:00'),
(16, 'sala ramon  palomares', 3, '2024-06-18 11:12:32', '2024-06-18 11:13:16', '0000-00-00 00:00:00'),
(17, 'sala infantil', 3, '2024-06-18 11:12:55', '2024-06-18 11:12:55', '0000-00-00 00:00:00'),
(18, 'prestamo circulante', 4, '2024-06-18 11:14:59', '2024-06-18 11:14:59', '0000-00-00 00:00:00'),
(19, 'prestamo especial', 4, '2024-06-18 11:15:11', '2025-06-20 12:27:11', '0000-00-00 00:00:00'),
(20, 'prestamo intelbibliotecario', 4, '2024-06-18 11:16:03', '2024-06-18 11:16:03', '0000-00-00 00:00:00'),
(21, 'reserva de documentos', 4, '2024-06-18 11:16:22', '2024-06-18 11:16:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `persona_id` int(11) NOT NULL,
  `persona_nombre` varchar(100) NOT NULL,
  `persona_apellido` varchar(100) NOT NULL,
  `persona_fch_nacimi` date NOT NULL,
  `persona_carnet` varchar(11) NOT NULL,
  `persona_ci` int(11) NOT NULL,
  `persona_sexo` varchar(15) NOT NULL,
  `persona_tf` varchar(25) NOT NULL,
  `persona_email` varchar(80) NOT NULL,
  `persona_foto` varchar(50) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`persona_id`, `persona_nombre`, `persona_apellido`, `persona_fch_nacimi`, `persona_carnet`, `persona_ci`, `persona_sexo`, `persona_tf`, `persona_email`, `persona_foto`, `cargo_id`, `tipo_id`, `direccion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, 'yeliant', 'buitrago', '2000-03-05', '7654321', 27371854, 'masculino', '04125939885', 'yeli@gmail.com', '1749563169_7c1cca2115066ed6d3b2.png', 1, 1, 'los teuqes', '2024-06-15 05:02:14', '2025-06-10 09:46:59', '0000-00-00 00:00:00'),
(28, 'jose gabriel', 'yanez chavez', '2003-07-19', '1234567', 29923258, 'masculino', '04129958321', 'yanezgabriel78910@gmail.com', '1749562077_d4ff8c45d27d703988c0.png', 1, 1, 'san diego', '2025-06-10 09:27:57', '2025-06-10 09:27:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `recurso_id` int(11) NOT NULL,
  `recurso_nro` int(10) NOT NULL,
  `recurso_nombre` varchar(80) NOT NULL,
  `ocupado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`recurso_id`, `recurso_nro`, `recurso_nombre`, `ocupado`) VALUES
(1, 34, 'pc', '0000-00-00 00:00:00'),
(2, 37, 'impresora', '0000-00-00 00:00:00'),
(3, 2, 'telefono', '0000-00-00 00:00:00'),
(4, 4, 'Televisor', '0000-00-00 00:00:00'),
(5, 7, 'camara', '0000-00-00 00:00:00'),
(6, 43, 'tablet', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre`) VALUES
(1, 'Tecnologia'),
(2, 'Coordinador'),
(3, 'Jefe'),
(4, 'Recepcionista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `tipo_id` int(11) NOT NULL,
  `tipo_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`tipo_id`, `tipo_name`) VALUES
(1, 'rango');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user`, `user_passwd`, `rol_id`, `user_name`, `user_lastname`, `user_email`, `user_active`, `persona_id`, `user_token`, `user_reset_token`, `user_reset_expires_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(36, 'antahony', '$2y$10$.YuSczncw.gWY2BNRJAt3e6w/UvcykxVB31CsqTPAcSusH2hRM3vC', 1, 'anthony', 'osorio', 'antahony@gmail.com', 1, 25, '', '370bdb27c0ed98529e51d7095c63a2d44c8f5ed7', '2025-03-15 15:04:51', '2024-06-15 10:11:35', '2025-06-10 09:31:08', '2025-06-10 09:31:08'),
(37, 'caballo', '$2y$10$YJX.EmcejtLZEi1J.fH0XOw3xOfWjdpxuaqWgoH6CBM6FzIYsJ5DO', 1, 'brayan', 'ustariz', 'brayan17enrique@gmail.com', 1, 27, '', NULL, NULL, '2024-06-15 15:20:40', '2025-03-15 13:39:32', '2025-03-15 13:39:32'),
(38, 'gabriel', '$2y$10$PWsPQQHzn0BUKdOly327LOdjWJ/J9re2gdnPAO1d5yM5IfKv7a9/O', 3, 'gabriel', 'yanez', 'yanezgabriel78910@gmail.com', 1, 28, '', 'e7e0b160d4be4f7b8e9d7376884eedb8dd8898fc', '2025-06-24 07:59:52', '2025-06-10 09:29:16', '2025-07-04 08:11:53', '0000-00-00 00:00:00'),
(39, 'yeliant', '$2y$10$4dhzgWR.X2g.6LVLE.Xu6O/9j3cS2rLQljVLkyXZCqnd1N2TUPoj.', 1, 'yeliant', 'buitrago', 'yeli@gmail.com', 1, 25, '', NULL, NULL, '2025-06-10 10:48:02', '2025-06-10 10:48:28', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`bitacora_id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`cargo_id`);

--
-- Indices de la tabla `casilleros`
--
ALTER TABLE `casilleros`
  ADD PRIMARY KEY (`casillero_id`);

--
-- Indices de la tabla `cubiculos`
--
ALTER TABLE `cubiculos`
  ADD PRIMARY KEY (`cubiculo_id`);

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
-- Indices de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`modalidad_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`persona_id`),
  ADD UNIQUE KEY `personal_carnet` (`persona_carnet`),
  ADD UNIQUE KEY `personal_ci` (`persona_ci`),
  ADD UNIQUE KEY `personal_email` (`persona_email`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`recurso_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `bitacora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `casilleros`
--
ALTER TABLE `casilleros`
  MODIFY `casillero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cubiculos`
--
ALTER TABLE `cubiculos`
  MODIFY `cubiculo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `lib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `modalidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `persona_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `recurso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
