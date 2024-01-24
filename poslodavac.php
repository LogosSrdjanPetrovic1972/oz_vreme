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
* @file         poslodavac.php
* @package       
* @subpackage   
*
* @description  List of job companies
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$where = "";

if (isset($_POST["search"])) {
  $search = $_POST["search"];
  $where = "WHERE name LIKE '%$search%' OR address LIKE '%$search%'";
}

$query = mysql_query("SELECT COUNT(*) FROM oszemployer $where") or die(mysql_error());
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
                      <form name="frmSearch" action="./poslodavac.php" method="POST">
                      <tr>
                        <td valign="middle">Dodaj novog poslodavca</td>
                        <td><a href="./poslodavacunos.php"><img src="./images/form/add.jpg" alt="<?=$_LANG["sr"]["ADD"];?>" title="<?=$_LANG["sr"]["ADD"];?>" /></a></td>
                        <td><input type="text" name="search" id="search" maxlength="255" style="width:200px;" /></td>
                        <td><input type="image" src="./images/form/search.jpg" alt="<?=$_LANG["sr"]["SEARCH"];?>" title="<?=$_LANG["sr"]["SEARCH"];?>" /></td>
<?php
if ($navigate) {
  if ($_from > 0) {
    $from = $_from - $GLOBALS["browse_count"];
    if ($from < 0) $from = 0;
?>                  
                        <td><a href="poslodavac.php?from=0"><img src="./images/form/first.jpg" alt="<?=$_LANG["sr"]["FIRST"];?>" title="<?=$_LANG["sr"]["FIRST"];?>" /></a></td>
                        <td><a href="poslodavac.php?from=<?=$from;?>"><img src="./images/form/prev.jpg" alt="<?=$_LANG["sr"]["PREV"];?>" title="<?=$_LANG["sr"]["PREV"];?>" /></a></td>
<?php
  }
  $from = $_from + $GLOBALS["browse_count"];
  if ($from > $browsecount) $from = $from - $GLOBALS["browse_count"];
  $last = $browsecount - $GLOBALS["browse_count"];
  if ($_from + $GLOBALS["browse_count"] < $browsecount) {
?>                  
                        <td><a href="poslodavac.php?from=<?=$from;?>"><img src="./images/form/next.jpg" alt="<?=$_LANG["sr"]["NEXT"];?>" title="<?=$_LANG["sr"]["NEXT"];?>" /></a></td>
                        <td><a href="poslodavac.php?from=<?=$last;?>"><img src="./images/form/last.jpg" alt="<?=$_LANG["sr"]["LAST"];?>" title="<?=$_LANG["sr"]["LAST"];?>" /></a></td>
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
                  <th>Naziv poslodavca</th>
                  <th>Adresa</th>
                  <th>Sedište</th>
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
  $query = mysql_query("SELECT ID, name, address, IDPlace FROM oszemployer $where ORDER BY name LIMIT $_from, $_offs") or die(mysql_error());
else
  $query = mysql_query("SELECT ID, name, address, IDPlace FROM oszemployer $where ORDER BY name") or die(mysql_error());

while ($res = mysql_fetch_array($query)) {
  $grad = "";
  if ($res["IDPlace"] > 0) $grad = $_grad[$res["IDPlace"]];
  $suma = mysql_query(sprintf("SELECT COUNT(ID) as ugovori FROM oszcontract$_currentyear WHERE IDEmployer = %d", $res["ID"])) or die(mysql_error());
  $suma = mysql_fetch_array($suma);
  $suma = $suma["ugovori"];
?>                
                <tr>
                  <td><?=$res["name"];?>&nbsp;</td>
                  <td><?=$res["address"];?>&nbsp;</td>
                  <td><?=$grad;?>&nbsp;</td>
                  <td align="center"><a href="./poslodavacunos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
                  <td align="center">
<? if ($suma == 0) { ?>
                    <a href="./poslodavacunos.php?id=<?=$res["ID"];?>&act=del" onClick="javascript: return confirmDelete('<?=$_LANG["sr"]["CONFIRM_DELETE_COMPANY_JOB"];?>');"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" /></a>
<? } else echo '&nbsp;'; ?>
                  </td>
                </tr>
<? } ?>                
              </table>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
