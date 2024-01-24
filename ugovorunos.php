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
* @file         ugovorunos.php
* @package       
* @subpackage   
*
* @description  Write contract
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/

include_once('./header.php');

$del = false;
if (isset($_GET["id"]) && (int)$_GET["id"] > 0 && isset($_GET["act"]) && $_GET["act"] == "del") {
  // delete invoice
  $IDContract = (int)$_GET["id"];
  mysql_query(sprintf("DELETE FROM oszcontractitem$_currentyear WHERE IDContract = %d", $IDContract)) or die(mysql_error());
  mysql_query(sprintf("DELETE FROM oszcontract$_currentyear WHERE ID = %d", $IDContract)) or die(mysql_error());
  $del = true;
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>Unos novog ugovora :</th>
                  <td>
                    <form name="newContract" method="POST" action="./zaradaunos.php">
<script language="JavaScript">
  function checkEmployer() {
    var d = document;
    var selEmployer = d.getElementById('selEmployer');
    
    if (parseInt(selEmployer.value) < 0) {
      alert('Izaberite poslodavca kao nosioca ugovora!');
      return false;
    }
    return true;
  }
</script>  
                    <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                      <tr>
                        <th>Poslodavac :</th>
                        <td>
                          <select name="selEmployer" id="selEmployer">
                            <option value="-1">Izaberite poslodavca</option>
<?php
$query = mysql_query("SELECT ID, name FROM oszemployer ORDER BY name") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  // _db_date_to_date($date)
?>
                            <option value="<?=$res["ID"];?>"><?=$res["name"];?></option>
<?
}
?>                      
                          </select>
                        </td>
                      </tr>
<? if ($_timescale == 1) { ?>                      
                      <tr>
                        <th>Angažovan od :</th>
                        <td>
                    <select name="fromday" id="fromday">
<? for ($i = 0; $i < 32; $i++) { $selected = ""; if ($i == (int)date("d")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="frommonth" id="frommonth">
<? for ($i = 0; $i < 13; $i++) { $selected = ""; if ($i == (int)date("m")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="fromyear" id="fromyear">
                      <option value="0">0</option>                 
<? for ($i = 2000; $i < date("Y")+2; $i++) { $selected = ""; if ($i == (int)date("Y")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                        </td>
                      </tr>
                      <tr>
                        <th>Do :</th>
                        <td>
                    <select name="today" id="today">
<? for ($i = 0; $i < 32; $i++) { $selected = ""; if ($i == (int)date("d")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="tomonth" id="tomonth">
<? for ($i = 0; $i < 13; $i++) { $selected = ""; if ($i == (int)date("m")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="toyear" id="toyear">
                      <option value="0">0</option>                 
<? for ($i = 2000; $i < date("Y")+2; $i++) { $selected = ""; if ($i == (int)date("Y")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                        </td>
                      </tr>
                      <tr>
                        <th>Broj sati :</th>
                        <td><input name="hours" id="hours" value="" style="width:50px;" maxlength="5" />
                        </td>
                      </tr>
<? } ?>                      
                      <tr>
                        <th>Opis posla :</th>
                        <td><!-- <input type="text" name="jobdescription" value="" style="width:300px;" /> -->
                          <textarea name="jobdescription" style="width:400px;" rows="3"></textarea>
                        </td>
                      </tr>
                      <tr>
                        <th>Na dan :</th>
                        <td>
                    <select name="onday" id="onday">
<? for ($i = 0; $i < 32; $i++) { $selected = ""; if ($i == (int)date("d")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="onmonth" id="onmonth">
<? for ($i = 0; $i < 13; $i++) { $selected = ""; if ($i == (int)date("m")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="onyear" id="onyear">
                      <option value="0">0</option>                 
<? for ($i = 2000; $i < date("Y")+2; $i++) { $selected = ""; if ($i == (int)date("Y")) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select> &nbsp; <input type="image" src="./images/form/save_middle.jpg" name="submit" alt="Unos novog" title="Unos novog" onClick="javascript:return checkEmployer();" />
                        </td>
                      </tr>
                    </table>
                    </form>
                  </td>
                </tr>
              </table>
              <form name="frmSearch" action="./ugovorunos.php" method="POST">
              <table cellpadding="2" cellspacing="2" border="0" class="table_search">
                <tr>
<?php
$query        = mysql_query("SELECT COUNT(ID) AS uk_broj FROM oszcontract$_currentyear") or die(mysql_error());
$res          = mysql_fetch_array($query);
$browsecount  = $res["uk_broj"];

$_from    = 0;
$_offs    = $GLOBALS["browse_count"];
$navigate = false;

if (isset($_GET["from"])) $_from = (int)$_GET["from"];

if ($browsecount > $GLOBALS["browse_count"]) {
  $navigate   = true;
}

$sql = "SELECT C.ID, C.contractdate, E.name, COUNT(I.ID) AS invoice, SUM(CI.net) AS neto
  FROM oszcontract$_currentyear AS C 
  LEFT JOIN oszemployer AS E ON C.IDEmployer=E.ID 
  LEFT JOIN oszinvoice$_currentyear AS I ON C.ID = I.IDContract
  LEFT JOIN oszcontractitem$_currentyear AS CI ON C.ID = CI.IDContract
  GROUP BY C.ID
  ORDER BY C.ID DESC";
    
if ($navigate)
  $sql .= " LIMIT $_from, $_offs";
$query = mysql_query($sql) or die(mysql_error());

if ($navigate) {
  if ($_from > 0) {
    $from = $_from - $GLOBALS["browse_count"];
    if ($from < 0) $from = 0;
?>                  
                  <td><a href="ugovorunos.php?from=0"><img src="./images/form/first.jpg" alt="<?=$_LANG["sr"]["FIRST"];?>" title="<?=$_LANG["sr"]["FIRST"];?>" /></a></td>
                  <td><a href="ugovorunos.php?from=<?=$from;?>"><img src="./images/form/prev.jpg" alt="<?=$_LANG["sr"]["PREV"];?>" title="<?=$_LANG["sr"]["PREV"];?>" /></a></td>
<?php
  }
  $from = $_from + $GLOBALS["browse_count"];
  if ($from > $browsecount) $from = $from - $GLOBALS["browse_count"];
  $last = $browsecount - $GLOBALS["browse_count"];
  if ($_from + $GLOBALS["browse_count"] < $browsecount) {
?>                  
                  <td><a href="ugovorunos.php?from=<?=$from;?>"><img src="./images/form/next.jpg" alt="<?=$_LANG["sr"]["NEXT"];?>" title="<?=$_LANG["sr"]["NEXT"];?>" /></a></td>
                  <td><a href="ugovorunos.php?from=<?=$last;?>"><img src="./images/form/last.jpg" alt="<?=$_LANG["sr"]["LAST"];?>" title="<?=$_LANG["sr"]["LAST"];?>" /></a></td>
<?php
  }
}
?>                  
                </tr>
              </table>  
              </form>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>Broj ugovora</th>
                  <th>Datum</th>
                  <th>Poslodavac</th>
                  <th>Neto iznos</th>
                  <th><?=$_LANG["sr"]["EDIT"];?></th>
                  <th><?=$_LANG["sr"]["DELETE"];?></th>
                </tr>
<?php
while ($res = mysql_fetch_array($query)) {
?>                
                <tr>
                  <td align="right"><?=$res["ID"];?>.</td>
                  <td><?=_db_date_to_date($res["contractdate"]);?>&nbsp;</td>
                  <td><?=$res["name"];?>&nbsp;</td>
                  <td><?=number_format($res["neto"],2,',','.');?></td>
                  <td align="center"><a href="./zaradaunos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
                  <td align="center">
<? if ($res["invoice"] == 0) { ?>                    
                    <a href="./ugovorunos.php?id=<?=$res["ID"];?>&act=del" onClick="javascript: return confirmDelete('<?=$_LANG["sr"]["CONFIRM_DELETE_COMMON"];?>');"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" /></a>
<? } else echo '&nbsp;'; ?>                    
                  </td>
                </tr>
<? } ?>                
              </table>              
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
