<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/project.php
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

	public function get_upload_path_files_allowed() {
		return $this->_db->select("SELECT 
											".PREFIX."tsettings.uploadPath,
											".PREFIX."tsettings.filesAllowed
									FROM 
											".PREFIX."tsettings"
								);
	}

	/*public function get_user_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tuser WHERE ".PREFIX."tuser.IsActive = 1 AND ".PREFIX."tuser.Level = 3");
	}*/

	public function get_user_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tuser WHERE ".PREFIX."tuser.IsActive = 1 AND ".PREFIX."tuser.Level = 3");
	}

	public function get_user_email($id) {
		return $this->_db->select("SELECT ".PREFIX."tuser.Email FROM ".PREFIX."tuser WHERE ".PREFIX."tuser.IsActive = 1 AND ".PREFIX."tuser.Level = 3 AND ".PREFIX."tuser.IdUser = :id", 
									array(':id' => $id));
	}

	public function get_role_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."trole WHERE ".PREFIX."trole.IsActive = 1");
	}

	public function get_client_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.IsActive = 1");
	}

	public function get_client_email($id) {
		return $this->_db->select("SELECT ".PREFIX."tclients.Email FROM ".PREFIX."tclients WHERE ".PREFIX."tclients.IsActive = 1 AND ".PREFIX."tclients.IdClient = :id", 
									array(':id' => $id));
	}

	public function get_service_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."twotype WHERE ".PREFIX."twotype.IsActive = 1");
	}

	public function get_currency_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tcurrency WHERE ".PREFIX."tcurrency.IsActive = 1");
	}

	public function get_phase_list() {
		return $this->_db->select("SELECT * FROM ".PREFIX."phase WHERE ".PREFIX."phase.IsActive = 1");
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
											".PREFIX."tuser.FullName AS AdminName
									FROM 
											".PREFIX."tprojects 
											LEFT JOIN ".PREFIX."tclients ON ".PREFIX."tprojects.IdClient = ".PREFIX."tclients.IdClient
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
											LEFT JOIN ".PREFIX."tcurrency ON ".PREFIX."tprojects.ProjectCurrency = ".PREFIX."tcurrency.CurrencyId
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tprojects.CreatedUser = ".PREFIX."tuser.IdUser
									WHERE 
											".PREFIX."tprojects.isArchived = 0");
	}

	public function get_project_archived() {
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
									WHERE 
											".PREFIX."tprojects.isArchived = 1");
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
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS MemberName,
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
											".PREFIX."tprojects.IdProject = :id", 
									array(':id' => $id));
	}

	public function get_member_access($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojectmember.IdMember,
											".PREFIX."tprojectmember.IdProject AS MemberProject,
											".PREFIX."tprojectmember.IdUser AS MemberId,
											".PREFIX."tprojectmember.RoleId,
											".PREFIX."tprojects.IdProject,
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
											LEFT JOIN ".PREFIX."trole ON ".PREFIX."tprojectmember.RoleId = ".PREFIX."trole.RoleId
									WHERE
											".PREFIX."tprojectmember.IdProject = :id
									AND
											".PREFIX."tprojectmember.IdUser = ".Session::get(IdUser), 
									array(':id' => $id));
	}

	public function check_user_available($id, $user) {
		$data = $this->_db->select("SELECT ".PREFIX."tprojectmember.IdUser FROM ".PREFIX."tprojectmember WHERE ".PREFIX."tprojectmember.IdProject = :id AND ".PREFIX."tprojectmember.IdUser = :user LIMIT 1", array(':id' => $id, 'user' => $user));
		return count($data);
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
											".PREFIX."tprojectinvoices.isGenerated,
											".PREFIX."tprojectinvoices.isCompleted,
											".PREFIX."tprojects.IdProject
									FROM 
											".PREFIX."tprojectinvoices 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectinvoices.IdProject
									WHERE 
											".PREFIX."tprojectinvoices.IdProject = :id", 
									array(':id' => $id));
	}

	public function check_invoice_number($number) {
		$data = $this->_db->select("SELECT ".PREFIX."tprojectinvoices.invoiceNumber FROM ".PREFIX."tprojectinvoices WHERE ".PREFIX."tprojectinvoices.invoiceNumber = :number LIMIT 1", array(':number' => $number));
		return count($data);
	}

	public function get_wo_finance($id) {
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
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS CreatedName
									FROM 
											".PREFIX."tprojectfinances 
											LEFT JOIN ".PREFIX."tprojects ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectfinances.IdProject
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tuser.IdUser = ".PREFIX."tprojectfinances.CreatedUser
									WHERE 
											".PREFIX."tprojectfinances.IdProject = :id", 
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
											".PREFIX."tprojectattachment.IdProject = :id", 
									array(':id' => $id));
	}


	public function get_task_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojecttask WHERE IdProject = :id", array(':id' => $id));
		return count($data);
	}

	public function get_task_complete_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojecttask WHERE IdProject = :id AND TaskProgress < 100", array(':id' => $id));
		return count($data);
	}

	public function get_members_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectmember WHERE IdProject = :id", array(':id' => $id));
		return count($data);
	}

	public function get_invoices_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectinvoices WHERE IdProject = :id", array(':id' => $id));
		return count($data);
	}

	public function get_payments_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectpayments WHERE IdProject = :id", array(':id' => $id));
		return count($data);
	}

	public function get_wo_complete_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE IdProject = :id AND IsComplete = 0", array(':id' => $id));
		return count($data);
	}

	public function get_wo($id) {
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
											".PREFIX."tprojects.IdProject = :id", 
									array(':id' => $id));
	}

	public function insert_project_data($data){
    		$this->_db->insert(PREFIX.'tprojects',$data);
			return $this->_db->lastInsertId('IdProject');
    }

    public function update_project_data($data, $where){
    	return $this->_db->update(PREFIX.'tprojects',$data, $where);
    }

    public function delete_project_data($data){
		$this->_db->delete(PREFIX.'tprojects', $data);
	}

	public function insert_task_data($data){
    		$this->_db->insert(PREFIX.'tprojecttask',$data);
			return $this->_db->lastInsertId('IdTask');
    }

    public function update_task_data($data, $where){
    	return $this->_db->update(PREFIX.'tprojecttask',$data, $where);
    }

    public function delete_task_data($data){
		$this->_db->delete(PREFIX.'tprojecttask', $data);
	}

	public function insert_schedule_data($data){
    		$this->_db->insert(PREFIX.'tprojectschedule',$data);
			return $this->_db->lastInsertId('IdSchedule');
    }

    public function update_schedule_data($data, $where){
    	return $this->_db->update(PREFIX.'tprojectschedule',$data, $where);
    }

    public function delete_schedule_data($data){
		$this->_db->delete(PREFIX.'tprojectschedule', $data);
	}

	public function insert_member_data($data){
    		$this->_db->insert(PREFIX.'tprojectmember',$data);
			return $this->_db->lastInsertId('IdMember');
    }

    public function delete_member_data($data){
		$this->_db->delete(PREFIX.'tprojectmember', $data);
	}

	public function insert_finance_data($data){
    		$this->_db->insert(PREFIX.'tprojectfinances',$data);
			return $this->_db->lastInsertId('IdFinance');
    }

    public function update_finance_data($data, $where){
    	return $this->_db->update(PREFIX.'tprojectfinances',$data, $where);
    }

    public function delete_finance_data($data){
		$this->_db->delete(PREFIX.'tprojectfinances', $data);
	}

	public function insert_attachment_data($data){
    		$this->_db->insert(PREFIX.'tprojectattachment',$data);
			return $this->_db->lastInsertId('IdAttachment');
    }

    public function update_attachment_data($data, $where){
    	return $this->_db->update(PREFIX.'tprojectattachment',$data, $where);
    }

    public function delete_attachment_data($data){
		$this->_db->delete(PREFIX.'tprojectattachment', $data);
	}

	public function insert_invoice_data($data){
    		$this->_db->insert(PREFIX.'tprojectinvoices',$data);
			return $this->_db->lastInsertId('invoiceId');
    }

    public function delete_invoice_data($data){
		$this->_db->delete(PREFIX.'tprojectinvoices', $data);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}