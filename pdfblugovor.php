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
* @file         pdfblugovor.php
* @package       
* @subpackage   
*
* @description  Print blank contract to pdf
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
define('_EDOTPLUS_ALLOW',     1);

require_once('./include/globals.inc');
require_once('./include/c_db.inc');
require_once('./fpdf/fpdf.php');

mysql_query("SET NAMES 'utf8'") or die(mysql_error()); 
mysql_query("SET SESSION character_set_client='utf8'");
mysql_query("SET SESSION character_set_connection='utf8'");
mysql_query("SET SESSION character_set_results='utf8'");    

  $jobdescription = "_______________________________________________________";
  $worker         = "________________________________";
  $evnum          = "_________";
  $jmbr           = "___________________";
  $address        = "________________________________";
  $place          = "________________________________";
  $IDContract     = "______";
  $_currentyear   = "________";
  
  
  $pdf=new FPDF('P','mm','A4');
  $pdf->AddPage();
  $print = mysql_query("SELECT * FROM oszprintitem WHERE IDPrint = 1 ORDER BY sort") or die(mysql_error());
  while ($line = mysql_fetch_array($print)) {
    $pdf->SetFont('arial',$line["style"],$line["fontsize"]);
    if (strpos($line["text"], '$') !== false) {
      $eval_line = $line["text"];
      eval("\$eval_line = \"$eval_line\";");
      $pdf->MultiCell(0,6,$pdf->StringConvert($eval_line),0,$line["align"]);
    } else {
      $pdf->MultiCell(0,6,$pdf->StringConvert($line["text"]),0,$line["align"]);
    }
    if ((int)$line["ln"] > 0)
      $pdf->Ln((int)$line["ln"]);
  }
  $pdf->Output();
?>