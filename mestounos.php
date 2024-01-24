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
* @file         mestounos.php
* @package       
* @subpackage   
*
* @description  Edit page for place
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
$post     = ""; 	
$phone    = "";

if (isset($_GET['id']) && (int)$_GET['id'] > 0 ) {
  $id = (int)$_GET['id'];
  if (isset($_GET['act']) && $_GET['act'] == 'del') {
    mysql_query("DELETE FROM oszplace WHERE ID=$id") or die(mysql_error());
    header("location: mesto.php");
  }
}


if (isset($_POST['id'])) {
  if ((int)$_POST['id'] > 0) {
    $id = (int)$_POST['id'];
    $sql = "UPDATE oszplace SET name='%s', post='%s', phone='%s' WHERE ID=%d";
    mysql_query(sprintf($sql,
      $_POST["name"],
      $_POST["post"],
      $_POST["phone"],
      $id
    )) or die(mysql_error());
  } else {
    $sql = "INSERT INTO oszplace (name,post,phone) 
      VALUES ('%s', '%s', '%s')";
    mysql_query(sprintf($sql,
      $_POST["name"],
      $_POST["post"],
      $_POST["phone"]
    )) or die(mysql_error());
  }
  header("location: mesto.php");
}
include_once('./header.php');
if ($id > 0) {
  $query  = mysql_query("SELECT * FROM oszplace WHERE ID=$id") or die(mysql_error());
  $res    = mysql_fetch_array($query);
  $name   = $res["name"];	
  $post   = $res["post"]; 	
  $phone  = $res["phone"];
}
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<script language="JavaScript">
  function checkInput() {
    var d       = document;
    var name    = d.getElementById('name').value.trim();
    
    if (name.length == 0) {
      alert('Naziv mesta je obavezan podatak!');
      return false;
    }
    
    return true;
  }
</script>                      
              <form name="frmTableEdit" id="frmTableEdit" method="POST" action="./mestounos.php" onSubmit="javascript:return checkInput();">
              <input type="hidden" name="id" value="<?=$id;?>" />
              <table cellpadding="2" cellspacing="2" border="0" class="table_edit">
                <tr>
                  <th align="right"><span class="required_data">Naziv : </span></th>
                  <td><input type="text" value="<?=$name;?>" name="name" id="name" maxlength="255" style="width: 300px;" /></td>
                </tr>
                <tr>
                  <th align="right">Pošta : </th>
                  <td><input type="text" value="<?=$post;?>" name="post" id="post" maxlength="5" style="width: 50px;" /></td>
                </tr>
                <tr>
                  <th align="right">Pozivni broj : </th>
                  <td><input type="text" value="<?=$phone;?>" name="phone" id="phone" maxlength="5" style="width: 50px;" /></td>
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
