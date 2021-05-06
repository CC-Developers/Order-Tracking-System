<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/client/dashboard/dashboard.php
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
            <li class="active"><a href='<?php echo DIR;?>'><i class="fa fa-dashboard"></i> <?php echo _DASHBOARD_LANG_;?></a></li>
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

        <hr />

        <?php
            if(isset($error)) {
                foreach ($error as $error) {
                    echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._ALERT_LANG_."</b> $error
                                </div>";
                }
            }
        ?>  

        <?php
            if(Session::get(successAddRequest) == '1') {
                echo "<div class='alert alert-success alert-dismissable'>
                                <i class='fa fa-ban'></i>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_REQUEST_LANG_."
                            </div>";
                Session::pull(successAddRequest);
            }
        ?>   

        <?php
            if(Session::get(successDeleteRequest) == '1') {
                echo "<div class='alert alert-success alert-dismissable'>
                                <i class='fa fa-ban'></i>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_REQUEST_LANG_."
                            </div>";
                Session::pull(successDeleteRequest);
            }
        ?> 
        <!-- Small boxes (User Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-4">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php echo $data['get_client_active_request_count'];?>
                        </h3>
                        <p>
                            <?php echo _ACTIVE_REQUEST_LANG_; ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ticket"></i>
                    </div>
                    <a class="small-box-footer">
                         <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo $data['get_client_active_work_order_count'];?>
                        </h3>
                        <p>
                            <?php echo _ACTIVE_ORDER_LANG_; ?>
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
             <div class="col-lg-4 col-xs-4">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php echo $data['get_invoice_count']; ?>
                        </h3>
                        <p>
                            <?php echo _ACTIVE_INVOICE_LANG_;?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios7-pricetag-outline"></i>
                    </div>
                    <a class="small-box-footer">
                         <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <hr />

        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-block btn-info" data-toggle="modal" data-target="#add-request"><i class="fa fa-ticket"></i> <?php echo _SUBMIT_REQUEST_LANG_;?></a>
            </div>
        </div>
        <hr />

        <div class="row">
            <div class="col-lg-12"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _CLIENT_WO_TITLE_LANG_; ?></a></li>
                        <li ><a href="#invoice" data-toggle="tab"><?php echo _CLIENT_INVOICE_TITLE_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_client_active_work_order']){ ?>
                                <table id="all-workorders" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#WO</center></th>
                                            <th>Work Order Type <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Progress</th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th><center>Currency</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_client_active_work_order'] as $row) 
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
                                                        <td><center><a class='btn btn-primary' href='".DIR."project/view/".$row->IdProject."'>View</a></center></td>
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

                         <div class="tab-pane" id="invoice">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_client_invoice_access']){ ?>
                                <table id="all-invoices" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#Invoice</center></th>
                                            <th><center>#WO</center></th>
                                            <th><center>Due Date</center></th>
                                            <th><center>Currency</center></th>
                                            <th><center>Tax Rate</center></th>
                                            <th><center>Total Paid</center></th>
                                            <th><center>Total Due</center></th>
                                            <th><center>Status</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            $no = 1;
                                            foreach ($data['get_client_invoice_access'] as $row) 
                                            {

                                                $now = date('d-m-Y');
                                                $deadline = $row->nInvoiceDueDate;
                                                $diff = strtotime($deadline) - strtotime($now);
                                                $days = floor($diff/(60*60*24));
                                                if ($days < 0) {
                                                    $invoiceDueDate =  "<span class='badge bg-red'>Due Date Reached</span>";
                                                } elseif ($days == 1 OR $days == 0) {
                                                    $invoiceDueDate = "<span class='badge bg-yellow'>1 Day to Due Date</span>";
                                                } else { 
                                                    $invoiceDueDate = "<span class='badge bg-info'>$row->nInvoiceDueDate</span>";
                                                } 

                                                if($row->invoiceStatus == 1) {
                                                    $invoiceStatus =  "<span class='badge bg-green'>sent to email !</span>";
                                                } else {
                                                    $invoiceStatus =  "<span class='badge bg-red'>not sent !</span>";
                                                }


                                                $paid   = number_format($row->invoiceTotalPaid, 2);
                                                if($row->invoiceTotalPaid == 0) {
                                                    $invoiceTotalPaid =  "<span class='badge bg-red'>Not Paid</span>";
                                                } else {
                                                    $invoiceTotalPaid =  "<span class='badge bg-green'>$row->CurrencySymbol $paid</span>";
                                                }

                                                $due    = number_format($row->invoiceTotalDue, 2);
                                                if($row->invoiceTotalDue == 0) {
                                                    $invoiceTotalDue =  "<i class='fa fa-ellipsis-h'></i>";
                                                } else {
                                                    $invoiceTotalDue = "<span class='badge bg-info'>$row->CurrencySymbol $due</span>";
                                                }

                                                
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><a href='".DIR."invoice/view/".$row->invoiceId."'>$row->invoiceNumber</a></center></td>
                                                        <td><center><span class='badge bg-blue'>".WO_CODE."$row->IdProject</span></center></td>
                                                        <td>$invoiceDueDate</td>
                                                        <td>
                                                        <center>
                                                            $row->CurrencyName
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            $row->invoiceTaxRate%
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            $invoiceTotalPaid
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            $invoiceTotalDue
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            $invoiceStatus
                                                        </center>
                                                        </td>
                                                    </tr>
                                                ";
                                                $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_INVOICE_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
        </div>
        </div>

        <div class="row">
            <div class="col-lg-12"> 
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _CLIENT_REQUEST_TITLE_LANG_; ?></a></li>
                      
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
                                                    $action = "<a href='' data-toggle='modal' data-target='#delete-request$row->IdRequest'><i class='fa fa-times'></i>  </a>";
                                                } else if ($row->RequestStatus == 1) {
                                                     $action = "<a href='' data-toggle='modal' data-target='#delete-request$row->IdRequest'><i class='fa fa-times'></i>  </a>";
                                                } else {
                                                    $action = "<i class='fa fa-ellipsis-h'></i>";
                                                }

                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
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
                                                    <div class='modal fade' id='delete-request$row->IdRequest' tabindex='-1' role='dialog' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                    <h4 class='modal-title'><i class='fa fa-ticket'></i> Are you sure want to delete "._DELETE_WORK_ORDER_REQUEST_LANG_." ?</h4>
                                                                </div>
                                                                <form role='form' method='post' action=''>
                                                                    <div class='modal-body'>
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
                                                                               <button type='input' name='submit' value='delete-request' class='btn btn-danger' ><i class='fa fa-ban'></i> Yes, Delete Request</button>
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
        

    </section><!-- /.content -->

    <div class="row">
        <!-- ADD REQUEST DATA MODAL -->
        <div class="modal fade" id="add-request" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-ticket"></i> <?php echo _REQUEST_ADD_LANG_; ?></h4>
                    </div>
                   <form role="form" method="post" action="">
                            <div class="modal-body">
                                   <div class="form-group">
                                        <label>Work Order Type</label>
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-bar-chart-o"></i></span>
                                                <?php if ($data['service_lists']){ ?>
                                                <select name="TypeId" id="TypeId" class="form-control" >
                                                    <option value="++" selected>Select Work Order Type</option>
                                                    <?php 
                                                        foreach ($data['service_lists'] as $row) { 
                                                                 
                                                                echo 
                                                                    "<option value=$row->TypeId>[ $row->TypeCode ] - $row->TypeTitle</option>"
                                                                ;
                                                                
                                                                    
                                                           } 
                                                    ?>
                                                </select>
                                                <?php } else { ?>
                                                    <select name="TypeId" id="TypeId" class="form-control" disabled>
                                                        <option value="" selected><?php echo _NO_SERVICE_DATA_LANG_;?></option>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Work Order Currency</label>
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                <?php if ($data['currency_lists']){ ?>
                                                <select name="ProjectCurrency" id="ProjectCurrency" class="form-control" >
                                                    <option value="++" selected>Select Work Order Currency</option>
                                                    <?php 
                                                        foreach ($data['currency_lists'] as $row) { 
                                                                 
                                                                echo 
                                                                    "<option value=$row->CurrencyId>$row->CurrencySymbol- $row->CurrencyName</option>"
                                                                ;
                                                                
                                                                    
                                                           } 
                                                    ?>
                                                </select>
                                                <?php } else { ?>
                                                    <select name="ProjectCurrency" id="ProjectCurrency" class="form-control" disabled>
                                                        <option value="" selected><?php echo _NO_CURRENCY_DATA_LANG_;?></option>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Work Order Start</label>
                                        <input type="text" name="ProjectStart" id="ProjectStart" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['ProjectStart'];?>"/>
                                    </div>
                                     <div class="form-group">
                                        <label>Work Order Deadline</label>
                                        <input type="text" name="ProjectDeadline" id="ProjectDeadline" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['ProjectDeadline'];?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea name="ProjectNotes" id="ProjectNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['ProjectNotes'];?></textarea>
                                    </div>
                                    
                                    <div class="box-footer">
                                        <input type="hidden" name="IdClient" id="IdClient" value="<?php echo Session::get(IdClient); ?>"/>
                                        <button type='input' name='submit' value='add-request' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add New Request</button>

                                    </div>
                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                   </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- END REQUEST DATA MODAL -->
    </div>


