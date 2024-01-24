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
* @file         common.js
* @package      include 
* @subpackage   
*
* @description  Common JS functions
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/

String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}
String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
}
String.prototype.rtrim = function() {
	return this.replace(/\s+$/,"");
}


function confirmDelete(message) {
  return confirm(message);
}

function validateEmail(url_field, message) {
  var d     = document;
  var field = d.getElementById(url_field);
  var reg = /^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))$/;
  var url = field.value;
  if(reg.test(url) == false) {
    alert(message);
    field.className = "text_input_error";
    return false;
  }
}

function validateEmail(email_field, message) {
  var d       = document;
  var field   = d.getElementById(email_field);
  var reg     = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  var address = field.value;
  if(reg.test(address) == false) {
    alert(message);
    field.className = "text_input_error";
    return false;
  }
}

function validatePhone(phone_field)
{
  var d     = document;
  var field = d.getElementById(phone_field);
  var value = field.value; //get characters
  //check that all characters are digits, ., -, or ""
  var new_key = value.charAt(field.value.length - 1);

  if(((new_key < "0") || (new_key > "9")) && (new_key != "(") && (new_key != ")") && (new_key != "/") && (new_key != "-") && (new_key != " "))
  {
    field.value = field.value.substring(0, field.value.length - 1);
  }
  
  return ret;
}

function validateNumber(field) {
  var value = field.value; //get characters
  //check that all characters are digits, ., -, or ""
  var new_key = value.charAt(field.value.length - 1);

  if(((new_key < "0") || (new_key > "9")) && (new_key != ".") && (new_key != ",") && (new_key != "-"))
  {
    field.value = field.value.substring(0, field.value.length - 1);
  }
  
  return ret;
}

function validateNumberField(number_field) {
  var d     = document;
  var field = d.getElementById(number_field);
  var value = field.value; //get characters
  //check that all characters are digits, ., -, or ""
  var new_key = value.charAt(field.value.length - 1);

  if(((new_key < "0") || (new_key > "9")) && (new_key != ".") && (new_key != ",") && (new_key != "-"))
  {
    field.value = field.value.substring(0, field.value.length - 1);
  }
  
  return ret;
}

function validateDecimalNumber(number_field) {
  var d     = document;
  var field = d.getElementById(number_field);
  var value = field.value; //get characters
  //check that all characters are digits, ., -, or ""
  var new_key = value.charAt(field.value.length - 1);

  if(((new_key < "0") || (new_key > "9")) && (new_key != ".") && (new_key != "-"))
  {
    field.value = field.value.substring(0, field.value.length - 1);
  }
  
  return ret;
}

function validateOnlyNumberField(number_field) {
  var d     = document;
  var field = d.getElementById(number_field);
  var value = field.value; //get characters
  //check that all characters are digits, ., -, or ""
  var new_key = value.charAt(field.value.length - 1);

  if(((new_key < "0") || (new_key > "9")))
  {
    field.value = field.value.substring(0, field.value.length - 1);
  }
  
  return ret;
}


function checkMember(message) {
  var d = document;
  var selMember = d.getElementById('selMember');
  
  if (parseInt(selMember.value) < 0) {
    alert(message);
    return false;
  }
  return true;
}

function checkContract(message) {
  var d = document;
  var selContract = d.getElementById('selContract');
  
  if (parseInt(selContract.value) < 0) {
    alert(message);
    return false;
  }
  return true;
}

function checkContract1(message) {
  var d = document;
  var selContract = d.getElementById('selContract1');
  
  if (parseInt(selContract.value) < 0) {
    alert(message);
    return false;
  }
  return true;
}

function checkInvoice(message) {
  var d = document;
  var selInvoice = d.getElementById('selInvoice');
  
  if (parseInt(selInvoice.value) < 0) {
    alert(message);
    return false;
  }
  return true;
}

/* Rollover image START */
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
/* Rollover image END */
