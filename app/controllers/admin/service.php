<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/admin/service.php
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
 	\helpers\session as Session,
 	\helpers\password as Password,
 	\helpers\gump as Gump,
 	\helpers\document as Document,
 	\helpers\url as Url;
use Helpers\csrfhelper;

class Service extends \core\controller{

	private $_service;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_service = new \models\admin\service();
		if(Session::get('loggedin') == false) {
			Url::redirect('admin/login');
		}
	}

	/*
	 *---------------------------------------------------------------
	 * INDEX
	 *---------------------------------------------------------------
	 */
	public function index(){

		$data['active_service'] 		= $this->_service->get_service();
		$data['get_wo_task'] 	= $this->_service->get_wo_task();
		$data['get_task_count'] = $this->_service->get_task_count();
		$data['mailcount'] 		= $this->_service->get_unread_mail_count(Session::get(IdUser));
		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() {    
			        $('#all-services').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
		    	});
			</script>";

		View::rendertemplate('header',$data);
		View::render('admin/service/service',$data);
		View::rendertemplate('footer',$data);
	}

	/*
	 *---------------------------------------------------------------
	 * ADD
	 *---------------------------------------------------------------
	 */
	public function add(){

		$data['get_wo_task'] 	= $this->_service->get_wo_task();
		$data['get_task_count'] = $this->_service->get_task_count();
		$data['mailcount'] 		= $this->_service->get_unread_mail_count(Session::get(IdUser));

		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// ADD NEW SERVICE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Add') {
				
				//CHECK IF CODE AND/OR TITLE EXIST
				$data['check_code'] = $this->_service->check_code($_POST['TypeCode']);
				$data['check_name'] = $this->_service->check_name($_POST['TypeTitle']);
				
				if(empty($_POST['TypeCode'])) {
					$error[] = _ERROR_CODE_LANG_;
				} else if(empty($_POST['TypeTitle'])) {
					$error[] = _ERROR_TITLE_LANG_;
				} else if($_POST['TypeDesc'] == "") {
					$error[] = _ERROR_DESC_LANG_;
    			} else if($data['check_code'] > 0) {
					$error[] = _ERROR_EXIST_CODE_LANG_;
				} else if ($data['check_name'] > 0){
					$error[] = _ERROR_EXIST_TITLE_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 		= date('Y-m-d H:i:s');
				$TypeCode	   		= trim(strip_tags(isset($_POST['TypeCode']) ? $_POST['TypeCode'] : ''));
				$TypeTitle	  		= trim(strip_tags(isset($_POST['TypeTitle']) ? $_POST['TypeTitle'] : ''));
				$TypeDesc		   	= trim(strip_tags(isset($_POST['TypeDesc']) ? $_POST['TypeDesc'] : ''));
				$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));

						$postdata = array(
											'TypeTitle' 		=> $TypeTitle,
											'TypeCode' 			=> $TypeCode,
											'TypeDesc' 			=> $TypeDesc,
											'IsActive' 			=> $IsActive,
											'CreatedDate' 		=> $CreatedDate,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_service->insert_service_data($postdata);

						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_SERVICE_;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_service->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */

						Session::set('successAddService', 1);

						Url::redirect('admin/service');
				
				}
		}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/service/add',$data, $error);
		View::rendertemplate('footer',$data);
	}

	/*
	 *---------------------------------------------------------------
	 * VIEW
	 *---------------------------------------------------------------
	 */
	public function view($id){

		$data['get_wo_task'] 	= $this->_service->get_wo_task();
		$data['get_task_count'] = $this->_service->get_task_count();
		$data['mailcount'] 		= $this->_service->get_unread_mail_count(Session::get(IdUser));
		$data['rows'] 					= $this->_service->view_service($id);
		$data['get_service_wo_count'] 	= $this->_service->get_service_wo_count($id);
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

        if ($data['rows']){
            foreach ($data['rows'] as $row) {
            	$data['TypeId'] 			= $row->TypeId;
				$data['TypeTitle'] 			= $row->TypeTitle;
				$data['TypeCode'] 			= $row->TypeCode;
				$data['TypeDesc'] 			= $row->TypeDesc;
				$data['IsActive']			= $row->IsActive;
				$data['LastUpdateDate']		= $row->LastUpdateDate;
				$data['nLastUpdateDate']	= $row->nLastUpdateDate;
				$data['LastUpdateUser']		= $row->LastUpdateUser;
				$data['CreatedDate']		= $row->CreatedDate;
				$data['nCreatedDate']		= $row->nCreatedDate;
				$data['CreatedUser']		= $row->CreatedUser;
				$data['FullName']			= $row->FullName;
            }
        }

        if ($id != $row->TypeId) {
        	Session::set('InvalidService', 1);
        }

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

        // DELETED
        if (isset($_POST['submit']) && $_POST['submit'] == 'x') {
        	if ($data['get_service_wo_count'] > 0) {
        		$error[] = _NO_ASSOCIATE_WORK_ORDER_DATA_LANG_;
        	} else {
        		$postdata = array('TypeId' => $id);      
				$this->_service->delete_service_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_SERVICE_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_service->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeletedService', 1);
				Url::redirect('admin/service');
        	}
        }


        // UPDATE WORK ORDER TYPE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {

				//CHECK IF CODE AND/OR TITLE EXIST
				$data['check_code'] = $this->_service->check_code($_POST['TypeCode']);
				$data['check_name'] = $this->_service->check_name($_POST['TypeTitle']);

				if($_POST['TypeDesc'] == "") {
					$error[] = _ERROR_DESC_LANG_;
    			} else if($data['check_code'] > 0) {
					$error[] = _ERROR_EXIST_CODE_LANG_;
				} else if ($data['check_name'] > 0){
					$error[] = _ERROR_EXIST_TITLE_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdatedDate 		= date('Y-m-d H:i:s');
				$TypeId		   		= trim(strip_tags(isset($_POST['TypeId']) ? $_POST['TypeId'] : ''));
				$TypeDesc		   	= trim(strip_tags(isset($_POST['TypeDesc']) ? $_POST['TypeDesc'] : ''));
				$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));

				if(isset($_POST['TypeCode']) && $_POST['TypeCode'] != "") {
            		$TypeCode = isset($_POST['TypeCode']) ? $_POST['TypeCode'] : '';
	            } else {
	                $TypeCode = isset($_POST['TypeCodeOld']) ? $_POST['TypeCodeOld'] : '';
	            }

	            if(isset($_POST['TypeTitle']) && $_POST['TypeTitle'] != "") {
            		$TypeTitle = isset($_POST['TypeTitle']) ? $_POST['TypeTitle'] : '';
	            } else {
	                $TypeTitle = isset($_POST['TypeTitleOld']) ? $_POST['TypeTitleOld'] : '';
	            }

				$postdata = array(
									'TypeTitle' 		=> $TypeTitle,
									'TypeCode' 			=> $TypeCode,
									'TypeDesc' 			=> $TypeDesc,
									'IsActive' 			=> $IsActive,
									'LastUpdateDate' 	=> $UpdatedDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);   
					$where = array('TypeId' => $TypeId);     
					$this->_service->update_service_data($postdata, $where);

					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_SERVICE_;

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_service->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */

					Session::set('successUpdatedService', 1);
					Url::redirect('admin/service/view/'.$TypeId);
					
				}
			}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/service/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}