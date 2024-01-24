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
* @file         oszpodaci.php
* @package       
* @subpackage   
*
* @description  Edit cooperative data
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');

$name       = "";
$address    = "";
$IDPlace    = 0;
$phone      = "";
$mobile     = "";
$fax        = "";
$email      = "";
$url        = "";
$account    = "";
$reference  = "";
$idnumber   = "";
$pib        = "";
$activity   = "";

$edit     = false;

if (isset($_GET['edit'])) $edit = true;

if (isset($_POST['name'])) {
  $query = mysql_query("SELECT * FROM oszcooperative WHERE ID=1") or die(mysql_error());
  
  if (mysql_num_rows($query) == 1) {
    $sql = "UPDATE oszcooperative SET 
      name='%s',
      short='%s',
      shortest='%s',
      address='%s',
      IDPlace=%d,
      phone='%s',
      mobile='%s',
      fax='%s',
      email='%s',
      url='%s',
      account='%s',
      reference='%s',
      idnumber='%s',
      pib='%s',
      activity='%s'
    WHERE ID=1";
    mysql_query(sprintf($sql,
      $_POST['name'],
      $_POST['short'],
      $_POST['shortest'],
      $_POST['address'],
      $_POST['IDPlace'],
      $_POST['phone'],
      $_POST['mobile'],
      $_POST['fax'],
      $_POST['email'],
      $_POST['url'],
      $_POST['account'],
      $_POST['reference'],
      $_POST['idnumber'],
      $_POST['pib'],
      $_POST['activity']
    )) or die(mysql_error());
  } else {
    $sql = "INSERT INTO oszcooperative (name,short,shortest,address,IDPlace,phone,mobile,fax,email,url,account,reference,idnumber,pib,activity) 
      VALUES ('%s','%s','%s','%s',%d,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";
    mysql_query(sprintf($sql,
      $_POST['name'],
      $_POST['short'],
      $_POST['shortest'],
      $_POST['address'],
      $_POST['IDPlace'],
      $_POST['phone'],
      $_POST['mobile'],
      $_POST['fax'],
      $_POST['email'],
      $_POST['url'],
      $_POST['account'],
      $_POST['reference'],
      $_POST['idnumber'],
      $_POST['pib'],
      $_POST['activity'])) or die(mysql_error());
  }
  // update company information in the oszemployer for ID 1
  $query = mysql_query("SELECT * FROM oszemployer WHERE ID=1") or die(mysql_error());
  if (mysql_num_rows($query) == 1) 
    $sql = "UPDATE oszemployer SET 
      name='%s',
      address='%s',
      IDPlace=%d,
      phone='%s',
      mobile='%s',
      fax='%s',
      email='%s',
      url='%s',
      account='%s',
      idnumber='%s',
      pib='%s'
    WHERE ID=1";
  else
    $sql = "INSERT INTO oszemployer (ID,name,address,IDPlace,phone,mobile,fax,email,url,account,idnumber,pib) 
      VALUES (1,'%s','%s',%d,'%s','%s','%s','%s','%s','%s','%s','%s')";
  mysql_query(sprintf($sql,
    $_POST['name'],
    $_POST['address'],
    $_POST['IDPlace'],
    $_POST['phone'],
    $_POST['mobile'],
    $_POST['fax'],
    $_POST['email'],
    $_POST['url'],
    $_POST['account'],
    $_POST['idnumber'],
    $_POST['pib'])) or die(mysql_error());
}

$query = mysql_query("SELECT * FROM oszcooperative WHERE ID=1") or die(mysql_error());
$res = mysql_fetch_array($query );
if (isset($res['ID'])) {
  $name       = $res['name'];
  $short      = $res['short'];
  $shortest   = $res['shortest'];
  $address    = $res['address'];
  $IDPlace    = $res['IDPlace'];
  $phone      = $res['phone'];
  $mobile     = $res['mobile'];
  $fax        = $res['fax'];
  $email      = $res['email'];
  $url        = $res['url'];
  $account    = $res['account'];
  $reference  = $res['reference'];
  $idnumber   = $res['idnumber'];
  $pib        = $res['pib'];
  $activity   = $res['activity'];
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
              <form name="frmTableEdit" id="frmTableEdit" method="POST" action="./oszpodaci.php">
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit">
                <tr>
                  <th align="right" style="width:150px;">Naziv zadruge : </th>
                  <td style="width:300px;">
<? if ($edit) { ?>                    
                    <input type="text" value='<?=$name;?>' name="name" id="name" maxlength="255" style="width: 300px;" />
<? } elseif (strlen($name) > 0) echo $name; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Kraći naziv zadruge : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value='<?=$short;?>' name="short" id="short" maxlength="50" style="width: 150px;" />
<? } elseif (strlen($short) > 0) echo $short; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Najkraći naziv zadruge : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value='<?=$shortest;?>' name="shortest" id="shortest" maxlength="20" style="width: 100px;" />
<? } elseif (strlen($shortest) > 0) echo $shortest; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Adresa : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$address;?>" name="address" id="address" maxlength="255" style="width: 300px;" />
<? } elseif (strlen($address) > 0) echo $address; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Mesto :</th>
                  <td>
<? if ($edit) { ?>                    
                    <select name="IDPlace">
                      <option value="-1">Izaberite mesto</option>
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
<? } else {
    if ($IDPlace > 0) {
      $query  = mysql_query(sprintf("SELECT * FROM oszplace WHERE ID=%d",$IDPlace)) or die(mysql_error()); 
      $res = mysql_fetch_array($query);
      echo $res['name'];
    } else echo '&nbsp;';
   }?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Telefon : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$phone;?>" name="phone" id="phone" maxlength="30" style="width: 100px;" />
<? } elseif (strlen($phone) > 0) echo $phone; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Mobilni : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$mobile;?>" name="mobile" id="mobile" maxlength="30" style="width: 100px;" />
<? } elseif (strlen($mobile) > 0) echo $mobile; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Telefaks : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$fax;?>" name="fax" id="fax" maxlength="30" style="width: 100px;" />
<? } elseif (strlen($fax) > 0) echo $fax; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">E-pošta : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$email;?>" name="email" id="email" maxlength="255" style="width: 200px;" />
<? } elseif (strlen($email) > 0) echo $email; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Web adresa : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$url;?>" name="url" id="url" maxlength="255" style="width: 200px;" />
<? } elseif (strlen($url) > 0) echo $url; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Žiro račun : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$account;?>" name="account" id="account" maxlength="70" style="width: 200px;" />
<? } elseif (strlen($account) > 0) echo $account; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Poziv na broj : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$reference;?>" name="reference" id="reference" maxlength="70" style="width: 200px;" />
<? } elseif (strlen($reference) > 0) echo $reference; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Matični broj : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$idnumber;?>" name="idnumber" id="idnumber" maxlength="30" style="width: 100px;" />
<? } elseif (strlen($idnumber) > 0) echo $idnumber; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">PIB : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$pib;?>" name="pib" id="pib" maxlength="30" style="width: 100px;" />
<? } elseif (strlen($pib) > 0) echo $pib; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <th align="right">Delatnost : </th>
                  <td>
<? if ($edit) { ?>                    
                    <input type="text" value="<?=$activity;?>" name="activity" id="activity" maxlength="30" style="width: 100px;" />
<? } elseif (strlen($activity) > 0) echo $activity; else echo '&nbsp;'; ?>
                  </td>
                </tr>
                <tr>
                  <td style="padding:5px 5px 5px 0px;" colspan="2" align="right">
<? if ($edit) { ?>                    
                    <input type="submit" class="btn" name="submit" value="Sačuvaj" /> &nbsp; 
                    <input type="button" class="btn" name="reset" value="Nazad" onClick="javascript: history.go(-1);" />
<? } else { ?>
                    <a href="./oszpodaci.php?edit=1"><img src="./images/form/edit_big.jpg"></a>
<? } ?>                    
                  </td>
                </tr>
              </table>
              </form>
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
