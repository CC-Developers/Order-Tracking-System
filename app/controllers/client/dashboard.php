<?php namespace controllers\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/admin/dashboard.php
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
use Helpers\csrfhelper;

class Dashboard extends \core\controller{

	private $_login;
	private $_dashboard;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_login = new \models\client\login();
		$this->_dashboard = new \models\client\dashboard();
		if(Session::get('clientloggedin') == false) {
			Url::redirect('login');
		}
	}

	/**
	 * define page title and load template files
	 */
	public function welcome(){	
		
		$data['rows'] 								= $this->_login->get_appname(1);
		$data['get_invoice_count'] 					= $this->_dashboard->get_invoice_count(Session::get(IdClient));
		$data['get_client_invoice_access'] 			= $this->_dashboard->get_client_invoice_access(Session::get(IdClient));
		$data['get_client_active_work_order_count'] = $this->_dashboard->get_client_active_work_order_count(Session::get(IdClient));
		$data['get_client_active_work_order'] 		= $this->_dashboard->get_client_active_work_order(Session::get(IdClient));
		$data['get_client_active_request_count'] 	= $this->_dashboard->get_client_active_request_count(Session::get(IdClient));
		$data['get_client_active_request'] 			= $this->_dashboard->get_client_active_request(Session::get(IdClient));
		$data['service_lists'] 	= $this->_dashboard->get_service_list();
		$data['currency_lists'] = $this->_dashboard->get_currency_list();
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();
		$data['js'] 			=
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/bootstrap-datepicker.js' type='text/javascript'></script>
			";

		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() { 
					$('.datepicker').datepicker({
				    	format: 'yyyy-mm-dd'
					}); 
					$('#all-workorders').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });    
			        $('#all-invoices').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
					$('#all-requests').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
		    	});
			</script>";

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// ADD NEW REQUEST DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-request') {

				if(empty($_POST['ProjectStart'])) {
					$error[] = _ERROR_PROJECT_START_LANG_;
				} else if(empty($_POST['ProjectDeadline'])) {
					$error[] = _ERROR_PROJECT_DEADLINE_LANG_;
				} else if($_POST['TypeId'] == "++") {
					$error[] = _ERROR_PROJECT_TYPE_LANG_;
				} else if($_POST['ProjectCurrency'] == "++") {
					$error[] = _ERROR_PROJECT_CURRENCY_LANG_;
				} else if($_POST['ProjectStart'] > $_POST['ProjectDeadline']) {
					$error[] = _ERROR_PROJECT_START_DEADLINE_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 		= date('Y-m-d H:i:s');
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$TypeId 			= trim(strip_tags(isset($_POST['TypeId']) ? $_POST['TypeId'] : ''));
				$ProjectCurrency 	= trim(strip_tags(isset($_POST['ProjectCurrency']) ? $_POST['ProjectCurrency'] : ''));
				$ProjectStart	  	= trim(strip_tags(isset($_POST['ProjectStart']) ? $_POST['ProjectStart'] : ''));
				$ProjectDeadline	= trim(strip_tags(isset($_POST['ProjectDeadline']) ? $_POST['ProjectDeadline'] : ''));
				$ProjectNotes		= trim(strip_tags(isset($_POST['ProjectNotes']) ? $_POST['ProjectNotes'] : ''));
				$RequestStatus		= 0;

				$postdata = array(
									'IdClient' 			=> $IdClient,
									'TypeId' 			=> $TypeId,
									'ProjectCurrency' 	=> $ProjectCurrency,
									'ProjectNotes' 		=> $ProjectNotes,
									'ProjectStart' 		=> $ProjectStart,
									'ProjectDeadline' 	=> $ProjectDeadline,
									'RequestStatus' 	=> $RequestStatus,
									'CreatedDate' 		=> $CreatedDate,
									'CreatedUser' 		=> Session::get(IdClient)
								);     
				$this->_dashboard->insert_request_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_REQUEST_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdClient)
								);     
				$this->_dashboard->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successAddRequest', 1);
				Url::redirect('dashboard');
				
			}
		}


    	// DELETED
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-request') {

        		$IdRequest 	= trim(strip_tags(isset($_POST['IdRequest']) ? $_POST['IdRequest'] : ''));

	        	$postdata = array('IdRequest' => $IdRequest);      
				$this->_dashboard->delete_request_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_REQUEST_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdClient)
								);     
				$this->_dashboard->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeleteRequest', 1);
				Url::redirect('dashboard');
		}

		render:

		View::rendertemplate('header-client',$data);
		View::render('client/dashboard/dashboard',$data, $error);
		View::rendertemplate('footer',$data);
	}


	public function about(){	


		View::rendertemplate('header-client',$data);
		View::render('client/dashboard/about',$data);
		View::rendertemplate('footer',$data);
	}

}