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
* @file         fakturaracun.php
* @package       
* @subpackage   
*
* @description  Izveštaj o obračunu fakture
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
$IDContract   = 0;
if (isset($_POST["selContract"]) && (int)$_POST["selContract"] > 0)
  $IDContract = (int)$_POST["selContract"];
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<?
if ($IDContract > 0) {
  $neto     = 0; 
  // first check if we have contract definition
  $query    = mysql_query(sprintf("SELECT C.ID, C.IDEmployer, C.contractdate, E.name, E.address, E.phone, E.mobile, E.fax FROM oszcontract$_currentyear AS C 
              LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID WHERE C.ID=%d", $IDContract)) or die(mysql_error());
  $contract = mysql_fetch_array($query);
  if (isset($contract["ID"])) {
    $contractitem = mysql_query(sprintf("SELECT CI.ID, CI.IDMember, CI.net, M.surname, M.name, M.birthday FROM oszcontractitem$_currentyear AS CI 
      LEFT JOIN oszmember$_currentyear AS M ON CI.IDMember = M.ID
      WHERE CI.IDContract=%d ORDER BY M.surname, M.name", $IDContract)) or die(mysql_error());
    
    if (mysql_num_rows($contractitem) > 0) {
      $query = mysql_query("SELECT * FROM oszinvoicerule") or die(mysql_error());
      $rules = array();
      while ($res = mysql_fetch_array($query)) {
        $rules[$res['ID']] = array(
          "name"      => $res["name"],
          "age"       => $res["age"],
          "agerule"   => $res["agerule"]
        );
      }
?>      
            <form name="frmBilling" method="POST" action="./fakturaobracun.php">
            <input type="hidden" value="<?=$IDContract;?>" name="IDContract" />
            <table border="0" cellpadding="2" cellspacing="2" width="100%" class="table_browse">
              <tr> 
                <th valign="top">
                  Obrada fakture po ugovoru: <?=$IDContract;?> / <?=$_currentyear;?>
                </th>
                <td colspan="2">
                  <b>Poslodavac :</b> <?=$contract["name"];?><br />
                  <b>Adresa :</b> <?=$contract["address"];?><br />
                  <b>Telefon :</b> <?=$contract["phone"];?><br />
                  <b>Mobilni :</b> <?=$contract["mobile"];?><br />
                  <b>Fax :</b> <?=$contract["fax"];?>
                </td>
              </tr>
              <tr> 
                <th valign="top">
                  Datum fakture: 
                </th>
                <td colspan="2">
                  	<input type="text" name="date" id="date" value="<?=date("d").".".date("m").".".date("Y");?>" style="width:70px;" />
	<script language="JavaScript">
	new tcal ({'formname': 'frmBilling', 'controlname': 'date'});
	</script>
                </td>
              </tr>
              <tr> 
                <th>Prezime i ime</th>
                <th>Neto iznos</th>
                <th>Način obračuna</th>
              </tr>
<? while ($res = mysql_fetch_array($contractitem)) { $neto += $res["net"];?>              
              <tr> 
                <td><?=$res['surname'];?> <?=$res['name'];?>
                  <input type="hidden" name="ID[]" value="<?=$res['ID'];?>" />
                </td>
                <td align="right"><?=number_format($res["net"], 2, '.', '');?></td>
                <td>
                  <select name="rule[]">
<? 
  $birthday = _get_Age($res["birthday"]);
  if ($birthday <= $GLOBALS["agerule"])
    $idrule = $GLOBALS["oldid"];
  else
    $idrule = $GLOBALS["olderid"];
    foreach($rules as $ID => $rule) { $selected=""; if ($idrule == $ID) $selected="selected";?>
                    <option value="<?=$ID;?>" <?=$selected;?> ><?=$rule["name"];?></option>
<? } ?>
                  </select>
                </td>
              </tr>
<? } ?>
              <tr> 
                <td align="center"><input type="image" src="./images/form/calc_middle.jpg" name="submit" alt="Obračunaj" title="Obračunaj" /></td>
                <td align="right"><?=number_format($neto, 2, '.', '');?></td>
                <th>UKUPNO</th>
              </tr>
            </table>
          </form>
<?
    } else echo '<h3>Podaci ugovora nisu dostupni, obračun nije moguć!</h3>';
  } else echo '<h3>Podaci ugovora nisu dostupni, obračun nije moguć!</h3>';
} else echo '<h3>Podaci ugovora nisu dostupni, obračun nije moguć!</h3>';
?>              
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
