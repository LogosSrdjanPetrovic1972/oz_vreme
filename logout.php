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
* @copyright    (C)2011 by Srdan Petrovic@edotplus. All rights reserved.
* @license      Edotplus applications are not free software. For usage, distribution, using,
*               changing or copying any part of the code you need to have exclusive permission
*               by Srdjan Petrovic. Any violation of those rules will be considered as
*               intellectual property theft!
*
* @file         logout.php
* @package       
* @subpackage   
*
* @description  Logout page
*
* @history      01.02.2012. ; srdjanp ; Initial revision
*
*/
define('_EDOTPLUS_ALLOW',     1);

$redirect = "./zadrugar.php";
if (isset($_POST["redirect"])) $redirect = trim($_POST["redirect"]);

/* must be included */
require_once('./include/globals.inc');
require_once('./include/debug.php');
require_once('./include/c_db.php');
require_once('./include/common.php');
require_once('./include/c_session.php');
require_once('./lang/sr.php');

// get settings 
if (!isset($_session))
{
  $_session = new c_Session;
}

$_session->_delSessionVar();
if ($redirect == "./parametarunos_form.php")
  $redirect = "./parametarobracun.php";
header("location: $redirect");
?>