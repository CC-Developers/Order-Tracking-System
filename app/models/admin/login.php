<?php namespace models\admin;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/admin/login.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class Login extends \core\model {

	public function __construct() {
		parent::__construct();
	}

	public function get_owner($id) {
		return $this->_db->select("SELECT ownerName, ownerAddress, ownerEmail, ownerPhone FROM ".PREFIX."tsettings WHERE settingsId = :id", array(':id' => $id));
	}

	public function get_appname($id) {
		return $this->_db->select("SELECT appName FROM ".PREFIX."tsettings WHERE settingsId = :id", array(':id' => $id));
	}

	public function get_hash($username) {
		$data =  $this->_db->select("SELECT Password FROM ".PREFIX."tuser WHERE Username = :username AND IsActive = 1", array(':username' => $username));
		return $data[0]->Password;
	}

	public function get_user($username) {
		return $this->_db->select("SELECT IdUser, FullName, Email, Level, Username, ProfilePicture, LastLoginIP, IsLogin FROM ".PREFIX."tuser WHERE Username = :username AND IsActive = 1", array(':username' => $username));
	}

	public function get_user_from_email($email) {
		return $this->_db->select("SELECT IdUser, FullName, Email, Level, Username FROM ".PREFIX."tuser WHERE Email = :email AND IsActive = 1 LIMIT 1", array(':email' => $email));
	}

	public function update_lastlogin($data, $where){
    	return $this->_db->update(PREFIX.'tuser',$data, $where);
    }

    public function update_lastupdate($data, $where){
    	return $this->_db->update(PREFIX.'tuser',$data, $where);
    }

    public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }


}