<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/dashboard/dashboard.php
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
?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
            <?php
			if ($data['rows']) {
				foreach ($data['rows'] as $row) {
					echo "<h1>"._WELCOME_LANG_."<small>$row->appName</small></h1>";
				}
			}
			?>
        <ol class="breadcrumb">
            <li class="active"><a href='<?php echo DIR;?>admin'><i class="fa fa-dashboard"></i> <?php echo _DASHBOARD_LANG_;?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
            if(Session::get(WelcomeDashboard) == '1') {
                echo "<div class='alert alert-success alert-dismissable'>
                                <i class='fa fa-check'></i>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <b>"._WELCOME_MESSAGE_LANG_.",</b> ".Session::get('FullName')." !
                            </div>";
                Session::pull(WelcomeDashboard);
            }
        ?>
        <?php
            if(Session::get(successResponseRequest) == '1') {
                echo "<div class='alert alert-success alert-dismissable'>
                                <i class='fa fa-check'></i>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_RESPONSE_REQUEST_LANG_."
                            </div>";
                Session::pull(successResponseRequest);
            }
        ?>
        <?php if(Session::get(Level) == '1') { ?>
        <!-- Small boxes (Admin Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo $data['wocount'];?>
                        </h3>
                        <p>
                            <?php echo _ACTIVE_WORK_ORDER_LANG_; ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?php echo DIR;?>admin/project" class="small-box-footer">
                        <?php echo _MORE_INFO_LANG_;?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php echo $data['clientcount'];?>
                        </h3>
                        <p>
                            <?php echo _ACTIVE_CLIENT_LANG_;?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href='<?php echo DIR;?>admin/client' class="small-box-footer">
                        <?php echo _MORE_INFO_LANG_;?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php echo $data['invoicecount']; ?>
                        </h3>
                        <p>
                            <?php echo _ACTIVE_INVOICE_LANG_;?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios7-pricetag-outline"></i>
                    </div>
                    <a href="<?php echo DIR;?>admin/invoice" class="small-box-footer">
                        <?php echo _MORE_INFO_LANG_;?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php echo $data['mailcount'];?>
                        </h3>
                        <p>
                            <?php echo _UNREAD_MESSAGE_LANG_;?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios7-email-outline"></i>
                    </div>
                    <a href="<?php echo DIR;?>admin/mail" class="small-box-footer">
                        <?php echo _MORE_INFO_LANG_;?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <hr />
         <div class="row">
            <div class="col-lg-12"> 
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _WO_REQUEST_TITLE_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_client_active_request']){ ?>
                                <table id="all-requests" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Client</center></th>
                                            <th><center>Status</center></th>
                                            <th>Work Order Type <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th><center>Currency</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_client_active_request'] as $row) 
                                            {

                                                if ($row->RequestStatus == 0) {
                                                    $statusLabel = "<span class='badge'>Waiting</span>";
                                                } else if ($row->RequestStatus == 1) {
                                                    $statusLabel = "<span class='badge bg-red'>Rejected / Canceled</span>";
                                                } else if ($row->RequestStatus == 2) {
                                                    $statusLabel = "<span class='badge bg-blue'>Approved</span>";
                                                } else if ($row->RequestStatus == 3) {
                                                    $statusLabel = "<span class='badge bg-green'>Active</span>";
                                                }

                                                if ($row->RequestStatus == 0) {
                                                    $action = "<a href='' data-toggle='modal' data-target='#update-request$row->IdRequest'><i class='fa fa-search'></i>  </a>";
                                                } else if ($row->RequestStatus == 1) {
                                                     $action = "<a href='' data-toggle='modal' data-target='#update-request$row->IdRequest'><i class='fa fa-search'></i>  </a>";
                                                } else if ($row->RequestStatus == 2) {
                                                     $action = "<a href='' data-toggle='modal' data-target='#update-request$row->IdRequest'><i class='fa fa-search'></i>  </a>";
                                                } else {
                                                    $action = "<i class='fa fa-ellipsis-h'></i>";
                                                }

                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><a href='".DIR."admin/client/view/".$row->IdClient."'>$row->ClientName</a></center></td>
                                                        <td>
                                                            <center>
                                                                $statusLabel
                                                            </center>
                                                        </td>
                                                        <td><b>[$row->TypeCode]</b> $row->TypeTitle</td>
                                                        <td><span class='badge bg-green'>$row->nProjectStart</span></td>
                                                        <td><span class='badge bg-red'>$row->nProjectDeadline</span></td>
                                                        <td>
                                                        <center>
                                                            $row->CurrencyName
                                                        </center>
                                                        </td>
                                                        <td><center>$action</center></td>
                                                    </tr>
                                                ";
                                                $no++;
                                                echo 
                                                    "
                                                    <div class='modal fade' id='update-request$row->IdRequest' tabindex='-1' role='dialog' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                    <h4 class='modal-title'><i class='fa fa-ticket'></i> "._RESPONSE_WORK_ORDER_REQUEST_LANG_."</h4>
                                                                </div>
                                                                <form role='form' method='post' action=''>
                                                                    <div class='modal-body'>
                                                                            <div class='form-group'>
                                                                                <label>Client</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->ClientName' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Work Order Type Code</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->TypeCode' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Work Order Type Title</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->TypeTitle' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Work Order Currency</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->CurrencyName' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Start Date</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->nProjectStart' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Deadline</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->nProjectDeadline' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Notes</label>
                                                                                <textarea class='form-control' placeholder='Enter ...' disabled>$row->ProjectNotes</textarea>
                                                                            </div>
                                                                            <div class='box-footer'>
                                                                                <input type='hidden' name='IdRequest' id='IdRequest' value='$row->IdRequest'/>
                                                                                <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                                <input type='hidden' name='TypeId' id='TypeId' value='$row->TypeId'/>
                                                                                <input type='hidden' name='ProjectCurrency' id='ProjectCurrency' value='$row->ProjectCurrency'/>
                                                                                <input type='hidden' name='ProjectStart' id='ProjectStart' value='$row->ProjectStart'/>
                                                                                <input type='hidden' name='ProjectDeadline' id='ProjectDeadline' value='$row->ProjectDeadline'/>
                                                                                <input type='hidden' name='ProjectNotes' id='ProjectNotes' value='$row->ProjectNotes'/>
                                                                                <button type='input' name='submit' value='reject-request' class='btn btn-default' ><i class='fa fa-ban'></i> Reject / Cancel</button>
                                                                                <button type='input' name='submit' value='approve-request' class='btn btn-success' ><i class='fa f fa-check-circle-o'></i> Approve</button>
                                                                                <button type='input' name='submit' value='activate-request' class='btn btn-info' ><i class='fa fa-bar-chart-o'></i> Activate Work Order</button>
                                                                                <button type='input' name='submit' value='delete-request' class='btn btn-danger' ><i class='fa fa-times'></i> Delete</button>
                                                                                <button type='button' class='btn pull-right' data-dismiss='modal'> Close</button>
                                                                            </div>
                                                                                <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                                    </form>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    ";
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_ACTIVE_WORK_ORDER_REQUEST_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> <?php echo _STATISTICS_LANG_;?></h3>
                    </div>
                    <div class="panel-body">
                        <div id="container" style="margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else if(Session::get(Level) == '2') { ?>
        <!-- Small boxes (User Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo $data['wocount'];?>
                        </h3>
                        <p>
                            Active Work Orders
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?php echo DIR;?>admin/project" class="small-box-footer">
                        <?php echo _MORE_INFO_LANG_;?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php echo $data['mailcount'];?>
                        </h3>
                        <p>
                            <?php echo _UNREAD_MESSAGE_LANG_;?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios7-email-outline"></i>
                    </div>
                    <a href="<?php echo DIR;?>admin/mail" class="small-box-footer">
                        <?php echo _MORE_INFO_LANG_;?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <hr />
        <div class="row">
            <div class="col-lg-12"> 
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _WO_REQUEST_TITLE_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_client_active_request']){ ?>
                                <table id="all-requests" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Client</center></th>
                                            <th><center>Status</center></th>
                                            <th>Work Order Type <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th><center>Currency</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_client_active_request'] as $row) 
                                            {

                                                if ($row->RequestStatus == 0) {
                                                    $statusLabel = "<span class='badge'>Waiting</span>";
                                                } else if ($row->RequestStatus == 1) {
                                                    $statusLabel = "<span class='badge bg-red'>Rejected / Canceled</span>";
                                                } else if ($row->RequestStatus == 2) {
                                                    $statusLabel = "<span class='badge bg-blue'>Approved</span>";
                                                } else if ($row->RequestStatus == 3) {
                                                    $statusLabel = "<span class='badge bg-green'>Active</span>";
                                                }

                                                if ($row->RequestStatus == 0) {
                                                    $action = "<a href='' data-toggle='modal' data-target='#update-request$row->IdRequest'><i class='fa fa-search'></i>  </a>";
                                                } else if ($row->RequestStatus == 1) {
                                                     $action = "<a href='' data-toggle='modal' data-target='#update-request$row->IdRequest'><i class='fa fa-search'></i>  </a>";
                                                } else if ($row->RequestStatus == 2) {
                                                     $action = "<a href='' data-toggle='modal' data-target='#update-request$row->IdRequest'><i class='fa fa-search'></i>  </a>";
                                                } else {
                                                    $action = "<i class='fa fa-ellipsis-h'></i>";
                                                }

                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><a href='".DIR."admin/client/view/".$row->IdClient."'>$row->ClientName</a></center></td>
                                                        <td>
                                                            <center>
                                                                $statusLabel
                                                            </center>
                                                        </td>
                                                        <td><b>[$row->TypeCode]</b> $row->TypeTitle</td>
                                                        <td><span class='badge bg-green'>$row->nProjectStart</span></td>
                                                        <td><span class='badge bg-red'>$row->nProjectDeadline</span></td>
                                                        <td>
                                                        <center>
                                                            $row->CurrencyName
                                                        </center>
                                                        </td>
                                                        <td><center>$action</center></td>
                                                    </tr>
                                                ";
                                                $no++;
                                                echo 
                                                    "
                                                    <div class='modal fade' id='update-request$row->IdRequest' tabindex='-1' role='dialog' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                    <h4 class='modal-title'><i class='fa fa-ticket'></i> "._RESPONSE_WORK_ORDER_REQUEST_LANG_."</h4>
                                                                </div>
                                                                <form role='form' method='post' action=''>
                                                                    <div class='modal-body'>
                                                                            <div class='form-group'>
                                                                                <label>Client</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->ClientName' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Work Order Type Code</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->TypeCode' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Work Order Type Title</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->TypeTitle' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Work Order Currency</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->CurrencyName' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Start Date</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->nProjectStart' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Deadline</label>
                                                                                <input type='text' class='form-control' placeholder='Enter ...' value='$row->nProjectDeadline' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Notes</label>
                                                                                <textarea class='form-control' placeholder='Enter ...' disabled>$row->ProjectNotes</textarea>
                                                                            </div>
                                                                            <div class='box-footer'>
                                                                                <input type='hidden' name='IdRequest' id='IdRequest' value='$row->IdRequest'/>
                                                                                <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                                <input type='hidden' name='TypeId' id='TypeId' value='$row->TypeId'/>
                                                                                <input type='hidden' name='ProjectCurrency' id='ProjectCurrency' value='$row->ProjectCurrency'/>
                                                                                <input type='hidden' name='ProjectStart' id='ProjectStart' value='$row->ProjectStart'/>
                                                                                <input type='hidden' name='ProjectDeadline' id='ProjectDeadline' value='$row->ProjectDeadline'/>
                                                                                <input type='hidden' name='ProjectNotes' id='ProjectNotes' value='$row->ProjectNotes'/>
                                                                                <button type='input' name='submit' value='reject-request' class='btn btn-default' ><i class='fa fa-ban'></i> Reject / Cancel</button>
                                                                                <button type='input' name='submit' value='approve-request' class='btn btn-success' ><i class='fa f fa-check-circle-o'></i> Approve</button>
                                                                                <button type='input' name='submit' value='activate-request' class='btn btn-info' ><i class='fa fa-bar-chart-o'></i> Activate Work Order</button>
                                                                               <button type='input' name='submit' value='delete-request' class='btn btn-danger' ><i class='fa fa-times'></i> Delete</button>
                                                                                <button type='button' class='btn pull-right' data-dismiss='modal'> Close</button>
                                                                            </div>
                                                                                <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                                    </form>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    ";
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_ACTIVE_WORK_ORDER_REQUEST_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> <?php echo _STATISTICS_LANG_;?></h3>
                    </div>
                    <div class="panel-body">
                        <div id="container" style="margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <!-- Small boxes (User Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo $data['employeewocount'];?>
                        </h3>
                        <p>
                            <?php echo _ACTIVE_WORK_ORDER_LANG_; ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a class="small-box-footer">
                         <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php echo $data['mailcount'];?>
                        </h3>
                        <p>
                            <?php echo _UNREAD_MESSAGE_LANG_;?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios7-email-outline"></i>
                    </div>
                    <a href="<?php echo DIR;?>admin/mail" class="small-box-footer">
                        <?php echo _MORE_INFO_LANG_;?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <hr />
        <div class="row">
            <div class="col-lg-12"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _EMPLOYEE_WO_TITLE_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_employee_active_work_order']){ ?>
                                <table id="all-workorders" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#WO</center></th>
                                            <th>Work Order Type <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Client <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Progress</th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th><center>Currency</center></th>
                                            <th><center>Role</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_employee_active_work_order'] as $row) 
                                            {

                                                $now = date('d-m-Y');
                                                $deadline = $row->ProjectDeadline;
                                                $diff = strtotime($deadline) - strtotime($now);
                                                $days = floor($diff/(60*60*24));
                                                if ($days < 0) {
                                                    $ProjectDeadline = "<span class='badge bg-red'>Deadline Reached</span>";
                                                } elseif ($days == 1 OR $days == 0) {
                                                    $ProjectDeadline = "<span class='badge bg-yellow'>1 Day to Deadline</span>";
                                                } else { 
                                                    $ProjectDeadline = "<span class='badge bg-green'>$row->ProjectDeadline</span>";
                                                } 

                                                if ($row->IsComplete == 0) {
                                                    $statusLabel = "<span style='background-color:$row->PhaseColor;' class='badge'>$row->PhaseName</span>";
                                                } else {
                                                    $statusLabel = "<span class='badge bg-green'>Completed</span>";
                                                }

                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><span class='badge bg-blue'>".WO_CODE."$row->IdProject</span></center></td>
                                                        <td><b>[$row->TypeCode]</b> $row->TypeTitle</td>
                                                        <td><a href='".DIR."admin/client/view/$row->IdClient'>$row->ClientName</td>
                                                        <td>
                                                            <center>
                                                                $statusLabel
                                                            </center>
                                                        </td>
                                                        <td><span class='badge bg-green'>$row->ProjectStart</span></td>
                                                        <td>$ProjectDeadline</td>
                                                        <td>
                                                        <center>
                                                            $row->CurrencyName
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            <span class='badge'>$row->RoleName</span>
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/project/view/".$row->IdProject."'>View</a></center></td>
                                                    </tr>
                                                ";
                                                $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_ACTIVE_WORK_ORDER_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
        </div>
        <?php } ?>
        

    </section><!-- /.content -->


