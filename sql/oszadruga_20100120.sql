-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2010 at 05:05 PM
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
  `jobdescription` text,
  `net` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `contribute` double NOT NULL DEFAULT '0',
  `claimsum` double NOT NULL DEFAULT '0',
  `sum` double NOT NULL DEFAULT '0',
  `rule` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `oszcontract2010`
--

INSERT INTO `oszcontract2010` (`ID`, `IDEmployer`, `contractnumber`, `contractdate`, `contractfrom`, `contractto`, `hours`, `jobdescription`, `net`, `tax`, `contribute`, `claimsum`, `sum`, `rule`) VALUES
(1, 20, NULL, '2010-01-11', '2009-12-01', '2009-12-31', '', 'Rad na pepelištu za mesec decembar 2009.', 0, 0, 0, 0, 0, 0),
(2, 20, NULL, '2010-01-12', '2009-12-01', '2009-12-31', '', 'higijeničarski poslovi na Đerdapu za mesec decembar 2009. ', 0, 0, 0, 0, 0, 0),
(3, 20, NULL, '2010-01-12', '2009-12-01', '2009-12-12', '', 'higijeničarski poslovi za mesec decembar 2009.', 0, 0, 0, 0, 0, 0),
(4, 20, NULL, '2010-01-12', '2009-12-01', '2009-12-31', '', 'higijeničarski poslovi za mesec decembar 2009.', 0, 0, 0, 0, 0, 0),
(5, 41, NULL, '2010-01-13', '2009-12-01', '2009-12-31', '', 'administrativni poslovi', 0, 0, 0, 0, 0, 0),
(6, 39, NULL, '2010-01-13', '2009-12-01', '2009-12-31', '', 'higijeničarski poslovi', 0, 0, 0, 0, 0, 0),
(7, 42, NULL, '2010-01-18', '2010-01-04', '2010-01-15', '', 'pomocni poslovi u inkubatorskoj stanici', 0, 0, 0, 0, 0, 0),
(8, 12, NULL, '2010-01-18', '2009-10-01', '2009-10-31', '', 'obavljanje fizičkih poslova u RJ', 0, 0, 0, 0, 0, 0),
(9, 1, NULL, '2010-01-18', '2010-01-04', '2010-01-15', '', 'rad u stručnoj službi', 5000, 530.9736, 331.8585, 5862.8321, 5862.8321, 1),
(11, 42, NULL, '2010-01-19', '0000-00-00', '0000-00-00', '', 'pomoćni poslovi u inkubatorskoj stanici ', 0, 0, 0, 0, 0, 0);

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
  `jobdescription` text COLLATE utf8_unicode_ci NOT NULL,
  `net` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `contribute` double NOT NULL DEFAULT '0',
  `claimsum` double NOT NULL DEFAULT '0',
  `sum` double NOT NULL DEFAULT '0',
  `rule` tinyint(4) NOT NULL DEFAULT '0',
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
  `contractfrom` date DEFAULT NULL,
  `contractto` date DEFAULT NULL,
  `hours` varchar(5) NOT NULL,
  `value` double NOT NULL DEFAULT '0',
  `pio` double NOT NULL DEFAULT '0',
  `health` double NOT NULL DEFAULT '0',
  `insurance` double NOT NULL DEFAULT '0',
  `bruto` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDContract` (`IDContract`,`IDMember`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `oszcontractitem2010`
--

INSERT INTO `oszcontractitem2010` (`ID`, `IDContract`, `IDMember`, `net`, `contractfrom`, `contractto`, `hours`, `value`, `pio`, `health`, `insurance`, `bruto`) VALUES
(1, 1, 9, 20472.12, NULL, NULL, '', 0, 0, 0, 0, 0),
(2, 1, 8, 20472.12, NULL, NULL, '', 0, 0, 0, 0, 0),
(3, 1, 7, 20472.12, NULL, NULL, '', 0, 0, 0, 0, 0),
(4, 1, 6, 23704.56, NULL, NULL, '', 0, 0, 0, 0, 0),
(5, 1, 5, 23704.56, NULL, NULL, '', 0, 0, 0, 0, 0),
(6, 1, 4, 23704.56, NULL, NULL, '', 0, 0, 0, 0, 0),
(7, 1, 3, 22627.08, NULL, NULL, '', 0, 0, 0, 0, 0),
(8, 1, 2, 22627.08, NULL, NULL, '', 0, 0, 0, 0, 0),
(9, 1, 1, 22627.08, NULL, NULL, '', 0, 0, 0, 0, 0),
(10, 2, 10, 9500, NULL, NULL, '', 0, 0, 0, 0, 0),
(11, 3, 11, 8000, NULL, NULL, '', 0, 0, 0, 0, 0),
(12, 4, 12, 10000, NULL, NULL, '', 0, 0, 0, 0, 0),
(13, 5, 13, 30000, NULL, NULL, '', 0, 0, 0, 0, 0),
(30, 6, 14, 8000, NULL, NULL, '', 0, 0, 0, 0, 0),
(15, 7, 15, 7000, NULL, NULL, '', 0, 0, 0, 0, 0),
(22, 8, 19, 10790, NULL, NULL, '', 0, 0, 0, 0, 0),
(24, 8, 17, 8216, NULL, NULL, '', 0, 0, 0, 0, 0),
(23, 8, 16, 5840, NULL, NULL, '', 0, 0, 0, 0, 0),
(25, 8, 18, 9260, NULL, NULL, '', 0, 0, 0, 0, 0),
(27, 9, 20, 5000, NULL, NULL, '', 5530.98, 0, 0, 0, 5862.83),
(31, 11, 15, 6000, NULL, NULL, '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oszcontractitem2011`
--

CREATE TABLE IF NOT EXISTS `oszcontractitem2011` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDContract` int(11) NOT NULL,
  `IDMember` int(11) NOT NULL,
  `net` double DEFAULT NULL,
  `contractfrom` date DEFAULT NULL,
  `contractto` date DEFAULT NULL,
  `hours` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `value` double NOT NULL DEFAULT '0',
  `pio` double NOT NULL DEFAULT '0',
  `health` double NOT NULL DEFAULT '0',
  `insurance` double NOT NULL DEFAULT '0',
  `bruto` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDContract` (`IDContract`,`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `oszcontractitem2011`
--


-- --------------------------------------------------------

--
-- Table structure for table `oszcontractruledef`
--

CREATE TABLE IF NOT EXISTS `oszcontractruledef` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `oszcontractruledef`
--

INSERT INTO `oszcontractruledef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES
(1, 1, 'Prihod (ugovorena naknada)', 1, 0, 0, '*', 0, 1.106195, 0, '', 0, 0, 1, 0),
(2, 1, 'Normirani troškovi', 2, 0, 1, '%', 1, 20, 0, '', 0, 0, 0, 0),
(3, 1, 'Oporezivi prihod', 3, 0, 1, '-', 1, 0, 2, '', 0, 0, 0, 0),
(4, 1, 'Porez na dohodak građana', 4, 0, 1, '%', 3, 20, 0, '', 0, 0, 0, 0),
(5, 1, 'Umanjenje poreza', 5, 0, 1, '%', 4, 40, 0, '', 0, 0, 0, 0),
(6, 1, 'Porez za uplatu', 6, 1, 1, '-', 4, 0, 5, '', 0, 0, 0, 0),
(7, 1, 'Doprinosi za PIO na teret isplatioca prihoda', 7, 1, 1, '%', 1, 4, 0, '', 0, 1, 0, 0),
(8, 1, 'Doprinos za zdravstveno osiguranje na teret isplatioca prihoda', 8, 1, 1, '%', 1, 2, 0, '', 0, 1, 0, 0),
(9, 1, 'Svega za refundaciju/Iznos za isplatu', 9, 1, 1, '+', 6, 0, 7, '+', 8, 0, 1, 0),
(10, 1, 'Ukupno za uplatu', 11, 1, 0, '', 9, 0, 0, '', 0, 0, 0, 0),
(11, 1, 'Kontrola Neto na Bruto', 12, 0, 0, '*', 0, 1.172566, 0, '', 0, 0, 1, 1),
(12, 2, 'Osnovica za obračun poreza', 1, 0, 0, '*', 0, 1.426534, 0, '', 0, 0, 1, 0),
(13, 2, 'Za PIO na teret zaposlenog', 2, 0, 1, '%', 12, 11, 0, '', 0, 1, 0, 0),
(14, 2, 'Za zdravstveno osiguranje na teret zaposlenog', 3, 0, 1, '%', 12, 6.15, 0, '', 0, 1, 0, 0),
(15, 2, 'Za osiguranje od slučaja nezaposlenosti', 4, 0, 1, '%', 12, 0.75, 0, '', 0, 1, 0, 0),
(16, 2, 'Na teret zaposlenog', 5, 0, 1, '+', 13, 0, 14, '+', 15, 0, 0, 0),
(17, 2, 'Za PIO na teret poslodavca', 6, 0, 1, '%', 12, 11, 0, '', 0, 1, 0, 0),
(18, 2, 'Za zdravstveno osiguranje na teret poslodavca', 7, 0, 1, '%', 12, 6.15, 0, '', 0, 1, 0, 0),
(19, 2, 'Za osiguranje od nezaposlenosti na teret poslodavca', 8, 0, 1, '%', 12, 0.75, 0, '', 0, 1, 0, 0),
(20, 2, 'Na teret poslodavca', 9, 0, 1, '+', 17, 0, 18, '+', 19, 0, 0, 0),
(21, 2, 'Ukupno plaćen porez', 10, 1, 1, '%', 12, 12, 0, '', 0, 0, 0, 0),
(22, 2, 'Doprinosi za socijalno osiguranje', 11, 1, 0, '+', 16, 0, 20, '', 0, 0, 0, 0),
(23, 2, 'Svega za refundaciju', 13, 1, 0, '+', 21, 0, 22, '', 0, 0, 1, 0),
(24, 2, 'Ukupno za uplatu', 14, 1, 0, '', 23, 0, 0, ' ', 0, 0, 0, 0),
(25, 2, 'Kontrola Neto na Bruto', 15, 0, 0, '*', 0, 1.681882, 0, '', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `oszcontractruleitem2010`
--

CREATE TABLE IF NOT EXISTS `oszcontractruleitem2010` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDContract` int(11) NOT NULL DEFAULT '0',
  `IDInvoiceRuleDef` int(11) NOT NULL DEFAULT '0',
  `net` tinyint(4) NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDContract` (`IDContract`),
  KEY `IDInvoiceRuleDef` (`IDInvoiceRuleDef`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `oszcontractruleitem2010`
--

INSERT INTO `oszcontractruleitem2010` (`ID`, `IDContract`, `IDInvoiceRuleDef`, `net`, `value`) VALUES
(1, 9, 0, 1, 5000),
(2, 9, 1, 0, 5530.975),
(3, 9, 2, 0, 1106.195),
(4, 9, 3, 0, 4424.78),
(5, 9, 4, 0, 884.956),
(6, 9, 5, 0, 353.9824),
(7, 9, 6, 0, 530.9736),
(8, 9, 7, 0, 221.239),
(9, 9, 8, 0, 110.6195),
(10, 9, 9, 0, 5862.8321),
(11, 9, 10, 0, 5862.8321),
(12, 9, 11, 0, 5862.83);

-- --------------------------------------------------------

--
-- Table structure for table `oszcontractruleprt`
--

CREATE TABLE IF NOT EXISTS `oszcontractruleprt` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `oszcontractruleprt`
--

INSERT INTO `oszcontractruleprt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES
(1, 1, 0, 'Prihod (ugovorena naknada)', 0, 1, 1, '', 0, '', 0, 'def', '', ''),
(2, 1, 0, 'Normirani troškovi (1. x 20%)', 0, 2, 2, '', 0, '', 0, 'def', '', ''),
(3, 1, 0, 'Oporezivi prihod (1. - 2)', 0, 3, 3, '-', 0, '', 0, 'def', '', ''),
(4, 1, 0, 'Porez na dohodak građana', 0, 4, 4, '', 0, '', 0, 'def', '', ''),
(5, 1, 0, 'Umanjenje poreza (4. x 40%)', 0, 5, 5, '', 0, '', 0, 'def', '', ''),
(6, 1, 0, 'Porez za uplatu (4. - 5)', 0, 6, 6, '', 0, '', 0, 'def', '', ''),
(7, 1, 0, 'Iznos za isplatu (1. - 6. - 7)', 0, 7, 9, '', 0, '', 0, 'def', '', ''),
(8, 1, 0, 'Doprinos za PIO na teret isplatioca prihoda', 0, 8, 7, '', 0, '', 0, 'def', '', ''),
(9, 1, 0, 'Doprinos za zdravstveno osiguranje na teret isplatioca prihoda', 0, 9, 8, '', 0, '', 0, 'def', '', ''),
(10, 2, 0, 'Za PIO na teret zaposlenog', 0, 1, 13, '', 0, '', 0, 'def', '', ''),
(11, 2, 0, 'Za zdravstveno osiguranje na teret zaposlenog', 0, 2, 14, '', 0, '', 0, 'def', '', ''),
(12, 2, 0, 'Za osiguranje od slučaja nezaposlenosti', 0, 3, 15, '', 0, '', 0, 'def', '', ''),
(13, 2, 0, 'Na teret zaposlenog', 0, 4, 16, '', 0, '', 0, 'def', '', ''),
(14, 2, 0, 'Za PIO na teret poslodavca', 0, 5, 17, '', 0, '', 0, 'def', '', ''),
(15, 2, 0, 'Za zdravstveno osiguranje na teret poslodavca', 0, 6, 18, '', 0, '', 0, 'def', '', ''),
(16, 2, 0, 'Za osiguranje od nezaposlenosti na teret poslodavca', 0, 7, 19, '', 0, '', 0, 'def', '', ''),
(17, 2, 0, 'Na teret poslodavca', 0, 8, 20, '', 0, '', 0, 'def', '', ''),
(18, 2, 0, 'Ukupno plaćen porez', 0, 9, 21, '', 0, '', 0, 'def', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `oszcooperative`
--

CREATE TABLE IF NOT EXISTS `oszcooperative` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shortest` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
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
  `contracthours` tinyint(4) NOT NULL DEFAULT '0',
  `memberhours` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `name` (`name`),
  KEY `IDPlace` (`IDPlace`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `oszcooperative`
--

INSERT INTO `oszcooperative` (`ID`, `name`, `short`, `shortest`, `address`, `IDPlace`, `phone`, `mobile`, `fax`, `email`, `url`, `account`, `reference`, `pib`, `idnumber`, `activity`, `currentyear`, `contracthours`, `memberhours`) VALUES
(1, 'Omladinska Zadruga "VREME"', 'OZ "VREME"', '"VREME"', 'SVETOG SAVE 19D', 59, '(026)319-511', '(063)289.022', '(026)319-511', '', '', '170-003008420001-19', '355-1023876-05', '101928789', '7844069', '74840', '2010', 0, 0);

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
(1, 'Omladinska Zadruga "VREME"', 'SVETOG SAVE 19D', 59, '(026)319-511', '(063)289.022', '(026)319-511', '', '', '170-003008420001-19', '101928789', '7844069');

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
  `rule` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDContract` (`IDContract`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `oszinvoice2010`
--

INSERT INTO `oszinvoice2010` (`ID`, `IDContract`, `date`, `net`, `tax`, `contribute`, `claimsum`, `cooperative`, `sum`, `rule`) VALUES
(1, 1, '2010-01-19', 200411.28, 34307.220588, 102349.874755, 337068.375344, 20041.128, 357109.503344, 2),
(2, 2, '2010-01-19', 9500, 1626.24876, 4851.642134, 15977.890894, 950, 16927.890894, 2),
(3, 3, '2010-01-19', 8000, 1369.47264, 4085.593376, 13455.066016, 800, 14255.066016, 2),
(4, 4, '2010-01-19', 10000, 1711.8408, 5106.99172, 16818.83252, 1000, 17818.83252, 2),
(5, 5, '2010-01-19', 30000, 5135.5224, 15320.97516, 50456.49756, 3000, 53456.49756, 2),
(6, 6, '2010-01-19', 8000, 849.55776, 530.9736, 9380.53136, 800, 10180.53136, 1),
(7, 7, '2010-01-19', 7000, 743.36304, 464.6019, 8207.96494, 700, 8907.96494, 1),
(8, 8, '2010-01-19', 34106, 5838.404232, 17417.90596, 57362.310193, 3410.6, 60772.910193, 2),
(9, 9, '2010-01-19', 5000, 530.9736, 331.8585, 5862.8321, 500, 6362.8321, 0),
(10, 11, '2010-01-19', 6000, 637.16832, 398.2302, 7035.39852, 600, 7635.39852, 1);

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
  `rule` tinyint(4) NOT NULL DEFAULT '0',
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
  `pio` double NOT NULL DEFAULT '0',
  `health` double NOT NULL DEFAULT '0',
  `insurance` double NOT NULL DEFAULT '0',
  `bruto` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IDInvoice` (`IDInvoice`),
  KEY `IDContract` (`IDContract`),
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=48 ;

--
-- Dumping data for table `oszinvoicecontractitem2010`
--

INSERT INTO `oszinvoicecontractitem2010` (`ID`, `IDInvoice`, `IDContract`, `IDMember`, `net`, `value`, `pio`, `health`, `insurance`, `bruto`) VALUES
(42, 1, 1, 9, 20472.12, 29204.175232, 2251.9332, 1330.6878, 153.5409, 36478.90213),
(41, 1, 1, 8, 20472.12, 29204.175232, 2251.9332, 1330.6878, 153.5409, 36478.90213),
(40, 1, 1, 7, 20472.12, 29204.175232, 2251.9332, 1330.6878, 153.5409, 36478.90213),
(39, 1, 1, 6, 23704.56, 33815.360795, 2607.5016, 1540.7964, 177.7842, 42238.728782),
(38, 1, 1, 5, 23704.56, 33815.360795, 2607.5016, 1540.7964, 177.7842, 42238.728782),
(37, 1, 1, 4, 23704.56, 33815.360795, 2607.5016, 1540.7964, 177.7842, 42238.728782),
(36, 1, 1, 3, 22627.08, 32278.298941, 2488.9788, 1470.7602, 169.7031, 40318.786565),
(35, 1, 1, 2, 22627.08, 32278.298941, 2488.9788, 1470.7602, 169.7031, 40318.786565),
(34, 1, 1, 1, 22627.08, 32278.298941, 2488.9788, 1470.7602, 169.7031, 40318.786565),
(33, 2, 2, 10, 9500, 13552.073, 1045, 617.5, 71.25, 16927.879),
(32, 3, 3, 11, 8000, 11412.272, 880, 520, 60, 14255.056),
(31, 4, 4, 12, 10000, 14265.34, 1100, 650, 75, 17818.82),
(30, 5, 5, 13, 30000, 42796.02, 3300, 1950, 225, 53456.46),
(44, 6, 6, 14, 8000, 8849.568, 0, 0, 0, 10180.528),
(28, 7, 7, 15, 7000, 7743.372, 0, 0, 0, 8907.962),
(27, 8, 8, 19, 10790, 15392.30186, 1186.9, 701.35, 80.925, 19226.50678),
(26, 8, 8, 18, 9260, 13209.70484, 1018.6, 601.9, 69.45, 16500.22732),
(25, 8, 8, 17, 8216, 11720.403344, 903.76, 534.04, 61.62, 14639.942512),
(24, 8, 8, 16, 5840, 8330.95856, 642.4, 379.6, 43.8, 10406.19088),
(22, 9, 9, 20, 5000, 5530.98, 0, 0, 0, 0),
(47, 10, 11, 15, 6000, 6637.176, 0, 0, 0, 7635.396);

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
  `pio` double NOT NULL DEFAULT '0',
  `health` double NOT NULL DEFAULT '0',
  `insurance` double NOT NULL DEFAULT '0',
  `bruto` double NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=362 ;

--
-- Dumping data for table `oszinvoiceitem2010`
--

INSERT INTO `oszinvoiceitem2010` (`ID`, `IDInvoice`, `IDInvoiceRuleDef`, `net`, `value`) VALUES
(296, 1, 26, 0, 357109.252429),
(295, 1, 25, 0, 357109.503344),
(294, 1, 27, 0, 337068.375344),
(293, 1, 24, 0, 20041.128),
(292, 1, 23, 0, 102349.874755),
(291, 1, 22, 0, 34307.220588),
(290, 1, 21, 0, 51174.937378),
(289, 1, 20, 0, 2144.201287),
(288, 1, 19, 0, 17582.450552),
(287, 1, 18, 0, 31448.285539),
(286, 1, 17, 0, 51174.937378),
(285, 1, 16, 0, 2144.201287),
(284, 1, 15, 0, 17582.450552),
(283, 1, 14, 0, 31448.285539),
(282, 1, 13, 0, 285893.504904),
(281, 1, 0, 1, 200411.28),
(280, 2, 26, 0, 16927.879),
(279, 2, 25, 0, 16927.890894),
(278, 2, 27, 0, 15977.890894),
(277, 2, 24, 0, 950),
(276, 2, 23, 0, 4851.642134),
(275, 2, 22, 0, 1626.24876),
(274, 2, 21, 0, 2425.821067),
(273, 2, 20, 0, 101.640547),
(272, 2, 19, 0, 833.45249),
(271, 2, 18, 0, 1490.72803),
(270, 2, 17, 0, 2425.821067),
(269, 2, 16, 0, 101.640547),
(268, 2, 15, 0, 833.45249),
(267, 2, 14, 0, 1490.72803),
(266, 2, 13, 0, 13552.073),
(265, 2, 0, 1, 9500),
(264, 3, 26, 0, 14255.056),
(263, 3, 25, 0, 14255.066016),
(262, 3, 27, 0, 13455.066016),
(261, 3, 24, 0, 800),
(260, 3, 23, 0, 4085.593376),
(259, 3, 22, 0, 1369.47264),
(258, 3, 21, 0, 2042.796688),
(257, 3, 20, 0, 85.59204),
(256, 3, 19, 0, 701.854728),
(255, 3, 18, 0, 1255.34992),
(254, 3, 17, 0, 2042.796688),
(253, 3, 16, 0, 85.59204),
(252, 3, 15, 0, 701.854728),
(251, 3, 14, 0, 1255.34992),
(250, 3, 13, 0, 11412.272),
(249, 3, 0, 1, 8000),
(248, 4, 26, 0, 17818.82),
(247, 4, 25, 0, 17818.83252),
(246, 4, 27, 0, 16818.83252),
(245, 4, 24, 0, 1000),
(244, 4, 23, 0, 5106.99172),
(243, 4, 22, 0, 1711.8408),
(242, 4, 21, 0, 2553.49586),
(241, 4, 20, 0, 106.99005),
(240, 4, 19, 0, 877.31841),
(239, 4, 18, 0, 1569.1874),
(238, 4, 17, 0, 2553.49586),
(237, 4, 16, 0, 106.99005),
(236, 4, 15, 0, 877.31841),
(235, 4, 14, 0, 1569.1874),
(234, 4, 13, 0, 14265.34),
(233, 4, 0, 1, 10000),
(229, 5, 24, 0, 3000),
(228, 5, 23, 0, 15320.97516),
(227, 5, 22, 0, 5135.5224),
(226, 5, 21, 0, 7660.48758),
(225, 5, 20, 0, 320.97015),
(224, 5, 19, 0, 2631.95523),
(223, 5, 18, 0, 4707.5622),
(222, 5, 17, 0, 7660.48758),
(221, 5, 16, 0, 320.97015),
(220, 5, 15, 0, 2631.95523),
(219, 5, 14, 0, 4707.5622),
(218, 5, 13, 0, 42796.02),
(217, 5, 0, 1, 30000),
(232, 5, 26, 0, 53456.46),
(231, 5, 25, 0, 53456.49756),
(230, 5, 27, 0, 50456.49756),
(322, 6, 12, 0, 10180.528),
(321, 6, 11, 0, 10180.53136),
(320, 6, 10, 0, 800),
(319, 6, 9, 0, 9380.53136),
(318, 6, 8, 0, 176.9912),
(317, 6, 7, 0, 353.9824),
(316, 6, 6, 0, 849.55776),
(315, 6, 5, 0, 566.37184),
(314, 6, 4, 0, 1415.9296),
(313, 6, 3, 0, 7079.648),
(312, 6, 2, 0, 1769.912),
(311, 6, 1, 0, 8849.56),
(310, 6, 0, 1, 8000),
(203, 7, 12, 0, 8907.962),
(202, 7, 11, 0, 8907.96494),
(201, 7, 10, 0, 700),
(200, 7, 9, 0, 8207.96494),
(199, 7, 8, 0, 154.8673),
(198, 7, 7, 0, 309.7346),
(197, 7, 6, 0, 743.36304),
(196, 7, 5, 0, 495.57536),
(195, 7, 4, 0, 1238.9384),
(194, 7, 3, 0, 6194.692),
(193, 7, 2, 0, 1548.673),
(192, 7, 1, 0, 7743.365),
(191, 7, 0, 1, 7000),
(190, 8, 26, 0, 60772.867492),
(189, 8, 25, 0, 60772.910193),
(188, 8, 27, 0, 57362.310193),
(187, 8, 24, 0, 3410.6),
(186, 8, 23, 0, 17417.90596),
(185, 8, 22, 0, 5838.404232),
(184, 8, 21, 0, 8708.95298),
(183, 8, 20, 0, 364.900265),
(182, 8, 19, 0, 2992.182169),
(181, 8, 18, 0, 5351.870546),
(180, 8, 17, 0, 8708.95298),
(179, 8, 16, 0, 364.900265),
(178, 8, 15, 0, 2992.182169),
(177, 8, 14, 0, 5351.870546),
(176, 8, 13, 0, 48653.368604),
(175, 8, 0, 1, 34106),
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
(149, 9, 0, 1, 5000),
(361, 10, 12, 0, 7635.396),
(360, 10, 11, 0, 7635.39852),
(359, 10, 10, 0, 600),
(358, 10, 9, 0, 7035.39852),
(357, 10, 8, 0, 132.7434),
(356, 10, 7, 0, 265.4868),
(355, 10, 6, 0, 637.16832),
(354, 10, 5, 0, 424.77888),
(353, 10, 4, 0, 1061.9472),
(352, 10, 3, 0, 5309.736),
(351, 10, 2, 0, 1327.434),
(350, 10, 1, 0, 6637.17),
(349, 10, 0, 1, 6000);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

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
(15, 1, 0, 'Doprinos za zdravstveno osiguranje na teret isplatioca prihoda', 0, 9, 8, '', 0, '', 0, 'def', '', ''),
(16, 2, 1, 'Neto zarada zadrugara', 1, 1, 0, '', 0, '', 0, 'ugo', '', ''),
(17, 2, 1, 'Porez na zaradu', 0, 2, 22, '', 0, '', 0, 'def', '', ''),
(18, 2, 1, 'Doprinosi za socijalno osiguranje', 0, 3, 23, '', 0, '', 0, 'def', '', ''),
(19, 2, 1, 'Svega za refundaciju', 0, 4, 27, '', 0, '', 0, 'def', '', ''),
(20, 2, 1, 'Članski doprinos', 0, 5, 24, '', 0, '', 0, 'def', '', ''),
(21, 2, 1, 'Ukupno za uplatu', 0, 6, 25, '', 0, '', 0, 'def', '', ''),
(22, 2, 0, 'Za PIO na teret zaposlenog', 0, 1, 14, '', 0, '', 0, 'def', '', ''),
(23, 2, 0, 'Za zdravstveno osiguranje na teret zaposlenog', 0, 2, 15, '', 0, '', 0, 'def', '', ''),
(24, 2, 0, 'Za osiguranje od slučaja nezaposlenosti', 0, 3, 16, '', 0, '', 0, 'def', '', ''),
(25, 2, 0, 'Na teret zaposlenog', 0, 4, 17, '', 0, '', 0, 'def', '', ''),
(26, 2, 0, 'Za PIO na teret poslodavca', 0, 5, 18, '', 0, '', 0, 'def', '', ''),
(27, 2, 0, 'Za zdravstveno osiguranje na teret poslodavca', 0, 6, 19, '', 0, '', 0, 'def', '', ''),
(28, 2, 0, 'Za osiguranje od nezaposlenosti na teret poslodavca', 0, 7, 20, '', 0, '', 0, 'def', '', ''),
(29, 2, 0, 'Na teret poslodavca', 0, 8, 21, '', 0, '', 0, 'def', '', ''),
(30, 2, 0, 'Ukupno plaćen porez', 0, 9, 22, '', 0, '', 0, 'def', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

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
(35, 'Pregled obračuna', 'pregledobracun.php', 15, 2),
(36, 'Parametri evidencije', 'evidencija.php', 4, 5),
(37, 'Obračun ugovora', 'ugovor.php', 2, 3),
(38, 'Obračun ugovora', 'ugovorracun.php', 37, 1),
(39, 'Obračun ugovora', 'ugovorobracun.php', 37, 1),
(40, 'Definicije obračuna ugovora', 'parametarugunos.php', 17, 2),
(41, 'Parametri štampe obračuna ugovora', 'parametarstampaugunos.php', 29, 2),
(42, 'Knjiga ugovora - Pregled', 'pregledobugovor.php', 14, 1);

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
