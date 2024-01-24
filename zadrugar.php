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
* @file         zadrugar.php
* @package       
* @subpackage   
*
* @description  Main default page - member list
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$where = "";

if (isset($_POST["search"])) {
  $search = $_POST["search"];
  $where = "WHERE M.name LIKE '%$search%' OR M.surname LIKE '%$search%'";
}

$query = mysql_query("SELECT COUNT(*) FROM oszmember$_currentyear AS M $where") or die(mysql_error());
$res = mysql_fetch_row($query);
$browsecount = $res[0];

$_from    = 0;
$_offs    = $GLOBALS["browse_count"];
$navigate = false;

if (isset($_GET["from"])) $_from = (int)$_GET["from"];

if ($browsecount > $GLOBALS["browse_count"]) {
  $navigate   = true;
}
?>
                            <!-- MAIN CONTENT START -->
                            <h2><?=$GLOBALS["sectiontitle"];?></h2>
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                              <tr>
                                <td valign="middle" align="left">
                                  <table cellpadding="2" cellspacing="2" border="0" class="table_search">
                                    <form name="frmSearch" action="./zadrugar.php" method="POST">
                                    <tr>
                                      <td valign="middle">Dodaj novog zadrugara</td>
                                      <td><a href="./zadrugarunos.php"><img src="./images/form/add.jpg" alt="<?=$_LANG["sr"]["ADD"];?>" title="<?=$_LANG["sr"]["ADD"];?>" /></a></td>
                                      <td><input type="text" name="search" id="search" maxlength="255" style="width:200px;" /></td>
                                      <td><input type="image" src="./images/form/search.jpg" alt="<?=$_LANG["sr"]["SEARCH"];?>" title="<?=$_LANG["sr"]["SEARCH"];?>" /></td>
<?php
if ($navigate) {
  if ($_from > 0) {
    $from = $_from - $GLOBALS["browse_count"];
    if ($from < 0) $from = 0;
?>                  
                                      <td><a href="zadrugar.php?from=0"><img src="./images/form/first.jpg" alt="<?=$_LANG["sr"]["FIRST"];?>" title="<?=$_LANG["sr"]["FIRST"];?>" /></a></td>
                                      <td><a href="zadrugar.php?from=<?=$from;?>"><img src="./images/form/prev.jpg" alt="<?=$_LANG["sr"]["PREV"];?>" title="<?=$_LANG["sr"]["PREV"];?>" /></a></td>
<?php
  }
  $from = $_from + $GLOBALS["browse_count"];
  if ($from > $browsecount) $from = $from - $GLOBALS["browse_count"];
  $last = $browsecount - $GLOBALS["browse_count"];
  if ($_from + $GLOBALS["browse_count"] < $browsecount) {
?>                  
                                      <td><a href="zadrugar.php?from=<?=$from;?>"><img src="./images/form/next.jpg" alt="<?=$_LANG["sr"]["NEXT"];?>" title="<?=$_LANG["sr"]["NEXT"];?>" /></a></td>
                                      <td><a href="zadrugar.php?from=<?=$last;?>"><img src="./images/form/last.jpg" alt="<?=$_LANG["sr"]["LAST"];?>" title="<?=$_LANG["sr"]["LAST"];?>" /></a></td>
<?php
  }
}
?>
                                    </tr>
                                    </form>
                                  </table>
                                </td>
                                <td style="padding-right:20px;" align="right" valign="middle">
                                  <a href="./zadrugaruvoz.php"><img src="./images/import.png" alt="Uvoz osnovnih podataka zadrugara iz predhodnih godina" title="Uvoz osnovnih podataka zadrugara iz predhodnih godina" /></a>
                                </td>  
                              </tr>
                            </table>
                            <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                              <tr>
                                <th>Šifra</th>
                                <th>Prezime i ime</th>
                                <th>Adresa</th>
                                <th>Mesto</th>
                                <th><?=$_LANG["sr"]["EDIT"];?></th>
                                <th><?=$_LANG["sr"]["DELETE"];?></th>
                              </tr>
<?php
$query = mysql_query("SELECT ID, name FROM oszplace") or die(mysql_error());
$_grad = array();
while ($res = mysql_fetch_array($query)) {
  $_grad[$res["ID"]] = $res["name"];
}

if ($navigate)
  $query = mysql_query("SELECT M.ID, M.name, M.surname, M.address, M.IDAddressPlace FROM oszmember$_currentyear AS M 
      $where ORDER BY M.surname, M.name LIMIT $_from, $_offs") or die(mysql_error());
else
  $query = mysql_query("SELECT M.ID, M.name, M.surname, M.address, M.IDAddressPlace FROM oszmember$_currentyear AS M
      $where ORDER BY M.surname, M.name") or die(mysql_error());

while ($res = mysql_fetch_array($query)) {
  $grad = "";
  if ($res["IDAddressPlace"] > 0) $grad = $_grad[$res["IDAddressPlace"]];
  $poslovi = mysql_query(sprintf("SELECT COUNT(ID) as poslovi FROM oszinvoicecontractitem$_currentyear WHERE IDMember=%d",$res["ID"])) or die(mysql_error());
  $angazmn = mysql_fetch_array($poslovi);
  $poslovi = $angazmn["poslovi"];
?>                
                              <tr>
                                <td align="right"><?=$res["ID"];?>.</td>
                                <td><?=$res["surname"].' '.$res["name"];?>&nbsp;</td>
                                <td><?=$res["address"];?>&nbsp;</td>
                                <td><?=$grad;?>&nbsp;</td>
                                <td align="center"><a href="./zadrugarunos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
                                <td align="center">
<? if ($poslovi == 0) { ?>                    
                                  <a href="./zadrugarunos.php?id=<?=$res["ID"];?>&act=del" onClick="javascript: return confirmDelete('<?=$_LANG["sr"]["CONFIRM_DELETE_MEMBER"];?>');"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" /></a>
<? } else echo '&nbsp;'; ?>                    
                                </td>
                              </tr>
<? } ?>                
                            </table>
                            <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
