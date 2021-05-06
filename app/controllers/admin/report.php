<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/admin/report.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
use core\view as View,
	core\config as Config,
 	\helpers\session as Session,
 	\helpers\url as Url,
 	\helpers\password as Password;

class Report extends \core\controller{

	private $_report;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_report = new \models\admin\report();
		if(Session::get('loggedin') == false) {
			Url::redirect('admin/login');
		}
	}

	/**
	 * define page title and load template files
	 */
	public function index(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));
		
		View::rendertemplate('header',$data);
		View::render('admin/report/report',$data);
		View::rendertemplate('footer',$data);
	}

	public function workorder(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_project'] = $this->_report->get_project();

		View::rendertemplate('header',$data);
		View::render('admin/report/workorder',$data);
		View::rendertemplate('footer',$data);
	}

	public function task(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_wo_task_project'] = $this->_report->get_wo_task_project();

		View::rendertemplate('header',$data);
		View::render('admin/report/task',$data);
		View::rendertemplate('footer',$data);
	}

	public function invoice(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_wo_invoice'] = $this->_report->get_wo_invoice();

		View::rendertemplate('header',$data);
		View::render('admin/report/invoice',$data);
		View::rendertemplate('footer',$data);
	}

	public function payment(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_wo_invoice_payment'] = $this->_report->get_wo_invoice_payment();

		View::rendertemplate('header',$data);
		View::render('admin/report/payment',$data);
		View::rendertemplate('footer',$data);
	}

	public function finance(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_wo_finance'] = $this->_report->get_wo_finance();

		View::rendertemplate('header',$data);
		View::render('admin/report/finance',$data);
		View::rendertemplate('footer',$data);
	}

	public function client(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_client'] = $this->_report->get_client();

		View::rendertemplate('header',$data);
		View::render('admin/report/client',$data);
		View::rendertemplate('footer',$data);
	}

	public function user(){	

		$data['title'] 			= 'User Reports';
		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_user'] = $this->_report->get_user();

		View::rendertemplate('header',$data);
		View::render('admin/report/user',$data);
		View::rendertemplate('footer',$data);
	}

	public function audit(){	

		$data['get_wo_task'] 	= $this->_report->get_wo_task();
		$data['get_task_count'] = $this->_report->get_task_count();
		$data['mailcount'] 		= $this->_report->get_unread_mail_count(Session::get(IdUser));

		$data['get_audit'] = $this->_report->get_audit();

		View::rendertemplate('header',$data);
		View::render('admin/report/audit',$data);
		View::rendertemplate('footer',$data);
	}

}