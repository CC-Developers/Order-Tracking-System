<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/profile.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Profile extends \core\model {

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

	public function view_profile($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName,
											".PREFIX."tuser.MailingAddress,
											".PREFIX."tuser.Phone,
											".PREFIX."tuser.CellPhone,
											".PREFIX."tuser.Email,
											".PREFIX."tuser.IsActive,
											".PREFIX."tuser.Level,
											".PREFIX."tuser.Username,
											".PREFIX."tuser.Password,
											".PREFIX."tuser.ProfilePicture,
											DATE_FORMAT(".PREFIX."tuser.LastLogin,'%M %d, %Y %H:%i:%s') AS nLastLoginDate,
											".PREFIX."tuser.LastLogin,
											".PREFIX."tuser.LastLoginIp,
											".PREFIX."tuser.IsLogin,
											DATE_FORMAT(".PREFIX."tuser.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tuser.LastUpdateDate,
											".PREFIX."tuser.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tuser.CreatedDate,'%M %d, %Y %H:%i:%s') AS nCreatedDate,
											".PREFIX."tuser.CreatedDate,
											".PREFIX."tuser.CreatedUser
									FROM 
											".PREFIX."tuser 
									WHERE 
											IdUser = :id", 
									array(':id' => $id));
	}

	public function get_user_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectmember WHERE IdUser = :id", array(':id' => $id));
		return count($data);
	}

	public function get_user_wo($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tprojects.IdProject,
											".PREFIX."tprojects.TypeId,
											".PREFIX."tprojects.ProjectProgress,
											".PREFIX."tprojects.ProjectStatus,
											".PREFIX."phase.PhaseId,
											".PREFIX."phase.PhaseName,
											".PREFIX."phase.PhaseColor,
											".PREFIX."twotype.TypeId,
											".PREFIX."twotype.TypeTitle AS TypeTitle,
											".PREFIX."tprojectmember.IdProject,
											".PREFIX."tprojectmember.IdUser,
											".PREFIX."tprojectmember.RoleId,
											".PREFIX."trole.RoleId,
											".PREFIX."trole.RoleName

									FROM 
											".PREFIX."tprojects 
											LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
											LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
											LEFT JOIN ".PREFIX."tprojectmember ON ".PREFIX."tprojects.IdProject = ".PREFIX."tprojectmember.IdProject
											LEFT JOIN ".PREFIX."trole ON ".PREFIX."tprojectmember.RoleId = ".PREFIX."trole.RoleId
									WHERE 
											".PREFIX."tprojectmember.IdUser = :id", 
									array(':id' => $id));
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

    public function update_profile_data($data, $where){
    	return $this->_db->update(PREFIX.'tuser',$data, $where);
    }

    public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}