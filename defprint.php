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
* @file         defprint.php
* @package       
* @subpackage   
*
* @description  Define contract text which will be printed on the pdf.
*
* @history      06.06.2013. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
if (!$GLOBALS["admin"]) die('You do not have permission for this page!');
$IDPrint = 0;
if (isset($_GET["idprint"])) $IDPrint = $_GET["idprint"]; 
if (isset($_POST["idprint"])) $IDPrint = $_POST["idprint"]; 
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <div>
<?
$query = mysql_query("SELECT * FROM oszprint ORDER BY IDPrint") or die(mysql_error());
$started = false;
$sub_title = '';
$page = '';
$preview = '';
while ($res = mysql_fetch_array($query)) {
  if ($IDPrint == 0) $IDPrint = $res["IDPrint"];
  if ($started) echo ' &nbsp; | &nbsp; ';
  if ($IDPrint == $res["IDPrint"]) {
    $sub_title=$res["name"];
    $page=$res["page"];
    $preview=$res["preview"];
?>
  <a href=".<?=$_SERVER['PHP_SELF']?>?idprint=<?=$res["IDPrint"]?>" class="main_menu_selected"><?=$res["name"]?></a>
<?  
  } else {
?>
  <a href=".<?=$_SERVER['PHP_SELF']?>?idprint=<?=$res["IDPrint"]?>"><?=$res["name"]?></a>
<?
  }
  $started = true;
}
?>              
              </div>
              <hr/>
              <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                <tr>
                  <td align="right"><h4><?=$sub_title;?> - definicije štampe&nbsp;</h4></td>
                  <td colspan="4">&nbsp; 
                    <a href="./defprintunos.php?idprint=<?=$IDPrint;?>"><img src="./images/form/add.jpg" alt="<?=$_LANG["sr"]["ADD"];?>" title="<?=$_LANG["sr"]["ADD"];?>" /></a>
                    &nbsp; Dodaj novu definiciju 
                  </td>
                  <td colspan="4">&nbsp; 
                    <a href="./<?=$page?>?<?=$preview;?>=1" target="_blank"><img src="./images/form/pdf.jpg" alt="<?=$_LANG["sr"]["PDF_PREVIEW"];?>" title="<?=$_LANG["sr"]["PDF_PREVIEW"];?>" /></a>
                    &nbsp; <?=$_LANG["sr"]["PDF_PREVIEW"];?> 
                  </td>
                </tr>
                <tr>
                  <th>Tekst za štampu</th>
                  <th>Sort</th>
                  <th>Align</th>
                  <th>Font</th>
                  <th>Size</th>
                  <th>Style</th>
                  <th>Line</th>
                  <th>Izmeni?</th>
                  <th>Briši?</th>
                </tr>
<?
// text, align, font, fontsize, style, ln
$query = mysql_query(sprintf("SELECT * FROM oszprintitem where IDPrint = %d ORDER BY sort",$IDPrint)) or die(mysql_error());  
while ($res = mysql_fetch_array($query)) {
?>
                <tr>
                  <td align="<?if ($res["align"] == 'L') echo 'left'; if ($res["align"] == 'C') echo 'center'; if ($res["align"] == 'R') echo 'right';?>">
                    <? if ($res["style"] == 'B') echo '<b>'; if ($res["style"] == 'I') echo '<i>';?><?=$res["text"];?><? if ($res["style"] == 'B') echo '</b>'; if ($res["style"] == 'I') echo '</i>';?>
                    </td>
                  <td align="center"><?=$res["sort"];?></td>
                  <td align="center"><?=$GLOBALS["aligns"][$res["align"]];?></td>
                  <td align="center"><?=$res["font"];?></td>
                  <td align="center"><?=$res["fontsize"];?></td>
                  <td align="center"><?=$GLOBALS["styles"][$res["style"]];?></td>
                  <td align="center"><?=$res["ln"];?></td>
                  <td align="center"><a href="./defprintunos.php?id=<?=$res["ID"];?>&idprint=<?=$IDPrint;?>"><img src="./images/form/edit.jpg" alt="<?=$_LANG["sr"]["EDIT"];?>" title="<?=$_LANG["sr"]["EDIT"];?>" /></a></td>
                  <td align="center"><a href="./defprintunos.php?id=<?=$res["ID"];?>&act=del&idprint=<?=$IDPrint;?>"><img src="./images/form/del.jpg" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" onClick="javascript:return confirmDelete();" /></a> &nbsp;</td>                  
                </tr>
<?
}
?>
              </table>              
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
