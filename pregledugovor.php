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
* @file         pregledugovor.php
* @package       
* @subpackage   
*
* @description  Contract list
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$selContract = 0;

if (isset($_POST["selContract"]) && (int)$_POST["selContract"] > 0)
  $selContract = (int)$_POST["selContract"];

$query    = mysql_query(sprintf("SELECT C.ID, C.IDEmployer, C.contractnumber, C.contractdate, E.name FROM oszcontract$_currentyear AS C LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID WHERE C.ID=%d",$selContract)) or die(mysql_error());
$contract = mysql_fetch_array($query);
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse">
                <tr>
                  <th>Broj ugovora : </th>
                  <td><?=$contract["ID"];?></td>
                </tr>
                <tr>
                  <th>Datum ugovora : </th>
                  <td><?=_db_date_to_date($contract["contractdate"]);?></td>
                </tr>
                <tr>
                  <th>Poslodavac : </th>
                  <td><?=$contract["name"];?></td>
                </tr>
              </table>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th align="center">Prezime i ime : </th>
                  <th align="center">NETO</th>
                </tr>
<?
$query = mysql_query(sprintf("SELECT CI.IDMember, CI.net, M.name, M.surname FROM oszcontractitem$_currentyear AS CI LEFT JOIN oszmember$_currentyear AS M ON CI.IDMember=M.ID WHERE CI.IDContract=%d ORDER BY M.surname, M.name",$_POST["selContract"] )) or die(mysql_error());
$net = 0;
while ($res = mysql_fetch_array($query)) {
  $net += $res['net'];
?>
                <tr>
                  <td><?=$res['surname'];?> <?=$res['name'];?></td>
                  <td align="right"><?=sprintf("%01.2f", $res['net']);?></td>
                </tr>
<?
}
?>                
                <tr>
                  <th align="right">SUMA : </th>
                  <td align="right"><?=sprintf("%01.2f", $net);?></td>
                </tr>
                <tr>
                  <td align="right" colspan="2">
<? if ($contract["IDEmployer"] == 1 || $net == 0) { ?>                    
                    <a href="./pdfugovor.php?IDContract=<?=$selContract;?>&from=c" target="_blank">
                      <img src="./images/form/pdf_big.jpg" alt="Štampa ugovora" title="Štampa ugovora" />
                    </a>
<? } else { ?>                    
                    <a href="./pdfugovor.php?IDContract=<?=$selContract;?>" target="_blank">
                      <img src="./images/form/pdf_big.jpg" alt="Štampa ugovora" title="Štampa ugovora" />
                    </a>
<? } ?>                    
                  </td>
                </tr>
              </table>
                
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
