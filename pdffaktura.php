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
* @file         pdffaktura.php
* @package       
* @subpackage   
*
* @description  Print invoice to pdf
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

define('PDF_RIGHT', 20);

if (isset($_GET["IDInvoice"]) && (int)$_GET["IDInvoice"] > 0) { // print to pdf
  $IDInvoice = (int)$_GET["IDInvoice"];
  //echo($selContract);

  $_session = new c_Session;

  $_currentyear = $_session->_getCurrentYear();
  $companyname = $_session->_getCooperativeName(); 

  mysql_query("SET NAMES 'utf8'") or die(mysql_error());
  mysql_query("SET SESSION character_set_client='utf8'");
  mysql_query("SET SESSION character_set_connection='utf8'");
  mysql_query("SET SESSION character_set_results='utf8'");    

  $pdf=new FPDF('P','mm','A4');
  $pdf->AddPage();
  $query      = mysql_query("SELECT C.*, P.name AS place FROM oszcooperative AS C LEFT JOIN oszplace AS P ON C.IDPlace = P.ID WHERE C.ID=1") or die(mysql_error());
  $cooperative= mysql_fetch_array($query);
  $query      = mysql_query(sprintf("SELECT * FROM oszinvoice$_currentyear WHERE ID=%d",$IDInvoice)) or die(mysql_error());
  $invoice    = mysql_fetch_array($query);
  $query      = mysql_query(sprintf("SELECT C.*, E.name AS employer, E.address, E.pib, P.name AS place FROM oszcontract$_currentyear AS C 
                  LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID 
                  LEFT JOIN oszplace AS P ON E.IDPlace = P.ID
                  WHERE C.ID=%d",$invoice["IDContract"])) or die(mysql_error());
  $contract   = mysql_fetch_array($query);
  // Image($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
  if (isset($cooperative["pdfimage"]) && strlen(trim($cooperative["pdfimage"])) > 0)
    $pdf->Image(trim($cooperative["pdfimage"]),PDF_RIGHT,10,50);
  else
    $pdf->Image('./images/ezadruga_pdf.png',PDF_RIGHT,10,50);
  $pdf->Image('./images/bill/bord_pdf_ln.jpg',10,10,5,274);
  $pdf->SetFont('Arial','B',PDF_SMALL);
  $pdf->SetX($pdf->GetX()+130);
  $pdf->Cell(0,10,"U Smed. Palanci, "._db_date_to_date($invoice["date"]),0,0);
  $pdf->Ln(15);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,$cooperative["address"].', '.$cooperative["place"],0,0);
  $pdf->Ln(4);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'tel/fax '.$cooperative["phone"],0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,$pdf->StringConvert($contract["employer"]),0,0);
  $pdf->Ln(4);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'mob. '.$cooperative["mobile"],0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,$pdf->StringConvert($contract["address"]),0,0);
  $pdf->Ln(4);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'PIB '.$cooperative["pib"],0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,$contract["place"],0,0);
  $pdf->Ln(4);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'Mat. br. '.$cooperative["idnumber"],0,0);
  $pdf->SetX(130);
  if (strlen(trim($contract["pib"])) > 0)
    $pib = $contract["pib"];
  else
    $pib = "_________________";
  $pdf->Cell(0,10,'PIB: '.$pib,0,0);
  $pdf->Ln(4);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,$pdf->StringConvert('Žiro račun: '.$cooperative["account"]),0,0);
  $pdf->Ln(4);
  $pdf->SetX($pdf->GetX()+38);
  $pdf->Cell(0,10,$cooperative["reference"],0,0);
  $pdf->Ln(40);
  $pdf->SetFont('Arial','B',PDF_BIG);
  $pdf->Cell(0,10,$pdf->StringConvert('RAČUN BR:'.$invoice["ID"]),0,0,'C');
  $pdf->SetFont('Arial','B',PDF_SMALL);
  $pdf->Ln(15);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'Za poslove obavljene prema ugovoru br: '.$contract["ID"],0,0);
  $pdf->Ln(7);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,$companyname["short"].' nije u sistemu PDV.',0,0);
  $pdf->Ln(40);
  $pdf->SetFont('Arial','B',PDF_BIG);
  $pdf->Cell(0,10,'SPECIFIKACIJA:',0,0,'C');
  $pdf->Ln(30);

  $pdf->SetX(10);
  $pdf->SetFont('Arial','',PDF_SMALL);
  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'Neto zarada zadrugara: ...............................................................................',0,0);
  //$pdf->SetX(85);
  //$pdf->Cell(0,10,'____________________________',0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,number_format(round($invoice['net'],2), 2, '.', ','),0,0,'R');
  $pdf->Ln(7);

  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'Porez na zaradu: .........................................................................................',0,0);
  //$pdf->SetX(85);
  //$pdf->Cell(0,10,'____________________________',0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,number_format(round($invoice['tax'],2), 2, '.', ','),0,0,'R');
  $pdf->Ln(7);

  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'Doprinos za socijalno osiguranje: ................................................................',0,0);
  $pdf->SetX(130);
  //$pdf->SetX(85);
  //$pdf->Cell(0,10,'____________________________',0,0);
  $pdf->Cell(0,10,number_format(round($invoice['contribute'],2), 2, '.', ','),0,0,'R');
  $pdf->Ln(7);

  $pdf->SetFont('Arial','B',PDF_SMALL);

  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'Svega za refundaciju: ................................................................................',0,0);
  //$pdf->SetX(85);
  //$pdf->Cell(0,10,'____________________________',0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,number_format(round($invoice['claimsum'],2), 2, '.', ','),0,0,'R');
  $pdf->Ln(7);

  $pdf->SetFont('Arial','',PDF_SMALL);

  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,$pdf->StringConvert("Članski doprinos: ........................................................................................."),0,0);
  //$pdf->SetX(85);
  //$pdf->Cell(0,10,'____________________________',0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,number_format(round($invoice['cooperative'],2), 2, '.', ','),0,0,'R');
  $pdf->Ln(7);

  $pdf->SetFont('Arial','B',PDF_SMALL);

  $pdf->SetX(PDF_RIGHT);
  $pdf->Cell(0,10,'Ukupno za uplatu: ......................................................................................',0,0);
  //$pdf->SetX(85);
  //$pdf->Cell(0,10,'____________________________',0,0);
  $pdf->SetX(130);
  $pdf->Cell(0,10,number_format(round($invoice['sum'],2), 2, '.', ','),0,0,'R');
  $pdf->Ln(7);
  
  $pdf->SetXY(150, $pdf->GetY()+30);
  $pdf->Cell(0,10,'Za '.$companyname["short"],0,0, "R");
  $pdf->SetXY(150, $pdf->GetY()+7);
  $pdf->Cell(0,10,'____________________________',0,0, "R");
  
  $pdf->Output();
} 
?>