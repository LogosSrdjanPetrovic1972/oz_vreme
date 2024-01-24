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
* @file         tekucagodina.php
* @package       
* @subpackage   
*
* @description  Edit current year
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$result = '';
if (isset($_POST["selYear"]) && (int)$_POST["selYear"] > $GLOBALS["def_start_year"]) {
  if ($db->_openYear($_POST["selYear"])) {
    $query  = mysql_query(sprintf("SELECT * FROM oszyear WHERE year='%s'",$_POST["selYear"])) or die(mysql_error());
    $res    = mysql_fetch_array($query);
    if (!isset($res["ID"])) {
      mysql_query(sprintf("INSERT INTO oszyear (year) VALUES ('%s')",$_POST["selYear"])) or die(mysql_error());
    }
    $result = 'Godina '.$_POST["selYear"].' je uspešno izabrana!';
    $_currentyear = $_POST["selYear"];
    $_session->_setCurrentYear($_currentyear);
    mysql_query(sprintf("UPDATE oszcooperative SET currentyear  = '%s' WHERE ID=1",$_POST["selYear"])) or die(mysql_error());
  } else $result = 'Godina '.$_POST["selYear"].' nije uspešno izabrana!';
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="chooseYear" method="POST" action="./tekucagodina.php">
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th><h2>TEKUĆA GODINA </h2></th>
                  <th><div align="center"><?=_year_to_image($_currentyear);?></div></th>
                </tr>
                <tr><td colspan="2" style="height: 20px">&nbsp;</td></tr>
                <tr>
                  <td align="right">Do sada su otvorene sledeće godine : </td>
                  <td><strong>
<? 
$query  = mysql_query("SELECT * FROM oszyear ORDER BY Year") or die(mysql_error());
$opened = '';
while ($res = mysql_fetch_array($query)) {
  if ($opened == '')
    $opened = $res['year'];
  else
    $opened .= ', '.$res['year'];
}
if ($opened == '') $opened = 'Nema otvorenih godina!';
echo $opened;
?>
                    </strong>                    
                  </td>
                </tr>
                <tr><td colspan="2" style="height: 30px">&nbsp;</td></tr>
                <tr>
                  <td align="right" width="60%">Izaberi tekuću godinu, ako ne postoje kreiraj tabele automatski : </td>
                  <td width="40%">
                    <select name="selYear" id="selYear">
                      <option value="-1">Izaberite godinu</option>
<? for ($i = 1999; $i < (int)date("Y")+3; $i++) { $selected = ""; if ($i == (int)date("Y")+1) $selected = "selected"; ?>                      
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>
<? } ?>
                    </select>
                    &nbsp;
                    <input type="image" src="./images/form/save.jpg" name="submit" alt="Izaberi tekuću godinu" title="Izaberi tekuću godinu" />
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
