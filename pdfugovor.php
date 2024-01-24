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
* @file         pdfugovor.php
* @package       
* @subpackage   
*
* @description  Print contract to pdf
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
define('_EDOTPLUS_ALLOW',     1);
require_once('./include/globals.inc');
require_once('./fpdf/fpdf.php');
require_once('./include/c_db.inc');
require_once('./include/c_session.php');
require_once('./include/common.php');

if (isset($_GET["IDContract"]) && (int)$_GET["IDContract"] > 0) { // print to pdf
  $IDContract = (int)$_GET["IDContract"];
  $contr      = false;
  if (isset($_GET["from"]))
    $contr    = true;
    
  $_session = new c_Session;

  $_currentyear = $_session->_getCurrentYear();
  $companyname = $_session->_getCooperativeName();  

  mysql_query("SET NAMES 'utf8'") or die(mysql_error());
  mysql_query("SET SESSION character_set_client='utf8'");
  mysql_query("SET SESSION character_set_connection='utf8'");
  mysql_query("SET SESSION character_set_results='utf8'");    
  
  $jobdescription = "";
  
  $contracts = mysql_query(sprintf("SELECT C.*, CONCAT(M.name, ' ', M.surname) AS worker, M.ID AS evnum,
    M.jmbr, M.address, P.name as place 
    FROM oszcontractitem$_currentyear AS C 
    LEFT JOIN oszmember$_currentyear AS M ON C.IDMember = M.ID
    LEFT JOIN oszplace AS P ON M.IDAddressPlace = P.ID
    WHERE C.IDContract=%d",$IDContract)) or die(mysql_error());
  
  $contract = mysql_query(sprintf("SELECT * FROM oszcontract$_currentyear WHERE ID=%d", $IDContract));
  $contract_data = mysql_fetch_array($contract);
  if (isset($contract_data['jobdescription'])) $jobdescription = $contract_data['jobdescription'];
  if (trim($jobdescription) == "") $jobdescription = "_______________________________________________________";
  $pdf=new FPDF('P','mm','A4');
  while($item = mysql_fetch_array($contracts)) {
    $worker   = $item['worker'];
    if (trim($worker) == "") $worker = "________________________________";
    $evnum    = $item['evnum'];
    if (trim($evnum) == "") $evnum = "_________";
    $jmbr     = $item['jmbr'];
    if (trim($jmbr) == "") $jmbr = "___________________";
    $address  = $item['address'];
    if (trim($address) == "") $address = "________________________________";
    $place    = $item['place'];
    if (trim($place) == "") $place = "________________________________";
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
  }
  $pdf->Output();
}
?>