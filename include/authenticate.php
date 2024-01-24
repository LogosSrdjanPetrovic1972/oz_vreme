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
* @copyright    (C)2011 by Srđan Petrović@edotplus. All rights reserved.
* @license      Edotplus applications are not free software. For usage, distribution, using,
*               changing or copying any part of the code you need to have exclusive permission
*               by Srdjan Petrovic. Any violation of those rules will be considered as
*               intellectual property theft!
*
* @file         authenticate.php
* @package      include 
* @subpackage   
*
* @description  Authentication file
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/

function isAuthenticate() {
  session_start();
  if (isset($_SESSION['_ID']))
    return true;
  else
    return false;
}

function setAuthenticate($authenticateSet = array()) {
  session_start();
  if (isset($authenticateSet[0])) {
    $_SESSION["_ID"]      = $authenticateSet[0];
    $_SESSION["_Ime"]     = $authenticateSet[1];
    $_SESSION["_Prezime"] = $authenticateSet[2];
  } 
   
}

function getAuthenticate() {
  return array(
    $_SESSION["_ID"],
    $_SESSION["_Ime"],
    $_SESSION["_Prezime"]
  );
}

?>