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
* @file         parametarugpregled.php
* @package       
* @subpackage   
*
* @description  View contract parameter
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
  $query = mysql_query(sprintf("SELECT * FROM oszcontractruledef WHERE ID=%d",$id)) or die(mysql_error());
  $res   = mysql_fetch_array($query);
  $IDInvoiceRule = $res["IDInvoiceRule"];
  $sort  = $res["sort"];
  if ($_GET["sort"] == "up") {  // up
    mysql_query(sprintf("UPDATE oszcontractruledef SET sort=%d WHERE IDInvoiceRule=%d AND sort=%d", $sort, $IDInvoiceRule, $sort-1)) or die(mysql_error());
    mysql_query(sprintf("UPDATE oszcontractruledef SET sort=%d WHERE ID=%d", $sort-1, $id)) or die(mysql_error());
  } else {                      // down
    mysql_query(sprintf("UPDATE oszcontractruledef SET sort=%d WHERE IDInvoiceRule=%d AND sort=%d", $sort, $IDInvoiceRule, $sort+1)) or die(mysql_error());
    mysql_query(sprintf("UPDATE oszcontractruledef SET sort=%d WHERE ID=%d", $sort+1, $id)) or die(mysql_error());
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
              <form name="frmEdit" method="POST" action="./parametarunos.php">
              <input type="hidden" name="ID" id="ID" value="<?=$id;?>">
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit" width="100%">
                <tr>
                  <th>Naziv pravila : </th>
                  <td><input type="text" name="name" id="name" value="<?=$name?>" maxlength="255" style="width:450px;" disabled="disabled" /></td>
                </tr>
                <tr>
                  <th>Uključi starosnu granicu : </th>
                  <td><input type="text" name="age" id="age" value="<?=$age?>" maxlength="5" style="width:30px;" disabled="disabled" /></td>
                </tr>
                <tr>
                  <th>Pravilo za starosnu granicu : </th>
                  <td>
                    <select name="agerule" id="agerule" disabled="disabled">
                      <option value="">Izaberite pravilo</option>
<? foreach($GLOBALS["invoicerule"] as $key => $value) { $selected = ""; if ($key == $agerule) $selected = "selected"; ?>                   
                      <option value="<?=$key;?>" <?=$selected;?>><?=$value;?></option>
<? } ?>
                    </select>
                  </td>
                </tr>
                <!--<tr>
                  <td>&nbsp;</td>
                  <td><input type="submit" class="btn" name="save" value="<?=$_LANG["sr"]["SAVE"];?>" disabled="disabled" /></td>
                </tr>-->
              </table>
              </form>
<?
if ($id > 0) { 
  $query = mysql_query(sprintf("SELECT * FROM oszcontractruledef WHERE IDInvoiceRule=%d ORDER BY sort", $id)) or die(mysql_error());
  $_Invoiceruledef = array();
  $affected = mysql_num_rows($query);
  $i = 1;
  while ($res = mysql_fetch_array($query)) {
    $_Invoiceruledef[$res["ID"]] = array (
      "name"          => $res["name"],
      "sort"          => $res["sort"],
      "invoice"       => $res["invoice"],
      "report"        => $res["report"],
      "operator"      => $res["operator"],
      "input"         => $res["input"],
      "inputVal"      => $res["inputVal"],
      "inputY"        => $res["inputY"],
      "operatorY"     => $res["operatorY"],
      "inputZ"        => $res["inputZ"],
      "contributesum" => $res["contributesum"],
      "inputnet"      => $res["inputnet"],
      "image"         => "./images/signs/letther_".$i."_resize.png"
    );
    $i++;
  }
  if ($affected > 0) {
?>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>&nbsp;</th>
                  <th>Naziv</th>
                  <th>Fakt.?</th>
                  <th>Izveš.?</th>
                  <th>A</th>
                  <th>Oper.</th>
                  <th>Koef.</th>
                  <th>B</th>
                  <th>Oper.</th>
                  <th>C</th>
                  <th>Sum?</th>
                  <th>Neto?</th>
                  <th>Ord</th>
                </tr>
<? $started = true; $current = 0; foreach ($_Invoiceruledef AS $key => $res) { $current++; ?>                
                <tr>
                  <td align="center" valign="middle"><img src="<?=$res["image"];?>" alt="<?=$res["name"];?>" title="<?=$res["name"];?>" /></td>
                  <td><?=substr($res["name"], 0, 40);?></td>
                  <td align="center" valign="middle"><? if ($res["invoice"]) { ?> <img src="./images/form/att.jpg" /><? } else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"><? if ($res["report"]) { ?> <img src="./images/form/att.jpg" /><? } else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"><? if ($res["input"] > 0) { ?> 
                    <img src="<?=$_Invoiceruledef[$res["input"]]["image"];?>" alt="<?=$_Invoiceruledef[$res["input"]]["name"];?>" title="<?=$_Invoiceruledef[$res["input"]]["name"];?>"/> 
                    <? } else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"><?if (strlen(trim($res["operator"])) > 0) echo $res["operator"]; else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"><?if ($res["inputVal"] > 0) echo $res["inputVal"]; else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"><? if ($res["inputY"] > 0) { ?>
                    <img src="<?=$_Invoiceruledef[$res["inputY"]]["image"];?>" alt="<?=$_Invoiceruledef[$res["inputY"]]["name"];?>" title="<?=$_Invoiceruledef[$res["inputY"]]["name"];?>"/> 
                    <? } else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"><?if ($res["operatorY"] != "") echo $res["operatorY"]; else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"d><? if ($res["inputZ"] > 0) { ?>
                    <img src="<?=$_Invoiceruledef[$res["inputZ"]]["image"];?>" alt="<?=$_Invoiceruledef[$res["inputZ"]]["name"];?>" title="<?=$_Invoiceruledef[$res["inputZ"]]["name"];?>"/> 
                    <? } else echo '&nbsp;'; ?></td>
                  <td align="center" valign="middle"><? if ($res["contributesum"]) { ?> <img src="./images/form/att.jpg" /><? } else echo '&nbsp;'; ?> </td>
                  <td align="center" valign="middle"><? if ($res["inputnet"]) { ?> <img src="./images/form/att.jpg" /><? } else echo '&nbsp;'; ?> </td>
                  <td align="center" valign="middle">
                    <!--<table cellpadding="0" cellspacing="0" border="0">
                      <tr><td style="border:0px none;" align="center"> <? if ($started) { $started=false; echo '&nbsp;'; } else { ?><a href="parametarunos.php?id=<?=$key;?>&sort=up"><img src="./images/form/up.jpg" /></a><? } ?></td></tr>
                      <tr><td style="border:0px none;" align="center"> <? if ($affected == $current) { echo '&nbsp;'; } else { ?><a href="parametarunos.php?id=<?=$key;?>&sort=down"><img src="./images/form/down.jpg" /></a><? } ?></td></tr>
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
