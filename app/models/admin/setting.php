<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/setting.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Setting extends \core\model {

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

	public function get_setting() {
		return $this->_db->select("SELECT 
											".PREFIX."tsettings.settingsId,
											".PREFIX."tsettings.appUrl,
											".PREFIX."tsettings.appName,
											".PREFIX."tsettings.ownerName,
											".PREFIX."tsettings.ownerAddress,
											".PREFIX."tsettings.ownerEmail,
											".PREFIX."tsettings.ownerPhone,
											".PREFIX."tsettings.uploadPath,
											".PREFIX."tsettings.filesAllowed,
											".PREFIX."tsettings.AppLogo,
											DATE_FORMAT(".PREFIX."tsettings.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tsettings.LastUpdateDate,
											".PREFIX."tsettings.LastUpdateUser,
											".PREFIX."tuser.IdUser,
											".PREFIX."tuser.FullName AS AdminName 
									FROM 
											".PREFIX."tsettings 
											LEFT JOIN ".PREFIX."tuser ON ".PREFIX."tsettings.LastUpdateUser = ".PREFIX."tuser.IdUser"
								);
	}

    public function update_setting_data($data, $where){
    	return $this->_db->update(PREFIX.'tsettings',$data, $where);
    }

    public function get_phase() {
		return $this->_db->select("SELECT * FROM ".PREFIX."phase");
	}

	public function get_phase_id($id) {
		return $this->_db->select("SELECT * FROM ".PREFIX."phase WHERE PhaseId = :id", array(':id' => $id));
	}

	public function get_phase_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE ProjectStatus = :id", array(':id' => $id));
		return count($data);
	}

	public function delete_phase_data($data){
		$this->_db->delete(PREFIX.'phase', $data);
	}

	public function get_currency() {
		return $this->_db->select("SELECT * FROM ".PREFIX."tcurrency");
	}

	public function get_currency_id($id) {
		return $this->_db->select("SELECT * FROM ".PREFIX."tcurrency WHERE CurrencyId = :id", array(':id' => $id));
	}

	public function get_currency_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE ProjectCurrency = :id", array(':id' => $id));
		return count($data);
	}

	public function delete_currency_data($data){
		$this->_db->delete(PREFIX.'tcurrency', $data);
	}

	public function get_role() {
		return $this->_db->select("SELECT * FROM ".PREFIX."trole");
	}

	public function get_role_id($id) {
		return $this->_db->select("SELECT * FROM ".PREFIX."trole WHERE RoleId = :id", array(':id' => $id));
	}

	public function get_role_pm_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojectmember WHERE RoleId = :id", array(':id' => $id));
		return count($data);
	}

	public function delete_role_data($data){
		$this->_db->delete(PREFIX.'trole', $data);
	}

	public function add_phase($data){
    		$this->_db->insert(PREFIX.'phase',$data);
			return $this->_db->lastInsertId('PhaseId');
    }

    public function check_phase_color($color) {
		$data = $this->_db->select("SELECT ".PREFIX."phase.PhaseColor FROM ".PREFIX."phase WHERE ".PREFIX."phase.PhaseColor = :color LIMIT 1", array(':color' => $color));
		return count($data);
	}

	public function check_phase_order($order) {
		$data = $this->_db->select("SELECT ".PREFIX."phase.PhaseOrder FROM ".PREFIX."phase WHERE ".PREFIX."phase.PhaseOrder = :order LIMIT 1", array(':order' => $order));
		return count($data);
	}

    public function update_phase($data, $where){
    	return $this->_db->update(PREFIX.'phase',$data, $where);
    }

    public function add_currency($data){
    		$this->_db->insert(PREFIX.'tcurrency',$data);
			return $this->_db->lastInsertId('CurrencyId');
    }

    public function check_currency_name($name) {
		$data = $this->_db->select("SELECT ".PREFIX."tcurrency.CurrencyName FROM ".PREFIX."tcurrency WHERE ".PREFIX."tcurrency.CurrencyName = :name LIMIT 1", array(':name' => $name));
		return count($data);
	}

	public function check_currency_symbol($symbol) {
		$data = $this->_db->select("SELECT ".PREFIX."tcurrency.CurrencySymbol FROM ".PREFIX."tcurrency WHERE ".PREFIX."tcurrency.CurrencySymbol = :symbol LIMIT 1", array(':symbol' => $symbol));
		return count($data);
	}

    public function update_currency($data, $where){
    	return $this->_db->update(PREFIX.'tcurrency',$data, $where);
    }

    public function add_role($data){
    		$this->_db->insert(PREFIX.'trole',$data);
			return $this->_db->lastInsertId('RoleId');
    }

    public function check_role_name($name) {
		$data = $this->_db->select("SELECT ".PREFIX."trole.RoleName FROM ".PREFIX."trole WHERE ".PREFIX."trole.RoleName = :name LIMIT 1", array(':name' => $name));
		return count($data);
	}

    public function update_role($data, $where){
    	return $this->_db->update(PREFIX.'trole',$data, $where);
    }

    public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }
}