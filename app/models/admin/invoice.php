<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/invoice.php
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

	public function get_task_count() {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojecttask WHERE TaskProgress < 100");
		return count($data);
	}

	public function get_wo_task() {
		return $this->_db->select("SELECT 
											".PREFIX."tprojecttask.IdTask,
											".PREFIX."tprojecttask.IdProject,
											".PREFIX."tprojecttask.IdClient,
											".PREFIX."tprojecttask.TaskDesc,
											".PREFIX."tprojecttask.TaskDate,
											DATE_FORMAT(".PREFIX."tprojecttask.TaskDate,'%M %d, %Y') AS nTaskDate,
											".PREFIX."tprojecttask.TaskDueDate,
											DATE_FORMAT(".PREFIX."tprojecttask.TaskDueDate,'%M %d, %Y') AS nTaskDueDate,
											".PREFIX."tprojecttask.TaskNotes,
											".PREFIX."tprojecttask.TaskProgress,
											".PREFIX."tprojecttask.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tprojecttask.LastUpdateDate,'%M %d, %Y') AS nLastUpdateDate,
											".PREFIX."tprojecttask.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tprojecttask.CreatedDate,'%M %d, %Y') AS CreatedDate,
											".PREFIX."tprojecttask.CreatedUser,
											".PREFIX."tprojects.IdProject
									FROM 
											".PREFIX."tprojecttask 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojecttask.IdProject
									WHERE 
										".PREFIX."tprojecttask.TaskProgress < 100");
	}
	
	public function get_unread_mail_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tmailbox WHERE IsRead = 0 AND ReceiverId = :id", array(':id' => $id));
		return count($data);
	}


	public function get_wo_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE ".PREFIX."tprojects.isArchived = 0");
	}

	public function get_client_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.isArchived = 0");
	}


	public function get_currency_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tcurrency WHERE ".PREFIX."tcurrency.IsActive = 1");
	}

	public function get_member_invoice_access($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectmember.IdMember,
											".PREFIX."tprojectmember.IdProject AS MemberProject,
											".PREFIX."tprojectmember.IdUser AS MemberId,
											".PREFIX."tprojectmember.RoleId,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tprojectinvoices.IdProject AS invoiceProject,
											".PREFIX."trole.RoleId,
											".PREFIX."trole.RoleName,
											".PREFIX."trole.RoleDesc,
											".PREFIX."trole.GeneralEdit,
											".PREFIX."trole.TaskView,
											".PREFIX."trole.TaskCreate,
											".PREFIX."trole.TaskEdit,
											".PREFIX."trole.TaskDelete,
											".PREFIX."trole.ScheduleView,
											".PREFIX."trole.ScheduleCreate,
											".PREFIX."trole.ScheduleEdit,
											".PREFIX."trole.ScheduleDelete,
											".PREFIX."trole.MemberView,
											".PREFIX."trole.MemberCreate,
											".PREFIX."trole.MemberEdit,
											".PREFIX."trole.MemberDelete,
											".PREFIX."trole.FinanceView,
											".PREFIX."trole.FinanceCreate,
											".PREFIX."trole.FinanceEdit,
											".PREFIX."trole.FinanceDelete,
											".PREFIX."trole.AttachmentView,
											".PREFIX."trole.AttachmentCreate,
											".PREFIX."trole.AttachmentEdit,
											".PREFIX."trole.AttachmentDelete,
											".PREFIX."trole.InvoiceView,
											".PREFIX."trole.InvoiceCreate,
											".PREFIX."trole.InvoiceEdit,
											".PREFIX."trole.InvoiceDelete,
											".PREFIX."trole.InvoiceGenerate,
											".PREFIX."trole.InvoiceSendMail,
											".PREFIX."trole.PaymentCreate,
											".PREFIX."trole.PaymentEdit,
											".PREFIX."trole.PaymentDelete,
											".PREFIX."trole.ItemCreate,
											".PREFIX."trole.ItemEdit,
											".PREFIX."trole.ItemDelete
									FROM 
											".PREFIX."tprojectmember 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojectmember.IdProject = ".PREFIX."tprojects.IdProject
											LEFT JOIN ".PREFIX."tprojectinvoices ON ".PREFIX."tprojectmember.IdProject = ".PREFIX."tprojectinvoices.IdProject
											LEFT JOIN ".PREFIX."trole ON ".PREFIX."tprojectmember.RoleId = ".PREFIX."trole.RoleId
									WHERE
											".PREFIX."tprojectinvoices.IdProject = :id
									AND
											".PREFIX."tprojectmember.IdUser = ".Session::get(IdUser), 
									array(':id' => $id));
	}

	public function get_invoice() {
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
											".PREFIX."tprojectinvoices.invoiceTaxRate,
											".PREFIX."tprojectinvoices.invoiceTotalPaid,
											".PREFIX."tprojectinvoices.invoiceTotalDue,
											".PREFIX."tprojectinvoices.invoiceStatus,
											".PREFIX."tprojectinvoices.isGenerated,
											".PREFIX."tprojectinvoices.isCompleted,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol
									FROM 
											".PREFIX."tprojectinvoices 
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tcurrency.CurrencyId = ".PREFIX."tprojectinvoices.invoiceCurrency
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectinvoices.IdProject");
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
											".PREFIX."tprojectinvoices.isCompleted,
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
											".PREFIX."tinvoiceitems.invoiceId = :id", 
									array(':id' => $id));
	}

	public function check_invoice_number($number) {
		$data = $this->_db->select("SELECT ".PREFIX."tprojectinvoices.invoiceNumber FROM ".PREFIX."tprojectinvoices WHERE ".PREFIX."tprojectinvoices.invoiceNumber = :number LIMIT 1", array(':number' => $number));
		return count($data);
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
											".PREFIX."tprojectpayments.invoiceId = :id", 
									array(':id' => $id));
	}


    public function update_invoice_data($data, $where){
    	return $this->_db->update(PREFIX.'tprojectinvoices',$data, $where);
    }

    public function delete_invoice_data($data){
		$this->_db->delete(PREFIX.'tprojectinvoices', $data);
	}

	public function insert_payment_data($data){
    		$this->_db->insert(PREFIX.'tprojectpayments',$data);
			return $this->_db->lastInsertId('IdPayment');
    }

    public function update_payment_data($data, $where){
    	return $this->_db->update(PREFIX.'tprojectpayments',$data, $where);
    }

    public function delete_payment_data($data){
		$this->_db->delete(PREFIX.'tprojectpayments', $data);
	}

	public function insert_item_data($data){
    		$this->_db->insert(PREFIX.'tinvoiceitems',$data);
			return $this->_db->lastInsertId('ItemId');
    }

    public function update_item_data($data, $where){
    	return $this->_db->update(PREFIX.'tinvoiceitems',$data, $where);
    }

    public function delete_item_data($data){
		$this->_db->delete(PREFIX.'tinvoiceitems', $data);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}