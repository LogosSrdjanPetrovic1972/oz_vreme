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
* @file         globals.inc
* @package      include 
* @subpackage   
*
* @description  Global definitions
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/ 
 /* database definitions */
 $GLOBALS["connect"]        = "localhost";
// intranet - localhost
$GLOBALS["username"]       = "root";
$GLOBALS["password"]       = "root";
$GLOBALS["database"]       = "oszadruga";


$GLOBALS["invoicerule"]    = array(
  ">"   => "stariji od",
  "<"   => "mlađi od",
  "<="  => "do starosne granice",
  ">="  => "od starosne granice"
);
 
$GLOBALS["operators"] = array("+", "-", "*", "/", "%");
$GLOBALS["letther"]   = array(
  "1"   => "A",
  "2"   => "B",
  "3"   => "C",
  "4"   => "D",
  "5"   => "E",
  "6"   => "F",
  "7"   => "G",
  "8"   => "H",
  "9"   => "I",
  "10"   => "J",
  "11"   => "K",
  "12"   => "M",
  "13"   => "N",
  "14"   => "O",
  "15"   => "P",
  "16"   => "Q",
  "17"   => "R",
  "18"   => "S",
  "19"   => "T",
  "21"   => "U",
  "22"   => "V",
  "23"   => "W",
  "24"   => "X",
  "25"   => "Y",
  "26"   => "Z",
 );
 
$GLOBALS["version"]  = '3.1';
 
/* default user definitions */ 
$GLOBALS["def_username"]   = "admin";
$GLOBALS["def_password"]   = "admin";
$GLOBALS["def_firstname"]  = "Administrator";
$GLOBALS["def_secondname"] = "Sistema";

$GLOBALS["authenticate"]   = False;

$GLOBALS["browse_count"]   = 20;

$GLOBALS["def_start_year"] = 2000;

$GLOBALS["agerule"]        = 26;
$GLOBALS["oldid"]          = 1;
$GLOBALS["olderid"]        = 2;

$GLOBALS["bruto_limit"]    = 1.3;
$GLOBALS["bruto_higher"]   = 1.781882;
$GLOBALS["bruto_lower"]    = 1.272566;

$GLOBALS["age"][1] = array (
  'tax'         => 6,
  'contribute'  => 9999,
  'claimsum'    => 9,
  'cooperative' => 10,
  'sum'         => 11,
  'transform'   => 1.106196,
  'bruto'       => 1.272566,
  'pio'         => 0,
  'health'      => 0,
  'insurance'   => 0
);

//  'bruto'       => 1.781882,
$GLOBALS["age"][2] = array (
  'tax'         => 22,
  'contribute'  => 9999,
  'claimsum'    => 27,
  'cooperative' => 24,
  'sum'         => 25,
  'transform'   => 1.426534,
  'bruto'       => 1.764051,
  'pio'         => 0.11,
  'health'      => 0.065,
  'insurance'   => 0.0075
);

// 'bruto'       => 1.565573,
$GLOBALS["age"][3] = array (
  'tax'         => 36,
  'contribute'  => 9999,
  'claimsum'    => 39,
  'cooperative' => 38,
  'sum'         => 40,
  'transform'   => 1.311475,
  'bruto'       => 1.549906,
  'pio'         => 0.11,
  'health'      => 0,
  'insurance'   => 0.0075
);

$GLOBALS["agec"][1] = array (
  'tax'         => 6,
  'contribute'  => 9999,
  'claimsum'    => 9,
  'sum'         => 10,
  'transform'   => 1.106196,
  'bruto'       => 1.172566,
  'pio'         => 0,
  'health'      => 0,
  'insurance'   => 0
);

$GLOBALS["agec"][2] = array (
  'tax'         => 21,
  'contribute'  => 9999,
  'claimsum'    => 23,
  'sum'         => 24,
  'transform'   => 1.426534,
  'bruto'       => 1.681882,
  'pio'         => 0.11,
  'health'      => 0.065,
  'insurance'   => 0.0075
);

$GLOBALS["agec"][3] = array (
  'tax'         => 33,
  'contribute'  => 9999,
  'claimsum'    => 35,
  'sum'         => 36,
  'transform'   => 1.311475,
  'bruto'       => 1.465573,
  'pio'         => 0.11,
  'health'      => 0,
  'insurance'   => 0.0075
);

$GLOBALS["aligns"] = array (
  ''  => ' ',
  'C' => 'center',
  'L' => 'left',
  'R' => 'right',
);

$GLOBALS["styles"] = array (
  ''  => ' ',
  'B' => 'bold',
  'I' => 'italic',
  'U' => 'underline',
);

define('PDF_SMALLEST', 9);
define('PDF_SMALLER', 10.5);
define('PDF_SMALL',   12);
define('PDF_MIDDLE',  14);
define('PDF_BIG',     16);

 ?>