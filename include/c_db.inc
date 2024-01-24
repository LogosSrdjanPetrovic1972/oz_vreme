<?php
/* $Id$ */
/**
*
* @author         $Author$
* @version        $Revision$
* @lastrevision   $Date$
* @modifiedby     $LastChangedBy$
* @lastmodified   $LastChangedDate$
*
*/
/**
*
* EDOTPLUS 
*
* @project      EZADRUGA web portal
* @copyright    (C)2011 by Srdjan Petrovic@edotplus. All rights reserved.
* @license      Edotplus applications are not free software. For usage, distribution, using,
*               changing or copying any part of the code you need to have exclusive permission
*               by Srdjan Petrovic. Any violation of those rules will be considered as
*               intellectual property theft!
*
* @file         c_db.inc
* @package      include 
* @subpackage   
*
* @description  Database connection ASCII
*
* @important    The inc extensions is used for security reasons
*                Configure server to prevent view the content of the inc file
*                !!! For correct work database must be created !!!
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/
defined('_EDOTPLUS_ALLOW') or die('Access is forbidden!');

$GLOBALS["connect"]        = "localhost";
$GLOBALS["username"]       = "root";
$GLOBALS["password"]       = "root";
$GLOBALS["database"]       = "oszadruga";

// $conn = mysql_pconnect($GLOBALS["connect"], $GLOBALS["username"], $GLOBALS["password"]) or die(mysql_error());
$conn = mysql_connect($GLOBALS["connect"], $GLOBALS["username"], $GLOBALS["password"]) or die(mysql_error());
mysql_select_db($GLOBALS["database"],$conn) 
  or die(mysql_error());

?>