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
* @file         index.php
* @package      
* @subpackage   
*
* @description  Starting page, if database is not installed go to installation process
*               otherwise goto "main page" -> zadrugar.php
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
header('location: zadrugar.php');
?>