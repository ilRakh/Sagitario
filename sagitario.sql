-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2021 a las 10:01:52
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sagitario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id_asignacion` int(11) NOT NULL,
  `cuil_doctor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticos`
--

CREATE TABLE `diagnosticos` (
  `id_diagnostico` int(11) NOT NULL,
  `diagnostico` int(11) NOT NULL,
  `cuil_doctor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diario_paciente`
--

CREATE TABLE `diario_paciente` (
  `id_diario` int(11) NOT NULL,
  `title_diario` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `texto_diario` text COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_diario` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades`
--

CREATE TABLE `enfermedades` (
  `id_enfermedad` int(11) NOT NULL,
  `enfermedad` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `enfermedades`
--

INSERT INTO `enfermedades` (`id_enfermedad`, `enfermedad`) VALUES
(1, 'Cáncer'),
(2, 'Oftalmológica'),
(3, 'Odontológica'),
(4, 'Vacunación'),
(5, 'Cardiaca'),
(6, 'Físicas(Fracturas, contusiones, etc)'),
(7, 'Otologica'),
(8, 'Alimenticia'),
(9, 'Psiquiátricas'),
(10, 'Otra (Escríbala)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evolucion_paciente`
--

CREATE TABLE `evolucion_paciente` (
  `id_evolucion` int(11) NOT NULL,
  `datos_evolucion` int(11) NOT NULL,
  `estado_paciente` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_doctor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_citas`
--

CREATE TABLE `historial_citas` (
  `id_historial` int(11) NOT NULL,
  `razon_cita` text COLLATE utf8_unicode_ci NOT NULL,
  `conclusion_cita` text COLLATE utf8_unicode_ci NOT NULL,
  `estado_paciente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_cita` timestamp NOT NULL DEFAULT current_timestamp(),
  `cuil_doctor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_noti` int(11) NOT NULL,
  `texto_noti` text COLLATE utf8_unicode_ci NOT NULL,
  `cuil_doctor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `estado_noti` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_noti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otros_diagnosticos`
--

CREATE TABLE `otros_diagnosticos` (
  `id_otros` int(11) NOT NULL,
  `diagnostico` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_doctor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendaciones`
--

CREATE TABLE `recomendaciones` (
  `id_recomendacion` int(11) NOT NULL,
  `recomendacion` text COLLATE utf8_unicode_ci NOT NULL,
  `cuil_paciente` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `cuil_doctor` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `id_diario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(55) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Doctor'),
(3, 'Paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_noti`
--

CREATE TABLE `tipo_noti` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_noti`
--

INSERT INTO `tipo_noti` (`id_tipo`, `tipo`) VALUES
(1, 'Solicitud de Cita'),
(2, 'Nuevo Paciente para Asignar'),
(3, 'Confirmación o Rechazo de Cita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `cuil` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `alta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nombre`, `apellido`, `correo`, `cuil`, `clave`, `rol`, `alta`) VALUES
(1, 'Camilo', 'Sanchez', 'camilo_sanchezcjs29@hotmail.com', '20-44193352-6', '202cb962ac59075b964b07152d234b70', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id_asignacion`);

--
-- Indices de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD PRIMARY KEY (`id_diagnostico`);

--
-- Indices de la tabla `diario_paciente`
--
ALTER TABLE `diario_paciente`
  ADD PRIMARY KEY (`id_diario`);

--
-- Indices de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  ADD PRIMARY KEY (`id_enfermedad`);

--
-- Indices de la tabla `evolucion_paciente`
--
ALTER TABLE `evolucion_paciente`
  ADD PRIMARY KEY (`id_evolucion`);

--
-- Indices de la tabla `historial_citas`
--
ALTER TABLE `historial_citas`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_noti`);

--
-- Indices de la tabla `otros_diagnosticos`
--
ALTER TABLE `otros_diagnosticos`
  ADD PRIMARY KEY (`id_otros`);

--
-- Indices de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  ADD PRIMARY KEY (`id_recomendacion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_noti`
--
ALTER TABLE `tipo_noti`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  MODIFY `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `diario_paciente`
--
ALTER TABLE `diario_paciente`
  MODIFY `id_diario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `evolucion_paciente`
--
ALTER TABLE `evolucion_paciente`
  MODIFY `id_evolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=660;

--
-- AUTO_INCREMENT de la tabla `historial_citas`
--
ALTER TABLE `historial_citas`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_noti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `otros_diagnosticos`
--
ALTER TABLE `otros_diagnosticos`
  MODIFY `id_otros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  MODIFY `id_recomendacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_noti`
--
ALTER TABLE `tipo_noti`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
