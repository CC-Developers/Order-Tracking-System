<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/admin/mail.php
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

class Mail extends \core\controller{

	private $_mail;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_mail = new \models\admin\mail();
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

		$data['get_wo_task'] 	= $this->_mail->get_wo_task();
		$data['get_task_count'] = $this->_mail->get_task_count();
		$data['mailcount'] 		= $this->_mail->get_unread_mail_count(Session::get(IdUser));

		$data['get_inbox'] 			= $this->_mail->get_inbox(Session::get(IdUser));
		$data['get_outbox'] 		= $this->_mail->get_outbox(Session::get(IdUser));
		$data['get_mail_archived'] 	= $this->_mail->get_mail_archived(Session::get(IdUser));

		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

        // MARK AS READ
        if (isset($_POST['submit']) && $_POST['submit'] == 'IsRead') {
        		$IdMail 		= trim(strip_tags(isset($_POST['IdMail']) ? $_POST['IdMail'] : ''));
        		$isRead 		= '1';
	        	$UpdateDate 	= date('Y-m-d H:i:s');
	        	$postdata 		= array(
											'isRead' 			=> $isRead,
											'LastUpdatedDate' 	=> $UpdateDate
										);   
				$where = array('IdMail' => $IdMail);     
				$this->_mail->update_mail_data($postdata, $where);
				Session::set('successReadMail', 1);
				Url::redirect('admin/mail');
        }

        // MARK AS UNREAD
        if (isset($_POST['submit']) && $_POST['submit'] == 'UnRead') {
        		$IdMail 		= trim(strip_tags(isset($_POST['IdMail']) ? $_POST['IdMail'] : ''));
        		$isRead 		= '0';
	        	$UpdateDate 	= date('Y-m-d H:i:s');
	        	$postdata 		= array(
											'isRead' 			=> $isRead,
											'LastUpdatedDate' 	=> $UpdateDate
										);   
				$where = array('IdMail' => $IdMail);     
				$this->_mail->update_mail_data($postdata, $where);
				Session::set('successUnreadMail', 1);
				Url::redirect('admin/mail');
        }

        // ARCHIVE
        if (isset($_POST['submit']) && $_POST['submit'] == 'IsArchived') {
        	$IdMail 		= trim(strip_tags(isset($_POST['IdMail']) ? $_POST['IdMail'] : ''));
    		$isArchived 	= '1';
        	$UpdateDate 	= date('Y-m-d H:i:s');
        	$postdata 		= array(
										'isArchived' 		=> $isArchived,
										'LastUpdatedDate' 	=> $UpdateDate
									);   
			$where = array('IdMail' => $IdMail);     
			$this->_mail->update_mail_data($postdata, $where);
			Session::set('successArchivedMail', 1);
			Url::redirect('admin/mail');
        }

        // UNARCHIVE
        if (isset($_POST['submit']) && $_POST['submit'] == 'UnArchived') {
        	$IdMail 		= trim(strip_tags(isset($_POST['IdMail']) ? $_POST['IdMail'] : ''));
    		$isArchived 	= '0';
        	$UpdateDate 	= date('Y-m-d H:i:s');
        	$postdata 		= array(
										'isArchived' 		=> $isArchived,
										'LastUpdatedDate' 	=> $UpdateDate
									);   
			$where = array('IdMail' => $IdMail);     
			$this->_mail->update_mail_data($postdata, $where);
			Session::set('successUnarchivedMail', 1);
			Url::redirect('admin/mail');
        }

        // DELETED
        if (isset($_POST['submit']) && $_POST['submit'] == 'IsDeleted') {
        	$IdMail 		= trim(strip_tags(isset($_POST['IdMail']) ? $_POST['IdMail'] : ''));
    		$isDeleted 		= '1';
        	$DeletedDate 	= date('Y-m-d H:i:s');
        	$UpdateDate 	= date('Y-m-d H:i:s');
        	$postdata 		= array(
										'isDeleted' 		=> $isDeleted,
										'DeletedDate' 		=> $DeletedDate,
										'LastUpdatedDate' 	=> $UpdateDate
									);   
			$where = array('IdMail' => $IdMail);     
			$this->_mail->update_mail_data($postdata, $where);
			Session::set('successDeletedMail', 1);
			Url::redirect('admin/mail');
        }

		$data['user_lists'] 		= $this->_mail->get_user_list(Session::get(IdUser));

		// COMPOSE NEW MAIL
        if (isset($_POST['submit']) && $_POST['submit'] == 'Compose') {

				if($_POST['ReceiverId'] == "++") {
					$error[] = _ERROR_RECIPIENT_LANG_;
				} else if(empty($_POST['MailTitle'])) {
					$error[] = _ERROR_SUBJECT_LANG_;
				} else if($_POST['MailContent'] == "") {
					$error[] = _ERROR_BODY_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$SentDate 			= date('Y-m-d H:i:s');
				$ReceiverId 		= trim(strip_tags(isset($_POST['ReceiverId']) ? $_POST['ReceiverId'] : ''));
				$MailTitle	   		= trim(strip_tags(isset($_POST['MailTitle']) ? $_POST['MailTitle'] : ''));
				$MailContent	  	= trim(strip_tags(isset($_POST['MailContent']) ? $_POST['MailContent'] : ''));
				
				$postdata = array(
									'SenderId' 			=> Session::get(IdUser),
									'ReceiverId' 		=> $ReceiverId,
									'MailTitle' 		=> $MailTitle,
									'MailContent' 		=> $MailContent,
									'sentDate' 			=> $SentDate
								);     
				$this->_mail->compose_mail($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_COMPOSE_MESSAGE_AUDIT_LANG_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_mail->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successComposedMail', 1);
				Url::redirect('admin/mail');

				
			}
		}

		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() {    
			        $('#inbox').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
					$('#outbox').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
					$('#archive-mail').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
		    	});
			</script>";

		render:

		View::rendertemplate('header',$data);
		View::render('admin/mail/mail',$data, $error);
		View::rendertemplate('footer',$data);
	}




}