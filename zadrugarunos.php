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
* @description  Member edit page
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


$id             = 0;
$surname        = "";
$name           = "";
$parent         = "";
$jmbr           = "";
$idnumber       = "";
$mup            = "";
$birthday       = 0;
$birthmonth     = 0;
$birthyear      = 0;
$birthplace     = "";
$address        = "";
$IDAddressPlace = 0;
$occupation     = "";
$specialkno     = "";
$healthinsur    = 0;
$memberother    = 0;
$IDMemberBasis  = 0;
$phone          = "";
$mobile         = "";
$email          = "";
$IDEmployer     = 0;


// $_GET["id"] = 1;

if (isset($_GET["id"]) && (int)$_GET["id"] > 0 && isset($_GET["act"]) && $_GET["act"] == "del" ) {
  mysql_query(sprintf("DELETE FROM oszmember$_currentyear WHERE ID=%d", (int)$_GET["id"])) or die(mysql_error());
  header("location: zadrugar.php");
}

if (isset($_POST["id"])) {
  if ($_POST["id"] == 0) {    // add new
    $sql = "INSERT INTO oszmember$_currentyear (surname,name,parent,jmbr,idnumber,mup,birthday,birthplace,address,IDAddressPlace,occupation,specialkno,healthinsur,memberother,IDMemberBasis,phone,mobile,email,IDEmployer,memberdate) 
            VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s',%d,'%s','%s',%d,%d,%d,'%s','%s','%s',%d,now())";
    // _input_to_db_date($day,$month,$year);
    mysql_query(sprintf($sql,
      $_POST["surname"],
      $_POST["name"],
      $_POST["parent"],
      $_POST["jmbr"],
      $_POST["idnumber"],
      $_POST["mup"],
      _input_to_db_date($_POST["birthday"],$_POST["birthmonth"],$_POST["birthyear"]),
      $_POST["birthplace"],
      $_POST["address"],
      ((int) $_POST["IDAddressPlace"] > 0) ? (int) $_POST["IDAddressPlace"] : 0,
      $_POST["occupation"],
      $_POST["specialkno"],
      (int)$_POST["healthinsur"],
      (int)$_POST["memberother"],
      ((int) $_POST["IDMemberBasis"] > 0) ? (int) $_POST["IDMemberBasis"] : 0,
      $_POST["phone"],
      $_POST["mobile"],
      $_POST["email"],
      ((int) $_POST["IDEmployer"] > 0) ? (int) $_POST["IDEmployer"] : 0
    ), $db->_conn) or die(mysql_error());
    $id = mysql_insert_id();
    $_GET["id"] = $id;
    if (isset($_POST["docnumbers"]) && is_array($_POST["docnumbers"])) {
      for ($i=0; $i < count($_POST["docnumbers"]); $i++) {
        $sql = "INSERT INTO oszdocument$_currentyear (IDMember,document,publisher) VALUES (%d, '%s', '%s')";
        mysql_query(sprintf($sql, $id, $_POST["docnumbers"][$i], $_POST["docoffices"][$i]), $db->_conn) or die(mysql_error());
      }
    }
  } else {                    // save changes
    $id = (int)$_POST["id"];
    $_GET["id"] = $id;
    $sql = "UPDATE oszmember$_currentyear SET surname='%s',name='%s',parent='%s',jmbr='%s',idnumber='%s',mup='%s',birthday='%s',birthplace='%s',
            address='%s',IDAddressPlace=%d,occupation='%s',specialkno='%s',healthinsur=%d,memberother=%d,IDMemberBasis=%d,phone='%s',
            mobile='%s',email='%s',IDEmployer=%d WHERE ID=%d";
    mysql_query(sprintf($sql,
      $_POST["surname"],
      $_POST["name"],
      $_POST["parent"],
      $_POST["jmbr"],
      $_POST["idnumber"],
      $_POST["mup"],
      _input_to_db_date($_POST["birthday"],$_POST["birthmonth"],$_POST["birthyear"]),
      $_POST["birthplace"],
      $_POST["address"],
      ((int) $_POST["IDAddressPlace"] > 0) ? (int) $_POST["IDAddressPlace"] : 0,
      $_POST["occupation"],
      $_POST["specialkno"],
      (int)$_POST["healthinsur"],
      (int)$_POST["memberother"],
      ((int) $_POST["IDMemberBasis"] > 0) ? (int) $_POST["IDMemberBasis"] : 0,
      $_POST["phone"],
      $_POST["mobile"],
      $_POST["email"],
      ((int) $_POST["IDEmployer"] > 0) ? (int) $_POST["IDEmployer"] : 0,
      $id
    ), $db->_conn) or die(mysql_error());
    mysql_query(sprintf("DELETE FROM oszdocument$_currentyear WHERE IDMember=%d", $id), $db->_conn) or die(mysql_error());
    if (isset($_POST["docnumbers"]) && is_array($_POST["docnumbers"])) {
      for ($i=0; $i < count($_POST["docnumbers"]); $i++) {
        $sql = "INSERT INTO oszdocument$_currentyear (IDMember,document,publisher) VALUES (%d, '%s', '%s')";
        mysql_query(sprintf($sql, $id, $_POST["docnumbers"][$i], $_POST["docoffices"][$i]), $db->_conn) or die(mysql_error());
      }
    }
  }
  header("location: zadrugar.php");
}

include_once('./header.php');

if (isset($_GET["id"]) && (int)$_GET["id"] > 0 ) {
  $id = (int)$_GET["id"];
  $query = mysql_query(sprintf("SELECT * FROM oszmember$_currentyear WHERE ID = %d",$id)) or die(mysql_error());
  $res   = mysql_fetch_array($query);
  if (isset($res['ID'])) {
    $surname        = $res['surname'];
    $name           = $res['name'];
    $parent         = $res['parent'];
    $jmbr           = $res['jmbr'];
    $idnumber       = $res['idnumber'];
    $mup            = $res['mup'];
    $birthday       = _db_date_to_day($res['birthday']);
    $birthmonth     = _db_date_to_month($res['birthday']);
    $birthyear      = _db_date_to_year($res['birthday']);
    $birthplace     = $res['birthplace'];
    $address        = $res['address'];
    $IDAddressPlace = $res['IDAddressPlace'];
    $occupation     = $res['occupation'];
    $specialkno     = $res['specialkno'];
    $healthinsur    = $res['healthinsur'];
    $memberother    = $res['memberother'];
    $IDMemberBasis  = $res['IDMemberBasis'];
    $phone          = $res['phone'];
    $mobile         = $res['mobile'];
    $email          = $res['email'];
    $IDEmployer     = $res['IDEmployer'];
  }
}


$_GRAD = array();

$query = mysql_query("SELECT ID, name FROM oszplace ORDER BY name") or die(mysql_error());
while($res = mysql_fetch_array($query)) {
  $_GRAD[] = array(
    "ID"    => $res["ID"],
    "name"  => $res["name"]
  );
}
//dump($_GRAD);
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<script language="JavaScript">
  function checkInput() {
    var d       = document;
    var surname = d.getElementById('surname').value.trim();
    var name    = d.getElementById('name').value.trim();
    
    if (surname.length == 0) {
      alert('Prezime je obavezan podatak!');
      return false;
    }

    if (name.length == 0) {
      alert('Ime je obavezan podatak!');
      return false;
    }
    
    return true;
  }
</script>                
              <form name="frmTableEdit" id="frmTableEdit" method="POST" action="./zadrugarunos.php" onSubmit="javascript:return checkInput();">
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit" width="100%">
                <input type="hidden" name="id" value="<?=$id;?>">
                <tr>
                  <th align="right"><span class="required_data">Prezime : </span></th>
                  <td><input type="text" class="text_input" value="<?=$surname;?>" name="surname" id="surname" maxlength="70" style="width: 150px;" /></td>
                  <th align="right"><span class="required_data">Ime : </span></th>
                  <td><input type="text" class="text_input" value="<?=$name;?>" name="name" id="name" maxlength="70" style="width: 150px;" /></td>
                </tr>
                <tr>
                  <th align="right">Jedinstveni matični br :</th>
                  <td><input type="text" class="text_input" value="<?=$jmbr;?>" name="jmbr" id="jmbr" maxlength="13" style="width: 100px;" onKeyUp="javascript:return validateOnlyNumberField('jmbr');" /></td>
                  <th align="right">Ime jednog roditelja : </th>
                  <td><input type="text" class="text_input" value="<?=$parent;?>" name="parent" id="parent" maxlength="70" style="width: 150px;" /></td>
                </tr>
                <tr>
                  <th align="right">Broj l.k. i MUP : </th>
                  <td colspan="3"><input type="text" class="text_input" value="<?=$idnumber;?>" name="idnumber" id="idnumber" maxlength="15" style="width: 100px;" onKeyUp="javascript:return validateNumberField('idnumber');" /> 
                    &nbsp; <b>MUP</b> &nbsp; <input type="text" class="text_input" value="<?=$mup;?>" name="mup" id="mup" maxlength="70" style="width: 250px;" /></td>
                </tr>
                <tr>
                  <th align="right">Datum rođenja :</th>
                  <td>
                    <select name="birthday" id="birthday" class="text_input">
<? for ($i = 0; $i < 32; $i++) { $selected = ""; if ($i == $birthday) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="birthmonth" id="birthmonth" class="text_input">
<? for ($i = 0; $i < 13; $i++) { $selected = ""; if ($i == $birthmonth) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                    .
                    <select name="birthyear" id="birthyear" class="text_input">
                      <option value="0">0</option>                 
<? for ($i = 1939; $i < date("Y"); $i++) { $selected = ""; if ($i == $birthyear) $selected = "selected"; ?>     
                      <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>                 
<? } ?>                      
                    </select>
                  </td>
                  <th align="right">Mesto rođenja : </th>
                  <td>
                    <input type="text" class="text_input" value="<?=$birthplace;?>" name="birthplace" id="birthplace" maxlength="70" style="width: 200px;" />
                    </td>
                </tr>
                <tr>
                  <th align="right">Adresa boravka :</th>
                  <td><input type="text" class="text_input" value="<?=$address;?>" name="address" id="address" maxlength="255" style="width: 160px;" /></td>
                  <th align="right">Mesto boravka : </th>
                  <td>
                    <select name="IDAddressPlace" id="IDAddressPlace" class="text_input" style="width: 200px;">
                      <option value="-1">Izaberite mesto boravka</option>
<?php for ($i=0; $i < count($_GRAD); $i++) { $selected = ""; if ($IDAddressPlace == $_GRAD[$i]["ID"]) $selected = "selected"; ?>                      
                      <option value="<?=$_GRAD[$i]["ID"];?>"  <?=$selected;?>><?=$_GRAD[$i]['name'];?></option>
<?php } ?>                      
                    </select>
                  </td>
                </tr>
                <tr>
                  <th align="right">Stručna sprema : </th>
                  <td><input type="text" class="text_input" value="<?=$occupation;?>" name="occupation" id="occupation" maxlength="255" style="width: 160px;" /></td>
                  <th align="right">Posebna znanja : </th>
                  <td><input type="text" class="text_input" value="<?=$specialkno;?>" name="specialkno" id="specialkno" maxlength="255" style="width: 200px;" /></td>
                </tr>
                <tr>
                  <th align="right">Zdravstveno osiguran : </th>
                  <td>
                    <select name="healthinsur" id="healthinsur" class="text_input">
                      <option value="1">Da</option>
                      <option value="0">Ne</option>
                    </select>  
                  </td>
                  <th align="right">Član druge zadruge : </th>
                  <td>
                    <select name="memberother" id="memberother" class="text_input">
                      <option value="0">Ne</option>
                      <option value="1">Da</option>
                    </select>  
                  </td>
                </tr>
                <tr>
                  <th align="right">Osnov za članstvo : </th>
                  <td>
                    <select name="IDMemberBasis" id="IDMemberBasis" class="text_input">
                      <option value="-1">Izaberite osnov članstva</option>
<?php $query = mysql_query("SELECT * FROM oszmemberbasis ORDER BY ID") or die(mysql_error());
      while ($res = mysql_fetch_array($query)) { $selected = ""; if ($IDMemberBasis == $res['ID']) $selected = "selected"; ?>                      
                      <option value="<?=$res['ID'];?>" <?=$selected;?>><?=$res['name'];?></option>
<?php } ?>                      
                    </select>
                  </td>
                  <th align="right">Telefon : </th>
                  <td><input type="text" class="text_input" value="<?=$phone;?>" name="phone" id="phone" maxlength="20" style="width: 110px;" onKeyUp="javascript:return validatePhone('phone');" /></td>
                </tr>
                <tr>
                  <th align="right">Mobilni : </th>
                  <td><input type="text" class="text_input" value="<?=$mobile;?>" name="mobile" id="mobile" maxlength="20" style="width: 110px;" onKeyUp="javascript:return validatePhone('mobile');" /></td>
                  <th align="right">E pošta : </th>
<?php $error_message = $_LANG["sr"]["ERROR_INPUT_EMAIL"]; ?>                  
                  <td><input type="text" class="text_input" value="<?=$email;?>" name="email" id="email" maxlength="255" style="width: 200px;" onKeyUp="javascript:return validateEmail('email', '<?=$error_message;?>');" /></td>
                </tr>
                <tr>
                  <th align="right">Radna jedinica : </th>
                  <td colspan="3">
                    <select name="IDEmployer" id="IDEmployer" class="text_input">
                      <option value="-1">Izaberite radnu jedinicu</option>
<?php $query = mysql_query("SELECT ID, name FROM oszemployer ORDER BY name") or die(mysql_error());
      while ($res = mysql_fetch_array($query)) { $selected = ""; if ($IDEmployer == $res['ID']) $selected = "selected"; ?>                      
                      <option value="<?=$res['ID'];?>" <?=$selected;?>><?=$res['name'];?></option>
<?php } ?>                      
                    </select>
                  </td>
                </tr>
<script language="JavaScript">
  var forRdel = 0;
  function addDocument() {
    var d             = document;
    var docnumber     = d.getElementById('docnumber');
    var docnumber_val = docnumber.value;
    var docoffice     = d.getElementById('docoffice');
    var docoffice_val = docoffice.value;
    
    if (docnumber_val.length == 0 || docoffice_val.length == 0) {
      alert('Za dodavanje dokumenta potrebni su broj i ko je izdao dokument!');
      return false;
    }
    
    var documents     = d.getElementById('documents');
    var rand          = Math.floor(Math.random() * 10000000000000);
    var text_delete   = '<?=$_LANG["sr"]["DELETE"];?>';

    if (documents.rows.length == 0) {
      var rowHeadDocument         = documents.insertRow(-1);
      var colHeadDocNumber        = rowHeadDocument.insertCell(-1);
      var colHeadDocOffice        = rowHeadDocument.insertCell(-1);
      var colHeadDocDelete        = rowHeadDocument.insertCell(-1);
      
      colHeadDocNumber.innerHTML  = "Broj isprave";
      colHeadDocNumber.setAttribute("align", "center");
      colHeadDocOffice.innerHTML  = "Ko je izdao ispravu";
      colHeadDocOffice.setAttribute("align", "center");
      colHeadDocDelete.innerHTML  = "Briši?";
      colHeadDocDelete.setAttribute("align", "center");
    }
    
    var rowDocument   = documents.insertRow(-1);
    var colDocNumber  = rowDocument.insertCell(-1);
    var colDocOffice  = rowDocument.insertCell(-1);
    var colDocDelete  = rowDocument.insertCell(-1);
    var ahrefDel      = d.createElement("a");
    ahrefDel.setAttribute("href", "javascript:deleteRow('" + rand + "');");
    var imgDel        = d.createElement("img");
   
    var hiddenNumber  = d.createElement("input");
    hiddenNumber.setAttribute("type", "hidden");
    hiddenNumber.setAttribute("name", "docnumbers[]");
    hiddenNumber.setAttribute("value", docnumber_val);

    var hiddenOffice  = d.createElement("input");
    hiddenOffice.setAttribute("type", "hidden");
    hiddenOffice.setAttribute("name", "docoffices[]");
    hiddenOffice.setAttribute("value", docoffice_val);

    imgDel.setAttribute("src", "./images/form/del.jpg");
    imgDel.setAttribute("alt", text_delete);
    imgDel.setAttribute("title", text_delete);
    ahrefDel.appendChild(imgDel);
    colDocDelete.appendChild(ahrefDel);
    colDocDelete.setAttribute("align", "center");

    rowDocument.setAttribute("id", rand);
    colDocNumber.innerHTML = docnumber_val;
    colDocNumber.appendChild(hiddenNumber);
    colDocOffice.innerHTML = docoffice_val;
    colDocOffice.appendChild(hiddenOffice);
    
    docnumber.value = '';
    docoffice.value = '';
    
    return false;
  }

  function deleteRow(rdel) {
    
    var d         = document;
    var documents = d.getElementById('documents');
    
    for (var i=0; i < documents.rows.length; i++) {
      var current_row = documents.rows[i];
      if (parseFloat(rdel) == parseFloat(current_row.id)) {
        documents.deleteRow(i);
        break;
      }
    }
  }
  
</script>                   
                <tr>
                  <th align="right">Broj isprave : </th>
                  <td valign="top" colspan="3">
                    <table  cellpadding="2" cellspacing="2" border="0" width="100%">
                      <tr>
                        <td valign="middle" style="border: 0px none;"><input type="text" class="text_input" value="" name="docnumber" id="docnumber" maxlength="15" style="width: 100px;" /></td>
                        <td valign="middle" style="border: 0px none;"><b>Ko je izdao ispravu :</b></td>
                        <td valign="middle" style="border: 0px none;"><input type="text" class="text_input" value="" name="docoffice" id="docoffice" maxlength="70" style="width: 260px;" /></td>
                        <td valign="middle" style="border: 0px none;"><input type="image" src="./images/form/add.jpg" name="btn_add" id="btn_add" alt="<?=$_LANG["sr"]["ADD_DOCUMENT"];?>" title="<?=$_LANG["sr"]["ADD_DOCUMENT"];?>" onClick="javascript:return addDocument();" /></td>
                      </tr>
                    </table>
                    <table id="documents" cellpadding="2" cellspacing="2" border="0" class="table_edit" width="100%">
<?php
if ($id > 0) {
  $query = mysql_query(sprintf("SELECT * FROM oszdocument$_currentyear WHERE IDMember=%d",$id)) or die(mysql_error());
  while ($res = mysql_fetch_array($query)) {
    $rand = rand(1, 100000);
?>
                    <tr id="<?=$rand;?>"><td><?=$res["document"];?><input type="hidden" name="docnumbers[]" value="<?=$res["document"];?>" /></td><td><?=$res["publisher"];?><input type="hidden" name="docoffices[]" value="<?=$res["publisher"];?>" /></td><td align="center"><input type="image" src="./images/form/del.jpg" name="btn_del" id="btn_del" alt="<?=$_LANG["sr"]["DELETE"];?>" title="<?=$_LANG["sr"]["DELETE"];?>" onClick="javascript:return deleteRow(<?=$rand;?>);" /></td></tr> 
<?php    
  }
}
?>                      
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="required_data">Unos podataka je obavezan!</td>
                  <td style="padding:5px 5px 5px 0px;" colspan="2" align="right"><input type="submit" class="btn" name="submit" value="<?=$_LANG["sr"]["SAVE"];?>" /> &nbsp; <input type="button" class="btn" name="reset" value="<?=$_LANG["sr"]["BACK"];?>" onClick="javascript: history.go(-1);" /></td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
