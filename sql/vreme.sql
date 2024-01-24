-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Домаћин: localhost
-- Време креирања: 18. јан 2010. у 20:08
-- Верзија сервера: 5.0.45
-- верзија PHP-a: 5.2.3-1ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База података: `www_dbspzin_com`
--

-- --------------------------------------------------------

--
-- Структура табеле `OSZContract2010`
--

CREATE TABLE IF NOT EXISTS `OSZContract2010` (
  `ID` int(11) NOT NULL auto_increment,
  `IDEmployer` int(11) NOT NULL,
  `contractnumber` int(11) default NULL,
  `contractdate` date default NULL,
  `contractfrom` date default NULL,
  `contractto` date default NULL,
  `hours` varchar(5) collate utf8_unicode_ci default NULL,
  `jobdescription` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`ID`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZContract2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZContract2011`
--

CREATE TABLE IF NOT EXISTS `OSZContract2011` (
  `ID` int(11) NOT NULL auto_increment,
  `IDEmployer` int(11) NOT NULL,
  `contractnumber` int(11) default NULL,
  `contractdate` date default NULL,
  `contractfrom` date default NULL,
  `contractto` date default NULL,
  `hours` varchar(5) collate utf8_unicode_ci default NULL,
  `jobdescription` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`ID`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Приказ података табеле `OSZContract2011`
--

INSERT INTO `OSZContract2011` (`ID`, `IDEmployer`, `contractnumber`, `contractdate`, `contractfrom`, `contractto`, `hours`, `jobdescription`) VALUES
(1, 3, NULL, '2010-01-14', NULL, NULL, NULL, 'Testiranje otpadnih voda na mišiju groznicu'),
(3, 3, NULL, '2010-01-18', NULL, NULL, NULL, 'Samo da nije nešto'),
(4, -1, NULL, '2010-01-18', NULL, NULL, NULL, 'Obavljanje internih poslova za zadrugu');

-- --------------------------------------------------------

--
-- Структура табеле `OSZContractItem2010`
--

CREATE TABLE IF NOT EXISTS `OSZContractItem2010` (
  `ID` int(11) NOT NULL auto_increment,
  `IDContract` int(11) NOT NULL,
  `IDMember` int(11) NOT NULL,
  `net` double default NULL,
  `contractfrom` date default NULL,
  `contractto` date default NULL,
  `hours` varchar(5) collate utf8_unicode_ci default NULL,
  `value` double NOT NULL default '0',
  `pio` double NOT NULL default '0',
  `health` double NOT NULL default '0',
  `insurance` double NOT NULL default '0',
  `bruto` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDContract` (`IDContract`,`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZContractItem2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZContractItem2011`
--

CREATE TABLE IF NOT EXISTS `OSZContractItem2011` (
  `ID` int(11) NOT NULL auto_increment,
  `IDContract` int(11) NOT NULL,
  `IDMember` int(11) NOT NULL,
  `net` double default NULL,
  `contractfrom` date default NULL,
  `contractto` date default NULL,
  `hours` varchar(5) collate utf8_unicode_ci default NULL,
  `value` double NOT NULL default '0',
  `pio` double NOT NULL default '0',
  `health` double NOT NULL default '0',
  `insurance` double NOT NULL default '0',
  `bruto` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDContract` (`IDContract`,`IDMember`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Приказ података табеле `OSZContractItem2011`
--

INSERT INTO `OSZContractItem2011` (`ID`, `IDContract`, `IDMember`, `net`, `contractfrom`, `contractto`, `hours`, `value`, `pio`, `health`, `insurance`, `bruto`) VALUES
(1, 1, 2, 3927, '2010-01-04', '2010-01-06', '24', 0, 0, 0, 0, 0),
(2, 1, 1, 4735, '2010-01-04', '2010-01-07', '32', 0, 0, 0, 0, 0),
(6, 3, 1, 2783, '2010-01-18', '2010-01-18', '8', 0, 0, 0, 0, 0),
(5, 3, 2, 4324, '2010-01-18', '2010-01-18', '8', 0, 0, 0, 0, 0),
(7, 4, 3, 2432, '2010-01-18', '2010-01-18', '8', 0, 0, 0, 0, 0),
(8, 4, 4, 1212, '2010-01-18', '2010-01-18', '8', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура табеле `OSZContractRuleDef`
--

CREATE TABLE IF NOT EXISTS `OSZContractRuleDef` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Приказ података табеле `OSZContractRuleDef`
--

INSERT INTO `OSZContractRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES
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
(11, 1, 'Kontrola Neto na Bruto', 12, 0, 0, '*', 0, 1.272566, 0, '', 0, 0, 1, 1),
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
(25, 2, 'Kontrola Neto na Bruto', 15, 0, 0, '*', 0, 1.781882, 0, '', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Структура табеле `OSZContractRuleItem2010`
--

CREATE TABLE IF NOT EXISTS `OSZContractRuleItem2010` (
  `ID` int(11) NOT NULL auto_increment,
  `IDContract` int(11) NOT NULL default '0',
  `IDMember` int(11) NOT NULL default '0',
  `IDInvoiceRuleDef` int(11) NOT NULL default '0',
  `net` tinyint(4) NOT NULL default '0',
  `value` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDContract` (`IDContract`),
  KEY `IDMember` (`IDMember`),
  KEY `IDInvoiceRuleDef` (`IDInvoiceRuleDef`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZContractRuleItem2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZContractRuleItem2011`
--

CREATE TABLE IF NOT EXISTS `OSZContractRuleItem2011` (
  `ID` int(11) NOT NULL auto_increment,
  `IDContract` int(11) NOT NULL default '0',
  `IDMember` int(11) NOT NULL default '0',
  `IDInvoiceRuleDef` int(11) NOT NULL default '0',
  `net` tinyint(4) NOT NULL default '0',
  `value` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDContract` (`IDContract`),
  KEY `IDMember` (`IDMember`),
  KEY `IDInvoiceRuleDef` (`IDInvoiceRuleDef`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZContractRuleItem2011`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZContractRulePrt`
--

CREATE TABLE IF NOT EXISTS `OSZContractRulePrt` (
  `ID` int(11) NOT NULL auto_increment,
  `IDInvoiceRule` int(11) NOT NULL default '0',
  `invoice` tinyint(4) NOT NULL default '0',
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `net` tinyint(4) NOT NULL default '0',
  `sort` tinyint(4) NOT NULL default '0',
  `inputA` int(11) NOT NULL default '0',
  `inputAOper` varchar(1) collate utf8_unicode_ci NOT NULL,
  `inputB` int(11) NOT NULL default '0',
  `inputBOper` varchar(1) collate utf8_unicode_ci NOT NULL,
  `inputC` int(11) NOT NULL default '0',
  `inputASrc` varchar(3) collate utf8_unicode_ci NOT NULL,
  `inputBSrc` varchar(3) collate utf8_unicode_ci NOT NULL,
  `inputCSrc` varchar(3) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `IDInvoiceRule` (`IDInvoiceRule`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Приказ података табеле `OSZContractRulePrt`
--

INSERT INTO `OSZContractRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES
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
-- Структура табеле `OSZCooperative`
--

CREATE TABLE IF NOT EXISTS `OSZCooperative` (
  `ID` smallint(6) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `short` varchar(50) collate utf8_unicode_ci default NULL,
  `shortest` varchar(20) collate utf8_unicode_ci default NULL,
  `address` varchar(255) collate utf8_unicode_ci default NULL,
  `IDPlace` smallint(6) default '0',
  `phone` varchar(20) collate utf8_unicode_ci default NULL,
  `mobile` varchar(20) collate utf8_unicode_ci default NULL,
  `fax` varchar(20) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `url` varchar(255) collate utf8_unicode_ci default NULL,
  `account` varchar(255) collate utf8_unicode_ci default NULL,
  `reference` varchar(255) collate utf8_unicode_ci default NULL,
  `pib` varchar(20) collate utf8_unicode_ci default NULL,
  `idnumber` varchar(20) collate utf8_unicode_ci default NULL,
  `activity` varchar(20) collate utf8_unicode_ci default NULL,
  `currentyear` varchar(4) collate utf8_unicode_ci default NULL,
  `contracthours` tinyint(4) default '0',
  `memberhours` tinyint(4) default '0',
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`),
  KEY `IDPlace` (`IDPlace`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Приказ података табеле `OSZCooperative`
--

INSERT INTO `OSZCooperative` (`ID`, `name`, `short`, `shortest`, `address`, `IDPlace`, `phone`, `mobile`, `fax`, `email`, `url`, `account`, `reference`, `pib`, `idnumber`, `activity`, `currentyear`, `contracthours`, `memberhours`) VALUES
(1, 'Omladinska zadruga "VREME"', 'OZ "VREME"', '"VREME"', 'FRANCUSKA 23', 59, '(026)315-909', '(063)289.022', '(026)315-909', '', '', '170-003008420001-19', '355-1023876-05', '7844069', '101928789', '74840', '2011', 0, 1);

-- --------------------------------------------------------

--
-- Структура табеле `OSZDocument2010`
--

CREATE TABLE IF NOT EXISTS `OSZDocument2010` (
  `IDMember` int(11) NOT NULL,
  `document` varchar(20) collate utf8_unicode_ci NOT NULL,
  `publisher` varchar(70) collate utf8_unicode_ci NOT NULL,
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Приказ података табеле `OSZDocument2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZDocument2011`
--

CREATE TABLE IF NOT EXISTS `OSZDocument2011` (
  `IDMember` int(11) NOT NULL,
  `document` varchar(20) collate utf8_unicode_ci NOT NULL,
  `publisher` varchar(70) collate utf8_unicode_ci NOT NULL,
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Приказ података табеле `OSZDocument2011`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZEmployer`
--

CREATE TABLE IF NOT EXISTS `OSZEmployer` (
  `ID` smallint(6) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `address` varchar(255) collate utf8_unicode_ci default NULL,
  `IDPlace` smallint(6) default NULL,
  `phone` varchar(20) collate utf8_unicode_ci default NULL,
  `mobile` varchar(20) collate utf8_unicode_ci default NULL,
  `fax` varchar(20) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `url` varchar(255) collate utf8_unicode_ci default NULL,
  `account` varchar(255) collate utf8_unicode_ci default NULL,
  `pib` varchar(20) collate utf8_unicode_ci default NULL,
  `idnumber` varchar(20) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`),
  KEY `IDPlace` (`IDPlace`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Приказ података табеле `OSZEmployer`
--

INSERT INTO `OSZEmployer` (`ID`, `name`, `address`, `IDPlace`, `phone`, `mobile`, `fax`, `email`, `url`, `account`, `pib`, `idnumber`) VALUES
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
(11, 'INSTITUT ZA POVRTARSTVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'JAVNO KOMUNALNO PREDUZEĆE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'JRDNP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'KATASTAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'KC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'KK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'KLANICA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'KRAJSER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'MLINPEK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'GOŠA MONTAŽA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
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
(-1, 'Omladinska zadruga "VREME" ', 'FRANCUSKA 23', 59, '(026)315-909 ', '(063)289.022 ', '(026)315-909 ', NULL, NULL, '170-003008420001-19 ', '7844069 ', '101928789 ');

-- --------------------------------------------------------

--
-- Структура табеле `OSZGrad`
--

CREATE TABLE IF NOT EXISTS `OSZGrad` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(70) collate utf8_unicode_ci NOT NULL,
  `post` varchar(5) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(5) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=120 ;

--
-- Приказ података табеле `OSZGrad`
--

INSERT INTO `OSZGrad` (`ID`, `name`, `post`, `phone`) VALUES
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
(119, 'Žitište', '', '');

-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoice2010`
--

CREATE TABLE IF NOT EXISTS `OSZInvoice2010` (
  `ID` int(11) NOT NULL auto_increment,
  `IDContract` int(11) NOT NULL default '0',
  `date` date NOT NULL,
  `net` double NOT NULL default '0',
  `tax` double NOT NULL default '0',
  `contribute` double NOT NULL default '0',
  `claimsum` double NOT NULL default '0',
  `cooperative` double NOT NULL default '0',
  `sum` double NOT NULL default '0',
  `rule` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDContract` (`IDContract`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZInvoice2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoice2011`
--

CREATE TABLE IF NOT EXISTS `OSZInvoice2011` (
  `ID` int(11) NOT NULL auto_increment,
  `IDContract` int(11) NOT NULL default '0',
  `date` date NOT NULL,
  `net` double NOT NULL default '0',
  `tax` double NOT NULL default '0',
  `contribute` double NOT NULL default '0',
  `claimsum` double NOT NULL default '0',
  `cooperative` double NOT NULL default '0',
  `sum` double NOT NULL default '0',
  `rule` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDContract` (`IDContract`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Приказ података табеле `OSZInvoice2011`
--

INSERT INTO `OSZInvoice2011` (`ID`, `IDContract`, `date`, `net`, `tax`, `contribute`, `claimsum`, `cooperative`, `sum`, `rule`) VALUES
(1, 1, '2010-01-14', 8662, 919.858665, 574.911665, 10156.77033, 866.2, 11022.97033, 1),
(3, 3, '2010-01-18', 7107, 754.725875, 471.703672, 8333.429547, 710.7, 9044.129547, 1);

-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoiceContractItem2010`
--

CREATE TABLE IF NOT EXISTS `OSZInvoiceContractItem2010` (
  `ID` int(11) NOT NULL auto_increment,
  `IDInvoice` int(11) NOT NULL default '0',
  `IDContract` int(11) NOT NULL default '0',
  `IDMember` int(11) NOT NULL default '0',
  `net` double NOT NULL default '0',
  `value` double NOT NULL default '0',
  `pio` double NOT NULL default '0',
  `health` double NOT NULL default '0',
  `insurance` double NOT NULL default '0',
  `bruto` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDInvoice` (`IDInvoice`),
  KEY `IDContract` (`IDContract`),
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZInvoiceContractItem2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoiceContractItem2011`
--

CREATE TABLE IF NOT EXISTS `OSZInvoiceContractItem2011` (
  `ID` int(11) NOT NULL auto_increment,
  `IDInvoice` int(11) NOT NULL default '0',
  `IDContract` int(11) NOT NULL default '0',
  `IDMember` int(11) NOT NULL default '0',
  `net` double NOT NULL default '0',
  `value` double NOT NULL default '0',
  `pio` double NOT NULL default '0',
  `health` double NOT NULL default '0',
  `insurance` double NOT NULL default '0',
  `bruto` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDInvoice` (`IDInvoice`),
  KEY `IDContract` (`IDContract`),
  KEY `IDMember` (`IDMember`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Приказ података табеле `OSZInvoiceContractItem2011`
--

INSERT INTO `OSZInvoiceContractItem2011` (`ID`, `IDInvoice`, `IDContract`, `IDMember`, `net`, `value`, `pio`, `health`, `insurance`, `bruto`) VALUES
(8, 1, 1, 2, 3927, 4344.031692, 0, 0, 0, 4997.366682),
(7, 1, 1, 1, 4735, 5237.83806, 0, 0, 0, 6025.60001),
(12, 3, 3, 2, 4324, 4783.191504, 0, 0, 0, 5502.575384),
(11, 3, 3, 1, 2783, 3078.543468, 0, 0, 0, 3541.551178);

-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoiceItem2010`
--

CREATE TABLE IF NOT EXISTS `OSZInvoiceItem2010` (
  `ID` int(11) NOT NULL auto_increment,
  `IDInvoice` int(11) NOT NULL default '0',
  `IDInvoiceRuleDef` int(11) NOT NULL default '0',
  `net` tinyint(4) NOT NULL default '0',
  `value` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDInvoice` (`IDInvoice`),
  KEY `IDInvoiceRuleDef` (`IDInvoiceRuleDef`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZInvoiceItem2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoiceItem2011`
--

CREATE TABLE IF NOT EXISTS `OSZInvoiceItem2011` (
  `ID` int(11) NOT NULL auto_increment,
  `IDInvoice` int(11) NOT NULL default '0',
  `IDInvoiceRuleDef` int(11) NOT NULL default '0',
  `net` tinyint(4) NOT NULL default '0',
  `value` double NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDInvoice` (`IDInvoice`),
  KEY `IDInvoiceRuleDef` (`IDInvoiceRuleDef`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=82 ;

--
-- Приказ података табеле `OSZInvoiceItem2011`
--

INSERT INTO `OSZInvoiceItem2011` (`ID`, `IDInvoice`, `IDInvoiceRuleDef`, `net`, `value`) VALUES
(55, 1, 12, 0, 11022.966692),
(54, 1, 11, 0, 11022.97033),
(53, 1, 10, 0, 866.2),
(52, 1, 9, 0, 10156.77033),
(51, 1, 8, 0, 191.637222),
(50, 1, 7, 0, 383.274444),
(49, 1, 6, 0, 919.858665),
(48, 1, 5, 0, 613.23911),
(47, 1, 4, 0, 1533.097774),
(46, 1, 3, 0, 7665.488872),
(45, 1, 2, 0, 1916.372218),
(44, 1, 1, 0, 9581.86109),
(43, 1, 0, 1, 8662),
(81, 3, 12, 0, 9044.126562),
(80, 3, 11, 0, 9044.129547),
(79, 3, 10, 0, 710.7),
(78, 3, 9, 0, 8333.429547),
(77, 3, 8, 0, 157.234557),
(76, 3, 7, 0, 314.469115),
(75, 3, 6, 0, 754.725875),
(74, 3, 5, 0, 503.150583),
(73, 3, 4, 0, 1257.876458),
(72, 3, 3, 0, 6289.382292),
(71, 3, 2, 0, 1572.345573),
(70, 3, 1, 0, 7861.727865),
(69, 3, 0, 1, 7107);

-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoiceRule`
--

CREATE TABLE IF NOT EXISTS `OSZInvoiceRule` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `agerule` varchar(2) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Приказ података табеле `OSZInvoiceRule`
--

INSERT INTO `OSZInvoiceRule` (`ID`, `name`, `age`, `agerule`) VALUES
(1, 'Definicija obračuna do 26 godina', 26, '<='),
(2, 'Definicija obračuna za starije od 26 godina', 26, '>');

-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoiceRuleDef`
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
-- Приказ података табеле `OSZInvoiceRuleDef`
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

-- --------------------------------------------------------

--
-- Структура табеле `OSZInvoiceRulePrt`
--

CREATE TABLE IF NOT EXISTS `OSZInvoiceRulePrt` (
  `ID` int(11) NOT NULL auto_increment,
  `IDInvoiceRule` int(11) NOT NULL default '0',
  `invoice` tinyint(4) NOT NULL default '0',
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `net` tinyint(4) NOT NULL default '0',
  `sort` tinyint(4) NOT NULL default '0',
  `inputA` int(11) NOT NULL default '0',
  `inputAOper` varchar(1) collate utf8_unicode_ci NOT NULL,
  `inputB` int(11) NOT NULL default '0',
  `inputBOper` varchar(1) collate utf8_unicode_ci NOT NULL,
  `inputC` int(11) NOT NULL default '0',
  `inputASrc` varchar(3) collate utf8_unicode_ci NOT NULL,
  `inputBSrc` varchar(3) collate utf8_unicode_ci NOT NULL,
  `inputCSrc` varchar(3) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `IDInvoiceRule` (`IDInvoiceRule`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Приказ података табеле `OSZInvoiceRulePrt`
--

INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES
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
-- Структура табеле `OSZMember2010`
--

CREATE TABLE IF NOT EXISTS `OSZMember2010` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(70) collate utf8_unicode_ci NOT NULL,
  `surname` varchar(70) collate utf8_unicode_ci NOT NULL,
  `parent` varchar(70) collate utf8_unicode_ci default NULL,
  `jmbr` varchar(13) collate utf8_unicode_ci default NULL,
  `idnumber` varchar(15) collate utf8_unicode_ci default NULL,
  `mup` varchar(70) collate utf8_unicode_ci default NULL,
  `birthday` date default NULL,
  `birthplace` varchar(70) collate utf8_unicode_ci default NULL,
  `address` varchar(255) collate utf8_unicode_ci default NULL,
  `IDAddressPlace` smallint(6) default NULL,
  `occupation` varchar(255) collate utf8_unicode_ci default NULL,
  `specialkno` varchar(255) collate utf8_unicode_ci default NULL,
  `healthinsur` tinyint(1) default NULL,
  `memberother` tinyint(1) default NULL,
  `IDMemberBasis` tinyint(4) default NULL,
  `phone` varchar(20) collate utf8_unicode_ci default NULL,
  `mobile` varchar(20) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `IDEmployer` smallint(6) default NULL,
  `memberdate` date default NULL,
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`),
  KEY `surname` (`surname`),
  KEY `name_2` (`name`,`surname`),
  KEY `birthplace` (`birthplace`),
  KEY `IDAddressPlace` (`IDAddressPlace`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Приказ података табеле `OSZMember2010`
--


-- --------------------------------------------------------

--
-- Структура табеле `OSZMember2011`
--

CREATE TABLE IF NOT EXISTS `OSZMember2011` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(70) collate utf8_unicode_ci NOT NULL,
  `surname` varchar(70) collate utf8_unicode_ci NOT NULL,
  `parent` varchar(70) collate utf8_unicode_ci default NULL,
  `jmbr` varchar(13) collate utf8_unicode_ci default NULL,
  `idnumber` varchar(15) collate utf8_unicode_ci default NULL,
  `mup` varchar(70) collate utf8_unicode_ci default NULL,
  `birthday` date default NULL,
  `birthplace` varchar(70) collate utf8_unicode_ci default NULL,
  `address` varchar(255) collate utf8_unicode_ci default NULL,
  `IDAddressPlace` smallint(6) default NULL,
  `occupation` varchar(255) collate utf8_unicode_ci default NULL,
  `specialkno` varchar(255) collate utf8_unicode_ci default NULL,
  `healthinsur` tinyint(1) default NULL,
  `memberother` tinyint(1) default NULL,
  `IDMemberBasis` tinyint(4) default NULL,
  `phone` varchar(20) collate utf8_unicode_ci default NULL,
  `mobile` varchar(20) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `IDEmployer` smallint(6) default NULL,
  `memberdate` date default NULL,
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`),
  KEY `surname` (`surname`),
  KEY `name_2` (`name`,`surname`),
  KEY `birthplace` (`birthplace`),
  KEY `IDAddressPlace` (`IDAddressPlace`),
  KEY `IDEmployer` (`IDEmployer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Приказ података табеле `OSZMember2011`
--

INSERT INTO `OSZMember2011` (`ID`, `name`, `surname`, `parent`, `jmbr`, `idnumber`, `mup`, `birthday`, `birthplace`, `address`, `IDAddressPlace`, `occupation`, `specialkno`, `healthinsur`, `memberother`, `IDMemberBasis`, `phone`, `mobile`, `email`, `IDEmployer`, `memberdate`) VALUES
(1, 'Mlađan', 'Marković', '', '', '', '', '1990-01-01', '', '', 0, '', '', 1, 0, 0, '', '', '', 0, '2010-01-14'),
(2, 'Mlađan', 'Mišković', '', '', '', '', '1991-04-02', '', '', 0, '', '', 1, 0, 0, '', '', '', 0, '2010-01-14'),
(3, 'Stojan ', 'Stojanović', '', '', '', '', '1950-01-01', '', '', 0, '', '', 1, 0, 0, '', '', '', 0, '2010-01-14'),
(4, 'Petar', 'Petrović', '', '', '', '', '1950-01-01', '', '', 0, '', '', 1, 0, 0, '', '', '', 0, '2010-01-14');

-- --------------------------------------------------------

--
-- Структура табеле `OSZMemberBasis`
--

CREATE TABLE IF NOT EXISTS `OSZMemberBasis` (
  `ID` tinyint(4) NOT NULL auto_increment,
  `name` varchar(70) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Приказ података табеле `OSZMemberBasis`
--

INSERT INTO `OSZMemberBasis` (`ID`, `name`) VALUES
(1, 'Student'),
(2, 'Učenik'),
(3, 'Nezaposlen'),
(4, 'Posebni uslovi');

-- --------------------------------------------------------

--
-- Структура табеле `OSZMenu`
--

CREATE TABLE IF NOT EXISTS `OSZMenu` (
  `ID` smallint(6) NOT NULL auto_increment,
  `title` varchar(70) collate utf8_unicode_ci NOT NULL,
  `link` varchar(255) collate utf8_unicode_ci NOT NULL,
  `root` smallint(6) NOT NULL default '0',
  `sort` tinyint(4) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `title` (`title`),
  KEY `root` (`root`),
  KEY `link` (`link`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Приказ података табеле `OSZMenu`
--

INSERT INTO `OSZMenu` (`ID`, `title`, `link`, `root`, `sort`) VALUES
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
(28, 'Definicija obračuna fakture', 'parametarunos.php', 17, 1),
(29, 'Parametri štampe', 'parametarstampa.php', 4, 2),
(30, 'Parametri štampe obračuna fakture', 'parametarstampaunos.php', 29, 1),
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
(41, 'Parametri štampe obračuna ugovora', 'parametarstampaugunos.php', 29, 2);

-- --------------------------------------------------------

--
-- Структура табеле `OSZOsnovClanstva`
--

CREATE TABLE IF NOT EXISTS `OSZOsnovClanstva` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(70) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Приказ података табеле `OSZOsnovClanstva`
--

INSERT INTO `OSZOsnovClanstva` (`ID`, `name`) VALUES
(1, 'Učenik'),
(2, 'Student'),
(3, 'Nezaposlen');

-- --------------------------------------------------------

--
-- Структура табеле `OSZPlace`
--

CREATE TABLE IF NOT EXISTS `OSZPlace` (
  `ID` smallint(6) NOT NULL auto_increment,
  `name` varchar(70) collate utf8_unicode_ci NOT NULL,
  `post` varchar(5) collate utf8_unicode_ci default NULL,
  `phone` varchar(5) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`ID`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=120 ;

--
-- Приказ података табеле `OSZPlace`
--

INSERT INTO `OSZPlace` (`ID`, `name`, `post`, `phone`) VALUES
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
(119, 'Žitište', '', '');

-- --------------------------------------------------------

--
-- Структура табеле `OSZPrint`
--

CREATE TABLE IF NOT EXISTS `OSZPrint` (
  `IDPrint` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `contract` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`IDPrint`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Приказ података табеле `OSZPrint`
--

INSERT INTO `OSZPrint` (`IDPrint`, `name`, `contract`) VALUES
(1, 'Ugovor', 1);

-- --------------------------------------------------------

--
-- Структура табеле `OSZPrintItem`
--

CREATE TABLE IF NOT EXISTS `OSZPrintItem` (
  `ID` int(11) NOT NULL auto_increment,
  `IDPrint` int(11) NOT NULL default '0',
  `sort` tinyint(4) NOT NULL default '0',
  `text` text collate utf8_unicode_ci NOT NULL,
  `align` varchar(1) collate utf8_unicode_ci NOT NULL default 'L',
  `font` varchar(20) collate utf8_unicode_ci NOT NULL default 'Arial',
  `fontsize` tinyint(4) NOT NULL default '0',
  `style` varchar(1) collate utf8_unicode_ci NOT NULL,
  `ln` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Приказ података табеле `OSZPrintItem`
--

INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES
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
-- Структура табеле `OSZYear`
--

CREATE TABLE IF NOT EXISTS `OSZYear` (
  `ID` int(11) NOT NULL auto_increment,
  `year` varchar(4) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Приказ података табеле `OSZYear`
--

INSERT INTO `OSZYear` (`ID`, `year`) VALUES
(1, '2010'),
(2, '2011');
