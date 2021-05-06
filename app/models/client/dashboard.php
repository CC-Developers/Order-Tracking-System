<?php namespace models\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/client/dashboard.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Dashboard extends \core\model {

	public function __construct() {
		parent::__construct();
	}

	public function get_invoice_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectinvoices WHERE isSync = '1'
									AND IdClient = :id", array(':id' => $id));
		return count($data);
	}

	public function get_client_invoice_access($id) {
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
											".PREFIX."tprojectinvoices.isSync,
											".PREFIX."tprojectinvoices.isGenerated,
											".PREFIX."tprojectinvoices.isCompleted,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol
									FROM 
											".PREFIX."tprojectinvoices 
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tcurrency.CurrencyId = ".PREFIX."tprojectinvoices.invoiceCurrency
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectinvoices.IdProject
									WHERE
											".PREFIX."tprojectinvoices.isSync = '1'
									AND
											".PREFIX."tprojectinvoices.IdClient = :id", 
									array(':id' => $id));
	}

	public function get_client_active_work_order_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE isArchived = 0 AND IdClient = :id", array(':id' => $id));
		return count($data);
	}

	public function get_client_active_work_order($id) {
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
											DATE_FORMAT(".PREFIX."tprojects.archiveDate,'%M %d, %Y %H:%i:%s') AS narchiveDate, 
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
											".PREFIX."phase.PhaseColor
									FROM 
											".PREFIX."tprojects
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."tprojects.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojects.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
									WHERE 
											".PREFIX."tprojects.isArchived = 0
									AND
											".PREFIX."tprojects.IdClient= :id", 
									array(':id' => $id));
	}

	public function get_client_active_request_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."trequests WHERE IdClient = :id", array(':id' => $id));
		return count($data);
	}

	public function get_client_active_request($id) {
		return $this->_db->select("SELECT 
											".PREFIX."trequests.IdRequest, 
											".PREFIX."trequests.IdClient, 
											".PREFIX."trequests.TypeId, 
											".PREFIX."trequests.ProjectCurrency, 
											".PREFIX."trequests.ProjectNotes, 
											".PREFIX."trequests.ProjectStart, 
											".PREFIX."trequests.ProjectDeadline, 
											DATE_FORMAT(".PREFIX."trequests.ProjectStart,'%M %d, %Y') AS nProjectStart, 
											DATE_FORMAT(".PREFIX."trequests.ProjectDeadline,'%M %d, %Y') AS nProjectDeadline, 
											".PREFIX."trequests.RequestStatus,
											".PREFIX."trequests.LastUpdateDate, 
											DATE_FORMAT(".PREFIX."trequests.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."trequests.LastUpdateUser, 
											".PREFIX."trequests.CreatedDate, 
											DATE_FORMAT(".PREFIX."trequests.CreatedDate,'%M %d, %Y %H:%i:%s') AS nCreatedDate,
											".PREFIX."trequests.CreatedUser, 
											".PREFIX."tclients.IdClient, 
											".PREFIX."tclients.Fullname AS ClientName, 
											".PREFIX."twotype.TypeId, 
											".PREFIX."twotype.TypeCode, 
											".PREFIX."twotype.TypeTitle, 
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol
									FROM 
											".PREFIX."trequests
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."trequests.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."trequests.TypeId = ".PREFIX."twotype.TypeId
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."trequests.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
									WHERE 
											".PREFIX."trequests.IdClient= :id", 
									array(':id' => $id));
	}

	public function get_service_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."twotype WHERE ".PREFIX."twotype.IsActive = 1");
	}

	public function get_currency_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tcurrency WHERE ".PREFIX."tcurrency.IsActive = 1");
	}

	public function insert_request_data($data){
    		$this->_db->insert(PREFIX.'trequests',$data);
			return $this->_db->lastInsertId('IdRequest');
    }

    public function update_request_data($data, $where){
    	return $this->_db->update(PREFIX.'trequests',$data, $where);
    }

    public function delete_request_data($data){
		$this->_db->delete(PREFIX.'trequests', $data);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}