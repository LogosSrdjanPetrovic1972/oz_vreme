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
* @file         mesto.php
* @package       
* @subpackage   
*
* @description  View places table
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
$where = "";

if (isset($_POST["search"])) {
  $search = $_POST["search"];
  $where = "WHERE name LIKE '%$search%'";
}

$query = mysql_query("SELECT COUNT(*) FROM oszplace $where") or die(mysql_error());
$res = mysql_fetch_row($query);
$browsecount = $res[0];

$_from    = 0;
$_offs    = $GLOBALS["browse_count"];
$navigate = false;

if (isset($_GET["from"])) $_from = (int)$_GET["from"];

if ($browsecount > $GLOBALS["browse_count"]) {
  $navigate   = true;
}

//  $GLOBALS["browse_count"]
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td valign="middle" align="left">
                    <table cellpadding="2" cellspacing="2" border="0" class="table_search">
                      <form name="frmSearch" action="./mesto.php" method="POST">
                      <tr>
                        <td valign="middle">Dodaj novo mesto</td>
                        <td><a href="./mestounos.php"><img src="./images/form/add.jpg" alt="<?=$_LANG["sr"]["ADD"];?>" title="<?=$_LANG["sr"]["ADD"];?>" /></a></td>
                        <td><input type="text" name="search" id="search" maxlength="255" style="width:200px;" /></td>
                        <td><input type="image" src="./images/form/search.jpg" alt="<?=$_LANG["sr"]["SEARCH"];?>" title="<?=$_LANG["sr"]["SEARCH"];?>" /></td>
<?php
if ($navigate) {
  if ($_from > 0) {
    $from = $_from - $GLOBALS["browse_count"];
    if ($from < 0) $from = 0;
?>                  
                        <td><a href="mesto.php?from=0"><img src="./images/form/first.jpg" alt="<?=$_LANG["sr"]["FIRST"];?>" title="<?=$_LANG["sr"]["FIRST"];?>" /></a></td>
                        <td><a href="mesto.php?from=<?=$from;?>"><img src="./images/form/prev.jpg" alt="<?=$_LANG["sr"]["PREV"];?>" title="<?=$_LANG["sr"]["PREV"];?>" /></a></td>
<?php
  }
  $from = $_from + $GLOBALS["browse_count"];
  if ($from > $browsecount) $from = $from - $GLOBALS["browse_count"];
  $last = $browsecount - $GLOBALS["browse_count"];
  if ($_from + $GLOBALS["browse_count"] < $browsecount) {
?>                  
                        <td><a href="mesto.php?from=<?=$from;?>"><img src="./images/form/next.jpg" alt="<?=$_LANG["sr"]["NEXT"];?>" title="<?=$_LANG["sr"]["NEXT"];?>" /></a></td>
                        <td><a href="mesto.php?from=<?=$last;?>"><img src="./images/form/last.jpg" alt="<?=$_LANG["sr"]["LAST"];?>" title="<?=$_LANG["sr"]["LAST"];?>" /></a></td>
<?php
  }
}
?>
                      </tr>
                      </form>
                    </table>
                  </td>
                </tr>
              </table>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <th>Naziv mesta</th>
                  <th>Pošta</th>
                  <th>Pozivni broj</th>
                  <th><?=$_LANG["sr"]["EDIT"];?></th>
                  <th><?=$_LANG["sr"]["DELETE"];?></th>
                </tr>
<?php
if ($navigate)
  $query = mysql_query("SELECT ID, name, post, phone FROM oszplace $where ORDER BY name LIMIT $_from, $_offs") or die(mysql_error());
else
  $query = mysql_query("SELECT ID, name, post, phone FROM oszplace $where ORDER BY name") or die(mysql_error());

while ($res = mysql_fetch_array($query)) {
  $suma = mysql_query(sprintf("SELECT COUNT(ID) as clanovi FROM oszmember$_currentyear WHERE IDAddressPlace = %d", $res["ID"])) or die(mysql_error());
  $suma = mysql_fetch_array($suma);
  $suma = $suma["clanovi"];
  if ($suma == 0) {
    $suma = mysql_query(sprintf("SELECT COUNT(ID) as poslodavci FROM oszemployer WHERE IDPlace = %d", $res["ID"])) or die(mysql_error());
    $suma = mysql_fetch_array($suma);
    $suma = $suma["poslodavci"];
  }
  if ($suma == 0) {
    $suma = mysql_query(sprintf("SELECT COUNT(ID) as oz FROM oszcooperative WHERE IDPlace = %d", $res["ID"])) or die(mysql_error());
    $suma = mysql_fetch_array($suma);
    $suma = $suma["oz"];
  }
?>                
                <tr>
                  <td><?=$res["name"];?>&nbsp;</td>
                  <td><?=$res["post"];?>&nbsp;</td>
                  <td><?=$res["phone"];?>&nbsp;</td>
                  <td align="center"><a href="./mestounos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
                  <td align="center">
<? if ($suma == 0) { ?>
                    <a href="./mestounos.php?id=<?=$res["ID"];?>&act=del" onClick="javascript: return confirmDelete('<?=$_LANG["sr"]["CONFIRM_DELETE_PLACE"];?>');"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" /></a>
<? } else echo '&nbsp;'; ?>
                  </td>
                </tr>
<? } ?>                
              </table>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
