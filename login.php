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
* @file         login.php
* @package       
* @subpackage   
*
* @description  Login page
*
* @history      01.02.2012. ; srdjanp ; Initial revision
*
*/
$preload_image = array("./img/eadmin_login_red.png");

$redirect = "./zadrugar.php";
if (isset($_POST["redirect"]))         
  $redirect = trim($_POST["redirect"]);
  
//dump($_POST);
//dump($redirect);
//die;
if (isset($_POST["fUser"]) && isset($_POST["fPass"])) {
  define('_EDOTPLUS_ALLOW',     1);
  require_once('./include/globals.inc');
  require_once('./include/c_db.php');
  require_once('./include/debug.php');
  require_once('./include/common.php');
  require_once('./include/c_session.php');
  if (!isset($db))
  {
    $db                     = new c_Db;
    $GLOBALS["connection"]  = $db->_conn;
    mysql_query("SET NAMES 'utf8'");
  }
  
  // get settings 
  if (!isset($_session))
  {
    $_session = new c_Session;
  }

  $sql = "SELECT * FROM euser where username='%s' and password=password('%s')";
  $query = mysql_query(sprintf($sql, $_POST["fUser"], $_POST["fPass"]));
  $result = mysql_fetch_array($query);
  if (isset($result['ID']))
  {
    $_session->_setSessionVar("euser", "logged");
    $_session->_setSessionVar("eusername", $result["username"]);
    $_session->_setSessionVar("ename", $result["name"]);
    header("location: $redirect");
  }
} else {
  include_once('./header.php');
}
?>
                            <!-- MAIN CONTENT START -->
                            <div align="center" style="margin-top:60px;">
                            <form name="frmLogin" action="./login.php" method="POST">
                            <input type="hidden" id="redirect" name="redirect" value="<?=$redirect;?>" />
                            <table cellpadding="0" cellspacing="0" border="0" class="table_browse" style="width:500px;">
                              <tr>
                                <td colspan="2" style="height:50px"><img src="./img/eadmin_log_top.png" /></td>
                              </tr>
                              <tr>
                                <td colspan="2" style="height:50px" width="100%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="right" width="50%"> <b>Korisničko ime:</b> </td>
                                <td width="50%"> &nbsp; <input type="text" id="fUser" name="fUser" /></td>
                              </tr>
                              <tr>
                                <td align="right" width="50%"> <b>Lozinka:</b> </td>
                                <td width="50%"> &nbsp; <input type="password" id="fPass" name="fPass" /></td>
                              </tr>
                              <tr>
                                <td colspan="2" style="height:50px" width="100%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="right" width="50%">&nbsp;</td>
                                <td> &nbsp; <input type="submit" id="btnSubmit" name="btnSubmit" class="btn" value="Prijavi se" /></td>
                              </tr>
                            </table>  
                            </form>
                            </div>
                            <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
