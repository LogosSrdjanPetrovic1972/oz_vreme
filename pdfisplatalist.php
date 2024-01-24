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
* @file         pdfisplatalist.php
* @package       
* @subpackage   
*
* @description  Print paying list to pdf
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

mysql_query("SET NAMES 'utf8'") or die(mysql_error());
mysql_query("SET SESSION character_set_client='utf8'");
mysql_query("SET SESSION character_set_connection='utf8'");
mysql_query("SET SESSION character_set_results='utf8'");    

class PDF extends FPDF
{
  //Page footer
  function Footer()
  {
      //Position at 1.5 cm from bottom
      $this->SetY(-15);
      //Arial italic 8
      $this->SetFont('Arial','I',PDF_SMALLEST);
      //Page number
      $this->Cell(0,10,'Strana '.$this->PageNo(),0,0,'C');
  }

  function AddTable($header,$data)
  {
      //Column widths
      $w=array(20,20,60,35,50);
      //Header
      $this->SetFont('Arial','B',PDF_MIDDLE);
      for($i=0;$i<count($header);$i++)
          $this->Cell($w[$i],7,$this->StringConvert($header[$i]),1,0,'C');
      $this->Ln();
      //Data
      $this->SetFont('Arial','B',PDF_SMALL);
      foreach($data as $row)
      {
          $this->Cell($w[0],7,$row[0],'LR',0,'R');
          $this->Cell($w[1],7,$row[1],'LR',0,'R');
          $this->Cell($w[2],7,$row[2],'LR');
          $this->Cell($w[3],7,number_format($row[3],2,'.',','),'LR',0,'R');
          $this->Cell($w[4],7,$row[4],'LR',0,'C');
          $this->Ln(7);
          if ($this->GetY() >= 270) {
            //Closure line
            $this->Cell(array_sum($w),0,'','T');
            $this->AddPage();
            $this->Ln();
            $this->SetFont('Arial','B',PDF_MIDDLE);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$this->StringConvert($header[$i]),1,0,'C');
            $this->Ln();
            //Data
            $this->SetFont('Arial','B',PDF_SMALL);
          }
          
      }
      //Closure line
      $this->Cell(array_sum($w),0,'','T');
  }
}

if (isset($_GET["IDContract"]) && (int)$_GET["IDContract"] > 0) { // print to pdf
  $IDContract = (int)$_GET["IDContract"];
  //echo($selContract);
  $contr      = false;
  if (isset($_GET["from"]))
    $contr    = true;

  $_session = new c_Session;

  $_currentyear = $_session->_getCurrentYear();
  $companyname = $_session->_getCooperativeName();  

  if ($contr)
    $query    = mysql_query(sprintf("SELECT C.*, E.name AS employer, E.address, P.name as place FROM oszcontract$_currentyear AS C 
      LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID 
      LEFT JOIN oszplace AS P ON E.IDPlace = P.ID
      WHERE C.ID=%d",$IDContract)) or die(mysql_error());
  else
    $query    = mysql_query(sprintf("SELECT C.*, I.ID AS IDInvoice, E.name AS employer, E.address, P.name as place FROM oszcontract$_currentyear AS C 
      LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID 
      LEFT JOIN oszplace AS P ON E.IDPlace = P.ID
      LEFT JOIN oszinvoice$_currentyear AS I ON C.ID = I.IDContract
      WHERE C.ID=%d",$IDContract)) or die(mysql_error());
  $contract = mysql_fetch_array($query);

  if ($contr)
    $contractlist = mysql_query(sprintf("SELECT ICI.*, M.surname, M.name FROM oszcontractitem$_currentyear AS ICI
        LEFT JOIN oszmember$_currentyear AS M ON ICI.IDMember = M.ID
        WHERE ICI.IDContract = %d ORDER BY M.surname, M.name", $IDContract)) or die(mysql_error()); 
  else
    $contractlist = mysql_query(sprintf("SELECT ICI.*, M.surname, M.name FROM oszinvoicecontractitem$_currentyear AS ICI
        LEFT JOIN oszmember$_currentyear AS M ON ICI.IDMember = M.ID
        WHERE ICI.IDContract = %d ORDER BY M.surname, M.name", $IDContract)) or die(mysql_error()); 

  $pdf=new PDF('P','mm','A4');
  $pdf->AddPage();

  $pdf->SetFont('Arial','B',PDF_MIDDLE);
  $pdf->Cell(0,10,strtoupper($companyname["name"]),0,0);
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',PDF_SMALL);
  $pdf->Cell(0,10,'Smed. Palanka, dana ___________________',0,0);

  $pdf->Ln(10);
  $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
  $pdf->SetFont('Arial','',PDF_MIDDLE);
  if ($contr)
    $pdf->Cell(0,10,$pdf->StringConvert('Spisak za isplatu uz ugovor broj : ').$contract["ID"],0,0,'C');
  else
    $pdf->Cell(0,10,$pdf->StringConvert('Spisak za isplatu uz račun broj : ').$contract["IDInvoice"],0,0,'C');
  $pdf->Ln(10);
  $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
  $pdf->SetFont('Arial','B',PDF_SMALL);
  $header=array('Red.Br.', 'Šifra', 'Prezime i ime','Iznos','Potpis');
  $pdf->Ln(10);

  $suma = 0.00;
  $data = array();
  $i = 1;
  while ($res = mysql_fetch_array($contractlist)) {
    $suma += $res['net'];
    $data[] = array($i.'.', $res['IDMember'], $pdf->StringConvert($res['surname'].' '.$res['name']), $res['net'], '____________________');
    $i++;
  }
  $pdf->AddTable($header,$data);
  $pdf->Cell(0,10,'UKUPNO :        '.number_format(round($suma,2),2,'.',',').'                                               ',0,0,'R');

  //Position at 1.5 cm from bottom
  $pdf->SetY(-45);
  //$pdf->Cell(0,10,$pdf->StringConvert('Za '.$contract["employer"]),0,0);
  $pdf->Cell(0,10,'Za '.$companyname["short"],0,0,'R');
  $pdf->Ln(10);
  //$pdf->Cell(0,10,'__________________________________',0,0);
  $pdf->Cell(0,10,'__________________________________',0,0,'R');

  $pdf->Output();
} 
?>