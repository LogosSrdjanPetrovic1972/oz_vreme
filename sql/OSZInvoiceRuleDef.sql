-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2010 at 02:33 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3-1ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `www_dbspzin_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `OSZInvoiceRuleDef`
--

CREATE TABLE IF NOT EXISTS `OSZInvoiceRuleDef` (
  `ID` int(11) NOT NULL auto_increment,
  `IDInvoiceRule` int(11) NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `sort` tinyint(4) NOT NULL default '0',
  `invoice` tinyint(4) NOT NULL default '0',
  `report` tinyint(4) NOT NULL default '0',
  `operator` varchar(1) collate utf8_unicode_ci NOT NULL,
  `input` int(11) NOT NULL default '0',
  `inputVal` double NOT NULL default '0',
  `inputY` int(11) NOT NULL default '0',
  `operatorY` varchar(1) collate utf8_unicode_ci NOT NULL,
  `inputZ` int(11) NOT NULL default '0',
  `contributesum` tinyint(4) NOT NULL default '0',
  `inputnet` tinyint(4) NOT NULL default '0',
  `control` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDInvoiceRule` (`IDInvoiceRule`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `OSZInvoiceRuleDef`
--

INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES
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
