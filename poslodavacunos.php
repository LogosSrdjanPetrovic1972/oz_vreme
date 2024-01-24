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
* @file         poslodavacunos.php
* @package       
* @subpackage   
*
* @description  Edit job companies
*
* @history      12.11.2011. ; srdjanp ; Initial revision
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
$name     = "";	
$address  = ""; 	
$IDPlace  = 0; 	
$phone    = "";
$mobile   = ""; 	
$fax      = "";
$email    = "";
$url      = ""; 	
$account  = ""; 	
$pib      = ""; 	
$idnumber = "";

if (isset($_GET['id']) && (int)$_GET['id'] > 0 ) {
  $id = (int)$_GET['id'];
  if (isset($_GET['act']) && $_GET['act'] == 'del') {
    mysql_query("DELETE FROM oszemployer WHERE ID=$id") or die(mysql_error());
    header("location: poslodavac.php");
  }
}


if (isset($_POST['id'])) {
  if ((int)$_POST['id'] > 0) {
    $id = (int)$_POST['id'];
    $sql = "UPDATE oszemployer SET name='%s', address='%s', IDPlace=%d, phone='%s', mobile='%s', fax='%s', email='%s', url='%s', account='%s', pib='%s', idnumber='%s' WHERE ID=%d";
    mysql_query(sprintf($sql,
      $_POST["name"],
      $_POST["address"],
      $_POST["IDPlace"],
      $_POST["phone"],
      $_POST["mobile"],
      $_POST["fax"],
      $_POST["email"],
      $_POST["url"],
      $_POST["account"],
      $_POST["pib"],
      $_POST["idnumber"],
      $id
    )) or die(mysql_error());
  } else {
    $sql = "INSERT INTO oszemployer (name,address,IDPlace,phone,mobile,fax,email,url,account,pib,idnumber) 
      VALUES ('%s', '%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
    mysql_query(sprintf($sql,
      $_POST["name"],
      $_POST["address"],
      $_POST["IDPlace"],
      $_POST["phone"],
      $_POST["mobile"],
      $_POST["fax"],
      $_POST["email"],
      $_POST["url"],
      $_POST["account"],
      $_POST["pib"],
      $_POST["idnumber"]
    )) or die(mysql_error());
  }
  header("location: poslodavac.php");
}

include_once('./header.php');
if ($id > 0) {
  $query  = mysql_query("SELECT * FROM oszemployer WHERE id=$id") or die(mysql_error());
  $res    = mysql_fetch_array($query);
  $name     = $res["name"];	
  $address  = $res["address"]; 	
  $IDPlace  = $res["IDPlace"]; 	
  $phone    = $res["phone"];
  $mobile   = $res["mobile"]; 	
  $fax      = $res["fax"];
  $email    = $res["email"];
  $url      = $res["url"]; 	
  $account  = $res["account"]; 	
  $pib      = $res["pib"]; 	
  $idnumber = $res["idnumber"];
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<script language="JavaScript">
  function checkInput() {
    var d       = document;
    var name    = d.getElementById('name').value.trim();
    
    if (name.length == 0) {
      alert('Naziv poslodavca je obavezan podatak!');
      return false;
    }
    
    return true;
  }
</script>                      
              <form name="frmTableEdit" id="frmTableEdit" method="POST" action="./poslodavacunos.php" onSubmit="javascript:return checkInput();">
              <input type="hidden" name="id" value="<?=$id;?>" />
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit">
                <tr>
                  <th align="right"><span class="required_data">Naziv : </span></th>
                  <td><input type="text" value="<?=$name;?>" name="name" id="name" maxlength="255" style="width: 300px;" /></td>
                </tr>
                <tr>
                  <th align="right">Adresa : </th>
                  <td><input type="text" value="<?=$address;?>" name="address" id="address" maxlength="255" style="width: 300px;" /></td>
                </tr>
                <tr>
                  <th align="right">Mesto :</th>
                  <td>
                    <select name="IDPlace">
                      <option value="-1">Izaberite mesto poslodavca</option>
<?php
$query  = mysql_query("SELECT * FROM oszplace ORDER BY name") or die(mysql_error()); 
while ($res = mysql_fetch_array($query)) {
  $selected = "";
  if ($IDPlace == $res["ID"]) $selected = "selected";
?>
                      <option value="<?=$res["ID"];?>" <?=$selected;?> ><?=$res["name"];?></option>
<?php
}
?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th align="right">Telefon : </th>
                  <td><input type="text" value="<?=$phone;?>" name="phone" id="phone" maxlength="30" style="width: 100px;" /></td>
                </tr>
                <tr>
                  <th align="right">Mobilni : </th>
                  <td><input type="text" value="<?=$mobile;?>" name="mobile" id="mobile" maxlength="30" style="width: 100px;" /></td>
                </tr>
                <tr>
                  <th align="right">Telefaks : </th>
                  <td><input type="text" value="<?=$fax;?>" name="fax" id="fax" maxlength="30" style="width: 100px;" /></td>
                </tr> 
                <tr>
                  <th align="right">E-pošta : </th>
                  <td><input type="text" value="<?=$email;?>" name="email" id="email" maxlength="70" style="width: 200px;" /></td>
                </tr>
                <tr>
                  <th align="right">Web stranica : </th>
                  <td><input type="text" value="<?=$url;?>" name="url" id="url" maxlength="70" style="width: 200px;" /></td>
                </tr>
                <tr>
                  <th align="right">Žiro račun : </th>
                  <td><input type="text" value="<?=$account;?>" name="account" id="account" maxlength="70" style="width: 200px;" /></td>
                </tr>
                <tr>
                  <th align="right">PIB : </th>
                  <td><input type="text" value="<?=$pib;?>" name="pib" id="pib" maxlength="30" style="width: 100px;" /></td>
                </tr>
                <tr>
                  <th align="right">Matični broj : </th>
                  <td><input type="text" value="<?=$idnumber;?>" name="idnumber" id="idnumber" maxlength="30" style="width: 100px;" /></td>
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
