<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/admin/profile.php
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
 	\helpers\document as Document,
 	\helpers\url as Url;
use Helpers\csrfhelper;

class Profile extends \core\controller{

	private $_profile;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_profile = new \models\admin\profile();
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

		$data['get_wo_task'] 	= $this->_profile->get_wo_task();
		$data['get_task_count'] = $this->_profile->get_task_count();
		$data['mailcount'] 		= $this->_profile->get_unread_mail_count(Session::get(IdUser));
		$data['womembercount'] 	= $this->_profile->get_user_wo_count(Session::get(IdUser));
		$data['womember'] 		= $this->_profile->get_user_wo(Session::get(IdUser));
		$data['rows'] 			= $this->_profile->view_profile(Session::get(IdUser));

		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

        if ($data['rows']){
            foreach ($data['rows'] as $row) {
            	$data['IdUser'] 			= $row->IdUser;
				$data['FullName'] 			= $row->FullName;
				$data['Username'] 			= $row->Username;
				$data['Password'] 			= $row->Password;
				$data['Email']				= $row->Email;
				$data['MailingAddress']		= $row->MailingAddress;
				$data['Phone']				= $row->Phone;
				$data['CellPhone']			= $row->CellPhone;
				$data['Level']				= $row->Level;
				$data['ProfilePicture']		= $row->ProfilePicture;
				$data['IsActive']			= $row->IsActive;
				$data['LastUpdateDate']		= $row->LastUpdateDate;
				$data['nLastUpdateDate']	= $row->nLastUpdateDate;
				$data['LastUpdateUser']		= $row->LastUpdateUser;
				$data['LastLogin']			= $row->LastLogin;
				$data['nLastLoginDate']		= $row->nLastLoginDate;
				$data['LastLoginIp']		= $row->LastLoginIp;
				$data['IsLogin']			= $row->IsLogin;
				$data['CreatedDate']		= $row->CreatedDate;
				$data['nCreatedDate']		= $row->nCreatedDate;
				$data['CreatedUser']		= $row->CreatedUser;
            }
        }

        if (Session::get(IdUser) != $row->IdUser) {
        	Session::set('InvalidProfile', 1);
        }

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// UPDATE PROFILE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {

				if(empty($_POST['FullName'])) {
					$error[] = _ERROR_FULLNAME_LANG_;
				} else if(empty($_POST['MailingAddress'])) {
					$error[] = _ERROR_MAILING_ADDRESS_LANG_;
				} else if($_POST['Phone'] == "") {
					$error[] = _ERROR_PHONE_NUMBER_LANG_;
				} else if(!filter_var($_POST['Phone'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_PHONE_FORMAT_LANG_;
				} else {
				
				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdateDate 		= date('Y-m-d H:i:s');
				$IdUser 			= trim(strip_tags(isset($_POST['IdUser']) ? $_POST['IdUser'] : ''));
				$FullName	   		= trim(strip_tags(isset($_POST['FullName']) ? $_POST['FullName'] : ''));
				$MailingAddress	  	= trim(strip_tags(isset($_POST['MailingAddress']) ? $_POST['MailingAddress'] : ''));
				$Phone		   		= trim(strip_tags(isset($_POST['Phone']) ? $_POST['Phone'] : ''));
				$CellPhone		   	= trim(strip_tags(isset($_POST['CellPhone']) ? $_POST['CellPhone'] : ''));
				$lokasi_file    	= $_FILES['fupload']['tmp_name'];
				$tipe_file      	= $_FILES['fupload']['type'];
				$nama_file      	= trim(strip_tags(isset($_POST['usernameOld']) ? $_POST['usernameOld'] : ''));

	            
				//PASSWORD GENERATE AUTOMATICALLY IF CHANGED
				if(isset($_POST['Password']) && $_POST['Password'] != "") {
                	$Password = Password::make($_POST['Password']);
	            } else {
	                $Password = isset($_POST['passwordOld']) ? $_POST['passwordOld'] : '';
	            }

	            

				//GET ORIGINAL EXTENSION
				$bits = explode(".", basename($_FILES['fupload']['name']));
				$extension = end($bits);
				$nama_file_unik = $nama_file.'.'.$extension; 

				//IF PROFILE PICTURE NOT CHANGED
				if (empty($lokasi_file)){
								$postdata = array(
													'FullName' 			=> $FullName,
													'Password' 			=> $Password,
													'MailingAddress' 	=> $MailingAddress,
													'Phone' 			=> $Phone,
													'CellPhone' 		=> $CellPhone,
													'LastUpdateDate' 	=> $UpdateDate,
													'LastUpdateUser' 	=> Session::get(FullName)
												);   
								$where = array('IdUser' => $IdUser);     
								$this->_profile->update_profile_data($postdata, $where);
								/*
								 *---------------------------------------------------------------
								 * AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								$CreatedDate 		= date('Y-m-d H:i:s');
								$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_PROFILE_;

							    $auditdata = array(
													'CreatedDate' 		=> $CreatedDate,
													'AuditContent' 		=> $AuditContent,
													'CreatedUser' 		=> Session::get(IdUser)
												);     
								$this->_profile->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successUpdatedProfile', 1);
								Url::redirect('admin/profile');
				} elseif (!empty($lokasi_file)){
					if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
						$error[] = _ERROR_UPLOAD_FAILED_LANG_;
					} else {					
								//UPLOAD FILE TO .DIR./UPLOADS/ADMINISTRATORS
								Document::uploadPhotoAdmin($nama_file_unik);
								$postdata = array(
													'FullName' 			=> $FullName,
													'Password' 			=> $Password,
													'MailingAddress' 	=> $MailingAddress,
													'Phone' 			=> $Phone,
													'CellPhone' 		=> $CellPhone,
													'ProfilePicture' 	=> $nama_file_unik,
													'LastUpdateDate' 	=> $UpdateDate,
													'LastUpdateUser' 	=> Session::get(FullName)
												);   
								$where = array('IdUser' => $IdUser);     
								$this->_profile->update_profile_data($postdata, $where);
								/*
								 *---------------------------------------------------------------
								 * AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								$CreatedDate 		= date('Y-m-d H:i:s');
								$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_PROFILE_;

							    $auditdata = array(
													'CreatedDate' 		=> $CreatedDate,
													'AuditContent' 		=> $AuditContent,
													'CreatedUser' 		=> Session::get(IdUser)
												);     
								$this->_profile->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successUpdatedProfile', 1);
								Url::redirect('admin/profile');
					}
				}
			}
		}

		// UPDATE EMAIL DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-email') {

			//CHECK IF EMAIL EXIST
			$data['check_email_1'] 	= $this->_profile->check_email_1($_POST['Email']);
			$data['check_email_2'] 	= $this->_profile->check_email_2($_POST['Email']);

			if(empty($_POST['Email'])) {
					$error[] = _ERROR_EMAIL_LANG_;
			} else if(!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
    			$error[] = _ERROR_EMAIL_FORMAT_LANG_;
			} else if ($data['check_email_1'] > 0){
				$error[] = _ERROR_EMAIL_EXIST_LANG_;
			} else if ($data['check_email_2'] > 0){
				$error[] = _ERROR_EMAIL_EXIST_LANG_;
			} else {
			
			//DEFINE VARIABLE FOR INSERT TO DB	
			$UpdateDate 		= date('Y-m-d H:i:s');
			$IdUser 			= trim(strip_tags(isset($_POST['IdUser']) ? $_POST['IdUser'] : ''));
			$Email		   		= Url::cbnSafe(isset($_POST['Email']) ? $_POST['Email'] : '');
            
				$postdata = array(
									'Email' 			=> $Email,
									'LastUpdateDate' 	=> $UpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);   
				$where = array('IdUser' => $IdUser);     
				$this->_profile->update_profile_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_EMAIL_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_profile->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdatedProfile', 1);
				Url::redirect('admin/profile');
				
			}
		}

		// UPDATE USERNAME DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-username') {

			//CHECK IF USERNAME EXIST
			$data['check_username_1'] = $this->_profile->check_username_1($_POST['Username']);
			$data['check_username_2'] = $this->_profile->check_username_2($_POST['Username']);

			if(empty($_POST['Username'])) {
				$error[] = _ERROR_USERNAME_LANG_;
			} else if (!ctype_alnum($_POST['Username'])) {
				$error[] = _ERROR_USERNAME_FORMAT_LANG_;
			} else if($data['check_username_1'] > 0) {
				$error[] = _ERROR_USERNAME_EXIST_LANG_;
			} else if($data['check_username_2'] > 0) {
				$error[] = _ERROR_USERNAME_EXIST_LANG_;
			} else {
			
			//DEFINE VARIABLE FOR INSERT TO DB	
			$UpdateDate 		= date('Y-m-d H:i:s');
			$IdUser 			= trim(strip_tags(isset($_POST['IdUser']) ? $_POST['IdUser'] : ''));
            $Username 			= trim(strip_tags(isset($_POST['Username']) ? $_POST['Username'] : ''));
            
				$postdata = array(
									'Username' 			=> $Username,
									'LastUpdateDate' 	=> $UpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);   
				$where = array('IdUser' => $IdUser);     
				$this->_profile->update_profile_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_USERNAME_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_profile->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdatedProfile', 1);
				Url::redirect('admin/profile');
				
			}
		}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/profile/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}