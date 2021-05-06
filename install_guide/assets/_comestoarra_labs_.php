<?php namespace core;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       install_guide/assets/_comestoarra_labs_.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */

	//site address
	define('DIR',''); //Example : http://localhost/awots/

	//CODE DEFINITION : WORK ORDER CODE
	define ("WO_CODE","WO-000"); //Example : WO-000		

	//DATABASE DETAILS		
	define('DB_HOST','');	//Example : localhost
	define('DB_NAME','');		//Example : awots
	define('DB_USER','');		//Example : root
	define('DB_PASS','');		//Example : root

	//DATABASE TYPE	
	define('DB_TYPE','mysql');

	//optional create a constant for the name of the site
	define('SITETITLE','A.W.O.T.S v.1.1');
	define('BARTITLE','Advanced Work Order Tracking System v.1.1');

	//set email sender
	define('SITEMAIL','labs@comestoarra.com');

	//set timezone
	date_default_timezone_set('Asia/Jakarta');

	//set the default language
	define('LANG', 'english');

	if (defined('LANG')){

		switch (LANG){
			case 'indonesian':
				include_once("lang/id.php");
			break;
			case 'english':
				include_once("lang/en.php");
			break;

			default:
				exit('The application language is not set correctly.');
		}

	}