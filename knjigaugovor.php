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
* @file         knjigaugovor.php
* @package       
* @subpackage   
*
* @description  Choose pregled i štampu ugovora
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="newContract" method="POST" action="./pregledugovor.php">
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th width="30%">Pregled i štampa ugovora : </th>
                  <td width="70%">
                    <select name="selContract" id="selContract">
                      <option value="-1">Izaberite ugovor</option>
<?php
$query = mysql_query("SELECT C.ID, C.contractnumber, C.contractdate, E.name FROM oszcontract$_currentyear AS C LEFT JOIN oszemployer AS E ON C.IDEmployer=E.ID WHERE C.IDEmployer > 0 ORDER BY C.ID DESC") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  // _db_date_to_date($date)
?>
                      <option value="<?=$res["ID"];?>"><?=$res["ID"];?>. &nbsp;&nbsp; <?=_db_date_to_date($res["contractdate"]);?> &nbsp;&nbsp; <?=$res["name"];?></option>
<?
}
?>                      
                    </select>
                    &nbsp;
                    <input type="image" src="./images/form/save.jpg" name="submit" alt="Pregled i štampa" title="Pregled i štampa" onClick="javascript:return checkContract('Izaberite ugovor!');" />
                  </td>
                </tr>
              </table>
              </form>
              <form name="newObContract" method="POST" action="./pregledobugovor.php">
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th width="40%">Pregled i štampa obračunatih ugovora : </th>
                  <td width="60%">
                    <select name="selContract1" id="selContract1">
                      <option value="-1">Izaberite ugovor</option>
<?php
$query = mysql_query("SELECT C.ID, C.contractnumber, C.contractdate, E.name FROM oszcontract$_currentyear AS C LEFT JOIN oszemployer AS E ON C.IDEmployer=E.ID WHERE C.IDEmployer = 1 ORDER BY C.ID DESC") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  // _db_date_to_date($date)
?>
                      <option value="<?=$res["ID"];?>"><?=$res["ID"];?>. &nbsp;&nbsp; <?=_db_date_to_date($res["contractdate"]);?> &nbsp;&nbsp; <?=$res["name"];?></option>
<?
}
?>                      
                    </select>
                    &nbsp;
                    <input type="image" src="./images/form/save.jpg" name="submit" alt="Pregled i štampa" title="Pregled i štampa" onClick="javascript:return checkContract1('Izaberite ugovor!');" />
                  </td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
