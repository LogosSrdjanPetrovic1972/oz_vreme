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
* @file         zadrugaruvoz.php
* @package       
* @subpackage   
*
* @description  Import data for persons from previous years
*
* @history      02.02.2012. ; srdjanp ; Initial revision
*
*/
if (isset($_POST["import"]) && is_array($_POST["import"]))
{
  define('_EDOTPLUS_ALLOW',     1);
  
  /* must be included */
  require_once('./include/globals.inc');
  require_once('./include/debug.php');
  require_once('./include/c_db.php');
  require_once('./include/common.php');
  require_once('./include/c_session.php');
  
  if (!isset($db))
  {
    $db                     = new c_Db;
    $GLOBALS["connection"]  = $db->_conn;
    mysql_query("SET NAMES 'utf8'");
  }
  
  if (!isset($_session))
  {
    $_session = new c_Session;
  }  
  $_currentyear = $_session->_getCurrentYear();
  //dump($_POST["import"]);
  //die;
  
  for ($j=0; $j < count($_POST["import"]); $j++) {
    // ID, Year
    $importing = explode(";", $_POST["import"][$j]);
    $ID = $importing[0];
    $year = $importing[1];
    mysql_query("INSERT INTO oszmember$_currentyear (name, surname, parent, jmbr, idnumber, mup, birthday, birthplace, address, IDAddressPlace, occupation, specialkno, healthinsur, memberother, IDMemberBasis, phone, mobile, email, IDEmployer, memberdate)
    SELECT name, surname, parent, jmbr, idnumber, mup, birthday, birthplace, address, IDAddressPlace, occupation, specialkno, healthinsur, memberother, IDMemberBasis, phone, mobile, email, IDEmployer, now() FROM oszmember$year WHERE ID = $ID") or die(mysql_error());
  }
  header("location: ./zadrugar.php");
}
include_once('./header.php');
//die;
$where = "";
$_import = array();
if (isset($_POST["search"])) {
  $search = $_POST["search"];
  if ($_POST["searchType"] == "IP")
    $where = "WHERE name LIKE '%$search%' OR surname LIKE '%$search%'";
  else
    $where = "WHERE jmbr LIKE '%$search%'";
  switch($_POST["_year"]) {
    case "ALL":
      $years = explode(";", $_POST["all_years"]);
      foreach ($years as $year)
      {
        $query = mysql_query("SELECT ID, name, surname, jmbr, address FROM oszmember$year $where") or die(mysql_error);
        while ($result=mysql_fetch_array($query)) {
          $_import[] = array(
            "ID"        => $result["ID"], 
            "name"      => $result["name"], 
            "surname"   => $result["surname"], 
            "jmbr"      => $result["jmbr"], 
            "address"   => $result["address"],
            "year"      => $year
          );
        }
      }
      break;
    default:
      $year = $_POST["_year"];
      $query = mysql_query("SELECT ID, name, surname, jmbr, address FROM oszmember$year $where") or die(mysql_error);
      while ($result=mysql_fetch_array($query)) {
        $_import[] = array(
          "ID"        => $result["ID"], 
          "name"      => $result["name"], 
          "surname"   => $result["surname"], 
          "jmbr"      => $result["jmbr"], 
          "address"   => $result["address"],
          "year"      => $year
        );
      }
      break;
  }
}
?>
                            <!-- MAIN CONTENT START -->
                            <h2><?=$GLOBALS["sectiontitle"];?></h2>
                            <table cellpadding="2" cellspacing="2" border="0" class="table_search">
                              <form name="frmSearch" action="./zadrugaruvoz.php" method="POST">
                              <tr>
                                <td valign="middle">
                                  <select name="_year">
                                    <option value="ALL">Pretraži sve godine</option>
<?php
$query = mysql_query("SELECT year FROM oszyear ORDER BY year DESC");
$count = 1;
$years = "";
while ($result = mysql_fetch_array($query))
{
  if (intval($result["year"]) < intval($_currentyear)) {
    if ($years == "")
      $years = $result["year"];
    else
      $years .= ";".$result["year"];
?>
                                    <option value="<?=$result["year"];?>"><?=$result["year"];?></option>
<?php
  }
}
?>                                    
                                  </select>
                                  <input type="hidden" name="all_years" value="<?=$years?>">
                                </td>
                                <td valign="middle">
                                  <input type="radio" name="searchType" value="IP" checked="checked" /> &nbsp; Ime i prezime ?
                                </td>
                                <td valign="middle">
                                  <input type="radio" name="searchType" value="JBMG" /> &nbsp; Matični broj ?
                                </td>
                                <td><input type="text" name="search" id="search" maxlength="255" style="width:200px;" /></td>
                                <td><input type="image" src="./images/form/search.jpg" alt="<?=$_LANG["sr"]["SEARCH"];?>" title="<?=$_LANG["sr"]["SEARCH"];?>" /></td>
                              </tr>
                              </form>
                            </table>
                            <form name="import" action="./zadrugaruvoz.php" method="POST">
                            <table cellpadding="2" cellspacing="2" border="0" class="table_browse" width="100%">
                              <tr>
                                <th>Prezime i ime</th>
                                <th>JMBR</th>
                                <th>Adresa</th>
                                <th>Godina</th>
                                <th>Uvezi u (<?=$_currentyear;?>)?</th>
                              </tr>
<?php 
if (count($_import)>0)  { 
  for($i=0; $i < count($_import); $i++) {
?>
                              <tr>
                                <td><?=$_import[$i]["surname"]."&nbsp;".$_import[$i]["name"];?></td>
                                <td align="center"><?=$_import[$i]["jmbr"];?></td>
                                <td><?=$_import[$i]["address"];?></td>
                                <td align="center"><?=$_import[$i]["year"];?></td>
                                <td align="center"><input type="checkbox" name="import[]" value="<?=$_import[$i]["ID"].";".$_import[$i]["year"]?>" /></th>
                              </tr>
<?php 
  }
?>
                              <tr>
                                <td colspan="5" align="right"><input type="submit" name="bntUvoz" class="btn" value="&nbsp;&nbsp; UVOZI &nbsp;&nbsp;"></td>
                              </tr>
<?php
} 
?>
                            </table>
                            </form>
                            <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
