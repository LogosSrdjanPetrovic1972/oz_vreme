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
* @file         common.php
* @package      include 
* @subpackage   
*
* @description  Common PHP functions
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/

function _getPhpSelf()
{
  $retVal = explode("/", $_SERVER['PHP_SELF']);
  return $retVal[count($retVal) - 1];
}

function _year_to_image($number)
{
  $return = '<table cellpadding="0" cellspacing="0" border="0"><tr>';
  for($i=0; $i < strlen($number); $i++)
  {
    switch (substr($number, $i, 1))
    {
      case "0":
        $return .= '<td><img src="./images/signs/0.png" /></td>';
        break;      
      case "1":
        $return .= '<td><img src="./images/signs/1.png" /></td>';      
        break;      
      case "2":
        $return .= '<td><img src="./images/signs/2.png" /></td>';     
        break;      
      case "3":
        $return .= '<td><img src="./images/signs/3.png" /></td>';      
        break;      
      case "4":
        $return .= '<td><img src="./images/signs/4.png" /></td>';      
        break;      
      case "5":
        $return .= '<td><img src="./images/signs/5.png" /></td>';      
        break;      
      case "6":
        $return .= '<td><img src="./images/signs/6.png" /></td>';      
        break;      
      case "7":
        $return .= '<td><img src="./images/signs/7.png" /></td>';      
        break;      
      case "8":
        $return .= '<td><img src="./images/signs/8.png" /></td>';      
        break;      
      case "9":
        $return .= '<td><img src="./images/signs/9.png" /></td>';      
        break;
      default:
          $return .= "";
        break;
    }
  }
  $return .= '</tr></table>';
  return $return;
}

function _get_Age($date) {
  // input:   1957-12-22
  // output:  22.12.1957
  $year = (int)substr($date, 0, 4);
  return (int)date("Y") -$year;
}

function _input_date_to_db_date($date) {
  // input:   22.12.1957
  // output:  1957-12-22
  if (strlen($date) == 10 )
    return substr($date, 6, 4).'-'.substr($date, 3, 2).'-'.substr($date, 0, 2);
  else
    return '1950-01-01';
}

function _db_date_to_date($date) {
  // input:   1957-12-22
  // output:  22.12.1957
  if (strlen($date) == 10 )
    return substr($date, 8, 2).'.'.substr($date, 5, 2).'.'.substr($date, 0, 4);
  else
    return '01.01.1950';
}

 
function _db_date_to_day($date) {
  // input:   1957-12-22
  // output:  22
  if (strlen($date) == 10 )
    return (int)substr($date, 8, 2);
  else
    return 0;
}

function _db_date_to_month($date) {
  // input:   1957-12-22
  // output:  12
  if (strlen($date) == 10 )
    return (int)substr($date, 5, 2);
  else
    return 0;
}

function _db_date_to_year($date) {
  // input:   1957-12-22
  // output:  1957
  if (strlen($date) == 10 )
    return (int)substr($date, 0, 4);
  else
    return 0;
}

function _input_to_db_date($day,$month,$year) {
  if ((int)$day > 0 && (int)$month > 0 && (int)$year > 0)
    return $year."-".$month."-".$day;
  else
    return '1950-01-01';
}
 
?>