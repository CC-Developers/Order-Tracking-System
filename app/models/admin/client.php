<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/client.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Client extends \core\model {

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

	public function get_client() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.isArchived = 0");
	}

	public function get_all_client_email() {
		return $this->_db->select("SELECT ".PREFIX."tclients.Email FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.IsActive = 1");
	}

	public function get_client_archived() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.isArchived = 1");
	}

	public function view_client($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tclients.IdClient,
											".PREFIX."tclients.FullName,
											".PREFIX."tclients.Username,
											".PREFIX."tclients.Password,
											".PREFIX."tclients.Email,
											".PREFIX."tclients.MailingAddress,
											".PREFIX."tclients.Phone,
											".PREFIX."tclients.CellPhone,
											".PREFIX."tclients.Notes,
											".PREFIX."tclients.ProfilePicture,
											".PREFIX."tclients.IsActive,
											DATE_FORMAT(".PREFIX."tclients.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tclients.LastUpdateDate,
											".PREFIX."tclients.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tclients.LastLoginDate,'%M %d, %Y %H:%i:%s') AS nLastLoginDate,
											".PREFIX."tclients.LastLoginDate,
											".PREFIX."tclients.LastLoginIp,
											".PREFIX."tclients.IsLogin,
											DATE_FORMAT(".PREFIX."tclients.CreatedDate,'%M %d, %Y %H:%i:%s') AS nCreatedDate,
											".PREFIX."tclients.CreatedDate,
											".PREFIX."tclients.CreatedUser,
											".PREFIX."tclients.isArchived,
											DATE_FORMAT(".PREFIX."tclients.archiveDate,'%M %d, %Y') AS narchiveDate,
											".PREFIX."tclients.archiveDate,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS AdminName 
									FROM 
											".PREFIX."tclients 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tclients.CreatedUser = ".PREFIX."tuser.IdUser
									WHERE 
											IdClient = :id", 
									array(':id' => $id));
	}

	public function get_client_wo($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojects.IdProject,
											".PREFIX."tprojects.TypeId,
											".PREFIX."tprojects.ProjectProgress,
											".PREFIX."tprojects.ProjectStatus,
											".PREFIX."phase.PhaseId,
											".PREFIX."phase.PhaseName,
											".PREFIX."phase.PhaseColor,
											".PREFIX."twotype.TypeId,
											".PREFIX."twotype.TypeTitle AS TypeTitle
									FROM 
											".PREFIX."tprojects 
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
									WHERE 
											".PREFIX."tprojects.IdClient = :id", 
									array(':id' => $id));
	}

	public function get_client_invoice($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectinvoices.invoiceId,
											".PREFIX."tprojectinvoices.IdClient,
											".PREFIX."tprojectinvoices.IdProject,
											".PREFIX."tprojectinvoices.invoiceNumber,
											".PREFIX."tprojectinvoices.invoiceStatus,
											DATE_FORMAT(".PREFIX."tprojectinvoices.invoiceDueDate,'%M %d, %Y') AS invoiceDueDate
									FROM 
											".PREFIX."tprojectinvoices 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectinvoices.IdProject
									WHERE 
											".PREFIX."tprojectinvoices.IdClient = :id", 
									array(':id' => $id));
	}

	public function get_client_payment($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectpayments.IdPayment,
											".PREFIX."tprojectpayments.IdClient,
											".PREFIX."tprojectpayments.IdProject,
											".PREFIX."tprojectpayments.invoiceId,
											".PREFIX."tprojectinvoices.invoiceNumber,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tprojects.ProjectCurrency,
											".PREFIX."tcurrency.CurrencyId, 
											".PREFIX."tcurrency.CurrencyName, 
											".PREFIX."tcurrency.CurrencySymbol, 
											DATE_FORMAT(".PREFIX."tprojectpayments.paymentDate,'%M %d, %Y') AS paymentDate,
											".PREFIX."tprojectpayments.paymentAmount
									FROM 
											".PREFIX."tprojectpayments 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectpayments.IdProject
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojects.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."tprojectinvoices ON ".PREFIX."tprojectinvoices.IdProject = ".PREFIX."tprojectpayments.IdProject
									WHERE 
											".PREFIX."tprojectpayments.IdClient = :id", 
									array(':id' => $id));
	}

	public function get_client_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE IdClient = :id", array(':id' => $id));
		return count($data);
	}

	public function get_client_wo_archive_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE IdClient = :id AND isComplete = 0", array(':id' => $id));
		return count($data);
	}

	public function get_client_invoice_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectinvoices WHERE IdClient = :id", array(':id' => $id));
		return count($data);
	}

	public function get_client_payment_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectpayments WHERE IdClient = :id", array(':id' => $id));
		return count($data);
	}

	public function insert_client_data($data){
    		$this->_db->insert(PREFIX.'tclients',$data);
			return $this->_db->lastInsertId('IdClient');
    }

    public function check_username_1($username) {
		$data = $this->_db->select("SELECT ".PREFIX."tclients.Username FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.Username = :username LIMIT 1", array(':username' => $username));
		return count($data);
	}

	public function check_username_2($username) {
		$data = $this->_db->select("SELECT ".PREFIX."tuser.Username FROM ".PREFIX."tuser WHERE ".PREFIX."tuser.Username = :username LIMIT 1", array(':username' => $username));
		return count($data);
	}

	public function check_email_1($email) {
		$data = $this->_db->select("SELECT ".PREFIX."tclients.Email FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.Email = :email LIMIT 1", array(':email' => $email));
		return count($data);
	}

	public function check_email_2($email) {
		$data = $this->_db->select("SELECT ".PREFIX."tuser.Email FROM ".PREFIX."tuser WHERE ".PREFIX."tuser.Email = :email LIMIT 1", array(':email' => $email));
		return count($data);
	}

    public function update_client_data($data, $where){
    	return $this->_db->update(PREFIX.'tclients',$data, $where);
    }

    public function delete_client_data($data){
		$this->_db->delete(PREFIX.'tclients', $data);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}