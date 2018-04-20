-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2018 a las 15:46:22
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pvalle`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `apellido`, `email`, `password`, `hash`, `type`) VALUES
(1, 'fabian', 'mesaglio', 'enerone@gmail.com', '12345', '746dac1390239bf765d83eedb8ab55782c7685f9', 1),
(23, 'Virgilio', 'Rios', 'vrio@pomera.com.ar', '12345678', '8b18508d35480f1a8516f85d6d38af553fca862a', 1),
(22, 'Hernan', 'Baibiene', 'fbai@garruchos.com', '12345678', '8b18508d35480f1a8516f85d6d38af553fca862a', 1),
(8, 'Martin', 'Pires', 'mpires@grupoinsud.com', 'nosopa', 'dc70fa9b5eaa1e507607bf897d002e339e8d8577', 1),
(21, 'Gumercindo', 'Irala', 'gira@pomera.com.ar', '12345678', '8b18508d35480f1a8516f85d6d38af553fca862a', 1),
(17, 'Osvaldo', 'Moschcovich', 'omoschcovich@grupoinsud.com', '12345678', '8b18508d35480f1a8516f85d6d38af553fca862a', 1),
(18, 'Mauro ', 'Cardozo', 'mcar@yacarepora.com', '12345678', '8b18508d35480f1a8516f85d6d38af553fca862a', 1),
(19, 'Pablo', 'Aquino', 'paquino@pomera.com.ar', '12345678', '8b18508d35480f1a8516f85d6d38af553fca862a', 1),
(20, 'Maximiliano', 'Bertolini', 'Maximiliano@hotelpuertovalle.com', '12345678', '8b18508d35480f1a8516f85d6d38af553fca862a', 1),
(16, 'Fernando ', 'Prieto', 'fprieto@grupoinsud.com', '123456789', '83cf5079053ff6db5110e2a3bb3ec6d13f507d6b', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrios`
--

CREATE TABLE `barrios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `barrios`
--

INSERT INTO `barrios` (`id`, `titulo`) VALUES
(3, 'puerto valle');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradasalida`
--

CREATE TABLE `entradasalida` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `dominio` varchar(255) NOT NULL,
  `ingreso` datetime NOT NULL,
  `salida` datetime DEFAULT NULL,
  `status` enum('si','no') NOT NULL DEFAULT 'no',
  `observaciones` text NOT NULL,
  `quien` enum('insud','pedido') NOT NULL,
  `vivero` tinyint(3) UNSIGNED NOT NULL,
  `forestal` tinyint(3) UNSIGNED NOT NULL,
  `ganaderia` tinyint(3) UNSIGNED NOT NULL,
  `hotel` tinyint(3) UNSIGNED NOT NULL,
  `yacare` tinyint(3) UNSIGNED NOT NULL,
  `otros` int(11) NOT NULL,
  `tipovisita` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) UNSIGNED NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `lugar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `texto` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` enum('activo','inactivo') DEFAULT 'activo',
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `externos`
--

CREATE TABLE `externos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `art` varchar(255) NOT NULL,
  `vencimiento_art` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `cant_visitas` int(10) UNSIGNED NOT NULL,
  `ultima_visita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias`
--

CREATE TABLE `galerias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `texto` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `galerias`
--

INSERT INTO `galerias` (`id`, `titulo`, `texto`, `tipo`) VALUES
(1, 'prueba', 'adhajdffva', '1k');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_secciones`
--

CREATE TABLE `galeria_secciones` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitados`
--

CREATE TABLE `invitados` (
  `id` int(10) UNSIGNED NOT NULL,
  `dni` varchar(255) NOT NULL,
  `dominio` varchar(255) NOT NULL,
  `ingreso` datetime NOT NULL,
  `salida` datetime NOT NULL,
  `status` enum('si','no') NOT NULL DEFAULT 'no',
  `observaciones` text NOT NULL,
  `quien` enum('insud','pedido') NOT NULL,
  `vivero` tinyint(3) UNSIGNED NOT NULL,
  `forestal` tinyint(3) UNSIGNED NOT NULL,
  `ganaderia` tinyint(3) UNSIGNED NOT NULL,
  `hotel` tinyint(3) UNSIGNED NOT NULL,
  `yacare` tinyint(3) UNSIGNED NOT NULL,
  `nombre_empleado` varchar(100) NOT NULL,
  `nombre_invitado` varchar(100) NOT NULL,
  `interno` int(11) NOT NULL,
  `aclaracion` int(11) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `hora` time NOT NULL,
  `id_invitado` int(11) NOT NULL,
  `llegada` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rotador_secciones`
--

CREATE TABLE `rotador_secciones` (
  `id` int(11) NOT NULL,
  `id_sec` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `path` varchar(250) DEFAULT NULL,
  `copete` varchar(11) NOT NULL,
  `seccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rotador_secciones`
--

INSERT INTO `rotador_secciones` (`id`, `id_sec`, `tipo`, `path`, `copete`, `seccion`) VALUES
(8, 4, '0', '8565a14243ed07731c4842842b8225a1.png', '0', ''),
(9, 0, '0', 'd8a2447b6767026fb2ad16e23b1cbd65.png', '0', ''),
(11, 9, '0', '3b414e42e56e9dad78379d705bb12189.png', '', '\r\n'),
(17, 1, '0', 'db387890770fe56e04de94b42641cc36.png', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `nombre`) VALUES
(1, 'Tato Bores'),
(2, 'Eladia Blazquez'),
(3, 'Mercedes Sosa'),
(4, 'Maria Elena Walsh'),
(5, 'Atahualpa Yupanqui'),
(6, 'Antonio Berni'),
(7, 'Cesar Milstein'),
(8, 'Astor Piaziola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `seccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `texto` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `orden` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('activo','inactivo') DEFAULT NULL,
  `id_seccion` int(10) UNSIGNED DEFAULT NULL,
  `rotador` int(10) UNSIGNED DEFAULT NULL,
  `galerias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_seccion`
--

CREATE TABLE `tipo_seccion` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `marco` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_barrio` int(10) UNSIGNED DEFAULT NULL,
  `lote` int(11) UNSIGNED DEFAULT NULL,
  `mobil` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradasalida`
--
ALTER TABLE `entradasalida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `externos`
--
ALTER TABLE `externos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `galerias`
--
ALTER TABLE `galerias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `galeria_secciones`
--
ALTER TABLE `galeria_secciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invitados`
--
ALTER TABLE `invitados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rotador_secciones`
--
ALTER TABLE `rotador_secciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_seccion`
--
ALTER TABLE `tipo_seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
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
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `barrios`
--
ALTER TABLE `barrios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entradasalida`
--
ALTER TABLE `entradasalida`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `externos`
--
ALTER TABLE `externos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galerias`
--
ALTER TABLE `galerias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `galeria_secciones`
--
ALTER TABLE `galeria_secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `invitados`
--
ALTER TABLE `invitados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rotador_secciones`
--
ALTER TABLE `rotador_secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo_seccion`
--
ALTER TABLE `tipo_seccion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
