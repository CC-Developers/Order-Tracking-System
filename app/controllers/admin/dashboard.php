<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       controllers/dashboard.php
 * @package    Work Order Tracking System
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
		$this->_login = new \models\admin\login();
		$this->_dashboard = new \models\admin\dashboard();
		if(Session::get('loggedin') == false) {
			Url::redirect('admin/login');
		}
	}

	/**
	 * define page title and load template files
	 */
	public function welcome(){	
		
		$data['rows'] 			= $this->_login->get_appname(1);
		$data['get_wo_task'] 	= $this->_dashboard->get_wo_task();
		$data['get_task_count'] = $this->_dashboard->get_task_count();
		$data['invoicecount'] 	= $this->_dashboard->get_invoice_count();
		$data['clientcount'] 	= $this->_dashboard->get_client_count();
		$data['wocount'] 		= $this->_dashboard->get_active_work_order_count();
		$data['employeewocount'] = $this->_dashboard->get_employee_active_work_order_count(Session::get(IdUser));
		$data['get_employee_active_work_order'] = $this->_dashboard->get_employee_active_work_order(Session::get(IdUser));
		$data['get_client_active_request'] = $this->_dashboard->get_client_active_request();
		$data['mailcount'] 		= $this->_dashboard->get_unread_mail_count(Session::get(IdUser));
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		$data['js'] 			= 
			"
			<script src='http://code.highcharts.com/highcharts.js'></script>
			<script src='http://code.highcharts.com/modules/exporting.js'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";


		$data['jq'] 			= //HIGH CHART
			"<script type='text/javascript'>
				$(document).ready(function() {
				$('#all-requests').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
			    var options = {
					chart: {
						renderTo: 'container',
						type: 'column',
						marginRight: 130,
						marginBottom: 25
								},
						title: {
						text: 'Advanced Work Order Tracking System',
						x: -20 //center
								},
						subtitle: {
						text: 'Work Order Statistics',
						x: -20
								},
						xAxis: {
						categories: []
								},
						yAxis: {
						title: {
						text: 'Total Work Order'
									},
						plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
									}]
								},
						tooltip: {
						formatter: function() {
										return + this.y +' <b>'+ this.series.name +'</b>';
									}
								},
						legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						enabled: false,
						borderWidth: 0
								},
						credits: {
						enabled: false
								},
						plotOptions: {
						column: {
						stacking: 'normal',
						dataLabels: {
						enabled: true,
						color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
										}
									}
								},
						series: []
							}
							
							$.getJSON('".DIR."app/core/graph.php', function(json) {
								options.xAxis.categories = json[0]['data'];
								options.series[0] = json[1];
								chart = new Highcharts.Chart(options);
							});
						});
				$(function() { 
					$('#all-workorders').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
			        $('#archive-workorders').dataTable({
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

		// CONVERT REQUEST WORK ORDER DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'activate-request') {


				//DEFINE VARIABLE FOR INSERT TO DB	
        		$CreatedDate 		= date('Y-m-d H:i:s');
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$TypeId 			= trim(strip_tags(isset($_POST['TypeId']) ? $_POST['TypeId'] : ''));
				$ProjectCurrency 	= trim(strip_tags(isset($_POST['ProjectCurrency']) ? $_POST['ProjectCurrency'] : ''));
				$ProjectNotes 		= trim(strip_tags(isset($_POST['ProjectNotes']) ? $_POST['ProjectNotes'] : ''));
				$ProjectStart 		= trim(strip_tags(isset($_POST['ProjectStart']) ? $_POST['ProjectStart'] : ''));
				$ProjectDeadline 	= trim(strip_tags(isset($_POST['ProjectDeadline']) ? $_POST['ProjectDeadline'] : ''));
				$ProjectNotes		= trim(strip_tags(isset($_POST['ProjectNotes']) ? $_POST['ProjectNotes'] : ''));				
				$ProjectProgress 	= 0;
				$ProjectStatus	   	= 1;
				$postdata = array(
									'IdClient' 			=> $IdClient,
									'TypeId' 			=> $TypeId,
									'ProjectProgress' 	=> $ProjectProgress,
									'ProjectStatus' 	=> $ProjectStatus,
									'ProjectCurrency' 	=> $ProjectCurrency,
									'ProjectNotes' 		=> $ProjectNotes,
									'ProjectStart' 		=> $ProjectStart,
									'ProjectDeadline' 	=> $ProjectDeadline,
									'CreatedDate' 		=> $CreatedDate,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_dashboard->insert_project_data($postdata);

				/*
				 *---------------------------------------------------------------
				 * UPDATE REQUEST STATUS
				 *---------------------------------------------------------------
				 */
				$IdRequest 			= trim(strip_tags(isset($_POST['IdRequest']) ? $_POST['IdRequest'] : ''));
        		$RequestStatus	   	= 3; 

        		$requestdata = array('RequestStatus' 		=> $RequestStatus);   
				$where = array('IdRequest' => $IdRequest);     
				$this->_dashboard->update_request_data($requestdata, $where);
        		/*
				 *---------------------------------------------------------------
				 * END UPDATE REQUEST STATUS
				 *---------------------------------------------------------------
				 */


				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_CONVERT_ORDER_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_dashboard->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successResponseRequest', 1);
				Url::redirect('admin/dashboard');
				
		}	

		// APPROVE REQUEST WORK ORDER DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'approve-request') {


				/*
				 *---------------------------------------------------------------
				 * UPDATE REQUEST STATUS
				 *---------------------------------------------------------------
				 */
				$IdRequest 			= trim(strip_tags(isset($_POST['IdRequest']) ? $_POST['IdRequest'] : ''));
        		$RequestStatus	   	= 2; 

        		$requestdata = array('RequestStatus' 		=> $RequestStatus);   
				$where = array('IdRequest' => $IdRequest);     
				$this->_dashboard->update_request_data($requestdata, $where);
        		/*
				 *---------------------------------------------------------------
				 * END UPDATE REQUEST STATUS
				 *---------------------------------------------------------------
				 */


				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_REPSONSE_ORDER_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_dashboard->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successResponseRequest', 1);
				Url::redirect('admin/dashboard');
				
		}	

		// REJECT / CANCEL REQUEST WORK ORDER DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'reject-request') {


				/*
				 *---------------------------------------------------------------
				 * UPDATE REQUEST STATUS
				 *---------------------------------------------------------------
				 */
				$IdRequest 			= trim(strip_tags(isset($_POST['IdRequest']) ? $_POST['IdRequest'] : ''));
        		$RequestStatus	   	= 1; 

        		$requestdata = array('RequestStatus' 		=> $RequestStatus);   
				$where = array('IdRequest' => $IdRequest);     
				$this->_dashboard->update_request_data($requestdata, $where);
        		/*
				 *---------------------------------------------------------------
				 * END UPDATE REQUEST STATUS
				 *---------------------------------------------------------------
				 */


				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_REPSONSE_ORDER_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_dashboard->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successResponseRequest', 1);
				Url::redirect('admin/dashboard');
				
		}	

		render:

		View::rendertemplate('header',$data);
		View::render('admin/dashboard/dashboard',$data);
		View::rendertemplate('footer',$data);
	}

	public function calendar(){	

		$data['get_wo_task'] 	= $this->_dashboard->get_wo_task();
		$data['get_task_count'] = $this->_dashboard->get_task_count();
		$data['mailcount'] 		= $this->_dashboard->get_unread_mail_count(Session::get(IdUser));

		View::rendertemplate('header',$data);
		View::render('admin/dashboard/calendar',$data);
		View::rendertemplate('footer-cal',$data);
	}

	public function about(){	

		$data['get_wo_task'] 	= $this->_dashboard->get_wo_task();
		$data['get_task_count'] = $this->_dashboard->get_task_count();
		$data['mailcount'] 		= $this->_dashboard->get_unread_mail_count(Session::get(IdUser));


		View::rendertemplate('header',$data);
		View::render('admin/dashboard/about',$data);
		View::rendertemplate('footer',$data);
	}

}