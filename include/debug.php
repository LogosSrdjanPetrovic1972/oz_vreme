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
* @project      EdotPLUS web portal
* @copyright    (C)2011 by Srđan Petrović@edotplus. All rights reserved.
* @license      Edotplus applications are not free software. For usage, distribution, using,
*               changing or copying any part of the code you need to have exclusive permission
*               by Srdjan Petrovic. Any violation of those rules will be considered as
*               intellectual property theft!
*
* @file         debug.php
* @package      libraries
* @subpackage   debug
*
* @description  Main debug file
*
* @history      17.08.2011. ; srdjanp ; Initial revision
*
*/

function getTimer() {
	list($usec, $sec) = explode(' ',microtime());
	return ((float)$usec + (float)$sec);
}

$GLOBALS['__TIMER__'] = getTimer();

define('_EDOTPLUS_MULTIPLY',    1000);
define('_EDOTPLUS_DECIMALS',    2);

function backTrace($recipient = null) {
  if ( is_null($recipient) ) {
    dump(niceDebugBacktrace(debug_backtrace()));
  }
  else {
    mail(
      $recipient,
      '['.$_SERVER['SERVER_NAME'] . '] Backtrace @ '. date('Y-m-D H:i:s'),
      niceDebugBacktrace(debug_backtrace()),
		  "MIME-Version: 1.0\n".
		  "Content-type: text/html; charset=UTF-8\n".
      "From: srdjan.petrovic@edotplus.com\n",
      '-srdjan.petrovic@edotplus.com'
    );
  }
}


function niceDebugBacktrace($backtrace) {
	$rv = '';

	krsort($backtrace);
	array_pop($backtrace);

	if (_EDOTPLUS_CLI) {
		foreach( $backtrace as $node => $info ) {
			$rv .= sprintf("%d. \t%s:%d\t %s::%s(%s)\n",
				(count($backtrace) - $node),
				$info['file'], $info['line'] - 1,
				(isset($info['class']) ? $info['class']:''),
				$info['function'],
				( isset($info['args']) && count($info['args']) > 0 ? implode(", ",array_map('Sanitize', $info['args'])) : '')
			);
		}
	} else {
		foreach( $backtrace as $node => $info ) {
			if ( isset($info['function']) && $info['function'] != __FUNCTION__ ) {
				$rv .= '<h3>Call #'.(count($backtrace) - $node).'</h3><pre>';
				if ( isset($info['file']) ) {
					$rv .= "Filename: ". $info['file'] . "<br />";
					$rv .= "Line:     ". $info['line'].'<br />';
				}

				if ( isset($info['function']) ) {

					if ( isset($info['class']) ) {
						$rv .= "Method:   <b>" . $info['class'] . "::";
					}
					else {
						$rv .= "Function: <b>";
					}

					$rv .= $info['function'] .'</b>( <span style="color: gray;">'."\n\t    " .
					( isset($info['args']) && count($info['args']) > 0 ? implode(",\n\t    ",array_map('Sanitize', $info['args'])) : '')."</span>\n\t  )<br />";
				}
				$rv .= '</pre><hr />';
			}
		}
	}
	return $rv;
}

/**
 * See getDump
 *
 */
function dump($var = 'Here\was/zin', $type = 1, $mini = false) {
	if (function_exists('disableCacheSaving')) {
		disableCacheSaving();
	}

	echo defined('_EDOTPLUS_CLI') && _EDOTPLUS_CLI ? getCliDump($var, $type) : getDump($var, $type, $mini);
}

/**
 * Returns formated variable structure
 *
 * @param mixed Anything that you want to output
 * @param int   Type of output (0: var_dump, 1: print_r, 2: xdebug_var_dump (will fall back to print_r if not supported))
 */
function getDump($var, $type = 1, $mini = false) {
	ob_start();
	if ($mini) echo '<div style="height: 500px; overflow:auto; border: 5px outset;">';

	$cur_mem = null;

	if (function_exists('memory_get_usage')) {
		$cur_mem = '<br />Memory usage at this point: '.number_format(memory_get_usage()).' bytes';
	}

	if (function_exists('xdebug_time_index')) {
		$ctime = number_format(xdebug_time_index()*1000, 3);
	} else {
		$ctime = number_format((getTimer() - $GLOBALS['__TIMER__'])*1000, 3);
	}

	if ('Here\was/zin' === $var) {
		// Lame solution, but using something more sane like NULL would
		// result in displaying what we want even when we don't want it ;>
		$var = $ctime.' ms';
	}

	$bt = debug_backtrace();
	echo '<pre style="background: #DDDDDD; border: 1px solid black; margin: 5px; text-align: left; padding: 10px; color: black; clear: both;">';
	echo '<div style="color: gray; font-size: 10px; text-align: right; '.
	     'margin: -10px -5px 10px 0px;">'.
	     "\n".'Dump location: <i>'.$bt[1]['file'].':'.$bt[1]['line'].'</i>'.
	     "\n".$cur_mem.'<br />'.
	     "\n".'Milisec from the start of the script: '.$ctime.'</div>';

	switch ($type) {
		case 2:
			if (function_exists('xdebug_var_dump')) {
				xdebug_var_dump($var);
				break;
			}
		case 1:
			print_r($var);
			break;
		case 0:
			var_dump($var);
			break;
	}

	echo '</pre>';

	if ( $mini ) echo '</div>';

	return ob_get_clean();
}

/**
 * Returns formated variable structure
 *
 * @param mixed Anything that you want to output
 * @param int   Type of output (0: var_dump, 1: print_r, 2: xdebug_var_dump (will fall back to print_r if not supported))
 */
function getCliDump($var, $type = 1) {
	ob_start();

	echo "\n" . str_repeat('*', 80) . "\n";

	$bt = debug_backtrace();

	$memory = '?';
	if (function_exists('memory_get_usage')) {
		$memory = number_format(memory_get_usage());
	}

	if (function_exists('xdebug_time_index')) {
		$ctime = number_format(xdebug_time_index()*1000, 3);
	} else {
		$ctime = number_format((BM() - $GLOBALS['__TIMER__'])*1000, 3);
	}

	printf("dump info: \x1b[32m%s\x1b[0m bytes / \x1b[32m%s\x1b[0m ms @ \x1b[32m%s\x1b[0m:\x1b[32m%s\x1b[0m\n", $memory, $ctime, $bt[1]['file'], $bt[1]['line'] - 1);

	switch ($type) {
		case 2:
			if (function_exists('xdebug_var_dump')) {
				xdebug_var_dump($var);
				break;
			}
		case 1:
			print_r($var);
			break;
		case 0:
			var_dump($var);
			break;
	}

	echo "\n". str_repeat('*', 80) . "\n";;

	return ob_get_clean();
}

function Sanitize(&$input) {
	switch ( gettype($input) ) {
		case 'object':
			return 'Object: '. get_class($input);
		case 'array':
		  return 'Array: '. count($input);
		case 'boolean':
		  return 'Bool: '. ($input ? 'TRUE' : 'FALSE');
		case 'NULL':
		  return 'NULL';
		default:
			return ucfirst(gettype($input)) . ': '.$input;
	}
}

function getMem($point = null) {
	if (function_exists('memory_get_usage')) {
		dump('Memory usage at this point '.(is_null($point) ? null : '('.$point.')').': '.number_format(memory_get_usage()).' bytes');
	}
}
?>