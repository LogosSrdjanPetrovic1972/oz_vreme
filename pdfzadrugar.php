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
* @file         pdfzadrugar.php
* @package       
* @subpackage   
*
* @description  Print member card to pdf
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
require_once('./include/pdf_text.php');

$_session = new c_Session;

$_currentyear = $_session->_getCurrentYear(); 
$companyname = $_session->_getCooperativeName(); 

mysql_query("SET NAMES 'utf8'") or die(mysql_error());
mysql_query("SET SESSION character_set_client='utf8'");
mysql_query("SET SESSION character_set_connection='utf8'");
mysql_query("SET SESSION character_set_results='utf8'");    

define('LEFT_START',  10);
define('LEFT_ONE',    30);
define('LEFT_TWO',    150);

class PDF extends FPDF
{
  function AddTable($header,$data)
  {
      //Column widths
      $w=array(18,18,18,18,18,18,18,18,18,18,18,18,18,18,24);
      //Header
      $this->SetFont('Arial','B',PDF_SMALLEST);
      for($i=0;$i<count($header);$i++)
          $this->Cell($w[$i],7,$this->StringConvert($header[$i]),1,0,'C');
      $this->Ln();
      //Data
      $this->SetFont('Arial','B',7);
      foreach($data as $row)
      {
          $this->Cell($w[0],7,$row[0],1,0,'C');
          $this->Cell($w[1],7,$row[1],1,0,'C');
          $this->Cell($w[2],7,$row[2],1,0,'C');
          $this->Cell($w[3],7,$row[3],1,0,'C');
          $this->Cell($w[4],7,$row[4],1,0,'C');
          $this->Cell($w[5],7,$row[5],1,0,'C');
          $this->Cell($w[6],7,$row[6],1,0,'C');
          $this->Cell($w[7],7,$row[7],1,0,'C');
          $this->Cell($w[8],7,$row[8],1,0,'R');
          $this->Cell($w[9],7,$row[9],1,0,'R');
          $this->Cell($w[10],7,$row[10],1,0,'R');
          $this->Cell($w[11],7,$row[11],1,0,'R');
          $this->Cell($w[12],7,$row[12],1,0,'R');
          $this->Cell($w[13],7,$row[13],1,0,'R');
          $this->Cell($w[14],7,$row[14],1,0,'C');
          $this->Ln(7);
          if ($this->GetY() >= 270) {
            //Closure line
            $this->Cell(array_sum($w),0,'','T');
            $this->AddPage();
            $this->Ln();
            $this->SetFont('Arial','B',PDF_SMALLEST);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$this->StringConvert($header[$i]),1,0,'C');
            $this->Ln();
            //Data
            $this->SetFont('Arial','B',7);
          }
          
      }
      //Closure line
      $this->Cell(array_sum($w),0,'','T');
  }
}

if (isset($_POST["selMember"]) && (int)$_POST["selMember"] > 0) {
  $IDMember = (int)$_POST["selMember"];
  // IDAddressPlace, IDMemberBasis, IDEmployer
  $sql = "SELECT M.*, P.name as place, MB.name as basis, E.name as employer FROM oszmember$_currentyear AS M 
    LEFT JOIN oszplace AS P ON M.IDAddressPlace = P.ID
    LEFT JOIN oszmemberbasis AS MB ON M.IDMemberBasis = MB.ID
    LEFT JOIN oszemployer AS E ON M.IDEmployer = E.ID
    WHERE M.ID = %d";
  $query = mysql_query(sprintf($sql,$IDMember)) or die(mysql_error());
  $member = mysql_fetch_array($query);
  // memberdays, memberhours, contractdays, contracthours
  $sql = "SELECT CI.ID,  CI.IDContract,  CI.IDMember,  CI.net,  CI.contractfrom as memberfrom, CI.contractto as memberto, 
    DAY(CI.contractto-CI.contractfrom) AS memberdays, CI.hours as memberhours,
    C.contractdate, C.contractfrom, C.contractto, DAY(C.contractto - C.contractfrom) AS contractdays, 
    C.hours AS contracthours, C.jobdescription, ICI.value AS bruto, ICI.pio, ICI.health, ICI.insurance FROM oszcontractitem$_currentyear AS CI 
    LEFT JOIN oszcontract$_currentyear AS C ON CI.IDContract = C.ID
    LEFT JOIN oszinvoicecontractitem$_currentyear AS ICI ON CI.IDContract = ICI.IDContract AND CI.IDMember = ICI.IDMember AND CI.net = ICI.net
    WHERE CI.IDMember = %d";
  $contracts = mysql_query(sprintf($sql,$IDMember)) or die(mysql_error());
  
  $pdf = new PDF('L','mm','A4');
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',PDF_SMALL);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_CONTRACT_BOOK),0,0,'C');
  $pdf->Ln(7);
  $pdf->SetFont('Arial','',PDF_SMALLER);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_OSZ),0,0);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_ID.'   '.$member["ID"].'.'),0,0, 'R');
  $pdf->Ln(5);
  $pdf->Cell(0,5,$pdf->StringConvert($companyname["shortest"]),0,0);
  $pdf->SetFont('Arial','B',PDF_SMALL);
  $pdf->Ln(7);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_REQUEST),0,0,'C');
  $pdf->Ln(7);
  $pdf->SetFont('Arial','',PDF_SMALLER);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_SURNAME.$member["surname"]),0,0);
  $pdf->SetX(LEFT_TWO);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_NAME.$member["name"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_JMBR.$member["jmbr"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_IDNUMBER.$member["idnumber"]),0,0);
  $pdf->SetX(LEFT_TWO);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_MUP.$member["mup"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_BIRTH._db_date_to_date($member["birthday"]).' '.$member["birthplace"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_ADDRESS.$member["address"].' '.$member["place"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_occupation.$member["occupation"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_specialkno.$member["specialkno"]),0,0);
  $pdf->SetX(LEFT_TWO);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_PHONE.$member["phone"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_MemberBasis.$member["basis"]),0,0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_ONE);
  if ($member["healthinsur"])
    $text = TPDF_HELT.TPDF_YES;
  else
    $text = TPDF_HELT.TPDF_NO;
  $pdf->Cell(0,5,$pdf->StringConvert($text),0,0);
  $pdf->SetX(LEFT_TWO);
  if ($member["memberother"])
    $text = TPDF_OTHER.TPDF_YES;
  else
    $text = TPDF_OTHER.TPDF_NO;
  $pdf->Cell(0,5,$pdf->StringConvert($text),0,0);
  //die('"');
  $pdf->Ln(6);
  $pdf->SetX(LEFT_START);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE1),0);
  $pdf->Ln(6);
  $pdf->SetX(LEFT_START);
  $pdf->SetFont('Arial','B',PDF_SMALLER);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE2),0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',PDF_SMALLER);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE3),0,0);
  $pdf->Ln(7);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE4),0,0, 'C');
  $pdf->Cell(0,5,$pdf->StringConvert('_________________________'),0,0, 'R');
  $pdf->Ln(5);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE5),0,0, 'R');
  $pdf->Ln(7);
  $pdf->SetFont('Arial','B',PDF_SMALLER);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE6),0,0, 'C');
  $pdf->SetFont('Arial','',PDF_SMALLER);
  $pdf->Ln(5);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE7),0);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE8),0);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE9),0);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE10),0);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE11),0);
  $pdf->MultiCell(0,5,$pdf->StringConvert(TPDF_LINE12),0);
  $pdf->Ln(5);
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert("_________________________"),0,0);
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert("_________________________"),0,0,'C');
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert("_________________________"),0,0,'R');
  $pdf->Ln(5);
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE13),0,0);
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE15),0,0,'C');
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE17),0,0,'R');
  $pdf->Ln(5);
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE14),0,0);
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE16),0,0,'C');
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE18),0,0,'R');
  $pdf->Ln(7);
  $pdf->SetX(LEFT_START);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE19),0,0);
  $pdf->AddPage();
  $header = array('Datum is','Ugov. br.','Iznos','Od','Do','Dana','Sati','ZSS','Neto','Bruto osn.','PIO','Zdr.os.','Osig.nez.','Član. d.','Porez doh.');
  $data[] = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15');
  $iznos = 0;
  $dana  = 0;
  $sati  = 0;
  $neto  = 0;
  $brut  = 0;
  $osno  = 0;
  $pio   = 0;
  $zdrv  = 0;
  $osig  = 0;
  $clan  = 0;
  $tax   = 0;
  $sql   = "SELECT * FROM oszinvoice$_currentyear WHERE IDContact = %d";
  $count = 0;
  while ($contract = mysql_fetch_array($contracts)) {
    // check if we have per contract or per member hours counting
    // memberdays, memberhours, contractdays, contracthours
    $from   = '';
    $to     = '';
    $days   = 0;
    $hours  = 0;
    if ((int)$contract["memberdays"] > 0 || (int)$contract["memberhours"] > 0 ) {
      $from   = _db_date_to_date($contract["memberfrom"]);
      $to     = _db_date_to_date($contract["memberto"]);
      $days   = $contract["memberdays"];
      $hours  = $contract["memberhours"];
      
      if ($days == 0 && $hours > 0) {
        $days = round($hours/8,2);
      }
    } elseif ((int)$contract["contractdays"] > 0 || (int)$contract["contracthours"] > 0 ) {
      $from   = _db_date_to_date($contract["contractfrom"]);
      $to     = _db_date_to_date($contract["contractto"]);
      $days   = $contract["contractdays"];
      $hours  = $contract["contracthours"];
      
      if ($days == 0 && $hours > 0) {
        $days = round($hours/8,2);
      }
    }
    $_tax = 0;
    if (intval($contract["health"]) == 0 && intval($contract["pio"]) == 0 && intval($contract["insurance"]) == 0)
    {
      $_tax = $contract["bruto"] * 0.096;
      $data[] = array(_db_date_to_date($contract["contractdate"]),$contract["IDContract"],
        number_format($contract["net"],2,',','.'),$from,$to,$days,$hours,'',
        number_format($contract["net"],2,',','.'),number_format($contract["bruto"],2,',','.'),
        number_format($contract["pio"],2,',','.'),number_format($contract["health"],2,',','.'),
        number_format($contract["insurance"],2,',','.'),number_format($contract["net"]/10,2,',','.'),
        number_format($_tax,2,',','.'));
    } else {
      $_tax = $contract["bruto"] * 0.12;
      $data[] = array(_db_date_to_date($contract["contractdate"]),$contract["IDContract"],
        number_format($contract["net"],2,',','.'),$from,$to,$days,$hours,'',
        number_format($contract["net"],2,',','.'),number_format($contract["bruto"],2,',','.'),
        number_format($contract["pio"],2,',','.'),number_format($contract["health"],2,',','.'),
        number_format($contract["insurance"],2,',','.'),number_format($contract["net"]/10,2,',','.'),
        number_format($_tax,2,',','.'));
    }
    $iznos += $contract["net"];
    $neto += $contract["net"];
    $brut += $contract["bruto"];
    $pio  += $contract["pio"];
    $zdrv += $contract["health"];
    $osig += $contract["insurance"];
    $sati += $hours;
    $dana += $days;
    $clan += $contract["net"]/10;
    $tax  += $_tax;
    $count ++;
  }
  if ($count < 19) {
    for($i=$count; $i < 19; $i++) {
      $data[] = array('','','','','','','','','','','','','','','');
    }
  }
  $data[] = array('','UKUPNO:',number_format($iznos,2,',','.'),'','',$dana,$sati,'',number_format($neto,2,',','.'),number_format($brut,2,',','.'),number_format($pio,2,',','.'),number_format($zdrv,2,',','.'),number_format($osig,2,',','.'),number_format($clan,2,',','.'),number_format($tax,2,',','.'));
  $pdf->AddTable($header, $data);
  $pdf->Ln(3);
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE20),0,0);
  $pdf->SetX(120);
  $pdf->MultiCell(0,6,$pdf->StringConvert(TPDF_LINE23),0,'R');
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE21),0,0);
  $pdf->SetX(120);
  $pdf->MultiCell(0,6,$pdf->StringConvert(TPDF_LINE24),0,'R');
  $pdf->Cell(0,5,$pdf->StringConvert(TPDF_LINE22),0,0);
  
  //TPDF_LINE4 
  $pdf->Output();
}
exit;
?>