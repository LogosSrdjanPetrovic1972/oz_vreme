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
* @file         defprintunos.php
* @package       
* @subpackage   
*
* @description  Edit page for print definitions
*
* @history      07.06.2013. ; srdjanp ; Initial revision
*
*/
define('_EDOTPLUS_ALLOW',     1);
require_once('./include/globals.inc');
require_once('./include/debug.php');
require_once('./include/c_db.php');
require_once('./include/common.php');
require_once('./include/c_session.php');
// connect to database
$db                     = new c_Db;
$GLOBALS["connection"]  = $db->_conn;
mysql_query("SET NAMES 'utf8'");

$_session = new c_Session;

$_currentyear = $_session->_getCurrentYear();
$_timescale   = $_session->_getTimeScale();

$id       = 0;
$idprint  = 0;
$sort     = 0;	
$text     = ""; 	
$align    = "L";        // default values
$font     = "arial";
$fontsize = 9;
$style    = "";
$ln       = 1;

if (isset($_GET['idprint']) && (int)$_GET['idprint'] > 0 )
  $idprint = $_GET['idprint']; 
if (isset($_POST['idprint']) && (int)$_POST['idprint'] > 0 )
  $idprint = $_POST['idprint']; 

if (isset($_GET['id']) && (int)$_GET['id'] > 0 ) {
  $id = (int)$_GET['id'];
  if (isset($_GET['act']) && $_GET['act'] == 'del') {
    mysql_query("DELETE FROM oszprintitem WHERE ID=$id") or die(mysql_error());
    header("location: defprint.php");
  }
}

/*
  Default values : 
    align:      L
    font:       arial
    fontsize:   9
    style   :
    ln:         1
*/

if (isset($_POST['id'])) {
  if ((int)$_POST['id'] > 0) {
    $id = (int)$_POST['id'];
    $sql = "UPDATE oszprintitem SET sort=%d, text='%s', align='%s', font='%s', fontsize=%d, style='%s', ln=%d WHERE ID=%d";
    mysql_query(sprintf($sql,
      $_POST["sort"],
      $_POST["text"],
      $_POST["align"],
      $_POST["font"],
      $_POST["fontsize"],
      $_POST["style"],
      $_POST["ln"],
      $id
    )) or die(mysql_error());
  } else {
    $sql = "INSERT INTO oszprintitem (IDPrint, sort, text, align, font, fontsize, style, ln) 
      VALUES (%d, %d, '%s', '%s', '%s', %d, '%s', %d)";
    mysql_query(sprintf($sql,
      $_POST["idprint"],
      $_POST["sort"],
      $_POST["text"],
      $_POST["align"],
      $_POST["font"],
      $_POST["fontsize"],
      $_POST["style"],
      $_POST["ln"]
    )) or die(mysql_error());
  }
  header("location: defprint.php?idprint=$idprint");
}
include_once('./header.php');
if ($id > 0) {
  $query    = mysql_query("SELECT * FROM oszprintitem WHERE ID=$id") or die(mysql_error());
  $res      = mysql_fetch_array($query);
  $idprint  = $res["IDPrint"];	
  $sort     = $res["sort"]; 	
  $text     = $res["text"];
  $align    = $res["align"];	
  $font     = $res["font"]; 	
  $fontsize = $res["fontsize"];
  $style    = $res["style"];	
  $ln       = $res["ln"]; 	
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<script language="JavaScript">
  function checkInput() {
    var d       = document;
    var text    = d.getElementById('text').value;
    var sort    = d.getElementById('sort').value.trim();
    
    if (text.length == 0) {
      alert('Tekst štampe je obavezan podatak!');
      return false;
    }

    if (sort.length == 0) {
      alert('Sort je obavezan podatak!');
      return false;
    }
    
    return true;
  }
</script>                      
              <form name="frmTableEdit" id="frmTableEdit" method="POST" action="./defprintunos.php" onSubmit="javascript:return checkInput();">
              <input type="hidden" name="id" value="<?=$id;?>" />
              <input type="hidden" name="idprint" value="<?=$idprint;?>" />
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit">
                <tr>
                  <th align="right"><span class="required_data">Text : </span></th>
                  <td>
                    <textarea rows="4" style="width: 550px;" name="text" id="text" ><?=$text;?></textarea>
                  </td>
                </tr>
                <tr>
                  <th align="right" class="required_data">Sort : </th>
                  <td>
                    <input type="text" value="<?=$sort;?>" name="sort" id="sort" maxlength="5" style="width: 50px;" />
                    &nbsp;
                    <select name="sortinfo" id="sortinfo">
<? $qtemp = mysql_query("SELECT * FROM oszprintitem WHERE IDPrint=$idprint ORDER BY sort") or die(mysql_error());
while($qres = mysql_fetch_array($qtemp)) { ?>
                      <option value="<?=$qres['ID']?>" > <?=$qres['sort'];?> : <? echo substr($qres['text'], 0, 50);?> </option>
<? } ?>                    
                    </select>
                  </td>
                </tr>
                <tr>
                  <th align="right">Align : </th>
                  <td>
                    <select name="align" id="align">
<? foreach($GLOBALS["aligns"] as $key=>$value) { ?>
                      <option value="<?=$key?>" <? if ($key == $align) echo 'selected'; ?> ><?=$value?></option>                      
<? } ?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th align="right">Font : </th>
                  <td>
                    <select name="font" id="font">
                      <option value="arial" <? if ("arial" == $font) echo 'selected'; ?>>arial</option>
                      <option value="arialb" <? if ("arialb" == $font) echo 'selected'; ?>>arialb</option>
                      <option value="ariali" <? if ("ariali" == $font) echo 'selected'; ?>>ariali</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th align="right">Font size : </th>
                  <td>
                    <select name="fontsize" id="fontsize">
<? for ($i = 8; $i < 30; $i++) {?>
                      <option value="<?=$i?>" <? if ($i == $fontsize) echo 'selected'; ?> ><?=$i?></option>                      
<? }?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th align="right">Style : </th>
                  <td>
                    <select name="style" id="style">
<? foreach($GLOBALS["styles"] as $key=>$value) {?>
                      <option value="<?=$key?>" <? if ($key == $style)  echo 'selected'; ?> ><?=$value?></option>                      
<? }?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th align="right">Line : </th>
                  <td><input type="text" value="<?=$ln;?>" name="ln" id="ln" maxlength="5" style="width: 100px;" /></td>
                </tr>
                <tr>
                  <td class="required_data">Unos podataka je obavezan!</td>
                  <td style="padding:5px 5px 5px 0px;" align="right"><input type="submit" class="btn" name="submit" value="Sačuvaj" /> &nbsp; <input type="button" class="btn" name="reset" value="Nazad" onClick="javascript: history.go(-1);" /></td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
