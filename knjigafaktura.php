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
* @file         knjigafaktura.php
* @package       
* @subpackage   
*
* @description  Choose invoice for view or print
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="newInvoice" method="POST" action="./pregledfaktura.php">
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th width="30%">Pregled i štampa faktura : </th>
                  <td width="70%">
                    <select name="selInvoice" id="selInvoice">
                      <option value="-1">Izaberite fakturu</option>
<?php
$query = mysql_query("SELECT I.*, C.contractdate, E.name FROM oszinvoice$_currentyear AS I 
  LEFT JOIN oszcontract$_currentyear AS C ON I.IDContract = C.ID
  LEFT JOIN oszemployer AS E ON C.IDEmployer=E.ID WHERE C.IDEmployer > 0 ORDER BY I.ID DESC") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  // _db_date_to_date($date)
?>
                      <option value="<?=$res["ID"];?>">Faktura : <?=$res["ID"];?>, Ugovor : <?=$res["IDContract"];?>, <?=_db_date_to_date($res["date"]);?>, <?=$res["name"];?> </option>
<?
}
?>                      
                    </select>
                    &nbsp;
                    <input type="image" src="./images/form/save.jpg" name="submit" alt="Pregled i štampa" title="Pregled i štampa" onClick="javascript:return checkInvoice('Izaberite fakturu za pregled');" />
                  </td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
