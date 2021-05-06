<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/mail.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Mail extends \core\model {

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

	public function get_user_list($id) {
		return $this->_db->select("SELECT * FROM ".PREFIX."tuser WHERE ".PREFIX."tuser.IsActive = 1 AND ".PREFIX."tuser.IdUser != :id", array(':id' => $id));
	}

	public function get_inbox($session) {
		return $this->_db->select("SELECT 
											".PREFIX."tmailbox.IdMail,
											".PREFIX."tmailbox.SenderId,
											".PREFIX."tmailbox.ReceiverId,
											".PREFIX."tmailbox.MailTitle,
											".PREFIX."tmailbox.MailContent,
											DATE_FORMAT(".PREFIX."tmailbox.sentDate,'%M %d, %Y %H:%i:%s') AS sentDate,
											".PREFIX."tmailbox.isRead,
											".PREFIX."tmailbox.isArchived,
											".PREFIX."tmailbox.isDeleted,
											".PREFIX."tmailbox.DeletedDate,
											DATE_FORMAT(".PREFIX."tmailbox.DeletedDate,'%M %d, %Y %H:%i:%s') AS nDeletedDate,
											DATE_FORMAT(".PREFIX."tmailbox.LastUpdatedDate,'%M %d, %Y %H:%i:%s') AS LastUpdatedDate,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.Email,
											".PREFIX."tuser.FullName AS SenderName 
									FROM 
											".PREFIX."tmailbox 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tmailbox.SenderId = ".PREFIX."tuser.IdUser
									WHERE 
											".PREFIX."tmailbox.isArchived = 0
									AND 
											".PREFIX."tmailbox.isDeleted = 0
									AND
											".PREFIX."tmailbox.ReceiverId = :id", array(':id' => $session));
	}


	public function get_outbox($session) {
		return $this->_db->select("SELECT 
											".PREFIX."tmailbox.IdMail,
											".PREFIX."tmailbox.SenderId,
											".PREFIX."tmailbox.ReceiverId,
											".PREFIX."tmailbox.MailTitle,
											".PREFIX."tmailbox.MailContent,
											DATE_FORMAT(".PREFIX."tmailbox.sentDate,'%M %d, %Y %H:%i:%s') AS sentDate,
											".PREFIX."tmailbox.isRead,
											".PREFIX."tmailbox.isArchived,
											".PREFIX."tmailbox.isDeleted,
											".PREFIX."tmailbox.DeletedDate,
											DATE_FORMAT(".PREFIX."tmailbox.DeletedDate,'%M %d, %Y %H:%i:%s') AS nDeletedDate,
											DATE_FORMAT(".PREFIX."tmailbox.LastUpdatedDate,'%M %d, %Y %H:%i:%s') AS LastUpdatedDate,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.Email,
											".PREFIX."tuser.FullName AS ReceiverName 
									FROM 
											".PREFIX."tmailbox 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tmailbox.ReceiverId = ".PREFIX."tuser.IdUser
									WHERE 
											".PREFIX."tmailbox.SenderId = :id", array(':id' => $session));
	}

	public function get_mail_archived($session) {
		return $this->_db->select("SELECT 
											".PREFIX."tmailbox.IdMail,
											".PREFIX."tmailbox.SenderId,
											".PREFIX."tmailbox.ReceiverId,
											".PREFIX."tmailbox.MailTitle,
											".PREFIX."tmailbox.MailContent,
											DATE_FORMAT(".PREFIX."tmailbox.sentDate,'%M %d, %Y %H:%i:%s') AS sentDate,
											".PREFIX."tmailbox.isRead,
											".PREFIX."tmailbox.isArchived,
											".PREFIX."tmailbox.isDeleted,
											".PREFIX."tmailbox.DeletedDate,
											DATE_FORMAT(".PREFIX."tmailbox.DeletedDate,'%M %d, %Y %H:%i:%s') AS nDeletedDate,
											DATE_FORMAT(".PREFIX."tmailbox.LastUpdatedDate,'%M %d, %Y %H:%i:%s') AS LastUpdatedDate,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.Email,
											".PREFIX."tuser.FullName AS SenderName 
									FROM 
											".PREFIX."tmailbox 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tmailbox.SenderId = ".PREFIX."tuser.IdUser
									WHERE 
											".PREFIX."tmailbox.isDeleted = 0 
									AND 
											".PREFIX."tmailbox.isArchived = 1 
									AND 
											".PREFIX."tmailbox.ReceiverId = :id", array(':id' => $session));
	}

	public function update_mail_data($data, $where){
    	return $this->_db->update(PREFIX.'tmailbox',$data, $where);
    }
	
	public function compose_mail($data){
    		$this->_db->insert(PREFIX.'tmailbox',$data);
			return $this->_db->lastInsertId('IdMail');
    }

    public function delete_mail_data($data){
		$this->_db->delete(PREFIX.'tmailbox', $data);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}