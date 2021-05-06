<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       controllers/administrator.php
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
 	\helpers\gump as Gump,
 	\helpers\document as Document,
 	\helpers\url as Url;
use Helpers\csrfhelper;

class Administrator extends \core\controller{

	private $_administrator;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_administrator = new \models\admin\administrator();
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

		$data['active_user'] 	= $this->_administrator->get_user();
		$data['get_wo_task'] 	= $this->_administrator->get_wo_task();
		$data['get_task_count'] = $this->_administrator->get_task_count();
		$data['mailcount'] 		= $this->_administrator->get_unread_mail_count(Session::get(IdUser));
		
		$data['get_all_user_email'] = $this->_administrator->get_all_user_email();
	
		$data['owner_info'] 			= $this->_administrator->get_owner(1);

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
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() {    
			        $('#all-users').dataTable({
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

		// SEND EMAIL TO ALL USERS
        if (isset($_POST['submit']) && $_POST['submit'] == 'email-all-users') {
        	if(empty($_POST['EmailSubject'])) {
				$error[] = 'Please enter Email subject. !';
			} else if(empty($_POST['EmailText'])) {
				$error[] = 'Please enter Email body / content. !';
			} else {

			
			$EmailSubject		= trim(strip_tags(isset($_POST['EmailSubject']) ? $_POST['EmailSubject'] : ''));
			$EmailText			= trim(strip_tags(isset($_POST['EmailText']) ? $_POST['EmailText'] : ''));

			

			$mail = new \helpers\phpmailer\mail();
		    $mail->setFrom($data['ownerEmail']);
		    if ($data['get_all_user_email']){
	            foreach ($data['get_all_user_email'] as $allusers) {
	            	$mail->addAddress($allusers->Email);
	            }
	        }
		    $mail->subject($EmailSubject);
		    $mail->body($EmailText);

		    if(!$mail->Send()) {

				$error[] = $mail->ErrorInfo;

			} else {
			    /*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SEND_EMAIL_USER_AUDIT_LANG_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_administrator->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				
				Session::set('successEmailAllUser', 1);
				Url::redirect('admin/administrator');
			}
		}
	}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/administrator/administrator',$data, $error);
		View::rendertemplate('footer',$data);
	}

	/*
	 *---------------------------------------------------------------
	 * ADD
	 *---------------------------------------------------------------
	 */
	public function add(){

		$data['get_wo_task'] 	= $this->_administrator->get_wo_task();
		$data['get_task_count'] = $this->_administrator->get_task_count();
		$data['mailcount'] 		= $this->_administrator->get_unread_mail_count(Session::get(IdUser));

		$data['owner_info'] 			= $this->_administrator->get_owner(1);

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

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// ADD NEW USER DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Add') {
				
				//CHECK IF USERNAME AND/OR EMAIL EXIST
				$data['check_username_1'] = $this->_administrator->check_username_1($_POST['Username']);
				$data['check_username_2'] = $this->_administrator->check_username_2($_POST['Username']);
				$data['check_email_1'] 	= $this->_administrator->check_email_1($_POST['Email']);
				$data['check_email_2'] 	= $this->_administrator->check_email_2($_POST['Email']);
				
				if(empty($_POST['FullName'])) {
					$error[] = _ERROR_FULLNAME_LANG_;
				} else if(empty($_POST['MailingAddress'])) {
					$error[] = _ERROR_MAILING_ADDRESS_LANG_;
				} else if($_POST['Phone'] == "") {
					$error[] = _ERROR_PHONE_NUMBER_LANG_;
				} else if(!filter_var($_POST['Phone'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_PHONE_FORMAT_LANG_;
				} else if($_POST['Email'] == "") {
					$error[] = _ERROR_EMAIL_LANG_;
				} else if($_POST['Username'] == "") {
					$error[] = _ERROR_USERNAME_LANG_;
				} else if (!ctype_alnum($_POST['Username'])) {
					$error[] = _ERROR_USERNAME_FORMAT_LANG_;
				} else if (!ctype_alnum($_POST['Username'])) {
					$error[] = _ERROR_USERNAME_FORMAT_LANG_;
				} else if($_POST['Password'] == "") {
					$error[] = _ERROR_PASSWORD_LANG_;
				} else if(!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
    				$error[] = _ERROR_EMAIL_FORMAT_LANG_;
    			} else if($data['check_username_1'] > 0) {
					$error[] = _ERROR_USERNAME_EXIST_LANG_;
				} else if ($data['check_email_1'] > 0){
					$error[] = _ERROR_EMAIL_EXIST_LANG_;
				} else if($data['check_username_2'] > 0) {
					$error[] = _ERROR_USERNAME_EXIST_LANG_;
				} else if ($data['check_email_2'] > 0){
					$error[] = _ERROR_EMAIL_EXIST_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 		= date('Y-m-d H:i:s');
				$FullName	   		= trim(strip_tags(isset($_POST['FullName']) ? $_POST['FullName'] : ''));
				$MailingAddress	  	= trim(strip_tags(isset($_POST['MailingAddress']) ? $_POST['MailingAddress'] : ''));
				$Phone		   		= trim(strip_tags(isset($_POST['Phone']) ? $_POST['Phone'] : ''));
				$CellPhone		   	= trim(strip_tags(isset($_POST['CellPhone']) ? $_POST['CellPhone'] : ''));
				$Email		   		= Url::cbnSafe(isset($_POST['Email']) ? $_POST['Email'] : '');
				$Level		   		= trim(strip_tags(isset($_POST['Level']) ? $_POST['Level'] : ''));
				$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));
				$lokasi_file    	= $_FILES['fupload']['tmp_name'];
				$tipe_file      	= $_FILES['fupload']['type'];
				$nama_file      	= trim(strip_tags(isset($_POST['Username']) ? $_POST['Username'] : ''));
				$Username      		= trim(strip_tags(isset($_POST['Username']) ? $_POST['Username'] : ''));
				$Password      		= Password::make(isset($_POST['Password']) ? $_POST['Password'] : '');

				//GET ORIGINAL EXTENSION
				$bits = explode(".", basename($_FILES['fupload']['name']));
				$extension = end($bits);
				$nama_file_unik = $nama_file.'.'.$extension; 

				//IF PROFILE PICTURE NOT CHANGED
				if (empty($lokasi_file)){
						$postdata = array(
											'FullName' 			=> $FullName,
											'Username' 			=> $Username,
											'Password' 			=> $Password,
											'Email' 			=> $Email,
											'MailingAddress' 	=> $MailingAddress,
											'Phone' 			=> $Phone,
											'CellPhone' 		=> $CellPhone,
											'Level' 			=> $Level,
											'IsActive' 			=> $IsActive,
											'CreatedDate' 		=> $CreatedDate,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_administrator->insert_user_data($postdata);

						$mail = new \helpers\phpmailer\mail();
					    $mail->setFrom($data['ownerEmail']);
					    $mail->addAddress($Email);
					    $mail->subject('Your '.$data['appName'].' Account has been Created');
					    $mail->body('<h1>Your credential is:</h1><br />
					    	<hr><p>Username : '.$Username.'</p>
					    	<p>Password : '.$_POST['Password'].' (Do Not Copy Paste !)</p>
					    	<p>Link : <a href="'.DIR.'/admin">'.$data['appName'].'</a></p>');
					    if(!$mail->Send()) {

							$error[] = $mail->ErrorInfo;

						} else {

						    /*
							 *---------------------------------------------------------------
							 * AUDIT TRAILS
							 *---------------------------------------------------------------
							 */
							$CreatedDate 		= date('Y-m-d H:i:s');
							$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_USER_AUDIT_LANG_;

						    $auditdata = array(
												'CreatedDate' 		=> $CreatedDate,
												'AuditContent' 		=> $AuditContent,
												'CreatedUser' 		=> Session::get(IdUser)
											);     
							$this->_administrator->insert_audit_data($auditdata);
							/*
							 *---------------------------------------------------------------
							 * END AUDIT TRAILS
							 *---------------------------------------------------------------
							 */

							Session::set('successAddUser', 1);
							Url::redirect('admin/administrator');
						}
				} elseif (!empty($lokasi_file)){
					if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
						$error[] = _ERROR_UPLOAD_FAILED_LANG_;
					} else {
							//UPLOAD FILE TO .DIR./UPLOADS/ADMINISTRATORS
							Document::uploadPhotoAdmin($nama_file_unik);
							$postdata = array(
												'FullName' 			=> $FullName,
												'Username' 			=> $Username,
												'Password' 			=> $Password,
												'Email' 			=> $Email,
												'MailingAddress' 	=> $MailingAddress,
												'Phone' 			=> $Phone,
												'CellPhone' 		=> $CellPhone,
												'Level' 			=> $Level,
												'IsActive' 			=> $IsActive,
												'ProfilePicture' 	=> $nama_file_unik,
												'CreatedDate' 		=> $CreatedDate,
												'CreatedUser' 		=> Session::get(IdUser)
											);       
							$this->_administrator->insert_user_data($postdata);

							$mail = new \helpers\phpmailer\mail();
						    $mail->setFrom($data['ownerEmail']);
						    $mail->addAddress($Email);
						    $mail->subject('Your '.$data['appName'].' Account has been Created');
						    $mail->body('<h1>Your credential is:</h1><br />
						    	<hr><p>Username : '.$Username.'</p>
						    	<p>Password : '.$_POST['Password'].' (Do Not Copy Paste !)</p>
						    	<p>Link : <a href="'.DIR.'">'.$data['appName'].'</a></p>');

						if(!$mail->Send()) {

							$error[] = $mail->ErrorInfo;

						} else {

						    /*
							 *---------------------------------------------------------------
							 * AUDIT TRAILS
							 *---------------------------------------------------------------
							 */
							$CreatedDate 		= date('Y-m-d H:i:s');
							$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_USER_AUDIT_LANG_;

						    $auditdata = array(
												'CreatedDate' 		=> $CreatedDate,
												'AuditContent' 		=> $AuditContent,
												'CreatedUser' 		=> Session::get(IdUser)
											);     
							$this->_administrator->insert_audit_data($auditdata);
							/*
							 *---------------------------------------------------------------
							 * END AUDIT TRAILS
							 *---------------------------------------------------------------
							 */
							
							Session::set('successAddUser', 1);
							Url::redirect('admin/administrator');
						}
					}
				}
			}
		}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/administrator/add',$data, $error);
		View::rendertemplate('footer',$data);
	}

	/*
	 *---------------------------------------------------------------
	 * VIEW
	 *---------------------------------------------------------------
	 */
	public function view($id){

		$data['get_wo_task'] 	= $this->_administrator->get_wo_task();
		$data['get_task_count'] = $this->_administrator->get_task_count();
		$data['mailcount'] 		= $this->_administrator->get_unread_mail_count(Session::get(IdUser));
		$data['womembercount'] 	= $this->_administrator->get_user_wo_count($id);
		$data['womember'] 		= $this->_administrator->get_user_wo($id);
		$data['rows'] 			= $this->_administrator->view_user($id);
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

        if ($id != $row->IdUser) {
        	Session::set('InvalidUser', 1);
        }

        $data['owner_info'] 			= $this->_administrator->get_owner(1);

		if ($data['owner_info']) {
            foreach ($data['owner_info'] as $row) {
               $data['appName'] 	= $row->appName;
               $data['ownerName'] 	= $row->ownerName;
               $data['ownerAddress'] = $row->ownerAddress;
               $data['ownerEmail'] 	= $row->ownerEmail;
               $data['ownerPhone'] 	= $row->ownerPhone;
            }
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
        	$postdata = array('IdUser' => $id);      
			$this->_administrator->delete_user_data($postdata);
			/*
			 *---------------------------------------------------------------
			 * AUDIT TRAILS
			 *---------------------------------------------------------------
			 */
			$CreatedDate 		= date('Y-m-d H:i:s');
			$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_USER_AUDIT_LANG_;

		    $auditdata = array(
								'CreatedDate' 		=> $CreatedDate,
								'AuditContent' 		=> $AuditContent,
								'CreatedUser' 		=> Session::get(IdUser)
							);     
			$this->_administrator->insert_audit_data($auditdata);
			/*
			 *---------------------------------------------------------------
			 * END AUDIT TRAILS
			 *---------------------------------------------------------------
			 */
			Session::set('successDeletedUser', 1);
			Url::redirect('administrator');
        }

        // UPDATE USER DATA
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
				$Level		   		= trim(strip_tags(isset($_POST['Level']) ? $_POST['Level'] : ''));
				$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));
				$lokasi_file    	= $_FILES['fupload']['tmp_name'];
				$tipe_file      	= $_FILES['fupload']['type'];
                $nama_file 			= isset($_POST['usernameOld']) ? $_POST['usernameOld'] : '';

	            
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
													'Level' 			=> $Level,
													'IsActive' 			=> $IsActive,
													'LastUpdateDate' 	=> $UpdateDate,
													'LastUpdateUser' 	=> Session::get(FullName)
												);   
								$where = array('IdUser' => $IdUser);     
								$this->_administrator->update_user_data($postdata, $where);
								/*
								 *---------------------------------------------------------------
								 * AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								$CreatedDate 		= date('Y-m-d H:i:s');
								$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_USER_AUDIT_LANG_. ' ' .$FullName;

							    $auditdata = array(
													'CreatedDate' 		=> $CreatedDate,
													'AuditContent' 		=> $AuditContent,
													'CreatedUser' 		=> Session::get(IdUser)
												);     
								$this->_administrator->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successUpdatedUser', 1);
								Url::redirect('admin/administrator/view/'.$IdUser);
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
													'Level' 			=> $Level,
													'IsActive' 			=> $IsActive,
													'ProfilePicture' 	=> $nama_file_unik,
													'LastUpdateDate' 	=> $UpdateDate,
													'LastUpdateUser' 	=> Session::get(FullName)
												);   
								$where = array('IdUser' => $IdUser);     
								$this->_administrator->update_user_data($postdata, $where);
								/*
								 *---------------------------------------------------------------
								 * AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								$CreatedDate 		= date('Y-m-d H:i:s');
								$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_USER_AUDIT_LANG_;

							    $auditdata = array(
													'CreatedDate' 		=> $CreatedDate,
													'AuditContent' 		=> $AuditContent,
													'CreatedUser' 		=> Session::get(IdUser)
												);     
								$this->_administrator->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successUpdatedUser', 1);
								Url::redirect('admin/administrator/view/'.$IdUser);
					}
				}
			}
		}

		// UPDATE EMAIL DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-email') {

			//CHECK IF EMAIL EXIST
			$data['check_email_1'] 	= $this->_administrator->check_email_1($_POST['Email']);
			$data['check_email_2'] 	= $this->_administrator->check_email_2($_POST['Email']);

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
				$this->_administrator->update_user_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_EMAIL_USER_AUDIT_LANG_. ' ' .$Email;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_administrator->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdatedUser', 1);
				Url::redirect('admin/administrator/view/'.$IdUser);
				
			}
		}

		// UPDATE USERNAME DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-username') {

			//CHECK IF USERNAME EXIST
			$data['check_username_1'] = $this->_administrator->check_username_1($_POST['Username']);
			$data['check_username_2'] = $this->_administrator->check_username_2($_POST['Username']);

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
				$this->_administrator->update_user_data($postdata, $where);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_USERNAME_USER_AUDIT_LANG_. ' ' .$Username;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_administrator->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successUpdatedUser', 1);
				Url::redirect('admin/administrator/view/'.$IdUser);
				
			}
		}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/administrator/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}