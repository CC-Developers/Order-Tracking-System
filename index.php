<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       index.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2016 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */

if(file_exists('vendor/autoload.php')) :
	
	require 'vendor/autoload.php';

else : 

	echo "<h1>Please install via composer.json</h1>";
	echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
	echo "<p>Once composer is installed navigate to the working directory in your terminal/command prompt and enter 'composer install'</p>";
	exit;

endif;

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'production');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and production will hide them.
 */

if (defined('ENVIRONMENT')) :

	switch (ENVIRONMENT) {

		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');

	}

endif;

//create alias for Router
use \core\router as Router,
    \helpers\url as Url;

    if ( ! file_exists( "app/core/_comestoarra_labs_" ) ) :

		$url = 'install_guide/index.php';
		header( 'location: '.$url );

	endif;

	/*
	 *---------------------------------------------------------------
	 * ADMINISTRATOR ROUTES
	 *---------------------------------------------------------------
	 */

	//DEFINE ROUTES
	Router::any('/admin', '\controllers\admin\login@process');
	Router::any('admin/dashboard', '\controllers\admin\dashboard@welcome');
	Router::any('admin/calendar', '\controllers\admin\dashboard@calendar');
	Router::any('admin/about', '\controllers\admin\dashboard@about');
	Router::any('admin/login', '\controllers\admin\login@process');
	Router::any('admin/forgot', '\controllers\admin\login@forgot');
	Router::get('admin/logout', '\controllers\admin\login@logout');

	//client routes
	Router::any('admin/client', '\controllers\admin\client@index');
	Router::any('admin/client/view/(:num)', '\controllers\admin\client@view');
	Router::any('admin/client/add', '\controllers\admin\client@add');

	//administrator routes
	Router::any('admin/administrator', '\controllers\admin\administrator@index');
	Router::any('admin/administrator/view/(:num)', '\controllers\admin\administrator@view');
	Router::any('admin/administrator/add', '\controllers\admin\administrator@add');

	//profile routes
	Router::any('admin/profile', '\controllers\admin\profile@index');

	//mail routes
	Router::any('admin/mail', '\controllers\admin\mail@index');

	//work order routes
	Router::get('admin/project', '\controllers\admin\project@index');
	Router::any('admin/project/view/(:num)', '\controllers\admin\project@view');
	Router::any('admin/project/add', '\controllers\admin\project@add');

	//work order type routes
	Router::get('admin/service', '\controllers\admin\service@index');
	Router::any('admin/service/view/(:num)', '\controllers\admin\service@view');
	Router::any('admin/service/add', '\controllers\admin\service@add');

	//invoice routes
	Router::get('admin/invoice', '\controllers\admin\invoice@index');
	Router::any('admin/invoice/view/(:num)', '\controllers\admin\invoice@view');

	//report routes
	Router::any('admin/report', '\controllers\admin\report@index');
	Router::any('admin/report/workorder', '\controllers\admin\report@workorder');
	Router::any('admin/report/task', '\controllers\admin\report@task');
	Router::any('admin/report/invoice', '\controllers\admin\report@invoice');
	Router::any('admin/report/payment', '\controllers\admin\report@payment');
	Router::any('admin/report/finance', '\controllers\admin\report@finance');
	Router::any('admin/report/client', '\controllers\admin\report@client');
	Router::any('admin/report/user', '\controllers\admin\report@user');
	Router::any('admin/report/audit', '\controllers\admin\report@audit');

	//App Settings routes
	Router::any('admin/setting', '\controllers\admin\setting@viewsetting');

	//App Phase routes
	Router::any('admin/phase/view/(:num)', '\controllers\admin\setting@viewphase');
	Router::any('admin/phase/add', '\controllers\admin\setting@addphase');

	//App Currency routes
	Router::any('admin/currency/view/(:num)', '\controllers\admin\setting@viewcurrency');
	Router::any('admin/currency/add', '\controllers\admin\setting@addcurrency');

	//App Role routes
	Router::any('admin/role/view/(:num)', '\controllers\admin\setting@viewrole');
	Router::any('admin/role/add', '\controllers\admin\setting@addrole');

	/*
	 *---------------------------------------------------------------
	 * CLIENT ROUTES
	 *---------------------------------------------------------------
	 */

	//DEFINE ROUTES
	Router::any('/', '\controllers\client\login@process');
	Router::any('dashboard', '\controllers\client\dashboard@welcome');
	Router::any('calendar', '\controllers\client\dashboard@calendar');
	Router::any('about', '\controllers\client\dashboard@about');
	Router::any('login', '\controllers\client\login@process');
	Router::any('forgot', '\controllers\client\login@forgot');
	Router::get('logout', '\controllers\client\login@logout');

	//work order routes
	Router::any('project/view/(:num)', '\controllers\client\project@view');

	//invoice routes
	Router::any('invoice/view/(:num)', '\controllers\client\invoice@view');

	//profile routes
	Router::any('profile', '\controllers\client\profile@index');


	//if no route found
	Router::error('\core\error@index');

	//execute matched routes
	Router::dispatch();
