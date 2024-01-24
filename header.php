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
* @file         header.php
* @package       
* @subpackage   
*
* @description  Header part, correct EDITPLUS inside channel and common includes
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
if (!defined('_EDOTPLUS_ALLOW'))
  define('_EDOTPLUS_ALLOW',     1);

/* must be included */
require_once('./include/globals.inc');
require_once('./include/debug.php');
require_once('./include/c_db.php');
require_once('./include/common.php');
require_once('./include/c_session.php');
require_once('./lang/sr.php');
// connect to database
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


$_esettings = $_session->_getSettings();
//dump($_esettings);
if (count($_esettings) == 0) {          // there is no settings in the sessions, get from database
  $query = mysql_query("select * from esettings where ID > 0 LIMIT 1") or die(mysql_error());
  $_esettings = mysql_fetch_array($query);
  //dump($_esettings);
  //die;
  if (!isset($_esettings["ID"]))
    die($_LANG["sr"]["FATAL_INSTAL"]);
  if (!$_session->_setSettings($_esettings))
    die($_LANG["sr"]["FATAL_SETTINGS"]);
}

$_oszcooperative = $_session->_getCooperative();
if (count($_oszcooperative) == 0) {          // there is no cooperative information in the sessions, get from database
  $query = mysql_query("select * from oszcooperative where ID > 0 LIMIT 1") or die(mysql_error());
  $_oszcooperative = mysql_fetch_array($query);
  if (!isset($_oszcooperative["ID"]))
    die($_LANG["sr"]["FATAL_INSTAL"]);
  if (!$_session->_setCooperative($_oszcooperative))
    die($_LANG["sr"]["FATAL_SETTINGS"]);
}

if ($GLOBALS["authenticate"]) {
  require_once('./include/authenticate.php');
  if (!isAuthenticate()) {
    header("Location: ./login.php");
  } 
  else {
    list($UserID, $UserIme, $UserPrezime) = getAuthenticate();
  }
}

$_currentyear = $_session->_getCurrentYear();
$_timescale   = $_session->_getTimeScale();

// get current script file
$forSelf = explode("/", $_SERVER['PHP_SELF']);
$_self   = $forSelf[count($forSelf)-1];
$_menu   = array();
$_root   = 0;
$_father = 0;
$_this   = 0;
$_index  = false;

$query = mysql_query("SELECT * FROM oszmenu ORDER BY root, sort") or die(mysql_error());
//Dump($GLOBALS);
$GLOBALS["sectiontitle"]  = "Početna strana";
$GLOBALS["menutitle"]     = "Početna strana";

while ($res = mysql_fetch_array($query)) {
  if ($_self == trim($res['link'])) {
    $_this    = $res['ID'];
    $_father  = $res['root'];
    $GLOBALS["sectiontitle"] = $res['title'];
  }
  if ($res['root'] > 0) {
    foreach($_menu[0] as $key => $menu) {
      if ($key == $res['root']) {
        $_menu[0][$key]['submenu'][$res['ID']] = array(
        "ID"        => $res['ID'],
        "title"     => $res['title'],
        "link"      => $res['link'],
        "root"      => $res['root'],
        "sort"      => $res['sort'],
        "sub_item"  => $res['sub_item'],
        "show_admin"=> $res['show_admin']
        );
      }
    }
  } else {
    $_menu[0][$res['ID']] = array(
      "ID"    => $res['ID'],
      "title" => $res['title'],
      "link"  => $res['link'],
      "root"  => $res['root'],
      "sort"      => $res['sort'],
      "sub_item"  => $res['sub_item'],
      "show_admin"=> $res['show_admin']
    );
  }
}
if ($_father > 0 || $_this > 0) {              // not index page
  if ($_father > 0) {                          // first level
    if (!isset($_menu[$_root][$_father]['submenu'][$_this])) {
      foreach($_menu[$_root] as $key => $submenu) {
        if (isset($_menu[$_root][$key]['submenu'][$_father])) {
          $_root = $key;
          break;
        }
      }
    }
  }
} else $_index  = true;
if ($_root > 0) {
  $GLOBALS["menutitle"] = $_menu[0][$_root]["title"];
} else {
  if ($_father > 0) {
    $GLOBALS["menutitle"] = $_menu[0][$_father]["title"];
  } else {
    $GLOBALS["menutitle"] = $GLOBALS["sectiontitle"];
  }
}

// MM_preloadImages('."'".'./images/edotplus_head_mouse.png'."'".');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>
    <title><?=$_LANG["sr"]["WEB_TITLE"];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="<?=$_LANG["sr"]["WEB_KEYWORDS"];?>" />
    <link href="./css/style.css" rel="stylesheet" type="text/css">
    <link href="./css/calendar.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/ico" href="favicon.ico" />
    <script language="JavaScript" src="./include/common.js"></script>
    <script language="JavaScript" src="./include/calendar_sr.js"></script>
  </head>
<?php
if (isset($preload_image) && is_array($preload_image)) {
  $strOnLoad = "javascript:MM_preloadImages(";
  $start = true;
  foreach($preload_image as $_image) {
    if ($start)
    {
      $start = false;
      $strOnLoad .= "'". $_image."'";
    } else $strOnLoad .= ",'". $_image."'";
  }
?>
  <body OnLoad="<?=$strOnLoad;?>">
<?php  
} else {
?>
  <body>
<?php
}
?>    
    <div class="main_content_location" align="center" valign="top">
      <table cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td colspan="2" valign="top">
            <table cellpadding="0" cellspacing="0" border="0" class="content_all">
              <tr>
                <td class="content_all_left"><img src="./images/1px.gif" /></td>
                <td class="content_main" valign="top">
                    <!-- MAIN CONTENT START -->
                    <table cellpadding="0" cellspacing="0" border="0" class="content_main">
                      <tr>
                        <td>
                          <table cellpadding="0" cellspacing="0" border="0" class="header">
                            <tr>
                              <td align="left" class="header_left">
<?php
$GLOBALS["admin"] = false;
if ($_session->_getSessionVar("euser"))
{
?>
<?php
  echo '<span style="font-size:14px;color:#700000;font-weight:bold;">Ø &nbsp; <i><u>Prijavljen: ' . $_session->_getSessionVar("ename") . "</u></i> &nbsp; Ø</span>";
?>
<?php  
  $GLOBALS["admin"] = true;
}
?>
&nbsp;                                
                              </td>
                              <td align="right" valign="top" class="header_right">
                                <a href="./index.php">
<?php if (isset($_esettings["custom_head"]) && $_esettings["custom_head"] && isset($_oszcooperative["headimage"]) && file_exists($_oszcooperative["headimage"])) { ?>
                                  <img src="<?=$_oszcooperative["headimage"];?>" alt="<?=$_LANG["sr"]["MAIN_IMAGE_ALT"];?>" title="<?=$_LANG["sr"]["MAIN_IMAGE_ALT"];?>" />
<?php } else { ?>
                                  <img src="./images/ezadruga_logo.png" alt="<?=$_LANG["sr"]["MAIN_IMAGE_ALT"];?>" title="<?=$_LANG["sr"]["MAIN_IMAGE_ALT"];?>" />
<?php } ?>
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td class="main_menu" colspan="2">
                                <!-- MAIN MENU START -->
<? 
  foreach ($_menu[0] as $key => $menu) { 
    if (intval($menu["sort"]) > 0) {
      if ($key == $_father || $key == $_root){
        // show administrator menu items
        if ($_menu[0][$key]["show_admin"] && $GLOBALS["admin"]) {
?>
                                <a href="./<?=$_menu[0][$key]["link"];?>" class="main_menu_selected"><?=$_menu[0][$key]["title"];?></a> &nbsp;
<?        
        } else {
?>
                                <a href="./<?=$_menu[0][$key]["link"];?>" class="main_menu_selected"><?=$_menu[0][$key]["title"];?></a> &nbsp;
<?
        }      
      } else {
        if ($_menu[0][$key]["show_admin"] && $GLOBALS["admin"]) {
?>
                                <a href="./<?=$_menu[0][$key]["link"];?>"><?=$_menu[0][$key]["title"];?></a> &nbsp;
<?        
        } else {
?>
                                <a href="./<?=$_menu[0][$key]["link"];?>"><?=$_menu[0][$key]["title"];?></a> &nbsp;
<? 
        }      
      }
    }
  }
?>                          
                                <!-- MAIN MENU END -->
                              </td>
                            <tr>
                          </table>
                        </td>
                      </tr>
                      <!-- HEADER END -->
                      <tr>
                        <td valign="top">
                          <table cellpadding="0" cellspacing="0" border="0" class="main_content">
                            <tr>
                              <td class="left_menu" valign="top">
                                <!-- LEFT MENU START START -->
<?php
//dump("_this = " . $_this);
//dump("_root = " . $_root);
//dump("_father = " . $_father);
//dump($_menu);
if (!$_index) {
?>
                                <h3><?=$GLOBALS["menutitle"];?></h3>
                                <ul>
<?php
  $sub_item = -1;
  if ($_root > 0) {
    foreach($_menu[0][$_root]['submenu'] as $key => $menu) {
      if (intval($_menu[0][$_root]['submenu'][$key]["sub_item"]) > 0 && $_this == $key) $sub_item = intval($_menu[0][$_root]['submenu'][$key]["sub_item"]); 
      if (intval($_menu[0][$_root]['submenu'][$key]["sort"]) > 0)    
      {
        if ($key == $_father || $key == $sub_item) {
          if ($_menu[0][$_root]['submenu'][$key]["show_admin"] && $GLOBALS["admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_root]['submenu'][$key]["link"];?>" class="main_menu_selected"><?=$_menu[0][$_root]['submenu'][$key]["title"];?></a></li>
<?        
          } elseif (!$_menu[0][$_root]['submenu'][$key]["show_admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_root]['submenu'][$key]["link"];?>" class="main_menu_selected"><?=$_menu[0][$_root]['submenu'][$key]["title"];?></a></li>
<?php
          }        
        } else {
          if ($_menu[0][$_root]['submenu'][$key]["show_admin"] && $GLOBALS["admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_root]['submenu'][$key]["link"];?>"><?=$_menu[0][$_root]['submenu'][$key]["title"];?></a></li>
<?        
          } elseif (!$_menu[0][$_root]['submenu'][$key]["show_admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_root]['submenu'][$key]["link"];?>"><?=$_menu[0][$_root]['submenu'][$key]["title"];?></a></li>
<?php        
          }        
        }
      }
    }
  } else {
    if ($_father > 0) {
      foreach($_menu[0][$_father]['submenu'] as $key => $menu) {
        if (intval($_menu[0][$_father]['submenu'][$key]["sub_item"]) > 0 && $_this == $key) $sub_item = intval($_menu[0][$_father]['submenu'][$key]["sub_item"]);  
        if (intval($_menu[0][$_father]['submenu'][$key]["sort"]) > 0)    
        {
          if ($key == $_this || $key == $sub_item) {
            if ($_menu[0][$_father]['submenu'][$key]["show_admin"] && $GLOBALS["admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_father]['submenu'][$key]["link"];?>" class="main_menu_selected"><?=$_menu[0][$_father]['submenu'][$key]["title"];?></a></li>
<?        
          } elseif (!$_menu[0][$_father]['submenu'][$key]["show_admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_father]['submenu'][$key]["link"];?>" class="main_menu_selected"><?=$_menu[0][$_father]['submenu'][$key]["title"];?></a></li>
<?
            }          
          } else {
            if ($_menu[0][$_father]['submenu'][$key]["show_admin"] && $GLOBALS["admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_father]['submenu'][$key]["link"];?>"><?=$_menu[0][$_father]['submenu'][$key]["title"];?></a></li>
<?        
          } elseif (!$_menu[0][$_father]['submenu'][$key]["show_admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_father]['submenu'][$key]["link"];?>"><?=$_menu[0][$_father]['submenu'][$key]["title"];?></a></li>
<? 
            }          
          }
        }     
      }     
    } else {
      foreach($_menu[0][$_this]['submenu'] as $key => $menu) {
        if ($_menu[0][$_this]['submenu'][$key]["show_admin"] && $GLOBALS["admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_this]['submenu'][$key]["link"];?>"><?=$_menu[0][$_this]['submenu'][$key]["title"];?></a></li>
<?        
        } elseif (!$_menu[0][$_this]['submenu'][$key]["show_admin"]) {
?>
                                  <li><a href="<?=$_menu[0][$_this]['submenu'][$key]["link"];?>"><?=$_menu[0][$_this]['submenu'][$key]["title"];?></a></li>
<?
        } 
      }     
    }
  }
?>
                                </ul>
<?  
} else {
?>
<!--                                <h3><?=$_LANG["sr"]["WELCOME"];?></h3>  -->
<?php
}
?>
                                <!-- LEFT MENU START END -->
                                
                                <hr style="margin-top:25px;margin-bottom:25px;width:140px;"/>
                                <div align="center">
<?php if (!$GLOBALS["admin"]) { ?>                                
                                  <form name="frmLogin" action="./login.php" method="POST">
                                    <input type="hidden" name="redirect" id="redirect" value="<?="./"._getPhpSelf();?>" />
                                    <input type="submit" name="login" id="login" class="btn" value=" &nbsp; &nbsp; Prijava &nbsp; &nbsp; " />
                                  </form>
<?php } else { ?>                                
                                  <form name="frmLogout" action="./logout.php" method="POST">
                                    <input type="hidden" name="redirect" id="redirect" value="<?="./"._getPhpSelf();?>" />
                                    <input type="submit" name="login" id="login" class="btn" value=" &nbsp; &nbsp; Odjava &nbsp; &nbsp; " />
                                  </form>
<?php } ?>
                                </div>                                
                                <hr style="margin-top:25px;width:140px;" />
                                
                              </td>
                              <td style="width:830px;padding-left:5px;" valign="top">
