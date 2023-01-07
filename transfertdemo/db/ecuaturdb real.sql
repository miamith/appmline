-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2020 a las 14:02:09
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecuaturdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencias`
--

CREATE TABLE `agencias` (
  `idagencia` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `agentcrea` varchar(8) DEFAULT NULL,
  `fecrea` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `agencias`
--

INSERT INTO `agencias` (`idagencia`, `nombre`, `descripcion`, `agentcrea`, `fecrea`) VALUES
(1, 'Semu', 'Agencia sito frente Tamara en Semu', 'ap001531', '2019-09-08 00:00:00'),
(2, 'Bata', 'Agencia de Bata', 'ap001531', '2019-09-08 00:00:00'),
(3, 'Ebibeyin', 'Agencia de Ebibeyin', 'ap001531', '2019-09-08 00:00:00'),
(10, 'TestA', 'TestB', 'ap001531', '2019-10-30 00:22:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billetes`
--

CREATE TABLE `billetes` (
  `idbillete` int(11) NOT NULL,
  `company` varchar(15) DEFAULT NULL,
  `ruta` int(11) DEFAULT NULL,
  `fechaemision` date DEFAULT NULL,
  `fesali` date DEFAULT NULL,
  `fevuel` date DEFAULT NULL,
  `numvuel` varchar(8) DEFAULT NULL,
  `nompasa` varchar(10) DEFAULT NULL COMMENT 'Nombre del pasajero',
  `localiz` varchar(20) DEFAULT NULL COMMENT 'Localizador',
  `precio` int(11) DEFAULT NULL COMMENT 'Prcio del billete',
  `descripcion` varchar(30) DEFAULT NULL COMMENT 'Descripcion del billete',
  `agencia` int(11) NOT NULL,
  `fecrea` datetime DEFAULT NULL,
  `agentcrea` varchar(8) DEFAULT NULL COMMENT 'Agente que ha creado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `billetes`
--

INSERT INTO `billetes` (`idbillete`, `company`, `ruta`, `fechaemision`, `fesali`, `fevuel`, `numvuel`, `nompasa`, `localiz`, `precio`, `descripcion`, `agencia`, `fecrea`, `agentcrea`) VALUES
(3, 'Ceiba', 2, '2019-10-16', '2019-10-16', '2019-10-16', '232', '4444444444', 'W-23', 45000, 'Test 6', 3, '2019-10-16 00:00:00', 'ap001531'),
(8, 'Ceiba', 2, '2019-10-16', '2019-10-16', '2019-10-16', '232', '4444444444', 'W-23', 45000, 'Test 6', 3, '2019-10-16 00:00:00', 'ap001531'),
(9, 'Ceiba', 2, '2019-10-16', '2019-10-16', '2019-10-16', '232', '4444444444', 'W-23', 45000, 'Test 6', 3, '2019-10-16 00:00:00', 'ap001531'),
(10, 'Chronos', 2, '2019-10-16', '2019-10-16', '2019-10-16', '232', '4444444444', 'W-23', 45000, 'Test 6', 3, '2019-10-16 00:00:00', 'ap001531');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bkhis`
--

CREATE TABLE `bkhis` (
  `idbkhis` int(11) NOT NULL,
  `DNIremitenteh` varchar(10) DEFAULT NULL,
  `nomcompletoch` varchar(45) DEFAULT NULL,
  `telch` varchar(14) DEFAULT NULL,
  `direccionch` varchar(45) DEFAULT NULL,
  `agentcreaRh` varchar(8) DEFAULT NULL,
  `idreceptorh` int(11) DEFAULT NULL,
  `DNIreceptorh` varchar(10) DEFAULT NULL,
  `nomcomplerh` varchar(45) DEFAULT NULL,
  `telrh` varchar(14) DEFAULT NULL,
  `direccionrh` varchar(45) DEFAULT NULL,
  `agentcrearetorh` varchar(8) DEFAULT NULL,
  `idtransaccionh` int(11) DEFAULT NULL,
  `ageenviah` int(11) DEFAULT NULL,
  `agerecibeh` int(11) DEFAULT NULL,
  `tipoh` int(11) DEFAULT NULL,
  `montoh` double DEFAULT NULL,
  `comisionh` double DEFAULT NULL,
  `codigoh` varchar(6) DEFAULT NULL,
  `estadoth` varchar(20) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `agentcreh` varchar(8) DEFAULT NULL,
  `agentvalida` varchar(8) NOT NULL,
  `fecrea` datetime DEFAULT NULL,
  `operacion` varchar(40) DEFAULT NULL COMMENT 'Aqui intervienen estados como: Envio normal, Recibo normal, Solicitud Modificacion envio',
  `fechavalidacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bkhis`
--

INSERT INTO `bkhis` (`idbkhis`, `DNIremitenteh`, `nomcompletoch`, `telch`, `direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `telrh`, `direccionrh`, `agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, `fechavalidacion`) VALUES
(12, '4444444444', 'Marcos Bill 22', '222512842', 'San Luis copia nueva', 'ap001531', 6, '1234567800', 'Rafael Edu SEGUNDO', '999999', 'San Luis SEGUNDO ENVIO TEST', 'ap001531', 12, 1, 1, 2, 88000, 28500, 'F8Q9', 'Pendiente', 'Test TERCEROS ENVIO', 'ap001531', 'ap001531', '2019-12-10 09:13:18', 'Solicitud Modificacion envio', '2019-12-16 17:56:15'),
(13, '4444444444', 'Marcos Bill RESTO', '222512842', 'San Luis copia nueva RESTO', 'ap001531', 6, '1234567800', 'Rafael Edu SEGUNDO RESTO', '999999', 'San Luis SEGUNDO ENVIO TEST', 'ap001531', 12, 1, 1, 2, 88000, 28500, 'F8Q9', 'Cancelado', 'Test SEGUNDO ENVIO', 'ap001531', 'ap001531', '2019-12-10 09:13:18', 'Envio normal', '2019-12-16 17:56:15'),
(23, '4444444444', 'Marcos Bill RESTO', '222512842', 'San Luis copia nueva RESTO', 'ap001531', 18, '2918000111', 'Test tete', '7878', 'zzzzzz', 'ap001531', 27, 1, 1, 1, 120000, 28500, '2M8981', 'Cancelado', 'ok ticket', 'ap001531', 'ap001531', '2019-12-19 22:42:39', 'Envio normal', '2019-12-19 22:52:11'),
(24, '4444444444', 'Marcos Bill', '222512842', 'San Luis copia nueva RESTO', 'ap001531', 18, '2918000111', 'Test tete', '7878', 'zzzzzz', 'ap001531', 27, 1, 1, 1, 120000, 28500, '2M8981', 'Recibido', 'solicitud test', 'ap001531', 'ap001531', '2019-12-19 22:49:42', 'Solicitud Modificacion envio', '2019-12-19 22:52:11'),
(25, '1290989821', 'Test test', '21622', 'wwww', 'ap001531', 19, '1234534344', 'Test tete tete', '3232', 'zzzzz', 'ap001531', 28, 1, 3, 1, 200000, 65000, 'HYMWMA', 'Cancelado', 'Test ebibeyin', 'ap001531', 'ap001531', '2019-12-22 18:00:36', 'Envio normal', '2019-12-22 18:04:02'),
(26, '1290989821', 'Test test', '21622', 'test test', 'ap001531', 19, '1234534344', 'Test tete tete', '3232', 'zzzzz', 'ap001531', 28, 1, 3, 1, 200000, 65000, 'HYMWMA', 'Recibido', 'La direccion era erronea', 'ap001531', 'ap001531', '2019-12-22 18:02:06', 'Solicitud Modificacion envio', '2019-12-22 18:04:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `ap` varchar(8) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `DNI` varchar(10) NOT NULL COMMENT 'Codigo del cliente registrado como empleado',
  `cargo` varchar(20) DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `agencia_em` int(11) NOT NULL COMMENT 'Agencia que trabaja',
  `condicion` int(1) DEFAULT NULL COMMENT 'Estados: 1 Activo, 2 Suspendido, 3 Bloqueado',
  `agecrea` varchar(8) DEFAULT NULL COMMENT 'Agente que lo ha creado',
  `fecrea` date DEFAULT NULL COMMENT 'Fecha de creacion',
  `feinicioempleo` date NOT NULL,
  `femod` date DEFAULT NULL COMMENT 'Fecha de la modificacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `ap`, `password`, `DNI`, `cargo`, `salario`, `agencia_em`, `condicion`, `agecrea`, `fecrea`, `feinicioempleo`, `femod`) VALUES
(1, 'ap001531', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1000000001', 'Desarrollador Web', 5000000, 2, 1, 'ap001531', '2020-01-24', '2019-12-13', '2019-12-24'),
(5, 'ap001664', '', '1100110010', 'Intst', 5000000, 1, 0, 'ap001531', '2019-10-24', '2019-12-13', '2019-12-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos_gastos`
--

CREATE TABLE `ingresos_gastos` (
  `iding_gas` int(11) NOT NULL,
  `concepto` varchar(45) NOT NULL,
  `monto` int(11) NOT NULL,
  `sentido` varchar(1) NOT NULL,
  `observacion` varchar(45) NOT NULL,
  `fecrea` date NOT NULL,
  `agecrea` int(11) NOT NULL,
  `agentcrea` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingresos_gastos`
--

INSERT INTO `ingresos_gastos` (`iding_gas`, `concepto`, `monto`, `sentido`, `observacion`, `fecrea`, `agecrea`, `agentcrea`) VALUES
(1, 'Test ', 2000, 'D', 'test', '2020-01-05', 1, ''),
(2, 'Test creditos', 3000, 'C', 'test cred test mod', '2020-01-04', 2, ''),
(3, 'Test 33', 500, 'D', 'test 33', '2020-01-05', 1, ''),
(4, 'Test creditos 444', 500, 'C', 'test cred    4444 hoy union', '2020-01-05', 1, ''),
(5, 'Comisiones de envio 1', 28500, 'C', 'Receptor Test tete', '2020-01-23', 1, 'ap001531');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'escritorio'),
(2, 'envios'),
(3, 'recibos'),
(4, 'billetes'),
(5, 'empleados'),
(6, 'agencias'),
(7, 'consultas'),
(8, 'tasas'),
(9, 'rutas'),
(10, 'solicitudes'),
(11, 'usuarios'),
(12, 'contabilidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_empleado`
--

CREATE TABLE `permiso_empleado` (
  `id_permisoempleado` int(11) NOT NULL,
  `_idpermiso` int(11) NOT NULL,
  `empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso_empleado`
--

INSERT INTO `permiso_empleado` (`id_permisoempleado`, `_idpermiso`, `empleado`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 11, 1),
(4, 10, 1),
(5, 3, 1),
(6, 4, 1),
(7, 5, 1),
(8, 7, 1),
(9, 9, 1),
(10, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptor`
--

CREATE TABLE `receptor` (
  `idreceptor` int(11) NOT NULL,
  `DNIreceptor` varchar(10) DEFAULT NULL,
  `nomcompler` varchar(45) DEFAULT NULL,
  `telr` varchar(14) DEFAULT NULL,
  `direccionr` varchar(45) DEFAULT NULL,
  `agentcrea` varchar(8) DEFAULT NULL COMMENT 'Agente que ha creado al receptor',
  `fecrea` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `receptor`
--

INSERT INTO `receptor` (`idreceptor`, `DNIreceptor`, `nomcompler`, `telr`, `direccionr`, `agentcrea`, `fecrea`) VALUES
(1, '1234567899', 'Rafael Edu ', '11111', 'San Luis SEGUNDO', 'ap001531', '2019-09-09 23:11:14'),
(2, '1199229999', 'Rafael Edu', '333333333', 'CASA BALNCI', 'ap001531', '2019-09-09 23:42:53'),
(3, '2121212121', 'Mariano Ela', '111999000', 'Paraiso Eboloua', 'ap001531', '2019-09-12 22:23:57'),
(18, '2918000111', 'Test tete', '2232323', 'Alcaide test', 'ap001531', '2019-12-19 22:42:39'),
(19, '1234534344', 'Test tete tete', '3232', 'zzzzz', 'ap001531', '2019-12-22 18:00:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitentes`
--

CREATE TABLE `remitentes` (
  `DNIremitente` varchar(10) NOT NULL,
  `nomcompleto` varchar(45) DEFAULT NULL COMMENT 'Nombre completo',
  `tel` varchar(14) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `agentcreaR` varchar(8) DEFAULT NULL,
  `fecreaR` datetime DEFAULT NULL,
  `estado` int(1) DEFAULT NULL COMMENT 'Estado remitente: 1=Activo, 2=Suspendido, 3=Borrado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `remitentes`
--

INSERT INTO `remitentes` (`DNIremitente`, `nomcompleto`, `tel`, `direccion`, `agentcreaR`, `fecreaR`, `estado`) VALUES
('1000000001', 'Administrador del sistema', '222512842', 'Alcaide ME SILE Tas', 'root', '2019-10-17 00:00:00', 1),
('1100110010', 'Marina aaaaaa', '2222222222', 'Tststs', 'ap001531', '2019-10-24 14:29:53', 1),
('1290989821', 'Test test', '21622', 'test test', 'ap001531', '2019-12-22 18:00:36', 1),
('2312412099', 'Bill', '', 'Compra de billete', 'ap001531', '2019-10-16 11:40:19', 1),
('4444444444', 'Marcos Bill', '222512842', 'San Luis copia nueva RESTO', 'ap001531', '2019-09-09 23:11:14', 1),
('4545454545', 'Julian Django', '222444555', 'Alcaide', 'ap001531', '2019-09-12 22:23:57', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `idruta` int(11) NOT NULL,
  `nombreR` varchar(25) DEFAULT NULL,
  `descripcionr` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`idruta`, `nombreR`, `descripcionr`) VALUES
(2, 'MALABO-BATA', 'Vuelos puntuales del dia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idsolicitud` int(11) NOT NULL,
  `transaccion` int(11) NOT NULL,
  `monantes` double DEFAULT NULL COMMENT 'Monto antes de la solicitud',
  `mondespues` double DEFAULT NULL COMMENT 'Monto despues de validar o autorizar',
  `agentcrea` varchar(8) DEFAULT NULL COMMENT 'Agente que ha creado la solicitud',
  `agentmod` varchar(8) DEFAULT NULL COMMENT 'Agente que modifica o valida la solicitud',
  `mensaje` varchar(60) DEFAULT NULL COMMENT 'Mensage de la solicitud',
  `fecrea` datetime DEFAULT NULL COMMENT 'Fecha de creacion de la solicitu',
  `fevalidacion` datetime DEFAULT NULL COMMENT 'Fecha de validacion de la solicitud'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idsolicitud`, `transaccion`, `monantes`, `mondespues`, `agentcrea`, `agentmod`, `mensaje`, `fecrea`, `fevalidacion`) VALUES
(2, 3, 400000, 400000, 'ap001531', 'ap001531', 'Test Validacion validado CAN ENVIO', '2019-09-28 01:28:43', '2019-12-09 15:52:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasas`
--

CREATE TABLE `tasas` (
  `idTasas` int(11) NOT NULL,
  `Descripcion` varchar(20) DEFAULT NULL,
  `Monto1` double DEFAULT NULL,
  `Monto2` double DEFAULT NULL,
  `comisiont` double DEFAULT NULL COMMENT 'Comision Tasas',
  `fecreat` datetime DEFAULT NULL,
  `agencrea` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tasas`
--

INSERT INTO `tasas` (`idTasas`, `Descripcion`, `Monto1`, `Monto2`, `comisiont`, `fecreat`, `agencrea`) VALUES
(1, 'De 1 a 60,000', 1, 60000, 24500, '2019-10-01 00:00:00', 'ap001531'),
(2, 'De 60,001 a 120000', 60001, 120000, 28500, '2019-10-15 00:00:00', 'ap001531'),
(3, 'De 200000 a 500000', 200000, 500000, 65000, '2019-10-15 15:15:10', 'ap001531');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `idtransaccion` int(11) NOT NULL,
  `remitente` varchar(10) NOT NULL,
  `receptor` int(11) NOT NULL,
  `ageenvia` int(11) NOT NULL,
  `agerecibe` int(11) NOT NULL,
  `tipo` int(1) DEFAULT NULL COMMENT 'Tipo de transaccion: 1->Divisas 2-> Paquete',
  `monto` double DEFAULT NULL,
  `comision` double DEFAULT NULL,
  `codigo` varchar(6) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL COMMENT 'La descripcion se usa y se muestra en lista envios cuando es un paquete o un envio con error o alguna observacion',
  `sms_mobil` varchar(30) DEFAULT NULL,
  `estadot` varchar(20) DEFAULT NULL COMMENT 'Estados:Pendiente,Recibido,Cancelado,Revalidar',
  `agentcreat` varchar(8) DEFAULT NULL COMMENT 'Agente que Crea',
  `agenmod` varchar(8) DEFAULT NULL COMMENT 'Agente que modifica',
  `fecrea` datetime DEFAULT NULL COMMENT 'Fecha de creacion',
  `femodif` datetime DEFAULT NULL COMMENT 'Fecha de modificacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`idtransaccion`, `remitente`, `receptor`, `ageenvia`, `agerecibe`, `tipo`, `monto`, `comision`, `codigo`, `descripcion`, `sms_mobil`, `estadot`, `agentcreat`, `agenmod`, `fecrea`, `femodif`) VALUES
(1, '4444444444', 1, 1, 3, 2, 160000, 65000, 'ACZ7', 'Test copia', 'sms_mobile', 'Recibido', 'ap001531', 'ap001531', '2019-10-09 23:11:14', '2019-11-03 22:42:01'),
(3, '4545454545', 3, 1, 2, 1, 400000, 65000, 'AZZ7', 'Realizar copia', 'sms_mobile', 'Cancelado', 'ap001531', 'ap001531', '2019-09-12 22:23:57', '2019-12-09 15:52:57'),
(27, '4444444444', 18, 1, 1, 1, 120000, 28500, '2M8981', 'tete', 'sms_mobile copia', 'Recibido', 'ap001531', 'ap001531', '2019-12-19 22:42:39', '2020-01-23 19:52:09'),
(28, '1290989821', 19, 1, 3, 1, 200000, 65000, 'HYMWMA', 'La direccion era erronea', 'insertar_sms_mobile', 'Recibido', 'ap001531', 'ap001531', '2019-12-22 18:00:36', '2019-12-22 18:04:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agencias`
--
ALTER TABLE `agencias`
  ADD PRIMARY KEY (`idagencia`);

--
-- Indices de la tabla `billetes`
--
ALTER TABLE `billetes`
  ADD PRIMARY KEY (`idbillete`),
  ADD KEY `fk_Billetes_Agencias1_idx` (`agencia`),
  ADD KEY `fk_Billetes_Remitente1_idx` (`nompasa`),
  ADD KEY `fk_Billetes_Rutas1_idx` (`ruta`);

--
-- Indices de la tabla `bkhis`
--
ALTER TABLE `bkhis`
  ADD PRIMARY KEY (`idbkhis`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `fk_Empleados_Cliente_idx` (`DNI`);

--
-- Indices de la tabla `ingresos_gastos`
--
ALTER TABLE `ingresos_gastos`
  ADD PRIMARY KEY (`iding_gas`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `permiso_empleado`
--
ALTER TABLE `permiso_empleado`
  ADD PRIMARY KEY (`id_permisoempleado`),
  ADD KEY `fk_permiso_has_Empleados_permiso1_idx` (`_idpermiso`),
  ADD KEY `fk_permiso_empleado_empleados1_idx` (`empleado`);

--
-- Indices de la tabla `receptor`
--
ALTER TABLE `receptor`
  ADD PRIMARY KEY (`idreceptor`);

--
-- Indices de la tabla `remitentes`
--
ALTER TABLE `remitentes`
  ADD PRIMARY KEY (`DNIremitente`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`idruta`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idsolicitud`),
  ADD KEY `fk_Solicitud_Transaccion1_idx` (`transaccion`);

--
-- Indices de la tabla `tasas`
--
ALTER TABLE `tasas`
  ADD PRIMARY KEY (`idTasas`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`idtransaccion`),
  ADD KEY `fk_Transaccion_Remitente1_idx` (`remitente`),
  ADD KEY `fk_Transaccion_Agencias1_idx` (`ageenvia`),
  ADD KEY `fk_Transaccion_Agencias2_idx` (`agerecibe`),
  ADD KEY `fk_transaccion_receptor1_idx` (`receptor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agencias`
--
ALTER TABLE `agencias`
  MODIFY `idagencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `billetes`
--
ALTER TABLE `billetes`
  MODIFY `idbillete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `bkhis`
--
ALTER TABLE `bkhis`
  MODIFY `idbkhis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ingresos_gastos`
--
ALTER TABLE `ingresos_gastos`
  MODIFY `iding_gas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `permiso_empleado`
--
ALTER TABLE `permiso_empleado`
  MODIFY `id_permisoempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `receptor`
--
ALTER TABLE `receptor`
  MODIFY `idreceptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `idruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idsolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tasas`
--
ALTER TABLE `tasas`
  MODIFY `idTasas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `idtransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `billetes`
--
ALTER TABLE `billetes`
  ADD CONSTRAINT `fk_Billetes_Agencias1` FOREIGN KEY (`agencia`) REFERENCES `agencias` (`idagencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Billetes_Remitente1` FOREIGN KEY (`nompasa`) REFERENCES `remitentes` (`DNIremitente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Billetes_Rutas1` FOREIGN KEY (`ruta`) REFERENCES `rutas` (`idruta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_Empleados_Remitente` FOREIGN KEY (`DNI`) REFERENCES `remitentes` (`DNIremitente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso_empleado`
--
ALTER TABLE `permiso_empleado`
  ADD CONSTRAINT `fk_permiso_empleado_empleados1` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permiso_has_Empleados_permiso1` FOREIGN KEY (`_idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_Solicitud_Transaccion1` FOREIGN KEY (`transaccion`) REFERENCES `transaccion` (`idtransaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_Transaccion_Agencias1` FOREIGN KEY (`ageenvia`) REFERENCES `agencias` (`idagencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Transaccion_Agencias2` FOREIGN KEY (`agerecibe`) REFERENCES `agencias` (`idagencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Transaccion_Remitente1` FOREIGN KEY (`remitente`) REFERENCES `remitentes` (`DNIremitente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaccion_receptor1` FOREIGN KEY (`receptor`) REFERENCES `receptor` (`idreceptor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
