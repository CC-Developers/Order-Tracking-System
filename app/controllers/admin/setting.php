<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/admin/setting.php
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

class Setting extends \core\controller{

	private $_setting;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_setting = new \models\admin\setting();
		if(Session::get('loggedin') == false) {
			Url::redirect('admin/login');
		}
	}

	/*
	 *---------------------------------------------------------------
	 * VIEW
	 *---------------------------------------------------------------
	 */
	public function viewsetting(){
		
		$data['get_wo_task'] 	= $this->_setting->get_wo_task();
		$data['get_task_count'] = $this->_setting->get_task_count();
		$data['mailcount'] 		= $this->_setting->get_unread_mail_count(Session::get(IdUser));
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();
		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() { 
					$('#all-phase').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });    
			        $('#all-currency').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
					$('#all-role').dataTable({
			            'bPaginate': true,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
		    	});
			</script>";

		$data['get_setting'] 	= $this->_setting->get_setting();

        if ($data['get_setting']){
            foreach ($data['get_setting'] as $row) {
            	$data['settingsId'] 		= $row->settingsId;
				$data['appUrl'] 			= $row->appUrl;
				$data['appName'] 			= $row->appName;
				$data['ownerName'] 			= $row->ownerName;
				$data['ownerAddress']		= $row->ownerAddress;
				$data['ownerEmail']			= $row->ownerEmail;
				$data['ownerPhone']			= $row->ownerPhone;
				$data['uploadPath']			= $row->uploadPath;
				$data['filesAllowed']		= $row->filesAllowed;
				$data['AppLogo']			= $row->AppLogo;
				$data['LastUpdateDate']		= $row->LastUpdateDate;
				$data['nLastUpdateDate']	= $row->nLastUpdateDate;
				$data['LastUpdateUser']		= $row->LastUpdateUser;
				$data['AdminName']			= $row->AdminName;
            }
        }

        $data['get_phase'] 	= $this->_setting->get_phase();
        $data['get_currency'] 	= $this->_setting->get_currency();
        $data['get_role'] 	= $this->_setting->get_role();

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

        // UPDATE SETTING DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
				
				if(empty($_POST['appUrl'])) {
					$error[] = _ERROR_APP_URL_LANG_;
				} else if(empty($_POST['appName'])) {
					$error[] = _ERROR_APP_NAME_LANG_;
				} else if(empty($_POST['ownerName'])) {
					$error[] = _ERROR_BUSINESS_NAME_LANG_;
				} else if(empty($_POST['ownerAddress'])) {
					$error[] = _ERROR_BUSINESS_ADDRESS_LANG_;
				} else if(empty($_POST['ownerEmail'])) {
					$error[] = _ERROR_BUSINESS_EMAIL_LANG_;
				} else if(!filter_var($_POST['ownerEmail'], FILTER_VALIDATE_EMAIL)) {
    				$error[] = _ERROR_EMAIL_FORMAT_LANG_;
				} else if(empty($_POST['ownerPhone'])) {
					$error[] = _ERROR_BUSINESS_PHONE_LANG_;
				} else if(!filter_var($_POST['ownerPhone'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_PHONE_FORMAT_LANG_;
				} else if(empty($_POST['uploadPath'])) {
					$error[] = _ERROR_UPLOAD_PATH_LANG_;
				} else if(empty($_POST['filesAllowed'])) {
					$error[] = _ERROR_EXT_LANG_;
				} else {
				
				//DEFINE VARIABLE FOR INSERT TO DB	
				$UpdateDate 		= date('Y-m-d H:i:s');
				$settingsId 		= trim(strip_tags(isset($_POST['settingsId']) ? $_POST['settingsId'] : ''));
				$appUrl	   			= trim(strip_tags(isset($_POST['appUrl']) ? $_POST['appUrl'] : ''));
				$appName	  		= trim(strip_tags(isset($_POST['appName']) ? $_POST['appName'] : ''));
				$ownerName	  		= trim(strip_tags(isset($_POST['ownerName']) ? $_POST['ownerName'] : ''));
				$ownerAddress	  	= trim(strip_tags(isset($_POST['ownerAddress']) ? $_POST['ownerAddress'] : ''));
				$ownerEmail	  		= trim(strip_tags(isset($_POST['ownerEmail']) ? $_POST['ownerEmail'] : ''));
				$ownerPhone		   	= trim(strip_tags(isset($_POST['ownerPhone']) ? $_POST['ownerPhone'] : ''));
				$uploadPath		   	= trim(strip_tags(isset($_POST['uploadPath']) ? $_POST['uploadPath'] : ''));
				$filesAllowed		= trim(strip_tags(isset($_POST['filesAllowed']) ? $_POST['filesAllowed'] : ''));
				$lokasi_file    	= $_FILES['fupload']['tmp_name'];
				$tipe_file      	= $_FILES['fupload']['type'];
				$nama_file      	= trim(strip_tags(isset($_POST['ownerName']) ? $_POST['ownerName'] : ''));

				//ADD (/)
				if(substr($appUrl, -1) != '/') {
					$install = $appUrl.'/';
				} else {
					$install = $appUrl;
				}

				//ADD (/)
				if(substr($uploadPath, -1) != '/') {
					$uploadPath = $uploadPath.'/';
				} else {
					$uploadPath = $uploadPath;
				}

				//IF UPLOAD PATH == ''
				if (!is_dir($uploadPath)) { 
					
					//CREATE DIRECTORY
					mkdir($uploadPath);
					
				}

				//GET ORIGINAL EXTENSION
				$bits = explode(".", basename($_FILES['fupload']['name']));
				$extension = end($bits);
				$nama_file_unik = $nama_file.'.'.$extension; 

				//IF LOGO NOT CHANGED
				if (empty($lokasi_file)){
								$postdata = array(
													'appUrl' 			=> $install,
													'appName' 			=> $appName,
													'ownerName' 		=> $ownerName,
													'ownerAddress' 		=> $ownerAddress,
													'ownerEmail' 		=> $ownerEmail,
													'ownerPhone' 		=> $ownerPhone,
													'uploadPath' 		=> $uploadPath,
													'filesAllowed' 		=> $filesAllowed,
													'LastUpdateDate' 	=> $UpdateDate,
													'LastUpdateUser' 	=> Session::get(FullName)
												);   
								$where = array('settingsId' => $settingsId);     
								$this->_setting->update_setting_data($postdata, $where);
								/*
								 *---------------------------------------------------------------
								 * AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								$CreatedDate 		= date('Y-m-d H:i:s');
								$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_GENERAL_SETTING_;

							    $auditdata = array(
													'CreatedDate' 		=> $CreatedDate,
													'AuditContent' 		=> $AuditContent,
													'CreatedUser' 		=> Session::get(IdUser)
												);     
								$this->_setting->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successGeneralSetting', 1);
								Url::redirect('admin/setting');
				} elseif (!empty($lokasi_file)){
					if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
						$error[] = _ERROR_UPLOAD_FAILED_LANG_;
					} else {					
								//UPLOAD FILE TO .DIR./UPLOADS/CLIENT
								Document::uploadLogo($nama_file_unik);
								$postdata = array(
													'appUrl' 			=> $install,
													'appName' 			=> $appName,
													'ownerName' 		=> $ownerName,
													'ownerAddress' 		=> $ownerAddress,
													'ownerEmail' 		=> $ownerEmail,
													'ownerPhone' 		=> $ownerPhone,
													'uploadPath' 		=> $uploadPath,
													'filesAllowed' 		=> $filesAllowed,
													'AppLogo' 			=> $nama_file_unik,
													'LastUpdateDate' 	=> $UpdateDate,
													'LastUpdateUser' 	=> Session::get(FullName)
												);   
								$where = array('settingsId' => $settingsId);     
								$this->_setting->update_setting_data($postdata, $where);
								/*
								 *---------------------------------------------------------------
								 * AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								$CreatedDate 		= date('Y-m-d H:i:s');
								$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_GENERAL_SETTING_;

							    $auditdata = array(
													'CreatedDate' 		=> $CreatedDate,
													'AuditContent' 		=> $AuditContent,
													'CreatedUser' 		=> Session::get(IdUser)
												);     
								$this->_setting->insert_audit_data($auditdata);
								/*
								 *---------------------------------------------------------------
								 * END AUDIT TRAILS
								 *---------------------------------------------------------------
								 */
								Session::set('successGeneralSetting', 1);
								Url::redirect('admin/setting');
					}
				}
			}
		}

		render:

		View::rendertemplate('header',$data);
		View::render('admin/setting/setting',$data, $error);
		View::rendertemplate('footer',$data);
	}

	public function addphase() {

		$data['get_wo_task'] 	= $this->_setting->get_wo_task();
		$data['get_task_count'] = $this->_setting->get_task_count();
		$data['mailcount'] 		= $this->_setting->get_unread_mail_count(Session::get(IdUser));
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();
		$data['js'] 			=
			"
			<script src='".Url::get_template_path()."js/plugins/colorpicker/bootstrap-colorpicker.min.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() {
	                $('.phasecolor').colorpicker();
            	});
			</script>";

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// ADD NEW PHASE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Add') {
        		if(empty($_POST['PhaseName'])) {
					$error[] = _ERROR_PHASE_NAME_LANG_;
				} else if(empty($_POST['PhaseOrder'])) {
					$error[] = _ERROR_PHASE_ORDER_LANG_;
				} else {

					//DEFINE VARIABLE FOR INSERT TO DB	
					$CreatedDate 		= date('Y-m-d H:i:s');
					$PhaseName	   		= trim(strip_tags(isset($_POST['PhaseName']) ? $_POST['PhaseName'] : ''));
					$PhaseColor		   	= trim(strip_tags(isset($_POST['PhaseColor']) ? $_POST['PhaseColor'] : ''));
					$PhaseOrder	  		= trim(strip_tags(isset($_POST['PhaseOrder']) ? $_POST['PhaseOrder'] : ''));
					$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));

					//CHECK IF PHASE COLOR AND/OR PHASE ORDER EXIST
					$data['check_phase_color'] 	= $this->_setting->check_phase_color($_POST['PhaseColor']);
					$data['check_phase_order'] 	= $this->_setting->check_phase_order($_POST['PhaseOrder']);

					if ($data['check_phase_color'] > 0) {
						$error[] = _ERROR_EXIST_PHASE_COLOR_LANG_;
					} else if ($data['check_phase_order'] > 0) {
						$error[] = _ERROR_EXIST_PHASE_ORDER_LANG_;
					} else {
						$postdata = array(
										'PhaseName' 		=> $PhaseName,
										'PhaseColor' 		=> $PhaseColor,
										'PhaseOrder' 		=> $PhaseOrder,
										'IsActive' 			=> $IsActive,
										'CreatedDate' 		=> $CreatedDate,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
						$this->_setting->add_phase($postdata);
						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_PHASE_;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_setting->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						Session::set('successAddPhase', 1);
						Url::redirect('admin/setting');
					}
				
        		}
        }

		render:

		View::rendertemplate('header',$data);
		View::render('admin/setting/addphase',$data, $error);
		View::rendertemplate('footer',$data);
	}

	public function viewphase($id) {

		$data['get_wo_task'] 	= $this->_setting->get_wo_task();
		$data['get_task_count'] = $this->_setting->get_task_count();
		$data['mailcount'] 		= $this->_setting->get_unread_mail_count(Session::get(IdUser));
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();
		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/colorpicker/bootstrap-colorpicker.min.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //COLOR PICKER
			"<script type='text/javascript'>
				$(function() {
	                $('.phasecolor').colorpicker();
            	});
			</script>";
		$data['phasecount'] 	= $this->_setting->get_phase_wo_count($id);
		$data['get_phase_id'] 	= $this->_setting->get_phase_id($id);

        if ($data['get_phase_id']){
            foreach ($data['get_phase_id'] as $row) {
            	$data['PhaseId'] 		= $row->PhaseId;
				$data['PhaseName'] 		= $row->PhaseName;
				$data['PhaseColor'] 	= $row->PhaseColor;
				$data['PhaseOrder'] 	= $row->PhaseOrder;
				$data['IsActive']		= $row->IsActive;
            }
        }

        if ($id != $row->PhaseId) {
        	Session::set('InvalidPhase', 1);
        }

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// UPDATE PHASE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
				
        		//CHECK IF PHASE COLOR AND/OR PHASE ORDER EXIST
				$data['check_phase_color'] 	= $this->_setting->check_phase_color($_POST['PhaseColor']);
				$data['check_phase_order'] 	= $this->_setting->check_phase_order($_POST['PhaseOrder']);

				if(empty($_POST['PhaseName'])) {
					$error[] = _ERROR_PHASE_NAME_LANG_;
				} else if($data['check_phase_color'] > 0) {
					$error[] = _ERROR_EXIST_PHASE_COLOR_LANG_;
				} else if($data['check_phase_order'] > 0) {
					$error[] = _ERROR_EXIST_PHASE_ORDER_LANG_;
				} else {
				
					//DEFINE VARIABLE FOR INSERT TO DB	
					$UpdateDate 		= date('Y-m-d H:i:s');
					$PhaseId 			= isset($_POST['PhaseId']) ? $_POST['PhaseId'] : '';
					$PhaseName	   		= trim(strip_tags(isset($_POST['PhaseName']) ? $_POST['PhaseName'] : ''));
					$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));

					if(isset($_POST['PhaseColor']) && $_POST['PhaseColor'] != "") {
                		$PhaseColor = isset($_POST['PhaseColor']) ? $_POST['PhaseColor'] : '';
		            } else {
		                $PhaseColor = isset($_POST['PhaseColorOld']) ? $_POST['PhaseColorOld'] : '';
		            }

		            if(isset($_POST['PhaseOrder']) && $_POST['PhaseOrder'] != "") {
                		$PhaseOrder = isset($_POST['PhaseOrder']) ? $_POST['PhaseOrder'] : '';
		            } else {
		                $PhaseOrder = isset($_POST['PhaseOrderOld']) ? $_POST['PhaseOrderOld'] : '';
		            }


		            	$postdata = array(
										'PhaseName' 		=> $PhaseName,
										'PhaseColor' 		=> $PhaseColor,
										'PhaseOrder' 		=> $PhaseOrder,
										'IsActive' 			=> $IsActive,
										'LastUpdateDate' 	=> $UpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName)
									);   
						$where = array('PhaseId' => $id);     
						$this->_setting->update_phase($postdata, $where);
						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_PHASE_. ' ' .$PhaseName;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_setting->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						Session::set('successUpdatedPhase', 1);
						Url::redirect('admin/phase/view/'.$id);
		            

		            
			}
		}

		// DELETED
        if (isset($_POST['submit']) && $_POST['submit'] == 'x') {
        	if ($data['phasecount'] > 0) {
        		$error[] = _ERROR_PHASE_COUNT_ASSOCIATION_LANG_;
        	} else {
        		$postdata = array('PhaseId' => $id);      
				$this->_setting->delete_phase_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_PHASE_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_setting->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeletedPhase', 1);
				Url::redirect('admin/setting');
        	}
        }

		render:

		View::rendertemplate('header',$data);
		View::render('admin/setting/viewphase',$data, $error);
		View::rendertemplate('footer',$data);
	}

	public function addcurrency() {

		$data['get_wo_task'] 	= $this->_setting->get_wo_task();
		$data['get_task_count'] = $this->_setting->get_task_count();
		$data['mailcount'] 		= $this->_setting->get_unread_mail_count(Session::get(IdUser));
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// ADD NEW CURRENCY DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Add') {
        		if(empty($_POST['CurrencyName'])) {
					$error[] = _ERROR_CURRENCY_NAME_LANG_;
				} else if(empty($_POST['CurrencySymbol'])) {
					$error[] = _ERROR_CURRENCY_SYMBOL_LANG_;
				} else {

					//DEFINE VARIABLE FOR INSERT TO DB	
					$CreatedDate 		= date('Y-m-d H:i:s');
					$CurrencyName	   	= trim(strip_tags(isset($_POST['CurrencyName']) ? $_POST['CurrencyName'] : ''));
					$CurrencySymbol		= trim(strip_tags(isset($_POST['CurrencySymbol']) ? $_POST['CurrencySymbol'] : ''));
					$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));

					//CHECK IF CURRENCY NAME AND/OR CURRENCY SYMBOL EXIST
					$data['check_currency_name'] 	= $this->_setting->check_currency_name($_POST['CurrencyName']);
					$data['check_currency_symbol'] 	= $this->_setting->check_currency_symbol($_POST['CurrencySymbol']);

					if ($data['check_currency_name'] > 0) {
						$error[] = _ERROR_EXIST_CURRENCY_NAME_LANG_;
					} else if ($data['check_currency_symbol'] > 0) {
						$error[] = _ERROR_EXIST_CURRENCY_SYMBOL_LANG_;
					} else {
						$postdata = array(
										'CurrencyName' 		=> $CurrencyName,
										'CurrencySymbol' 	=> $CurrencySymbol,
										'IsActive' 			=> $IsActive,
										'CreatedDate' 		=> $CreatedDate,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
						$this->_setting->add_currency($postdata);
						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_CURRENCY_;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_setting->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						Session::set('successAddCurrency', 1);
						Url::redirect('admin/setting');
					}
				
        		}
        }

		render:

		View::rendertemplate('header',$data);
		View::render('admin/setting/addcurrency',$data, $error);
		View::rendertemplate('footer',$data);
	}

	public function viewcurrency($id) {

		$data['get_wo_task'] 	= $this->_setting->get_wo_task();
		$data['get_task_count'] = $this->_setting->get_task_count();
		$data['mailcount'] 		= $this->_setting->get_unread_mail_count(Session::get(IdUser));
		$data['currencycount'] 		= $this->_setting->get_currency_wo_count($id);
		$data['get_currency_id'] 	= $this->_setting->get_currency_id($id);
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

        if ($data['get_currency_id']){
            foreach ($data['get_currency_id'] as $row) {
            	$data['CurrencyId'] 		= $row->CurrencyId;
				$data['CurrencyName'] 		= $row->CurrencyName;
				$data['CurrencySymbol'] 	= $row->CurrencySymbol;
				$data['IsActive']			= $row->IsActive;
            }
        }

        if ($id != $row->CurrencyId) {
        	Session::set('InvalidCurrency', 1);
        }

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// UPDATE CURRENCY DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
				
        		//CHECK IF CURRENCY NAME AND/OR CURRENCY SYMBOL EXIST
				$data['check_currency_name'] 	= $this->_setting->check_currency_name($_POST['CurrencyName']);
				$data['check_currency_symbol'] 	= $this->_setting->check_currency_symbol($_POST['CurrencySymbol']);

				if($data['check_currency_name'] > 0) {
					$error[] = _ERROR_EXIST_CURRENCY_NAME_LANG_;
				} else if($data['check_currency_symbol'] > 0) {
					$error[] = _ERROR_EXIST_CURRENCY_SYMBOL_LANG_;
				} else {
				
					//DEFINE VARIABLE FOR INSERT TO DB	
					$UpdateDate 		= date('Y-m-d H:i:s');
					$CurrencyId 		= isset($_POST['PhaseId']) ? $_POST['PhaseId'] : '';
					$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));

					if(isset($_POST['CurrencyName']) && $_POST['CurrencyName'] != "") {
                		$CurrencyName = isset($_POST['CurrencyName']) ? $_POST['CurrencyName'] : '';
		            } else {
		                $CurrencyName = isset($_POST['CurrencyNameOld']) ? $_POST['CurrencyNameOld'] : '';
		            }

		            if(isset($_POST['CurrencySymbol']) && $_POST['CurrencySymbol'] != "") {
                		$CurrencySymbol = isset($_POST['CurrencySymbol']) ? $_POST['CurrencySymbol'] : '';
		            } else {
		                $CurrencySymbol = isset($_POST['CurrencySymbolOld']) ? $_POST['CurrencySymbolOld'] : '';
		            }


		            	$postdata = array(
										'CurrencyName' 		=> $CurrencyName,
										'CurrencySymbol' 	=> $CurrencySymbol,
										'IsActive' 			=> $IsActive,
										'LastUpdateDate' 	=> $UpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName)
									);   
						$where = array('CurrencyId' => $id);     
						$this->_setting->update_currency($postdata, $where);
						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_CURRENCY_. ' ' .$CurrencyName;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_setting->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						Session::set('successUpdatedCurrency', 1);
						Url::redirect('admin/currency/view/'.$id);
		            

		            
			}
		}

		// DELETED
        if (isset($_POST['submit']) && $_POST['submit'] == 'x') {
        	if ($data['currencycount'] > 0) {
        		$error[] = _ERROR_CURRENCY_COUNT_ASSOCIATION_LANG_;
        	} else {
        		$postdata = array('CurrencyId' => $id);      
				$this->_setting->delete_currency_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_CURRENCY_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_setting->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeletedCurrency', 1);
				Url::redirect('admin/setting');
        	}
        }

		render:

		View::rendertemplate('header',$data);
		View::render('admin/setting/viewcurrency',$data, $error);
		View::rendertemplate('footer',$data);
	}

	public function addrole() {

		$data['get_wo_task'] 	= $this->_setting->get_wo_task();
		$data['get_task_count'] = $this->_setting->get_task_count();
		$data['mailcount'] 		= $this->_setting->get_unread_mail_count(Session::get(IdUser));
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// ADD NEW ROLE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Add') {
        		if(empty($_POST['RoleName'])) {
					$error[] = _ERROR_ROLE_NAME_LANG_;
				} else if(empty($_POST['RoleDesc'])) {
					$error[] = _ERROR_ROLE_DESC_LANG_;
				} else {

					//DEFINE VARIABLE FOR INSERT TO DB	
					$CreatedDate 		= date('Y-m-d H:i:s');
					$RoleName	   	= trim(strip_tags(isset($_POST['RoleName']) ? $_POST['RoleName'] : ''));
					$RoleDesc		= trim(strip_tags(isset($_POST['RoleDesc']) ? $_POST['RoleDesc'] : ''));
					$IsActive		= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));
					$GeneralEdit	= trim(strip_tags(isset($_POST['GeneralEdit']) ? $_POST['GeneralEdit'] : ''));
					$TaskView		= trim(strip_tags(isset($_POST['TaskView']) ? $_POST['TaskView'] : ''));
					$TaskCreate		= trim(strip_tags(isset($_POST['TaskCreate']) ? $_POST['TaskCreate'] : ''));
					$TaskEdit		= trim(strip_tags(isset($_POST['TaskEdit']) ? $_POST['TaskEdit'] : ''));
					$TaskDelete		= trim(strip_tags(isset($_POST['TaskDelete']) ? $_POST['TaskDelete'] : ''));
					$ScheduleView 	= trim(strip_tags(isset($_POST['ScheduleView']) ? $_POST['ScheduleView'] : ''));
					$ScheduleCreate = trim(strip_tags(isset($_POST['ScheduleCreate']) ? $_POST['ScheduleCreate'] : ''));
					$ScheduleEdit 	= trim(strip_tags(isset($_POST['ScheduleEdit']) ? $_POST['ScheduleEdit'] : ''));
					$ScheduleDelete = trim(strip_tags(isset($_POST['ScheduleDelete']) ? $_POST['ScheduleDelete'] : ''));
					$MemberView 	= trim(strip_tags(isset($_POST['MemberView']) ? $_POST['MemberView'] : ''));
					$MemberCreate 	= trim(strip_tags(isset($_POST['MemberCreate']) ? $_POST['MemberCreate'] : ''));
					$MemberEdit 	= trim(strip_tags(isset($_POST['MemberEdit']) ? $_POST['MemberEdit'] : ''));
					$MemberDelete 	= trim(strip_tags(isset($_POST['MemberDelete']) ? $_POST['MemberDelete'] : ''));
					$FinanceView 	= trim(strip_tags(isset($_POST['FinanceView']) ? $_POST['FinanceView'] : ''));
					$FinanceCreate 	= trim(strip_tags(isset($_POST['FinanceCreate']) ? $_POST['FinanceCreate'] : ''));
					$FinanceEdit 	= trim(strip_tags(isset($_POST['FinanceEdit']) ? $_POST['FinanceEdit'] : ''));
					$FinanceDelete 	= trim(strip_tags(isset($_POST['FinanceDelete']) ? $_POST['FinanceDelete'] : ''));
					$AttachmentView = trim(strip_tags(isset($_POST['AttachmentView']) ? $_POST['AttachmentView'] : ''));
					$AttachmentCreate 	= trim(strip_tags(isset($_POST['AttachmentCreate']) ? $_POST['AttachmentCreate'] : ''));
					$AttachmentEdit 	= trim(strip_tags(isset($_POST['AttachmentEdit']) ? $_POST['AttachmentEdit'] : ''));
					$AttachmentDelete 	= trim(strip_tags(isset($_POST['AttachmentDelete']) ? $_POST['AttachmentDelete'] : ''));
					$InvoiceView 		= trim(strip_tags(isset($_POST['InvoiceView']) ? $_POST['InvoiceView'] : ''));
					$InvoiceCreate 		= trim(strip_tags(isset($_POST['InvoiceCreate']) ? $_POST['InvoiceCreate'] : ''));
					$InvoiceEdit 		= trim(strip_tags(isset($_POST['InvoiceEdit']) ? $_POST['InvoiceEdit'] : ''));
					$InvoiceDelete 		= trim(strip_tags(isset($_POST['InvoiceDelete']) ? $_POST['InvoiceDelete'] : ''));
					$InvoiceGenerate 	= trim(strip_tags(isset($_POST['InvoiceGenerate']) ? $_POST['InvoiceGenerate'] : ''));
					$InvoiceSend 		= trim(strip_tags(isset($_POST['InvoiceSend']) ? $_POST['InvoiceSend'] : ''));
					$PaymentCreate 		= trim(strip_tags(isset($_POST['PaymentCreate']) ? $_POST['PaymentCreate'] : ''));
					$PaymentEdit 		= trim(strip_tags(isset($_POST['PaymentEdit']) ? $_POST['PaymentEdit'] : ''));
					$PaymentDelete 		= trim(strip_tags(isset($_POST['PaymentDelete']) ? $_POST['PaymentDelete'] : ''));
					$ItemCreate 		= trim(strip_tags(isset($_POST['ItemCreate']) ? $_POST['ItemCreate'] : ''));
					$ItemEdit 			= trim(strip_tags(isset($_POST['ItemEdit']) ? $_POST['ItemEdit'] : ''));
					$ItemDelete 		= trim(strip_tags(isset($_POST['ItemDelete']) ? $_POST['ItemDelete'] : ''));
				
					//CHECK IF ROLE NAME EXIST
					$data['check_role_name'] 	= $this->_setting->check_role_name($_POST['RoleName']);

					if ($data['check_role_name'] > 0) {
						$error[] = _ERROR_EXIST_ROLE_NAME_LANG_;
					} else {
						$postdata = array(
										'RoleName' 			=> $RoleName,
										'RoleDesc' 			=> $RoleDesc,
										'IsActive' 			=> $IsActive,
										'GeneralEdit' 		=> $GeneralEdit,
										'TaskView' 			=> $TaskView,
										'TaskCreate' 		=> $TaskCreate,
										'TaskEdit' 			=> $TaskEdit,
										'TaskDelete' 		=> $TaskDelete,
										'ScheduleView' 		=> $ScheduleView,
										'ScheduleCreate' 	=> $ScheduleCreate,
										'ScheduleEdit' 		=> $ScheduleEdit,
										'ScheduleDelete' 	=> $ScheduleDelete,
										'MemberView' 		=> $MemberView,
										'MemberCreate' 		=> $MemberCreate,
										'MemberEdit' 		=> $MemberEdit,
										'MemberDelete' 		=> $MemberDelete,
										'FinanceView' 		=> $FinanceView,
										'FinanceCreate' 	=> $FinanceCreate,
										'FinanceEdit' 		=> $FinanceEdit,
										'FinanceDelete' 	=> $FinanceDelete,
										'AttachmentView' 	=> $AttachmentView,
										'AttachmentCreate' 	=> $AttachmentCreate,
										'AttachmentEdit' 	=> $AttachmentEdit,
										'AttachmentDelete' 	=> $AttachmentDelete,
										'InvoiceView' 		=> $InvoiceView,
										'InvoiceCreate' 	=> $InvoiceCreate,
										'InvoiceEdit' 		=> $InvoiceEdit,
										'InvoiceDelete' 	=> $InvoiceDelete,
										'InvoiceGenerate' 	=> $InvoiceGenerate,
										'InvoiceSendMail' 	=> $InvoiceSend,
										'PaymentCreate' 	=> $PaymentCreate,
										'PaymentEdit' 		=> $PaymentEdit,
										'PaymentDelete' 	=> $PaymentDelete,
										'ItemCreate' 		=> $ItemCreate,
										'ItemEdit' 			=> $ItemEdit,
										'ItemDelete' 		=> $ItemDelete,
										'CreatedDate' 		=> $CreatedDate,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
						$this->_setting->add_role($postdata);
						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_ROLE_;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_setting->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						Session::set('successAddRole', 1);
						Url::redirect('admin/setting');
					}
				
        		}
        }

		render:

		View::rendertemplate('header',$data);
		View::render('admin/setting/addrole',$data, $error);
		View::rendertemplate('footer',$data);
	}

	public function viewrole($id) {

		$data['get_wo_task'] 	= $this->_setting->get_wo_task();
		$data['get_task_count'] = $this->_setting->get_task_count();
		$data['mailcount'] 		= $this->_setting->get_unread_mail_count(Session::get(IdUser));
		$data['rolecount'] 		= $this->_setting->get_role_pm_count($id);
		$data['get_role_id'] 	= $this->_setting->get_role_id($id);
		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

        if ($data['get_role_id']){
            foreach ($data['get_role_id'] as $row) {
            	$data['RoleId'] 			= $row->RoleId;
				$data['RoleName'] 			= $row->RoleName;
				$data['RoleDesc'] 			= $row->RoleDesc;
				$data['IsActive']			= $row->IsActive;
				$data['GeneralEdit'] 		= $row->GeneralEdit;
				$data['TaskView'] 			= $row->TaskView;
				$data['TaskCreate'] 		= $row->TaskCreate;
				$data['TaskEdit'] 			= $row->TaskEdit;
				$data['TaskDelete'] 		= $row->TaskDelete;
				$data['ScheduleView'] 		= $row->ScheduleView;
				$data['ScheduleCreate'] 	= $row->ScheduleCreate;
				$data['ScheduleEdit'] 		= $row->ScheduleEdit;
				$data['ScheduleDelete'] 	= $row->ScheduleDelete;
				$data['MemberView'] 		= $row->MemberView;
				$data['MemberCreate'] 		= $row->MemberCreate;
				$data['MemberEdit'] 		= $row->MemberEdit;
				$data['MemberDelete'] 		= $row->MemberDelete;
				$data['FinanceView'] 		= $row->FinanceView;
				$data['FinanceCreate'] 		= $row->FinanceCreate;
				$data['FinanceEdit'] 		= $row->FinanceEdit;
				$data['FinanceDelete'] 		= $row->FinanceDelete;
				$data['AttachmentView'] 	= $row->AttachmentView;
				$data['AttachmentCreate'] 	= $row->AttachmentCreate;
				$data['AttachmentEdit'] 	= $row->AttachmentEdit;
				$data['AttachmentDelete'] 	= $row->AttachmentDelete;
				$data['InvoiceView'] 		= $row->InvoiceView;
				$data['InvoiceCreate'] 		= $row->InvoiceCreate;
				$data['InvoiceEdit'] 		= $row->InvoiceEdit;
				$data['InvoiceDelete'] 		= $row->InvoiceDelete;
				$data['InvoiceGenerate'] 	= $row->InvoiceGenerate;
				$data['InvoiceSendMail'] 	= $row->InvoiceSendMail;
				$data['PaymentCreate'] 		= $row->PaymentCreate;
				$data['PaymentEdit'] 		= $row->PaymentEdit;
				$data['PaymentDelete'] 		= $row->PaymentDelete;
				$data['ItemCreate'] 		= $row->ItemCreate;
				$data['ItemEdit'] 			= $row->ItemEdit;
				$data['ItemDelete'] 		= $row->ItemDelete;
            }
        }

        if ($id != $row->RoleId) {
        	Session::set('InvalidRole', 1);
        }

		// check csrf
		if (isset($_POST['submit'])){
			if ( ! csrfhelper::validate( $_POST ) ) :

				$error[] = "Token was not valid !";

				goto render;

			endif;
		}

		// UPDATE ROLE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
				
        		//CHECK IF ROLE NAME EXIST
				$data['check_role_name'] 	= $this->_setting->check_role_name($_POST['RoleName']);

				if($data['check_role_name'] > 0) {
					$error[] = _ERROR_EXIST_ROLE_NAME_LANG_;
				} else {
				
					//DEFINE VARIABLE FOR INSERT TO DB	
					$UpdateDate 		= date('Y-m-d H:i:s');
					$RoleId 			= isset($_POST['RoleId']) ? $_POST['RoleId'] : '';
					$RoleDesc			= trim(strip_tags(isset($_POST['RoleDesc']) ? $_POST['RoleDesc'] : ''));
					$IsActive			= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));
					$GeneralEdit		= trim(strip_tags(isset($_POST['GeneralEdit']) ? $_POST['GeneralEdit'] : ''));
					$TaskView			= trim(strip_tags(isset($_POST['TaskView']) ? $_POST['TaskView'] : ''));
					$TaskCreate			= trim(strip_tags(isset($_POST['TaskCreate']) ? $_POST['TaskCreate'] : ''));
					$TaskEdit			= trim(strip_tags(isset($_POST['TaskEdit']) ? $_POST['TaskEdit'] : ''));
					$TaskDelete			= trim(strip_tags(isset($_POST['TaskDelete']) ? $_POST['TaskDelete'] : ''));
					$ScheduleView 		= trim(strip_tags(isset($_POST['ScheduleView']) ? $_POST['ScheduleView'] : ''));
					$ScheduleCreate 	= trim(strip_tags(isset($_POST['ScheduleCreate']) ? $_POST['ScheduleCreate'] : ''));
					$ScheduleEdit 		= trim(strip_tags(isset($_POST['ScheduleEdit']) ? $_POST['ScheduleEdit'] : ''));
					$ScheduleDelete 	= trim(strip_tags(isset($_POST['ScheduleDelete']) ? $_POST['ScheduleDelete'] : ''));
					$MemberView 		= trim(strip_tags(isset($_POST['MemberView']) ? $_POST['MemberView'] : ''));
					$MemberCreate 		= trim(strip_tags(isset($_POST['MemberCreate']) ? $_POST['MemberCreate'] : ''));
					$MemberEdit 		= trim(strip_tags(isset($_POST['MemberEdit']) ? $_POST['MemberEdit'] : ''));
					$MemberDelete 		= trim(strip_tags(isset($_POST['MemberDelete']) ? $_POST['MemberDelete'] : ''));
					$FinanceView 		= trim(strip_tags(isset($_POST['FinanceView']) ? $_POST['FinanceView'] : ''));
					$FinanceCreate 		= trim(strip_tags(isset($_POST['FinanceCreate']) ? $_POST['FinanceCreate'] : ''));
					$FinanceEdit 		= trim(strip_tags(isset($_POST['FinanceEdit']) ? $_POST['FinanceEdit'] : ''));
					$FinanceDelete 		= trim(strip_tags(isset($_POST['FinanceDelete']) ? $_POST['FinanceDelete'] : ''));
					$AttachmentView 	= trim(strip_tags(isset($_POST['AttachmentView']) ? $_POST['AttachmentView'] : ''));
					$AttachmentCreate 	= trim(strip_tags(isset($_POST['AttachmentCreate']) ? $_POST['AttachmentCreate'] : ''));
					$AttachmentEdit 	= trim(strip_tags(isset($_POST['AttachmentEdit']) ? $_POST['AttachmentEdit'] : ''));
					$AttachmentDelete 	= trim(strip_tags(isset($_POST['AttachmentDelete']) ? $_POST['AttachmentDelete'] : ''));
					$InvoiceView 		= trim(strip_tags(isset($_POST['InvoiceView']) ? $_POST['InvoiceView'] : ''));
					$InvoiceCreate 		= trim(strip_tags(isset($_POST['InvoiceCreate']) ? $_POST['InvoiceCreate'] : ''));
					$InvoiceEdit 		= trim(strip_tags(isset($_POST['InvoiceEdit']) ? $_POST['InvoiceEdit'] : ''));
					$InvoiceDelete 		= trim(strip_tags(isset($_POST['InvoiceDelete']) ? $_POST['InvoiceDelete'] : ''));
					$InvoiceGenerate 	= trim(strip_tags(isset($_POST['InvoiceGenerate']) ? $_POST['InvoiceGenerate'] : ''));
					$InvoiceSend 		= trim(strip_tags(isset($_POST['InvoiceSend']) ? $_POST['InvoiceSend'] : ''));
					$PaymentCreate 		= trim(strip_tags(isset($_POST['PaymentCreate']) ? $_POST['PaymentCreate'] : ''));
					$PaymentEdit 		= trim(strip_tags(isset($_POST['PaymentEdit']) ? $_POST['PaymentEdit'] : ''));
					$PaymentDelete 		= trim(strip_tags(isset($_POST['PaymentDelete']) ? $_POST['PaymentDelete'] : ''));
					$ItemCreate 		= trim(strip_tags(isset($_POST['ItemCreate']) ? $_POST['ItemCreate'] : ''));
					$ItemEdit 			= trim(strip_tags(isset($_POST['ItemEdit']) ? $_POST['ItemEdit'] : ''));
					$ItemDelete 		= trim(strip_tags(isset($_POST['ItemDelete']) ? $_POST['ItemDelete'] : ''));
					$IsActive		   	= trim(strip_tags(isset($_POST['On']) ? $_POST['On'] : ''));

					if(isset($_POST['RoleName']) && $_POST['RoleName'] != "") {
                		$RoleName = isset($_POST['RoleName']) ? $_POST['RoleName'] : '';
		            } else {
		                $RoleName = isset($_POST['RoleNameOld']) ? $_POST['RoleNameOld'] : '';
		            }

		           
		            	$postdata = array(
										'RoleName' 			=> $RoleName,
										'RoleDesc' 			=> $RoleDesc,
										'IsActive' 			=> $IsActive,
										'GeneralEdit' 		=> $GeneralEdit,
										'TaskView' 			=> $TaskView,
										'TaskCreate' 		=> $TaskCreate,
										'TaskEdit' 			=> $TaskEdit,
										'TaskDelete' 		=> $TaskDelete,
										'ScheduleView' 		=> $ScheduleView,
										'ScheduleCreate' 	=> $ScheduleCreate,
										'ScheduleEdit' 		=> $ScheduleEdit,
										'ScheduleDelete' 	=> $ScheduleDelete,
										'MemberView' 		=> $MemberView,
										'MemberCreate' 		=> $MemberCreate,
										'MemberEdit' 		=> $MemberEdit,
										'MemberDelete' 		=> $MemberDelete,
										'FinanceView' 		=> $FinanceView,
										'FinanceCreate' 	=> $FinanceCreate,
										'FinanceEdit' 		=> $FinanceEdit,
										'FinanceDelete' 	=> $FinanceDelete,
										'AttachmentView' 	=> $AttachmentView,
										'AttachmentCreate' 	=> $AttachmentCreate,
										'AttachmentEdit' 	=> $AttachmentEdit,
										'AttachmentDelete' 	=> $AttachmentDelete,
										'InvoiceView' 		=> $InvoiceView,
										'InvoiceCreate' 	=> $InvoiceCreate,
										'InvoiceEdit' 		=> $InvoiceEdit,
										'InvoiceDelete' 	=> $InvoiceDelete,
										'InvoiceGenerate' 	=> $InvoiceGenerate,
										'InvoiceSendMail' 	=> $InvoiceSend,
										'PaymentCreate' 	=> $PaymentCreate,
										'PaymentEdit' 		=> $PaymentEdit,
										'PaymentDelete' 	=> $PaymentDelete,
										'ItemCreate' 		=> $ItemCreate,
										'ItemEdit' 			=> $ItemEdit,
										'ItemDelete' 		=> $ItemDelete,
										'LastUpdateDate' 	=> $UpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName)
									);   
						$where = array('RoleId' => $id);     
						$this->_setting->update_role($postdata, $where);
						/*
						 *---------------------------------------------------------------
						 * AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						$CreatedDate 		= date('Y-m-d H:i:s');
						$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_ROLE_. ' ' .$RoleName;

					    $auditdata = array(
											'CreatedDate' 		=> $CreatedDate,
											'AuditContent' 		=> $AuditContent,
											'CreatedUser' 		=> Session::get(IdUser)
										);     
						$this->_setting->insert_audit_data($auditdata);
						/*
						 *---------------------------------------------------------------
						 * END AUDIT TRAILS
						 *---------------------------------------------------------------
						 */
						Session::set('successUpdatedRole', 1);
						Url::redirect('admin/role/view/'.$id);
		            

		            
			}
		}

		// DELETED
        if (isset($_POST['submit']) && $_POST['submit'] == 'x') {
        	if ($data['rolecount'] > 0) {
        		$error[] = _ERROR_ROLE_COUNT_ASSOCIATION_LANG_;
        	} else {
        		$postdata = array('RoleId' => $id);      
				$this->_setting->delete_role_data($postdata);
				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_ROLE_;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_setting->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				Session::set('successDeletedCurrency', 1);
				Url::redirect('admin/setting');
        	}
        }

		render:

		View::rendertemplate('header',$data);
		View::render('admin/setting/viewrole',$data, $error);
		View::rendertemplate('footer',$data);
	}

}