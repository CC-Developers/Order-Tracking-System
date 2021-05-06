<?php namespace controllers\client;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/controllers/client/project.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
use core\view as View,
 	\helpers\session as Session,
 	\helpers\password as Password,
 	\helpers\document as Document,
 	\helpers\url as Url;
use Helpers\csrfhelper;

class Project extends \core\controller{

	private $_project;

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
		$this->_project = new \models\client\project();
		if(Session::get('clientloggedin') == false) {
			Url::redirect('login');
		}
	}

	public function view($id){

		$data['get_wo_task_project'] 		= $this->_project->get_wo_task_project($id);
		$data['get_wo_schedule_project'] 	= $this->_project->get_wo_schedule_project($id);
		$data['get_wo_member'] 				= $this->_project->get_wo_member($id);
		$data['get_wo_invoice'] 			= $this->_project->get_wo_invoice($id);
		$data['get_wo_attachment'] 			= $this->_project->get_wo_attachment($id);
		$data['taskcount'] 					= $this->_project->get_task_wo_count($id);
		$data['membercount'] 				= $this->_project->get_members_wo_count($id);
		$data['invoicecount'] 				= $this->_project->get_invoices_wo_count($id);
		$data['wodata'] 					= $this->_project->get_wo($id);

		$data['CSRF_TOKEN_NAME'] = csrfhelper::TOKEN_NAME;
		$data['CSRF_TOKEN_VALUE'] = csrfhelper::getToken();

		$data['js'] 			= 
			"
			<script src='".Url::get_template_path()."js/plugins/datatables/jquery.dataTables.js' type='text/javascript'></script>
			<script src='".Url::get_template_path()."js/plugins/datatables/dataTables.bootstrap.js' type='text/javascript'></script>
			";
		$data['jq'] 			= 
			"<script type='text/javascript'>
				$(function() { 
				    $('#chat-box').slimScroll({
				        height: '250px'
				    });	
					$('#all-attachments').dataTable({
			            'bPaginate': false,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
					$('#all-members').dataTable({
			            'bPaginate': false,
			            'bLengthChange': true,
			            'bFilter': true,
			            'bSort': true,
			            'bInfo': true,
			            'bAutoWidth': true
			        });
		    	});
			</script>";

		$data['rows'] 			= $this->_project->view_project($id);

        if ($data['rows']){
            foreach ($data['rows'] as $row) {
            	$data['IdProject'] 			= $row->IdProject;
				$data['IdClient'] 			= $row->IdClient;
				$data['TypeId'] 			= $row->TypeId;
				$data['ProjectProgress'] 	= $row->ProjectProgress;
				$data['ProjectStatus'] 		= $row->ProjectStatus;
				$data['ProjectCurrency'] 	= $row->ProjectCurrency;
				$data['ProjectNotes'] 		= $row->ProjectNotes;
				$data['ProjectStart'] 		= $row->ProjectStart;
				$data['nProjectStart'] 		= $row->nProjectStart;
				$data['ProjectDeadline'] 	= $row->ProjectDeadline;
				$data['nProjectDeadline'] 	= $row->nProjectDeadline;
				$data['LastUpdateDate'] 	= $row->LastUpdateDate;
				$data['nLastUpdateDate'] 	= $row->nLastUpdateDate;
				$data['LastUpdateUser'] 	= $row->LastUpdateUser;
				$data['CreatedDate'] 		= $row->CreatedDate;
				$data['nCreatedDate'] 		= $row->nCreatedDate;
				$data['CreatedUser'] 		= $row->CreatedUser;
				$data['isArchived'] 		= $row->isArchived;
				$data['archiveDate'] 		= $row->archiveDate;
				$data['narchiveDate'] 		= $row->narchiveDate;
				$data['IsComplete'] 		= $row->IsComplete;
				$data['TaskProgress'] 		= $row->TaskProgress;
				$data['IdClient'] 			= $row->IdClient;
				$data['ClientName'] 		= $row->ClientName;
				$data['TypeId'] 			= $row->TypeId;
				$data['TypeCode'] 			= $row->TypeCode;
				$data['TypeTitle'] 			= $row->TypeTitle;
				$data['CurrencyId'] 		= $row->CurrencyId;
				$data['CurrencyName'] 		= $row->CurrencyName;
				$data['CurrencySymbol'] 	= $row->CurrencySymbol;
				$data['PhaseId'] 			= $row->PhaseId;
				$data['PhaseName'] 			= $row->PhaseName;
				$data['PhaseColor'] 		= $row->PhaseColor;
				$data['IdUser'] 			= $row->IdUser;
				$data['AdminName'] 			= $row->AdminName;
            }
        }

        if ($id != $row->IdProject) {
        	Session::set('InvalidProject', 1);
        }

		View::rendertemplate('header-client',$data);
		View::render('client/project/view',$data, $error);
		View::rendertemplate('footer',$data);
	}


}