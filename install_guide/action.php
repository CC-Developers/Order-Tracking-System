<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       install_guide/action.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2016 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
error_reporting( 0 );
ini_set( 'display_errors', FALSE );
include "../app/core/_comestoarra_labs_.php";
$newFile 	= "../app/core/_comestoarra_labs_";
$fh      	= fopen($newFile, 'w');
$name     	= "YOUR LICENSE KEY : CBN-AWOTS-0";
$rand     	= rand(1,99);
$licenseApp = $name.$rand;
$theDate = $licenseApp. "\nDO NOT DELETE THIS FILE !\n" . date("F j, Y, g:i a");
fwrite($fh, $theDate);
fclose($fh);
 echo "<h1>INSTALLATION SUCCESS</h1>";  
     echo "<p>You can <a href='".DIR."admin'>LOGIN HERE</a></p>";  