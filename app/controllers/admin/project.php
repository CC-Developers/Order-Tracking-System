<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       controllers/admin/project.php
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
 	\helpers\session as Session,
 	\helpers\password as Password,
 	\helpers\document as Document,
 	\helpers\gump as Gump,
 	\helpers\url as Url;
use Helpers\csrfhelper;

class Project extends \core\controller{

	private $_project;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_project = new \models\admin\project();
		if(Session::get('loggedin') == false) {
			Url::redirect('admin/login');
		}
	}

	public function index(){

		$data['get_wo_task'] 			= $this->_project->get_wo_task();
		$data['get_task_count'] 		= $this->_project->get_task_count();
		$data['mailcount'] 				= $this->_project->get_unread_mail_count(Session::get(IdUser));
		$data['get_project'] 			= $this->_project->get_project();
		$data['get_project_archived'] 	= $this->_project->get_project_archived();
		$data['js'] 			=
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
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

		View::rendertemplate('header',$data);
		View::render('admin/project/project',$data);
		View::rendertemplate('footer',$data);
	}

	/*
	 *---------------------------------------------------------------
	 * ADD
	 *---------------------------------------------------------------
	 */
	public function add(){

		$data['get_wo_task'] 	= $this->_project->get_wo_task();
		$data['get_task_count'] = $this->_project->get_task_count();
		$data['mailcount'] 		= $this->_project->get_unread_mail_count(Session::get(IdUser));
		$data['client_lists'] 	= $this->_project->get_client_list();
		$data['service_lists'] 	= $this->_project->get_service_list();
		$data['currency_lists'] = $this->_project->get_currency_list();
		$data['phase_lists'] 	= $this->_project->get_phase_list();

		$data['owner_info'] 			= $this->_project->get_owner(1);

		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		if ($data['owner_info']) {
            foreach ($data['owner_info'] as $row) {
               $data['appName'] 	= $row->appName;
               $data['ownerName'] 	= $row->ownerName;
               $data['ownerAddress'] = $row->ownerAddress;
               $data['ownerEmail'] 	= $row->ownerEmail;
               $data['ownerPhone'] 	= $row->ownerPhone;
            }
        }

		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/bootstrap-datepicker.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() { 
					$('#ProjectStart').datepicker({
				    format: 'yyyy-mm-dd'
					});   
				$('#ProjectDeadline').datepicker({
				    format: 'yyyy-mm-dd'
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

		// ADD NEW WORK ORDER DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Add') {

				if(empty($_POST['ProjectStatus'])) {
					$error[] = _ERROR_PROJECT_STATUS_LANG_;
				} else if(empty($_POST['ProjectStart'])) {
					$error[] = _ERROR_PROJECT_START_LANG_;
				} else if(empty($_POST['ProjectDeadline'])) {
					$error[] = _ERROR_PROJECT_DEADLINE_LANG_;
				} else if($_POST['IdClient'] == "++") {
					$error[] = _ERROR_PROJECT_CLIENT_LANG_;
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
				$ProjectProgress 	= 0;
				$TypeId 			= trim(strip_tags(isset($_POST['TypeId']) ? $_POST['TypeId'] : ''));
				$ProjectCurrency 	= trim(strip_tags(isset($_POST['ProjectCurrency']) ? $_POST['ProjectCurrency'] : ''));
				$ProjectStatus	   	= trim(strip_tags(isset($_POST['ProjectStatus']) ? $_POST['ProjectStatus'] : ''));
				$ProjectStart	  	= trim(strip_tags(isset($_POST['ProjectStart']) ? $_POST['ProjectStart'] : ''));
				$ProjectDeadline	= trim(strip_tags(isset($_POST['ProjectDeadline']) ? $_POST['ProjectDeadline'] : ''));
				$ProjectNotes		= trim(strip_tags(isset($_POST['ProjectNotes']) ? $_POST['ProjectNotes'] : ''));

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
				$this->_project->insert_project_data($postdata);

				//GET CLIENT EMAIL
				$data['get_client_email'] = $this->_project->get_client_email($IdClient);
				if ($data['get_client_email']){
	            	foreach ($data['get_client_email'] as $clientEmail) {
	            		$data['EmailClient'] 		= $clientEmail->Email;
	            	}
	            }

				$mail = new \helpers\phpmailer\mail();
			    $mail->setFrom($data['ownerEmail']);
			    $mail->addAddress($data['EmailClient']);
			    $mail->subject('You have new Work Order with : '.$data['ownerName']);
				$mail->body(
								'You have new Work Order : '.WO_CODE.$IdProject
				    		);
			    if(!$mail->Send()) {

					$error[] = $mail->ErrorInfo;

				} else {
					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_PROJECT_;

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_project->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					Session::set('successAddProject', 1);
					Url::redirect('admin/project');
				
				}
			}
		}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/project/add',$data, $error);
		View::rendertemplate('footer',$data);
	}

	public function view($id){

		$data['get_wo_task'] 				= $this->_project->get_wo_task();
		$data['get_task_count'] 			= $this->_project->get_task_count();
		$data['mailcount'] 					= $this->_project->get_unread_mail_count(Session::get(IdUser));
		$data['get_wo_task_project'] 		= $this->_project->get_wo_task_project($id);
		$data['get_wo_schedule_project'] 	= $this->_project->get_wo_schedule_project($id);
		$data['get_wo_member'] 				= $this->_project->get_wo_member($id);
		$data['get_wo_invoice'] 			= $this->_project->get_wo_invoice($id);
		$data['get_wo_finance'] 			= $this->_project->get_wo_finance($id);
		$data['get_wo_attachment'] 			= $this->_project->get_wo_attachment($id);
		$data['taskcount'] 					= $this->_project->get_task_wo_count($id);
		$data['get_task_complete_count'] 	= $this->_project->get_task_complete_count($id);
		$data['membercount'] 				= $this->_project->get_members_wo_count($id);
		$data['invoicecount'] 				= $this->_project->get_invoices_wo_count($id);
		$data['paymentcount'] 				= $this->_project->get_payments_wo_count($id);
		$data['wodata'] 					= $this->_project->get_wo($id);

		$data['owner_info'] 			= $this->_project->get_owner(1);

		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		if ($data['owner_info']) {
            foreach ($data['owner_info'] as $row) {
               $data['appName'] 	= $row->appName;
               $data['ownerName'] 	= $row->ownerName;
               $data['ownerAddress'] = $row->ownerAddress;
               $data['ownerEmail'] 	= $row->ownerEmail;
               $data['ownerPhone'] 	= $row->ownerPhone;
            }
        }

		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/bootstrap-datepicker.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/bootstrap-slider/bootstrap-slider.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/timepicker/bootstrap-timepicker.min.js' type='text/javascript'></script>
			";
		$data['jq'] 			= 
			"<script type='text/javascript'>
				$(function() { 
				    $('#chat-box').slimScroll({
				        height: '250px'
				    });	
					$('.slider').slider();			     
					$('.datepicker').datepicker({
				    	format: 'yyyy-mm-dd'
					}); 
					 $('.timepicker').timepicker({
                    	showInputs: false
               		 });
					$('#all-members').dataTable({
			            'bPaginate': false,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
					$('#all-finances').dataTable({
			            'bPaginate': false,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
					$('#all-attachments').dataTable({
			            'bPaginate': false,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
		    	});
			</script>";
		$data['user_lists'] 	= $this->_project->get_user_list();
		$data['role_lists'] 	= $this->_project->get_role_list();
		$data['client_lists'] 	= $this->_project->get_client_list();
		$data['service_lists'] 	= $this->_project->get_service_list();
		$data['currency_lists'] = $this->_project->get_currency_list();
		$data['phase_lists'] 	= $this->_project->get_phase_list();
		$data['wocomplete'] 	= $this->_project->get_wo_complete_count($id);

		if (Session::get('Level') == 3) {

			$data['get_member_access'] 	= $this->_project->get_member_access($id);

			if ($data['get_member_access']){
	            foreach ($data['get_member_access'] as $member) {
	            	$data['IdMember'] 		= $member->IdMember;
					$data['MemberProject'] 	= $member->MemberProject;
					$data['MemberId'] 		= $member->MemberId;
					$data['RoleId'] 		= $member->RoleId;
					$data['IdProject'] 		= $member->IdProject;
					$data['IdUser'] 		= $member->IdUser;
					$data['MemberName'] 	= $member->MemberName;
					$data['Level'] 			= $member->Level;
					$data['RoleId'] 		= $member->RoleId;
					$data['RoleName'] 		= $member->RoleName;
					$data['RoleDesc'] 		= $member->RoleDesc;
					$data['RoleId'] 		= $member->RoleId;
					$data['RoleName'] 		= $member->RoleName;
					$data['RoleDesc'] 		= $member->RoleDesc;
					$data['IsActive'] 		= $member->IsActive;
					$data['GeneralEdit'] 	= $member->GeneralEdit;
					$data['TaskView'] 		= $member->TaskView;
					$data['TaskCreate'] 	= $member->TaskCreate;
					$data['TaskEdit'] 		= $member->TaskEdit;
					$data['TaskDelete'] 	= $member->TaskDelete;
					$data['ScheduleView'] 	= $member->ScheduleView;
					$data['ScheduleCreate'] = $member->ScheduleCreate;
					$data['ScheduleEdit'] 	= $member->ScheduleEdit;
					$data['ScheduleDelete'] = $member->ScheduleDelete;
					$data['MemberView'] 	= $member->MemberView;
					$data['MemberCreate'] 	= $member->MemberCreate;
					$data['MemberEdit'] 	= $member->MemberEdit;
					$data['MemberDelete'] 	= $member->MemberDelete;
					$data['FinanceView'] 	= $member->FinanceView;
					$data['FinanceCreate'] 	= $member->FinanceCreate;
					$data['FinanceEdit'] 	= $member->FinanceEdit;
					$data['FinanceDelete'] 	= $member->FinanceDelete;
					$data['AttachmentView'] = $member->AttachmentView;
					$data['AttachmentCreate'] 	= $member->AttachmentCreate;
					$data['AttachmentEdit'] 	= $member->AttachmentEdit;
					$data['AttachmentDelete'] 	= $member->AttachmentDelete;
					$data['InvoiceView'] 		= $member->InvoiceView;
					$data['InvoiceCreate'] 		= $member->InvoiceCreate;
					$data['InvoiceEdit'] 		= $member->InvoiceEdit;
					$data['InvoiceDelete'] 		= $member->InvoiceDelete;
					$data['InvoiceGenerate'] 	= $member->InvoiceGenerate;
					$data['InvoiceSendMail'] 	= $member->InvoiceSendMail;
					$data['PaymentCreate'] 		= $member->PaymentCreate;
					$data['PaymentEdit'] 		= $member->PaymentEdit;
					$data['PaymentDelete'] 		= $member->PaymentDelete;
					$data['ItemCreate'] 		= $member->ItemCreate;
					$data['ItemEdit'] 			= $member->ItemEdit;
					$data['ItemDelete'] 		= $member->ItemDelete;
	            }
	        } else {
	        	Session::set('InvalidAccessProject', 1);
	        }
        
        }

		$data['rows'] 			= $this->_project->view_project($id);

        if ($data['rows']){
            foreach ($data['rows'] as $row) {
            	$data['IdProject'] 			= $row->IdProject;
				$data['IdClient'] 			= $row->IdClient;
				$data['TypeId'] 			= $row->TypeId;
				$data['ProjectProgress'] 	= $row->ProjectProgress;
				$data['ProjectStatus'] 		= $row->ProjectStatus;
				$data['ProjectCurrency'] 	= $row->ProjectCurrency;
				$data['ProjectNotes'] 		= $row->ProjectNotes;
				$data['ProjectStart'] 		= $row->ProjectStart;
				$data['nProjectStart'] 		= $row->nProjectStart;
				$data['ProjectDeadline'] 	= $row->ProjectDeadline;
				$data['nProjectDeadline'] 	= $row->nProjectDeadline;
				$data['LastUpdateDate'] 	= $row->LastUpdateDate;
				$data['nLastUpdateDate'] 	= $row->nLastUpdateDate;
				$data['LastUpdateUser'] 	= $row->LastUpdateUser;
				$data['CreatedDate'] 		= $row->CreatedDate;
				$data['nCreatedDate'] 		= $row->nCreatedDate;
				$data['CreatedUser'] 		= $row->CreatedUser;
				$data['isArchived'] 		= $row->isArchived;
				$data['archiveDate'] 		= $row->archiveDate;
				$data['narchiveDate'] 		= $row->narchiveDate;
				$data['IsComplete'] 		= $row->IsComplete;
				$data['TaskProgress'] 		= $row->TaskProgress;
				$data['IdClient'] 			= $row->IdClient;
				$data['ClientName'] 		= $row->ClientName;
				$data['TypeId'] 			= $row->TypeId;
				$data['TypeCode'] 			= $row->TypeCode;
				$data['TypeTitle'] 			= $row->TypeTitle;
				$data['CurrencyId'] 		= $row->CurrencyId;
				$data['CurrencyName'] 		= $row->CurrencyName;
				$data['CurrencySymbol'] 	= $row->CurrencySymbol;
				$data['PhaseId'] 			= $row->PhaseId;
				$data['PhaseName'] 			= $row->PhaseName;
				$data['PhaseColor'] 		= $row->PhaseColor;
				$data['IdUser'] 			= $row->IdUser;
				$data['AdminName'] 			= $row->AdminName;
            }
        }

        if ($id != $row->IdProject) {
        	Session::set('InvalidProject', 1);
        }

        $data['get_setting'] 	= $this->_project->get_upload_path_files_allowed();

        if ($data['get_setting']){
            foreach ($data['get_setting'] as $setting) {
            	$data['uploadPath'] 	= $setting->uploadPath;
				$data['filesAllowed'] 	= $setting->filesAllowed;
			}
		}

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

        // UPDATE WORK ORDER
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-wo') {
        		if(empty($_POST['ProjectStatus'])) {
					$error[] = _ERROR_PROJECT_STATUS_LANG_;
				} else if(empty($_POST['ProjectStart'])) {
					$error[] = _ERROR_PROJECT_START_LANG_;
				} else if(empty($_POST['ProjectDeadline'])) {
					$error[] = _ERROR_PROJECT_DEADLINE_LANG_;
				} else if($_POST['IdClient'] == "++") {
					$error[] = _ERROR_PROJECT_CLIENT_LANG_;
				} else if($_POST['TypeId'] == "++") {
					$error[] = _ERROR_PROJECT_TYPE_LANG_;
				} else if($_POST['ProjectCurrency'] == "++") {
					$error[] = _ERROR_PROJECT_CURRENCY_LANG_;
				} else if($_POST['ProjectStart'] > $_POST['ProjectDeadline']) {
					$error[] = _ERROR_PROJECT_START_DEADLINE_LANG_;
				} else {

					//DEFINE VARIABLE FOR INSERT TO DB	
					$LastUpdateDate 	= date('Y-m-d H:i:s');
					$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
					$ProjectProgress 	= 0;
					$TypeId 			= trim(strip_tags(isset($_POST['TypeId']) ? $_POST['TypeId'] : ''));
					$ProjectCurrency 	= trim(strip_tags(isset($_POST['ProjectCurrency']) ? $_POST['ProjectCurrency'] : ''));
					$ProjectStatus	   	= trim(strip_tags(isset($_POST['ProjectStatus']) ? $_POST['ProjectStatus'] : ''));
					$ProjectStart	  	= trim(strip_tags(isset($_POST['ProjectStart']) ? $_POST['ProjectStart'] : ''));
					$ProjectDeadline	= trim(strip_tags(isset($_POST['ProjectDeadline']) ? $_POST['ProjectDeadline'] : ''));
					$ProjectNotes		= trim(strip_tags(isset($_POST['ProjectNotes']) ? $_POST['ProjectNotes'] : ''));
					$IsComplete			= trim(strip_tags(isset($_POST['IsComplete']) ? $_POST['IsComplete'] : ''));

					$postdata = array(
										'TypeId' 			=> $TypeId,
										'ProjectProgress' 	=> $ProjectProgress,
										'ProjectStatus' 	=> $ProjectStatus,
										'ProjectCurrency' 	=> $ProjectCurrency,
										'ProjectNotes' 		=> $ProjectNotes,
										'ProjectStart' 		=> $ProjectStart,
										'ProjectDeadline' 	=> $ProjectDeadline,
										'LastUpdateDate' 	=> $LastUpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName),
										'IsComplete'		=> $IsComplete
									);     
					$where = array('IdProject' => $IdProject);     
					$this->_project->update_project_data($postdata, $where);
					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_PROJECT_. ' ' .WO_CODE.$IdProject;

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_project->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					Session::set('successUpdatedProject', 1);
					Url::redirect('admin/project/view/'.$IdProject);
        		}
    	}

    	// ARCHIVE
        if (isset($_POST['submit']) && $_POST['submit'] == 'archive-wo') {
        	if ($data['wocomplete'] > 0) {
        		$error[] = 'Sorry, This Work Order is NOT COMPLETED !, cannot Archived. !';
        	} else if ($data['get_task_complete_count'] > 0) {
        		$error[] = 'Sorry, This Work Order have active Tasks !, cannot Archived. !';
        	} else {
        		$isArchived 		= '1';
	        	$archiveDate 		= date('Y-m-d');
	        	$UpdateDate 		= date('Y-m-d H:i:s');
	        	$postdata = array(
									'LastUpdateDate' 	=> $UpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName),
									'isArchived' 		=> $isArchived,
									'archiveDate' 		=> $archiveDate
								);   
				$where = array('IdProject' => $id);     
				$this->_project->update_project_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ARCHIVE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successArchivedProject', 1);
				Url::redirect('admin/project/view/'.$id);
        	}
        }


        // UNARCHIVE
        if (isset($_POST['submit']) && $_POST['submit'] == 'unarchive-wo') {
        	$isArchived 		= '0';
        	$archiveDate 		= '000-00-00';
        	$UpdateDate 		= date('Y-m-d H:i:s');
        	$postdata = array(
								'LastUpdateDate' 	=> $UpdateDate,
								'LastUpdateUser' 	=> Session::get(FullName),
								'isArchived' 		=> $isArchived,
								'archiveDate' 		=> $archiveDate
							);   
			$where = array('IdProject' => $id);     
			$this->_project->update_project_data($postdata, $where);
			/*
			 *---------------------------------------------------------------
			 * AUDIT TRAILS
			 *---------------------------------------------------------------
			 */
			$CreatedDate 		= date('Y-m-d H:i:s');
			$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UNARCHIVE_PROJECT_. ' ' .WO_CODE.$IdProject;

		    $auditdata = array(
								'CreatedDate' 		=> $CreatedDate,
								'AuditContent' 		=> $AuditContent,
								'CreatedUser' 		=> Session::get(IdUser)
							);     
			$this->_project->insert_audit_data($auditdata);
			/*
			 *---------------------------------------------------------------
			 * END AUDIT TRAILS
			 *---------------------------------------------------------------
			 */
			Session::set('successUnarchivedProject', 1);
			Url::redirect('admin/project/view/'.$id);
        }

        // DELETED
        if (isset($_POST['submit']) && $_POST['submit'] == 'x') {
        	if ($data['wocomplete'] > 0) {
        		$error[] = 'Sorry, This Work Order is NOT COMPLETED !, cannot Deleted. !';
        	} else {
	        	$postdata = array('IdProject' => $id);      
				$this->_project->delete_project_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeletedProject', 1);
				Url::redirect('admin/project');
			}
        }	

        /*
		 *---------------------------------------------------------------
		 * WORK ORDER TASKS
		 *---------------------------------------------------------------
		 */

        // ADD NEW TASK DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-task') {

				if(empty($_POST['TaskDesc'])) {
					$error[] = 'Please enter Work Order Task Title. !';
				} else if(empty($_POST['TaskDate'])) {
					$error[] = 'Please enter Work Order Task Start Date. !';
				} else if(empty($_POST['TaskDueDate'])) {
					$error[] = 'Please enter Work Order Task Deadline. !';
				} else if(empty($_POST['TaskNotes'])) {
					$error[] = 'Please enter Work Order Task Notes. !';
				} else if($_POST['TaskDate'] > $_POST['TaskDueDate']) {
					$error[] = 'Task Due Date should not be less than Task Date . !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 	= date('Y-m-d H:i:s');
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$TaskProgress 	= 0;
				$TaskDesc	   	= trim(strip_tags(isset($_POST['TaskDesc']) ? $_POST['TaskDesc'] : ''));
				$TaskDate	  	= trim(strip_tags(isset($_POST['TaskDate']) ? $_POST['TaskDate'] : ''));
				$TaskDueDate	= trim(strip_tags(isset($_POST['TaskDueDate']) ? $_POST['TaskDueDate'] : ''));
				$TaskNotes		= trim(strip_tags(isset($_POST['TaskNotes']) ? $_POST['TaskNotes'] : ''));

				$postdata = array(
									'IdProject' 	=> $IdProject,
									'IdClient' 		=> $IdClient,
									'TaskDesc' 		=> $TaskDesc,
									'TaskDate' 		=> $TaskDate,
									'TaskDueDate' 	=> $TaskDueDate,
									'TaskNotes' 	=> $TaskNotes,
									'TaskProgress' 	=> $TaskProgress,
									'CreatedDate' 	=> $CreatedDate,
									'CreatedUser' 	=> Session::get(IdUser)
								);     
				$this->_project->insert_task_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_TASK_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successAddTask', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// UPDATE TASK DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-wo-task') {

				if(empty($_POST['TaskDesc'])) {
					$error[] = 'Please enter Work Order Task Title. !';
				} else if(empty($_POST['TaskDate'])) {
					$error[] = 'Please enter Work Order Task Start Date. !';
				} else if(empty($_POST['TaskDueDate'])) {
					$error[] = 'Please enter Work Order Task Deadline. !';
				} else if(empty($_POST['TaskNotes'])) {
					$error[] = 'Please enter Work Order Task Notes. !';
				} else if($_POST['TaskDate'] > $_POST['TaskDueDate']) {
					$error[] = 'Task Due Date should not be less than Task Date . !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdatedDate 	= date('Y-m-d H:i:s');
				$IdTask 		= trim(strip_tags(isset($_POST['IdTask']) ? $_POST['IdTask'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$TaskProgress 	= trim(strip_tags(isset($_POST['TaskProgress']) ? $_POST['TaskProgress'] : ''));
				$TaskDesc	   	= trim(strip_tags(isset($_POST['TaskDesc']) ? $_POST['TaskDesc'] : ''));
				$TaskDate	  	= trim(strip_tags(isset($_POST['TaskDate']) ? $_POST['TaskDate'] : ''));
				$TaskDueDate	= trim(strip_tags(isset($_POST['TaskDueDate']) ? $_POST['TaskDueDate'] : ''));
				$TaskNotes		= trim(strip_tags(isset($_POST['TaskNotes']) ? $_POST['TaskNotes'] : ''));

				$postdata = array(
									'TaskDesc' 			=> $TaskDesc,
									'TaskDate' 			=> $TaskDate,
									'TaskDueDate' 		=> $TaskDueDate,
									'TaskNotes' 		=> $TaskNotes,
									'TaskProgress' 		=> $TaskProgress,
									'LastUpdateDate' 	=> $UpdatedDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);  
				$where = array('IdTask' => $IdTask);  
				$this->_project->update_task_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_TASK_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdateTask', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// DELETE TASK DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-wo-task') {

        		$IdTask 		= trim(strip_tags(isset($_POST['IdTask']) ? $_POST['IdTask'] : ''));
        		$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));

	        	$postdata = array('IdTask' => $IdTask);      
				$this->_project->delete_task_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_TASK_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeleteTask', 1);
				Url::redirect('admin/project/view/'.$IdProject);

        }

        /*
		 *---------------------------------------------------------------
		 * WORK ORDER SCHEDULE
		 *---------------------------------------------------------------
		 */

        // ADD NEW SCHEDULE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-schedule') {

				if(empty($_POST['ScheduleDesc'])) {
					$error[] = 'Please enter Work Order Schedule Title. !';
				} else if(empty($_POST['ScheduleTimeStart'])) {
					$error[] = 'Please enter Work Order Schedule Start Time. !';
				} else if(empty($_POST['ScheduleTimeEnd'])) {
					$error[] = 'Please enter Work Order Schedule End Time. !';
				} else if(empty($_POST['ScheduleDueDate'])) {
					$error[] = 'Please enter Work Order Schedule Deadline. !';
				} else if(empty($_POST['ScheduleNotes'])) {
					$error[] = 'Please enter Work Order Schedule Notes. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 	= date('Y-m-d H:i:s');
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$ScheduleDesc	= trim(strip_tags(isset($_POST['ScheduleDesc']) ? $_POST['ScheduleDesc'] : ''));
				$ScheduleTimeStart	= trim(strip_tags(isset($_POST['ScheduleTimeStart']) ? $_POST['ScheduleTimeStart'] : ''));
				$ScheduleTimeEnd	= trim(strip_tags(isset($_POST['ScheduleTimeEnd']) ? $_POST['ScheduleTimeEnd'] : ''));
				$ScheduleDueDate	= trim(strip_tags(isset($_POST['ScheduleDueDate']) ? $_POST['ScheduleDueDate'] : ''));
				$ScheduleNotes		= trim(strip_tags(isset($_POST['ScheduleNotes']) ? $_POST['ScheduleNotes'] : ''));

				$postdata = array(
									'IdProject' 	=> $IdProject,
									'IdClient' 		=> $IdClient,
									'ScheduleDesc' 	=> $ScheduleDesc,
									'ScheduleTimeStart' => $ScheduleTimeStart,
									'ScheduleTimeEnd' 	=> $ScheduleTimeEnd,
									'ScheduleDueDate' 	=> $ScheduleDueDate,
									'ScheduleNotes' 	=> $ScheduleNotes,
									'CreatedDate' 	=> $CreatedDate,
									'CreatedUser' 	=> Session::get(IdUser)
								);     
				$this->_project->insert_schedule_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_SCHEDULE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successAddSchedule', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// UPDATE SCHEDULE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-wo-schedule') {

				if(empty($_POST['ScheduleDesc'])) {
					$error[] = 'Please enter Work Order Schedule Title. !';
				} else if(empty($_POST['ScheduleTimeStart'])) {
					$error[] = 'Please enter Work Order Schedule Start Time. !';
				} else if(empty($_POST['ScheduleTimeEnd'])) {
					$error[] = 'Please enter Work Order Schedule End Time. !';
				} else if(empty($_POST['ScheduleDueDate'])) {
					$error[] = 'Please enter Work Order Schedule Deadline. !';
				} else if(empty($_POST['ScheduleNotes'])) {
					$error[] = 'Please enter Work Order Schedule Notes. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdatedDate 	= date('Y-m-d H:i:s');
				$IdSchedule 	= trim(strip_tags(isset($_POST['IdSchedule']) ? $_POST['IdSchedule'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$ScheduleDesc	= trim(strip_tags(isset($_POST['ScheduleDesc']) ? $_POST['ScheduleDesc'] : ''));
				$ScheduleTimeStart	= trim(strip_tags(isset($_POST['ScheduleTimeStart']) ? $_POST['ScheduleTimeStart'] : ''));
				$ScheduleTimeEnd	= trim(strip_tags(isset($_POST['ScheduleTimeEnd']) ? $_POST['ScheduleTimeEnd'] : ''));
				$ScheduleDueDate	= trim(strip_tags(isset($_POST['ScheduleDueDate']) ? $_POST['ScheduleDueDate'] : ''));
				$ScheduleNotes		= trim(strip_tags(isset($_POST['ScheduleNotes']) ? $_POST['ScheduleNotes'] : ''));
				$IsFinish			= trim(strip_tags(isset($_POST['IsFinish']) ? $_POST['IsFinish'] : ''));

				$postdata = array(
									'IdProject' 	=> $IdProject,
									'IdClient' 		=> $IdClient,
									'ScheduleDesc' 	=> $ScheduleDesc,
									'ScheduleTimeStart' => $ScheduleTimeStart,
									'ScheduleTimeEnd' 	=> $ScheduleTimeEnd,
									'ScheduleDueDate' 	=> $ScheduleDueDate,
									'ScheduleNotes' 	=> $ScheduleNotes,
									'IsFinish' 			=> $IsFinish,
									'LastUpdateDate' 	=> $UpdatedDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);  
				$where = array('IdSchedule' => $IdSchedule);  
				$this->_project->update_schedule_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_SCHEDULE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdateSchedule', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// DELETE SCHEDULE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-wo-schedule') {

        		$IdSchedule 	= trim(strip_tags(isset($_POST['IdSchedule']) ? $_POST['IdSchedule'] : ''));
        		$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));

	        	$postdata = array('IdSchedule' => $IdSchedule);      
				$this->_project->delete_schedule_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_SCHEDULE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeleteSchedule', 1);
				Url::redirect('admin/project/view/'.$IdProject);

        }

         /*
		 *---------------------------------------------------------------
		 * WORK ORDER MEMBERS
		 *---------------------------------------------------------------
		 */

        // ADD NEW MEMBER DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-member') {

        		//CHECK IF MEMBER WITH SELECTED ROLE EXIST
				$data['check_user_available'] = $this->_project->check_user_available($_POST['IdProject'], $_POST['IdUser']);

				if($_POST['IdUser'] == "++") {
					$error[] = 'Please select work order member. !';
				} else if($_POST['RoleId'] == "++") {
					$error[] = 'Please select member role. !';
				} else if ($data['check_user_available'] > 0){
					$error[] = 'Sorry, Member already have role. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 	= date('Y-m-d H:i:s');
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdUser 		= trim(strip_tags(isset($_POST['IdUser']) ? $_POST['IdUser'] : ''));
				$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$RoleId		   	= trim(strip_tags(isset($_POST['RoleId']) ? $_POST['RoleId'] : ''));

				$postdata = array(
									'IdProject' 	=> $IdProject,
									'IdUser' 		=> $IdUser,
									'RoleId' 		=> $RoleId,
									'IdClient' 		=> $IdClient,
									'CreatedDate' 	=> $CreatedDate,
									'CreatedUser' 	=> Session::get(IdUser)
								);     
				$this->_project->insert_member_data($postdata);

				//GET MEMBER EMAIL
				$data['get_user_email'] = $this->_project->get_user_email($IdUser);
				if ($data['get_user_email']){
	            	foreach ($data['get_user_email'] as $memberEmail) {
	            		$data['Email'] 		= $memberEmail->Email;
	            	}
	            }

				$mail = new \helpers\phpmailer\mail();
			    $mail->setFrom($data['ownerEmail']);
			    $mail->addAddress($data['Email']);
			    $mail->subject('You have a new Role at Team Member Work Order at : '.$data['appName']);
				$mail->body(
								'You have a new Role at Team Member Work Order : '.WO_CODE.$IdProject
				    		);
			    if(!$mail->Send()) {

					$error[] = $mail->ErrorInfo;

				} else {

					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_MEMBER_PROJECT_. ' ' .WO_CODE.$IdProject;

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_project->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					Session::set('successAddMember', 1);
					Url::redirect('admin/project/view/'.$IdProject);
				}
				
			}
		}


		// DELETE MEMBER DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-wo-member') {

        		$IdMember 		= trim(strip_tags(isset($_POST['IdMember']) ? $_POST['IdMember'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));

	        	$postdata = array('IdMember' => $IdMember);      
				$this->_project->delete_member_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_MEMBER_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeleteMember', 1);
				Url::redirect('admin/project/view/'.$IdProject);

        }

        /*
		 *---------------------------------------------------------------
		 * WORK ORDER FINANCES
		 *---------------------------------------------------------------
		 */

        // ADD NEW INCOME DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-income') {

				if(empty($_POST['FinanceTitle'])) {
					$error[] = 'Please enter Work Order Income Title. !';
				} else if(empty($_POST['FinanceDesc'])) {
					$error[] = 'Please enter Work Order Income Description. !';
				} else if(empty($_POST['FinanceDate'])) {
					$error[] = 'Please enter Work Order Income Date. !';
				} else if(!filter_var($_POST['FinanceAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = 'Income Amount be a Number. !';
				} else if(empty($_POST['FinanceAmount'])) {
					$error[] = 'Please enter Work Order Income Amount. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 	= date('Y-m-d H:i:s');
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$FinanceTitle 	= trim(strip_tags(isset($_POST['FinanceTitle']) ? $_POST['FinanceTitle'] : ''));
				$FinanceDesc 	= trim(strip_tags(isset($_POST['FinanceDesc']) ? $_POST['FinanceDesc'] : ''));
				$FinanceType 	= Income;
				$FinanceAmount	= trim(strip_tags(isset($_POST['FinanceAmount']) ? $_POST['FinanceAmount'] : ''));
				$FinanceDate	= trim(strip_tags(isset($_POST['FinanceDate']) ? $_POST['FinanceDate'] : ''));
				$FinanceNotes	= trim(strip_tags(isset($_POST['FinanceNotes']) ? $_POST['FinanceNotes'] : ''));

				$postdata = array(
									'IdProject' 	=> $IdProject,
									'FinanceTitle' 	=> $FinanceTitle,
									'FinanceDesc' 	=> $FinanceDesc,
									'FinanceType' 	=> $FinanceType,
									'FinanceAmount' => $FinanceAmount,
									'FinanceDate' 	=> $FinanceDate,
									'FinanceNotes' 	=> $FinanceNotes,
									'CreatedDate' 	=> $CreatedDate,
									'CreatedUser' 	=> Session::get(IdUser)
								);     
				$this->_project->insert_finance_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_INCOME_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successAddIncome', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// UPDATE INCOME DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-wo-income') {

				if(empty($_POST['FinanceTitle'])) {
					$error[] = 'Please enter Work Order Income Title. !';
				} else if(empty($_POST['FinanceDesc'])) {
					$error[] = 'Please enter Work Order Income Description. !';
				} else if(empty($_POST['FinanceDate'])) {
					$error[] = 'Please enter Work Order Income Date. !';
				} else if(!filter_var($_POST['FinanceAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = 'Income Amount be a Number. !';
				} else if(empty($_POST['FinanceAmount'])) {
					$error[] = 'Please enter Work Order Income Amount. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdatedDate 	= date('Y-m-d H:i:s');
				$IdFinance 		= trim(strip_tags(isset($_POST['IdFinance']) ? $_POST['IdFinance'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$FinanceTitle 	= trim(strip_tags(isset($_POST['FinanceTitle']) ? $_POST['FinanceTitle'] : ''));
				$FinanceDesc 	= trim(strip_tags(isset($_POST['FinanceDesc']) ? $_POST['FinanceDesc'] : ''));
				$FinanceType 	= Income;
				$FinanceAmount	= trim(strip_tags(isset($_POST['FinanceAmount']) ? $_POST['FinanceAmount'] : ''));
				$FinanceDate	= trim(strip_tags(isset($_POST['FinanceDate']) ? $_POST['FinanceDate'] : ''));
				$FinanceNotes	= trim(strip_tags(isset($_POST['FinanceNotes']) ? $_POST['FinanceNotes'] : ''));

				$postdata = array(
									'IdProject' 		=> $IdProject,
									'FinanceTitle' 		=> $FinanceTitle,
									'FinanceDesc' 		=> $FinanceDesc,
									'FinanceType' 		=> $FinanceType,
									'FinanceAmount' 	=> $FinanceAmount,
									'FinanceDate' 		=> $FinanceDate,
									'FinanceNotes' 		=> $FinanceNotes,
									'LastUpdateDate' 	=> $UpdatedDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);  
				$where = array('IdFinance' => $IdFinance);  
				$this->_project->update_finance_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_INCOME_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdateIncome', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// DELETE INCOME DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-wo-income') {

        		$IdFinance 		= trim(strip_tags(isset($_POST['IdFinance']) ? $_POST['IdFinance'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));

	        	$postdata = array('IdFinance' => $IdFinance);      
				$this->_project->delete_finance_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_INCOME_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeleteIncome', 1);
				Url::redirect('admin/project/view/'.$IdProject);

        }

        // ADD NEW EXPENSE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-expense') {

				if(empty($_POST['FinanceTitle'])) {
					$error[] = 'Please enter Work Order Expense Title. !';
				} else if(empty($_POST['FinanceDesc'])) {
					$error[] = 'Please enter Work Order Expense Description. !';
				} else if(empty($_POST['FinanceDate'])) {
					$error[] = 'Please enter Work Order Expense Date. !';
				} else if(!filter_var($_POST['FinanceAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = 'Expense Amount be a Number. !';
				} else if(empty($_POST['FinanceAmount'])) {
					$error[] = 'Please enter Work Order Expense Amount. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 	= date('Y-m-d H:i:s');
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$FinanceTitle 	= trim(strip_tags(isset($_POST['FinanceTitle']) ? $_POST['FinanceTitle'] : ''));
				$FinanceDesc 	= trim(strip_tags(isset($_POST['FinanceDesc']) ? $_POST['FinanceDesc'] : ''));
				$FinanceType 	= Expense;
				$FinanceAmount	= trim(strip_tags(isset($_POST['FinanceAmount']) ? $_POST['FinanceAmount'] : ''));
				$FinanceDate	= trim(strip_tags(isset($_POST['FinanceDate']) ? $_POST['FinanceDate'] : ''));
				$FinanceNotes	= trim(strip_tags(isset($_POST['FinanceNotes']) ? $_POST['FinanceNotes'] : ''));

				$postdata = array(
									'IdProject' 	=> $IdProject,
									'FinanceTitle' 	=> $FinanceTitle,
									'FinanceDesc' 	=> $FinanceDesc,
									'FinanceType' 	=> $FinanceType,
									'FinanceAmount' => $FinanceAmount,
									'FinanceDate' 	=> $FinanceDate,
									'FinanceNotes' 	=> $FinanceNotes,
									'CreatedDate' 	=> $CreatedDate,
									'CreatedUser' 	=> Session::get(IdUser)
								);     
				$this->_project->insert_finance_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_EXPENSE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successAddExpense', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// UPDATE EXPENSE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-wo-expense') {

				if(empty($_POST['FinanceTitle'])) {
					$error[] = 'Please enter Work Order Expense Title. !';
				} else if(empty($_POST['FinanceDesc'])) {
					$error[] = 'Please enter Work Order Expense Description. !';
				} else if(empty($_POST['FinanceDate'])) {
					$error[] = 'Please enter Work Order Expense Date. !';
				} else if(!filter_var($_POST['FinanceAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = 'Expense Amount be a Number. !';
				} else if(empty($_POST['FinanceAmount'])) {
					$error[] = 'Please enter Work Order Expense Amount. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdatedDate 	= date('Y-m-d H:i:s');
				$IdFinance 		= trim(strip_tags(isset($_POST['IdFinance']) ? $_POST['IdFinance'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$FinanceTitle 	= trim(strip_tags(isset($_POST['FinanceTitle']) ? $_POST['FinanceTitle'] : ''));
				$FinanceDesc 	= trim(strip_tags(isset($_POST['FinanceDesc']) ? $_POST['FinanceDesc'] : ''));
				$FinanceType 	= Expense;
				$FinanceAmount	= trim(strip_tags(isset($_POST['FinanceAmount']) ? $_POST['FinanceAmount'] : ''));
				$FinanceDate	= trim(strip_tags(isset($_POST['FinanceDate']) ? $_POST['FinanceDate'] : ''));
				$FinanceNotes	= trim(strip_tags(isset($_POST['FinanceNotes']) ? $_POST['FinanceNotes'] : ''));

				$postdata = array(
									'IdProject' 		=> $IdProject,
									'FinanceTitle' 		=> $FinanceTitle,
									'FinanceDesc' 		=> $FinanceDesc,
									'FinanceType' 		=> $FinanceType,
									'FinanceAmount' 	=> $FinanceAmount,
									'FinanceDate' 		=> $FinanceDate,
									'FinanceNotes' 		=> $FinanceNotes,
									'LastUpdateDate' 	=> $UpdatedDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);  
				$where = array('IdFinance' => $IdFinance);  
				$this->_project->update_finance_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_EXPENSE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdateExpense', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		// DELETE EXPENSE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-wo-expense') {

        		$IdFinance 		= trim(strip_tags(isset($_POST['IdFinance']) ? $_POST['IdFinance'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));

	        	$postdata = array('IdFinance' => $IdFinance);      
				$this->_project->delete_finance_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_EXPENSE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeleteExpense', 1);
				Url::redirect('admin/project/view/'.$IdProject);

        }

        /*
		 *---------------------------------------------------------------
		 * WORK ORDER ATTACHMENTS
		 *---------------------------------------------------------------
		 */

	    
		$attachmentDir 			= $data['uploadPath'];
		$Ext 					= $data['filesAllowed'];
		$FilesAllowed 			= preg_replace('/,/', ', ', $Ext); 
		$FilesAllowedTypes 		= array($Ext);
		$FilesAllowedTypesData 	= explode( ',', $Ext );

        //ADD FOLDER FOR ATTACHMENT FILES
		if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-folder') {
			mkdir($attachmentDir.WO_CODE.$data['IdProject']);
			Session::set('successAddFolder', 1);
			Url::redirect('admin/project/view/'.$data['IdProject']);
		}

		// ADD NEW ATTACHMENT DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-attachment') {

				if(empty($_POST['AttachmentTitle'])) {
					$error[] = 'Please enter Work Order Attachment Title. !';
				} else if(empty($_FILES['file']['name'])) {
					$error[] = 'Please select a File to upload. !';
				} else {
					$ext = substr(strrchr(basename($_FILES['file']['name']), '.'), 1);
					if (!in_array($ext, $FilesAllowedTypesData)) {
						$error[] = 'The File was not an accepted file type or was too large in file size.';
					} else {
						//SET FOLDER PATH	
						$folder = $attachmentDir.WO_CODE.$data['IdProject'];
						$AttachmentTitle = htmlentities(trim(strip_tags(isset($_POST['AttachmentTitle']) ? $_POST['AttachmentTitle'] : '')));
						
						//REPLACE ANY SPACES WITH (_) & SET LOWERCASE
						$newName = str_replace(' ', '_', $AttachmentTitle);
						$AttachmentNewName = strtolower($newName);

						//REMOVE (/) & SET UPLOAD PATH
						$uploadTo = $folder;

						//GET ORIGINAL FILE EXTENSION
						$bits = explode(".", basename($_FILES['file']['name']));
						$extension = end($bits);

						//SET FILE NAME AND ORIGINAL FILE EXTENSION
						$AttachmentDetail = $AttachmentNewName.'.'.$extension;
						$movePath = ''.$uploadTo.'/'.$AttachmentDetail;
						move_uploaded_file($_FILES['file']['tmp_name'], $movePath);

						//DEFINE VARIABLE FOR INSERT TO DB	
						$CreatedDate 		= date('Y-m-d H:i:s');
						$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
						$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
						$AttachmentTitle 	= trim(strip_tags(isset($_POST['AttachmentTitle']) ? $_POST['AttachmentTitle'] : ''));
						$AttachmentNotes 	= trim(strip_tags(isset($_POST['AttachmentNotes']) ? $_POST['AttachmentNotes'] : ''));
						$AttachmentType 	= Document::getFileType($extension);
						$AttachmentSize 	= Document::formatBytes($_FILES['file']['size']);


						$postdata = array(
											'IdProject' 		=> $IdProject,
											'IdClient' 			=> $IdClient,
											'AttachmentTitle' 	=> $AttachmentTitle,
											'AttachmentNotes' 	=> $AttachmentNotes,
											'AttachmentType' 	=> $AttachmentType,
											'AttachmentSize' 	=> $AttachmentSize,
											'AttachmentUrl' 	=> $AttachmentDetail,
											'CreatedDate' 		=> $CreatedDate,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_project->insert_attachment_data($postdata);
						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_ATTACHMENT_PROJECT_. ' ' .WO_CODE.$IdProject;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_project->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						Session::set('successAddAttachment', 1);
						Url::redirect('admin/project/view/'.$IdProject);
					}
				}	
		}

		// UPDATE ATTACHMENT DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-wo-attachment') {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdatedDate 		= date('Y-m-d H:i:s');
				$IdAttachment 		= trim(strip_tags(isset($_POST['IdAttachment']) ? $_POST['IdAttachment'] : ''));
				$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$AttachmentNotes 	= trim(strip_tags(isset($_POST['AttachmentNotes']) ? $_POST['AttachmentNotes'] : ''));

				if(isset($_POST['AttachmentTitle']) && $_POST['AttachmentTitle'] != "") {
                	$AttachmentTitle = isset($_POST['AttachmentTitle']) ? $_POST['AttachmentTitle'] : '';
	            } else {
	                $AttachmentTitle = isset($_POST['AttachmentTitleOld']) ? $_POST['AttachmentTitleOld'] : '';
	            }

				$postdata = array(
									'IdProject' 		=> $IdProject,
									'IdClient' 			=> $IdClient,
									'AttachmentTitle' 	=> $AttachmentTitle,
									'AttachmentNotes' 	=> $AttachmentNotes,
									'LastUpdateDate' 	=> $UpdatedDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);  
				$where = array('IdAttachment' => $IdAttachment);  
				$this->_project->update_attachment_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_ATTACHMENT_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdateAttachment', 1);
				Url::redirect('admin/project/view/'.$IdProject);

		}

		// DELETE ATTACHMENT DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-wo-attachment') {

        		$IdAttachment 	= trim(strip_tags(isset($_POST['IdAttachment']) ? $_POST['IdAttachment'] : ''));
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$AttachmentUrl 	= trim(strip_tags(isset($_POST['AttachmentUrl']) ? $_POST['AttachmentUrl'] : ''));

	        	$postdata = array('IdAttachment' => $IdAttachment);      
				$this->_project->delete_attachment_data($postdata);

				//DELETE ATTACHMENT FILE FROM UPLOAD FOLDER
				@unlink($attachmentDir.WO_CODE.$data['IdProject'].'/'.$AttachmentUrl);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_ATTACHMENT_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */

				Session::set('successDeleteAttachment', 1);
				Url::redirect('admin/project/view/'.$IdProject);

        }

        /*
		 *---------------------------------------------------------------
		 * WORK ORDER INVOICES
		 *---------------------------------------------------------------
		 */

        // ADD NEW INVOICE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-wo-invoice') {

        		//CHECK IF INVOICE NUMBER EXIST
				$data['check_invoice_number'] = $this->_project->check_invoice_number($_POST['invoiceNumber']);

				if(empty($_POST['invoiceNumber'])) {
					$error[] = 'Please enter Work Order Invoice Number. !';
				} else if(empty($_POST['invoiceDate'])) {
					$error[] = 'Please enter Work Order Invoice Date !';
				} else if(empty($_POST['invoiceDueDate'])) {
					$error[] = 'Please enter Work Order Invoice Due Date. !';
				} else if(!filter_var($_POST['invoiceTaxRate'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = 'Invoice Tax Rate Must be a Number. !';
				} else if(empty($_POST['invoiceTaxRate'])) {
					$error[] = 'Please enter Work Order Invoice Tax Rate !';
				} else if ($data['check_invoice_number'] > 0){
					$error[] = 'Sorry, Invoice Number already Exist. !';
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 	= date('Y-m-d H:i:s');
				$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$invoiceNumber 	= trim(strip_tags(isset($_POST['invoiceNumber']) ? $_POST['invoiceNumber'] : ''));
				$invoiceClientReference 	= trim(strip_tags(isset($_POST['invoiceClientReference']) ? $_POST['invoiceClientReference'] : ''));
				$invoiceCompanyReference 	= trim(strip_tags(isset($_POST['invoiceCompanyReference']) ? $_POST['invoiceCompanyReference'] : ''));
				$invoiceDate 	= trim(strip_tags(isset($_POST['invoiceDate']) ? $_POST['invoiceDate'] : ''));
				$invoiceDueDate = trim(strip_tags(isset($_POST['invoiceDueDate']) ? $_POST['invoiceDueDate'] : ''));
				$invoiceTaxRate	= trim(strip_tags(isset($_POST['invoiceTaxRate']) ? $_POST['invoiceTaxRate'] : ''));
				$invoiceCurrency	= trim(strip_tags(isset($_POST['invoiceCurrency']) ? $_POST['invoiceCurrency'] : ''));
				$invoiceNote	= trim(strip_tags(isset($_POST['invoiceNote']) ? $_POST['invoiceNote'] : ''));

				
				$number = Gump::clean($invoiceNumber);

				$invoicedata = array(
									'IdClient' 			=> $IdClient,
									'IdProject' 		=> $IdProject,
									'invoiceNumber' 	=> $number,
									'invoiceClientReference' 	=> $invoiceClientReference,
									'invoiceCompanyReference' 	=> $invoiceCompanyReference,
									'invoiceDate' 		=> $invoiceDate,
									'invoiceDueDate' 	=> $invoiceDueDate,
									'invoiceCurrency' 	=> $invoiceCurrency,
									'invoiceTaxRate' 	=> $invoiceTaxRate,
									'invoiceNote' 		=> $invoiceNote,
									'CreatedDate' 		=> $CreatedDate,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_invoice_data($invoicedata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_INVOICE_PROJECT_. ' ' .WO_CODE.$IdProject;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_project->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successAddInvoice', 1);
				Url::redirect('admin/project/view/'.$IdProject);
				
			}
		}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/project/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}