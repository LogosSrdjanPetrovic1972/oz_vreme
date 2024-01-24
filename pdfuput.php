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
* @file         pdfuput.php
* @package       
* @subpackage   
*
* @description  Print uput to pdf
*
* @history      11.06.2013. ; srdjanp ; Initial revision
*
*/
define('_EDOTPLUS_ALLOW',     1);
require_once('./include/globals.inc');
require_once('./fpdf/fpdf.php');
require_once('./include/c_db.inc');
require_once('./include/c_session.php');
require_once('./include/common.php');
require_once('./include/debug.php');
//dump($_POST);
//die;

if ((isset($_GET["IDMember"]) && (int)$_GET["IDMember"] > 0) || (isset($_POST["selMember"]) && (int)$_POST["selMember"] > 0)) { // print to pdf
  if (isset($_GET["IDMember"]))
    $IDMember = (int)$_GET["IDMember"];
  if (isset($_POST["selMember"]))
    $IDMember = (int)$_POST["selMember"];
    
  $_session = new c_Session;

  $_currentyear = $_session->_getCurrentYear();
  $companyname = $_session->_getCooperativeName();  

  mysql_query("SET NAMES 'utf8'") or die(mysql_error());
  mysql_query("SET SESSION character_set_client='utf8'");
  mysql_query("SET SESSION character_set_connection='utf8'");
  mysql_query("SET SESSION character_set_results='utf8'");    

  $query      = mysql_query("SELECT C.*, P.name AS place FROM oszcooperative AS C LEFT JOIN oszplace AS P ON C.IDPlace = P.ID WHERE C.ID=1") or die(mysql_error());
  $cooperative= mysql_fetch_array($query);
  $name       = $cooperative['name'];
  $address    = $cooperative['address'];
  $place      = $cooperative['place'];
  $phone      = $cooperative['phone'];
  $mobile     = $cooperative['mobile'];
  
  $query      = mysql_query("SELECT CONCAT(name, ' ', surname) AS worker, jmbr FROM oszmember$_currentyear WHERE ID=$IDMember") or die(mysql_error());
  $member     = mysql_fetch_array($query);
  $worker     = $member['worker'];
  if (trim($worker) == "") $worker = "________________________________";
  $jmbr       = $member['jmbr'];
  if (trim($jmbr) == "") $jmbr = "___________________";
  
  $employer = "______________________________________________";
  if (isset($_POST["selEmployer"]) && (int)$_POST["selEmployer"] > 0) {
      $query    = mysql_query(sprintf("SELECT name FROM oszemployer WHERE ID=%d", (int)$_POST["selEmployer"])) or die(mysql_error());
      $employ   = mysql_fetch_array($query);
      $employer = $employ['name'];
  }
  $jobdescription = "___________________________________________________________________";
  if (isset($_POST["jobdescription"]) && trim($_POST["jobdescription"]) <> '' )
    $jobdescription = trim($_POST["jobdescription"]);
  
  
  $pdf=new FPDF('P','mm','A4');
  $pdf->AddPage();
  $print = mysql_query("SELECT * FROM oszprintitem WHERE IDPrint = 2 ORDER BY sort") or die(mysql_error());
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
}
?>