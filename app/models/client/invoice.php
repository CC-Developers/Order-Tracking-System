<?php namespace models\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/client/invoice.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
use \helpers\session as Session;

class Invoice extends \core\model {

	public function __construct() {
		parent::__construct();
	}

	public function get_owner($id) {
		return $this->_db->select("SELECT ownerName, ownerAddress, ownerEmail, ownerPhone FROM ".PREFIX."tsettings WHERE settingsId = :id", array(':id' => $id));
	}

	public function view_invoice($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectinvoices.invoiceId,
											".PREFIX."tprojectinvoices.IdClient,
											".PREFIX."tprojectinvoices.IdProject,
											".PREFIX."tprojectinvoices.invoiceNumber,
											".PREFIX."tprojectinvoices.invoiceClientReference,
											".PREFIX."tprojectinvoices.invoiceCompanyReference,
											".PREFIX."tprojectinvoices.InvoiceDate, 
											DATE_FORMAT(".PREFIX."tprojectinvoices.InvoiceDate,'%M %d, %Y') AS nInvoiceDate,
											".PREFIX."tprojectinvoices.InvoiceDueDate, 
											DATE_FORMAT(".PREFIX."tprojectinvoices.InvoiceDueDate,'%M %d, %Y') AS nInvoiceDueDate,
											".PREFIX."tprojectinvoices.invoiceCurrency,
											".PREFIX."tprojectinvoices.invoiceSubtotal,
											".PREFIX."tprojectinvoices.invoiceTax,
											".PREFIX."tprojectinvoices.invoiceTaxRate,
											".PREFIX."tprojectinvoices.invoiceTotalPaid,
											".PREFIX."tprojectinvoices.invoiceTotalDue,
											".PREFIX."tprojectinvoices.invoiceNote,
											".PREFIX."tprojectinvoices.invoiceStatus,
											".PREFIX."tprojectinvoices.isSync,
											".PREFIX."tprojectinvoices.isGenerated,
											".PREFIX."tprojectinvoices.invoiceClientAddress,
											".PREFIX."tprojectinvoices.invoiceAddress,
											".PREFIX."tprojectinvoices.IsCompleted,
											".PREFIX."tprojectinvoices.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tprojectinvoices.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojectinvoices.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tprojectinvoices.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."tprojectinvoices.CreatedUser,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol,
											".PREFIX."phase.PhaseId, 
											".PREFIX."phase.PhaseName, 
											".PREFIX."phase.PhaseColor,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS AdminName,
											".PREFIX."tclients.IdClient,
											".PREFIX."tclients.FullName AS ClientName,
											".PREFIX."tclients.Username,
											".PREFIX."tclients.Password,
											".PREFIX."tclients.Email AS ClientEmail,
											".PREFIX."tclients.MailingAddress AS ClientAddress,
											".PREFIX."tclients.Phone AS ClientPhone,
											".PREFIX."tclients.CellPhone AS ClientCellPhone
									FROM 
											".PREFIX."tprojectinvoices 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojectinvoices.IdProject = ".PREFIX."tprojects.IdProject
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."tprojectinvoices.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojectinvoices.invoiceCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojectinvoices.CreatedUser = ".PREFIX."tuser.IdUser
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
									WHERE 
											".PREFIX."tprojectinvoices.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojectinvoices.invoiceId = :id", 
									array(':id' => $id));
	}

	public function get_invoice_item($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tinvoiceitems.ItemId,
											".PREFIX."tinvoiceitems.IdClient,
											".PREFIX."tinvoiceitems.IdProject,
											".PREFIX."tinvoiceitems.invoiceId,
											".PREFIX."tinvoiceitems.ItemTitle,
											".PREFIX."tinvoiceitems.ItemDesc,
											".PREFIX."tinvoiceitems.ItemQty,
											".PREFIX."tinvoiceitems.ItemAmount,
											".PREFIX."tinvoiceitems.ItemTotalAmount,
											".PREFIX."tinvoiceitems.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tinvoiceitems.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tinvoiceitems.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tinvoiceitems.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."tinvoiceitems.CreatedUser,
											".PREFIX."tprojectinvoices.invoiceId
											
									FROM 
											".PREFIX."tinvoiceitems 
											LEFT JOIN ".PREFIX."tprojectinvoices ON ".PREFIX."tinvoiceitems.invoiceId = ".PREFIX."tprojectinvoices.invoiceId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tinvoiceitems.CreatedUser = ".PREFIX."tuser.IdUser
									WHERE
											".PREFIX."tinvoiceitems.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tinvoiceitems.invoiceId = :id", 
									array(':id' => $id));
	}

	public function get_sub_total_invoice($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tinvoiceitems.ItemId,
											".PREFIX."tinvoiceitems.IdClient,
											".PREFIX."tinvoiceitems.IdProject,
											".PREFIX."tinvoiceitems.invoiceId,
											SUM(".PREFIX."tinvoiceitems.ItemTotalAmount) AS InvoiceSubTotalAmountItem,
											".PREFIX."tprojectinvoices.invoiceId
											
									FROM 
											".PREFIX."tinvoiceitems 
											LEFT JOIN ".PREFIX."tprojectinvoices ON ".PREFIX."tinvoiceitems.invoiceId = ".PREFIX."tprojectinvoices.invoiceId
									WHERE
											".PREFIX."tinvoiceitems.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tinvoiceitems.invoiceId = :id", 
									array(':id' => $id));
	}


	public function get_payment_total_invoice($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectpayments.IdPayment,
											".PREFIX."tprojectpayments.IdClient,
											".PREFIX."tprojectpayments.IdProject,
											".PREFIX."tprojectpayments.invoiceId,
											SUM(".PREFIX."tprojectpayments.PaymentAmount) AS InvoicePaymentTotal,
											".PREFIX."tprojectpayments.invoiceId
											
									FROM 
											".PREFIX."tprojectpayments 
											LEFT JOIN ".PREFIX."tprojectinvoices ON ".PREFIX."tprojectpayments.invoiceId = ".PREFIX."tprojectinvoices.invoiceId
									WHERE
											".PREFIX."tprojectpayments.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojectpayments.invoiceId = :id", 
									array(':id' => $id));
	}

	public function get_invoice_payment($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectpayments.IdPayment,
											".PREFIX."tprojectpayments.IdClient,
											".PREFIX."tprojectpayments.IdProject,
											".PREFIX."tprojectpayments.invoiceId,
											".PREFIX."tprojectpayments.PaymentDate, 
											DATE_FORMAT(".PREFIX."tprojectpayments.PaymentDate,'%M %d, %Y') AS nPaymentDate,
											".PREFIX."tprojectpayments.PaymentType, 
											".PREFIX."tprojectpayments.PaymentAmount, 
											".PREFIX."tprojectpayments.PaymentNotes,
											".PREFIX."tprojectpayments.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tprojectpayments.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojectpayments.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tprojectpayments.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."tprojectpayments.CreatedUser, 
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS AdminName,
											".PREFIX."tclients.IdClient,
											".PREFIX."tclients.FullName AS ClientName,
											".PREFIX."tprojects.IdProject
									FROM 
											".PREFIX."tprojectpayments 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojectpayments.IdProject = ".PREFIX."tprojects.IdProject
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."tprojectpayments.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."tprojectinvoices ON ".PREFIX."tprojectpayments.invoiceId = ".PREFIX."tprojectinvoices.invoiceId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojectpayments.CreatedUser = ".PREFIX."tuser.IdUser
									WHERE 
											".PREFIX."tprojectpayments.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojectpayments.invoiceId = :id", 
									array(':id' => $id));
	}


	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}