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
* @file         c_session.php
* @package      include 
* @subpackage   
*
* @description  Session manipulation file
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/
class c_Session {
  
  public function __construct() {
    session_start();
  }
  
  public function __destruct() {
  }

  public function _getCooperative() {
    $retCooperative = array();
    
    if (isset($_SESSION["name"]))
      $retCooperative["name"] = $_SESSION["name"];
    if (isset($_SESSION["short"]))
      $retCooperative["short"] = $_SESSION["short"];
    if (isset($_SESSION["shortest"]))
      $retCooperative["shortest"] = $_SESSION["shortest"];
    if (isset($_SESSION["address"]))
      $retCooperative["address"] = $_SESSION["address"];
    if (isset($_SESSION["IDPlace"]))
      $retCooperative["IDPlace"] = intval($_SESSION["IDPlace"]);
    if (isset($_SESSION["phone"]))
      $retCooperative["phone"] = $_SESSION["phone"];
    if (isset($_SESSION["mobile"]))
      $retCooperative["mobile"] = $_SESSION["mobile"];
    if (isset($_SESSION["fax"]))
      $retCooperative["fax"] = $_SESSION["fax"];
    if (isset($_SESSION["email"]))
      $retCooperative["email"] = $_SESSION["email"];
    if (isset($_SESSION["url"]))
      $retCooperative["url"] = $_SESSION["url"];
    if (isset($_SESSION["account"]))
      $retCooperative["account"] = $_SESSION["account"];
    if (isset($_SESSION["reference"]))
      $retCooperative["reference"] = $_SESSION["reference"];
    if (isset($_SESSION["pib"]))
      $retCooperative["pib"] = $_SESSION["pib"];
    if (isset($_SESSION["idnumber"]))
      $retCooperative["idnumber"] = $_SESSION["idnumber"];
    if (isset($_SESSION["activity"]))
      $retCooperative["activity"] = $_SESSION["activity"];
    if (isset($_SESSION["headimage"]))
      $retCooperative["headimage"] = $_SESSION["headimage"];
    if (isset($_SESSION["pdfimage"]))
      $retCooperative["pdfimage"] = $_SESSION["pdfimage"];
    
    return $retCooperative; 
  }

  public function _setCooperative($cooperative) {
    if (isset($cooperative["name"]))
      $_SESSION["name"] = $cooperative["name"];
    else
      return false;
    if (isset($cooperative["short"]))
      $_SESSION["short"] = $cooperative["short"];
    else
      return false;
    if (isset($cooperative["shortest"]))
      $_SESSION["shortest"] = $cooperative["shortest"];
    else
      return false;
    if (isset($cooperative["address"]))
      $_SESSION["address"] = $cooperative["address"];
    else
      return false;
    if (isset($cooperative["IDPlace"]))
      $_SESSION["IDPlace"] = intval($cooperative["IDPlace"]);
    else
      return false;      
    if (isset($cooperative["phone"]))
      $_SESSION["phone"] = $cooperative["phone"];
    else
      return false;
    if (isset($cooperative["mobile"]))
      $_SESSION["mobile"] = $cooperative["mobile"];
    else
      return false;
    if (isset($cooperative["fax"]))
      $_SESSION["fax"] = $cooperative["fax"];
    else
      return false;
    if (isset($cooperative["email"]))
      $_SESSION["email"] = $cooperative["email"];
    else
      return false;
    if (isset($cooperative["url"]))
      $_SESSION["url"] = $cooperative["url"];
    else
      return false;
    if (isset($cooperative["account"]))
      $_SESSION["account"] = $cooperative["account"];
    else
      return false;
    if (isset($cooperative["reference"]))
      $_SESSION["reference"] = $cooperative["reference"];
    else
      return false;
    if (isset($cooperative["pib"]))
      $_SESSION["pib"] = $cooperative["pib"];
    else
      return false;
    if (isset($cooperative["idnumber"]))
      $_SESSION["idnumber"] = $cooperative["idnumber"];
    else
      return false;
    if (isset($cooperative["activity"]))
      $_SESSION["activity"] = $cooperative["activity"];
    else
      return false;
    if (isset($cooperative["headimage"]))
      $_SESSION["headimage"] = $cooperative["headimage"];
    else
      return false;
    if (isset($cooperative["pdfimage"]))
      $_SESSION["pdfimage"] = $cooperative["pdfimage"];
    else
      return false;
    return true;
  }
  
  
  public function _getSettings() {
    $retSettings = array();
    
    if (isset($_SESSION["sequrity"]))
      $retSettings["sequrity"] = intval($_SESSION["sequrity"]);
    if (isset($_SESSION["upload"]))
      $retSettings["upload"] = intval($_SESSION["upload"]);
    if (isset($_SESSION["custom_head"]))
      $retSettings["custom_head"] = intval($_SESSION["custom_head"]);
    if (isset($_SESSION["open_year"]))
      $retSettings["open_year"] = intval($_SESSION["open_year"]);
    if (isset($_SESSION["backup"]))
      $retSettings["backup"] = intval($_SESSION["backup"]);
    if (isset($_SESSION["parameters"]))
      $retSettings["parameters"] = intval($_SESSION["parameters"]);
    
    return $retSettings; 
  }

  public function _setSettings($settings) {
    if (isset($settings["sequrity"]))
      $_SESSION["sequrity"] = intval($settings["sequrity"]);
    else
      return false;      
    if (isset($settings["upload"]))
      $_SESSION["upload"] = intval($settings["upload"]);
    else
      return false;      
    if (isset($settings["custom_head"]))
      $_SESSION["custom_head"] = intval($settings["custom_head"]);
    else
      return false;      
    if (isset($settings["open_year"]))
      $_SESSION["open_year"] = intval($settings["open_year"]);
    else
      return false;      
    if (isset($settings["backup"]))
      $_SESSION["backup"] = intval($settings["backup"]);
    else
      return false;      
    if (isset($settings["parameters"]))
      $_SESSION["parameters"] = intval($settings["parameters"]);
    else
      return false;
    
    return true;
  }
  
  public function _getCooperativeName() {
    // name short shortest 
    if (isset($_SESSION['_OSZ_CooperativeName']))
      return $_SESSION['_OSZ_CooperativeName'];
    else {
      $query = mysql_query("SELECT * FROM OSZCooperative") or die(mysql_error());
      $res = mysql_fetch_array($query);
        $_SESSION['_OSZ_CooperativeName'] = array("name" => $res['name'],"short" => $res['short'],"shortest" => $res['shortest']);
        
      return $_SESSION['_OSZ_CooperativeName'];
    }
  }
  
  public function _getCurrentYear() {
    if (isset($_SESSION['_OSZ_CurrentYear']) && (int)$_SESSION['_OSZ_CurrentYear'] > $GLOBALS["def_start_year"])
      return (int) $_SESSION['_OSZ_CurrentYear'];
    else {
      $query = mysql_query("SELECT * FROM OSZCooperative") or die(mysql_error());
      $res = mysql_fetch_array($query);
      if (isset($res['currentyear']) && (int)$res['currentyear'] > $GLOBALS["def_start_year"]) 
        $_SESSION['_OSZ_CurrentYear'] = (int) $res['currentyear'];
      else
        $_SESSION['_OSZ_CurrentYear'] = (int) date("Y");
        
      return (int) $_SESSION['_OSZ_CurrentYear'];
    }
  }

  public function _setCurrentYear($year) {
    $_SESSION['_OSZ_CurrentYear'] = $year;
  }
  
  public function _getTimeScale() {
    if (isset($_SESSION['_OSZ_TimeScale']))
      return (int) $_SESSION['_OSZ_TimeScale'];
    else {
      $query = mysql_query("SELECT * FROM OSZCooperative") or die(mysql_error());
      $res = mysql_fetch_array($query);
      if (isset($res['contracthours']) && (int)$res['contracthours']) 
        $_SESSION['_OSZ_TimeScale'] = 1;
      elseif (isset($res['memberhours']) && (int)$res['memberhours'])
        $_SESSION['_OSZ_TimeScale'] = 2;
      else
        $_SESSION['_OSZ_TimeScale'] = -1;
        
      return (int) $_SESSION['_OSZ_TimeScale'];
    }
  }

  public function _setTimeScale($type) {
    $_SESSION['_OSZ_TimeScale'] = $type;
  }
  
  public function _isSessionVar($session) {
    return isset($_SESSION[$session]);
  }

  public function _setSessionVar($session, $value) {
    $_SESSION[$session] = $value;
  }

  public function _getSessionVar($session) {
    if (isset($_SESSION[$session]))
      return $_SESSION[$session];
    else
      return null;
  }

  public function _delSessionVar() {
    session_destroy();
  }
}
 
?>