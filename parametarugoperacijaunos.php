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
* @file         parametarugoperacijaunos.php
* @package       
* @subpackage   
*
* @description  Edit one contract parameter
*
* @history      14.06.2013. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
if (!$GLOBALS["admin"]) die($_LANG["sr"]["ACCESS_DENIED"]);

$ID             = 0;
$IDInvoiceRule  = 0;
$invoicerule    = '';

$name           = '';
$sort           = 0;
$invoice        = 0;
$report         = 0;
$operator       = '';
$input          = 0;
$inputVal       = '';
$inputY         = 0;
$operatorY      = '';
$inputZ         = 0;
$contributesum  = 0;
$inputnet       = 0;
$control        = 0;

if (isset($_GET["id"])) $ID = (int)$_GET["id"];
if (isset($_POST["ID"])) $ID = (int)$_POST["ID"];
if (isset($_GET["idir"])) $IDInvoiceRule = (int)$_GET["idir"];
if (isset($_POST["IDInvoiceRule"])) $IDInvoiceRule = (int)$_POST["IDInvoiceRule"];

if (isset($_POST["ID"])) {
//  dump($_POST);
//  die;
  $name           = $_POST['name'];
  $sort           = $_POST['sort'];
  $invoice        = (isset($_POST['invoice'])) ? 1 : 0;
  $report         = (isset($_POST['report'])) ? 1 : 0;
  $operator       = $_POST['operator'];
  $input          = (trim($_POST['input']<>'')) ? $_POST['input'] : 0;
  $inputVal       = (trim($_POST['inputVal']<>'')) ? $_POST['inputVal'] : 0;
  $inputY         = (trim($_POST['inputY']<>'')) ? $_POST['inputY'] : 0;
  $operatorY      = (trim($_POST['operatorY']<>'')) ? $_POST['operatorY'] : 0;
  $inputZ         = (trim($_POST['inputZ']<>'')) ? $_POST['inputZ'] : 0;
  $contributesum  = (isset($_POST['contributesum'])) ? 1 : 0;
  $inputnet       = (isset($_POST['inputnet'])) ? 1 : 0;
  $control        = (isset($_POST['control'])) ? 1 : 0;
  if ($ID > 0) {  // update
    $sql = "UPDATE oszcontractruledef SET name='%s', sort=%d, invoice=%d, report=%d, operator='%s', input=%d, inputVal=%f, inputY=%d, operatorY='%s', inputZ=%d, contributesum=%d, inputnet=%d, control=%d WHERE ID=%d";
    mysql_query(sprintf($sql,
      $name,
      $sort,
      $invoice,
      $report,
      $operator,
      $input,
      $inputVal,
      $inputY,
      $operatorY,
      $inputZ,
      $contributesum,
      $inputnet,
      $control,
      $ID
    )) or die(mysql_error());  
  } else {        // insert
    if ($IDInvoiceRule > 0) {
      $sql = "INSERT INTO oszcontractruledef (IDInvoiceRule, name, sort, invoice, report, operator, input, inputVal, inputY, operatorY, inputZ, contributesum, inputnet, control)";
      $sql .= " VALUES ( $IDInvoiceRule, '$name', $sort, $invoice, $report, operator='$operator', $input, $inputVal, $inputY, '$operatorY', $inputZ, $contributesum, $inputnet, $control)";
      mysql_query($sql) or die(mysql_error());
    }  
  }
  header("location: parametarunos.php?id=$IDInvoiceRule");  
}

if ($ID > 0) {
  $query = mysql_query(sprintf("SELECT * FROM oszcontractruledef WHERE ID=%d",$ID)) or die(mysql_error());
  $res = mysql_fetch_array($query);
  $IDInvoiceRule  = $res['IDInvoiceRule'];
  $name           = $res['name'];
  $sort           = $res['sort'];
  $invoice        = $res['invoice'];
  $report         = $res['report'];
  $operator       = $res['operator'];
  $input          = $res['input'];
  $inputVal       = $res['inputVal'];
  $inputY         = $res['inputY'];
  $operatorY      = $res['operatorY'];
  $inputZ         = $res['inputZ'];
  $contributesum  = $res['contributesum'];
  $inputnet       = $res['inputnet'];
  $control        = $res['control'];
}

if (isset($_GET["id"]) && isset($_GET["add"]) && $_GET["add"] == 'del') {
  // delete action
  mysql_query("DELETE FROM oszcontractruledef WHERE ID=$ID") or die(mysql_error());
  header("location: parametarunos.php?id=$IDInvoiceRule");
}

if ($IDInvoiceRule > 0) {
  $query = mysql_query(sprintf("SELECT * FROM oszinvoicerule WHERE ID=%d",$IDInvoiceRule)) or die(mysql_error());
  $res = mysql_fetch_array($query);
  if (isset($res["ID"])) {
    $invoicerule  = $res["name"];
  }

  $query = mysql_query(sprintf("SELECT * FROM oszcontractruledef WHERE IDInvoiceRule=%d ORDER BY sort", $IDInvoiceRule)) or die(mysql_error());
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
      "control"       => $res["control"],
      "image"         => "./images/signs/letther_".$i."_resize.png"
    );
    $i++;
  }
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?> - <?=$invoicerule;?></h2>
<script language="JavaScript">
  function checkInput() {
    var d       = document;
    var name    = d.getElementById('name').value.trim();
    var sort    = d.getElementById('sort').value.trim();
    
    if (name.length == 0) {
      alert('Naziv je obavezan podatak!');
      return false;
    }

    if (sort.length == 0) {
      alert('Redosled operacije je obavezan podatak!');
      return false;
    }
    
    return true;
  }
</script>                
              <form name="frmEdit" method="POST" action="./parametaroperacijaunos.php" onSubmit="javascript:return checkInput();">
              <input type="hidden" name="ID" id="ID" value="<?=$ID;?>">
              <input type="hidden" name="IDInvoiceRule" id="IDInvoiceRule" value="<?=$IDInvoiceRule;?>">
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit" width="100%">
                <tr>
                  <th class="required_data">Naziv parametra : </th>
                  <td><input type="text" name="name" id="name" value="<?=$name?>" maxlength="255" style="width:450px;" /></td>
                </tr>
                <tr>
                  <th class="required_data">Redosled operacije : </th>
                  <td><input type="text" name="sort" id="sort" value="<?=$sort?>" maxlength="5" style="width:30px;" /></td>
                </tr>
                <tr>
                  <th>Uključen u fakturu : </th>
                  <td><input type="checkbox" name="invoice" id="invoice" value="1" <? if ($invoice) echo 'checked'; ?> /></td>
                </tr>
                <tr>
                  <th>Uključen u izveštaju : </th>
                  <td><input type="checkbox" name="report" id="report" value="1" <? if ($report) echo 'checked'; ?> /></td>
                </tr>
                <tr>
                  <th>Ulazni parametar A : </th>
                  <td>
                    <select name="input" id="input">
                      <option value=""></option>
<?foreach ($_Invoiceruledef AS $key => $definition) {?>                      
                      <option value="<?=$key?>" <? if ($input == $key) echo 'selected';?> ><?=$definition["name"];?></option>
<?}?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Operacija A ∞ Koef. ili A ∞ B : </th>
                  <td>
                    <select name="operator" id="operator">
                      <option value=""></option>
<?for ($i = 0; $i < count($GLOBALS["operators"]); $i++) {?>                      
                      <option value="<?=$GLOBALS["operators"][$i]?>" <? if ($operator == $GLOBALS["operators"][$i]) echo 'selected';?> ><?=$GLOBALS["operators"][$i];?></option>
<?}?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>A ili kontrolni koeficijent : </th>
                  <td><input type="text" name="inputVal" id="inputVal" value="<?=$inputVal?>" style="width:70px;" /></td>
                </tr>
                <tr>
                  <th>Ulazni parametar B : </th>
                  <td>
                    <select name="inputY" id="inputY">
                      <option value=""></option>
<?foreach ($_Invoiceruledef AS $key => $definition) {?>                      
                      <option value="<?=$key?>" <? if ($inputY == $key) echo 'selected';?> ><?=$definition["name"];?></option>
<?}?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Operacija B ∞ C : </th>
                  <td>
                    <select name="operatorY" id="operatorY">
                      <option value=""></option>
<?for ($i = 0; $i < count($GLOBALS["operators"]); $i++) {?>                      
                      <option value="<?=$GLOBALS["operators"][$i]?>" <? if ($operator == $GLOBALS["operators"][$i]) echo 'selected';?> ><?=$GLOBALS["operators"][$i];?></option>
<?}?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Ulazni parametar C : </th>
                  <td>
                    <select name="inputZ" id="inputZ">
                      <option value=""></option>
<?foreach ($_Invoiceruledef AS $key => $definition) {?>                      
                      <option value="<?=$key?>" <? if ($inputZ == $key) echo 'selected';?> ><?=$definition["name"];?></option>
<?}?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Suma ∑ : </th>
                  <td><input type="checkbox" name="contributesum" id="contributesum" value="1" <? if ($contributesum) echo 'checked'; ?> /></td>
                </tr>
                <tr>
                  <th>Neto : </th>
                  <td><input type="checkbox" name="inputnet" id="inputnet" value="1" <? if ($inputnet) echo 'checked'; ?> /></td>
                </tr>
                <tr>
                  <th>Kontrolni koeficijent : </th>
                  <td><input type="checkbox" name="control" id="control" value="1" <? if ($control) echo 'checked'; ?> /></td>
                </tr>
                <tr>
                  <td class="required_data">Unos podataka je obavezan!</td>
                  <td style="padding:5px 5px 5px 0px;" align="right"><input type="submit" class="btn" name="submit" value="Sačuvaj" /> &nbsp; <input type="button" class="btn" name="reset" value="Nazad" onClick="javascript: history.go(-1);" /></td>
                </tr>
              </table>
              </form>
<?
  if ($affected > 0) {
?>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>&nbsp;</th>
                  <th>Naziv</th>
                  <th>Fakt.</th>
                  <th>Izveš.</th>
                  <th>A</th>
                  <th>Op.</th>
                  <th>Koef.</th>
                  <th>B</th>
                  <th>Op.</th>
                  <th>C</th>
                  <th>∑</th>
                  <th>Neto</th>
                  <th>Sort</th>
                  <th>Kont</th>
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
                  <td align="center" valign="middle"><?=$res["sort"];?></td>
                  <td align="center" valign="middle"><? if ($res["control"]) { ?> <img src="./images/form/att.jpg" /><? } else echo '&nbsp;'; ?></td>
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
