<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/service.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Service extends \core\model {

	public function __construct() {
		parent::__construct();
	}

	public function get_service() {
		return $this->_db->select("SELECT * FROM ".PREFIX."twotype");
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

	public function view_service($id) {
		return $this->_db->select("SELECT 
											".PREFIX."twotype.TypeId,
											".PREFIX."twotype.TypeTitle,
											".PREFIX."twotype.TypeCode,
											".PREFIX."twotype.TypeDesc,
											".PREFIX."twotype.IsActive,
											DATE_FORMAT(".PREFIX."twotype.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."twotype.LastUpdateDate,
											".PREFIX."twotype.LastUpdateUser,
											DATE_FORMAT(".PREFIX."twotype.CreatedDate,'%M %d, %Y %H:%i:%s') AS nCreatedDate,
											".PREFIX."twotype.CreatedDate,
											".PREFIX."twotype.CreatedUser,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName
									FROM 
											".PREFIX."twotype 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."twotype.CreatedUser = ".PREFIX."tuser.IdUser
									WHERE 
											TypeId = :id", 
									array(':id' => $id));
	}

	public function get_service_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE TypeId = :id", array(':id' => $id));
		return count($data);
	}

	public function insert_service_data($data){
    		$this->_db->insert(PREFIX.'twotype',$data);
			return $this->_db->lastInsertId('TypeId');
    }

    public function check_code($code) {
		$data = $this->_db->select("SELECT ".PREFIX."twotype.TypeCode FROM ".PREFIX."twotype WHERE ".PREFIX."twotype.TypeCode = :code LIMIT 1", array(':code' => $code));
		return count($data);
	}

	public function check_name($name) {
		$data = $this->_db->select("SELECT ".PREFIX."twotype.TypeTitle FROM ".PREFIX."twotype WHERE ".PREFIX."twotype.TypeTitle = :name LIMIT 1", array(':name' => $name));
		return count($data);
	}


    public function update_service_data($data, $where){
    	return $this->_db->update(PREFIX.'twotype',$data, $where);
    }

    public function delete_service_data($data){
		$this->_db->delete(PREFIX.'twotype', $data);
	}

	public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}