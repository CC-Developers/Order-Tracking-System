<?php namespace controllers\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ---------------- 
*
* @file       app/controllers/client/login.php
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
 	\helpers\url as Url,
 	\helpers\password as Password,
 	\helpers\csrf as Csrf;
use Helpers\csrfhelper;

class Login extends \core\controller{

	private $_login;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_login = new \models\client\login();
	}

	public function process(){

		$data['ip'] 		= $_SERVER['REMOTE_ADDR'];
		$data['rows'] 		= $this->_login->get_appname(1);
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		if(Session::get('clientloggedin') === true) {
			Url::redirect('dashboard');
		}

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		if (isset($_POST['submit']) && $_POST['submit'] == 'Secure Login') {


				$username 		= Url::cbnSafe(isset($_POST['username']) ? $_POST['username'] : '');
				$password 		= isset($_POST['password']) ? $_POST['password'] : '';
			        
			        if (empty($username)) {
					$error[] = _ERROR_USERNAME_LANG_;
					} else if (empty($password)) {
						$error[] = _ERROR_PASSWORD_LANG_;
					} else if (!ctype_alnum($username)) {
						$error[] = _ERROR_USERNAME_FORMAT_LANG_;
					} else {

						$date 			= date('Y-m-d H:i:s');
						$yes 			= 1;
						$hash 			= $this->_login->get_hash($username);
						$user			= $this->_login->get_client($username);

							if(Password::verify($password, $hash) === false) {
								$error[] = _ERROR_USERNAME_PASSWORD_LANG_;
							} else {
								Session::set('clientloggedin',true);
								
								$postdata = array('IsLogin' => $yes, 'LastLoginDate' => $date, 'LastLoginIP' => $data['ip']);   
								$where = array('Username' => $username);     
								$this->_login->update_lastupdate($postdata, $where); 

								if ($user) {
									foreach ($user as $row) {
										Session::set('IdClient',$row->IdClient);
										Session::set('Username',$row->Username);
										Session::set('FullName',$row->FullName);
										Session::set('Email',$row->Email);
										Session::set('ProfilePicture',$row->ProfilePicture);
										Session::set('LastLoginIP',$row->LastLoginIP);
										Session::set('IsLogin',1);
									}
								}

								if(!isset($_SESSION['cbn_IdClient'])) {
									Url::redirect('login');
								} else {
									Session::set('WelcomeDashboard', 1);
									 /*
									 *---------------------------------------------------------------
									 * AUDIT TRAILS
									 *---------------------------------------------------------------
									 */
									$CreatedDate 		= date('Y-m-d H:i:s');
									$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_LOGIN_LANG_. ' ' .$data['ip'];

								    $auditdata = array(
														'CreatedDate' 		=> $CreatedDate,
														'AuditContent' 		=> $AuditContent,
														'CreatedUser' 		=> Session::get(IdUser)
													);     
									$this->_login->insert_audit_data($auditdata);
									/*
									 *---------------------------------------------------------------
									 * END AUDIT TRAILS
									 *---------------------------------------------------------------
									 */
									Url::redirect('dashboard');
								}

							}

					}
			
	
		}

		render:

		View::render('client/dashboard/login',$data, $error);
	}

	public function forgot(){

		$data['ip'] 	= $_SERVER['REMOTE_ADDR'];
		$data['rows'] 	= $this->_login->get_appname(1);

		$data['owner_info'] 			= $this->_login->get_owner(1);

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

		if(Session::get('clientloggedin') === true) {
			Url::redirect('dashboard');
		}

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		if(isset($_POST['submit'])) {

			$email 			= Url::cbnSafe(isset($_POST['email']) ? $_POST['email'] : '');
			$result			= $this->_login->get_client_from_email($email);

			if(empty($email)) {
				$error[] = _EMPTY_EMAIL_LANG_;
			} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    			$error[] = _INVALID_EMAIL_LANG_;
    		} else {
				if ($result) {
					$generate 		=  Password::cbnGeneratePassword();
					$token 			=  Password::make($generate);
					$LastUpdateDate = date('Y-m-d H:i:s');

					$postdata = array('LastUpdateDate' => $LastUpdateDate, 'Password' => $token);   
					$where = array('Email' => $email);     
					$this->_login->update_lastlogin($postdata, $where);

					$mail = new \helpers\phpmailer\mail();
				    $mail->setFrom($data['ownerEmail']);
				    $mail->addAddress($email);
				    $mail->subject('Your '.$data['appName'].' User Password has been Reset');
				    $mail->body('<h1>Your temporary password is:</h1>
				    	<hr><p>'.$generate.' (Do Not Copy Paste !)</p>');
				    
				     if(!$mail->Send()) {

						$error[] = $mail->ErrorInfo;

					} else {

				    	$data['success'] = _SUCCESS_RESET_LANG_;
				    }
				    
				} else {
					$error[] = _ERROR_RESET_LANG_;
				}
			}
		}
		
		render:

		View::render('client/dashboard/forgot',$data, $error);
	}

	public function logout(){
		$no 		= 0;	
		$postdata 	= array('IsLogin' => $no);   
		$where 		= array('IdClient' => $_SESSION['cbn_IdClient']);   

		$this->_login->update_lastupdate($postdata, $where);
		
		Session::destroy();
		Url::redirect('login');
	}
	
}