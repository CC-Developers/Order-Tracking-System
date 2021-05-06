<?php namespace models\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/models/client/profile.php
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

	public function view_profile($id) {
		return $this->_db->select("SELECT 
											".PREFIX."tclients.IdClient,
											".PREFIX."tclients.FullName,
											".PREFIX."tclients.MailingAddress,
											".PREFIX."tclients.Phone,
											".PREFIX."tclients.CellPhone,
											".PREFIX."tclients.Email,
											".PREFIX."tclients.IsActive,
											".PREFIX."tclients.Username,
											".PREFIX."tclients.Password,
											".PREFIX."tclients.ProfilePicture,
											DATE_FORMAT(".PREFIX."tclients.LastLoginDate,'%M %d, %Y %H:%i:%s') AS nLastLoginDate,
											".PREFIX."tclients.LastLoginDate,
											".PREFIX."tclients.LastLoginIp,
											".PREFIX."tclients.IsLogin,
											DATE_FORMAT(".PREFIX."tclients.LastUpdateDate,'%M %d, %Y %H:%i:%s') AS nLastUpdateDate,
											".PREFIX."tclients.LastUpdateDate,
											".PREFIX."tclients.LastUpdateUser,
											DATE_FORMAT(".PREFIX."tclients.CreatedDate,'%M %d, %Y %H:%i:%s') AS nCreatedDate,
											".PREFIX."tclients.CreatedDate,
											".PREFIX."tclients.CreatedUser
									FROM 
											".PREFIX."tclients 
									WHERE 
											IdClient = :id", 
									array(':id' => $id));
	}

	public function get_client_wo_count($id) {
		$data = $this->_db->select("SELECT * FROM ".PREFIX."tprojects WHERE IdClient = :id", array(':id' => $id));
		return count($data);
	}

	public function get_client_wo($id) {
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
											".PREFIX."tprojects.IdClient = :id", 
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
    	return $this->_db->update(PREFIX.'tclients',$data, $where);
    }

    public function insert_audit_data($data){
    	$this->_db->insert(PREFIX.'audit',$data);
		return $this->_db->lastInsertId('IdAudit');
    }

}