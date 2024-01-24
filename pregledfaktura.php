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
* @file         pregledfaktura.php
* @package       
* @subpackage   
*
* @description  Invoice list
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <!-- MAIN CONTENT END -->
<?php
if (isset($_POST['selInvoice']) && (int)$_POST['selInvoice'] > 0) { 
  $IDInvoice = (int)$_POST['selInvoice'];
  $query    = mysql_query(sprintf("SELECT IDContract FROM oszinvoice$_currentyear WHERE ID=%d", $IDInvoice)) or die(mysql_error());
  $res = mysql_fetch_array($query);
  $IDContract = $res["IDContract"];
    $query    = mysql_query(sprintf("SELECT C.ID, C.IDEmployer, C.contractdate, E.name, E.address, E.phone, E.mobile, E.fax, P.name as place FROM oszcontract$_currentyear AS C 
                LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID 
                LEFT JOIN oszplace AS P ON E.IDPlace = P.ID
                WHERE C.ID=%d", $IDContract)) or die(mysql_error());
    $contract = mysql_fetch_array($query);    
    $query    = mysql_query(sprintf("SELECT * FROM oszinvoice$_currentyear WHERE ID=%d", $IDInvoice)) or die(mysql_error());
    $invoice  = mysql_fetch_array($query);
    $query    = mysql_query(sprintf("SELECT ICI.ID, ICI.IDMember, ICI.net, ICI.bruto AS value, M.surname, M.name 
                FROM oszinvoicecontractitem$_currentyear AS ICI 
                LEFT JOIN oszmember$_currentyear AS M
                ON ICI.IDMember = M.ID
                WHERE ICI.IDInvoice=%d ORDER BY M.surname, M.name", $IDInvoice)) or die(mysql_error());
?>
    <table cellpadding="0" cellspacing="0" border="0" class="table_edit" width="100%"> 
      <tr>
        <th width="40%">Faktura broj : </th>
        <td width="60%"><?=$IDInvoice;?> / <?=$_currentyear;?></td>
      </tr>
      <tr>
        <th>Datum fakture : </th>
        <td><?=_db_date_to_date($invoice["date"]);?></td>
      </tr>
      <tr>
        <th width="40%">Ugovor broj : </th>
        <td width="60%"><?=$IDContract;?> / <?=$_currentyear;?></td>
      </tr>
      <tr>
        <th>Datum ugovora : </th>
        <td><?=_db_date_to_date($contract["contractdate"]);?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <th>Poslodavac : </th>
        <td><?=$contract["name"];?></td>
      </tr>
      <tr>
        <th>Adresa : </th>
        <td><?=$contract["address"];?></td>
      </tr>
      <tr>
        <th>Sedište : </th>
        <td><?=$contract["place"];?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <th>Neto zarada zadrugara : </th>
        <td><?=number_format($invoice["net"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Porez na zaradu : </th>
        <td><?=number_format($invoice["tax"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Doprinosi za socijalno osiguranje : </th>
        <td><?=number_format($invoice["contribute"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Svega za refundaciju : </th>
        <td><?=number_format($invoice["claimsum"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Članski doprinos : </th>
        <td><?=number_format($invoice["cooperative"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Ukupno za uplatu : </th>
        <td><?=number_format($invoice["sum"], 2, '.', '');?></td>
      </tr>
      <tr>
        <td colspan="2">
          <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
              <td style="border:0px none;" align="center"><a href="./pdffaktura.php?IDInvoice=<?=$IDInvoice;?>" target="_blank">Štampa fakture<br /><img src="./images/form/pdf.jpg" alt="Štampa fakture" title="Štampa fakture" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pdfugovor.php?IDContract=<?=$IDContract;?>" target="_blank">Štampa ugovora<br /><img src="./images/form/pdf.jpg" alt="Štampa ugovora" title="Štampa ugovora" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pdfugovorlist.php?IDContract=<?=$IDContract;?>" target="_blank">Spisak uz ugovor<br /><img src="./images/form/pdf.jpg" alt="Spisak uz ugovor" title="Spisak uz ugovor" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pdfisplatalist.php?IDContract=<?=$IDContract;?>" target="_blank">Spisak za isplatu<br /><img src="./images/form/pdf.jpg" alt="Spisak za isplatu" title="Spisak za isplatu" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pregledobracun.php?IDInvoice=<?=$IDInvoice;?>" target="_blank">Pregled obračuna<br /><img src="./images/form/bill.jpg" alt="Pregled obračuna" title="Pregled obračuna" /></a></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <h3>Spisak zadrugara : </h3>
    <table cellpadding="0" cellspacing="0" border="0" class="table_browse" width="100%">
      <tr>
        <th>Prezime i ime</th>
        <th>Neto iznos</th>
        <th>Iznos obračuna</th>
      </tr>
<?
  $neto = 0;
  $suma = 0; 
  while ($res = mysql_fetch_array($query)) { 
    $neto += $res["net"];
    $suma += $res["value"];
?>
      <tr>
        <td><?=$res["surname"];?> <?=$res["name"];?></td>
        <td align="right"><?=number_format($res["net"], 2, '.', '');?></td>
        <td align="right"><?=number_format($res["value"], 2, '.', '');?></td>
      </tr>
<? } ?>      
      <tr>
        <th align="right">UKUPNO : </th>
        <td align="right"><?=number_format($neto, 2, '.', '');?></td>
        <td align="right"><?=number_format($suma, 2, '.', '');?></td>
      </tr>
    </table>
<? 
} else echo '<h3>Podaci za fakture nisu dostupni!</h3>';
include_once('./footer.php');
?>
