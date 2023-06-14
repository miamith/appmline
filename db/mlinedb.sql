-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2023 a las 15:18:10
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mlinedb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencias`
--

CREATE TABLE `agencias` (
  `idagencia` int(11) NOT NULL,
  `nombre` varchar(55) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `pais` int(11) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `max_cajas` int(11) NOT NULL,
  `ncp` varchar(45) NOT NULL,
  `ncpComisiones` varchar(45) NOT NULL,
  `responsable` varchar(8) NOT NULL,
  `responsableMline` varchar(8) DEFAULT NULL,
  `agentcrea` varchar(8) DEFAULT NULL,
  `fecrea` datetime DEFAULT NULL,
  `agemodif` varchar(8) NOT NULL,
  `femodif` datetime DEFAULT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `agencias`
--

INSERT INTO `agencias` (`idagencia`, `nombre`, `descripcion`, `pais`, `ciudad`, `max_cajas`, `ncp`, `ncpComisiones`, `responsable`, `responsableMline`, `agentcrea`, `fecrea`, `agemodif`, `femodif`, `eliminado`) VALUES
(1, 'Malabo', 'Centro Comercial Doña Salomé', 1, 'Malabo 22', 4, '372100000000101', '999100000000102', 'ap001531', '', 'ap000002', '2020-03-21 09:31:25', 'ap001531', '2023-01-27 04:04:29', 0),
(2, 'Bata', 'Ngolo Bata', 0, '', 0, '', '', '', '', 'ap001531', '2019-09-08 00:00:00', '', NULL, 0),
(3, 'Ebibeyin', 'Kassav Express-Ebibeyin', 0, '', 0, '', '', '', '', 'ap001531', '2019-09-08 00:00:00', '', NULL, 0),
(14, 'Niefang', 'Frente a total Niefang', 1, '', 0, '372000000000201', '', 'ap000002', '', 'ap000002', '2020-03-21 09:40:43', 'ap001531', '2023-01-10 21:33:32', 0),
(15, 'DEVELOPER AGENCIA', 'Agencia de desarrollo web', 1, 'Malabo', 4, '372100000000101', '999100000000102', 'ap001531', '', 'ap001531', '2023-01-15 21:37:15', 'ap001531', '2023-01-26 20:09:05', 0),
(16, 'MUNIONE', 'MUNIONE', 1, 'Malabo', 4, '37211604001', '99911604002', 'ap000007', '', 'ap001531', '2023-01-27 04:03:37', 'ap001531', '2023-01-27 04:03:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `idbanco` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `pais` int(11) NOT NULL,
  `max_agencias` varchar(4) NOT NULL,
  `ncp` varchar(45) NOT NULL,
  `ncpComisiones` varchar(45) NOT NULL,
  `ncpIVA` varchar(45) NOT NULL,
  `responsable` varchar(8) NOT NULL,
  `agentcrea` varchar(8) NOT NULL,
  `fecrea` datetime NOT NULL,
  `agenmodif` varchar(8) DEFAULT NULL,
  `femodif` datetime DEFAULT NULL,
  `eliminado` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`idbanco`, `nombre`, `descripcion`, `pais`, `max_agencias`, `ncp`, `ncpComisiones`, `ncpIVA`, `responsable`, `agentcrea`, `fecrea`, `agenmodif`, `femodif`, `eliminado`) VALUES
(1, 'Banco', 'Banco TEst', 1, '6999', '9994444444401', '9994444444402', '9994444444403', 'ap001010', 'ap001531', '2023-02-01 01:54:25', 'ap001531', '2023-02-01 02:15:20', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancocomercial`
--

CREATE TABLE `bancocomercial` (
  `idbancoc` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `pais` int(11) NOT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `ncp` varchar(45) NOT NULL,
  `responsable` varchar(8) NOT NULL,
  `gerente` varchar(8) NOT NULL,
  `agentcrea` varchar(8) NOT NULL,
  `fecrea` datetime DEFAULT NULL,
  `agemodif` varchar(8) DEFAULT NULL,
  `femodif` datetime DEFAULT NULL,
  `eliminado` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bancocomercial`
--

INSERT INTO `bancocomercial` (`idbancoc`, `nombre`, `pais`, `ciudad`, `ncp`, `responsable`, `gerente`, `agentcrea`, `fecrea`, `agemodif`, `femodif`, `eliminado`) VALUES
(2, 'Tets', 1, 'Malabo', '37222222', 'ap001531', 'ap001531', 'ap001531', '2023-01-15 22:19:39', 'ap001531', '2023-02-07 14:42:16', '1'),
(3, 'Miguel Angel MITUY', 1, 'Malabo', '3721212121201', 'ap001212', 'ap000006', 'ap001531', '2023-02-07 14:43:31', 'ap001531', '2023-02-07 14:43:55', '1'),
(4, 'Miguel Angel MITUY REGINOC', 1, 'Malabo', '3721212121201', 'ap001212', 'ap001531', 'ap001531', '2023-02-07 14:44:23', 'ap001531', '2023-02-07 14:49:29', '0'),
(5, 'Malabo', 1, 'Malabo', '3721212121201', 'ap001212', 'ap001531', 'ap001531', '2023-02-07 15:25:04', 'ap001531', '2023-02-07 16:25:49', '1'),
(6, 'Trtetetet', 1, 'Yyyayayay', '3721212121201', 'ap001212', 'ap001531', 'ap001531', '2023-02-07 15:32:12', 'ap001531', '2023-02-07 16:25:55', '1');

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
(1, 'PEA', 1, '2020-11-24', '2020-11-26', '2020-11-29', '01', '123543', 'ok0h', 700000, 'Solo ida', 1, '2020-11-24 15:25:00', 'ap000002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bkhis`
--

CREATE TABLE `bkhis` (
  `idbkhis` int(11) NOT NULL,
  `referenciah` varchar(20) NOT NULL,
  `DNIremitenteh` varchar(10) DEFAULT NULL,
  `nomcompletoch` varchar(45) DEFAULT NULL,
  `cuentach` varchar(45) DEFAULT NULL,
  `telch` varchar(14) DEFAULT NULL,
  `direccionch` varchar(45) DEFAULT NULL,
  `agentcreaRh` varchar(8) DEFAULT NULL,
  `idreceptorh` int(11) DEFAULT NULL,
  `DNIreceptorh` varchar(10) DEFAULT NULL,
  `nomcomplerh` varchar(45) DEFAULT NULL,
  `cuentarh` varchar(45) DEFAULT NULL,
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
  `codigo_opeh` varchar(4) NOT NULL,
  `sentidoh` varchar(2) NOT NULL,
  `estadoth` varchar(20) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `agentcreh` varchar(8) DEFAULT NULL,
  `agentvalida` varchar(8) DEFAULT NULL,
  `fecrea` datetime DEFAULT NULL,
  `operacion` varchar(40) DEFAULT NULL COMMENT 'Aqui intervienen estados como: Envio normal, Recibo normal, Solicitud Modificacion envio',
  `fechavalidacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bkhis`
--

INSERT INTO `bkhis` (`idbkhis`, `referenciah`, `DNIremitenteh`, `nomcompletoch`, `cuentach`, `telch`, `direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `cuentarh`, `telrh`, `direccionrh`, `agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, `codigo_opeh`, `sentidoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, `fechavalidacion`) VALUES
(3, '', '000000', 'carmelo nsamio', '', '555470025', 'Malabo', 'ap000003', 2, '000001', 'bile', '', '222596311', 'bata', 'ap000003', 6, 1, 2, 1, 150000, 6000, 'ZVTMOD', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-03-30 17:02:03', 'Envio normal', NULL),
(4, '', '000002', 'Ruben nguema ondo', '', '222313871', 'Malabo', 'ap000002', 7, '000004', 'Montserrat Nzang ava', '', '222626828', 'Niefang', 'ap000002', 7, 1, 14, 1, 25000, 3000, 'EWG8S3', '', '', 'Pendiente', 'Ayuda familiar', 'ap000002', NULL, '2020-03-31 12:04:05', 'Envio normal', NULL),
(5, '', '077607', 'carmelo nsamiyo', '', '222597211', 'malabo', 'ap000004', 8, '1102', 'florentina bilehe', '', '0-', 'bata', 'ap000004', 8, 1, 2, 1, 100000, 3000, '3NP8LR', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-03-31 16:34:21', 'Envio normal', NULL),
(6, '', '567843', 'Carmelo Nsamio Esono', '', '222597211', 'malabo', 'ap000003', 9, '0', 'Laurencia Nguema Nchama', '', '555562971', 'bata', 'ap000003', 9, 1, 2, 1, 50000, 3000, '4MB4NZ', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-01 10:50:47', 'Envio normal', NULL),
(7, '', '23456', 'Carmelo Nzamio', '', '222597211', 'malabo', 'ap000003', 10, '5', 'Nemesio Esono', '', '222788339', 'niefang', 'ap000003', 10, 1, 14, 1, 170000, 6000, 'S3V16K', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-01 11:00:41', 'Envio normal', NULL),
(8, '', '367896', 'Carlos Micha Mba', '', '555004408', 'fiston', 'ap000003', 11, '00567', 'Samuel Ondo Nkara', '', '222726578', 'bata', 'ap000003', 11, 1, 2, 1, 150000, 6000, 'ALZQSG', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-01 12:07:57', 'Envio normal', NULL),
(9, '', '1431461', 'Marina Mangue Mba', '', '222115358', 'Buena Esperanza', 'ap000003', 12, '0983', 'Pera Nsuga Nzeng Bindang', '', '555598882', 'bata', 'ap000003', 12, 1, 2, 1, 95000, 3000, 'EMOBRQ', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-02 08:34:03', 'Envio normal', NULL),
(10, '', '000000', 'Carmelo Nsamio', '', '222597211', 'Malabo', 'ap000003', 13, '98765', 'Laurencia Nguema Nchama', '', '555962971', 'bata', 'ap000003', 13, 1, 2, 1, 500000, 15000, '79V7SM', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-02 08:47:41', 'Envio normal', NULL),
(11, '', '000000', 'Carmelo Nsamio', '', '222597211', 'Malabo', 'ap000003', 2, '000001', 'Nemesio Esono', '', '222788339', 'niefang', 'ap000003', 14, 1, 14, 1, 200000, 6000, 'ZTDYEQ', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-02 08:54:27', 'Envio normal', NULL),
(12, '', '0987', 'Pedro Juan Nze', '', '222021006', 'Malabo', 'ap000003', 14, '90', 'Juan Ondo Enguema', '', '222290430', 'bata', 'ap000003', 15, 1, 2, 1, 85000, 3000, 'GAWDB8', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-02 09:09:08', 'Envio normal', NULL),
(13, '', '84.229', 'Maria Soledad ANDEME NDONG', '', '222514846', 'BATA', 'ap000005', 15, 'X', 'Agustin Nve ASUMU NCHAMA', '', '222788013', 'MALABO', 'ap000005', 16, 2, 1, 1, 10, 3000, 'WY6D9Q', '', '', 'Recibido', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-04-02 12:22:04', 'Envio normal', NULL),
(14, '', '000.116.04', 'Lucas EDANG EDJANG', '', '222 287909', 'Ebibeyin', 'ap000007', 16, '000.117.02', 'AMBROSIO ESONO ANGUE', '', '222277872', 'Bata', 'ap000007', 17, 3, 2, 1, 70, 3000, 'TV398V', '', '', 'Recibido', 'Tes', 'ap000007', NULL, '2020-04-03 11:59:44', 'Envio normal', NULL),
(15, '', '1424715', 'magdalena mofuman', '', '222203180', 'Malabo', 'ap000004', 17, '01', 'francisca medja angono', '', '222630072', 'bata', 'ap000004', 18, 1, 2, 1, 130000, 6000, '3WHCFW', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-04-03 13:45:56', 'Envio normal', NULL),
(16, '', '02', 'exsuperacia nchama ondo', '', '222552321', 'semu', 'ap000004', 18, '3', 'justina andeme ngua', '', '222198658', 'bata', 'ap000004', 19, 1, 2, 1, 50000, 3000, 'G2MQEZ', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-04-03 14:51:25', 'Envio normal', NULL),
(17, '', '1.700.425', 'tomas nsue', '', '222276833', 'bata', 'ap000005', 19, 'x', 'jefte micha nsue', '', '555 453253', 'malabo', 'ap000005', 20, 2, 1, 1, 42, 3000, 'PLEDEG', '', '', 'Recibido', 'ayuda familiar', 'ap000005', NULL, '2020-04-04 10:21:17', 'Envio normal', NULL),
(18, '', 'x', 'Esperanza Nguema namikien', '', '222 522883', 'Bata', 'ap000005', 20, 'x', 'Antonio Saul Ndong', '', '222 190152', 'malabo', 'ap000005', 21, 2, 1, 1, 15, 3000, '0CFHQS', '', '', 'Recibido', 'ayuda familiar', 'ap000005', NULL, '2020-04-04 10:32:16', 'Envio normal', NULL),
(19, '', '76978', 'trifonia nsue', '', '00240222658263', 'Bata', 'ap000005', 16, '000.117.02', 'ambrosio esono angue', '', '222277872', 'Bata', 'ap000005', 22, 2, 1, 1, 50000, 3000, '0JL6QT', '', '', 'Recibido', 'test', 'ap000005', NULL, '2020-04-04 13:09:47', 'Envio normal', NULL),
(20, '', '028838', 'Bernardino Ndong MBA', '', '222273351', 'BATA', 'ap000005', 21, 'X', 'CELESTINO ENAMA ASUMU', '', '555622283', 'EBIBEYN', 'ap000005', 23, 2, 3, 1, 30000, 3000, 'CYZL30', '', '', 'Recibido', '', 'ap000005', NULL, '2020-04-06 15:36:03', 'Envio normal', NULL),
(21, '', '0987', 'Justo Asama', '', '222625531', 'Malabo', 'ap000003', 22, '76587', 'Mercedes Biang Bika', '', '222785673', 'bata', 'ap000003', 24, 1, 2, 1, 45000, 3000, 'MB5C0O', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 08:01:21', 'Envio normal', NULL),
(22, '', '09876', 'Miguel Edjang Angue', '', '222777446', 'Malabo', 'ap000003', 23, '097654', 'Trifonia Nsue', '', '222658263', 'bata', 'ap000003', 25, 1, 2, 1, 270000, 9000, 'C5VLK7', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 08:04:02', 'Envio normal', NULL),
(23, '', '56432', 'Baltasar Odjama Oyono', '', '222670904', 'Malabo', 'ap000003', 24, '5432', 'Antonio Ndong Esono', '', '222214001', 'niefang', 'ap000003', 26, 1, 14, 1, 385000, 12000, 'CPZ9J3', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 08:05:41', 'Envio normal', NULL),
(24, '', '547654', 'Miguel Edjang Angue', '', '222277446', 'Malabo', 'ap000003', 25, '324', 'Santiago Bee', '', '222589787', 'niefang', 'ap000003', 27, 1, 14, 1, 240000, 9000, 'D26GRI', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 08:08:18', 'Envio normal', NULL),
(25, '', '88287', 'Agustin Nve Asumu', '', '222788013', 'Malabo', 'ap000003', 26, '653', 'Maria Soledad Andeme', '', '222514846', 'bata', 'ap000003', 28, 1, 2, 1, 30000, 3000, 'OZ0DMV', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 08:28:19', 'Envio normal', NULL),
(26, '', '6573', 'Berta Bacale Bikie', '', '222500273', 'Malabo', 'ap000003', 27, '98563', 'Esperanza Oyen', '', '222152308', 'niefang', 'ap000003', 29, 1, 14, 1, 50000, 3000, 'TF03RQ', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 09:16:45', 'Envio normal', NULL),
(27, '', '6543', 'Pilar Mongomo Medico', '', '222388961', 'Malabo', 'ap000003', 28, '98764', 'Ana Maria Medico Borge', '', '222679027', 'bata', 'ap000003', 30, 1, 2, 1, 40000, 3000, 'NMJMNS', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 10:00:41', 'Envio normal', NULL),
(28, '', '345', 'Fonkeng Henry', '', '222651536', 'Malabo', 'ap000003', 2, '000001', 'Ebesoh Dorine', '', '222788339', 'bata', 'ap000003', 31, 1, 2, 1, 1220000, 30000, 'PYHI50', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-07 10:41:31', 'Envio normal', NULL),
(29, '', '000.206.80', 'maxsimiliano eyene okiri', '', '222326852', 'timbabe', 'ap000004', 30, '1', 'serafina abogo okiri', '', '222114179', 'niefang', 'ap000004', 32, 1, 14, 1, 25000, 3000, 'I2JSOM', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-04-07 12:53:13', 'Envio normal', NULL),
(30, '', '93', 'justo tomo ovono', '', '222232199', 'bayares', 'ap000004', 31, '111', 'soledad andeme ndong', '', '222514846', 'bata', 'ap000004', 33, 1, 2, 1, 50000, 3000, '9A2ESL', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-04-07 14:07:24', 'Envio normal', NULL),
(31, '', '23456', 'Carmelo Nzamio', '', '222597211', 'malabo', 'ap000003', 32, '000078', 'Cresensia Andong Esono', '', '222106916', 'bata', 'ap000003', 34, 1, 2, 1, 100000, 3000, '1LPK0S', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-08 07:26:06', 'Envio normal', NULL),
(32, '', '110114', 'salvador bolabota', '', '222789095', 'bantu', 'ap000004', 33, '01', 'wamba ngoumegnon wamba', '', '222203231', 'ebibeyin', 'ap000004', 35, 1, 3, 1, 90000, 3000, 'SF9DM6', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-04-09 13:40:58', 'Envio normal', NULL),
(33, '', 'X', 'JUAQUINA OKOMO NDONG', '', '222511714', 'BATA', 'ap000005', 34, 'X', 'MARIA CARMEN NDONG', '', '222004889', 'malabo', 'ap000005', 36, 2, 1, 1, 30000, 3000, 'EVVZGD', '', '', 'Recibido', 'ayuda familiar', 'ap000005', NULL, '2020-04-11 10:35:18', 'Envio normal', NULL),
(34, '', '000000', 'Carmelo Nzamio', '', '222597211', 'Malabo', 'ap000003', 9, '0', 'Cresensia Andong Esono', '', '555562971', 'bata', 'ap000003', 37, 1, 2, 1, 200000, 6000, '77B1VF', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-13 09:40:14', 'Envio normal', NULL),
(35, '', '000000', 'Carmelo Nzamio', '', '222597211', 'Malabo', 'ap000003', 35, '56754', 'Santiago Nguema Nchama', '', '22288365', 'bata', 'ap000003', 38, 1, 2, 1, 250000, 9000, 'APVZZ3', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-13 11:33:06', 'Envio normal', NULL),
(36, '', '000000', 'Carmelo Nzamio', '', '222597211', 'Malabo', 'ap000003', 37, '35663', 'Andres Miko Nseng', '', '222269889', 'bata', 'ap000003', 39, 1, 2, 1, 100000, 3000, '74N3B6', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-13 11:36:31', 'Envio normal', NULL),
(37, '', '000.116.04', 'Carmelo Nzamio', '', '222 287909', 'Ebibeyin', 'ap000003', 38, '1345', 'Pedro Manuel Nguema Ondo', '', '222536484', 'niefang', 'ap000003', 40, 1, 14, 1, 100000, 3000, '82VVPD', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-04-13 11:42:31', 'Envio normal', NULL),
(38, '', '0000058.01', 'jesus ndong mba', '', '222253154', 'Malabo', 'ap000004', 39, '4', 'esperasa oyeng', '', '222617984', 'niefang', 'ap000004', 41, 1, 14, 1, 40000, 3000, '503K66', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-04-13 14:07:31', 'Envio normal', NULL),
(39, '', 'X', 'Maria Antonia Mabale', '', '222511956', 'BATA', 'ap000005', 40, 'x', 'SANTIAGO MABALE', '', 'X', 'NIEFANG', 'ap000005', 42, 2, 14, 1, 50000, 3000, 'C1LTM8', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-04-14 14:40:45', 'Envio normal', NULL),
(40, '', '077607', 'carmelo nsamiyo', '', '222597211', 'malabo', 'ap000004', 41, '4', 'lucia nkenene esono', '', '222129640', 'niefang', 'ap000004', 43, 1, 14, 1, 200000, 6000, 'Q0HQSR', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-04-14 15:03:44', 'Envio normal', NULL),
(41, '', '077607', 'carmelo nsamiyo', '', '222597211', 'malabo', 'ap000004', 42, '05', 'catalina oyana obama', '', '222598147', 'niefang', 'ap000004', 44, 1, 2, 1, 80000, 3000, 'SEEZQV', '', '', 'Pendiente', 'ayuda famillar', 'ap000004', NULL, '2020-04-14 15:09:10', 'Envio normal', NULL),
(42, '', '00', 'medino plasido esono obiang', '', '222115647', 'fiston', 'ap000004', 43, '03', 'maria teresa eyenga afang', '', '222226662', 'niefang', 'ap000004', 45, 1, 14, 1, 40000, 3000, '80Z6T6', '', '', 'Pendiente', 'ayuda famillar', 'ap000004', NULL, '2020-04-14 15:16:18', 'Envio normal', NULL),
(43, '', '00', 'medino plasido esono obiang', '', '222115647', 'fiston', 'ap000004', 43, '03', 'maria teresa eyenga afang', '', '222226662', 'niefang', 'ap000004', 45, 1, 14, 1, 40000, 3000, '80Z6T6', '', '', 'Revalidar', 'ayuda famillar', 'ap000004', NULL, '2020-04-14 15:16:59', 'Solicitud Modificacion envio', NULL),
(44, '', '077607', 'carmelo nsamiyo', '', '222597211', 'malabo', 'ap000004', 42, '05', 'catalina oyana obama', '', '222598147', 'niefang', 'ap000004', 44, 1, 14, 1, 80000, 3000, 'SEEZQV', '', '', 'Revalidar', 'ayuda famillar', 'ap000004', NULL, '2020-04-14 15:25:44', 'Solicitud Modificacion envio', NULL),
(45, '', 'A', 'A', '', 'A', 'A', 'ap000006', 44, '54', 'A', '', 'A', 'A', 'ap000006', 46, 14, 1, 1, 1, 3000, 'CTCEE9', '', '', 'Recibido', '', 'ap000006', NULL, '2020-04-15 21:57:38', 'Envio normal', NULL),
(46, '', '985677', 'TANGUI OWONO', '', '222256248', 'Malabo', 'ap000003', 45, '099', 'Matias MONSUY', '', '222545427', 'bata', 'ap000003', 47, 1, 2, 1, 40000, 3000, 'GIOL13', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-05-04 11:43:03', 'Envio normal', NULL),
(47, '', '03', 'basilio moro mba', '', '222088886', 'buena esperansa', 'ap000004', 46, '5', 'encarnasion mangue mba', '', '222101501', 'bata', 'ap000004', 48, 1, 2, 1, 50000, 3000, 'LAWSMS', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-05-05 13:15:27', 'Envio normal', NULL),
(48, '', '000002', 'Ruben nguema ondo', '', '222313871', 'Malabo', 'ap000004', 7, '000004', 'Montserrat Nzang ava', '', '222626828', 'Niefang', 'ap000004', 7, 1, 14, 1, 25000, 3000, 'EWG8S3', '', '', 'Revalidar', 'Ayuda familiar', 'ap000004', NULL, '2020-05-05 13:30:37', 'Solicitud Modificacion envio', NULL),
(49, '', '1.700.425', 'tomas nsue', '', '222276833', 'bata', 'ap000005', 19, 'x', 'jefte micha nsue', '', '555 453253', 'malabo', 'ap000005', 49, 2, 1, 1, 20000, 3000, 'C28K9H', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-05-05 14:19:23', 'Envio normal', NULL),
(50, '', '0023456', 'Juan Demostenes Asumu', '', '222173672', 'Malabo', 'ap000003', 47, '0004567', 'Jose Luis Edjang Mba Mia', '', '555487635', 'bata', 'ap000003', 50, 1, 2, 1, 30000, 3000, 'VSLQKL', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-05-07 08:19:41', 'Envio normal', NULL),
(51, '', 'X', 'Esperanza Obiang Miaga', '', '222', 'bata', 'ap000005', 48, 'x', 'Imelda Oyono Obiang', '', '222', 'malabo', 'ap000005', 51, 2, 1, 1, 75000, 3000, 'Q3C6KS', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-05-07 08:26:39', 'Envio normal', NULL),
(52, '', 'X', 'Raul EYI NGUEMA', '', '222 288 300', 'BATA', 'ap000005', 49, 'x', 'Tangui OWONO NGUEMA', '', '222 256 248', 'malabo', 'ap000005', 52, 2, 1, 1, 35000, 3000, 'P9KPQ4', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-05-12 10:14:34', 'Envio normal', NULL),
(53, '', 'X', 'SATURNINA NCHAMA NSUE', '', '222023312', 'bata', 'ap000005', 50, 'x', 'AVELINA MANGUE NGUI', '', '222782735', 'malabo', 'ap000005', 53, 2, 1, 1, 65000, 3000, 'V6SE41', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-05-12 11:21:37', 'Envio normal', NULL),
(54, '', '9800042', 'Raul EYI NGUEMA', '', '222288500', 'bata', 'ap000005', 51, '000000', 'AVELINA MANGUE NGUI', '', '222782735', 'malabo', 'ap000005', 54, 2, 1, 1, 35000, 3000, 'OOLQI4', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-05-12 14:20:14', 'Envio normal', NULL),
(55, '', '1114110', 'Celestino OKUE MENENE', '', '222357080', 'ebibeyin', 'ap000007', 52, '0000', 'Trinidad AYANG', '', '222327814', 'bata', 'ap000007', 55, 3, 2, 1, 12000, 3000, 'ZMTSKO', '', '', 'Recibido', 'ayuda familiar', 'ap000007', NULL, '2020-05-14 09:59:27', 'Envio normal', NULL),
(56, '', 'X', 'Ignacio NSI NGUEMA', '', '55 516213', 'BATA', 'ap000005', 53, 'x', 'Sinforosa MIYONO AYANG', '', '555 593578', 'malabo', 'ap000005', 56, 2, 1, 1, 30000, 3000, 'HJTPTM', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-05-21 11:26:29', 'Envio normal', NULL),
(57, '', '017920', 'test', '', '028690', 'malabo', 'ap000005', 54, '0597', 'test1', '', '037950', 'niefang', 'ap000005', 57, 2, 1, 1, 20000, 3000, 'GYBSWI', '', '', 'Recibido', 'ayuda familiar', 'ap000005', NULL, '2020-06-01 10:06:43', 'Envio normal', NULL),
(58, '', '00', 'JUAQUINA OKOMO NDONG', '', '222511714', 'bata', 'ap000005', 55, 'x', 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '', '222004889', 'malabo', 'ap000005', 58, 2, 1, 1, 70000, 3000, 'FMQPQN', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-06-01 10:15:00', 'Envio normal', NULL),
(59, '', '04', 'celestina nkomo', '', '2222', 'Malabo', 'ap000004', 57, '06', 'delfin nsue', '', '222272646', 'bata', 'ap000004', 59, 1, 2, 1, 67000, 3000, '397MZ6', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-06-06 12:57:00', 'Envio normal', NULL),
(60, '', '000.116.63', 'exsuperacia nchama ondo', '', '222552321', 'Malabo', 'ap000004', 58, '5', 'justina andeme ngua', '', '222198658', 'bata', 'ap000004', 60, 1, 2, 1, 40000, 3000, 'SVVGVG', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-06-08 12:43:48', 'Envio normal', NULL),
(61, '', '000', 'LUIS MANGUE ONDJIGUI', '', '222405758', 'bata', 'ap000005', 59, '00', 'JESUS ONDJIGUI', '', '222381360', 'NIEFANG', 'ap000005', 61, 2, 1, 1, 25000, 3000, 'PLS3WE', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-06-08 13:45:23', 'Envio normal', NULL),
(62, '', 'XX', 'JUAQUINA OKOMO NDONG', '', '222511714', 'bata', 'ap000005', 60, '00', 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '', '222004889', 'malabo', 'ap000005', 62, 2, 1, 1, 100000, 3000, 'NSW25E', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-06-09 08:46:45', 'Envio normal', NULL),
(63, '', '000', 'LUIS MANGUE ONDJIGUI', '', '222405758', 'bata', 'ap000005', 59, '00', 'JESUS ONDJIGUI', '', '222381360', 'NIEFANG', 'ap000005', 63, 2, 1, 1, 25000, 3000, 'FV76CZ', '', '', 'Recibido', '', 'ap000005', NULL, '2020-06-09 09:01:09', 'Envio normal', NULL),
(64, '', '00987', 'PETRA MUANABANG', '', '222252646', 'semu', 'ap000003', 61, '00765', 'Trifonia Nsue', '', '222658263', 'bata', 'ap000003', 64, 1, 2, 1, 30000, 3000, 'MOTQLM', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-06-09 10:13:02', 'Envio normal', NULL),
(65, '', '09547', 'Francisco Engonga Nze', '', '222136646', 'Malabo', 'ap000003', 62, '93456', 'Elisa Masanga Nsue Angono', '', '555474808', 'bata', 'ap000003', 65, 1, 2, 1, 40000, 3000, 'ORL997', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-06-12 08:59:41', 'Envio normal', NULL),
(66, '', '84564', 'Victoria Eyang Ndong Oyana', '', '222205366', 'Malabo', 'ap000003', 63, '7345', 'Regina Meba Nsie', '', '222522883', 'bata', 'ap000003', 66, 1, 2, 1, 40000, 3000, 'JGSYFL', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-06-12 09:12:03', 'Envio normal', NULL),
(67, '', '000', 'FELIPE ONDO EVESOGO', '', '222257257', 'BATA', 'ap000005', 64, 'XXX', 'PASCUAL OSA NGUEMA', '', '555750697', 'MALABO', 'ap000005', 67, 2, 1, 1, 20000, 3000, '3E4Q5M', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-06-12 09:30:06', 'Envio normal', NULL),
(68, '', '00000', 'JUAN NGUERE EKOMO', '', '222250319', 'BATA', 'ap000005', 65, 'X', 'EMILIA MIFUMU NGUNDI', '', '222044565', 'MALABO', 'ap000005', 68, 2, 1, 1, 20000, 3000, 'EH8SD4', '', '', 'Recibido', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-06-12 13:21:34', 'Envio normal', NULL),
(69, '', '90876', 'Medino Placido Nseng', '', '222115647', 'Malabo', 'ap000003', 66, '64325', 'Maria Teresa Eyang', '', '222226662', 'niefang', 'ap000003', 69, 1, 14, 1, 150000, 6000, 'RQIVOT', '', '', 'Pendiente', 'ayuda famillar', 'ap000003', NULL, '2020-06-15 08:06:10', 'Envio normal', NULL),
(70, '', '23416', 'Paco Biyogo Obama', '', '222716879', 'Malabo', 'ap000003', 67, '62345', 'Leona Ayecaba Andeme Esono', '', '222604885', 'bata', 'ap000003', 70, 1, 2, 1, 60000, 3000, 'WIYP6W', '', '', 'Recibido', 'ayuda familla', 'ap000003', NULL, '2020-06-16 08:44:16', 'Envio normal', NULL),
(71, '', '000', 'JUAQUINA OKOMO NDONG', '', '222511714', 'bata', 'ap000005', 68, 'xxxxx', 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '', '222004889', 'malabo', 'ap000005', 71, 2, 1, 1, 70000, 3000, 'MMOM7Q', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-06-16 12:44:48', 'Envio normal', NULL),
(72, '', 'xx', 'JUAQUINA OKOMO NDONG', '', '222511714', 'bata', 'ap000005', 69, '00', 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '', '222004889', 'malabo', 'ap000005', 72, 2, 1, 1, 70000, 3000, '29LEEZ', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-06-16 12:50:45', 'Envio normal', NULL),
(73, '', '9800042', 'Raul EYI NGUEMA', '', '222288500', 'bata', 'ap000005', 70, 'x', 'Tangui OWONO NGUEMA', '', '222004889', 'malabo', 'ap000005', 73, 2, 1, 1, 30000, 3000, 'OV2QLQ', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-06-18 15:01:05', 'Envio normal', NULL),
(74, '', 'XXX', 'DAVID RIPEU BOTEPU', '', '222257530', 'BATA', 'ap000005', 71, '0000', 'ANASTACIA SUAMA NZIE', '', '222206171', 'MALABO', 'ap000005', 74, 2, 1, 1, 100000, 3000, '5S58LB', '', '', 'Recibido', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-06-24 08:54:48', 'Envio normal', NULL),
(75, '', '114060', 'HERIERTO MEKO MBA OSIE', '', '222798886', 'EBIBEYIN', 'ap000007', 72, '000000', 'CRISANTOS NGUEMA ASEMA', '', '555782530', 'NIEFANG', 'ap000007', 75, 3, 14, 1, 70, 3000, 'Z9RQ08', '', '', 'Pendiente', 'NIEFANG', 'ap000007', NULL, '2020-07-08 09:50:51', 'Envio normal', NULL),
(76, '', 'xxx', 'milagrosa obono asumu', '', '222736829', 'bata', 'ap000005', 34, 'X', 'maria carmen ondo', '', '222696500', 'Niefang', 'ap000005', 0, 2, 1, 1, 60000, 3000, '', '', '', 'Revalidar', 'ayuda famillar', 'ap000005', NULL, '2020-07-09 09:31:51', 'Solicitud Modificacion envio', NULL),
(77, '', 'XXX', 'MILAGROSA OBONO ASUMU', '', '222736829', 'bata', 'ap000005', 73, '0000', 'MARIA CARMEN NGUIE ONDO', '', '222696500', 'NIEFANG', 'ap000005', 76, 2, 1, 1, 60000, 3000, '152QTC', '', '', 'Recibido', 'ayuda famillar', 'ap000005', NULL, '2020-07-09 09:41:26', 'Envio normal', NULL),
(78, '', '002309979', 'AMELIA CARMEN NZANG EFUMAN', '', '222122927', 'BATA', 'ap000005', 74, '0000', 'RUBEN DARIO NZI EFUMAN', '', '222769092', 'MALABO', 'ap000005', 77, 2, 1, 1, 15000, 3000, 'VJMQV0', '', '', 'Recibido', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-07-09 10:17:39', 'Envio normal', NULL),
(79, '', '10071027', 'cipriano nsue misihi', '', '551801937', 'Malabo', 'ap000004', 75, '5', 'Trifonia Nsue', '', '222658263', 'bata', 'ap000004', 78, 1, 2, 1, 20000, 3000, '3V7MPJ', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-07-09 15:51:14', 'Envio normal', NULL),
(80, '', '09080706', 'Secundino mico', '', '222232323', 'Nkimi', 'ap000008', 76, '06080907', 'Santiago edjang', '', '555555553', 'Malabo', 'ap000008', 79, 14, 3, 1, 300000, 9000, '32SDLG', '', '', 'Recibido', 'Ayuda financiera', 'ap000008', NULL, '2020-07-12 10:42:24', 'Envio normal', NULL),
(81, '', '00317140', 'Juan Bautista edjang', '', '222093467', 'Nkimi', 'ap000011', 77, '00123812', 'Margarita angue Nguema aseme', '', '2222685671', 'Malabo', 'ap000011', 80, 14, 1, 1, 50000, 3000, '7LQRKS', '', '', 'Recibido', '', 'ap000011', NULL, '2020-07-12 12:05:05', 'Envio normal', NULL),
(82, '', '88287', 'Agustin', '', '222788013', 'Malabo', 'ap000003', 78, '8655', 'Maria Soledad Andeme', '', '222514842', 'bata', 'ap000003', 81, 1, 2, 1, 60000, 3000, 'AZZQO0', '', '', 'Recibido', 'ayuda famillar', 'ap000003', NULL, '2020-07-13 08:52:32', 'Envio normal', NULL),
(83, '', '00', 'Carmelo Nzamio', '', '222597211', 'Malabo', 'ap000004', 79, '010', 'antonio asila', '', '222371902', 'bata', 'ap000004', 82, 1, 2, 1, 100000, 3000, 'SPNHR2', '', '', 'Recibido', 'ayuda familla', 'ap000004', NULL, '2020-07-13 15:50:33', 'Envio normal', NULL),
(84, '', '000134095', 'Juan Pedro NDONG', '', '222533600', 'EBIEBYIN', 'ap000007', 80, '00000000', 'Francisco NSUE ABESO', '', '222212477', 'NIEFANG', 'ap000007', 83, 3, 14, 1, 15000, 3000, 'CQQ644', '', '', 'Pendiente', 'AYUDA FAMILLAR', 'ap000007', NULL, '2020-07-14 11:37:52', 'Envio normal', NULL),
(85, '', '001423872', 'venansio paco biyogo', '', '222716879', 'sipopo malabo', 'ap000004', 67, '62345', 'leona ayecaba andeme esono', '', '222604885', 'bata', 'ap000004', 0, 1, 2, 1, 50000, 2000, '', '', '', 'Revalidar', 'ayuda famillar', 'ap000004', NULL, '2020-07-15 12:42:09', 'Solicitud Modificacion envio', NULL),
(86, '', '0014238', 'venansio paco biyogo', '', '222716879', 'Malabo', 'ap000004', 67, '62345', 'leona ayecaba andeme esono', '', '222604885', 'bata', 'ap000004', 0, 1, 2, 1, 50000, 2000, '', '', '', 'Revalidar', 'ayuda famillar', 'ap000004', NULL, '2020-07-15 12:45:03', 'Solicitud Modificacion envio', NULL),
(87, '', '0014238', 'venansio paco biyogo obama', '', '222716879', 'sipopo malabo', 'ap000004', 67, '62345', 'leona ayecaba andeme esono', '', '222604885', 'bata', 'ap000004', 0, 1, 2, 1, 50000, 2000, '', '', '', 'Revalidar', 'ayuda famillar', 'ap000004', NULL, '2020-07-15 12:54:15', 'Solicitud Modificacion envio', NULL),
(88, '', '0014238', 'paco biyo obama', '', '222716879', 'Malabo', 'ap000004', 67, '62345', 'leona ayecaba andeme esono', '', '222604885', 'bata', 'ap000004', 0, 1, 2, 1, 50000, 2000, '', '', '', 'Revalidar', 'ayuda famillar', 'ap000004', NULL, '2020-07-15 12:57:46', 'Solicitud Modificacion envio', NULL),
(89, '', '0014238', 'venasio paco bigogo obama', '', '222716879', 'Malabo', 'ap000004', 81, '0', 'leona ayecaba andeme esono', '', '22626486', 'bata', 'ap000004', 84, 1, 2, 1, 50000, 2000, '00J2GZ', '', '', 'Recibido', 'ayuda famillar', 'ap000004', NULL, '2020-07-15 13:40:29', 'Envio normal', NULL),
(90, '', '102938', 'Saturnino owono owono', '', '222220964', 'Malabo', 'ap000002', 82, '284756', 'Miguel Nfa Nsi', '', '222683132', 'Nkimi', 'ap000002', 85, 1, 14, 1, 33000, 2000, '8VYVNH', '', '', 'Pendiente', 'Ayuda familiar', 'ap000002', NULL, '2020-07-27 11:47:03', 'Envio normal', NULL),
(91, '', '89763', 'venancio paco biyogo', '', '222716979', 'malabo', 'ap000003', 83, '98643', 'isabel ayi  nguema', '', '222786261', 'bata', 'ap000003', 86, 1, 2, 1, 15000, 2000, '9SL3TP', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-07-30 08:44:48', 'Envio normal', NULL),
(92, '', '100040', 'ismael SIMA ENGURU', '', '222409238', 'EBIBEYN', 'ap000007', 84, '10000', 'TOMASA ABESO ABAGA', '', '222208139', 'BATA', 'ap000007', 87, 3, 1, 1, 152000, 3500, 'P4QEZG', '', '', 'Pendiente', 'AYUDA FAMILLIA', 'ap000007', NULL, '2020-08-05 12:14:18', 'Envio normal', NULL),
(93, '', '100040', 'ismael SIMA ENGURU', '', '222409238', 'EBIBEYN', 'ap000007', 84, '10000', 'TOMASA ABESO ABAGA', '', '222208139', 'BATA', 'ap000007', 87, 3, 1, 1, 152000, 3500, 'P4QEZG', '', '', 'Revalidar', 'AYUDA FAMILLIA', 'ap000007', NULL, '2020-08-05 12:35:23', 'Solicitud Modificacion envio', NULL),
(94, '', '114060', 'ismael SIMA ENGURU', '', '222409238', 'EBIBEYN', 'ap000007', 85, '10', 'TOMASA ABESO ABAGA', '', '222208139', 'BATA', 'ap000007', 88, 3, 2, 1, 152000, 3500, 'KW65L6', '', '', 'Recibido', 'AYUDA FAMILLIA', 'ap000007', NULL, '2020-08-05 13:44:56', 'Envio normal', NULL),
(95, '', '1111601', 'josefa avoro ondo', '', '00240222045327', 'Empleada', 'ap000004', 86, '98643', 'anastasia asama nefuman', '', '222207485', 'bata', 'ap000004', 89, 1, 2, 1, 120000, 3500, 'SKMASV', '', '', 'Recibido', 'ayuda familiar', 'ap000004', NULL, '2020-08-06 13:36:10', 'Envio normal', NULL),
(96, '', '116.631', 'exsuperasia nchama ondo', '', '222552321', 'malabo', 'ap000004', 18, '3', 'justina andeme ngua', '', '222198658', 'bata', 'ap000004', 0, 1, 2, 1, 140000, 3500, '', '', '', 'Revalidar', 'ayuda familiar', 'ap000004', NULL, '2020-08-08 10:43:49', 'Solicitud Modificacion envio', NULL),
(97, '', '116.631', 'exsuperancia nchama ngua', '', '222045327', 'malabo', 'ap000004', 87, '11105', 'justina andeme ngua', '', '222198658', 'bata', 'ap000004', 90, 1, 2, 1, 140000, 3500, 'JZ9Z4S', '', '', 'Recibido', 'ayuda familiar', 'ap000004', NULL, '2020-08-08 11:00:55', 'Envio normal', NULL),
(98, '', '0000', 'MARIA DE LOS ANGELES MANGUE NVO', '', '222681391', 'BATA', 'ap000005', 88, '000001', 'TRINIDAD ABOGO NVO', '', '222352016', 'EBIBEYIN', 'ap000005', 91, 2, 1, 1, 40000, 2000, '3VQICL', '', '', 'Pendiente', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-08-11 14:07:44', 'Envio normal', NULL),
(99, '', '1122558', 'ramon miko avomo', '', '222299542', 'malabo', 'ap000004', 89, '11178', 'cristina wuadalupe eyenga', '', '222781383', 'bata', 'ap000004', 92, 1, 2, 1, 100000, 2500, 'M9QMFV', '', '', 'Recibido', 'ayuda familiar', 'ap000004', NULL, '2020-08-12 14:12:41', 'Envio normal', NULL),
(100, '', '84564', 'Victoria Eyang Ndong', '', '222205366', 'Malabo', 'ap000003', 63, '7345', 'Regina Meba nsie', '', '222522883', 'bata', 'ap000003', 93, 1, 2, 1, 100000, 2500, 'IZ9SGR', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-08-13 09:23:11', 'Envio normal', NULL),
(101, '', '734195', 'NDONGO DIUF', '', '222068657', 'malabo', 'ap000003', 90, '9876', 'LAMINE THIOR', '', '222712306', 'BATA', 'ap000003', 94, 1, 2, 1, 196500, 3500, 'M5YN2J', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-08-17 09:05:11', 'Envio normal', NULL),
(102, '', '000', 'GASPAR NSI NDONG ANDEME', '', '222759564', 'BATA', 'ap000005', 91, '0XXX', 'PERGENTINO NGUA NDONG ANDEME', '', '222767604', 'MALABO', 'ap000005', 95, 2, 1, 1, 19000, 2000, 'FZ1MZJ', '', '', 'Recibido', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-08-18 11:01:54', 'Envio normal', NULL),
(103, '', '08765', 'Cirilo OBAMA MANGUE', '', '222340164', 'malabo', 'ap000003', 92, '52132', 'Carina MBANG', '', '222257879', 'Ebibeyin', 'ap000003', 96, 1, 3, 1, 35000, 2000, 'VE7BOH', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-08-18 11:07:28', 'Envio normal', NULL),
(104, '', '08765', 'Cirilo OBAMA MANGUE', '', '222340164', 'malabo', 'ap000003', 93, '96310', 'Moinses ALOGO OBAMA', '', '551376682', 'Ebibeyin', 'ap000003', 97, 1, 3, 1, 25000, 2000, 'KBLH90', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-08-18 11:18:21', 'Envio normal', NULL),
(105, '', 'XXXX', 'BENEDICTA NZANG EDU', '', '222035103', 'BATA', 'ap000005', 94, 'XX00', 'PEDRO ANTONIO ONDO NZE', '', '222721363', 'EBIBEYIN', 'ap000005', 98, 2, 1, 1, 25000, 2000, '9FQ9Z3', '', '', 'Pendiente', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-08-18 11:37:54', 'Envio normal', NULL),
(106, '', '171025', 'sipriano nsue misihi', '', '551801937', 'malabo', 'ap000003', 95, 'XXXXXK', 'Leona EYANG MITOGO', '', '222642201', 'BATA', 'ap000003', 99, 1, 2, 1, 100000, 2500, 'LVBSMD', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-08-18 14:55:14', 'Envio normal', NULL),
(107, '', '03452', 'Maria Carmen ACHI', '', '222070695', 'malabo', 'ap000003', 96, 'yhtr', 'Israel ESONO OKOMO', '', '222748269', 'ebibeyin', 'ap000003', 100, 1, 3, 1, 20000, 2000, 'IPR2M3', '', '', 'Recibido', '', 'ap000003', NULL, '2020-08-19 13:12:23', 'Envio normal', NULL),
(108, '', '27654', 'Goyo EYAMA NSUE', '', '222006043', 'malabo', 'ap000003', 97, 'RTE', 'Trifonia NSUE MISIHI', '', '222658263', 'bata', 'ap000003', 101, 1, 2, 1, 40000, 2000, '4TG8ZP', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-08-21 07:10:04', 'Envio normal', NULL),
(109, '', '12345', 'Maria Blanca ASUMU EVUNA', '', '222249972', 'malabo', 'ap000003', 98, 'uytr', 'Esperanza NCHAMA EVUNA', '', '222635894', 'bata', 'ap000003', 102, 1, 2, 1, 230000, 5000, 'ATGDTD', '', '', 'Recibido', 'ayuda familiar', 'ap000003', NULL, '2020-08-24 07:49:27', 'Envio normal', NULL),
(110, '', '0000', 'PEDRO MARIANO ESONO BIBANG', '', '222248243', 'BATA', 'ap000005', 99, 'XXXXX', 'ANGEL NICANOR NKA ESONO', '', '555205312', 'MALABO', 'ap000005', 103, 2, 1, 1, 45000, 2000, 'I5SMSC', '', '', 'Pendiente', 'AYUDA FAMILIAR', 'ap000005', NULL, '2020-08-24 12:11:43', 'Envio normal', NULL),
(111, '', '90876', 'Medino Placido Nseng', '', '222115647', 'Malabo', 'ap001531', 66, '64325', 'Maria Teresa Eyang', '', '222226662', 'niefang', 'ap001531', 69, 1, 14, 1, 150000, 6000, 'RQIVOT', '', '', 'Revalidar', 'ayuda famillar', 'ap001531', NULL, '2023-01-17 04:27:34', 'Solicitud Modificacion envio', NULL),
(114, '23957676', '33221133', 'MMiguel angel', NULL, '222512842', 'Aqui', 'ap001531', 115, NULL, 'Test MBA', NULL, '222589550', 'Aqui', 'ap001531', 138, 1, NULL, 1, 60000, 2500, '775592', '001', 'D', 'Pendiente', 'Test familla', 'ap001531', NULL, '2023-01-19 23:35:10', 'Envio normal', NULL),
(139, 'AQ55IA52', '12121212', 'lisss', NULL, '111222333', 'Lisss', 'ap001531', 114, '12345678', 'Kiasss', NULL, '112233433', 'Kissss', 'ap001531', 133, 1, 1, 1, 60000, 2500, '1EFNS8', '001', 'D', 'Recibido', 'Ayusaaaaa', 'ap001531', NULL, '2023-01-18 12:44:44', 'Envio normal', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `idCaja` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `agencia` int(11) NOT NULL COMMENT 'Agencia Master',
  `cliente` varchar(10) NOT NULL COMMENT 'DNIremitente ',
  `cajero` varchar(8) NOT NULL,
  `ncpCorriente` varchar(45) NOT NULL,
  `ncpComisiones` varchar(45) NOT NULL,
  `auditada` varchar(2) DEFAULT 'NO',
  `montoMaxEnvio` double DEFAULT NULL,
  `cajacerrada` varchar(2) NOT NULL DEFAULT 'NO',
  `fecrea` datetime NOT NULL,
  `usCreador` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`idCaja`, `nombre`, `agencia`, `cliente`, `cajero`, `ncpCorriente`, `ncpComisiones`, `auditada`, `montoMaxEnvio`, `cajacerrada`, `fecrea`, `usCreador`) VALUES
(3, 'Caja 01', 15, '001104779', 'ap000002', '37200110477901', '99900110477902', 'NO', 4000000, 'NO', '2023-01-15 23:38:13', 'ap001531'),
(4, 'Caja 02', 1, '1000000001', 'ap001531', '372100000000101', '999100000000102', 'NO', 4000000, 'NO', '2023-01-15 23:38:13', 'ap001531');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `DNIremitente` varchar(10) NOT NULL,
  `nomcompleto` varchar(65) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `pais` int(11) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `agencia_cli` int(11) NOT NULL,
  `estado` int(11) NOT NULL COMMENT 'Estado remitente: 1=Activo, 2=Suspendido, 3=Borrado',
  `agencrea` varchar(8) NOT NULL,
  `fecrea` datetime NOT NULL,
  `agenmodif` varchar(8) DEFAULT NULL,
  `femodif` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`DNIremitente`, `nomcompleto`, `tel`, `pais`, `direccion`, `agencia_cli`, `estado`, `agencrea`, `fecrea`, `agenmodif`, `femodif`) VALUES
('001104779', 'Test Test Test222', '222512842', 1, 'Malabo, Alcaide Parque', 1, 1, 'ap001531', '2023-01-14 02:18:01', '37200110', '2023-01-14 02:19:01'),
('1000000001', 'Desarrollador Web', '222512842', 1, 'Malabo, Alcaide Parque', 1, 1, 'ap001531', '2023-01-14 02:18:01', '', '2023-01-14 02:19:01'),
('12121212', 'Javier Javier', '222555111', 1, 'Semu 2', 15, 1, 'ap001531', '2023-01-16 01:55:00', 'ap001531', NULL),
('13131313', 'lisss', '111222333', 1, 'Lisss', 1, 1, 'ap001531', '2023-01-18 12:44:44', 'ap001531', '2023-01-19 01:23:42'),
('33221133', 'MMiguel angel', '222512842', 1, 'Aqui', 1, 1, 'ap001531', '2023-01-19 23:35:10', NULL, NULL),
('44444444', 'Pelagio MBA', '222630191', 1, 'Mline', 1, 1, 'ap001531', '2023-01-20 04:41:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `numerocuenta` varchar(45) NOT NULL,
  `cliente` varchar(10) NOT NULL,
  `saldo` double NOT NULL DEFAULT 0,
  `tipo_cuenta` varchar(40) NOT NULL,
  `agencialigada` int(11) DEFAULT NULL COMMENT 'Si es libre o ligada a una agencia Master',
  `gestor` varchar(8) DEFAULT NULL,
  `firma` varchar(40) DEFAULT NULL COMMENT 'Imagen DNI y foto',
  `cuenta_cerrada` varchar(10) NOT NULL DEFAULT 'NO',
  `femovimiento` datetime DEFAULT NULL,
  `usCreador` varchar(8) NOT NULL,
  `fecreacion` datetime NOT NULL,
  `control` tinyint(4) DEFAULT 0 COMMENT 'Este capo recibe 1 si tiene operación en curso pulsado por el usuario, 0 al finalizar la operación para evitar negativos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`numerocuenta`, `cliente`, `saldo`, `tipo_cuenta`, `agencialigada`, `gestor`, `firma`, `cuenta_cerrada`, `femovimiento`, `usCreador`, `fecreacion`, `control`) VALUES
('37200110477901', '001104779', 850000, 'CUENTA_CORRIENTE', 0, '', 'ESCANEAR', 'NO', '2023-01-17 04:20:31', 'ap001531', '2023-01-14 03:21:09', 0),
('3721212121201', '12121212', 150000, 'CUENTA_CORRIENTE', NULL, NULL, 'ESCANEAR', 'NO', '2023-02-07 23:31:58', 'ap001531', '2023-01-16 02:02:46', 0),
('3721A00000000101', '1000000001', 359000, 'CUENTA_CORRIENTE', 0, '', 'ESCANEAR', 'NO', '2023-02-07 23:31:58', 'ap001531', '2023-01-14 03:21:09', 0),
('3724444444401', '44444444', 103500, 'CUENTA_CORRIENTE', 1, '', 'ESCANEAR', 'NO', '2023-02-07 17:37:54', 'ap001531', '2023-01-20 04:47:52', 0),
('37300110477901', '001104779', 0, 'CUENTA_AHORRO', 0, '', 'ESCANEAR', 'NO', NULL, 'ap001531', '2023-01-14 03:21:49', 0),
('88800110477901', '001104779', 0, 'CUENTA_GASTOS', 15, '', 'ESCANEAR', 'NO', NULL, 'ap001531', '2023-01-26 01:09:25', 0),
('99900110477902', '001104779', 0, 'CUENTA_COMISIONES', 0, '', 'ESCANEAR', 'NO', NULL, 'ap001531', '2023-01-14 03:29:37', 0),
('999100000000102', '1000000001', 7648, 'CUENTA_COMISIONES', 0, '', 'ESCANEAR', 'NO', '2023-01-24 13:02:32', 'ap001531', '2023-01-14 03:29:37', 0),
('999100000000105', '12121212', 4675, 'CUENTA_COMISIONES', 0, '', 'INTERNA', 'NO', '2023-01-19 23:35:10', 'ap001531', '2023-01-14 03:29:37', 0),
('9991212121201', '12121212', 800000, 'CUENTA_CAPITAL', 15, '', 'INTERNA', 'NO', NULL, 'ap001531', '2023-01-16 02:05:29', 0),
('9991212121202', '12121212', 0, 'CUENTA_COMISIONES', 15, '', 'ESCANEAR', 'NO', NULL, 'ap001531', '2023-01-16 02:05:29', 0),
('9991212121203', '12121212', 0, 'CUENTA_IVA', 15, '', 'INTERNA', 'NO', NULL, 'ap001531', '2023-01-16 02:05:29', 0),
('9994444444401', '44444444', 126500, 'CUENTA_CAPITAL', 1, '', 'INTERNA', 'NO', '2023-02-01 15:29:06', 'ap001531', '2023-01-16 02:05:29', 0),
('9994444444402', '44444444', 0, 'CUENTA_COMISIONES', 1, '', 'ESCANEAR', 'NO', NULL, 'ap001531', '2023-01-20 04:48:46', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL,
  `ap` varchar(8) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `DNI` varchar(10) DEFAULT NULL COMMENT 'Codigo del cliente registrado como empleado',
  `cargo` varchar(20) DEFAULT NULL,
  `rol` varchar(20) NOT NULL,
  `salario` double DEFAULT NULL,
  `agencia_em` int(11) NOT NULL COMMENT 'Agencia que trabaja',
  `pais` int(11) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `interno` varchar(8) NOT NULL,
  `condicion` int(1) DEFAULT NULL COMMENT 'Estados: 1 Activo, 2 Suspendido, 3 Bloqueado',
  `agecrea` varchar(8) DEFAULT NULL COMMENT 'Agente que lo ha creado',
  `fecrea` date DEFAULT NULL COMMENT 'Fecha de creacion',
  `feinicioempleo` date NOT NULL,
  `femod` date DEFAULT NULL COMMENT 'Fecha de la modificacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idempleado`, `ap`, `password`, `DNI`, `cargo`, `rol`, `salario`, `agencia_em`, `pais`, `ciudad`, `interno`, `condicion`, `agecrea`, `fecrea`, `feinicioempleo`, `femod`) VALUES
(1, 'ap001531', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1000000001', 'Desarrollador Web', 'Super Administrador', 5000000, 1, 1, '0', '', 1, 'ap001531', '2020-01-24', '2019-12-13', '2023-01-27'),
(6, 'ap000002', '4cab97e818b20e04b3e8530034ab018229ef6e3c090aa11d38b752e1a7e69b7c', '0000000002', 'Director', '', 4000000, 1, 0, '0', '', 1, 'ap001531', '2020-03-21', '2020-03-21', '2023-01-27'),
(10, 'ap000007', '', '116040', 'Agente de ventas', '', 100000, 3, 0, '0', '', 0, 'ap000002', '2020-03-22', '2018-02-01', '2020-11-25'),
(11, 'ap000003', '', '', 'Jefa de agencia', '', 150000, 1, 0, '0', '', 0, 'ap001531', '2020-03-24', '2019-09-01', '2020-11-25'),
(14, 'ap000004', '', '1111601', 'Agente de ventas', '', 200000, 1, 0, '0', '', 0, 'ap000002', '2020-03-28', '2016-08-01', '2020-11-25'),
(15, 'ap000005', '', '76978', 'Agente de ventas', '', 100000, 2, 0, '0', '', 0, 'ap000002', '2020-03-28', '2016-08-01', '2020-11-25'),
(16, 'ap000006', NULL, '137686', 'Agente de ventas', '', 100000, 14, 0, '0', '', 0, 'ap000002', '2020-03-31', '2020-03-31', '2020-11-25'),
(17, 'ap000006', NULL, '137686', 'Agente de ventas', '', 100000, 14, 0, '0', '', NULL, 'ap000002', '2020-03-31', '2020-03-31', NULL),
(18, 'ap000008', '', 'C0132977', 'Agente de venta', '', 0, 14, 0, '0', '', 0, 'ap000002', '2020-04-03', '2020-04-03', '2020-11-25'),
(19, 'ap000010', '', '50276', 'Administrador genera', '', 150000, 1, 0, '0', '', 0, 'ap000002', '2020-07-09', '2020-07-01', '2020-11-25'),
(20, 'ap000011', '', '3001470', 'Agente niefang', '', 100000, 14, 0, '0', '', 0, 'ap000002', '2020-07-12', '2020-07-12', '2020-11-25'),
(33, 'ap001515', NULL, '001104779', 'Dev', 'Cajero', 500000, 1, 1, 'Malabo', 'SI', 1, 'ap001531', '2023-01-12', '2023-01-12', '2023-01-12'),
(34, 'ap001212', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '12121212', 'Cajero', 'Administrador', 250000, 15, 1, 'Malabo', 'SI', 1, 'ap001531', '2023-01-16', '2023-01-16', '2023-01-27'),
(35, 'ap001010', NULL, '44444444', 'Supervisor general', 'Supervisor', 2000000, 1, 1, 'Malabo', 'SI', 1, 'ap001531', '2023-01-20', '2022-01-01', NULL);

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
(1, 'Saldo inicial caja', 500000, 'C', 'Bata', '2020-03-30', 1, 'ap000002'),
(2, 'Saldo inicial caja', 300000, 'C', 'Niefang', '2020-03-30', 1, 'ap000002'),
(3, 'Saldo inicial caja', 100000, 'C', 'Ebibeyin', '2020-03-30', 1, 'ap000002'),
(4, 'Salario mes de marzo 2020', 200000, 'D', 'Josefa', '2020-03-30', 1, 'ap000002'),
(5, 'Salario mes de marzo 2020', 150000, 'D', 'Marina', '2020-03-30', 1, 'ap000002'),
(6, 'Salario mes de febrero 2020', 50000, 'D', 'Marina', '2020-03-30', 1, 'ap000002'),
(7, 'Salario mes de marzo 2020', 100000, 'D', 'Trifonia', '2020-03-30', 1, 'ap000002'),
(8, 'Salario mes de marzo 2020', 100000, 'D', 'Muana chuchu', '2020-03-30', 1, 'ap000002'),
(9, 'Salario mes de marzo 2020', 100000, 'D', 'Crispin jaime', '2020-03-30', 1, 'ap000002'),
(13, 'Comisiones de envio 2', 6000, 'C', 'Receptor bile', '2020-03-30', 2, 'ap000005'),
(14, 'Ingreso del dia 26-03-20', 10000, 'C', 'CS 696', '0020-03-31', 1, 'ap000003'),
(15, 'Iingreso del dia 27-03-20', 10000, 'C', 'CS 696', '2020-03-31', 1, 'ap000003'),
(16, 'Ingreso del dia 26-03-20', 10000, 'C', 'CS 694', '2020-03-31', 1, 'ap000003'),
(17, 'ingreso del dia 28-03-20', 10000, 'C', 'CS 694', '2020-03-31', 1, 'ap000003'),
(18, 'ingerso del dia 30-03-20', 10000, 'C', 'CS 696', '2020-03-31', 1, 'ap000003'),
(20, 'Iingreso del dia 27-03-20', 10000, 'C', 'CS 698', '0020-03-31', 1, 'ap000003'),
(21, 'Iingreso del dia 27-03-20', 10000, 'C', 'CS 695', '2020-03-31', 1, 'ap000003'),
(22, 'ingreso del dia 28-03-20', 10000, 'C', 'CS 695', '2020-03-31', 1, 'ap000003'),
(23, 'ingerso del dia 30-03-20', 10000, 'C', 'CS 698', '2020-03-31', 1, 'ap000003'),
(24, 'Ingreso del dia 26-03-20', 10000, 'C', 'CS 697', '2020-03-31', 1, 'ap000003'),
(25, 'Iingreso del dia 27-03-20', 10000, 'C', 'CS 697', '0020-03-31', 1, 'ap000003'),
(26, 'ingerso del dia 30-03-20', 10000, 'C', 'CS 695', '2020-03-31', 1, 'ap000003'),
(27, 'ingreso del dia 31', 10000, 'C', 'CS 696', '0200-04-01', 1, 'ap000003'),
(28, 'Comisiones de envio 2', 3000, 'C', 'Receptor florentina bilehe', '2020-04-01', 2, 'ap000005'),
(29, 'Comisiones de envio 2', 3000, 'C', 'Receptor Laurencia Nguema Nchama', '2020-04-01', 2, 'ap000005'),
(30, 'Comisiones de envio 2', 6000, 'C', 'Receptor Samuel Ondo Nkara', '2020-04-01', 2, 'ap000005'),
(31, 'Igreso del dia 31', 10000, 'C', 'CS 697', '2020-04-02', 1, 'ap000003'),
(32, 'Ingreso del dia 01-04-20', 10000, 'C', 'CS 697', '2020-04-02', 1, 'ap000003'),
(33, 'ingreso del dia 31', 10000, 'C', 'CS 698', '2020-04-02', 1, 'ap000003'),
(34, 'Ingreso del dia 01-04-20', 10000, 'C', 'CS 698', '2020-04-02', 1, 'ap000003'),
(35, 'ingreso del dia 31', 10000, 'C', 'CS 695', '2020-04-02', 1, 'ap000003'),
(36, 'Comisiones de envio 2', 3000, 'C', 'Receptor Juan Ondo Enguema', '2020-04-02', 2, 'ap000005'),
(37, 'Comisiones de envio 2', 15000, 'C', 'Receptor Laurencia Nguema Nchama', '2020-04-02', 2, 'ap000005'),
(38, 'Comisiones de envio 2', 3000, 'C', 'Receptor Pera Nsuga Nzeng Bindang', '2020-04-02', 2, 'ap000005'),
(39, 'Comisiones de envio 1', 3000, 'C', 'Receptor Agustin Nve ASUMU NCHAMA', '2020-04-03', 1, 'ap000003'),
(40, 'ingreso del dia 01-04-20', 10000, 'C', 'CS 695', '2020-04-03', 1, 'ap000003'),
(41, 'ingreso del dia 02-04-2020', 10000, 'C', 'CS 695', '2020-04-03', 1, 'ap000003'),
(42, 'ingreso del dia 02-04-2020', 10000, 'C', 'CS 698', '2020-04-03', 1, 'ap000003'),
(43, 'ingerso del dia 30-03-20', 10000, 'C', 'CS 697', '2020-04-03', 1, 'ap000003'),
(44, 'ingreso del dia 02-04-2020', 10000, 'C', 'CS 697', '2020-04-03', 1, 'ap000003'),
(45, 'Comisiones de envio 14', 6000, 'C', 'Receptor Nemesio Esono', '2020-04-03', 14, 'ap000006'),
(46, 'Comisiones de envio 14', 6000, 'C', 'Receptor Nemesio Esono', '2020-04-03', 14, 'ap000006'),
(47, 'Comisiones de envio 2', 3000, 'C', 'Receptor AMBROSIO ESONO ANGUE', '2020-04-03', 2, 'ap000005'),
(48, 'Comisiones de envio 2', 6000, 'C', 'Receptor francisca medja angono', '2020-04-03', 2, 'ap000005'),
(49, 'Comisiones de envio 2', 3000, 'C', 'Receptor justina andeme ngua', '2020-04-03', 2, 'ap000005'),
(50, 'Comisiones de envio 1', 3000, 'C', 'Receptor ambrosio esono angue', '2020-04-04', 1, 'ap000003'),
(51, 'Comisiones de envio 1', 3000, 'C', 'Receptor jefte micha nsue', '2020-04-07', 1, 'ap000003'),
(52, 'Comisiones de envio 2', 3000, 'C', 'Receptor Mercedes Biang Bika', '2020-04-07', 2, 'ap000005'),
(53, 'Comisiones de envio 2', 9000, 'C', 'Receptor Trifonia Nsue', '2020-04-07', 2, 'ap000005'),
(54, 'Comisiones de envio 2', 3000, 'C', 'Receptor Maria Soledad Andeme', '2020-04-07', 2, 'ap000005'),
(55, 'Comisiones de envio 2', 3000, 'C', 'Receptor Ana Maria Medico Borge', '2020-04-07', 2, 'ap000005'),
(56, 'Comisiones de envio 2', 30000, 'C', 'Receptor Ebesoh Dorine', '2020-04-07', 2, 'ap000005'),
(57, 'Comisiones de envio 2', 3000, 'C', 'Receptor soledad andeme ndong', '2020-04-07', 2, 'ap000005'),
(58, 'Comisiones de envio 1', 3000, 'C', 'Receptor Antonio Saul Ndong', '2020-04-08', 1, 'ap000003'),
(59, 'Comisiones de envio 14', 12000, 'C', 'Receptor Antonio Ndong Esono', '2020-04-08', 14, 'ap000006'),
(60, 'Comisiones de envio 2', 3000, 'C', 'Receptor Cresensia Andong Esono', '2020-04-08', 2, 'ap000005'),
(61, 'Comisiones de envio 3', 3000, 'C', 'Receptor CELESTINO ENAMA ASUMU', '2020-04-08', 3, 'ap000007'),
(62, 'Comisiones de envio 14', 3000, 'C', 'Receptor Esperanza Oyen', '2020-04-10', 14, 'ap000006'),
(63, 'Comisiones de envio 14', 3000, 'C', 'Receptor serafina abogo okiri', '2020-04-10', 14, 'ap000006'),
(64, 'Comisiones de envio 14', 9000, 'C', 'Receptor Santiago Bee', '2020-04-10', 14, 'ap000006'),
(65, 'Comisiones de envio 2', 6000, 'C', 'Receptor Cresensia Andong Esono', '2020-04-13', 2, 'ap000005'),
(66, 'Comisiones de envio 3', 3000, 'C', 'Receptor wamba ngoumegnon wamba', '2020-04-13', 3, 'ap000007'),
(67, 'Pago del alquiler de la casa de sipopo', 130000, 'C', 'INMOSER', '2020-04-13', 1, 'ap000002'),
(68, 'Pago a Montse por el alquiler de su casa', 100000, 'D', 'INMOSER', '2020-04-13', 1, 'ap000002'),
(69, 'Comisiones de envio 2', 9000, 'C', 'Receptor Santiago Nguema Nchama', '2020-04-13', 2, 'ap000005'),
(70, 'Comisiones de envio 2', 3000, 'C', 'Receptor Andres Miko Nseng', '2020-04-13', 2, 'ap000005'),
(71, 'Comisiones de envio 14', 3000, 'C', 'Receptor Pedro Manuel Nguema Ondo', '2020-04-14', 14, 'ap000006'),
(72, 'Comisiones de envio 1', 3000, 'C', 'Receptor MARIA CARMEN NDONG', '2020-04-15', 1, 'ap000003'),
(73, 'Comisiones de envio 14', 3000, 'C', 'Receptor SANTIAGO MABALE', '2020-04-15', 14, 'ap000006'),
(74, 'Comisiones de envio 14', 6000, 'C', 'Receptor lucia nkenene esono', '2020-04-15', 14, 'ap000006'),
(75, 'Comisiones de envio 14', 3000, 'C', 'Receptor esperasa oyeng', '2020-04-15', 14, 'ap000006'),
(76, 'Comisiones de envio 2', 3000, 'C', 'Receptor Matias MONSUY', '2020-05-05', 2, 'ap000005'),
(77, 'Comisiones de envio 2', 3000, 'C', 'Receptor encarnasion mangue mba', '2020-05-07', 2, 'ap000005'),
(78, 'Comisiones de envio 2', 3000, 'C', 'Receptor Jose Luis Edjang Mba Mia', '2020-05-07', 2, 'ap000005'),
(79, 'Comisiones de envio 1', 3000, 'C', 'Receptor jefte micha nsue', '2020-05-07', 1, 'ap000004'),
(80, 'Comisiones de envio 2', 3000, 'C', 'Receptor Trinidad AYANG', '2020-05-14', 2, 'ap000005'),
(81, 'Comisiones de envio 1', 3000, 'C', 'Receptor Sinforosa MIYONO AYANG', '2020-05-23', 1, 'ap000004'),
(82, 'Comisiones de envio 1', 3000, 'C', 'Receptor MARIA JOSEFA ERNESTINA ASUE  NDONG', '2020-06-01', 1, 'ap000003'),
(83, 'Comisiones de envio 2', 3000, 'C', 'Receptor delfin nsue', '2020-06-08', 2, 'ap000005'),
(84, 'Comisiones de envio 2', 3000, 'C', 'Receptor justina andeme ngua', '2020-06-09', 2, 'ap000005'),
(85, 'Comisiones de envio 2', 3000, 'C', 'Receptor Trifonia Nsue', '2020-06-09', 2, 'ap000005'),
(86, 'Comisiones de envio 1', 3000, 'C', 'Receptor MARIA JOSEFA ERNESTINA ASUE  NDONG', '2020-06-09', 1, 'ap000003'),
(87, 'Comisiones de envio 2', 3000, 'C', 'Receptor Regina Meba Nsie', '2020-06-12', 2, 'ap000005'),
(88, 'Comisiones de envio 2', 3000, 'C', 'Receptor Elisa Masanga Nsue Angono', '2020-06-12', 2, 'ap000005'),
(89, 'Comisiones de envio 1', 3000, 'C', 'Receptor EMILIA MIFUMU NGUNDI', '2020-06-13', 1, 'ap000003'),
(90, 'Comisiones de envio 1', 3000, 'C', 'Receptor PASCUAL OSA NGUEMA', '2020-06-15', 1, 'ap000003'),
(91, 'Comisiones de envio 2', 3000, 'C', 'Receptor Leona Ayecaba Andeme Esono', '2020-06-16', 2, 'ap000005'),
(92, 'Comisiones de envio 1', 3000, 'C', 'Receptor MARIA JOSEFA ERNESTINA ASUE  NDONG', '2020-06-18', 1, 'ap000004'),
(93, 'Comisiones de envio 1', 3000, 'C', 'Receptor MARIA JOSEFA ERNESTINA ASUE  NDONG', '2020-06-18', 1, 'ap000004'),
(94, 'Comisiones de envio 1', 3000, 'C', 'Receptor JESUS ONDJIGUI', '2020-06-18', 1, 'ap000004'),
(95, 'Comisiones de envio 1', 3000, 'C', 'Receptor JESUS ONDJIGUI', '2020-06-18', 1, 'ap000004'),
(96, 'Comisiones de envio 1', 3000, 'C', 'Receptor test1', '2020-06-18', 1, 'ap000004'),
(97, 'Comisiones de envio 1', 3000, 'C', 'Receptor Tangui OWONO NGUEMA', '2020-06-19', 1, 'ap000004'),
(98, 'Comisiones de envio 1', 3000, 'C', 'Receptor ANASTACIA SUAMA NZIE', '2020-07-07', 1, 'ap000003'),
(99, 'Comisiones de envio 1', 3000, 'C', 'Receptor RUBEN DARIO NZI EFUMAN', '2020-07-09', 1, 'ap000004'),
(100, 'Comisiones de envio 2', 3000, 'C', 'Receptor Trifonia Nsue', '2020-07-10', 2, 'ap000005'),
(101, 'Comisiones de envio 1', 3000, 'C', 'Receptor MARIA CARMEN NGUIE ONDO', '2020-07-10', 1, 'ap000004'),
(102, 'Comisiones de envio 3', 9000, 'C', 'Receptor Santiago edjang', '2020-07-12', 3, 'ap000007'),
(103, 'Comisiones de envio 2', 3000, 'C', 'Receptor Maria Soledad Andeme', '2020-07-13', 2, 'ap000005'),
(104, 'Comisiones de envio 2', 3000, 'C', 'Receptor antonio asila', '2020-07-14', 2, 'ap000005'),
(105, 'Comisiones de envio 1', 3000, 'C', 'Receptor Margarita angue Nguema aseme', '2020-07-15', 1, 'ap000002'),
(106, 'Comisiones de envio 2', 2000, 'C', 'Receptor leona ayecaba andeme esono', '2020-07-15', 2, 'ap000005'),
(107, 'Comisiones de envio 1', 3000, 'C', 'Receptor AVELINA MANGUE NGUI', '2020-07-29', 1, 'ap000003'),
(108, 'Comisiones de envio 1', 3000, 'C', 'Receptor AVELINA MANGUE NGUI', '2020-07-29', 1, 'ap000003'),
(109, 'Comisiones de envio 1', 3000, 'C', 'Receptor Tangui OWONO NGUEMA', '2020-07-29', 1, 'ap000003'),
(110, 'Comisiones de envio 1', 3000, 'C', 'Receptor Imelda Oyono Obiang', '2020-07-29', 1, 'ap000003'),
(111, 'Comisiones de envio 1', 3000, 'C', 'Receptor A', '2020-07-29', 1, 'ap000003'),
(112, 'Comisiones de envio 2', 2000, 'C', 'Receptor isabel ayi  nguema', '2020-07-30', 2, 'ap000005'),
(113, 'Comisiones de envio 2', 3500, 'C', 'Receptor TOMASA ABESO ABAGA', '2020-08-05', 2, 'ap000005'),
(114, 'Comisiones de envio 2', 3500, 'C', 'Receptor anastasia asama nefuman', '2020-08-07', 2, 'ap000005'),
(115, 'Comisiones de envio 2', 3500, 'C', 'Receptor justina andeme ngua', '2020-08-10', 2, 'ap000005'),
(116, 'Comisiones de envio 2', 2500, 'C', 'Receptor cristina wuadalupe eyenga', '2020-08-12', 2, 'ap000005'),
(117, 'Comisiones de envio 2', 2500, 'C', 'Receptor Regina Meba nsie', '2020-08-13', 2, 'ap000005'),
(118, 'Comisiones de envio 2', 3500, 'C', 'Receptor LAMINE THIOR', '2020-08-17', 2, 'ap000005'),
(119, 'Comisiones de envio 1', 2000, 'C', 'Receptor PERGENTINO NGUA NDONG ANDEME', '2020-08-18', 1, 'ap000003'),
(120, 'Comisiones de envio 2', 2500, 'C', 'Receptor Leona EYANG MITOGO', '2020-08-18', 2, 'ap000005'),
(121, 'Comisiones de envio 3', 2000, 'C', 'Receptor Moinses ALOGO OBAMA', '2020-08-19', 3, 'ap000007'),
(122, 'Comisiones de envio 3', 2000, 'C', 'Receptor Israel ESONO OKOMO', '2020-08-19', 3, 'ap000007'),
(123, 'Comisiones de envio 3', 2000, 'C', 'Receptor Carina MBANG', '2020-08-20', 3, 'ap000007'),
(124, 'Comisiones de envio 2', 2000, 'C', 'Receptor Trifonia NSUE MISIHI', '2020-08-22', 2, 'ap000005'),
(125, 'Comisiones de envio 2', 5000, 'C', 'Receptor Esperanza NCHAMA EVUNA', '2020-08-24', 2, 'ap000005'),
(126, 'Comisiones de envio BRUTO 1', 2500, 'C', 'Receptor Validacion Miguel', '2023-01-19', 1, 'ap001531'),
(127, 'Comisiones de envio NETO 1', 638, 'C', 'Receptor Validacion Miguel', '2023-01-19', 1, 'ap001531'),
(128, 'Comisiones de envio BRUTO 1', 2500, 'C', 'Receptor Validacion Miguel', '2023-01-19', 1, 'ap001531'),
(129, 'Comisiones de envio NETO 1', 638, 'C', 'Receptor Validacion Miguel', '2023-01-19', 1, 'ap001531'),
(130, 'Comisiones de envio BRUTO 1', 2500, 'C', 'Receptor Validacion Miguel', '2023-01-23', 1, 'ap001531'),
(131, 'Comisiones de envio NETO 1', 638, 'C', 'Receptor Validacion Miguel', '2023-01-23', 1, 'ap001531'),
(132, 'Comisiones de envio BRUTO 1', 2500, 'C', 'Receptor Validacion Miguel', '2023-01-23', 1, 'ap001531'),
(133, 'Comisiones de envio NETO 1', 638, 'C', 'Receptor Validacion Miguel', '2023-01-23', 1, 'ap001531'),
(134, 'Comisiones de envio BRUTO 1', 2500, 'C', 'Receptor Validacion Miguel', '2023-01-24', 1, 'ap001531'),
(135, 'Comisiones de envio NETO 1', 638, 'C', 'Receptor Validacion Miguel', '2023-01-24', 1, 'ap001531');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `idPais` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(55) NOT NULL,
  `prefijoTel` varchar(6) NOT NULL,
  `limite_envioLOCAL` int(11) NOT NULL,
  `limite_envioINT` int(11) NOT NULL,
  `moneda` varchar(5) NOT NULL,
  `IVA` int(11) NOT NULL,
  `porcenENVIO` int(11) NOT NULL,
  `porcenRECIBIR` int(11) NOT NULL,
  `porcenENVIO_PAQ` int(11) NOT NULL,
  `porcenRECI_PAQ` int(11) NOT NULL,
  `partnerAPI` varchar(20) NOT NULL,
  `uscreador` varchar(8) NOT NULL,
  `fecrea` date NOT NULL,
  `usmodif` varchar(8) NOT NULL,
  `femodif` date NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`idPais`, `nombre`, `descripcion`, `prefijoTel`, `limite_envioLOCAL`, `limite_envioINT`, `moneda`, `IVA`, `porcenENVIO`, `porcenRECIBIR`, `porcenENVIO_PAQ`, `porcenRECI_PAQ`, `partnerAPI`, `uscreador`, `fecrea`, `usmodif`, `femodif`, `eliminado`) VALUES
(1, 'Guinea Ecuatorial', 'Un pais de la CEMAC Africa', '+240', 1000000, 1000000, 'FCFA', 15, 30, 30, 20, 20, '', 'ap001531', '2023-01-09', 'ap001531', '2023-01-19', 0);

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
(12, 'contabilidad'),
(13, 'acceso'),
(14, 'paises'),
(15, 'clientes'),
(16, 'cuentas'),
(17, 'cajas'),
(18, 'operaciones'),
(19, 'banco'),
(20, 'banco_comercial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_empleado`
--

CREATE TABLE `permiso_empleado` (
  `id_permisoempleado` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso_empleado`
--

INSERT INTO `permiso_empleado` (`id_permisoempleado`, `id_permiso`, `empleado`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 11, 1),
(4, 10, 1),
(5, 3, 1),
(6, 4, 1),
(7, 5, 1),
(8, 7, 1),
(9, 9, 1),
(10, 12, 1),
(22, 6, 1),
(24, 8, 1),
(25, 13, 1),
(120, 2, 16),
(121, 3, 16),
(128, 2, 16),
(129, 3, 16),
(130, 12, 16),
(131, 2, 10),
(132, 3, 10),
(133, 12, 10),
(136, 2, 11),
(137, 3, 11),
(138, 12, 11),
(139, 2, 15),
(140, 3, 15),
(141, 12, 15),
(145, 2, 14),
(146, 3, 14),
(147, 2, 18),
(148, 3, 18),
(149, 1, 19),
(150, 7, 19),
(151, 12, 19),
(152, 2, 20),
(153, 3, 20),
(156, 15, 1),
(163, 14, 1),
(165, 16, 1),
(169, 17, 1),
(208, 15, 34),
(209, 16, 34),
(210, 18, 1),
(211, 19, 1),
(212, 18, 1),
(213, 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptor`
--

CREATE TABLE `receptor` (
  `idreceptor` int(11) NOT NULL,
  `nomcompler` varchar(45) DEFAULT NULL,
  `telr` varchar(14) DEFAULT NULL,
  `direccionr` varchar(45) DEFAULT NULL,
  `agentcrea` varchar(8) DEFAULT NULL COMMENT 'Agente que ha creado al receptor',
  `fecrea` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `receptor`
--

INSERT INTO `receptor` (`idreceptor`, `nomcompler`, `telr`, `direccionr`, `agentcrea`, `fecrea`) VALUES
(2, 'Imelda Oyono Obiang', '222', 'bata', 'ap000003', '2020-03-30 08:45:39'),
(7, 'Tangui OWONO NGUEMA', '222626828', 'malabo', 'ap000002', '2020-03-31 12:04:05'),
(8, 'florentina bilehe', '0-', 'bata', 'ap000004', '2020-03-31 16:34:21'),
(9, 'Cresensia Andong Esono', '555562971', 'bata', 'ap000003', '2020-04-01 10:50:47'),
(10, 'Nemesio Esono', '222788339', 'niefang', 'ap000003', '2020-04-01 11:00:41'),
(11, 'Samuel Ondo Nkara', '222726578', 'bata', 'ap000003', '2020-04-01 12:07:57'),
(12, 'Pera Nsuga Nzeng Bindang', '555598882', 'bata', 'ap000003', '2020-04-02 08:34:03'),
(13, 'Laurencia Nguema Nchama', '555962971', 'bata', 'ap000003', '2020-04-02 08:47:41'),
(14, 'Juan Ondo Enguema', '222290430', 'bata', 'ap000003', '2020-04-02 09:09:08'),
(15, 'Agustin Nve ASUMU NCHAMA', '222788013', 'MALABO', 'ap000005', '2020-04-02 12:22:04'),
(16, 'ambrosio esono angue', '222277872', 'Bata', 'ap000007', '2020-04-03 11:59:44'),
(17, 'francisca medja angono', '222630072', 'bata', 'ap000004', '2020-04-03 13:45:56'),
(18, 'justina andeme ngua', '222198658', 'bata', 'ap000004', '2020-04-03 14:51:25'),
(19, 'jefte micha nsue', '555 453253', 'malabo', 'ap000005', '2020-04-04 10:21:17'),
(20, 'Antonio Saul Ndong', '222 190152', 'malabo', 'ap000005', '2020-04-04 10:32:16'),
(21, 'CELESTINO ENAMA ASUMU', '555622283', 'EBIBEYN', 'ap000005', '2020-04-06 15:36:03'),
(22, 'Mercedes Biang Bika', '222785673', 'bata', 'ap000003', '2020-04-07 08:01:21'),
(23, 'Trifonia Nsue', '222658263', 'bata', 'ap000003', '2020-04-07 08:04:02'),
(24, 'Antonio Ndong Esono', '222214001', 'niefang', 'ap000003', '2020-04-07 08:05:41'),
(25, 'Santiago Bee', '222589787', 'niefang', 'ap000003', '2020-04-07 08:08:18'),
(26, 'Maria Soledad Andeme', '222514846', 'bata', 'ap000003', '2020-04-07 08:28:19'),
(27, 'Esperanza Oyen', '222152308', 'niefang', 'ap000003', '2020-04-07 09:16:45'),
(28, 'Ana Maria Medico Borge', '222679027', 'bata', 'ap000003', '2020-04-07 10:00:41'),
(29, 'Ebesoh Dorine', '22626486', 'bata', 'ap000003', '2020-04-07 10:38:50'),
(30, 'serafina abogo okiri', '222114179', 'niefang', 'ap000004', '2020-04-07 12:53:13'),
(31, 'soledad andeme ndong', '222514846', 'bata', 'ap000004', '2020-04-07 14:07:24'),
(32, 'Cresensia Andong Esono', '222106916', 'bata', 'ap000003', '2020-04-08 07:26:06'),
(33, 'wamba ngoumegnon wamba', '222203231', 'ebibeyin', 'ap000004', '2020-04-09 13:40:58'),
(34, 'maria carmen ondo', '222696500', 'Niefang', 'ap000005', '2020-04-11 10:35:18'),
(35, 'Santiago Nguema Nchama', '22288365', 'bata', 'ap000003', '2020-04-13 11:33:06'),
(36, 'Andres Miko', '222269889', 'bata', 'ap000003', '2020-04-13 11:34:53'),
(37, 'Andres Miko Nseng', '222269889', 'bata', 'ap000003', '2020-04-13 11:36:31'),
(38, 'Pedro Manuel Nguema Ondo', '222536484', 'niefang', 'ap000003', '2020-04-13 11:42:31'),
(39, 'esperasa oyeng', '222617984', 'niefang', 'ap000004', '2020-04-13 14:07:30'),
(40, 'SANTIAGO MABALE', 'X', 'NIEFANG', 'ap000005', '2020-04-14 14:40:44'),
(41, 'lucia nkenene esono', '222129640', 'niefang', 'ap000004', '2020-04-14 15:03:44'),
(42, 'catalina oyana obama', '222598147', 'niefang', 'ap000004', '2020-04-14 15:09:10'),
(43, 'maria teresa eyenga afang', '222226662', 'niefang', 'ap000004', '2020-04-14 15:16:17'),
(44, 'A', 'A', 'A', 'ap000006', '2020-04-15 21:57:38'),
(45, 'Matias MONSUY', '222545427', 'bata', 'ap000003', '2020-05-04 11:43:03'),
(46, 'encarnasion mangue mba', '222101501', 'bata', 'ap000004', '2020-05-05 13:15:27'),
(47, 'Jose Luis Edjang Mba Mia', '555487635', 'bata', 'ap000003', '2020-05-07 08:19:41'),
(48, 'Imelda Oyono Obiang', '222', 'malabo', 'ap000005', '2020-05-07 08:26:39'),
(49, 'Tangui OWONO NGUEMA', '222 256 248', 'malabo', 'ap000005', '2020-05-12 10:14:34'),
(50, 'AVELINA MANGUE NGUI', '222782735', 'malabo', 'ap000005', '2020-05-12 11:21:37'),
(51, 'AVELINA MANGUE NGUI', '222782735', 'malabo', 'ap000005', '2020-05-12 14:20:14'),
(52, 'Trinidad AYANG', '222327814', 'bata', 'ap000007', '2020-05-14 09:59:27'),
(53, 'Sinforosa MIYONO AYANG', '555 593578', 'malabo', 'ap000005', '2020-05-21 11:26:29'),
(54, 'test1', '037950', 'niefang', 'ap000005', '2020-06-01 10:06:43'),
(55, 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '222004889', 'malabo', 'ap000005', '2020-06-01 10:15:00'),
(56, 'teresa afang mba', '222554669', 'niefang', 'ap000004', '2020-06-06 10:30:26'),
(57, 'delfin nsue', '222272646', 'bata', 'ap000004', '2020-06-06 12:57:00'),
(58, 'justina andeme ngua', '222198658', 'bata', 'ap000004', '2020-06-08 12:43:48'),
(59, 'JESUS ONDJIGUI', '222381360', 'NIEFANG', 'ap000005', '2020-06-08 13:45:23'),
(60, 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '222004889', 'malabo', 'ap000005', '2020-06-09 08:46:45'),
(61, 'Trifonia Nsue', '222658263', 'bata', 'ap000003', '2020-06-09 10:13:02'),
(62, 'Elisa Masanga Nsue Angono', '555474808', 'bata', 'ap000003', '2020-06-12 08:59:41'),
(63, 'Regina Meba nsie', '222522883', 'bata', 'ap000003', '2020-06-12 09:12:03'),
(64, 'PASCUAL OSA NGUEMA', '555750697', 'MALABO', 'ap000005', '2020-06-12 09:30:05'),
(65, 'EMILIA MIFUMU NGUNDI', '222044565', 'MALABO', 'ap000005', '2020-06-12 13:21:34'),
(66, 'Maria Teresa Eyang', '222226662', 'niefang', 'ap000003', '2020-06-15 08:06:10'),
(67, 'leona ayecaba andeme esono', '222604885', 'bata', 'ap000003', '2020-06-16 08:44:16'),
(68, 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '222004889', 'malabo', 'ap000005', '2020-06-16 12:44:48'),
(69, 'MARIA JOSEFA ERNESTINA ASUE  NDONG', '222004889', 'malabo', 'ap000005', '2020-06-16 12:50:45'),
(70, 'Tangui OWONO NGUEMA', '222004889', 'malabo', 'ap000005', '2020-06-18 15:01:05'),
(71, 'ANASTACIA SUAMA NZIE', '222206171', 'MALABO', 'ap000005', '2020-06-24 08:54:48'),
(72, 'CRISANTOS NGUEMA ASEMA', '555782530', 'NIEFANG', 'ap000007', '2020-07-08 09:50:51'),
(73, 'MARIA CARMEN NGUIE ONDO', '222696500', 'NIEFANG', 'ap000005', '2020-07-09 09:41:26'),
(74, 'RUBEN DARIO NZI EFUMAN', '222769092', 'MALABO', 'ap000005', '2020-07-09 10:17:39'),
(75, 'Trifonia Nsue', '222658263', 'bata', 'ap000004', '2020-07-09 15:51:14'),
(76, 'Santiago edjang', '555555553', 'Malabo', 'ap000008', '2020-07-12 10:42:24'),
(77, 'Margarita angue Nguema aseme', '2222685671', 'Malabo', 'ap000011', '2020-07-12 12:05:05'),
(78, 'Maria Soledad Andeme', '222514842', 'bata', 'ap000003', '2020-07-13 08:52:32'),
(79, 'antonio asila', '222371902', 'bata', 'ap000004', '2020-07-13 15:50:33'),
(81, 'leona ayecaba andeme esono', '22626486', 'bata', 'ap000004', '2020-07-15 13:40:29'),
(82, 'Miguel Nfa Nsi', '222683132', 'Nkimi', 'ap000002', '2020-07-27 11:47:03'),
(83, 'isabel ayi  nguema', '222786261', 'bata', 'ap000003', '2020-07-30 08:44:48'),
(84, 'TOMASA ABESO ABAGA', '222208139', 'BATA', 'ap000007', '2020-08-05 12:14:18'),
(85, 'TOMASA ABESO ABAGA', '222208139', 'BATA', 'ap000007', '2020-08-05 13:44:56'),
(86, 'anastasia asama nefuman', '222207485', 'bata', 'ap000004', '2020-08-06 13:36:10'),
(87, 'justina andeme ngua', '222198658', 'bata', 'ap000004', '2020-08-08 11:00:55'),
(88, 'TRINIDAD ABOGO NVO', '222352016', 'EBIBEYIN', 'ap000005', '2020-08-11 14:07:44'),
(89, 'cristina wuadalupe eyenga', '222781383', 'bata', 'ap000004', '2020-08-12 14:12:40'),
(90, 'LAMINE THIOR', '222712306', 'BATA', 'ap000003', '2020-08-17 09:05:11'),
(91, 'PERGENTINO NGUA NDONG ANDEME', '222767604', 'MALABO', 'ap000005', '2020-08-18 11:01:54'),
(92, 'Carina MBANG', '222257879', 'Ebibeyin', 'ap000003', '2020-08-18 11:07:28'),
(93, 'Moinses ALOGO OBAMA', '551376682', 'Ebibeyin', 'ap000003', '2020-08-18 11:18:21'),
(94, 'PEDRO ANTONIO ONDO NZE', '222721363', 'EBIBEYIN', 'ap000005', '2020-08-18 11:37:54'),
(95, 'Leona EYANG MITOGO', '222642201', 'BATA', 'ap000003', '2020-08-18 14:55:14'),
(96, 'Israel ESONO OKOMO', '222748269', 'ebibeyin', 'ap000003', '2020-08-19 13:12:23'),
(97, 'Trifonia NSUE MISIHI', '222658263', 'bata', 'ap000003', '2020-08-21 07:10:04'),
(98, 'Esperanza NCHAMA EVUNA', '222635894', 'bata', 'ap000003', '2020-08-24 07:49:27'),
(99, 'ANGEL NICANOR NKA ESONO', '555205312', 'MALABO', 'ap000005', '2020-08-24 12:11:43'),
(114, 'Validacion Miguel', '112233433', 'Kissss Validacion', 'ap001531', '2023-01-18 12:44:44'),
(115, 'Test MBA', '222589550', 'Aqui', 'ap001531', '2023-01-19 23:35:10');

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
(1, 'Malabo-Madrid', 'ida'),
(2, 'Madrid-Malabo', 'ida'),
(3, 'Malabo-Madrid-Malabo', 'ida y vuelta'),
(4, 'Madrid-Malabo-Madrid', 'ida y vuelta');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasas`
--

CREATE TABLE `tasas` (
  `idTasas` int(11) NOT NULL,
  `pais_origen` int(11) NOT NULL,
  `pais_destino` int(11) NOT NULL,
  `Descripcion` varchar(20) DEFAULT NULL,
  `Monto1` double DEFAULT NULL,
  `Monto2` double DEFAULT NULL,
  `MontoKILO` int(11) NOT NULL,
  `MontoSOBRE` int(11) NOT NULL,
  `comisiont` double DEFAULT NULL COMMENT 'Comision Tasas',
  `fecreat` datetime DEFAULT NULL,
  `agencrea` varchar(8) DEFAULT NULL,
  `femodit` date DEFAULT NULL,
  `agenmodif` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tasas`
--

INSERT INTO `tasas` (`idTasas`, `pais_origen`, `pais_destino`, `Descripcion`, `Monto1`, `Monto2`, `MontoKILO`, `MontoSOBRE`, `comisiont`, `fecreat`, `agencrea`, `femodit`, `agenmodif`) VALUES
(1, 1, 1, 'De 1000 a 50000', 1000, 50000, 0, 0, 2000, '2020-03-21 09:32:36', 'ap000002', NULL, ''),
(11, 1, 1, '', 50001, 100000, 0, 0, 2500, '2020-07-15 10:16:24', 'ap000002', NULL, 'ap001531'),
(12, 1, 1, 'DeDe 100001 a 200000', 100001, 200000, 0, 0, 3500, '2020-07-15 10:17:20', 'ap000002', NULL, 'ap001531'),
(13, 1, 1, 'De 200001 a 300000', 200001, 300000, 0, 0, 5000, '2020-07-15 10:18:26', 'ap000002', NULL, 'ap001531'),
(14, 1, 1, 'De 300001 a 400000', 300001, 400000, 0, 0, 7000, '2020-07-15 10:19:25', 'ap000002', NULL, 'ap001531'),
(15, 1, 1, 'De 400001 a 500000 T', 400001, 500000, 0, 0, 8000, '2020-07-15 10:20:10', 'ap000002', NULL, 'ap001531'),
(16, 0, 0, 'De 500001 a 600000', 500001, 600000, 0, 0, 8500, '2020-07-15 10:20:58', 'ap000002', NULL, ''),
(17, 1, 1, 'De 600001 a 700000', 600001, 700000, 0, 0, 9000, '2020-07-15 10:21:40', 'ap000002', NULL, ''),
(18, 1, 1, 'De 700001 a 800000', 700001, 800000, 0, 0, 10000, '2020-07-15 10:22:23', 'ap000002', NULL, ''),
(19, 1, 1, 'De 800001 a 900000', 800001, 900000, 0, 0, 12000, '2020-07-15 10:22:51', 'ap000002', NULL, ''),
(20, 0, 0, 'De 900001 a 1000000', 900001, 1000000, 0, 0, 15000, '2020-07-15 10:23:20', 'ap000002', NULL, ''),
(21, 1, 1, 'De 2000000 a 3000000', 2000000, 3000000, 0, 0, 55000, '2023-02-04 09:21:24', 'ap001531', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `idtransaccion` int(11) NOT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `remitente` varchar(10) DEFAULT NULL,
  `cuenta_remi` varchar(45) DEFAULT NULL,
  `receptor` int(11) DEFAULT NULL,
  `cuenta_recep` varchar(45) DEFAULT NULL,
  `ageenvia` int(11) DEFAULT NULL,
  `agerecibe` int(11) DEFAULT NULL,
  `pais_origen` int(11) DEFAULT NULL,
  `pais_destino` int(11) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL COMMENT 'Tipo de transaccion: 1->Divisas 2-> Paquete 3->Recarga, 4->Restituir 5-> Retiro Comisiones 6->Pagar comisiones',
  `monto` double DEFAULT NULL,
  `cobrar` double DEFAULT NULL,
  `comision` double DEFAULT NULL,
  `comi_empre` double DEFAULT NULL,
  `comi_remi` double DEFAULT NULL,
  `comi_benef` double DEFAULT NULL,
  `IVA` double DEFAULT NULL,
  `saldo_rescuenta` double DEFAULT NULL,
  `codigo` varchar(12) DEFAULT NULL,
  `codigo_ope` varchar(4) NOT NULL,
  `sentido` varchar(2) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL COMMENT 'La descripcion se usa y se muestra en lista envios cuando es un paquete o un envio con error o alguna observacion',
  `secreto` varchar(50) DEFAULT NULL,
  `sms_mobil` varchar(30) DEFAULT NULL,
  `estadot` varchar(20) DEFAULT NULL COMMENT 'Estados:Pendiente,Recibido,Cancelado,Revalidar',
  `objeto` varchar(50) DEFAULT NULL COMMENT 'Objeto que se hace mención ejemplo: CAJA:015',
  `agentcreat` varchar(8) DEFAULT NULL COMMENT 'Agente que Crea',
  `agenmod` varchar(8) DEFAULT NULL COMMENT 'Agente que modifica',
  `fecrea` datetime DEFAULT NULL COMMENT 'Fecha de creacion',
  `femodif` datetime DEFAULT NULL COMMENT 'Fecha de modificacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, `cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`, `cobrar`, `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`, `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`, `agenmod`, `fecrea`, `femodif`) VALUES
(6, NULL, '000000', '', 2, '', 1, 2, 0, 0, 1, 150000, 0, 6000, 0, 0, 0, 0, 0, 'ZVTMOD', '', '', 'ayuda familiar', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-03-30 17:02:03', '2020-03-30 17:02:57'),
(7, NULL, '000002', '', 7, '', 1, 14, 0, 0, 1, 25000, 0, 3000, 0, 0, 0, 0, 0, 'EWG8S3', '', '', 'Ayuda familiar', NULL, 'insertar_sms_mobile', 'Revalidar', NULL, 'ap000002', 'ap000004', '2020-03-31 12:04:05', '2020-05-05 13:30:37'),
(8, NULL, '077607', '', 8, '', 1, 2, 0, 0, 1, 100000, 0, 3000, 0, 0, 0, 0, 0, '3NP8LR', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-03-31 16:34:21', '2020-04-01 13:13:53'),
(9, NULL, '567843', '', 9, '', 1, 2, 0, 0, 1, 50000, 0, 3000, 0, 0, 0, 0, 0, '4MB4NZ', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-01 10:50:47', '2020-04-01 13:20:34'),
(10, NULL, '23456', '', 10, '', 1, 14, 0, 0, 1, 170000, 0, 6000, 0, 0, 0, 0, 0, 'S3V16K', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000006', '2020-04-01 11:00:41', '2020-04-03 11:58:44'),
(11, NULL, '367896', '', 11, '', 1, 2, 0, 0, 1, 150000, 0, 6000, 0, 0, 0, 0, 0, 'ALZQSG', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-01 12:07:57', '2020-04-01 13:21:02'),
(12, NULL, '1431461', '', 12, '', 1, 2, 0, 0, 1, 95000, 0, 3000, 0, 0, 0, 0, 0, 'EMOBRQ', '', '', 'ayuda famillar', NULL, 'sms_mobile copia', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-02 08:34:03', '2020-04-02 11:12:41'),
(13, NULL, '000000', '', 13, '', 1, 2, 0, 0, 1, 500000, 0, 15000, 0, 0, 0, 0, 0, '79V7SM', '', '', 'ayuda famillar', NULL, 'sms_mobile copia', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-02 08:47:41', '2020-04-02 11:09:27'),
(14, NULL, '000000', '', 2, '', 1, 14, 0, 0, 1, 200000, 0, 6000, 0, 0, 0, 0, 0, 'ZTDYEQ', '', '', 'ayuda famillar', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000006', '2020-04-02 08:54:27', '2020-04-03 11:58:00'),
(15, NULL, '0987', '', 14, '', 1, 2, 0, 0, 1, 85000, 0, 3000, 0, 0, 0, 0, 0, 'GAWDB8', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-02 09:09:08', '2020-04-02 10:49:03'),
(16, NULL, '84.229', '', 15, '', 2, 1, 0, 0, 1, 10, 0, 3000, 0, 0, 0, 0, 0, 'WY6D9Q', '', '', 'AYUDA FAMILIAR', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-04-02 12:22:04', '2020-04-03 08:06:32'),
(17, NULL, '000.116.04', '', 16, '', 3, 2, 0, 0, 1, 70, 0, 3000, 0, 0, 0, 0, 0, 'TV398V', '', '', 'Tes', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000007', 'ap000005', '2020-04-03 11:59:44', '2020-04-03 13:46:46'),
(18, NULL, '1424715', '', 17, '', 1, 2, 0, 0, 1, 130000, 0, 6000, 0, 0, 0, 0, 0, '3WHCFW', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-04-03 13:45:56', '2020-04-03 13:52:16'),
(19, NULL, '02', '', 18, '', 1, 2, 0, 0, 1, 50000, 0, 3000, 0, 0, 0, 0, 0, 'G2MQEZ', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-04-03 14:51:25', '2020-04-03 15:26:09'),
(20, NULL, '1.700.425', '', 19, '', 2, 1, 0, 0, 1, 42, 0, 3000, 0, 0, 0, 0, 0, 'PLEDEG', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-04-04 10:21:17', '2020-04-07 08:33:27'),
(21, NULL, 'x', '', 20, '', 2, 1, 0, 0, 1, 15, 0, 3000, 0, 0, 0, 0, 0, '0CFHQS', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-04-04 10:32:16', '2020-04-08 07:43:29'),
(22, NULL, '76978', '', 16, '', 2, 1, 0, 0, 1, 50000, 0, 3000, 0, 0, 0, 0, 0, '0JL6QT', '', '', 'test', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-04-04 13:09:47', '2020-04-04 13:11:50'),
(23, NULL, '028838', '', 21, '', 2, 3, 0, 0, 1, 30000, 0, 3000, 0, 0, 0, 0, 0, 'CYZL30', '', '', '', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000007', '2020-04-06 15:36:03', '2020-04-08 13:39:59'),
(24, NULL, '0987', '', 22, '', 1, 2, 0, 0, 1, 45000, 0, 3000, 0, 0, 0, 0, 0, 'MB5C0O', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-07 08:01:21', '2020-04-07 11:34:00'),
(25, NULL, '09876', '', 23, '', 1, 2, 0, 0, 1, 270000, 0, 9000, 0, 0, 0, 0, 0, 'C5VLK7', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-07 08:04:02', '2020-04-07 11:35:51'),
(26, NULL, '56432', '', 24, '', 1, 14, 0, 0, 1, 385000, 0, 12000, 0, 0, 0, 0, 0, 'CPZ9J3', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000006', '2020-04-07 08:05:41', '2020-04-08 09:47:20'),
(27, NULL, '547654', '', 25, '', 1, 14, 0, 0, 1, 240000, 0, 9000, 0, 0, 0, 0, 0, 'D26GRI', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000006', '2020-04-07 08:08:18', '2020-04-10 17:57:46'),
(28, NULL, '88287', '', 26, '', 1, 2, 0, 0, 1, 30000, 0, 3000, 0, 0, 0, 0, 0, 'OZ0DMV', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-07 08:28:19', '2020-04-07 11:36:18'),
(29, NULL, '6573', '', 27, '', 1, 14, 0, 0, 1, 50000, 0, 3000, 0, 0, 0, 0, 0, 'TF03RQ', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000006', '2020-04-07 09:16:45', '2020-04-10 17:54:16'),
(30, NULL, '6543', '', 28, '', 1, 2, 0, 0, 1, 40000, 0, 3000, 0, 0, 0, 0, 0, 'NMJMNS', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-07 10:00:41', '2020-04-07 11:37:15'),
(31, NULL, '345', '', 2, '', 1, 2, 0, 0, 1, 1220000, 0, 30000, 0, 0, 0, 0, 0, 'PYHI50', '', '', 'ayuda famillar', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-07 10:41:31', '2020-04-07 11:38:07'),
(32, NULL, '000.206.80', '', 30, '', 1, 14, 0, 0, 1, 25000, 0, 3000, 0, 0, 0, 0, 0, 'I2JSOM', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000006', '2020-04-07 12:53:13', '2020-04-10 17:54:49'),
(33, NULL, '93', '', 31, '', 1, 2, 0, 0, 1, 50000, 0, 3000, 0, 0, 0, 0, 0, '9A2ESL', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-04-07 14:07:24', '2020-04-07 16:14:23'),
(34, NULL, '23456', '', 32, '', 1, 2, 0, 0, 1, 100000, 0, 3000, 0, 0, 0, 0, 0, '1LPK0S', '', '', 'ayuda famillar', NULL, 'sms_mobile copia', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-08 07:26:06', '2020-04-08 11:42:05'),
(35, NULL, '110114', '', 33, '', 1, 3, 0, 0, 1, 90000, 0, 3000, 0, 0, 0, 0, 0, 'SF9DM6', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000007', '2020-04-09 13:40:58', '2020-04-13 12:07:56'),
(37, NULL, '000000', '', 9, '', 1, 2, 0, 0, 1, 200000, 0, 6000, 0, 0, 0, 0, 0, '77B1VF', '', '', 'ayuda famillar', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-04-13 09:40:14', '2020-04-13 11:06:35'),
(49, NULL, '1.700.425', '', 19, '', 2, 1, 0, 0, 1, 20000, 0, 3000, 0, 0, 0, 0, 0, 'C28K9H', '', '', 'ayuda famillar', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-05-05 14:19:23', '2020-05-07 13:39:25'),
(50, NULL, '0023456', '', 47, '', 1, 2, 0, 0, 1, 30000, 0, 3000, 0, 0, 0, 0, 0, 'VSLQKL', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-05-07 08:19:41', '2020-05-07 08:40:52'),
(54, NULL, '9800042', '', 51, '', 2, 1, 0, 0, 1, 35000, 0, 3000, 0, 0, 0, 0, 0, 'OOLQI4', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-05-12 14:20:14', '2020-07-29 10:15:15'),
(55, NULL, '1114110', '', 52, '', 3, 2, 0, 0, 1, 12000, 0, 3000, 0, 0, 0, 0, 0, 'ZMTSKO', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000007', 'ap000005', '2020-05-14 09:59:27', '2020-05-14 10:42:40'),
(56, NULL, 'X', '', 53, '', 2, 1, 0, 0, 1, 30000, 0, 3000, 0, 0, 0, 0, 0, 'HJTPTM', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-05-21 11:26:29', '2020-05-23 11:50:29'),
(57, NULL, '017920', '', 54, '', 2, 1, 0, 0, 1, 20000, 0, 3000, 0, 0, 0, 0, 0, 'GYBSWI', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-06-01 10:06:43', '2020-06-18 16:25:38'),
(58, NULL, '00', '', 55, '', 2, 1, 0, 0, 1, 70000, 0, 3000, 0, 0, 0, 0, 0, 'FMQPQN', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-06-01 10:15:00', '2020-06-01 10:44:47'),
(59, NULL, '04', '', 57, '', 1, 2, 0, 0, 1, 67000, 0, 3000, 0, 0, 0, 0, 0, '397MZ6', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-06-06 12:57:00', '2020-06-08 09:25:30'),
(60, NULL, '000.116.63', '', 58, '', 1, 2, 0, 0, 1, 40000, 0, 3000, 0, 0, 0, 0, 0, 'SVVGVG', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-06-08 12:43:48', '2020-06-09 09:40:22'),
(61, NULL, '000', '', 59, '', 2, 1, 0, 0, 1, 25000, 0, 3000, 0, 0, 0, 0, 0, 'PLS3WE', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-06-08 13:45:23', '2020-06-18 16:20:55'),
(62, NULL, 'XX', '', 60, '', 2, 1, 0, 0, 1, 100000, 0, 3000, 0, 0, 0, 0, 0, 'NSW25E', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-06-09 08:46:45', '2020-06-09 11:10:28'),
(63, NULL, '000', '', 59, '', 2, 1, 0, 0, 1, 25000, 0, 3000, 0, 0, 0, 0, 0, 'FV76CZ', '', '', '', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-06-09 09:01:09', '2020-06-18 16:15:55'),
(64, NULL, '00987', '', 61, '', 1, 2, 0, 0, 1, 30000, 0, 3000, 0, 0, 0, 0, 0, 'MOTQLM', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-06-09 10:13:02', '2020-06-09 10:54:52'),
(65, NULL, '09547', '', 62, '', 1, 2, 0, 0, 1, 40000, 0, 3000, 0, 0, 0, 0, 0, 'ORL997', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-06-12 08:59:41', '2020-06-12 09:46:08'),
(66, NULL, '84564', '', 63, '', 1, 2, 0, 0, 1, 40000, 0, 3000, 0, 0, 0, 0, 0, 'JGSYFL', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-06-12 09:12:03', '2020-06-12 09:43:59'),
(67, NULL, '000', '', 64, '', 2, 1, 0, 0, 1, 20000, 0, 3000, 0, 0, 0, 0, 0, '3E4Q5M', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-06-12 09:30:06', '2020-06-15 12:06:27'),
(68, NULL, '00000', '', 65, '', 2, 1, 0, 0, 1, 20000, 0, 3000, 0, 0, 0, 0, 0, 'EH8SD4', '', '', 'AYUDA FAMILIAR', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-06-12 13:21:34', '2020-06-13 13:26:44'),
(69, NULL, '90876', '', 66, '', 1, 14, 0, 0, 1, 150000, 0, 6000, 0, 0, 0, 0, 0, 'RQIVOT', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Revalidar', NULL, 'ap000003', 'ap001531', '2020-06-15 08:06:10', '2023-01-17 04:27:34'),
(70, NULL, '23416', '', 67, '', 1, 2, 0, 0, 1, 60000, 0, 3000, 0, 0, 0, 0, 0, 'WIYP6W', '', '', 'ayuda familla', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-06-16 08:44:16', '2020-06-16 09:54:46'),
(71, NULL, '000', '', 68, '', 2, 1, 0, 0, 1, 70000, 0, 3000, 0, 0, 0, 0, 0, 'MMOM7Q', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-06-16 12:44:48', '2020-06-18 16:14:02'),
(72, NULL, 'xx', '', 69, '', 2, 1, 0, 0, 1, 70000, 0, 3000, 0, 0, 0, 0, 0, '29LEEZ', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-06-16 12:50:45', '2020-06-18 16:12:12'),
(73, NULL, '9800042', '', 70, '', 2, 1, 0, 0, 1, 30000, 0, 3000, 0, 0, 0, 0, 0, 'OV2QLQ', '', '', 'ayuda famillar', NULL, 'sms_mobile copia', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-06-18 15:01:05', '2020-06-19 12:43:41'),
(74, NULL, 'XXX', '', 71, '', 2, 1, 0, 0, 1, 100000, 0, 3000, 0, 0, 0, 0, 0, '5S58LB', '', '', 'AYUDA FAMILIAR', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000003', '2020-06-24 08:54:48', '2020-07-07 07:41:50'),
(75, NULL, '114060', '', 72, '', 3, 14, 0, 0, 1, 70, 0, 3000, 0, 0, 0, 0, 0, 'Z9RQ08', '', '', 'NIEFANG', NULL, 'insertar_sms_mobile', 'Pendiente', NULL, 'ap000007', NULL, '2020-07-08 09:50:51', NULL),
(76, NULL, 'XXX', '', 73, '', 2, 1, 0, 0, 1, 60000, 0, 3000, 0, 0, 0, 0, 0, '152QTC', '', '', 'ayuda famillar', NULL, 'sms_mobile copia', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-07-09 09:41:26', '2020-07-10 15:47:31'),
(77, NULL, '002309979', '', 74, '', 2, 1, 0, 0, 1, 15000, 0, 3000, 0, 0, 0, 0, 0, 'VJMQV0', '', '', 'AYUDA FAMILIAR', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000005', 'ap000004', '2020-07-09 10:17:39', '2020-07-09 12:49:15'),
(78, NULL, '10071027', '', 75, '', 1, 2, 0, 0, 1, 20000, 0, 3000, 0, 0, 0, 0, 0, '3V7MPJ', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-07-09 15:51:14', '2020-07-10 08:27:58'),
(79, NULL, '09080706', '', 76, '', 14, 3, 0, 0, 1, 300000, 0, 9000, 0, 0, 0, 0, 0, '32SDLG', '', '', 'Ayuda financiera', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000008', 'ap000007', '2020-07-12 10:42:24', '2020-07-12 10:45:15'),
(80, NULL, '00317140', '', 77, '', 14, 1, 0, 0, 1, 50000, 0, 3000, 0, 0, 0, 0, 0, '7LQRKS', '', '', '', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000011', 'ap000002', '2020-07-12 12:05:05', '2020-07-15 13:40:33'),
(81, NULL, '88287', '', 78, '', 1, 2, 0, 0, 1, 60000, 0, 3000, 0, 0, 0, 0, 0, 'AZZQO0', '', '', 'ayuda famillar', NULL, 'sms_mobile copia', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-07-13 08:52:32', '2020-07-13 09:12:26'),
(82, NULL, '00', '', 79, '', 1, 2, 0, 0, 1, 100000, 0, 3000, 0, 0, 0, 0, 0, 'SPNHR2', '', '', 'ayuda familla', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-07-13 15:50:33', '2020-07-14 10:01:52'),
(83, NULL, '000134095', '', 80, '', 3, 14, 0, 0, 1, 15000, 0, 3000, 0, 0, 0, 0, 0, 'CQQ644', '', '', 'AYUDA FAMILLAR', NULL, 'insertar_sms_mobile', 'Pendiente', NULL, 'ap000007', NULL, '2020-07-14 11:37:52', NULL),
(84, NULL, '0014238', '', 81, '', 1, 2, 0, 0, 1, 50000, 0, 2000, 0, 0, 0, 0, 0, '00J2GZ', '', '', 'ayuda famillar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-07-15 13:40:29', '2020-07-15 13:56:34'),
(85, NULL, '102938', '', 82, '', 1, 14, 0, 0, 1, 33000, 0, 2000, 0, 0, 0, 0, 0, '8VYVNH', '', '', 'Ayuda familiar', NULL, 'insertar_sms_mobile', 'Pendiente', NULL, 'ap000002', NULL, '2020-07-27 11:47:03', NULL),
(86, NULL, '89763', '', 83, '', 1, 2, 0, 0, 1, 15000, 0, 2000, 0, 0, 0, 0, 0, '9SL3TP', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-07-30 08:44:48', '2020-07-30 09:17:39'),
(87, NULL, '100040', '', 84, '', 3, 1, 0, 0, 1, 152000, 0, 3500, 0, 0, 0, 0, 0, 'P4QEZG', '', '', 'AYUDA FAMILLIA', NULL, 'insertar_sms_mobile', 'Revalidar', NULL, 'ap000007', 'ap000007', '2020-08-05 12:14:18', '2020-08-05 12:35:23'),
(88, NULL, '114060', '', 85, '', 3, 2, 0, 0, 1, 152000, 0, 3500, 0, 0, 0, 0, 0, 'KW65L6', '', '', 'AYUDA FAMILLIA', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000007', 'ap000005', '2020-08-05 13:44:56', '2020-08-05 14:26:28'),
(89, NULL, '1111601', '', 86, '', 1, 2, 0, 0, 1, 120000, 0, 3500, 0, 0, 0, 0, 0, 'SKMASV', '', '', 'ayuda familiar', NULL, 'sms_mobile copia', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-08-06 13:36:10', '2020-08-07 09:02:01'),
(90, NULL, '116.631', '', 87, '', 1, 2, 0, 0, 1, 140000, 0, 3500, 0, 0, 0, 0, 0, 'JZ9Z4S', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-08-08 11:00:55', '2020-08-10 11:11:27'),
(91, NULL, '0000', '', 88, '', 2, 1, 0, 0, 1, 40000, 0, 2000, 0, 0, 0, 0, 0, '3VQICL', '', '', 'AYUDA FAMILIAR', NULL, 'insertar_sms_mobile', 'Pendiente', NULL, 'ap000005', NULL, '2020-08-11 14:07:44', NULL),
(92, NULL, '1122558', '', 89, '', 1, 2, 0, 0, 1, 100000, 0, 2500, 0, 0, 0, 0, 0, 'M9QMFV', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000004', 'ap000005', '2020-08-12 14:12:40', '2020-08-12 15:54:40'),
(93, NULL, '84564', '', 63, '', 1, 2, 0, 0, 1, 100000, 0, 2500, 0, 0, 0, 0, 0, 'IZ9SGR', '', '', 'ayuda familiar', NULL, 'solo_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-08-13 09:23:11', '2020-08-13 12:51:26'),
(94, NULL, '734195', '', 90, '', 1, 2, 0, 0, 1, 196500, 0, 3500, 0, 0, 0, 0, 0, 'M5YN2J', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000005', '2020-08-17 09:05:11', '2020-08-17 13:39:52'),
(95, NULL, '000', '', 91, '', 2, 1, 0, 0, 1, 19000, 0, 2000, 0, 0, 0, 0, 0, '777', '', '', 'AYUDA FAMILIAR', NULL, 'insertar_sms_mobile', 'Pendiente', NULL, 'ap000005', 'ap000003', '2020-08-18 11:01:54', '2020-08-18 11:24:03'),
(96, NULL, '08765', '', 92, '', 1, 3, 0, 0, 1, 35000, 0, 2000, 0, 0, 0, 0, 0, 'VE7BOH', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000007', '2020-08-18 11:07:28', '2020-08-20 11:14:46'),
(97, NULL, '08765', '', 93, '', 1, 3, 0, 0, 1, 25000, 0, 2000, 0, 0, 0, 0, 0, 'KBLH90', '', '', 'ayuda familiar', NULL, 'insertar_sms_mobile', 'Recibido', NULL, 'ap000003', 'ap000007', '2020-08-18 11:18:21', '2020-08-19 09:34:50'),
(117, 'HZFFJ53M', '12121212', '3721212121201', 1104779, '37200110477901', 15, 15, 1, 1, 3, 50000, 0, NULL, NULL, NULL, NULL, NULL, NULL, '7LSWBG', '004', 'C', 'Recarga caja 01', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-16 13:14:20', NULL),
(118, 'GB0EH46T', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, '1ZNJKI', '004', 'C', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 01:38:30', NULL),
(119, 'GB0EH46T', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, '1ZNJKI', '004', 'D', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 01:38:30', NULL),
(120, '93P01D3C', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 250000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'AG5O8S', '004', 'C', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 01:46:32', NULL),
(121, '93P01D3C', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 250000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'AG5O8S', '004', 'D', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 01:46:32', NULL),
(122, 'YQII17JL', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'LD7167', '004', 'C', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 02:11:55', NULL),
(123, 'YQII17JL', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'LD7167', '004', 'D', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 02:11:55', NULL),
(124, 'QH9GYTQQ', '12121212', '3721212121201', 1104779, '37200110477901', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'R0EQ03', '004', 'C', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 02:17:12', NULL),
(125, 'QH9GYTQQ', '12121212', '3721212121201', 1104779, '37200110477901', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'R0EQ03', '004', 'D', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 02:17:12', NULL),
(126, 'WQPS4NTV', '12121212', '3721212121201', 1104779, '37200110477901', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ZYQTCI', '004', 'C', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 02:18:45', NULL),
(127, 'WQPS4NTV', '12121212', '3721212121201', 1104779, '37200110477901', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'ZYQTCI', '004', 'D', 'Test', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 02:18:45', NULL),
(128, 'FJKQL4F4', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 200000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'GN8H74', '004', 'C', 'TEst', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 03:28:29', NULL),
(129, 'FJKQL4F4', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 200000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'GN8H74', '004', 'D', 'TEst', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 03:28:29', NULL),
(130, '9A4368V6', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, '6ZSAFW', '004', 'C', 'Recarga caja 01', NULL, 'sin sms movil', 'Recibido', '3', 'ap001531', NULL, '2023-01-17 04:20:31', NULL),
(131, '9A4368V6', '001104779', '37200110477901', 12121212, '3721212121201', 15, 15, 1, 1, 3, 150000, 0, NULL, NULL, NULL, NULL, NULL, NULL, '6ZSAFW', '004', 'D', 'Recarga caja 01', NULL, 'sin sms movil', 'Pendiente', '3', 'ap001531', NULL, '2023-01-17 04:20:31', NULL),
(133, 'YM7YOWZA', '12121212', NULL, 115, NULL, 1, 1, 1, 1, 1, 60000, 57500, 2500, 850, 637.5, 637.5, 375, 225000, '999', '001', 'D', 'ayuda famillar', '8888', 'insertar_sms_mobile', 'Pendiente', '', 'ap001531', 'ap001531', '2023-01-18 11:16:55', '2023-01-24 13:02:32'),
(144, '318629126026', '1000000001', '372100000000101', 44444444, '3724444444401', 1, 1, 1, 1, 3, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59661715', '002', 'C', 'Recarga AGENCIA', NULL, 'sin sms movil', 'Recibido', '1', 'ap001531', NULL, '2023-01-20 13:30:33', NULL),
(145, '318629126026', '1000000001', '372100000000101', 44444444, '3724444444401', 1, 1, 1, 1, 3, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59661715', '002', 'D', 'Recarga AGENCIA', NULL, 'sin sms movil', 'Recibido', '1', 'ap001531', NULL, '2023-01-20 13:30:33', NULL),
(158, '647709021258', '44444444', '9994444444401', 44444444, '9994444444401', 1, 1, 1, 1, 1, 800, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '87785913', '000', 'C', 'Banco', NULL, 'sin sms movil RECARGA BANCO', 'Recibido', '1', 'ap001531', NULL, '2023-02-01 12:58:59', NULL),
(159, '032885154208', '44444444', '9994444444401', 44444444, '9994444444401', 1, 1, 1, 1, 1, 5500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86487651', '000', 'C', 'Mas UV Banco', NULL, 'sin sms movil RECARGA BANCO', 'Recibido', '1', 'ap001531', NULL, '2023-02-01 13:05:08', NULL),
(160, '667578855792', '44444444', '9994444444401', 44444444, '9994444444401', 1, 1, 1, 1, 1, 5500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83193718', '000', 'C', 'Mas UV', NULL, 'sin sms movil RECARGA BANCO', 'Recibido', '1', 'ap001531', NULL, '2023-02-01 13:06:59', NULL),
(161, '448341795873', '44444444', '9994444444401', 44444444, '9994444444401', 1, 1, 1, 1, 1, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59816462', '000', 'C', 'Mas capital', NULL, 'sin sms movil RECARGA BANCO', 'Recibido', '1', 'ap001531', NULL, '2023-02-01 14:35:13', NULL),
(163, '666554941558', '44444444', '9994444444401', 44444444, '9994444444401', 1, 1, 1, 1, 1, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33257542', '000', 'C', 'myyy', NULL, 'sin sms movil RECARGA BANCO', 'Recibido', '1', 'ap001531', NULL, '2023-02-01 15:29:06', NULL),
(164, '837372117545', '1000000001', '3721A00000000101', 44444444, '3724444444401', 1, 1, 1, 1, 9, 3500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70282934', '009', 'C', 'Aprov Comercial MBA', NULL, 'sin sms movil', 'Recibido', '', 'ap001531', NULL, '2023-02-07 17:37:54', NULL),
(165, '837372117545', '1000000001', '3721A00000000101', 44444444, '3724444444401', 1, 1, 1, 1, 1, 3500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70282934', '009', 'D', 'Aprov Comercial MBA', NULL, 'sin sms movil', 'Recibido', '', 'ap001531', NULL, '2023-02-07 17:37:54', NULL),
(166, '912383391941', '1000000001', '3721A00000000101', 12121212, '3721212121201', 1, 15, 1, 1, 1, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42522066', '008', 'C', 'Añadir UV al Comercial', NULL, 'sin sms movil', 'Recibido', '4', 'ap001531', NULL, '2023-02-07 21:58:50', NULL),
(167, '912383391941', '1000000001', '3721A00000000101', 12121212, '3721212121201', 1, 15, 1, 1, 1, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42522066', '008', 'D', 'Añadir UV al Comercial', NULL, 'sin sms movil', 'Recibido', '4', 'ap001531', NULL, '2023-02-07 21:58:50', NULL),
(168, '523965422255', '12121212', '3721212121201', 1000000001, '3721A00000000101', 15, 1, 1, 1, 10, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39191652', '010', 'C', 'Restituir UV', NULL, 'sin sms movil', 'Recibido', '4', 'ap001531', NULL, '2023-02-07 23:31:58', NULL),
(169, '523965422255', '12121212', '3721212121201', 1000000001, '3721A00000000101', 15, 1, 1, 1, 10, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39191652', '010', 'D', 'Restituir UV', NULL, 'sin sms movil', 'Recibido', '4', 'ap001531', NULL, '2023-02-07 23:31:58', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agencias`
--
ALTER TABLE `agencias`
  ADD PRIMARY KEY (`idagencia`);

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`idbanco`);

--
-- Indices de la tabla `bancocomercial`
--
ALTER TABLE `bancocomercial`
  ADD PRIMARY KEY (`idbancoc`);

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
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`idCaja`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`DNIremitente`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`numerocuenta`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idempleado`);

--
-- Indices de la tabla `ingresos_gastos`
--
ALTER TABLE `ingresos_gastos`
  ADD PRIMARY KEY (`iding_gas`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `permiso_empleado`
--
ALTER TABLE `permiso_empleado`
  ADD PRIMARY KEY (`id_permisoempleado`);

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
  ADD KEY `fk_Transaccion_Agencias1_idx` (`ageenvia`),
  ADD KEY `fk_Transaccion_Agencias2_idx` (`agerecibe`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agencias`
--
ALTER TABLE `agencias`
  MODIFY `idagencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `idbanco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bancocomercial`
--
ALTER TABLE `bancocomercial`
  MODIFY `idbancoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `billetes`
--
ALTER TABLE `billetes`
  MODIFY `idbillete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bkhis`
--
ALTER TABLE `bkhis`
  MODIFY `idbkhis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `idCaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `ingresos_gastos`
--
ALTER TABLE `ingresos_gastos`
  MODIFY `iding_gas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `permiso_empleado`
--
ALTER TABLE `permiso_empleado`
  MODIFY `id_permisoempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT de la tabla `receptor`
--
ALTER TABLE `receptor`
  MODIFY `idreceptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `idruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idsolicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tasas`
--
ALTER TABLE `tasas`
  MODIFY `idTasas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `idtransaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

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
  ADD CONSTRAINT `fk_permiso_empleado_empleados1` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`idempleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permiso_has_Empleados_permiso1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_Transaccion_Agencias2` FOREIGN KEY (`agerecibe`) REFERENCES `agencias` (`idagencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
