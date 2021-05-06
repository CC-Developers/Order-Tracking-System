<?php namespace controllers\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/client/profile.php
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
		$this->_profile = new \models\client\profile();
		if(Session::get('clientloggedin') == false) {
			Url::redirect('login');
		}
	}

	/*
	 *---------------------------------------------------------------
	 * INDEX
	 *---------------------------------------------------------------
	 */
	public function index(){

		$data['woclientcount'] 	= $this->_profile->get_client_wo_count(Session::get(IdClient));
		$data['woclient'] 		= $this->_profile->get_client_wo(Session::get(IdClient));
		$data['rows'] 			= $this->_profile->view_profile(Session::get(IdClient));

		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

        if ($data['rows']){
            foreach ($data['rows'] as $row) {
            	$data['IdClient'] 			= $row->IdClient;
				$data['FullName'] 			= $row->FullName;
				$data['Username'] 			= $row->Username;
				$data['Password'] 			= $row->Password;
				$data['Email']				= $row->Email;
				$data['MailingAddress']		= $row->MailingAddress;
				$data['Phone']				= $row->Phone;
				$data['CellPhone']			= $row->CellPhone;
				$data['ProfilePicture']		= $row->ProfilePicture;
				$data['IsActive']			= $row->IsActive;
				$data['LastUpdateDate']		= $row->LastUpdateDate;
				$data['nLastUpdateDate']	= $row->nLastUpdateDate;
				$data['LastUpdateUser']		= $row->LastUpdateUser;
				$data['nLastLoginDate']		= $row->nLastLoginDate;
				$data['LastLoginIp']		= $row->LastLoginIp;
				$data['IsLogin']			= $row->IsLogin;
				$data['CreatedDate']		= $row->CreatedDate;
				$data['nCreatedDate']		= $row->nCreatedDate;
				$data['CreatedUser']		= $row->CreatedUser;
            }
        }

        if (Session::get(IdClient) != $row->IdClient) {
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
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
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
								$where = array('IdClient' => $IdClient);     
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
													'CreatedUser' 		=> Session::get(IdClient)
												);     
								$this->_profile->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successUpdatedProfile', 1);
								Url::redirect('profile');
				} elseif (!empty($lokasi_file)){
					if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
						$error[] = _ERROR_UPLOAD_FAILED_LANG_;
					} else {					
								//UPLOAD FILE TO .DIR./UPLOADS/CLIENTS
								Document::uploadPhotoClient($nama_file_unik);
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
								$where = array('IdClient' => $IdClient);     
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
													'CreatedUser' 		=> Session::get(IdClient)
												);     
								$this->_profile->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successUpdatedProfile', 1);
								Url::redirect('profile');
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
			$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
			$Email		   		= Url::cbnSafe(isset($_POST['Email']) ? $_POST['Email'] : '');
            
				$postdata = array(
									'Email' 			=> $Email,
									'LastUpdateDate' 	=> $UpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);   
				$where = array('IdClient' => $IdClient);     
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
									'CreatedUser' 		=> Session::get(IdClient)
								);     
				$this->_profile->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdatedProfile', 1);
				Url::redirect('profile');
				
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
			$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
            $Username 			= trim(strip_tags(isset($_POST['Username']) ? $_POST['Username'] : ''));
            
				$postdata = array(
									'Username' 			=> $Username,
									'LastUpdateDate' 	=> $UpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);   
				$where = array('IdClient' => $IdClient);     
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
									'CreatedUser' 		=> Session::get(IdClient)
								);     
				$this->_profile->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdatedProfile', 1);
				Url::redirect('profile');
				
			}
		}

		render:

		View::rendertemplate('header-client',$data);
		View::render('client/profile/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}