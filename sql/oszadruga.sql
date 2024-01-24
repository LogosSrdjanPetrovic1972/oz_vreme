-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2010 at 06:29 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oszadruga`
--

-- --------------------------------------------------------

--
-- Table structure for table `oszcontract2010`
--

CREATE TABLE IF NOT EXISTS `oszcontract2010` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDEmployer` int(11) NOT NULL,
  `contractnumber` int(11) DEFAULT NULL,
  `contractdate` date DEFAULT NULL,
  `contractfrom` date NOT NULL,
  `contractto` date NOT NULL,
  `hours` varchar(5) NOT NULL,
  `jobdescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `oszcontract2010`
--

INSERT INTO `oszcontract2010` (`ID`, `IDEmployer`, `contractnumber`, `contractdate`, `contractfrom`, `contractto`, `hours`, `jobdescription`) VALUES
(1, 20, NULL, '2010-01-11', '2009-12-01', '2009-12-31', '', 'Rad na pepelištu za mesec decembar 2009.'),
(2, 20, NULL, '2010-01-12', '2009-12-01', '2009-12-31', '', 'higijeničarski poslovi na Đerdapu za mesec decembar 2009. '),
(3, 20, NULL, '2010-01-12', '2009-12-01', '2009-12-12', '', 'higijeničarski poslovi za mesec decembar 2009.'),
(4, 20, NULL, '2010-01-12', '2009-12-01', '2009-12-31', '', 'higijeničarski poslovi za mesec decembar 2009.'),
(5, 41, NULL, '2010-01-13', '2009-12-01', '2009-12-31', '', 'administrativni poslovi'),
(6, 39, NULL, '2010-01-13', '2009-12-01', '2009-12-31', '', 'higijeničarski poslovi'),
(7, 42, NULL, '2010-01-18', '2010-01-04', '2010-01-15', '', 'pomocni poslovi u inkubatorskoj stanici'),
(8, 12, NULL, '2010-01-18', '2009-10-01', '2009-10-31', '', 'obavljanje fizičkih poslova u RJ'),
(9, 43, NULL, '2010-01-18', '2010-01-04', '2010-01-15', '', 'rad u stručnoj službi');

-- --------------------------------------------------------

--
-- Table structure for table `oszcontract2011`
--

CREATE TABLE IF NOT EXISTS `oszcontract2011` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDEmployer` int(11) NOT NULL,
  `contractnumber` int(11) DEFAULT NULL,
  `contractdate` date DEFAULT NULL,
  `contractfrom` date NOT NULL,
  `contractto` date NOT NULL,
  `hours` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `jobdescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `oszcontract2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszcontractitem2010`
--

CREATE TABLE IF NOT EXISTS `oszcontractitem2010` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDContract` int(11) NOT NULL,
  `IDMember` int(11) NOT NULL,
  `net` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDContract` (`IDContract`,`IDMember`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `oszcontractitem2010`
--

INSERT INTO `oszcontractitem2010` (`ID`, `IDContract`, `IDMember`, `net`) VALUES
(1, 1, 9, 20472.12),
(2, 1, 8, 20472.12),
(3, 1, 7, 20472.12),
(4, 1, 6, 23704.56),
(5, 1, 5, 23704.56),
(6, 1, 4, 23704.56),
(7, 1, 3, 22627.08),
(8, 1, 2, 22627.08),
(9, 1, 1, 22627.08),
(10, 2, 10, 9500),
(11, 3, 11, 8000),
(12, 4, 12, 10000),
(13, 5, 13, 30000),
(14, 6, 14, 8000),
(15, 7, 15, 7000),
(22, 8, 19, 10790),
(24, 8, 17, 8216),
(23, 8, 16, 5840),
(25, 8, 18, 9260),
(27, 9, 20, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `oszcontractitem2011`
--

CREATE TABLE IF NOT EXISTS `oszcontractitem2011` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDContract` int(11) NOT NULL,
  `IDMember` int(11) NOT NULL,
  `net` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDContract` (`IDContract`,`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `oszcontractitem2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszcooperative`
--

CREATE TABLE IF NOT EXISTS `oszcooperative` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDPlace` smallint(6) DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pib` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idnumber` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `currentyear` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `name` (`name`),
  KEY `IDPlace` (`IDPlace`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `oszcooperative`
--

INSERT INTO `oszcooperative` (`ID`, `name`, `address`, `IDPlace`, `phone`, `mobile`, `fax`, `email`, `url`, `account`, `reference`, `pib`, `idnumber`, `activity`, `currentyear`) VALUES
(1, 'Omladinska Zadruga "VREME"', 'SVETOG SAVE 19D', 59, '(026)319-511', '(063)289.022', '(026)319-511', '', '', '170-003008420001-19', '355-1023876-05', '101928789', '7844069', '74840', '2010');

-- --------------------------------------------------------

--
-- Table structure for table `oszdocument2010`
--

CREATE TABLE IF NOT EXISTS `oszdocument2010` (
  `IDMember` int(11) NOT NULL,
  `document` varchar(20) NOT NULL,
  `publisher` varchar(70) NOT NULL,
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oszdocument2010`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszdocument2011`
--

CREATE TABLE IF NOT EXISTS `oszdocument2011` (
  `IDMember` int(11) NOT NULL,
  `document` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `publisher` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oszdocument2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszemployer`
--

CREATE TABLE IF NOT EXISTS `oszemployer` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDPlace` smallint(6) DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pib` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idnumber` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `name` (`name`),
  KEY `IDPlace` (`IDPlace`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `oszemployer`
--

INSERT INTO `oszemployer` (`ID`, `name`, `address`, `IDPlace`, `phone`, `mobile`, `fax`, `email`, `url`, `account`, `pib`, `idnumber`) VALUES
(1, 'ALEX-TRAVEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'BOKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'BOLNICA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'DEUS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'ELDON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'GOŠA FOM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'GALIJA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'GOŠA INSTITUT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'GRACIJA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'HLADNJAČA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'INSTITUT ZA POVRTARSTVO D.O.O.', 'Karađorđeva 71', 59, '', '', '', '', '', '', '104684345', ''),
(12, 'JKP "MIKULJA"', 'Francuska 21', 59, '', '', '', '', '', '', '101929402', ''),
(13, 'JRDNP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'KATASTAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'KC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'KK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'KLANICA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'KRAJSER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'MLINPEK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'GOŠA MONTAŽA A.D.', '28 Oktobra 65', 70, '', '', '', '', '', '', '101974895', ''),
(21, 'MZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'NIK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'OPEKA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'POLJOPRIVREDA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'GOŠA ŠINSKA VOZILA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'SPIRALOGRAF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'STR ŠUMADIJA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'TIME', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'VETERINARSKA APOTEKA SVETI VRAČI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'VOĆAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'ŽIVINARSTVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'ZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '"VOĆAR S & M" D.O.O.', 'Maksima Gorkog bb', 59, '', '', '', '', '', '', '104363359', ''),
(38, 'GOŠA ZAŠTINA "SOLKO" D.O.O.', '', 59, '', '', '', '', '', '', '101930224', ''),
(39, '"NEW YORK TRADE" D.O.O.', 'Koste Glavinica 2', 9, '', '', '', '', '', '', '100267737', ''),
(40, 'ELEKTROMORAVA', 'Radmile Šišković', 59, '', '', '', '', '', '', '104196924', ''),
(41, '"PROKUPAC" A.D.', 'Kumodraška 263a', 9, '', '', '', '', '', '', '105774069', ''),
(42, '"PILE BRO" D.O.O.', 'Svetog Save 19', 59, '', '', '', '', '', '', '104692358', ''),
(43, 'Omladinska Zadruga "VREME"', 'Svetog Save 19d', 59, '026319511', '', '', '', '', '', '101928789', '');

-- --------------------------------------------------------

--
-- Table structure for table `oszinvoice2010`
--

CREATE TABLE IF NOT EXISTS `oszinvoice2010` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDContract` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `net` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `contribute` double NOT NULL DEFAULT '0',
  `claimsum` double NOT NULL DEFAULT '0',
  `cooperative` double NOT NULL DEFAULT '0',
  `sum` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDContract` (`IDContract`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `oszinvoice2010`
--

INSERT INTO `oszinvoice2010` (`ID`, `IDContract`, `date`, `net`, `tax`, `contribute`, `claimsum`, `cooperative`, `sum`) VALUES
(1, 1, '2010-01-11', 200411.28, 34307.220588, 102349.874755, 337068.375344, 20041.128, 357109.503344),
(2, 2, '2010-01-12', 9500, 1626.24876, 4851.642134, 15977.890894, 950, 16927.890894),
(3, 3, '2010-01-12', 8000, 1369.47264, 4085.593376, 13455.066016, 800, 14255.066016),
(4, 4, '2010-01-12', 10000, 1711.8408, 5106.99172, 16818.83252, 1000, 17818.83252),
(5, 5, '2010-01-13', 30000, 3185.8416, 1991.151, 35176.9926, 3000, 38176.9926),
(6, 6, '2010-01-13', 8000, 1369.47264, 4085.593376, 13455.066016, 800, 14255.066016),
(7, 7, '2010-01-19', 7000, 743.36304, 464.6019, 8207.96494, 700, 8907.96494),
(8, 8, '2010-01-18', 34106, 5838.404232, 17417.90596, 57362.310193, 3410.6, 60772.910193),
(9, 9, '2010-01-19', 5000, 530.9736, 331.8585, 5862.8321, 500, 6362.8321);

-- --------------------------------------------------------

--
-- Table structure for table `oszinvoice2011`
--

CREATE TABLE IF NOT EXISTS `oszinvoice2011` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `net` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `contribute` double NOT NULL DEFAULT '0',
  `claimsum` double NOT NULL DEFAULT '0',
  `cooperative` double NOT NULL DEFAULT '0',
  `sum` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `oszinvoice2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszinvoicecontractitem2010`
--

CREATE TABLE IF NOT EXISTS `oszinvoicecontractitem2010` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDInvoice` int(11) NOT NULL DEFAULT '0',
  `IDContract` int(11) NOT NULL DEFAULT '0',
  `IDMember` int(11) NOT NULL DEFAULT '0',
  `net` double NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDInvoice` (`IDInvoice`),
  KEY `IDContract` (`IDContract`),
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `oszinvoicecontractitem2010`
--

INSERT INTO `oszinvoicecontractitem2010` (`ID`, `IDInvoice`, `IDContract`, `IDMember`, `net`, `value`) VALUES
(1, 1, 1, 1, 22627.08, 32278.298941),
(2, 1, 1, 2, 22627.08, 32278.298941),
(3, 1, 1, 3, 22627.08, 32278.298941),
(4, 1, 1, 4, 23704.56, 33815.360795),
(5, 1, 1, 5, 23704.56, 33815.360795),
(6, 1, 1, 6, 23704.56, 33815.360795),
(7, 1, 1, 7, 20472.12, 29204.175232),
(8, 1, 1, 8, 20472.12, 29204.175232),
(9, 1, 1, 9, 20472.12, 29204.175232),
(10, 2, 2, 10, 9500, 13552.073),
(11, 3, 3, 11, 8000, 11412.272),
(12, 4, 4, 12, 10000, 14265.34),
(13, 5, 5, 13, 30000, 33185.88),
(14, 6, 6, 14, 8000, 11412.272),
(23, 7, 7, 15, 7000, 7743.372),
(16, 8, 8, 16, 5840, 8330.95856),
(17, 8, 8, 17, 8216, 11720.403344),
(18, 8, 8, 18, 9260, 13209.70484),
(19, 8, 8, 19, 10790, 15392.30186),
(22, 9, 9, 20, 5000, 5530.98);

-- --------------------------------------------------------

--
-- Table structure for table `oszinvoicecontractitem2011`
--

CREATE TABLE IF NOT EXISTS `oszinvoicecontractitem2011` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDInvoice` int(11) NOT NULL DEFAULT '0',
  `IDContract` int(11) NOT NULL DEFAULT '0',
  `IDMember` int(11) NOT NULL DEFAULT '0',
  `net` double NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `oszinvoicecontractitem2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszinvoiceitem2010`
--

CREATE TABLE IF NOT EXISTS `oszinvoiceitem2010` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDInvoice` int(11) NOT NULL DEFAULT '0',
  `IDInvoiceRuleDef` int(11) NOT NULL DEFAULT '0',
  `net` tinyint(4) NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDInvoice` (`IDInvoice`),
  KEY `IDInvoiceRuleDef` (`IDInvoiceRuleDef`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=175 ;

--
-- Dumping data for table `oszinvoiceitem2010`
--

INSERT INTO `oszinvoiceitem2010` (`ID`, `IDInvoice`, `IDInvoiceRuleDef`, `net`, `value`) VALUES
(1, 1, 0, 1, 200411.28),
(2, 1, 13, 0, 285893.504904),
(3, 1, 14, 0, 31448.285539),
(4, 1, 15, 0, 17582.450552),
(5, 1, 16, 0, 2144.201287),
(6, 1, 17, 0, 51174.937378),
(7, 1, 18, 0, 31448.285539),
(8, 1, 19, 0, 17582.450552),
(9, 1, 20, 0, 2144.201287),
(10, 1, 21, 0, 51174.937378),
(11, 1, 22, 0, 34307.220588),
(12, 1, 23, 0, 102349.874755),
(13, 1, 24, 0, 20041.128),
(14, 1, 27, 0, 337068.375344),
(15, 1, 25, 0, 357109.503344),
(16, 1, 26, 0, 357109.252429),
(17, 2, 0, 1, 9500),
(18, 2, 13, 0, 13552.073),
(19, 2, 14, 0, 1490.72803),
(20, 2, 15, 0, 833.45249),
(21, 2, 16, 0, 101.640547),
(22, 2, 17, 0, 2425.821067),
(23, 2, 18, 0, 1490.72803),
(24, 2, 19, 0, 833.45249),
(25, 2, 20, 0, 101.640547),
(26, 2, 21, 0, 2425.821067),
(27, 2, 22, 0, 1626.24876),
(28, 2, 23, 0, 4851.642134),
(29, 2, 24, 0, 950),
(30, 2, 27, 0, 15977.890894),
(31, 2, 25, 0, 16927.890894),
(32, 2, 26, 0, 16927.879),
(33, 3, 0, 1, 8000),
(34, 3, 13, 0, 11412.272),
(35, 3, 14, 0, 1255.34992),
(36, 3, 15, 0, 701.854728),
(37, 3, 16, 0, 85.59204),
(38, 3, 17, 0, 2042.796688),
(39, 3, 18, 0, 1255.34992),
(40, 3, 19, 0, 701.854728),
(41, 3, 20, 0, 85.59204),
(42, 3, 21, 0, 2042.796688),
(43, 3, 22, 0, 1369.47264),
(44, 3, 23, 0, 4085.593376),
(45, 3, 24, 0, 800),
(46, 3, 27, 0, 13455.066016),
(47, 3, 25, 0, 14255.066016),
(48, 3, 26, 0, 14255.056),
(49, 4, 0, 1, 10000),
(50, 4, 13, 0, 14265.34),
(51, 4, 14, 0, 1569.1874),
(52, 4, 15, 0, 877.31841),
(53, 4, 16, 0, 106.99005),
(54, 4, 17, 0, 2553.49586),
(55, 4, 18, 0, 1569.1874),
(56, 4, 19, 0, 877.31841),
(57, 4, 20, 0, 106.99005),
(58, 4, 21, 0, 2553.49586),
(59, 4, 22, 0, 1711.8408),
(60, 4, 23, 0, 5106.99172),
(61, 4, 24, 0, 1000),
(62, 4, 27, 0, 16818.83252),
(63, 4, 25, 0, 17818.83252),
(64, 4, 26, 0, 17818.82),
(65, 5, 0, 1, 30000),
(66, 5, 1, 0, 33185.85),
(67, 5, 2, 0, 6637.17),
(68, 5, 3, 0, 26548.68),
(69, 5, 4, 0, 5309.736),
(70, 5, 5, 0, 2123.8944),
(71, 5, 6, 0, 3185.8416),
(72, 5, 7, 0, 1327.434),
(73, 5, 8, 0, 663.717),
(74, 5, 9, 0, 35176.9926),
(75, 5, 10, 0, 3000),
(76, 5, 11, 0, 38176.9926),
(77, 5, 12, 0, 38176.98),
(78, 6, 0, 1, 8000),
(79, 6, 13, 0, 11412.272),
(80, 6, 14, 0, 1255.34992),
(81, 6, 15, 0, 701.854728),
(82, 6, 16, 0, 85.59204),
(83, 6, 17, 0, 2042.796688),
(84, 6, 18, 0, 1255.34992),
(85, 6, 19, 0, 701.854728),
(86, 6, 20, 0, 85.59204),
(87, 6, 21, 0, 2042.796688),
(88, 6, 22, 0, 1369.47264),
(89, 6, 23, 0, 4085.593376),
(90, 6, 24, 0, 800),
(91, 6, 27, 0, 13455.066016),
(92, 6, 25, 0, 14255.066016),
(93, 6, 26, 0, 14255.056),
(174, 7, 12, 0, 8907.962),
(173, 7, 11, 0, 8907.96494),
(172, 7, 10, 0, 700),
(171, 7, 9, 0, 8207.96494),
(170, 7, 8, 0, 154.8673),
(169, 7, 7, 0, 309.7346),
(168, 7, 6, 0, 743.36304),
(167, 7, 5, 0, 495.57536),
(166, 7, 4, 0, 1238.9384),
(165, 7, 3, 0, 6194.692),
(164, 7, 2, 0, 1548.673),
(163, 7, 1, 0, 7743.365),
(162, 7, 0, 1, 7000),
(107, 8, 0, 1, 34106),
(108, 8, 13, 0, 48653.368604),
(109, 8, 14, 0, 5351.870546),
(110, 8, 15, 0, 2992.182169),
(111, 8, 16, 0, 364.900265),
(112, 8, 17, 0, 8708.95298),
(113, 8, 18, 0, 5351.870546),
(114, 8, 19, 0, 2992.182169),
(115, 8, 20, 0, 364.900265),
(116, 8, 21, 0, 8708.95298),
(117, 8, 22, 0, 5838.404232),
(118, 8, 23, 0, 17417.90596),
(119, 8, 24, 0, 3410.6),
(120, 8, 27, 0, 57362.310193),
(121, 8, 25, 0, 60772.910193),
(122, 8, 26, 0, 60772.867492),
(161, 9, 12, 0, 6362.83),
(160, 9, 11, 0, 6362.8321),
(159, 9, 10, 0, 500),
(158, 9, 9, 0, 5862.8321),
(157, 9, 8, 0, 110.6195),
(156, 9, 7, 0, 221.239),
(155, 9, 6, 0, 530.9736),
(154, 9, 5, 0, 353.9824),
(153, 9, 4, 0, 884.956),
(152, 9, 3, 0, 4424.78),
(151, 9, 2, 0, 1106.195),
(150, 9, 1, 0, 5530.975),
(149, 9, 0, 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `oszinvoiceitem2011`
--

CREATE TABLE IF NOT EXISTS `oszinvoiceitem2011` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDInvoice` int(11) NOT NULL DEFAULT '0',
  `IDInvoiceRuleDef` int(11) NOT NULL DEFAULT '0',
  `net` tinyint(4) NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `oszinvoiceitem2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszinvoicerule`
--

CREATE TABLE IF NOT EXISTS `oszinvoicerule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `agerule` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `oszinvoicerule`
--

INSERT INTO `oszinvoicerule` (`ID`, `name`, `age`, `agerule`) VALUES
(1, 'Definicija obračuna do 26 godina', 26, '<='),
(2, 'Definicija obračuna za starije od 26 godina', 26, '>');

-- --------------------------------------------------------

--
-- Table structure for table `oszinvoiceruledef`
--

CREATE TABLE IF NOT EXISTS `oszinvoiceruledef` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDInvoiceRule` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `invoice` tinyint(4) NOT NULL DEFAULT '0',
  `report` tinyint(4) NOT NULL DEFAULT '0',
  `operator` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `input` int(11) NOT NULL DEFAULT '0',
  `inputVal` double NOT NULL DEFAULT '0',
  `inputY` int(11) NOT NULL DEFAULT '0',
  `operatorY` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inputZ` int(11) NOT NULL DEFAULT '0',
  `contributesum` tinyint(4) NOT NULL DEFAULT '0',
  `inputnet` tinyint(4) NOT NULL DEFAULT '0',
  `control` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDInvoiceRule` (`IDInvoiceRule`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `oszinvoiceruledef`
--

INSERT INTO `oszinvoiceruledef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES
(1, 1, 'Prihod (ugovorena naknada)', 1, 0, 0, '*', 0, 1.106195, 0, '', 0, 0, 1, 0),
(2, 1, 'Normirani troškovi', 2, 0, 1, '%', 1, 20, 0, '', 0, 0, 0, 0),
(3, 1, 'Oporezivi prihod', 3, 0, 1, '-', 1, 0, 2, '', 0, 0, 0, 0),
(4, 1, 'Porez na dohodak građana', 4, 0, 1, '%', 3, 20, 0, '', 0, 0, 0, 0),
(5, 1, 'Umanjenje poreza', 5, 0, 1, '%', 4, 40, 0, '', 0, 0, 0, 0),
(6, 1, 'Porez za uplatu', 6, 1, 1, '-', 4, 0, 5, '', 0, 0, 0, 0),
(7, 1, 'Doprinosi za PIO na teret isplatioca prihoda', 7, 1, 1, '%', 1, 4, 0, '', 0, 1, 0, 0),
(8, 1, 'Doprinos za zdravstveno osiguranje na teret isplatioca prihoda', 8, 1, 1, '%', 1, 2, 0, '', 0, 1, 0, 0),
(9, 1, 'Svega za refundaciju/Iznos za isplatu', 9, 1, 1, '+', 6, 0, 7, '+', 8, 0, 1, 0),
(10, 1, 'Članski doprinos', 10, 1, 0, '%', 0, 10, 0, '', 0, 0, 1, 0),
(11, 1, 'Ukupno za uplatu', 11, 1, 0, '+', 9, 0, 10, '', 0, 0, 0, 0),
(12, 1, 'Kontrola Neto na Bruto', 12, 0, 0, '*', 0, 1.272566, 0, '', 0, 0, 1, 1),
(13, 2, 'Osnovica za obračun poreza', 1, 0, 0, '*', 0, 1.426534, 0, '', 0, 0, 1, 0),
(14, 2, 'Za PIO na teret zaposlenog', 2, 0, 1, '%', 13, 11, 0, '', 0, 1, 0, 0),
(15, 2, 'Za zdravstveno osiguranje na teret zaposlenog', 3, 0, 1, '%', 13, 6.15, 0, '', 0, 1, 0, 0),
(16, 2, 'Za osiguranje od slučaja nezaposlenosti', 4, 0, 1, '%', 13, 0.75, 0, '', 0, 1, 0, 0),
(17, 2, 'Na teret zaposlenog', 5, 0, 1, '+', 14, 0, 15, '+', 16, 0, 0, 0),
(18, 2, 'Za PIO na teret poslodavca', 6, 0, 1, '%', 13, 11, 0, '', 0, 1, 0, 0),
(19, 2, 'Za zdravstveno osiguranje na teret poslodavca', 7, 0, 1, '%', 13, 6.15, 0, '', 0, 1, 0, 0),
(20, 2, 'Za osiguranje od nezaposlenosti na teret poslodavca', 8, 0, 1, '%', 13, 0.75, 0, '', 0, 1, 0, 0),
(21, 2, 'Na teret poslodavca', 9, 0, 1, '+', 18, 0, 19, '+', 20, 0, 0, 0),
(22, 2, 'Ukupno plaćen porez', 10, 1, 1, '%', 13, 12, 0, '', 0, 0, 0, 0),
(23, 2, 'Doprinosi za socijalno osiguranje', 11, 1, 0, '+', 17, 0, 21, '', 0, 0, 0, 0),
(24, 2, 'Članski doprinos', 12, 1, 0, '%', 0, 10, 0, '', 0, 0, 1, 0),
(25, 2, 'Ukupno za uplatu', 14, 1, 0, '+', 27, 0, 24, '', 0, 0, 0, 0),
(26, 2, 'Kontrola Neto na Bruto', 15, 0, 0, '*', 0, 1.781882, 0, '', 0, 0, 1, 1),
(27, 2, 'Svega za refundaciju', 13, 1, 0, '+', 22, 0, 23, '', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oszinvoiceruleprt`
--

CREATE TABLE IF NOT EXISTS `oszinvoiceruleprt` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDInvoiceRule` int(11) NOT NULL DEFAULT '0',
  `invoice` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `net` tinyint(4) NOT NULL DEFAULT '0',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `inputA` int(11) NOT NULL DEFAULT '0',
  `inputAOper` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inputB` int(11) NOT NULL DEFAULT '0',
  `inputBOper` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inputC` int(11) NOT NULL DEFAULT '0',
  `inputASrc` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `inputBSrc` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `inputCSrc` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDInvoiceRule` (`IDInvoiceRule`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `oszinvoiceruleprt`
--

INSERT INTO `oszinvoiceruleprt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES
(1, 1, 1, 'Neto zarada zadrugara', 1, 1, 1, '', 0, '', 0, 'ugo', '', ''),
(2, 1, 1, 'Porez na zaradu', 0, 2, 6, '', 0, '', 0, 'def', '', ''),
(3, 1, 1, 'Doprinosi za socijalno osiguranje', 0, 3, 7, '+', 8, '', 0, 'def', 'def', ''),
(4, 1, 1, 'Svega za refundaciju', 0, 4, 1, '+', 2, '+', 3, 'prt', 'prt', 'prt'),
(5, 1, 1, 'Članski doprinos', 0, 5, 10, '', 0, '', 0, 'def', '', ''),
(6, 1, 1, 'Ukupno za uplatu', 0, 6, 4, '+', 5, '', 0, 'prt', 'prt', ''),
(7, 1, 0, 'Prihod (ugovorena naknada)', 0, 1, 1, '', 0, '', 0, 'def', '', ''),
(8, 1, 0, 'Normirani troškovi (1. x 20%)', 0, 2, 2, '', 0, '', 0, 'def', '', ''),
(9, 1, 0, 'Oporezivi prihod (1. - 2)', 0, 3, 3, '-', 0, '', 0, 'def', '', ''),
(10, 1, 0, 'Porez na dohodak građana', 0, 4, 4, '', 0, '', 0, 'def', '', ''),
(11, 1, 0, 'Umanjenje poreza (4. x 40%)', 0, 5, 5, '', 0, '', 0, 'def', '', ''),
(12, 1, 0, 'Porez za uplatu (4. - 5)', 0, 6, 6, '', 0, '', 0, 'def', '', ''),
(13, 1, 0, 'Iznos za isplatu (1. - 6. - 7)', 0, 7, 9, '', 0, '', 0, 'def', '', ''),
(14, 1, 0, 'Doprinos za PIO na teret isplatioca prihoda', 0, 8, 7, '', 0, '', 0, 'def', '', ''),
(15, 1, 0, 'Doprinos za zdravstveno osiguranje na teret isplatioca prihoda', 0, 9, 8, '', 0, '', 0, 'def', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `oszmember2010`
--

CREATE TABLE IF NOT EXISTS `oszmember2010` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `surname` varchar(70) NOT NULL,
  `parent` varchar(70) DEFAULT NULL,
  `jmbr` varchar(13) DEFAULT NULL,
  `idnumber` varchar(15) DEFAULT NULL,
  `mup` varchar(70) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(70) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `IDAddressPlace` smallint(6) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `specialkno` varchar(255) DEFAULT NULL,
  `healthinsur` tinyint(1) DEFAULT NULL,
  `memberother` tinyint(1) DEFAULT NULL,
  `IDMemberBasis` tinyint(4) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `IDEmployer` smallint(6) DEFAULT NULL,
  `memberdate` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `name` (`name`),
  KEY `surname` (`surname`),
  KEY `name_2` (`name`,`surname`),
  KEY `birthplace` (`birthplace`),
  KEY `IDAddressPlace` (`IDAddressPlace`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `oszmember2010`
--

INSERT INTO `oszmember2010` (`ID`, `name`, `surname`, `parent`, `jmbr`, `idnumber`, `mup`, `birthday`, `birthplace`, `address`, `IDAddressPlace`, `occupation`, `specialkno`, `healthinsur`, `memberother`, `IDMemberBasis`, `phone`, `mobile`, `email`, `IDEmployer`, `memberdate`) VALUES
(1, 'GORAN', 'MILADINOVIĆ', '', '2112963761015', '85286', 'Smed.Palanka', '1963-12-21', 'Smed.Palanka', 'Glavaševa 72/1', 59, '', '', 1, 0, 0, '026314936', '', '', 20, '2010-01-11'),
(2, 'EMRULA', 'DELIBALTA', '', '2610970950001', '', '', '1970-10-26', '', '', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(3, 'DRAGAN', 'MIHAJLOVIĆ', '', '1806983762016', '172851', 'Požarevac', '1983-06-18', 'Požarevac', 'Užička 17', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(4, 'IMRAN', 'AJETI', '', '0105972742534', '210666', 'Požarevac', '1972-05-01', 'Bujanovac', 'Kobalova 42', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(5, 'BOŠKO', 'TANASKOVIĆ', '', '3003949761010', '114037', 'Smed.Palanka', '1949-03-30', 'Smederevo', 'Kralja Petra I 111', 59, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(6, 'ZORAN', 'SPASIĆ', '', '2512955710329', '113746', 'Niš', '1955-12-25', '', '', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(7, 'DEJAN', 'DOKIĆ', '', '0510952761054', '123401', 'Smed.Palanka', '1952-10-05', 'Smed.Palanka', 'Ratari', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(8, 'NENAD', 'RISTIĆ', '', '2505979762013', '160312', 'Požarevac', '1979-05-25', 'Požarevac', 'Kapetana Todića 55', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(9, 'MILAN', 'NARANDŽIĆ', '', '1408982762017', '169900', 'Požarevac', '1982-08-14', 'Požarevac', 'Kneza Miloša 41', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-11'),
(10, 'VESNA', 'JOVANOVIĆ', '', '1101963757918', '129903', 'Negotin', '1963-01-11', 'Donji Milanovac', 'Branka Perića 18/13', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-12'),
(11, 'MILKA', 'TONIĆ', '', '1310958915007', 'G112057', 'Beograd', '1958-10-13', 'Vučitrn', 'Obrenovački put 52', 0, '', '', 1, 0, 0, '', '', '', 20, '2010-01-12'),
(12, 'MILANKA', 'JOVANOVIĆ', '', '0710954719038', 'F280884', 'Beograd', '1954-10-07', 'Azanja', 'Ilije Garašanina', 70, '', '', 1, 0, 0, '', '', '', 20, '2010-01-12'),
(13, 'MARIJA', 'JOVANOVIĆ', '', '0110982766052', '105958', 'Smed.Palanka', '1982-10-01', 'Smed.Palanka', 'Slavonska 9', 59, '', '', 1, 0, 0, '', '', '', 41, '2010-01-13'),
(14, 'SANJA', 'MIŠIĆ', '', '1709986766041', '124146', 'Smed.Palanka', '1986-09-17', 'Smed.Palanka', 'Kajmakčalanska 8/1', 59, '', '', 1, 0, 0, '', '', '', 39, '2010-01-13'),
(15, 'NIKOLA', 'KRSIĆ', '', '2604988720038', '', '', '1988-04-26', 'Kragujevac', 'V.M.Velimirovića 3', 24, '', '', 1, 0, 0, '', '', '', 0, '2000-12-08'),
(16, 'MOMČILO', 'AGATONOVIĆ', '', '2402954761019', '122295', 'Smed.Palanka', '1954-02-24', 'Smed.Palanka', 'Glibovac', 59, '', '', 1, 0, 0, '', '', '', 12, '2010-01-18'),
(17, 'BRATISLAV', 'DOŠEN', '', '1001973761013', '108496', 'Smed.Palanka', '1973-01-10', 'Smed.Palanka', 'Rudnička 6a', 59, '', '', 1, 0, 0, '', '', '', 12, '2010-01-18'),
(18, 'VELJKO', 'PANTIĆ', '', '2304971761039', '87607', 'Smed.Palanka', '1971-04-23', 'Smed.Palanka', 'Glibovac', 59, '', '', 1, 0, 0, '', '', '', 12, '2010-01-18'),
(19, 'DEJAN', 'BATINIĆ', '', '1009973761022', '135464', 'Smed.Palanka', '1973-09-10', 'Smed.Palanka', 'Radoslava Gačića 9', 59, '', '', 1, 0, 0, '', '', '', 12, '2010-01-18'),
(20, 'MARKO', 'ŽIVANOVIĆ', '', '0406991761019', '', '', '1991-06-04', 'Smed.Palanka', 'Karađorđeva 120', 59, '', '', 1, 0, 0, '', '', '', 0, '2010-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `oszmember2011`
--

CREATE TABLE IF NOT EXISTS `oszmember2011` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `parent` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jmbr` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idnumber` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mup` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDAddressPlace` smallint(6) DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialkno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `healthinsur` tinyint(1) DEFAULT NULL,
  `memberother` tinyint(1) DEFAULT NULL,
  `IDMemberBasis` tinyint(4) DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDEmployer` smallint(6) DEFAULT NULL,
  `memberdate` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `name` (`name`),
  KEY `surname` (`surname`),
  KEY `name_2` (`name`,`surname`),
  KEY `birthplace` (`birthplace`),
  KEY `IDAddressPlace` (`IDAddressPlace`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `oszmember2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszmemberbasis`
--

CREATE TABLE IF NOT EXISTS `oszmemberbasis` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `oszmemberbasis`
--

INSERT INTO `oszmemberbasis` (`ID`, `name`) VALUES
(1, 'Student'),
(2, 'Učenik'),
(3, 'Nezaposlen'),
(4, 'Posebni uslovi');

-- --------------------------------------------------------

--
-- Table structure for table `oszmenu`
--

CREATE TABLE IF NOT EXISTS `oszmenu` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `root` smallint(6) NOT NULL DEFAULT '0',
  `sort` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `title` (`title`),
  KEY `root` (`root`),
  KEY `link` (`link`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `oszmenu`
--

INSERT INTO `oszmenu` (`ID`, `title`, `link`, `root`, `sort`) VALUES
(1, 'Osnovni podaci', 'osnovnipodaci.php', 0, 1),
(2, 'Obračun', 'obracun.php', 0, 2),
(3, 'Izveštaji', 'izvestaj.php', 0, 3),
(4, 'Podešavanja', 'podesavanja.php', 0, 4),
(5, 'Pomoć', 'pomoc.php', 0, 5),
(6, 'Knjiga zadrugara', 'zadrugar.php', 1, 1),
(7, 'Knjiga zadrugara - Unos', 'zadrugarunos.php', 6, 1),
(8, 'Kartica zadrugara', 'zadrugarkartica.php', 6, 2),
(9, 'Podaci zadruge', 'oszpodaci.php', 1, 2),
(10, 'Poslodavac', 'poslodavac.php', 1, 3),
(11, 'Poslodavac - Unos', 'poslodavacunos.php', 10, 1),
(12, 'Unos ugovora', 'ugovorunos.php', 2, 1),
(13, 'Obračun faktura', 'faktura.php', 2, 2),
(14, 'Knjiga ugovora', 'knjigaugovor.php', 3, 1),
(15, 'Knjiga faktura', 'knjigafaktura.php', 3, 2),
(16, 'Kartica zadrugara', 'karticazadrugar.php', 3, 3),
(17, 'Parametri obračuna', 'parametarobracun.php', 4, 1),
(18, 'Evidencija zadrugara', 'pomoczadrugar.php', 5, 1),
(19, 'Evidencija ugovora', 'pomocugovor.php', 5, 2),
(20, 'Unos ugovora - neto zarade', 'zaradaunos.php', 12, 1),
(21, 'Knjiga ugovora - pregled', 'pregledugovor.php', 14, 1),
(22, 'Mesta', 'mesto.php', 1, 4),
(23, 'Osnov članstva', 'osnov.php', 1, 5),
(24, 'Mesta - unos', 'mestounos.php', 23, 1),
(25, 'Osnov članstva - Unos', 'osnovunos.php', 23, 2),
(26, 'Otvori godinu', 'otvorigodinu.php', 4, 3),
(27, 'Tekuća godina', 'tekucagodina.php', 4, 4),
(28, 'Definicija obračuna - Unos', 'parametarunos.php', 18, 1),
(29, 'Parametri štampe', 'parametarstampa.php', 4, 2),
(30, 'Parametri štampe - Unos', 'parametarstampaunos.php', 29, 1),
(31, 'Blanko ugovor', 'blankougovor.php', 3, 4),
(32, 'Obračun fakture', 'fakturaracun.php', 13, 1),
(33, 'Faktura', 'fakturaobracun.php', 13, 2),
(34, 'Pregled fakture', 'pregledfaktura.php', 15, 1),
(35, 'Pregled obračuna', 'pregledobracun.php', 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `oszplace`
--

CREATE TABLE IF NOT EXISTS `oszplace` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `post` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=128 ;

--
-- Dumping data for table `oszplace`
--

INSERT INTO `oszplace` (`ID`, `name`, `post`, `phone`) VALUES
(1, 'Aleksandrovac', '', ''),
(2, 'Aleksinac', '', ''),
(3, 'Arilje', '', ''),
(4, 'Bajina Bašta', '', ''),
(5, 'Banja Koviljača', '', ''),
(6, 'Batajnica', '', ''),
(7, 'Batočina', '', ''),
(8, 'Bela Palanka', '', ''),
(9, 'Beograd', '11000', '011'),
(10, 'Blace', '', ''),
(11, 'Bogatić', '', ''),
(12, 'Boljevac', '', ''),
(13, 'Bor', '', ''),
(14, 'Bosilegrad', '', ''),
(15, 'Despotovac', '', ''),
(16, 'Dimitrovgrad', '', ''),
(17, 'Donji Milanovac', '', ''),
(18, 'Gornji Milanovac', '', ''),
(19, 'Ivanjica', '', ''),
(20, 'Jagodina', '', ''),
(21, 'Kladovo', '', ''),
(22, 'Knić', '', ''),
(23, 'Knjaževac', '', ''),
(24, 'Kragujevac', '', ''),
(25, 'Kraljevo', '', ''),
(26, 'Kruševac', '', ''),
(27, 'Kuršumlija', '', ''),
(28, 'Kučevo', '', ''),
(29, 'Lajkovac', '', ''),
(30, 'Lapovo', '', ''),
(31, 'Lazarevac', '', ''),
(32, 'Lebane', '', ''),
(33, 'Leposavić', '', ''),
(34, 'Leskovac', '', ''),
(35, 'Ljig', '', ''),
(36, 'Loznica', '', ''),
(37, 'Lučani', '', ''),
(38, 'Majdanpek', '', ''),
(39, 'Mali Zvornik', '', ''),
(40, 'Merošina', '', ''),
(41, 'Mionica', '', ''),
(42, 'Mladenovac', '', ''),
(43, 'Negotin', '', ''),
(44, 'Niš', '', ''),
(45, 'Nova Varoš', '', ''),
(46, 'Novi Pazar', '', ''),
(47, 'Obrenovac', '', ''),
(48, 'Osečina', '', ''),
(49, 'Paraćin', '', ''),
(50, 'Petrovac na Mlavi', '', ''),
(51, 'Pirot', '', ''),
(52, 'Požarevac', '', ''),
(53, 'Požega', '', ''),
(54, 'Prijepolje', '', ''),
(55, 'Prokuplje', '', ''),
(56, 'Raška', '', ''),
(57, 'Sjenica', '', ''),
(58, 'Smederevo', '26000', '026'),
(59, 'Smederevska Palanka', '11420', '026'),
(60, 'Sokobanja', '', ''),
(61, 'Surdulica', '', ''),
(62, 'Svilajnac', '', ''),
(63, 'Svrljig', '', ''),
(64, 'Topola', '', ''),
(65, 'Trstenik', '', ''),
(66, 'Ub', '', ''),
(67, 'Užice', '', ''),
(68, 'Valjevo', '', ''),
(69, 'Varvarin', '', ''),
(70, 'Velika Plana', '', ''),
(71, 'Veliko Gradište', '', ''),
(72, 'Vladimirci', '', ''),
(73, 'Vladičin Han', '', ''),
(74, 'Vlasotince', '', ''),
(75, 'Vranje', '', ''),
(76, 'Vrnjačka banja', '', ''),
(77, 'Zaječar', '', ''),
(78, 'Zemun', '', ''),
(79, 'Zubin potok', '', ''),
(80, 'Šabac', '', ''),
(81, 'Žagubica', '', ''),
(82, 'Ćićevac', '', ''),
(83, 'Ćuprija', '', ''),
(84, 'Čajetina', '', ''),
(85, 'Čačak', '', ''),
(86, 'Apatin', '', ''),
(87, 'Bač', '', ''),
(88, 'Bačka Palanka', '', ''),
(89, 'Bačka Topola', '', ''),
(90, 'Bela Crkva', '', ''),
(91, 'Bečej', '', ''),
(92, 'Inđija', '', ''),
(93, 'Jaša Tomić', '', ''),
(94, 'Kanjiža', '', ''),
(95, 'Kikinda', '', ''),
(96, 'Kovačica', '', ''),
(97, 'Kovin', '', ''),
(98, 'Kula', '', ''),
(99, 'Novi Kneževac', '', ''),
(100, 'Novi Sad', '21000', '021'),
(101, 'Odžaci', '', ''),
(102, 'Palić', '', ''),
(103, 'Pančevo', '', ''),
(104, 'Pećinci', '', ''),
(105, 'Plandište', '', ''),
(106, 'Ruma', '', ''),
(107, 'Sombor', '', ''),
(108, 'Srbobran', '', ''),
(109, 'Sremska Mitrovica', '', ''),
(110, 'Stara Pazova', '', ''),
(111, 'Subotica', '', ''),
(112, 'Temerin', '', ''),
(113, 'Titel', '', ''),
(114, 'Vrbas', '', ''),
(115, 'Vršac', '', ''),
(116, 'Zrenjanin', '', ''),
(117, 'Šid', '', ''),
(118, 'Žabalj', '', ''),
(119, 'Žitište', '', ''),
(120, 'Pakrac', NULL, NULL),
(121, 'Donji Lapac', NULL, NULL),
(122, 'Glina', NULL, NULL),
(123, 'Rača', NULL, NULL),
(124, 'Skopje', NULL, NULL),
(125, 'Kosovo Polje', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oszprint`
--

CREATE TABLE IF NOT EXISTS `oszprint` (
  `IDPrint` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contract` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IDPrint`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `oszprint`
--

INSERT INTO `oszprint` (`IDPrint`, `name`, `contract`) VALUES
(1, 'Ugovor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oszprintitem`
--

CREATE TABLE IF NOT EXISTS `oszprintitem` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDPrint` int(11) NOT NULL DEFAULT '0',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `align` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'L',
  `font` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Arial',
  `fontsize` tinyint(4) NOT NULL DEFAULT '0',
  `style` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ln` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `oszprintitem`
--

INSERT INTO `oszprintitem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES
(1, 1, 1, 'U G O V O R', 'C', 'arial', 14, 'B', 5),
(2, 1, 2, 'I OBAVEZE ČLANOVA ZADRUGE', 'C', 'arial', 11, '', 2),
(3, 1, 3, '1.Da poverene poslove svesno, marljivo i kvalitetno obavlja u ugovorenom roku;', 'L', 'arial', 9, '', 1),
(4, 1, 4, '2.Da se pridržavaju važećeg radnog reda i drugih pravila ponašanja i pravila radne discipline kod naručioca;', 'L', 'arial', 9, '', 1),
(5, 1, 5, '3.Da se staraju o pravilnoj upotrebi sredstava za rad i alata kojima se služe u toku rada;', 'L', 'arial', 9, '', 1),
(6, 1, 6, '4.Da lično obavljaju poverene poslove i da pre polaska na posao potpišu ovaj ugovor;', 'L', 'arial', 9, '', 1),
(7, 1, 7, '5.Da nakon obavljenog posla ovaj ugovor overe kod naručioca i dostave u zadrugu najkasnije u roku od dva dana.', 'L', 'arial', 9, '', 5),
(8, 1, 9, 'II OBAVEZE NARUČIOCA POSLA', 'C', 'arial', 11, '', 2),
(9, 1, 9, '1.Da na rad primi samo one članove zadruge koje je na posao uputila zadruga;', 'L', 'arial', 9, '', 1),
(10, 1, 10, '2.Da članovima zadruge poverava samo poslove koji su predvidjeni Zakonom o zadrugama i Zakonom o zadrugama;', 'L', 'arial', 9, '', 1),
(11, 1, 11, '3.Da članovima zadruge obezbedi zaštitu na radu u skladu sa Zakonom o zaštiti na radu;', 'L', 'arial', 9, '', 1),
(12, 1, 12, '4.Da Zadrugu i inspekciju rada obavesti o bilo kakvoj nesreći na poslu koju doživi član Zadruge u skladu sa zakonom;', 'L', 'arial', 9, '', 1),
(13, 1, 13, '5.Da Zadruzi nadoknadi štetu koju pretrpi njen član u toku rada, po opštim načelima odgovornosti za štetu;', 'L', 'arial', 9, '', 1),
(14, 1, 14, '6.Da članovima zadruge nakon završetka posla overi ovaj ugovor i razduži ih sa preuzetim alatom i sredstvima za rad;', 'L', 'arial', 9, '', 1),
(15, 1, 15, '7.Da zadruzi isplati iznos uvećan za ______ nakon ispostavljanja fakture u zakonskom roku.', 'L', 'arial', 9, '', 5),
(16, 1, 16, 'III OBAVEZE ZADRUGE', 'C', 'arial', 11, '', 2),
(17, 1, 17, '1.Da u slučaju eventualnog napuštanja posla, od strane upućenih članova, na rad pošalje nove svoje članove radi blagovremenog završetka posla;', 'L', 'arial', 9, '', 1),
(18, 1, 18, '2.Da članu zadruge isplati neto iznos, zarađen po ovom ugovoru najkasnije u roku od 15 dana od dana kad po ovom ugovoru bude uplaćeno Zadruzi.', 'L', 'arial', 9, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oszyear`
--

CREATE TABLE IF NOT EXISTS `oszyear` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `oszyear`
--

INSERT INTO `oszyear` (`ID`, `year`) VALUES
(1, '2010'),
(2, '2011');
