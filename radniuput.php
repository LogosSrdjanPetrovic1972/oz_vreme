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
* @file         radniuput.php
* @package       
* @subpackage   
*
* @description  Choose member for showing member working paper in the pdf document
*
* @history      12.06.2013. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="newMember" method="POST" action="./pdfuput.php" target="_blank">
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th width="30%">Član zadruge : </th>
                  <td width="70%">
                    <select name="selMember" id="selMember">
                      <option value="-1">Izaberite zadrugara</option>
<?php
$query = mysql_query("SELECT ID, surname, name FROM oszmember$_currentyear ORDER BY surname, name") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  // _db_date_to_date($date)
?>
                      <option value="<?=$res["ID"];?>"><?=$res["surname"];?> <?=$res["name"];?></option>
<?
}
?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th width="30%">Poslodavac : </th>
                  <td width="70%">
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
                <tr>
                  <th width="30%">Opis posla : </th>
                  <td width="70%">
                    <input name="jobdescription" id="jobdescription" size="70" maxlenght="255" />
                  </td>
                </tr>
                <tr>
                  <th width="30%">&nbsp;</th>
                  <td width="70%">
                    <input type="image" src="./images/form/save.jpg" name="submit" alt="Radni uput" title="Radni uput" onClick="javascript:return checkMember('Izaberite člana zadruge!');" />
                  </td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
