<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/report.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Report extends \core\model {

	public function __construct() {
		parent::__construct();
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

	public function get_project() {
		return $this->_db->select("SELECT 
											".PREFIX."tprojects.IdProject, 
											".PREFIX."tprojects.IdClient, 
											".PREFIX."tprojects.TypeId, 
											".PREFIX."tprojects.ProjectProgress, 
											".PREFIX."tprojects.ProjectStatus, 
											".PREFIX."tprojects.ProjectCurrency, 
											".PREFIX."tprojects.ProjectNotes, 
											DATE_FORMAT(".PREFIX."tprojects.ProjectStart,'%M %d, %Y') AS ProjectStart, 
											DATE_FORMAT(".PREFIX."tprojects.ProjectDeadline,'%M %d, %Y') AS ProjectDeadline, 
											".PREFIX."tprojects.LastUpdateDate, 
											DATE_FORMAT(".PREFIX."tprojects.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojects.LastUpdateUser, 
											".PREFIX."tprojects.CreatedDate, 
											DATE_FORMAT(".PREFIX."tprojects.CreatedDate,'%M %d, %Y %H:%i:%s') AS nCreatedDate,
											".PREFIX."tprojects.CreatedUser, 
											".PREFIX."tprojects.isArchived, 
											".PREFIX."tprojects.archiveDate,
											DATE_FORMAT(".PREFIX."tprojects.archiveDate,'%M %d, %Y') AS narchiveDate, 
											".PREFIX."tprojects.IsComplete,
											".PREFIX."tclients.IdClient, 
											".PREFIX."tclients.Fullname AS ClientName, 
											".PREFIX."twotype.TypeId, 
											".PREFIX."twotype.TypeCode, 
											".PREFIX."twotype.TypeTitle, 
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol, 
											".PREFIX."phase.PhaseId, 
											".PREFIX."phase.PhaseName, 
											".PREFIX."phase.PhaseColor,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS AdminName
									FROM 
											".PREFIX."tprojects 
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."tprojects.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojects.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojects.CreatedUser = ".PREFIX."tuser.IdUser
									ORDER BY
											".PREFIX."tprojects.IdProject");
	}

	public function get_wo_task_project() {
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
											DATE_FORMAT(".PREFIX."tprojecttask.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojecttask.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tprojecttask.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."tprojecttask.CreatedUser,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS CreatedName,
											".PREFIX."tprojects.IdProject
									FROM 
											".PREFIX."tprojecttask 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tuser.IdUser = ".PREFIX."tprojecttask.CreatedUser
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojecttask.IdProject
									ORDER BY
											".PREFIX."tprojecttask.IdProject"	
								);
	}

	public function get_wo_invoice() {
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
											".PREFIX."tprojects.IdProject,
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol
									FROM 
											".PREFIX."tprojectinvoices 
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tcurrency.CurrencyId = ".PREFIX."tprojectinvoices.invoiceCurrency
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectinvoices.IdProject
									ORDER BY
											".PREFIX."tprojectinvoices.IdProject"
								);
	}

	public function get_wo_invoice_payment() {
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
											".PREFIX."tprojectinvoices.invoiceId,
											".PREFIX."tprojectinvoices.invoiceNumber,
											".PREFIX."tprojectinvoices.invoiceCurrency,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS AdminName,
											".PREFIX."tclients.IdClient,
											".PREFIX."tclients.FullName AS ClientName,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol
									FROM 
											".PREFIX."tprojectpayments 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojectpayments.IdProject = ".PREFIX."tprojects.IdProject
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."tprojectpayments.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."tprojectinvoices ON ".PREFIX."tprojectpayments.invoiceId = ".PREFIX."tprojectinvoices.invoiceId
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tcurrency.CurrencyId = ".PREFIX."tprojectinvoices.invoiceCurrency
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojectpayments.CreatedUser = ".PREFIX."tuser.IdUser
									ORDER BY
											".PREFIX."tprojectpayments.IdProject"
								);
	}

	public function get_wo_finance() {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectfinances.IdFinance,
											".PREFIX."tprojectfinances.IdProject,
											".PREFIX."tprojectfinances.FinanceTitle,
											".PREFIX."tprojectfinances.FinanceDesc,
											".PREFIX."tprojectfinances.FinanceAmount,
											".PREFIX."tprojectfinances.FinanceType,
											".PREFIX."tprojectfinances.FinanceDate,
											".PREFIX."tprojectfinances.FinanceNotes,
											DATE_FORMAT(".PREFIX."tprojectfinances.FinanceDate,'%M %d, %Y') AS nFinanceDate,
											".PREFIX."tprojectfinances.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tprojectfinances.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojectfinances.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tprojectfinances.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."tprojectfinances.CreatedUser,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS CreatedName
									FROM 
											".PREFIX."tprojectfinances 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectfinances.IdProject
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojects.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tuser.IdUser = ".PREFIX."tprojectfinances.CreatedUser
									ORDER BY 
											".PREFIX."tprojectfinances.IdProject"
								);
	}

	public function get_client() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tclients");
	}

	public function get_user() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tuser");
	}

	public function get_audit() {
		return $this->_db->select("SELECT 
											".PREFIX."audit.IdAudit,
											".PREFIX."audit.CreatedDate,
											DATE_FORMAT(".PREFIX."audit.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."audit.CreatedUser,
											".PREFIX."audit.AuditContent,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS AuditUser,
											".PREFIX."tclients.IdClient,
											".PREFIX."tclients.FullName AS AuditUser
									FROM 
											".PREFIX."audit
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."audit.CreatedUser = ".PREFIX."tuser.IdUser
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."audit.CreatedUser = ".PREFIX."tclients.IdClient
									ORDER BY
											".PREFIX."audit.CreatedDate
									DESC"
								);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}