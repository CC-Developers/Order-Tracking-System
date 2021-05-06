<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/project/project.php
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
        <ol class="breadcrumb">
            <li ><a href='<?php echo DIR;?>admin'><i class="fa fa-dashboard"></i> <?php echo _DASHBOARD_LANG_;?></a></li>
            <li class="active"><?php echo _ALL_PROJECT_LANG_; ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) != '3') { ?>
        <div class="row">
            <div class="col-lg-12">
            <?php if(Session::get(Level) != '3') { ?>
                <a class="btn btn-success" href='<?php echo DIR;?>admin/project/add' ><i class="fa fa-plus"></i>  <?php echo _ADD_NEW_PROJECT_LANG_;?></a>
            <?php } ?>
            </div>
        </div>
        <hr />
        <?php
                if(Session::get(successAddProject) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                     <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_PROJECT_LANG_."
                                </div>";
                    Session::pull(successAddProject);
                }
        ?>
        <?php
                if(Session::get(successDeletedProject) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_PROJECT_LANG_."
                                </div>";
                    Session::pull(successDeletedProject);
                }
        ?>
        <div class="row">
            <div class="col-lg-12"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _ALL_ACTIVE_PROJECT_LANG_; ?></a></li>
                        <li><a href="#archived" data-toggle="tab"><?php echo _ALL_ARCHIVE_PROJECT_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_project']){ ?>
                                <table id="all-workorders" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#WO</center></th>
                                            <th>Work Order Type <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Client <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Status</th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th><center>Currency</center></th>
                                            <th><center>Created By</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_project'] as $row) 
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
                                                            <span class='badge'>$row->AdminName</span>
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
                                            <span class='badge bg-red'><?php echo _NO_ACTIVE_PROJECT_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="archived">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_project_archived']){ ?>
                                <table id="archive-workorders" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#WO</center></th>
                                            <th>Work Order Type <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Client <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th><center>Currency</center></th>
                                            <th><center>Archived Date</center></th>
                                            <th><center>Last Updated By</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_project_archived'] as $row) 
                                            {
                                                
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><span class='badge bg-blue'>".WO_CODE."$row->IdProject</span></center></td>
                                                        <td><b>[$row->TypeCode]</b> $row->TypeTitle</td>
                                                        <td><a href='".DIR."admin/client/view/$row->IdClient'>$row->ClientName</td>
                                                        <td>
                                                        <center>
                                                            $row->CurrencyName
                                                        </center>
                                                        </td>
                                                        <td><span class='badge bg-red'>$row->narchiveDate</span></td>
                                                        <td>
                                                        <center>
                                                            <span class='badge'>$row->LastUpdateUser</span>
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
                                            <span class='badge bg-red'><?php echo _NO_ARCHIVE_PROJECT_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
        </div>
    <?php } else { ?>
        <div class='alert alert-danger alert-dismissable'>
            <i class='fa fa-ban'></i>
            <b><?php echo _INVALID_LANG_;?></b>, <?php echo _CANNOT_ACCESS_PAGE_LANG_;?>
        </div>
    <?php } ?>
    </section><!-- /.content -->


