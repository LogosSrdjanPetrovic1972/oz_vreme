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
* @file         otvorigodinu.php
* @package       
* @subpackage   
*
* @description  Open new year
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$result = '';
if (isset($_POST["selYear"]) && (int)$_POST["selYear"] > $GLOBALS["def_start_year"]) {
  $drop = false;
  if (isset($_POST["drop"])) $drop = true;
  if ($db->_openYear($_POST["selYear"],$drop)) {
    $query  = mysql_query(sprintf("SELECT * FROM oszyear WHERE year='%s'",$_POST["selYear"])) or die(mysql_error());
    $res    = mysql_fetch_array($query);
    if (!isset($res["ID"])) {
      mysql_query(sprintf("INSERT INTO oszyear (year) VALUES ('%s')",$_POST["selYear"])) or die(mysql_error());
    }
    $result = 'Godina '.$_POST["selYear"].' je uspešno otvorena!';
  } else $result = 'Godina '.$_POST["selYear"].' nije uspešno otvorena!';
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="newYear" method="POST" action="./otvorigodinu.php">
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th width="60%">Otvori godinu sa automatskim kreiranjem tabela : </th>
                  <td width="40%">
                    <select name="selYear" id="selYear">
                      <option value="-1">Izaberite godinu</option>
<? for ($i = 1999; $i < (int)date("Y")+3; $i++) { $selected = ""; if ($i == (int)date("Y")) $selected = "selected"; ?>                      
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>
<? } ?>
                    </select>
                    &nbsp;
                    <input type="image" src="./images/form/save.jpg" name="submit" alt="Otvori godinu" title="Otvori godinu" />
                    <br /><br />
                    <input type="checkbox" value="1" name="drop" /> Pri otvaranju obriši predhodne tabele?
                  </td>
                </tr>
              </table>
<? if (strlen($result) > 0) { ?>
              <h3><?=$result;?></h3>
<? } ?>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
