<?php namespace controllers\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       controllers/invoice.php
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
 	\helpers\url as Url;
use Helpers\csrfhelper;

class Invoice extends \core\controller{

	private $_invoice;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_invoice = new \models\admin\invoice();
		if(Session::get('loggedin') == false) {
			Url::redirect('admin/login');
		}
	}

	public function index(){

		$data['get_wo_task'] 	= $this->_invoice->get_wo_task();
		$data['get_task_count'] = $this->_invoice->get_task_count();
		$data['mailcount'] 		= $this->_invoice->get_unread_mail_count(Session::get(IdUser));
		$data['get_invoice'] 	= $this->_invoice->get_invoice();

		$data['js'] 			=
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= //DATA TABLES
			"<script type='text/javascript'>
				$(function() { 
					$('#all-invoices').dataTable({
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
		View::render('admin/invoice/invoice',$data);
		View::rendertemplate('footer',$data);
	}


	public function view($id){
		
		$data['get_wo_task'] 			= $this->_invoice->get_wo_task();
		$data['get_task_count'] 		= $this->_invoice->get_task_count();
		$data['mailcount'] 				= $this->_invoice->get_unread_mail_count(Session::get(IdUser));
		$data['get_invoice_item'] 		= $this->_invoice->get_invoice_item($id);
		$data['get_invoice_payment'] 	= $this->_invoice->get_invoice_payment($id);
		
		$data['owner_info'] 			= $this->_invoice->get_owner(1);

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
		

		$data['get_sub_total_invoice'] 	= $this->_invoice->get_sub_total_invoice($id);

		if ($data['get_sub_total_invoice']) {
            foreach ($data['get_sub_total_invoice'] as $row) {
               $data['InvoiceSubTotalAmountItem'] 	= $row->InvoiceSubTotalAmountItem;
            }
        }

        $data['get_payment_total_invoice'] 	= $this->_invoice->get_payment_total_invoice($id);

		if ($data['get_payment_total_invoice']) {
            foreach ($data['get_payment_total_invoice'] as $row) {
               $data['InvoicePaymentTotal'] 	= $row->InvoicePaymentTotal;
            }
        }

		$data['owner_info'] 			= $this->_invoice->get_owner(1);

		if ($data['owner_info']) {
            foreach ($data['owner_info'] as $row) {
               $data['ownerName'] 	= $row->ownerName;
               $data['ownerAddress'] = $row->ownerAddress;
               $data['ownerEmail'] 	= $row->ownerEmail;
               $data['ownerPhone'] 	= $row->ownerPhone;
            }
        }

		$data['rows'] 					= $this->_invoice->view_invoice($id);

		if ($data['rows']){
            foreach ($data['rows'] as $row) {
            	$data['invoiceId'] 				= $row->invoiceId;
				$data['IdClient'] 				= $row->IdClient;
				$data['IdProject'] 				= $row->IdProject;
				$data['invoiceNumber'] 			= $row->invoiceNumber;
				$data['invoiceClientReference'] = $row->invoiceClientReference;
				$data['invoiceCompanyReference'] = $row->invoiceCompanyReference;
				$data['InvoiceDate'] 			= $row->InvoiceDate;
				$data['nInvoiceDate'] 			= $row->nInvoiceDate;
				$data['InvoiceDueDate'] 		= $row->InvoiceDueDate;
				$data['nInvoiceDueDate'] 		= $row->nInvoiceDueDate;
				$data['invoiceCurrency'] 		= $row->invoiceCurrency;
				$data['invoiceSubtotal'] 		= $row->invoiceSubtotal;
				$data['invoiceTax'] 			= $row->invoiceTax;
				$data['invoiceTaxRate'] 		= $row->invoiceTaxRate;
				$data['invoiceTotalPaid'] 		= $row->invoiceTotalPaid;
				$data['invoiceTotalDue'] 		= $row->invoiceTotalDue;
				$data['invoiceNote'] 			= $row->invoiceNote;
				$data['invoiceStatus'] 			= $row->invoiceStatus;
				$data['isSync'] 				= $row->isSync;
				$data['isGenerated'] 			= $row->isGenerated;
				$data['isCompleted'] 			= $row->isCompleted;
				$data['invoiceClientAddress'] 	= $row->invoiceClientAddress;
				$data['invoiceAddress'] 		= $row->invoiceAddress;
				$data['LastUpdateDate'] 		= $row->LastUpdateDate;
				$data['nLastUpdateDate'] 		= $row->nLastUpdateDate;
				$data['LastUpdateUser'] 		= $row->LastUpdateUser;
				$data['CreatedDate'] 			= $row->CreatedDate;
				$data['CreatedUser'] 			= $row->CreatedUser;
				$data['IdProject'] 				= $row->IdProject;
				$data['CurrencyId'] 			= $row->CurrencyId;
				$data['CurrencyName'] 			= $row->CurrencyName;
				$data['CurrencySymbol'] 		= $row->CurrencySymbol;
				$data['PhaseId'] 				= $row->PhaseId;
				$data['PhaseName'] 				= $row->PhaseName;
				$data['PhaseColor'] 			= $row->PhaseColor;
				$data['IdUser'] 				= $row->IdUser;
				$data['AdminName'] 				= $row->AdminName;
				$data['IdClient'] 				= $row->IdClient;
				$data['ClientName'] 			= $row->ClientName;
				$data['Username'] 				= $row->Username;
				$data['Password'] 				= $row->Password;
				$data['ClientEmail'] 			= $row->ClientEmail;
				$data['ClientAddress'] 			= $row->ClientAddress;
				$data['ClientPhone'] 			= $row->ClientPhone;
				$data['ClientCellPhone'] 		= $row->ClientCellPhone;
            }
        }

        if ($id != $row->invoiceId) {
        	Session::set('InvalidInvoice', 1);
        }

        if (Session::get('Level') == 3) {

			$data['get_member_invoice_access'] 	= $this->_invoice->get_member_invoice_access($row->IdProject);

			if ($data['get_member_invoice_access']){
	            foreach ($data['get_member_invoice_access'] as $member) {
	            	$data['IdMember'] 		= $member->IdMember;
					$data['MemberProject'] 	= $member->MemberProject;
					$data['MemberId'] 		= $member->MemberId;
					$data['RoleId'] 		= $member->RoleId;
					$data['IdProject'] 		= $member->IdProject;
					$data['invoiceProject'] = $member->invoiceProject;
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
	        	Session::set('InvalidAccessInvoice', 1);
	        }
        
        }

        
		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/bootstrap-datepicker.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= 
			"<script type='text/javascript'>
				$(function() { 
					$('.datepicker').datepicker({
				    	format: 'yyyy-mm-dd'
					}); 
					$('#all-payments').dataTable({
			            'bPaginate': false,
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

		// ADD NEW INVOICE ITEM DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-invoice-item') {

				if(empty($_POST['ItemTitle'])) {
					$error[] = _ERROR_ITEM_TITLE_LANG_;
				} else if(empty($_POST['ItemDesc'])) {
					$error[] = _ERROR_ITEM_DESC_LANG_;
				} else if(!filter_var($_POST['ItemQty'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_FORMAT_QTY_LANG_;
				} else if(empty($_POST['ItemQty'])) {
					$error[] = _ERROR_QTY_LANG_;
				} else if(!filter_var($_POST['ItemAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_FORMAT_ITEM_AMOUT_LANG_;
				} else if(empty($_POST['ItemAmount'])) {
					$error[] = _ERROR_ITEM_AMOUT_LANG_;
				} else if($_POST['ItemQty'] < 0) {
					$error[] = _ERROR_NEGATIVE_AMOUT_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 		= date('Y-m-d H:i:s');
				$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$ItemTitle 			= trim(strip_tags(isset($_POST['ItemTitle']) ? $_POST['ItemTitle'] : ''));
				$ItemDesc 			= trim(strip_tags(isset($_POST['ItemDesc']) ? $_POST['ItemDesc'] : ''));
				$ItemQty	   		= trim(strip_tags(isset($_POST['ItemQty']) ? $_POST['ItemQty'] : ''));
				$ItemAmount	  		= trim(strip_tags(isset($_POST['ItemAmount']) ? $_POST['ItemAmount'] : ''));
				$ItemTotalAmount	= $ItemAmount * $ItemQty;
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$isSync				= 0;

				$itemdata = array(
									'IdProject' 		=> $IdProject,
									'IdClient' 			=> $IdClient,
									'invoiceId' 		=> $invoiceId,
									'ItemTitle' 		=> $ItemTitle,
									'ItemDesc' 			=> $ItemDesc,
									'ItemQty' 			=> $ItemQty,
									'ItemAmount' 		=> $ItemAmount,
									'ItemTotalAmount' 	=> $ItemTotalAmount,
									'CreatedDate' 		=> $CreatedDate,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_item_data($itemdata);

				$invoicedata = array(
									'isSync' 			=> $isSync,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('invoiceId' => $invoiceId);     
				$this->_invoice->update_invoice_data($invoicedata, $where);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_INVOICE_ITEM_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */

				Session::set('newCalculatedInvoice'.$invoiceId, 1);
				Url::redirect('admin/invoice/view/'.$invoiceId);
				
			}
		}

		// UPDATE INVOICE ITEM DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'edit-invoice-item') {

				if(empty($_POST['ItemTitle'])) {
					$error[] = _ERROR_ITEM_TITLE_LANG_;
				} else if(empty($_POST['ItemDesc'])) {
					$error[] = _ERROR_ITEM_DESC_LANG_;
				} else if(!filter_var($_POST['ItemQty'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_FORMAT_QTY_LANG_;
				} else if(empty($_POST['ItemQty'])) {
					$error[] = _ERROR_QTY_LANG_;
				} else if(!filter_var($_POST['ItemAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_FORMAT_ITEM_AMOUT_LANG_;
				} else if(empty($_POST['ItemAmount'])) {
					$error[] = _ERROR_ITEM_AMOUT_LANG_;
				} else if($_POST['ItemQty'] < 0) {
					$error[] = _ERROR_NEGATIVE_AMOUT_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$ItemId 			= trim(strip_tags(isset($_POST['ItemId']) ? $_POST['ItemId'] : ''));
				$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$ItemTitle 			= trim(strip_tags(isset($_POST['ItemTitle']) ? $_POST['ItemTitle'] : ''));
				$ItemDesc 			= trim(strip_tags(isset($_POST['ItemDesc']) ? $_POST['ItemDesc'] : ''));
				$ItemQty	   		= trim(strip_tags(isset($_POST['ItemQty']) ? $_POST['ItemQty'] : ''));
				$ItemAmount	  		= trim(strip_tags(isset($_POST['ItemAmount']) ? $_POST['ItemAmount'] : ''));
				$ItemTotalAmount	= $ItemAmount * $ItemQty;
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$isSync				= 0;

				$postdata = array(
									'IdProject' 		=> $IdProject,
									'IdClient' 			=> $IdClient,
									'invoiceId' 		=> $invoiceId,
									'ItemTitle' 		=> $ItemTitle,
									'ItemDesc' 			=> $ItemDesc,
									'ItemQty' 			=> $ItemQty,
									'ItemAmount' 		=> $ItemAmount,
									'ItemTotalAmount' 	=> $ItemTotalAmount,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('ItemId' => $ItemId); 
				$this->_invoice->update_item_data($postdata, $where);  

				$invoicedata = array(
									'isSync' 			=> $isSync,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('invoiceId' => $invoiceId);     
				$this->_invoice->update_invoice_data($invoicedata, $where);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_INVOICE_ITEM_AUDIT_LANG_. ' ' .$data['invoiceNumber']. ' => ' .$ItemTitle;

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */  

				Session::set('newCalculatedInvoice'.$invoiceId, 1);
				Url::redirect('admin/invoice/view/'.$invoiceId);
				
			}
		}

		// DELETE INVOICE ITEM DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-invoice-item') {

        		$ItemId 			= trim(strip_tags(isset($_POST['ItemId']) ? $_POST['ItemId'] : ''));
        		$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$isSync				= 0;

	        	$postdata = array('ItemId' => $ItemId);      
				$this->_invoice->delete_item_data($postdata);

				$invoicedata = array(
									'isSync' 			=> $isSync,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('invoiceId' => $invoiceId);     
				$this->_invoice->update_invoice_data($invoicedata, $where);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_INVOICE_ITEM_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */  
				
				Session::set('newCalculatedInvoice'.$invoiceId, 1);
				Url::redirect('admin/invoice/view/'.$invoiceId);
        }

        // ADD NEW INVOICE PAYMENT DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'add-invoice-payment') {

				if(empty($_POST['PaymentDate'])) {
					$error[] = _ERROR_PAYMENT_DATE_LANG_;
				} else if(empty($_POST['PaymentType'])) {
					$error[] = _ERROR_PAYMENT_TYPE_LANG_;
				} else if(!filter_var($_POST['PaymentAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_FORMAT_PAYMENT_AMOUT_LANG_;
				} else if(empty($_POST['PaymentAmount'])) {
					$error[] = _ERROR_PAYMENT_AMOUT_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$CreatedDate 		= date('Y-m-d H:i:s');
				$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$PaymentDate 		= trim(strip_tags(isset($_POST['PaymentDate']) ? $_POST['PaymentDate'] : ''));
				$PaymentType 		= trim(strip_tags(isset($_POST['PaymentType']) ? $_POST['PaymentType'] : ''));
				$PaymentAmount	   	= trim(strip_tags(isset($_POST['PaymentAmount']) ? $_POST['PaymentAmount'] : ''));
				$PaymentNotes	  	= trim(strip_tags(isset($_POST['PaymentNotes']) ? $_POST['PaymentNotes'] : ''));
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$isSync				= 0;

				$paymentdata = array(
									'IdProject' 		=> $IdProject,
									'IdClient' 			=> $IdClient,
									'invoiceId' 		=> $invoiceId,
									'PaymentDate' 		=> $PaymentDate,
									'PaymentType' 		=> $PaymentType,
									'PaymentAmount' 	=> $PaymentAmount,
									'PaymentNotes' 		=> $PaymentNotes,
									'CreatedDate' 		=> $CreatedDate,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_payment_data($paymentdata);

				$invoicedata = array(
									'isSync' 			=> $isSync,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('invoiceId' => $invoiceId);     
				$this->_invoice->update_invoice_data($invoicedata, $where);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_ADD_INVOICE_PAYMENT_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */ 

				Session::set('newCalculatedInvoice'.$invoiceId, 1);
				Url::redirect('admin/invoice/view/'.$invoiceId);
				
			}
		}

		// UPDATE INVOICE PAYMENT DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'edit-invoice-payment') {

				if(empty($_POST['PaymentDate'])) {
					$error[] = _ERROR_PAYMENT_DATE_LANG_;
				} else if(empty($_POST['PaymentType'])) {
					$error[] = _ERROR_PAYMENT_TYPE_LANG_;
				} else if(!filter_var($_POST['PaymentAmount'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_FORMAT_PAYMENT_AMOUT_LANG_;
				} else if(empty($_POST['PaymentAmount'])) {
					$error[] = _ERROR_PAYMENT_AMOUT_LANG_;
				} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$IdPayment 			= trim(strip_tags(isset($_POST['IdPayment']) ? $_POST['IdPayment'] : ''));
				$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$PaymentDate 		= trim(strip_tags(isset($_POST['PaymentDate']) ? $_POST['PaymentDate'] : ''));
				$PaymentType 		= trim(strip_tags(isset($_POST['PaymentType']) ? $_POST['PaymentType'] : ''));
				$PaymentAmount	   	= trim(strip_tags(isset($_POST['PaymentAmount']) ? $_POST['PaymentAmount'] : ''));
				$PaymentNotes	  	= trim(strip_tags(isset($_POST['PaymentNotes']) ? $_POST['PaymentNotes'] : ''));
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$isSync				= 0;

				$paymentdata = array(
									'IdProject' 		=> $IdProject,
									'IdClient' 			=> $IdClient,
									'invoiceId' 		=> $invoiceId,
									'PaymentDate' 		=> $PaymentDate,
									'PaymentType' 		=> $PaymentType,
									'PaymentAmount' 	=> $PaymentAmount,
									'PaymentNotes' 		=> $PaymentNotes,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('IdPayment' => $IdPayment); 
				$this->_invoice->update_payment_data($paymentdata, $where); 

				$invoicedata = array(
									'isSync' 			=> $isSync,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('invoiceId' => $invoiceId);     
				$this->_invoice->update_invoice_data($invoicedata, $where);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_INVOICE_PAYMENT_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */    

				Session::set('newCalculatedInvoice'.$invoiceId, 1);
				Url::redirect('admin/invoice/view/'.$invoiceId);
				
			}
		}

		// DELETE INVOICE PAYMENT DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-invoice-payment') {

        		$IdPayment 			= trim(strip_tags(isset($_POST['IdPayment']) ? $_POST['IdPayment'] : ''));
        		$IdProject 			= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 			= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$isSync				= 0;

	        	$paymentdata = array('IdPayment' => $IdPayment);      
				$this->_invoice->delete_payment_data($paymentdata);

				$invoicedata = array(
									'isSync' 			=> $isSync,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('invoiceId' => $invoiceId);     
				$this->_invoice->update_invoice_data($invoicedata, $where);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_INVOICE_PAYMENT_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */    
				
				Session::set('newCalculatedInvoice'.$invoiceId, 1);
				Url::redirect('admin/invoice/view/'.$invoiceId);
        }

		// UPDATE/SYNC INVOICE CALCULATION DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-invoice-calculation') {


				//DEFINE VARIABLE FOR INSERT TO DB	
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$invoiceSubtotal	= trim(strip_tags(isset($_POST['invoiceSubtotal']) ? $_POST['invoiceSubtotal'] : ''));
				$invoiceTax	 		= trim(strip_tags(isset($_POST['invoiceTax']) ? $_POST['invoiceTax'] : ''));
				$invoiceTotalPaid	= trim(strip_tags(isset($_POST['invoiceTotalPaid']) ? $_POST['invoiceTotalPaid'] : ''));
				$invoiceTotalDue	= trim(strip_tags(isset($_POST['invoiceTotalDue']) ? $_POST['invoiceTotalDue'] : ''));
				$invoiceStatus		= 0;
				$isSync				= 1;
				$isGenerated		= 0;
				$isCompleted		= 0;

				$invoicedata = array(
									'invoiceSubtotal' 	=> $invoiceSubtotal,
									'invoiceTax' 		=> $invoiceTax,
									'invoiceTotalPaid' 	=> $invoiceTotalPaid,
									'invoiceTotalDue' 	=> $invoiceTotalDue,
									'invoiceStatus' 	=> $invoiceStatus,
									'isSync' 			=> $isSync,
									'isGenerated' 		=> $isGenerated,
									'isCompleted' 		=> $isCompleted,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
				$where = array('invoiceId' => $invoiceId);     
				$this->_invoice->update_invoice_data($invoicedata, $where);

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_SYNC_INVOICE_CALCULATION_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */   

				Session::pull('newCalculatedInvoice'.$invoiceId);
				Session::set('successInvoiceCalculation', 1);

				Session::set('needGenerateInvoice'.$row->invoiceId, 1);

				Url::redirect('admin/invoice/view/'.$invoiceId);
		}

        // UPDATE WORK ORDER INVOICE
        if (isset($_POST['submit']) && $_POST['submit'] == 'update-wo-invoice') {

        		//CHECK IF INVOICE NUMBER EXIST
				$data['check_invoice_number'] = $this->_invoice->check_invoice_number($_POST['invoiceNumber']);

				if(empty($_POST['invoiceDate'])) {
					$error[] = _ERROR_INVOICE_DATE_LANG_;
				} else if(empty($_POST['invoiceDueDate'])) {
					$error[] = _ERROR_INVOICE_DUE_DATE_LANG_;
				} else if(!filter_var($_POST['invoiceTaxRate'], FILTER_VALIDATE_FLOAT)) {
    				$error[] = _ERROR_FORMAT_INVOICE_TAX_RATE_LANG_;
				} else if(empty($_POST['invoiceTaxRate'])) {
					$error[] = _ERROR_INVOICE_TAX_RATE_LANG_;
				} else if ($data['check_invoice_number'] > 0){
					$error[] = _ERROR_EXIST_INVOICE_NUMBER_LANG_;
				} else {

					//DEFINE VARIABLE FOR INSERT TO DB	
					$LastUpdateDate 	= date('Y-m-d H:i:s');
					$invoiceId		= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
					$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
					$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));
					$invoiceClientReference 	= trim(strip_tags(isset($_POST['invoiceClientReference']) ? $_POST['invoiceClientReference'] : ''));
					$invoiceCompanyReference 	= trim(strip_tags(isset($_POST['invoiceCompanyReference']) ? $_POST['invoiceCompanyReference'] : ''));
					$invoiceDate 	= trim(strip_tags(isset($_POST['invoiceDate']) ? $_POST['invoiceDate'] : ''));
					$invoiceDueDate = trim(strip_tags(isset($_POST['invoiceDueDate']) ? $_POST['invoiceDueDate'] : ''));
					$invoiceTaxRate	= trim(strip_tags(isset($_POST['invoiceTaxRate']) ? $_POST['invoiceTaxRate'] : ''));
					$invoiceCurrency	= trim(strip_tags(isset($_POST['invoiceCurrency']) ? $_POST['invoiceCurrency'] : ''));
					$invoiceNote	= trim(strip_tags(isset($_POST['invoiceNote']) ? $_POST['invoiceNote'] : ''));
					$invoiceStatus		= 0;
					$isSync				= 0;
					$isGenerated		= 0;
					$isCompleted		= 0;

					if(isset($_POST['invoiceNumber']) && $_POST['invoiceNumber'] != "") {
                		$invoiceNumber = Gump::clean(isset($_POST['invoiceNumber']) ? $_POST['invoiceNumber'] : '');
		            } else {
		                $invoiceNumber = isset($_POST['invoiceNumberOld']) ? $_POST['invoiceNumberOld'] : '';
		            }

					$invoiceinfodata = array(
										'IdClient' 			=> $IdClient,
										'IdProject' 		=> $IdProject,
										'invoiceNumber' 	=> $invoiceNumber,
										'invoiceClientReference' 	=> $invoiceClientReference,
										'invoiceCompanyReference' 	=> $invoiceCompanyReference,
										'invoiceDate' 		=> $invoiceDate,
										'invoiceDueDate' 	=> $invoiceDueDate,
										'invoiceCurrency' 	=> $invoiceCurrency,
										'invoiceTaxRate' 	=> $invoiceTaxRate,
										'invoiceNote' 		=> $invoiceNote,
										'invoiceStatus' 	=> $invoiceStatus,
										'isSync' 			=> $isSync,
										'isGenerated' 		=> $isGenerated,
										'isCompleted' 		=> $isCompleted,
										'LastUpdateDate' 	=> $LastUpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName)
									);     
					$where = array('invoiceId' => $invoiceId);     
					$this->_invoice->update_invoice_data($invoiceinfodata, $where);
					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_UPDATE_INVOICE_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_invoice->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					Session::set('newCalculatedInvoice'.$invoiceId, 1);
					Url::redirect('admin/invoice/view/'.$invoiceId);
        		}
    	}	

    	 // COMPLETE WORK ORDER INVOICE
        if (isset($_POST['submit']) && $_POST['submit'] == 'complete-wo-invoice') {

					//DEFINE VARIABLE FOR INSERT TO DB	
					$LastUpdateDate 	= date('Y-m-d H:i:s');
					$isCompleted		= 1;


					$completedata = array(
										'isCompleted' 		=> $isCompleted,
										'LastUpdateDate' 	=> $LastUpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName)
									);     
					$where = array('invoiceId' => $data['invoiceId']);     
					$this->_invoice->update_invoice_data($completedata, $where);
					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_COMPLETE_INVOICE_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_invoice->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					Url::redirect('admin/invoice/view/'.$row->invoiceId);
    	}	

    	// ROLL BACK WORK ORDER INVOICE
        if (isset($_POST['submit']) && $_POST['submit'] == 'incomplete-wo-invoice') {

					//DEFINE VARIABLE FOR INSERT TO DB	
					$LastUpdateDate 	= date('Y-m-d H:i:s');
					$isCompleted		= 0;


					$incompletedata = array(
										'isCompleted' 		=> $isCompleted,
										'LastUpdateDate' 	=> $LastUpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName)
									);     
					$where = array('invoiceId' => $data['invoiceId']); 
					$this->_invoice->update_invoice_data($incompletedata, $where);
					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_INCOMPLETE_INVOICE_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_invoice->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					Url::redirect('admin/invoice/view/'.$row->invoiceId);
    	}	

    	// DELETE WORK ORDER INVOICE DATA
        if (isset($_POST['submit']) && $_POST['submit'] == 'delete-wo-invoice') {

        		$invoiceId 		= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
        		$IdProject 		= trim(strip_tags(isset($_POST['IdProject']) ? $_POST['IdProject'] : ''));
				$IdClient 		= trim(strip_tags(isset($_POST['IdClient']) ? $_POST['IdClient'] : ''));

	        	$invoiceinfodata = array('invoiceId' => $invoiceId);      
				$this->_invoice->delete_invoice_data($invoiceinfodata);

				if (file_exists("uploads/invoices/".$row->invoiceNumber.".pdf")) {

					//DELETE INVOICE PDF FROM UPLOAD FOLDER
					@unlink('uploads/invoices/'.$row->invoiceNumber.'.pdf');

				}

				/*
				 *---------------------------------------------------------------
				 * AUDIT TRAILS
				 *---------------------------------------------------------------
				 */
				$CreatedDate 		= date('Y-m-d H:i:s');
				$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_DELETE_INVOICE_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

			    $auditdata = array(
									'CreatedDate' 		=> $CreatedDate,
									'AuditContent' 		=> $AuditContent,
									'CreatedUser' 		=> Session::get(IdUser)
								);     
				$this->_invoice->insert_audit_data($auditdata);
				/*
				 *---------------------------------------------------------------
				 * END AUDIT TRAILS
				 *---------------------------------------------------------------
				 */

				Session::set('successDeleteInvoice', 1);
				Url::redirect('admin/project/view/'.$IdProject);

        }

        // GENERATE WORK ORDER INVOICE 
        if (isset($_POST['submit']) && $_POST['submit'] == 'generate-invoice-pdf') {

			$filename	= "uploads/invoices/".$row->invoiceNumber.".pdf";

		    $pdf = new \helpers\fpdf\pdf();
			$pdf->AddPage();
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->SetY(150);

			$pdf->Cell(20, 15, _INVOICE_TO_LANG_);
			$pdf->SetFont('Arial', '');

			$pdf->Cell(280, 15, $row->ClientName . ' - ' . $row->ClientEmail);

			$pdf->SetFont('Arial', 'B');
			$pdf->Cell(80, 15, _INVOICE_BILL_NO_LANG_);
			$pdf->SetFont('Arial', '');
			$pdf->Cell(200, 15, $row->invoiceNumber, 0, 1);

			$pdf->SetFont('Arial', '');
			$pdf->SetX(60);
			$pdf->Cell(280, 15, $row->ClientAddress);

			$pdf->SetFont('Arial', 'B');
			$pdf->Cell(80, 15, _INVOICE_DATE_LANG_);

			$pdf->SetFont('Arial', '');
			$pdf->Cell(280, 15, $row->nInvoiceDate, 0, 1);

			$pdf->SetX(340);
			$pdf->SetFont('Arial', 'B');
			$pdf->Cell(80, 15, _INVOICE_DUE_DATE_LANG_);

			$pdf->SetFont('Arial', '');
			$pdf->Cell(280, 15, $row->nInvoiceDueDate, 0, 1);



			$pdf->Ln(20);

			//INFO TABLE
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->SetTextColor(255);
			$pdf->SetFillColor(0);
			$pdf->SetLineWidth(1);
			$pdf->Cell(130, 25, _INVOICE_CLIENT_REFERENCE_LANG_, 'LTR', 0, 'C', true);
			$pdf->Cell(190, 25, _INVOICE_COMPANY_REFERENCE_LANG_, 'LTR', 0, 'C', true);
			$pdf->Cell(107, 25, _INVOICE_CURRENCY_LANG_, 'LTR', 0, 'C', true);
			$pdf->Cell(100, 25, _INVOICE_TOTAL_DUE_LANG_, 'LTR', 1, 'C', true);

			$pdf->SetFont('Arial', '');
			$pdf->SetTextColor(0);
			$pdf->SetFillColor(238);
			$pdf->SetLineWidth(0.2);
			$fill = false;
			$pdf->SetFont('Arial', 'B', 8);
			$pdf->Cell(130, 20, $row->invoiceClientReference, 1, 0, 'C', $fill);
			$pdf->Cell(190, 20, $row->invoiceCompanyReference, 1, 0, 'C', $fill);
			$pdf->Cell(107, 20, $row->CurrencyName, 1, 0, 'C', $fill);
			$pdf->Cell(100, 20, $row->CurrencySymbol.' '.number_format($row->invoiceSubtotal, 2), 1, 1, 'C', $fill);
			$fill = !$fill;

			$pdf->Ln(20);

			//INVOICE ITEM
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->SetTextColor(255);
			$pdf->SetFillColor(0);
			$pdf->SetLineWidth(1);
			$pdf->Cell(30, 25, _INVOICE_NO_LANG_, 'LTR', 0, 'C', true);
			$pdf->Cell(197, 25, _INVOICE_DESC_LANG_, 'LTR', 0, 'C', true);
			$pdf->Cell(100, 25, _INVOICE_QTY_LANG_, 'LTR', 0, 'C', true);
			$pdf->Cell(100, 25, _INVOICE_AMOUNT_LANG_, 'LTR', 0, 'C', true);
			$pdf->Cell(100, 25, _INVOICE_TOTAL_AMOUNT_LANG_, 'LTR', 1, 'C', true);

			$pdf->SetFont('Arial', '');
			$pdf->SetTextColor(0);
			$pdf->SetFillColor(238);
			$pdf->SetLineWidth(0.2);
			$fill = false;
			$orderNo = 1; 
			foreach ($data['get_invoice_item'] as $item) 
			{ 
				$pdf->Cell(30, 20, $orderNo, 1, 0, 'C', $fill);
				$pdf->Cell(197, 20, $item->ItemDesc, 1, 0, 'L', $fill);
				$pdf->Cell(100, 20, $item->ItemQty, 1, 0, 'C', $fill);
				$pdf->Cell(100, 20, $row->CurrencySymbol.' '.number_format($item->ItemAmount, 2), 1, 0, 'R', $fill);
				$pdf->Cell(100, 20, $row->CurrencySymbol.' '.number_format($item->ItemTotalAmount, 2), 1, 1, 'R', $fill);
				$fill = !$fill;
				$orderNo++;
			}
			

			$pdf->SetX(367);
			$pdf->SetFont('Arial', 'B');
			$pdf->Cell(100, 20, _INVOICE_TOTAL_PAYMENT_LANG_, 1);
			$pdf->SetFont('Arial', '');
			$pdf->Cell(100, 20, $row->CurrencySymbol.' '.number_format($row->invoiceTotalPaid, 2), 1, 1, 'R');
			$pdf->SetX(367);
			$pdf->SetFont('Arial', 'B');
			$pdf->Cell(100, 20, _INVOICE_TAX_LANG_." (". $row->invoiceTaxRate . '%)', 1);
			$pdf->SetFont('Arial', '');
			$pdf->Cell(100, 20, $row->CurrencySymbol.' '.number_format($row->invoiceTax, 2), 1, 1, 'R');
			$pdf->SetX(367);
			$pdf->SetFont('Arial', 'B');
			$pdf->Cell(100, 20, _INVOICE_BALANCE_DUE_LANG_, 1);
			$pdf->SetFont('Arial', '');
			$pdf->Cell(100, 20, $row->CurrencySymbol.' '.number_format($row->invoiceTotalDue, 2), 1, 1, 'R');

			$pdf->Ln(30);

			$pdf->SetFont('Arial', '', 10);

			$pdf->MultiCell(0, 15, $row->invoiceNote);

			$pdf->Output($filename,'F');

			//DEFINE VARIABLE FOR INSERT TO DB	
			$LastUpdateDate 	= date('Y-m-d H:i:s');
			$isGenerated		= 1;

			$invoicestatusdata = array(
									'isGenerated' 		=> $isGenerated,
									'LastUpdateDate' 	=> $LastUpdateDate,
									'LastUpdateUser' 	=> Session::get(FullName)
								);     
			$where = array('invoiceId' => $data['invoiceId']); 
			$this->_invoice->update_invoice_data($invoicestatusdata, $where);

			/*
			 *---------------------------------------------------------------
			 * AUDIT TRAILS
			 *---------------------------------------------------------------
			 */
			$CreatedDate 		= date('Y-m-d H:i:s');
			$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_GENERATE_PDF_INVOICE_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

		    $auditdata = array(
								'CreatedDate' 		=> $CreatedDate,
								'AuditContent' 		=> $AuditContent,
								'CreatedUser' 		=> Session::get(IdUser)
							);     
			$this->_invoice->insert_audit_data($auditdata);
			/*
			 *---------------------------------------------------------------
			 * END AUDIT TRAILS
			 *---------------------------------------------------------------
			 */

			Session::pull('needGenerateInvoice'.$row->invoiceId, 1);

			Session::set('SuccessGeneratedInvoice', 1);
			Url::redirect('admin/invoice/view/'.$row->invoiceId);

        }

        // SEND WORK ORDER INVOICE ATTACHMENT VIA EMAIL
        if (isset($_POST['submit']) && $_POST['submit'] == 'send-invoice-email') {

        	if(empty($_POST['EmailSubject'])) {
				$error[] = _ERROR_EMAIL_SUBJECT_LANG_;
			} else if(empty($_POST['EmailTarget'])) {
				$error[] = _ERROR_EMAIL_TARGET_LANG_;
			} else if(!filter_var($_POST['EmailTarget'], FILTER_VALIDATE_EMAIL)) {
				$error[] = _ERROR_FORMAT_EMAIL_TARGET_LANG_;
			} else if(empty($_POST['EmailText'])) {
				$error[] = _ERROR_EMAIL_TEXT_LANG_;
			} else {

				//DEFINE VARIABLE FOR INSERT TO DB	
				$LastUpdateDate 	= date('Y-m-d H:i:s');
				$invoiceId 			= trim(strip_tags(isset($_POST['invoiceId']) ? $_POST['invoiceId'] : ''));
				$invoiceStatus		= 1;
				$EmailSubject		= trim(strip_tags(isset($_POST['EmailSubject']) ? $_POST['EmailSubject'] : ''));
				$EmailTarget		= trim(strip_tags(isset($_POST['EmailTarget']) ? $_POST['EmailTarget'] : ''));
				$EmailText			= trim(strip_tags(isset($_POST['EmailText']) ? $_POST['EmailText'] : ''));

				$invoicestatusdata = array(
										'invoiceStatus' 	=> $invoiceStatus,
										'LastUpdateDate' 	=> $LastUpdateDate,
										'LastUpdateUser' 	=> Session::get(FullName)
									);     
				$where = array('invoiceId' => $invoiceId); 

				$mail = new \helpers\phpmailer\mail();
			    $mail->setFrom($data['ownerEmail']);
			    $mail->addAddress($EmailTarget);
			    $mail->subject($EmailSubject);
			    $mail->body($EmailText);
			    $mail->AddAttachment("uploads/invoices/".$row->invoiceNumber.".pdf");  
			    
			     if(!$mail->Send()) {

					$error[] = $mail->ErrorInfo;

				} else {

					$this->_invoice->update_invoice_data($invoicestatusdata, $where);

					/*
					 *---------------------------------------------------------------
					 * AUDIT TRAILS
					 *---------------------------------------------------------------
					 */
					$CreatedDate 		= date('Y-m-d H:i:s');
					$AuditContent 		= Session::get(FullName). ' ' ._SUCCESS_SEND_PDF_INVOICE_EMAIL_AUDIT_LANG_. ' ' .$data['invoiceNumber'];

				    $auditdata = array(
										'CreatedDate' 		=> $CreatedDate,
										'AuditContent' 		=> $AuditContent,
										'CreatedUser' 		=> Session::get(IdUser)
									);     
					$this->_invoice->insert_audit_data($auditdata);
					/*
					 *---------------------------------------------------------------
					 * END AUDIT TRAILS
					 *---------------------------------------------------------------
					 */

					Session::set('successSendEmail', 1);

					Url::redirect('admin/invoice/view/'.$invoiceId);
				}
			}

        }

		render:

		View::rendertemplate('header',$data);
		View::render('admin/invoice/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}