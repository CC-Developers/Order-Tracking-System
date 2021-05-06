<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/dashboard.php
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

	public function get_invoice_count() {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectinvoices");
		return count($data);
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

	public function get_client_count() {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tclients WHERE IsArchived = 0");
		return count($data);
	}

	public function get_active_work_order_count() {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE IsArchived = 0");
		return count($data);
	}

	public function get_employee_active_work_order_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectmember WHERE IdUser = :id", array(':id' => $id));
		return count($data);
	}

	public function get_employee_active_work_order($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectmember.IdMember,
											".PREFIX."tprojectmember.IdProject,
											".PREFIX."tprojectmember.IdUser,
											".PREFIX."tprojectmember.RoleId,
											".PREFIX."tprojectmember.CreatedDate, 
											DATE_FORMAT(".PREFIX."tprojectmember.CreatedDate,'%M %d, %Y %H:%i:%s') AS nCreatedDate,
											".PREFIX."tprojectmember.CreatedUser,
											".PREFIX."tprojectmember.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tprojectmember.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojectmember.LastUpdateUser,
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
											".PREFIX."phase.PhaseColor,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS MemberName,
											".PREFIX."trole.RoleId,
											".PREFIX."trole.RoleName,
											".PREFIX."trole.RoleDesc
									FROM 
											".PREFIX."tprojectmember 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojectmember.IdProject = ".PREFIX."tprojects.IdProject
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."tprojects.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojects.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojectmember.IdUser = ".PREFIX."tuser.IdUser
											LEFT JOIN ".PREFIX."trole ON ".PREFIX."tprojectmember.RoleId = ".PREFIX."trole.RoleId
									WHERE 
											".PREFIX."tprojects.isArchived = 0
									AND
											".PREFIX."tprojectmember.IdUser = :id", 
									array(':id' => $id));
	}

	public function get_client_active_request() {
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
											".PREFIX."trequests.RequestStatus != 3");
	}

	public function update_request_data($data, $where){
    	return $this->_db->update(PREFIX.'trequests',$data, $where);
    }

	public function insert_project_data($data){
    		$this->_db->insert(PREFIX.'tprojects',$data);
			return $this->_db->lastInsertId('IdProject');
    }

	public function get_unread_mail_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tmailbox WHERE IsRead = 0 AND ReceiverId = :id", array(':id' => $id));
		return count($data);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}