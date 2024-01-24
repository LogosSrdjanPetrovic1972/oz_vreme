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
* @file         zaradaunos.php
* @package       
* @subpackage   
*
* @description  Zarada unos
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$selContract = 0;

if (!isset($_POST["selContract"]) && isset($_GET["id"]))
  $_POST["selContract"] = $_GET["id"];

if (isset($_POST["selContract"]) && (int)$_POST["selContract"] > 0) {
  $selContract              = (int)$_POST["selContract"];
  $query                    = mysql_query(sprintf("SELECT * FROM oszcontract$_currentyear WHERE ID=%d",$selContract)) or die(mysql_error());
  $res                      = mysql_fetch_array($query);
  $_POST["selEmployer"]     = $res['IDEmployer'];
  $_POST["onday"]           = _db_date_to_day($res['contractdate']);
  $_POST["onmonth"]         = _db_date_to_month($res['contractdate']);
  $_POST["onyear"]          = _db_date_to_year($res['contractdate']);
  if ($_timescale == 1) {
    $_POST["fromday"]         = _db_date_to_day($res['contractfrom']);
    $_POST["frommonth"]       = _db_date_to_month($res['contractfrom']);
    $_POST["fromyear"]        = _db_date_to_year($res['contractfrom']);
    $_POST["today"]           = _db_date_to_day($res['contractto']);
    $_POST["tomonth"]         = _db_date_to_month($res['contractto']);
    $_POST["toyear"]          = _db_date_to_year($res['contractto']);
    $_POST["hours"]           = $res['hours'];
  }
  $_POST["jobdescription"]  = $res['jobdescription'];
}
  
if (isset($_POST["zarada"]) && is_array($_POST["zarada"]) && count($_POST["zarada"]) > 0) {
  if (isset($_POST["selContract"]) && (int)$_POST["selContract"] > 0) 
    $action = 'edit';
  else
    $action = 'new';
  
  if ($action == 'new') {
    // add contract
    $query    = mysql_query("SELECT MAX(ID) AS last_id FROM oszcontract$_currentyear") or die(mysql_error());
    $res      = mysql_fetch_array($query);
    $last_id  = $res["last_id"];
    if ($_timescale == 1) {
      mysql_query(sprintf("INSERT INTO oszcontract$_currentyear (ID,IDEmployer,contractdate,jobdescription, contractfrom, contractto, hours) VALUES (%d,%d,'%s','%s','%s','%s','%s')",
          $last_id+1,
          (int) $_POST["selEmployer"],
          _input_to_db_date($_POST["onday"],$_POST["onmonth"],$_POST["onyear"]),
          $_POST["jobdescription"],
          _input_to_db_date($_POST["fromday"],$_POST["frommonth"],$_POST["fromyear"]),
          _input_to_db_date($_POST["today"],$_POST["tomonth"],$_POST["toyear"]),
          $_POST["hours"]
        )) or die(mysql_error());
    } else {
      mysql_query(sprintf("INSERT INTO oszcontract$_currentyear (ID, IDEmployer,contractdate,jobdescription) VALUES (%d,%d,'%s','%s')",
          $last_id+1,
          (int) $_POST["selEmployer"],
          _input_to_db_date($_POST["onday"],$_POST["onmonth"],$_POST["onyear"]),
          $_POST["jobdescription"]
        )) or die(mysql_error());
    }
    $IDContract = $last_id+1;
  } else {
    $IDContract = (int)$_POST["selContract"];
    if ($_timescale == 1) {
      mysql_query(sprintf("UPDATE oszcontract$_currentyear SET IDEmployer=%d,contractdate='%s',jobdescription='%s',contractfrom='%s',contractto='%s',hours='%s' WHERE ID=%d",
          (int) $_POST["selEmployer"],
          _input_to_db_date($_POST["onday"],$_POST["onmonth"],$_POST["onyear"]),$_POST["jobdescription"],
          _input_to_db_date($_POST["fromday"],$_POST["frommonth"],$_POST["fromyear"]),
          _input_to_db_date($_POST["today"],$_POST["tomonth"],$_POST["toyear"]),
          $_POST["hours"],
          $IDContract
        )) or die(mysql_error());
    } else {
      mysql_query(sprintf("UPDATE oszcontract$_currentyear SET IDEmployer=%d,contractdate='%s',jobdescription='%s' WHERE ID=%d",
          (int) $_POST["selEmployer"],
          _input_to_db_date($_POST["onday"],$_POST["onmonth"],$_POST["onyear"]),$_POST["jobdescription"],
          $IDContract
        )) or die(mysql_error());
    }
    mysql_query(sprintf("DELETE FROM oszcontractitem$_currentyear WHERE IDContract=%d", $IDContract)) or die(mysql_error());
  }
  if ($_timescale == 2) 
    $sql = "INSERT INTO oszcontractitem$_currentyear (IDContract,IDMember,net,contractfrom,contractto,hours) VALUES (%d,%d,%f,'%s','%s','%s')";
  else
    $sql = "INSERT INTO oszcontractitem$_currentyear (IDContract,IDMember,net) VALUES (%d,%d,%f)";
  foreach($_POST["zarada"] as $key => $zarada) {
    $insert = explode(";", $_POST["zarada"][$key]);
    $ins_id   = $insert[0];
    $ins_net  = $insert[1];
    
    if ($_timescale == 2) {
      $hours = explode(";", $_POST["hours"][$key]);
      //dump(sprintf($sql,$IDContract,$insert[0],$insert[1],_input_date_to_db_date($hours[0]),_input_date_to_db_date($hours[1]),$hours[2]));
      mysql_query(sprintf($sql,$IDContract,$insert[0],$insert[1],_input_date_to_db_date($hours[0]),_input_date_to_db_date($hours[1]),$hours[2])) or die(mysql_error());
    } else
      mysql_query(sprintf($sql,$IDContract,$insert[0],$insert[1])) or die(mysql_error());
  }
  $selContract = $IDContract;
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<script language="JavaScript">              
  function submitPage() {
    var frm = document.getElementById('frmTableEdit');
    frm.submit();
  }
</script>                 
              <form name="frmTableEdit" id="frmTableEdit" method="POST" action="./zaradaunos.php">
              <input type="hidden" name="selContract" value="<?=$selContract;?>" />
                    <table cellpadding="2" cellspacing="2" border="0" class="table_browse">
                      <tr>
                        <th>Poslodavac :</th>
                        <td>
                          <select name="selEmployer" id="selEmployer">
                            <option value="-1">Izaberite poslodavca</option>
<?php
$query = mysql_query("SELECT ID, name FROM oszemployer ORDER BY name") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  // _db_date_to_date($date)
  $selected = "";
  if ($res["ID"] == (int)$_POST["selEmployer"]) $selected = "selected";
?>
                            <option value="<?=$res["ID"];?>" <?=$selected;?>><?=$res["name"];?></option>
<?
}
?>                      
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th>Na dan :</th>
                        <td>
                    <select name="onday" id="onday">
<? for ($i = 0; $i < 32; $i++) { $selected = ""; if ($i == (int)$_POST["onday"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="onmonth" id="onmonth">
<? for ($i = 0; $i < 13; $i++) { $selected = ""; if ($i == (int)$_POST["onmonth"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="onyear" id="onyear">
                      <option value="0">0</option>                 
<? for ($i = 2000; $i < date("Y")+2; $i++) { $selected = ""; if ($i == $_POST["onyear"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                        </td>
                      </tr>
<? if ($_timescale == 1) { ?>                      
                      <tr>
                        <th>Angažovan od :</th>
                        <td>
                    <select name="fromday" id="fromday">
<? for ($i = 0; $i < 32; $i++) { $selected = ""; if ($i == (int)$_POST["fromday"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="frommonth" id="frommonth">
<? for ($i = 0; $i < 13; $i++) { $selected = ""; if ($i == (int)$_POST["frommonth"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="fromyear" id="fromyear">
                      <option value="0">0</option>                 
<? for ($i = 2000; $i < date("Y")+2; $i++) { $selected = ""; if ($i == $_POST["fromyear"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                        </td>
                      </tr>
                      <tr>
                        <th>Do :</th>
                        <td>
                    <select name="today" id="today">
<? for ($i = 0; $i < 32; $i++) { $selected = ""; if ($i == (int)$_POST["today"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="tomonth" id="tomonth">
<? for ($i = 0; $i < 13; $i++) { $selected = ""; if ($i == (int)$_POST["tomonth"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="toyear" id="toyear">
                      <option value="0">0</option>                 
<? for ($i = 2000; $i < date("Y")+2; $i++) { $selected = ""; if ($i == $_POST["toyear"]) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                        </td>
                      </tr>
                      <tr>
                        <th>Broj sati :</th>
                        <td><input name="hours" id="hours" value="<?=$_POST["hours"];?>" style="width:50px;" maxlength="5" />
                        </td>
                      </tr>
<? } ?>                      
                      
                      <tr>
                        <th>Opis posla :</th>
                        <td><!--<input type="text" name="jobdescription" value="<?=$_POST["jobdescription"];?>" style="width:400px;" />-->
                          <textarea name="jobdescription" style="width:630px;" rows="3"><?=$_POST["jobdescription"];?></textarea>
                        </td>
                      </tr>
                <tr>
                  <th>Samo za prijavljene kod: </th>
                  <td>
                    <select name="IDEmployer" id="IDEmployer" onChange="javascript: submitPage();">
                      <option value="-1">Izaberite poslodavca</option>
<?php
$query = mysql_query("SELECT ID, name FROM oszemployer ORDER BY name") or die(mysql_error());
while ($res = mysql_fetch_array($query)) { 
  $selected = "";
  if (isset($_POST["IDEmployer"]) && (int)$_POST["IDEmployer"] == $res["ID"])
    $selected = "selected";
?>                    
                      <option value="<?=$res["ID"];?>" <?=$selected?>><?=$res["name"];?></option>
<? } ?>
                    </select>
                  </td>
                </tr>
              </table>
<br />
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" id="table_browse" width="100%">
<script language="JavaScript">
  var zadrugarList    = new Array();
<?php
$query = mysql_query("SELECT ID, name, surname FROM oszmember$_currentyear ORDER BY surname, name") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
?>
  zadrugarList[<?=$res["ID"];?>] = '<?=$res["surname"];?> <?=$res["name"];?>';
<? } ?>  
  function addColumn() {
    var d             = document;
    var rand          = Math.floor(Math.random() * 10000000000000);
    var table_browse  = d.getElementById('table_browse');
    var text_delete   = '<?=$_LANG["sr"]["DELETE"];?>';
    var zadrugar      = d.getElementById('zadrugar');
    var neto          = d.getElementById('neto');
    var lblNeto       = d.getElementById('lblNeto');
    var edtNeto       = d.getElementById('edtNeto');
    var suma          = 0.00;
<? if ($_timescale == 2) { ?>    
    var contractfrom  = d.getElementById('contractfrom');
    var contractto    = d.getElementById('contractto');
    var hours         = d.getElementById('hours');
<? } ?>    
    
    if (zadrugar.selectedIndex == 0) {
      alert('Izaberite zadrugara za dodavanje!');
      return false;
    }
    if (neto.value.trim() == '' || neto.value == NaN) {
      neto.value = '0.0';
    }
    
    var rowNew      = table_browse.insertRow(3);
    rowNew.setAttribute("id", rand);
    var newCellZadr = rowNew.insertCell(-1);
    var newCellNeto = rowNew.insertCell(-1);
<? if ($_timescale == 2) { ?>    
    var newCellFrom = rowNew.insertCell(-1);
    var newCellTo   = rowNew.insertCell(-1);
    var newCellHours = rowNew.insertCell(-1);
    newCellFrom.setAttribute("align", "center");
    newCellTo.setAttribute("align", "center");
    newCellHours.setAttribute("align", "right");
<? } ?>    
    var newCellDel  = rowNew.insertCell(-1);
    
    if (zadrugar.selectedIndex != 0)
      newCellZadr.innerHTML   = zadrugarList[zadrugar.value];
    else
      newCellZadr.innerHTML   = '';
    var for_neto = parseFloat(neto.value);
    newCellNeto.innerHTML   = for_neto.toFixed(2);
    newCellNeto.setAttribute("align", "right");
    
    var ahref   = document.createElement("a");
    ahref.setAttribute("href", "javascript:deleteRow('" + rand + "');");
    var img     = document.createElement("img");
    img.setAttribute("src", "./images/form/del.jpg");
    img.setAttribute("alt", text_delete);
    img.setAttribute("title", text_delete);
    ahref.appendChild(img);
    newCellDel.appendChild(ahref);
    newCellDel.setAttribute("align", "center");
    
    var newHidden   = document.createElement("input");
    newHidden.type  = 'hidden';
    newHidden.name  = 'zarada[' + rand + ']';
    newHidden.id    = 'zarada[' + rand + ']';
    newHidden.value = zadrugar.value + ';' + neto.value;

<? if ($_timescale == 2) { ?>    
    var hiddHours           = document.createElement("input");
    hiddHours.type          = 'hidden';
    hiddHours.name          = 'hours[' + rand + ']';
    hiddHours.id            = 'hours[' + rand + ']';
    hiddHours.value         = contractfrom.value + ';' + contractto.value + ';' + hours.value;
    newCellNeto.appendChild(hiddHours);
    
    newCellFrom.innerHTML   = contractfrom.value;
    newCellTo.innerHTML     = contractto.value;
    newCellHours.innerHTML  = hours.value;
<? } ?>    
    
    newCellNeto.appendChild(newHidden);
    
    suma = parseFloat(edtNeto.value) + parseFloat(neto.value);
    lblNeto.innerHTML = suma.toFixed(2);
    edtNeto.value     = suma.toFixed(2);
    
    zadrugar.selectedIndex  = 0;
    neto.value              = '';
    
    return false;
  }
  
  function deleteRow(rdel) {
    
    var d = document;
    var table_browse = d.getElementById('table_browse');
    var lblNeto      = d.getElementById('lblNeto');
    var edtNeto      = d.getElementById('edtNeto');
    var suma         = 0.00;
    
    for (var i=0; i < table_browse.rows.length; i++) {
      var current_row = table_browse.rows[i];
      /* alert(rdel + " == " + current_row.id); */
      if (parseFloat(rdel) == parseFloat(current_row.id)) {
        var zarada    = d.getElementById('zarada['+current_row.id+']').value;
        var zaradaArr = zarada.split(';');
        suma = parseFloat(edtNeto.value) - parseFloat(zaradaArr[1]);
        lblNeto.innerHTML = suma.toFixed(2);
        edtNeto.value     = suma.toFixed(2);
        table_browse.deleteRow(i);
        break;
        
      }

    }
    /*var i = rdel.parentNode.parentNode.rowIndex;
    document.getElementById('table_browse').deleteRow(i);*/
  }
  
  function validateMe() {
    var d     = document;
    var neto  = d.getElementById('neto');
    
    return validateNumber(neto);
  }
</script>                
                <tr id="header">
                  <th><?=$_LANG["sr"]["MEMBER"];?> : </th>
                  <th><?=$_LANG["sr"]["NET"];?> : </th>
<? if ($_timescale == 2) { ?>                  
                  <th>Od : </th>
                  <th>Do : </th>
                  <th>Vreme : </th>
<? } ?>                  
                  <th>&nbsp;</th>
                </tr>
                <tr>
                  <td valign="top">
                    <select name="zadrugar" id="zadrugar">
                      <option value="-1"><?=$_LANG["sr"]["CHOOSE_MEMBER"];?></option>
<?php
if (isset($_POST["IDEmployer"]) && (int)$_POST["IDEmployer"] > 0)
  $query = mysql_query(sprintf("SELECT ID, name, surname FROM oszmember$_currentyear WHERE IDEmployer=%d ORDER BY surname, name",(int)$_POST["IDEmployer"])) or die(mysql_error());
else
  $query = mysql_query("SELECT ID, name, surname FROM oszmember$_currentyear ORDER BY surname, name") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
?>
                      <option value="<?=$res['ID'];?>"><?=$res['surname'];?> <?=$res['name'];?></option>                      
<? } ?>
                    </select>
                  </td>
                  <td align="right" valign="top">
                    <input type="text" value="" name="neto" id="neto" maxlength="30" style="width: 100px;" onKeyUp="javascript: validateMe();"/>
                  </td>
<? if ($_timescale == 2) { ?>                  
                  <td>
                  	<input type="text" name="contractfrom" id="contractfrom" style="width:70px;" />
	<script language="JavaScript">
	new tcal ({'formname': 'frmTableEdit', 'controlname': 'contractfrom'});
	</script>
                  </td>
                  <td>
                  	<input type="text" name="contractto" id="contractto" style="width:70px;" />
	<script language="JavaScript">
	new tcal ({'formname': 'frmTableEdit', 'controlname': 'contractto'});
	</script>
                  </td>
                  <td><input type="text" name="hours" id="hours" value="" maxlength="5" style="width:30px;" /></td>
<? } ?>                  
                  <td valign="middle">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <td valign="middle" style="border:0px none;" align="right">
                          Dodaj izabranog zadrugara :
                        </td>
                        <td valign="middle" style="border:0px none;" align="left">
                          <input type="image" src="./images/form/add_middle.jpg" name="btn_add" id="btn_add" alt="<?=$_LANG["sr"]["ADD"];?>" title="<?=$_LANG["sr"]["ADD"];?>" onClick="javascript:return addColumn();" />
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr id="suma">
                  <th align="right"><?=strtoupper($_LANG["sr"]["SUMA"]);?> : </th>
                  <td align="right">
                    <label id="lblNeto">0.00</label>
                    <input type="hidden" id="edtNeto" value="0.00" />
                  </td>
                  <td colspan="4">
                    <img src="./images/1px.gif" />
                  </td>
                </tr>
<?php
if ($selContract > 0) {
  $sql = "SELECT CI.IDMember, CI.net, CI.contractfrom, CI.contractto, CI.hours, M.name, M.surname FROM oszcontractitem$_currentyear AS CI LEFT JOIN oszmember$_currentyear AS M ON CI.IDMember=M.ID WHERE CI.IDContract=%d ORDER BY M.surname, M.name";
  $query = mysql_query(sprintf($sql,$selContract)) or die(mysql_error());
  $net = 0; 
  while ($res = mysql_fetch_array($query)) {
    $rand = rand(1, 100000);
    $net += $res["net"];
?> 
                <tr id="<?=$rand;?>">
                  <td>
                    <?=$res["surname"];?> <?=$res["name"];?> <input type="hidden" name="zarada[<?=$rand;?>]" id="zarada[<?=$rand;?>]" value="<?=$res['IDMember'];?>;<?=$res['net'];?>" /> 
                    <? if ($_timescale == 2) { ?>
                      <input type="hidden" name="hours[<?=$rand;?>]" id="hours[<?=$rand;?>]" value="<?=_db_date_to_date($res['contractfrom']);?>;<?=_db_date_to_date($res['contractto']);?>;<?=$res['hours'];?>" />
                    <? } ?>
                  </td>
                  <td align="right"><?=number_format($res["net"], 2, '.', '');?></td>
<? if ($_timescale == 2) { ?>    
                  <td align="center"><?=_db_date_to_date($res["contractfrom"]);?></td>
                  <td align="center"><?=_db_date_to_date($res["contractto"]);?></td>
                  <td align="center"><?=$res["hours"];?></td>
<? } ?>    
                  <td align="center"><a href="javascript:deleteRow(<?=$rand;?>);"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" /></a></td>
                </tr>
<?php
  }
?>
<?php
}
?>                
              </table>
              <table cellpadding="0" cellspacing="0" border="0" style="margin-top:15px;">
                <tr>
                  <th valign="middle">&nbsp; Sačuvaj podatke ugovora : &nbsp;</th>
                  <td align="left" valign="middle">
                    &nbsp; <input type="submit" class="btn" name="save" value="<?=$_LANG["sr"]["SAVE"];?>" />
                  </td>
                  <th style="padding-left:260px;"> Nakon unosa svih podataka zaključite ugovor : </th>
                  <td valign="middle">
                    &nbsp; <a href="./ugovorunos.php"><img src="./images/form/accept_middle.jpg" alt="Zaključi ugovor" title="Zaključi ugovor" /></a>
                  </td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
<?php
if ($selContract > 0) {
?>
<script language="JavaScript">
  var doc = document;
  var lblNeto1 = doc.getElementById('lblNeto');
  var edtNeto1 = doc.getElementById('edtNeto');
  var net1 = <?=$net;?>;
 
  lblNeto1.innerHTML = net1.toFixed(2);
  edtNeto1.value = net1.toFixed(2);
</script>
<?php
}
?>                
