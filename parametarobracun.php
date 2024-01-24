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
* @file         parametarobracun.php
* @package       
* @subpackage   
*
* @description  View calculation parameters
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <td align="right"><h4>Definicije obračuna faktura</h4></td>
                  <td colspan="4">&nbsp; 
<? if ($GLOBALS["admin"]) { ?>                  
                    <a href="./parametarunos.php"><img src="./images/form/add.jpg" alt="<?=$_LANG["sr"]["ADD"];?>" title="<?=$_LANG["sr"]["ADD"];?>" /></a>
                    &nbsp; Dodaj novu definiciju
<? } ?>                  
                  </td>
                </tr>
                <tr>
                  <th>Naziv definicije:</th>
                  <th>Uključena star. granica:</th>
                  <th>Starosna granica:</th>
<? if ($GLOBALS["admin"]) { ?>                  
                  <th><?=$_LANG["sr"]["EDIT"];?>?</th>
<? } else { ?>                  
                  <th><?=$_LANG["sr"]["VIEW"];?></th>
<? } ?>                  
<? if ($GLOBALS["admin"]) { ?>                  
                  <th><?=$_LANG["sr"]["DELETE"];?>?</th>
<? } ?>                  
                </tr>
<?
$query = mysql_query("SELECT * FROM oszinvoicerule") or die(mysql_error());
while ($res = mysql_fetch_array($query)) {
  $rules[] = array(
    "ID"      => $res["ID"],
    "name"    => $res["name"],
    "age"     => $res["age"],
    "agerule" => $res["agerule"]
  );
}

for ($i=0; $i < count($rules); $i++) {
  $res = $rules[$i];
?>
                <tr>
                  <td><?=$res["name"];?></td>
                  <td align="center"><?=$res["age"];?></td>
                  <td align="center"><?=$GLOBALS["invoicerule"][$res["agerule"]];?></td>
<? if ($GLOBALS["admin"]) { ?>                  
                  <td align="center"><a href="./parametarunos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
<? } else { ?>                  
                  <td align="center"><a href="./parametarpregled.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["VIEW"];?>" title="<?=$_LANG["sr"]["VIEW"];?>" /></a></td>
<? } ?>                  
<? if ($GLOBALS["admin"]) { ?>                  
                  <td align="center"> <a href="./parametarunos.php?id=<?=$res["ID"];?>&add=del"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" onClick="javascript:return confirmDelete('Da li ste sigurni da želite brisati definiciju?');" /></a> &nbsp;</td>
<? } ?>                  
                </tr>
<? } ?>                
              </table>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <td align="right"><h4>Definicije obračuna ugovora</h4></td>
                  <td colspan="4">&nbsp; 
<? if ($GLOBALS["admin"]) { ?>                  
                    <a href="./parametarunos.php"><img src="./images/form/add.jpg" alt="<?=$_LANG["sr"]["ADD"];?>" title="<?=$_LANG["sr"]["ADD"];?>" /></a>
                    &nbsp; Dodaj novu definiciju
<? } ?>                  
                  </td>
                </tr>
                <tr>
                  <th>Naziv definicije:</th>
                  <th>Uključena star. granica:</th>
                  <th>Starosna granica:</th>
<? if ($GLOBALS["admin"]) { ?>                  
                  <th>Izmeni?</th>
<? } else { ?>                  
                  <th>Pregled </th>
<? } ?>                  
<? if ($GLOBALS["admin"]) { ?>                  
                  <th>Briši?</th>
<? } ?>                  
                </tr>
<?
for ($i=0; $i < count($rules); $i++) {
  $res = $rules[$i];
?>
                <tr>
                  <td><?=$res["name"];?></td>
                  <td align="center"><?=$res["age"];?></td>
                  <td align="center"><?=$GLOBALS["invoicerule"][$res["agerule"]];?></td>
<? if ($GLOBALS["admin"]) { ?>                  
                  <td align="center"><a href="./parametarugunos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
<? } else { ?>                  
                  <td align="center"><a href="./parametarugpregled.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
<? } ?>                  
<? if ($GLOBALS["admin"]) { ?>                  
                  <td align="center"><a href="./parametarugunos.php?id=<?=$res["ID"];?>&add=del"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" onClick="javascript:return confirmDelete();" /></a> &nbsp;</td>
<? } ?>                  
                </tr>
<? } ?>                
              </table>
             
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
