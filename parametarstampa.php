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
* @file         parametarstampa.php
* @package       
* @subpackage   
*
* @description  View print to pdf parameters
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
                  <td align="right"><h4>Definicije štampe za obračun faktura : </h4></td>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <th>Naziv definicije</th>
                  <th>Godine starosti</th>
                  <th>Starosna granica</th>
                  <th>Pregled</th>
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
                  <td align="center"><a href="./parametarstampaunos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
                </tr>
<? } ?>                
              </table>
<!--              
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <td align="right"><h4>Definicije štampe za obračun faktura : </h4></td>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <th>Naziv definicije : </th>
                  <th>Uključena starosna granica : </th>
                  <th>Starosna granica : </th>
                  <th>Pregled</th>
                </tr>
<?
for ($i=0; $i < count($rules); $i++) {
  $res = $rules[$i];
?>
                <tr>
                  <td><?=$res["name"];?></td>
                  <td align="center"><?=$res["age"];?></td>
                  <td align="center"><?=$GLOBALS["invoicerule"][$res["agerule"]];?></td>
                  <td align="center"><a href="./parametarstampaugunos.php?id=<?=$res["ID"];?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
                </tr>
<? } ?>                
              </table>
-->              
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
