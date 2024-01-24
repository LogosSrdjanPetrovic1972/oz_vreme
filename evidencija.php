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
* @file         evidencija.php
* @package       
* @subpackage   
*
* @description  Definisanje evidencije
*
* @history      30.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$contracthours  = 0;
$memberhours    = 0;
if (isset($_POST["contracthours"]) || isset($_POST["memberhours"]) || isset($_POST["save"])) {
  if (isset($_POST["contracthours"]))
    $contracthours  = 1;
  if (isset($_POST["memberhours"]))
    $memberhours  = 1;
  if ($contracthours == 1)
    $_session->_setTimeScale(1);
  elseif ($memberhours == 1)
    $_session->_setTimeScale(2);
  else
    $_session->_setTimeScale(0);
    
  mysql_query(sprintf("UPDATE oszcooperative SET contracthours=%d, memberhours=%d WHERE ID=1",$contracthours,$memberhours)) or die(mysql_error());
}

$query = mysql_query("SELECT contracthours, memberhours FROM oszcooperative WHERE ID=1") or die(mysql_error());
$coop  = mysql_fetch_array($query);
$contracthours  = $coop["contracthours"];
$memberhours    = $coop["memberhours"];
?>
<script language="JavaScript">
  function checkCase(me) {
    /* Check if we have at the same time both choosed */
    var d             = document;
    var contracthours = d.getElementById('contracthours');
    var memberhours   = d.getElementById('memberhours');
    
    if (contracthours.checked && memberhours.checked) {
      alert('Nije dozvoljeno obe evidencije upotrebiti istovremeno!');
      if (me == 1)
        memberhours.checked = false;
      else
        contracthours.checked = false;
    }
    
    return true;
  }
</script>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="formnm" method="POST" action="./evidencija.php">
              <table class="table_browse" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <th width="60%">Grupna evidencija vremena rada u okviru ugovora ?</th>
                  <td width="40%"><input type="checkbox" name="contracthours" id="contracthours" value="1" onClick="javascript:checkCase(1);" <? if ($contracthours) echo 'checked="checked"';?> /></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <th>Pojedinačna evidencija vremena rada za svakog zadrugara ?</th>
                  <td><input type="checkbox" name="memberhours" id="memberhours" value="1" onClick="javascript:checkCase(2);" <? if ($memberhours) echo 'checked="checked"';?> /></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input type="submit" class="btn" name="save" value="<?=$_LANG["sr"]["SAVE"];?>" /></td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
