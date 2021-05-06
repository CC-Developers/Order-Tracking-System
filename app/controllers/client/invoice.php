<?php namespace controllers\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/client/invoice.php
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
 	\helpers\url as Url;

class Invoice extends \core\controller{

	private $_invoice;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_invoice = new \models\client\invoice();
		if(Session::get('clientloggedin') == false) {
			Url::redirect('login');
		}
	}

	public function view($id){
		
		$data['get_invoice_item'] 		= $this->_invoice->get_invoice_item($id);
		$data['get_invoice_payment'] 	= $this->_invoice->get_invoice_payment($id);
		
		

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
				$data['invoiceClientAddress'] 	= $row->invoiceClientAddress;
				$data['invoiceAddress'] 		= $row->invoiceAddress;
				$data['IsCompleted'] 			= $row->IsCompleted;
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

        
		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= 
			"<script type='text/javascript'>
				$(function() { 
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

		View::rendertemplate('header-client',$data);
		View::render('client/invoice/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}