-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Домаћин: localhost
-- Време креирања: 18. јан 2010. у 20:23
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
