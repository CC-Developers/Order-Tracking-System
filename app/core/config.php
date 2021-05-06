<?php namespace core;
/*
 * config - setup system wide settings
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
use \helpers\session as Session;
class Config {

	public function __construct(){

		//turn on output buffering
		ob_start();

		include "_comestoarra_labs_.php";
		define('PREFIX','cbn_');
		
		//set prefix for sessions, DO NOT CHANGE THIS !!!
		define('SESSION_PREFIX','cbn_');

		//turn on custom error handling
		set_exception_handler('core\logger::exception_handler');
		set_error_handler('core\logger::error_handler');

		//start sessions
		Session::init();

		//set the default template
		Session::set('template','default');		
		
	}

}
