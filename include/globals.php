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
* @file         globals.php
* @package      include 
* @subpackage   
*
* @description  Global definitions
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/
 
 /* database definitions */
 $GLOBALS["invoicerule"]    = array(
    ">"   => "stariji od",
    "<"   => "mlađi od",
    "<="  => "do starosne granice",
    ">="  => "od starosne granice"
 );
?>