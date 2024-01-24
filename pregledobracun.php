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
* @file         pregledobracun.php
* @package       
* @subpackage   
*
* @description  Invoice calculation list
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<?
if (isset($_GET["IDInvoice"]) || isset($_GET["IDContract"])) {
  $IDInvoice  = 0;
  $IDContract = 0;
  if (isset($_GET["IDInvoice"]))
    $IDInvoice = (int)$_GET["IDInvoice"];
  if (isset($_GET["IDContract"]))
    $IDContract = (int)$_GET["IDContract"];
  if ($IDContract > 0)
    $query = mysql_query(sprintf("SELECT * FROM oszcontractitem$_currentyear WHERE IDContract=%d AND net",$IDContract)) or die(mysql_error());
  else
    $query = mysql_query(sprintf("SELECT * FROM oszinvoiceitem$_currentyear WHERE IDInvoice=%d AND net",$IDInvoice)) or die(mysql_error());
  $neto  = mysql_fetch_array($query);
  
  if ($IDInvoice > 0) {
    $query      = mysql_query(sprintf("SELECT * FROM oszinvoice$_currentyear WHERE ID=%d",$IDInvoice)) or die(mysql_error());
    $invoice    = mysql_fetch_array($query);
  }
  if ($IDContract > 0)
    $query      = mysql_query(sprintf("SELECT C.*, E.name AS employer, E.address, E.pib, P.name AS place FROM oszcontract$_currentyear AS C 
                    LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID 
                    LEFT JOIN oszplace AS P ON E.IDPlace = P.ID
                    WHERE C.ID=%d",$IDContract)) or die(mysql_error());
  else
    $query      = mysql_query(sprintf("SELECT C.*, E.name AS employer, E.address, E.pib, P.name AS place FROM oszcontract$_currentyear AS C 
                    LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID 
                    LEFT JOIN oszplace AS P ON E.IDPlace = P.ID
                    WHERE C.ID=%d",$invoice["IDContract"])) or die(mysql_error());
  $contract   = mysql_fetch_array($query);
  if ($IDContract > 0)
    $query = mysql_query(sprintf("SELECT II.value, IRD.name as rulename FROM oszcontractruleitem$_currentyear AS II 
      LEFT JOIN oszcontractruledef AS IRD ON II.IDInvoiceruledef = IRD.ID 
      WHERE II.IDContract=%d AND NOT II.net AND IRD.report ORDER BY IRD.sort",$IDContract)) or die(mysql_error());
  else
    $query = mysql_query(sprintf("SELECT II.value, IRD.name as rulename FROM oszinvoiceitem$_currentyear AS II 
      LEFT JOIN oszinvoiceruledef AS IRD ON II.IDInvoiceruledef = IRD.ID 
      WHERE II.IDInvoice=%d AND NOT II.net AND IRD.report ORDER BY IRD.sort",$IDInvoice)) or die(mysql_error());
?>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse_right" width="100%">
<? if ($IDInvoice > 0) { ?>                
                <tr>
                  <th width="60%" align="right">Faktura broj : </th>
                  <td width="40%"><?=$invoice['ID'];?></td>
                </tr>
                <tr>
                  <th>Datum faktura : </th>
                  <td><?=_db_date_to_date($invoice['date']);?></td>
                </tr>
<? } ?>                
                <tr>
                  <th width="60%">Ugovor broj : </th>
                  <td width="40%"><?=$contract['ID'];?></td>
                </tr>
                <tr>
                  <th>Datum ugovora : </th>
                  <td><?=_db_date_to_date($contract['contractdate']);?></td>
                </tr>
                <tr>
                  <th>Poslodavac : </th>
                  <td><?=$contract['employer'];?></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
<? while ($res = mysql_fetch_array($query)) { ?>                
                <tr>
                  <th><?=$res['rulename'];?></th>
                  <td><?=number_format(round($res['value']), 0, '', ',');?></td>
                </tr>
<? } ?>                
              </table>
<?
} else echo '<h3>Podaci o fakturi nisu dostupni!</h3>';
?>              
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
