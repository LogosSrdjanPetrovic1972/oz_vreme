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
* @file         faktura.php
* @package       
* @subpackage   
*
* @description  Obračun faktura za izabrani ugovor
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$del = false;
//echo $_currentyear."<br/>";
if (isset($_GET["id"]) && (int)$_GET["id"] > 0 && isset($_GET["act"]) && $_GET["act"] == "del") {
  // delete invoice
  $IDInvoice = (int)$_GET["id"];
  mysql_query(sprintf("DELETE FROM oszinvoicecontractitem$_currentyear WHERE IDInvoice = %d", $IDInvoice)) or die(mysql_error());
  mysql_query(sprintf("DELETE FROM oszinvoiceitem$_currentyear WHERE IDInvoice = %d", $IDInvoice)) or die(mysql_error());
  $query    = mysql_query(sprintf("SELECT * FROM oszinvoice$_currentyear WHERE ID = %d", $IDInvoice)) or die(mysql_error());
  $invoice  = mysql_fetch_array($query);
  mysql_query(sprintf("DELETE FROM oszinvoice$_currentyear WHERE ID = %d", $IDInvoice)) or die(mysql_error());
  
  mysql_query(sprintf("DELETE FROM oszcontractruleitem$_currentyear WHERE IDContract = %d", $invoice["IDContract"])) or die(mysql_error());
  mysql_query(sprintf("DELETE FROM oszinvoicecontractitem$_currentyear WHERE IDContract = %d", $invoice["IDContract"])) or die(mysql_error());
  mysql_query(sprintf("DELETE FROM oszcontractitem$_currentyear WHERE IDContract = %d", $invoice["IDContract"])) or die(mysql_error());
  mysql_query(sprintf("DELETE FROM oszcontract$_currentyear WHERE ID = %d", $invoice["IDContract"])) or die(mysql_error());
  
  $del = true;
}
// echo "SELECT C.ID, C.contractdate, E.name FROM oszcontract$_currentyear AS C LEFT JOIN oszemployer AS E ON C.IDEmployer=E.ID WHERE C.IDEmployer > 0 ORDER BY C.ID DESC";
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="frmBilling" method="POST" action="./fakturaracun.php">
              <table border="0" cellpadding="2" cellspacing="2" width="100%" class="table_edit">
                <tr>
                  <th valign="top">Obračun faktura za izabrani ugovor : </th>
                  <td valign="top">
                    <select name="selContract" id="selContract">
                      <option value="-1">Izaberite ugovor</option>
<?php
$query = mysql_query("SELECT C.ID, C.contractdate, E.name FROM oszcontract$_currentyear AS C LEFT JOIN oszemployer AS E ON C.IDEmployer=E.ID WHERE C.IDEmployer > 0 ORDER BY C.ID DESC") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  // _db_date_to_date($date)
?>
                      <option value="<?=$res["ID"];?>"><?=$res["ID"];?>. &nbsp; <?=_db_date_to_date($res["contractdate"]);?> &nbsp;&nbsp; <?=$res["name"];?></option>
<?
}
?>                      
                    </select>
                  </td>
                  <td valign="top"><input type="image" src="./images/form/save_middle.jpg" name="submit" alt="Obračunaj" title="Obračunaj" onClick="javascript:return checkContract('Izaberite ugovor za obračun!');" /></td>
                </tr>
              </table>
              </form>  
              <form name="frmSearch" action="./ugovorunos.php" method="POST">
              <table cellpadding="2" cellspacing="2" border="0" class="table_search">
                <tr>
<?php
$query        = mysql_query("SELECT COUNT(I.ID) AS uk_broj FROM oszinvoice$_currentyear AS I 
    LEFT JOIN oszcontract$_currentyear AS C ON I.IDContract = C.ID
    WHERE C.IDEmployer > 1") or die(mysql_error());
$res          = mysql_fetch_array($query);
$browsecount  = $res["uk_broj"];

$_from    = 0;
$_offs    = $GLOBALS["browse_count"];
$navigate = false;

if (isset($_GET["from"])) $_from = (int)$_GET["from"];

if ($browsecount > $GLOBALS["browse_count"]) {
  $navigate   = true;
}

$sql = "SELECT I.ID, I.IDContract, I.date, I.net, I.sum, E.name
  FROM oszinvoice$_currentyear AS I
  LEFT JOIN oszcontract$_currentyear AS C ON I.IDContract = C.ID
  LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID
  WHERE C.IDEmployer > 1 ORDER BY I.ID DESC";

if ($navigate)
  $sql .= " LIMIT $_from, $_offs";
$query = mysql_query($sql) or die(mysql_error());

if ($navigate) {
  if ($_from > 0) {
    $from = $_from - $GLOBALS["browse_count"];
    if ($from < 0) $from = 0;
?>                  
                  <td><a href="faktura.php?from=0"><img src="./images/form/first.jpg" alt="<?=$_LANG["sr"]["FIRST"];?>" title="<?=$_LANG["sr"]["FIRST"];?>" /></a></td>
                  <td><a href="faktura.php?from=<?=$from;?>"><img src="./images/form/prev.jpg" alt="<?=$_LANG["sr"]["PREV"];?>" title="<?=$_LANG["sr"]["PREV"];?>" /></a></td>
<?php
  }
  $from = $_from + $GLOBALS["browse_count"];
  if ($from > $browsecount) $from = $from - $GLOBALS["browse_count"];
  $last = $browsecount - $GLOBALS["browse_count"];
  if ($_from + $GLOBALS["browse_count"] < $browsecount) {
?>                  
                  <td><a href="faktura.php?from=<?=$from;?>"><img src="./images/form/next.jpg" alt="<?=$_LANG["sr"]["NEXT"];?>" title="<?=$_LANG["sr"]["NEXT"];?>" /></a></td>
                  <td><a href="faktura.php?from=<?=$last;?>"><img src="./images/form/last.jpg" alt="<?=$_LANG["sr"]["LAST"];?>" title="<?=$_LANG["sr"]["LAST"];?>" /></a></td>
<?php
  }
}
?>                  
                </tr>
              </table>  
              </form>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>Broj fakture</th>
                  <th>Broj ugovora</th>
                  <th>Datum</th>
                  <th>Poslodavac</th>
                  <th>Neto iznos</th>
                  <th>Bruto iznos</th>
                  <th><?=$_LANG["sr"]["DELETE"];?></th>
                </tr>
<?php
while ($res = mysql_fetch_array($query)) {
?>                
                <tr>
                  <td align="right"><?=$res["ID"];?>.</td>
                  <td align="right"><?=$res["IDContract"];?>.</td>
                  <td><?=_db_date_to_date($res["date"]);?>&nbsp;</td>
                  <td><?=$res["name"];?>&nbsp;</td>
                  <td><?=number_format($res["net"],2,',','.');?></td>
                  <td><?=number_format($res["sum"],2,',','.');?></td>
                  <td align="center">
                    <a href="./faktura.php?id=<?=$res["ID"];?>&act=del" onClick="javascript: return confirmDelete('<?=$_LANG["sr"]["CONFIRM_DELETE_INVOICE"];?>');"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" /></a>
                  </td>
                </tr>
<? } ?>                
              </table>                 
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
if ($del) { ?>
<script language="JavaScript">
  alert("Podaci su uspešno izbrisani!");
</script>
<? } ?>
