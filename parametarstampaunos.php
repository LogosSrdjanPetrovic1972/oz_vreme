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
* @file         parametarstampaunos.php
* @package       
* @subpackage   
*
* @description  Edit invoice print to pdf parameters
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
$id             = 0;
$IDInvoiceRule  = 0;
$name           = '';
$age            = 0;
$agerule        = '';

if (isset($_GET["id"])) $id = (int)$_GET["id"];

if (isset($_GET["sort"]) && $id > 0) {
  $query = mysql_query(sprintf("SELECT * FROM oszinvoiceruleprt WHERE ID=%d",$id)) or die(mysql_error());
  $res   = mysql_fetch_array($query);
  $IDInvoiceRule = $res["IDInvoiceRule"];
  $sort  = $res["sort"];
  if ($_GET["sort"] == "up") {  // up
    mysql_query(sprintf("UPDATE oszinvoiceruleprt SET sort=%d WHERE IDInvoiceRule=%d AND sort=%d", $sort, $IDInvoiceRule, $sort-1)) or die(mysql_error());
    mysql_query(sprintf("UPDATE oszinvoiceruleprt SET sort=%d WHERE ID=%d", $sort-1, $id)) or die(mysql_error());
  } else {                      // down
    mysql_query(sprintf("UPDATE oszinvoiceruleprt SET sort=%d WHERE IDInvoiceRule=%d AND sort=%d", $sort, $IDInvoiceRule, $sort+1)) or die(mysql_error());
    mysql_query(sprintf("UPDATE oszinvoiceruleprt SET sort=%d WHERE ID=%d", $sort+1, $id)) or die(mysql_error());
  }
  $id = $IDInvoiceRule;
}

if ($id > 0) {
  $query = mysql_query(sprintf("SELECT * FROM oszinvoicerule WHERE ID=%d",$id)) or die(mysql_error());
  $res = mysql_fetch_array($query);
  if (isset($res["ID"])) {
    $name     = $res["name"];
    $age      = $res["age"];
    $agerule  = $res["agerule"];
  }
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit" width="100%">
                <tr>
                  <th>Naziv pravila : </th>
                  <td><?=$name?></td>
                </tr>
                <tr>
                  <th>Uključi starosnu granicu : </th>
                  <td><?=$age?></td>
                </tr>
                <tr>
                  <th>Pravilo za starosnu granicu : </th>
                  <td><?=$GLOBALS["invoicerule"][$agerule];?>
                  </td>
                </tr>
              </table>
<?
if ($id > 0) { 
  $query = mysql_query(sprintf("SELECT * FROM oszinvoiceruledef WHERE IDInvoiceRule=%d ORDER BY sort", $id)) or die(mysql_error());
  $def = array();
  while ($res = mysql_fetch_array($query)) {
    $def[$res["ID"]] = $res["name"];
  }

  $query = mysql_query(sprintf("SELECT * FROM oszinvoiceruleprt WHERE IDInvoiceRule=%d AND invoice ORDER BY sort", $id)) or die(mysql_error());
  $prt = array();
  while ($res = mysql_fetch_array($query)) {
    $prt[$res["ID"]] = $res["name"];
  }

  $query = mysql_query(sprintf("SELECT * FROM oszinvoiceruleprt WHERE IDInvoiceRule=%d AND invoice ORDER BY sort", $id)) or die(mysql_error());
  $_Invoiceruleprt = array();
  $affected = mysql_num_rows($query);
  while ($res = mysql_fetch_array($query)) {
    $_Invoiceruleprt[$res["ID"]] = array (
      "IDInvoiceRule" => $res["IDInvoiceRule"],
      "invoice"       => $res["invoice"],
      "name"          => $res["name"],
      "net"           => $res["net"],
      "sort"          => $res["sort"],
      "inputA"        => $res["inputA"],
      "inputAOper"    => $res["inputAOper"],
      "inputASrc"     => $res["inputASrc"],
      "inputB"        => $res["inputB"],
      "inputBOper"    => $res["inputBOper"],
      "inputBSrc"     => $res["inputBSrc"],
      "inputC"        => $res["inputC"],
      "inputCSrc"     => $res["inputCSrc"]
    );
  }
  if ($affected > 0) {
?>
              <h3>Faktura:</h3>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>Naziv : </th>
                  <th>Neto?</th>
                  <th>A</th>
                  <th>A oper.</th>
                  <th>B</th>
                  <th>B oper.</th>
                  <th>C</th>
                  <th>&nbsp;</th>
                </tr>
<?  $started = true; 
    $current = 0; 
    foreach ($_Invoiceruleprt AS $key => $res) { 
      $current++; 
?>                
                <tr>
                  <td><?=$res["name"];?></td>
                  <td align="center"><? if ($res["net"]) { ?> <img src="./images/form/att.jpg" /><? } else echo '&nbsp;'; ?> </td>
                  <td>
    <? if ((int)$res["inputA"] > 0) { 
      switch($res["inputASrc"]) {
        case "ugo":
          echo 'Ugovor';
          break;
        case "def":
          echo $def[$res["inputA"]];
          break;
        case "prt":
          echo $prt[$res["inputA"]];
          break;
        default:
          echo '&nbsp;';
          break;
      } } else echo '&nbsp;';
    ?> 
                   </td>
                  <td align="center"><?if (strlen(trim($res["inputAOper"])) > 0) echo $res["inputAOper"]; else echo '&nbsp;'; ?></td>
                  <td>
    <? if ((int)$res["inputB"] > 0) { 
      switch($res["inputBSrc"]) {
        case "ugo":
          echo 'Ugovor';
          break;
        case "def":
          echo $def[$res["inputB"]];
          break;
        case "prt":
          echo $prt[$res["inputB"]];
          break;
        default:
          echo '&nbsp;';
          break;
      } } else echo '&nbsp;';
    ?> 
                   </td>
                  <td align="center"><?if (strlen(trim($res["inputBOper"])) > 0) echo $res["inputBOper"]; else echo '&nbsp;'; ?></td>
                  <td>
    <? if ((int)$res["inputC"] > 0) { 
      switch($res["inputCSrc"]) {
        case "ugo":
          echo 'Ugovor';
          break;
        case "def":
          echo $def[$res["inputC"]];
          break;
        case "prt":
          echo $prt[$res["inputC"]];
          break;
        default:
          echo '&nbsp;';
          break;
      } } else echo '&nbsp;';
    ?> 
                   </td>
                  <td align="center">
                    <!-- <table cellpadding="0" cellspacing="0" border="0">
                      <tr><td style="border:0px none;" align="center"><? if ($started) { $started=false; echo '&nbsp;'; } else { ?><a href="parametarstampaunos.php?id=<?=$key;?>&sort=up"><img src="./images/form/up.jpg" /></a><? } ?></td></tr>
                      <tr><td style="border:0px none;" align="center"><? if ($affected == $current) { echo '&nbsp;'; } else { ?><a href="parametarstampaunos.php?id=<?=$key;?>&sort=down"><img src="./images/form/down.jpg" /></a><? } ?></td></tr>
                    </table> -->&nbsp;
                  </td>
                </tr>
<? } ?>                
              </table>
<?
  }
  $query = mysql_query(sprintf("SELECT * FROM oszinvoiceruleprt WHERE IDInvoiceRule=%d AND NOT invoice ORDER BY sort", $id)) or die(mysql_error());
  $prt = array();
  while ($res = mysql_fetch_array($query)) {
    $prt[$res["ID"]] = $res["name"];
  }

  $query = mysql_query(sprintf("SELECT * FROM oszinvoiceruleprt WHERE IDInvoiceRule=%d AND NOT invoice ORDER BY sort", $id)) or die(mysql_error());
  $_Invoiceruleprt = array();
  $affected = mysql_num_rows($query);
  while ($res = mysql_fetch_array($query)) {
    $_Invoiceruleprt[$res["ID"]] = array (
      "IDInvoiceRule" => $res["IDInvoiceRule"],
      "invoice"       => $res["invoice"],
      "name"          => $res["name"],
      "net"           => $res["net"],
      "sort"          => $res["sort"],
      "inputA"        => $res["inputA"],
      "inputAOper"    => $res["inputAOper"],
      "inputASrc"     => $res["inputASrc"],
      "inputB"        => $res["inputB"],
      "inputBOper"    => $res["inputBOper"],
      "inputBSrc"     => $res["inputBSrc"],
      "inputC"        => $res["inputC"],
      "inputCSrc"     => $res["inputCSrc"]
    );
  }
  if ($affected > 0) {
?>
              <h3>Poreska prijava o obračunatom i plaćenom porezu na druge prihode:</h3>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>Naziv : </th>
                  <th>Neto?</th>
                  <th>A</th>
                  <th>A oper.</th>
                  <th>B</th>
                  <th>B oper.</th>
                  <th>C</th>
                  <th>&nbsp;</th>
                </tr>
<?  $started = true; 
    $current = 0; 
    foreach ($_Invoiceruleprt AS $key => $res) { 
      $current++; 
?>                
                <tr>
                  <td><?=$res["name"];?></td>
                  <td align="center"><? if ($res["net"]) { ?> <img src="./images/form/att.jpg" /><? } else echo '&nbsp;'; ?> </td>
                  <td>
    <? if ((int)$res["inputA"] > 0) { 
      switch($res["inputASrc"]) {
        case "ugo":
          echo 'Ugovor';
          break;
        case "def":
          echo $def[$res["inputA"]];
          break;
        case "prt":
          echo $prt[$res["inputA"]];
          break;
        default:
          echo '&nbsp;';
          break;
      } } else echo '&nbsp;';
    ?> 
                   </td>
                  <td align="center"><?if (strlen(trim($res["inputBOper"])) > 0) echo $res["inputBOper"]; else echo '&nbsp;'; ?></td>
                  <td>
    <? if ((int)$res["inputB"] > 0) { 
      switch($res["inputBSrc"]) {
        case "ugo":
          echo 'Ugovor';
          break;
        case "def":
          echo $def[$res["inputB"]];
          break;
        case "prt":
          echo $prt[$res["inputB"]];
          break;
        default:
          echo '&nbsp;';
          break;
      } } else echo '&nbsp;';
    ?> 
                   </td>
                  <td align="center"><?if (strlen(trim($res["inputBOper"])) > 0) echo $res["inputBOper"]; else echo '&nbsp;'; ?></td>
                  <td>
    <? if ((int)$res["inputC"] > 0) { 
      switch($res["inputCSrc"]) {
        case "ugo":
          echo 'Ugovor';
          break;
        case "def":
          echo $def[$res["inputC"]];
          break;
        case "prt":
          echo $prt[$res["inputC"]];
          break;
        default:
          echo '&nbsp;';
          break;
      } } else echo '&nbsp;';
    ?> 
                   </td>
                  <td align="center">
                    <!--<table cellpadding="0" cellspacing="0" border="0">
                      <tr><td style="border:0px none;" align="center"><? if ($started) { $started=false; echo '&nbsp;'; } else { ?><a href="parametarstampaunos.php?id=<?=$key;?>&sort=up"><img src="./images/form/up.jpg" /></a><? } ?></td></tr>
                      <tr><td style="border:0px none;" align="center"><? if ($affected == $current) { echo '&nbsp;'; } else { ?><a href="parametarstampaunos.php?id=<?=$key;?>&sort=down"><img src="./images/form/down.jpg" /></a><? } ?></td></tr>
                    </table>-->&nbsp;
                  </td>
                </tr>
<? } ?>                
              </table>
<?
  }  
} ?>              
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>