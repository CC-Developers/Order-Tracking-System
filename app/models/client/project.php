<?php namespace models\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/client/project.php
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

class Project extends \core\model {

	public function __construct() {
		parent::__construct();
	}

	public function view_project($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojects.IdProject, 
											".PREFIX."tprojects.IdClient, 
											".PREFIX."tprojects.TypeId, 
											".PREFIX."tprojects.ProjectProgress, 
											".PREFIX."tprojects.ProjectStatus, 
											".PREFIX."tprojects.ProjectCurrency, 
											".PREFIX."tprojects.ProjectNotes, 
											".PREFIX."tprojects.ProjectStart, 
											DATE_FORMAT(".PREFIX."tprojects.ProjectStart,'%M %d, %Y') AS nProjectStart, 
											".PREFIX."tprojects.ProjectDeadline,
											DATE_FORMAT(".PREFIX."tprojects.ProjectDeadline,'%M %d, %Y') AS nProjectDeadline, 
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
											SUM(".PREFIX."tprojecttask.TaskProgress) AS TaskProgress,
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
											LEFT JOIN ".PREFIX."tprojecttask ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojecttask.IdProject
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojects.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojects.CreatedUser = ".PREFIX."tuser.IdUser
									WHERE 
											".PREFIX."tprojects.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojects.isArchived = 0
									AND
											".PREFIX."tprojects.IdProject = :id", 
									array(':id' => $id));
	}

	public function get_wo_member($id) {
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
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS MemberName,
											".PREFIX."tuser.Email AS MemberEmail,
											".PREFIX."tuser.Phone AS MemberPhone,
											".PREFIX."tuser.CellPhone AS MemberCell,
											".PREFIX."trole.RoleId,
											".PREFIX."trole.RoleName,
											".PREFIX."trole.RoleDesc
									FROM 
											".PREFIX."tprojectmember 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojectmember.IdProject = ".PREFIX."tprojects.IdProject
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojectmember.IdUser = ".PREFIX."tuser.IdUser
											LEFT JOIN ".PREFIX."trole ON ".PREFIX."tprojectmember.RoleId = ".PREFIX."trole.RoleId
									WHERE
											".PREFIX."trole.IsActive = 1
									AND
											".PREFIX."tprojects.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojects.IdProject = :id", 
									array(':id' => $id));
	}

	public function get_wo_task_project($id) {
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
									WHERE 
											".PREFIX."tprojecttask.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojecttask.IdProject = :id", 
									array(':id' => $id));
	}

	public function get_wo_schedule_project($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectschedule.IdSchedule,
											".PREFIX."tprojectschedule.IdProject,
											".PREFIX."tprojectschedule.IdClient,
											".PREFIX."tprojectschedule.ScheduleDesc,
											".PREFIX."tprojectschedule.ScheduleTimeStart,
											".PREFIX."tprojectschedule.ScheduleTimeEnd,
											".PREFIX."tprojectschedule.ScheduleDueDate,
											DATE_FORMAT(".PREFIX."tprojectschedule.ScheduleDueDate,'%M %d, %Y') AS nScheduleDueDate,
											".PREFIX."tprojectschedule.ScheduleNotes,
											".PREFIX."tprojectschedule.IsFinish,
											".PREFIX."tprojectschedule.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tprojectschedule.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojectschedule.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tprojectschedule.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."tprojectschedule.CreatedUser,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS CreatedName,
											".PREFIX."tprojects.IdProject
									FROM 
											".PREFIX."tprojectschedule 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tuser.IdUser = ".PREFIX."tprojectschedule.CreatedUser
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectschedule.IdProject
									WHERE 
											".PREFIX."tprojectschedule.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojectschedule.IdProject = :id", 
									array(':id' => $id));
	}

	public function get_wo_invoice($id) {
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
											".PREFIX."tprojectinvoices.invoiceTaxRate,
											".PREFIX."tprojectinvoices.invoiceTotalPaid,
											".PREFIX."tprojectinvoices.invoiceTotalDue,
											".PREFIX."tprojectinvoices.invoiceStatus,
											".PREFIX."tprojectinvoices.isCompleted,
											".PREFIX."tprojects.IdProject
									FROM 
											".PREFIX."tprojectinvoices 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectinvoices.IdProject
									WHERE 
											".PREFIX."tprojectinvoices.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojectinvoices.IdProject = :id", 
									array(':id' => $id));
	}

	public function get_wo_attachment($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectattachment.IdAttachment,
											".PREFIX."tprojectattachment.IdProject,
											".PREFIX."tprojectattachment.IdClient,
											".PREFIX."tprojectattachment.AttachmentTitle,
											".PREFIX."tprojectattachment.AttachmentNotes,
											".PREFIX."tprojectattachment.AttachmentType,
											".PREFIX."tprojectattachment.AttachmentSize,
											".PREFIX."tprojectattachment.AttachmentUrl,
											DATE_FORMAT(".PREFIX."tprojectattachment.CreatedDate,'%M %d, %Y %H:%i:%s') AS CreatedDate,
											".PREFIX."tprojectattachment.CreatedUser,
											".PREFIX."tprojectattachment.LastUpdateDate,
											DATE_FORMAT(".PREFIX."tprojectattachment.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tprojectattachment.LastUpdateUser,
											".PREFIX."tprojects.IdProject,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS CreatedName
									FROM 
											".PREFIX."tprojectattachment 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectattachment.IdProject
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tuser.IdUser = ".PREFIX."tprojectattachment.CreatedUser
									WHERE 
											".PREFIX."tprojectattachment.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojectattachment.IdProject = :id", 
									array(':id' => $id));
	}


	public function get_task_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojecttask WHERE IdClient = ".Session::get(IdClient)." AND IdProject = :id", array(':id' => $id));
		return count($data);
	}

	public function get_members_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectmember WHERE IdClient = ".Session::get(IdClient)." AND IdProject = :id", array(':id' => $id));
		return count($data);
	}

	public function get_invoices_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectinvoices WHERE IdClient = ".Session::get(IdClient)." AND IdProject = :id", array(':id' => $id));
		return count($data);
	}


	public function get_wo($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojects.IdProject,
											".PREFIX."tprojects.IdClient,
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
											".PREFIX."tprojects.IdClient = ".Session::get(IdClient)."
									AND
											".PREFIX."tprojects.IdProject = :id", 
									array(':id' => $id));
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}