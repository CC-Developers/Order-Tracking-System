<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/project/view.php
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
            <?php if(Session::get(Level) != '3') { ?>
                <li ><a href='<?php echo DIR;?>admin/project'><i class="fa fa-bar-chart-o"></i> <?php echo _ALL_PROJECT_LANG_; ?></a></li>
            <?php } ?>
            <li class="active"><?php echo _OVERVIEW_PROJECT_LANG_; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
            <?php if(Session::get(Level) != '3') { ?>
                <a class="btn btn-info" href='<?php echo DIR;?>admin/project' ><i class="fa fa-bar-chart-o"></i>  <?php echo _ALL_PROJECT_LANG_; ?></a>
            <?php } ?>
            </div>
        </div>
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
        <?php if ($data['isArchived'] == '1') {
            echo "<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                         <b>"._ALERT_LANG_."</b>  "._DATE_ARCHIVE_PROJECT_LANG_." ".$data['narchiveDate']."
                                    </div>";
        }
        ?>
        <?php
                if(Session::get(successUpdatedProject) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_PROJECT_LANG_."
                                </div>";
                    Session::pull(successUpdatedProject);
                }
        ?>
        <?php
                if(Session::get(successArchivedProject) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ARCHIVE_PROJECT_LANG_."
                                </div>";
                    Session::pull(successArchivedProject);
                }
        ?>
        <?php
                if(Session::get(successUnarchivedProject) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UNARCHIVE_PROJECT_LANG_."
                                </div>";
                    Session::pull(successUnarchivedProject);
                }
        ?>
        <?php
                if(Session::get(successAddTask) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_TASK_LANG_."
                                </div>";
                    Session::pull(successAddTask);
                }
        ?>
        <?php
                if(Session::get(successUpdateTask) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_TASK_LANG_."
                                </div>";
                    Session::pull(successUpdateTask);
                }
        ?>
        <?php
                if(Session::get(successDeleteTask) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_TASK_LANG_."
                                </div>";
                    Session::pull(successDeleteTask);
                }
        ?>
        <?php
                if(Session::get(successAddSchedule) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_SCHEDULE_LANG_."
                                </div>";
                    Session::pull(successAddSchedule);
                }
        ?>
        <?php
                if(Session::get(successUpdateSchedule) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_SCHEDULE_LANG_."
                                </div>";
                    Session::pull(successUpdateSchedule);
                }
        ?>
        <?php
                if(Session::get(successDeleteSchedule) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_SCHEDULE_LANG_."
                                </div>";
                    Session::pull(successDeleteSchedule);
                }
        ?>
        <?php
                if(Session::get(successAddMember) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_MEMBER_LANG_."
                                </div>";
                    Session::pull(successAddMember);
                }
        ?>
        <?php
                if(Session::get(successDeleteMember) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_MEMBER_LANG_."
                                </div>";
                    Session::pull(successDeleteMember);
                }
        ?>
        <?php
                if(Session::get(successAddIncome) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_INCOME_LANG_."
                                </div>";
                    Session::pull(successAddIncome);
                }
        ?>
        <?php
                if(Session::get(successUpdateIncome) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_INCOME_LANG_."
                                </div>";
                    Session::pull(successUpdateIncome);
                }
        ?>
        <?php
                if(Session::get(successDeleteIncome) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_INCOME_LANG_."
                                </div>";
                    Session::pull(successDeleteIncome);
                }
        ?>
        <?php
                if(Session::get(successAddExpense) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_EXPENSE_LANG_."
                                </div>";
                    Session::pull(successAddExpense);
                }
        ?>
        <?php
                if(Session::get(successUpdateExpense) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_EXPENSE_LANG_."
                                </div>";
                    Session::pull(successUpdateExpense);
                }
        ?>
        <?php
                if(Session::get(successDeleteExpense) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_EXPENSE_LANG_."
                                </div>";
                    Session::pull(successDeleteExpense);
                }
        ?>
        <?php
                if(Session::get(successAddFolder) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_FOLDER_LANG_."
                                </div>";
                    Session::pull(successAddFolder);
                }
        ?>
        <?php
                if(Session::get(successAddAttachment) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_ATTACHMENT_LANG_."
                                </div>";
                    Session::pull(successAddAttachment);
                }
        ?>
        <?php
                if(Session::get(successUpdateAttachment) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_ATTACHMENT_LANG_."
                                </div>";
                    Session::pull(successUpdateAttachment);
                }
        ?>
        <?php
                if(Session::get(successDeleteAttachment) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_ATTACHMENT_LANG_."
                                </div>";
                    Session::pull(successDeleteAttachment);
                }
        ?>
         <?php
                if(Session::get(successAddInvoice) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_INVOICE_LANG_."
                                </div>";
                    Session::pull(successAddInvoice);
                }
        ?>
        <?php
                            if(Session::get(successDeleteInvoice) == '1') {
                                echo "<div class='alert alert-success alert-dismissable'>
                                                <i class='fa fa-ban'></i>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_INVOICE_LANG_."
                                            </div>";
                                Session::pull(successDeleteInvoice);
                            }
                    ?>
        <?php
            if (Session::get(InvalidProject) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                     <b>"._ERROR_LANG_."</b>, "._INVALID_PROJECT_LANG_."
                                </div>";
                Session::pull(InvalidProject);
            } else if (Session::get(InvalidAccessProject) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <b>"._INVALID_LANG_."</b>, "._CANNOT_ACCESS_PAGE_LANG_."
                                </div>";
                Session::pull(InvalidAccessProject);
            } else {
        ?>
        <div class="row">
            
            <div class="col-lg-8"> 
            
             <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _INFORMATION_PROJECT_LANG_;?> <b><?php echo WO_CODE.$data['IdProject']; ?></b></h3> 
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['membercount'];?>
                                    </h3>
                                    <p>
                                        <?php echo _MEMBER_PROJECT_LANG_;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a class="small-box-footer">
                                    <i class="ion ion-refreshing"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['invoicecount'];?>
                                    </h3>
                                    <p>
                                        <?php echo _INVOICE_PROJECT_LANG_;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clipboard"></i>
                                </div>
                                <a class="small-box-footer">
                                    <i class="ion ion-refreshing"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['taskcount'];?>
                                    </h3>
                                    <p>
                                        <?php echo _TASK_PROJECT_LANG_;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-check-square-o"></i>
                                </div>
                                <a class="small-box-footer">
                                    <i class="ion ion-refreshing"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>ID#:</td>
                                <td><span class="label label-primary"><?php echo WO_CODE.$data['IdProject']; ?></span></td>
                            </tr>
                            <tr>
                                <td>Work Order Type:</td>
                                <td><?php echo $data['TypeTitle']; ?> - <b><?php echo $data['TypeCode']; ?></b></td>
                            </tr>
                            <tr>
                                <td>Client:</td>
                                <td><a href="<?php echo DIR;?>admin/client/view/<?php echo $data['IdClient'];?>"><b><?php echo $data['ClientName']; ?></b></a></td>
                            </tr>
                            <tr>
                                <td>Started:</td>
                                <td><span class="badge bg-green"><?php echo $data['nProjectStart']; ?></span></td>
                            </tr>
                            <tr>
                                <td>Deadline:</td>
                                <td>
                                    <?php
                                        $now = date('d-m-Y');
                                        $deadline = $data['ProjectDeadline'];
                                        $diff = strtotime($deadline) - strtotime($now);
                                        $days = floor($diff/(60*60*24));
                                        if ($days < 0) {
                                            echo "<span class='badge bg-red'>Deadline Reached</span>";
                                        } elseif ($days == 1 OR $days == 0) {
                                            echo "<span class='badge bg-yellow'>1 Day to Deadline</span>";
                                        } else { 
                                            echo "<span class='badge bg-info'>$data[nProjectDeadline]</span>";
                                        } 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>
                                    <?php
                                        if ($data['IsComplete'] == 0) {
                                            echo "<span style='background-color:$data[PhaseColor];' class='badge'>$data[PhaseName]</span>";
                                        } else {
                                            echo "<span class='badge bg-green'>Completed</span>";
                                            if ($data['isArchived'] == 1) {
                                                echo "<span class='badge bg-red'>Archived</span>";
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php if ($data['taskcount'] > 0) { ?>
                            <tr>
                                <td>Task Progress:</td>
                                <td>
                                    <div class="progress xs">
                                        <div class="progress-bar" style="background-color:<?php echo $data['PhaseColor']; ?>; width: <?php echo $data['TaskProgress']/$data['taskcount']; ?>%" role="progressbar" aria-valuenow="<?php echo $data['TaskProgress']/$data['taskcount']; ?>" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <center><?php echo $data['TaskProgress']/$data['taskcount'];?>%</center>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td>Work Order Currency:</td>
                                <td><b><?php echo $data['CurrencyName']; ?> [<?php echo $data['CurrencySymbol']; ?>]</b></td>
                            </tr>
                                                                            
                        </tbody>
                    </table>

                    <hr />

                    <div class="box box-solid">
                        <div class="box-header">
                            <h3 class="box-title">Work Order Notes</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <p>
                                <?php echo $data['ProjectNotes']; ?>
                            </p>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->  

                    <div class="row">
                        <?php if ($data['LastUpdateDate'] == '0000-00-00 00:00:00') { ?>
                        <div class="col-xs-12">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="Never Updated" disabled/>
                        </div>
                        <?php } else { ?>
                        <div class="col-xs-6">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="<?php echo $data['nLastUpdateDate']; ?>" disabled/>
                        </div>
                        <div class="col-xs-6">
                            <label>Last Update User</label>
                            <input type="text" name="LastUpdateUser" id="LastUpdateUser" class="form-control" value="<?php echo $data['LastUpdateUser']; ?>" disabled/>
                        </div>
                        <?php } ?>

                        <div class="col-xs-6">
                            <label>Created Date</label>
                            <input type="text" name="CreatedDate" id="CreatedDate" class="form-control" value="<?php echo $data['nCreatedDate']; ?>" disabled/>
                        </div>
                       <div class="col-xs-6">
                            <label>Created User</label>
                            <input type="text" name="CreatedUser" id="CreatedUser" class="form-control" value="<?php echo $data['AdminName']; ?>" disabled/>
                        </div>
                        <?php if ($data['isArchived'] == '1') { ?>
                        <div class="col-xs-12">
                                <label>Archive Date</label>
                                <input type="text" name="archiveDate" id="archiveDate" class="form-control" value="<?php echo $data['narchiveDate']; ?>" disabled/>
                            </div>
                        <?php } ?>
                    </div>

                        <?php if ($data['GeneralEdit'] == 1 || Session::get('Level') != 3) { ?>

                        <hr />

                        <div class="row">
                            <div class="col-xs-12">
                                <a class='btn btn-block btn-primary' data-toggle='modal' data-target='#update-wo'>Update Work Order</a>
                            </div>
                        </div>

                        <?php } ?>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>

        <div class="col-lg-4">
                <?php if ($data['TaskView'] == 1 || Session::get('Level') != 3) { ?>
                <div class="box box-danger">
                    <div class="box-header">
                        <i class="fa fa-check-square-o"></i>
                        <h3 class="box-title"><?php echo _WORK_ORDER_TASK_LANG_;?></h3>
                        <button class="btn btn-danger pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-top: 5px; margin-right:5px;"><i class="fa fa-minus"></i></button>
                        <?php if ($data['TaskCreate'] == 1 || Session::get('Level') != 3) { ?>
                        <div class="box-tools pull-right" data-toggle="tooltip" title="<?php echo _WORK_ORDER_TASK_LANG_;?>">
                            <a class="btn btn-danger pull-right" data-toggle='modal' data-target='#add-wo-task'><i class="fa fa-plus"></i></a>
                        </div>
                        <?php } ?>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            <?php if ($data['get_wo_task_project']){ ?>
                                <?php
                                        foreach ($data['get_wo_task_project'] as $row) 
                                        {
                                            $now = date('d-m-Y');
                                            $deadline = $row->TaskDueDate;
                                            $diff = strtotime($deadline) - strtotime($now);
                                            $days = floor($diff/(60*60*24));
                                            if ($days < 0) {
                                                $TaskDueDate =  "<span class='badge bg-red'>Deadline Reached</span>";
                                            } else {
                                                $TaskDueDate =  "";
                                            }

                                            if ($data['TaskEdit'] == 1 || Session::get('Level') != 3) { 
                                                $TaskEdit = "<a href='' data-toggle='modal' data-target='#update-wo-task$row->IdTask'><i class='fa fa-pencil'></i>  </a>";
                                            } else {
                                                $TaskEdit = "";
                                            }

                                            if ($row->TaskProgress == 100) {
                                                $taskWO = "
                                                        <a data-toggle='tooltip' title='$row->TaskNotes'><strike>$row->TaskDesc</strike> </a> $TaskEdit
                                                        <small class='pull-right'><span class='badge bg-green'>Finish</span></small>
                                                        <div class='progress xs'>
                                                            <div class='progress-bar progress-bar-green' style='width: 100%' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>
                                                            </div>
                                                        </div>
                                                        ";
                                                        if ($data['TaskDelete'] == 1 || Session::get('Level') != 3) { 
                                                            $deleteButton   = "<button type='input' name='submit' value='delete-wo-task' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Task</button>";
                                                        }
                                            } else {
                                                $taskWO = "
                                                        <a data-toggle='tooltip' title='$row->TaskNotes'>$row->TaskDesc</a> $TaskEdit
                                                        <small class='pull-right'>$TaskDueDate $row->TaskProgress%</small>
                                                        <div class='progress xs'>
                                                            <div class='progress-bar progress-bar-red' style='width: $row->TaskProgress%' role='progressbar' aria-valuenow='$row->TaskProgress' aria-valuemin='0' aria-valuemax='100'>
                                                            </div>
                                                        </div>
                                                        ";
                                                $deleteButton = ""; 
                                            }

                                            if ($row->LastUpdateDate == '0000-00-00 00:00:00') {
                                                $LastUpdateDate = "";
                                            } else {
                                                $LastUpdateDate = "<div class='form-group'>
                                                                        <label>Last Update</label>
                                                                        <input type='text' class='form-control' value='$row->nLastUpdateDate By $row->LastUpdateUser' disabled/>
                                                                    </div>";
                                            }


                                            echo 
                                            "
                                                <li> 
                                                    $taskWO
                                            </li>
                                            ";

                                            echo 
                                            "
                                            <div class='modal fade' id='update-wo-task$row->IdTask' tabindex='-1' role='dialog' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                            <h4 class='modal-title'><i class='fa fa-check-square-o'></i> "._UPDATE_WORK_ORDER_TASK_LANG_."</h4>
                                                        </div>
                                                        <form role='form' method='post' action=''>
                                                            <div class='modal-body'>
                                                                    <div class='form-group'>
                                                                        <label>Task Title</label>
                                                                        <input type='text' name='TaskDesc' id='TaskDesc' class='form-control' placeholder='Enter ...' value='$row->TaskDesc'/>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Task Start</label>
                                                                        <input type='text' name='TaskDate' id='TaskDate' class='datepicker form-control' placeholder='Enter ...'' value='$row->TaskDate'/>
                                                                    </div>
                                                                     <div class='form-group'>
                                                                        <label>Task Deadline</label>
                                                                        <input type='text' name='TaskDueDate' id='TaskDueDate' class='datepicker form-control' placeholder='Enter ...' value='$row->TaskDueDate'/>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Task Progress : $row->TaskProgress%</label>
                                                                        <input type='text' name='TaskProgress' id='TaskProgress' class='slider form-control' value='$row->TaskProgress'  data-slider-min='0' data-slider-max='100' data-slider-step='10' data-slider-value='[$row->TaskProgress]' data-slider-orientation='horizontal'  data-slider-id='red'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Task Notes</label>
                                                                        <textarea name='TaskNotes' id='TaskNotes' class='form-control' rows='3' placeholder='Enter ...'>$row->TaskNotes</textarea>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Created Date</label>
                                                                        <input type='text' class='form-control' value='$row->CreatedDate By $row->CreatedName' disabled/>
                                                                    </div>
                                                                    $LastUpdateDate
                                                            </div>
                                                                    <div class='box-footer'>
                                                                        <input type='hidden' name='IdTask' id='IdTask' value='$row->IdTask'/>
                                                                        <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                        <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                        <button type='input' name='submit' value='update-wo-task' class='btn btn-warning'><i class='fa fa-check-square-o'></i> Update Task</button>
                                                                        <button type='button' class='btn pull-right' data-dismiss='modal'> Close</button>
                                                                        $deleteButton
                                                                    </div>
                                                                <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                            </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            ";
                                        } 
                                    ?>
                            
                             <?php } else { ?>
                                <hr />
                                <center><span class='badge bg-red'>There is currently no Task Data !</span></center>
                                <br />
                            <?php } ?>
                        </ul>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->

                <?php } ?>

                <?php if ($data['ScheduleView'] == 1 || Session::get('Level') != 3) { ?>
                <div class="box">
                    <div class="box-header">
                        <i class="fa fa-calendar-o"></i>
                        <h3 class="box-title"><?php echo _WORK_ORDER_SCHEDULE_LANG_;?></h3>
                        <button class="btn btn-default pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-top: 5px; margin-right:5px;"><i class="fa fa-minus"></i></button>
                        <?php if ($data['ScheduleCreate'] == 1 || Session::get('Level') != 3) { ?>
                        <div class="box-tools pull-right" data-toggle="tooltip" title="<?php echo _WORK_ORDER_SCHEDULE_LANG_;?>">
                            <a class="btn btn-default pull-right" data-toggle='modal' data-target='#add-wo-schedule'><i class="fa fa-plus"></i></a>
                        </div>
                        <?php } ?>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            <?php if ($data['get_wo_schedule_project']){ ?>
                                <?php
                                        foreach ($data['get_wo_schedule_project'] as $row) 
                                        {
                                            $now = date('d-m-Y');
                                            $deadline = $row->ScheduleDueDate;
                                            $diff = strtotime($deadline) - strtotime($now);
                                            $days = floor($diff/(60*60*24));
                                            if ($days < 0) {
                                                $ScheduleDueDate =  "<span class='badge bg-red'>Deadline Reached</span>";
                                            } else {
                                                $ScheduleDueDate =  "";
                                            }

                                            if ($data['ScheduleEdit'] == 1 || Session::get('Level') != 3) { 
                                                $ScheduleEdit = "<a href='' data-toggle='modal' data-target='#update-wo-schedule$row->IdSchedule'><i class='fa fa-pencil'></i>  </a>";
                                            } else {
                                                $ScheduleEdit = "";
                                            }

                                            if ($row->IsFinish == 1) {
                                                $scheduleWO = "
                                                        <a data-toggle='tooltip' title='$row->nScheduleDueDate'><strike>$row->ScheduleDesc</strike> <span class='badge bg-green'>Finish</span></a>  
                                                        <small class='pull-right'>$ScheduleEdit</small>
                                                        <hr />
                                                        <div class='xs'>
                                                            <small class='pull-right'><span class='badge bg-primary'>$row->ScheduleTimeStart</span> - <span class='badge bg-primary'>$row->ScheduleTimeEnd</span></small>
                                                            <br />
                                                            $row->ScheduleNotes
                                                        </div>
                                                        ";
                                                        if ($data['ScheduleDelete'] == 1 || Session::get('Level') != 3) { 
                                                            $deleteScheduleButton   = "<button type='input' name='submit' value='delete-wo-schedule' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Schedule</button>";
                                                        }
                                            } else {
                                                $scheduleWO = "
                                                        <a data-toggle='tooltip' title='$row->nScheduleDueDate'>$row->ScheduleDesc</a>  $ScheduleDueDate
                                                        <small class='pull-right'>$ScheduleEdit</small>
                                                        <hr />
                                                         <div class='xs'>
                                                            <small class='pull-right'><span class='badge bg-primary'>$row->ScheduleTimeStart</span> - <span class='badge bg-primary'>$row->ScheduleTimeEnd</span></small>
                                                            <br />
                                                            $row->ScheduleNotes
                                                        </div>
                                                        ";
                                                $deleteScheduleButton = ""; 
                                            }

                                            if ($row->LastUpdateDate == '0000-00-00 00:00:00') {
                                                $LastUpdateDate = "";
                                            } else {
                                                $LastUpdateDate = "<div class='form-group'>
                                                                        <label>Last Update</label>
                                                                        <input type='text' class='form-control' value='$row->nLastUpdateDate By $row->LastUpdateUser' disabled/>
                                                                    </div>";
                                            }

                                            if ($row->IsFinish == '1') {
                                                $IsFinish = "checked";
                                            } else {
                                                $IsFinish = "";
                                            }

                                            echo 
                                            "
                                                <li> 
                                                    $scheduleWO
                                            </li>
                                            ";

                                            echo 
                                            "
                                            <div class='modal fade' id='update-wo-schedule$row->IdSchedule' tabindex='-1' role='dialog' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                            <h4 class='modal-title'><i class='fa fa-calendar-o'></i> "._UPDATE_WORK_ORDER_SCHEDULE_LANG_."</h4>
                                                        </div>
                                                        <form role='form' method='post' action=''>
                                                            <div class='modal-body'>
                                                                    <div class='form-group'>
                                                                        <label>Schedule Description</label>
                                                                        <input type='text' name='ScheduleDesc' id='ScheduleDesc' class='form-control' placeholder='Enter ...' value='$row->ScheduleDesc'/>
                                                                    </div>
                                                                    <div class='bootstrap-timepicker'>
                                                                        <div class='form-group'>
                                                                            <label>Schedule Time Start:</label>
                                                                            <div class='input-group'>                                            
                                                                                <input type='text' name='ScheduleTimeStart' id='ScheduleTimeStart' class='timepicker form-control' placeholder='Enter ...'' value='$row->ScheduleTimeStart'/>
                                                                                <div class='input-group-addon'>
                                                                                    <i class='fa fa-clock-o'></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                     <div class='bootstrap-timepicker'>
                                                                        <div class='form-group'>
                                                                            <label>Schedule Time End:</label>
                                                                            <div class='input-group'>                                            
                                                                                <input type='text' name='ScheduleTimeEnd' id='ScheduleTimeEnd' class='timepicker form-control' placeholder='Enter ...'' value='$row->ScheduleTimeEnd'/>
                                                                                <div class='input-group-addon'>
                                                                                    <i class='fa fa-clock-o'></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                     <div class='form-group'>
                                                                        <label>Schedule Due Date</label>
                                                                        <input type='text' name='ScheduleDueDate' id='ScheduleDueDate' class='datepicker form-control' placeholder='Enter ...' value='$row->ScheduleDueDate'/>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Schedule Notes</label>
                                                                        <textarea name='ScheduleNotes' id='ScheduleNotes' class='form-control' rows='3' placeholder='Enter ...'>$row->ScheduleNotes</textarea>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Is Finish ?</label>
                                                                        <input type='checkbox' name='IsFinish' class='form-control' id='IsFinish' value='1' $IsFinish/>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Created Date</label>
                                                                        <input type='text' class='form-control' value='$row->CreatedDate By $row->CreatedName' disabled/>
                                                                    </div>
                                                                    $LastUpdateDate
                                                            </div>
                                                                    <div class='box-footer'>
                                                                        <input type='hidden' name='IdSchedule' id='IdSchedule' value='$row->IdSchedule'/>
                                                                        <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                        <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                        <button type='input' name='submit' value='update-wo-schedule' class='btn btn-warning'><i class='fa fa-check-square-o'></i> Update Schedule</button>
                                                                        <button type='button' class='btn pull-right' data-dismiss='modal'> Close</button>
                                                                        $deleteScheduleButton
                                                                    </div>
                                                                    <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                            </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            ";
                                        } 
                                    ?>
                            
                             <?php } else { ?>
                                <hr />
                                <center><span class='badge bg-red'>There is currently no Schedule Data !</span></center>
                                <br />
                            <?php } ?>
                        </ul>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->

                <?php } ?>

            </div> 

        </div>

        <hr />

            <div class="col-lg-8"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _ALL_WORK_ORDER_MEMBER_LANG_; ?></a></li>
                        <li><a href="#finance" data-toggle="tab"><?php echo _ALL_WORK_ORDER_FINANCE_LANG_; ?></a></li>

                        <li><a href="#attachment" data-toggle="tab"><?php echo _ALL_WORK_ORDER_ATTACHMENT_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                                <?php if ($data['MemberCreate'] == 1 || Session::get('Level') != 3) { ?>
                                    <button class="btn btn-primary" data-toggle='modal' data-target='#add-wo-member'><i class="fa fa-plus"></i> Add Member</button>
                                <?php } ?>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                            <?php if ($data['MemberView'] == 1 || Session::get('Level') != 3) { ?>
                                <?php if ($data['get_wo_member']){ ?>
                                <table id="all-members" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Member Name</center></th>
                                            <th>Role Name <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Role Desc <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_wo_member'] as $row) 
                                            {
                                                if ($row->IdUser != Session::get(IdUser)) { //CAN NOT DELETE SELF ROLE !
                                                    if ($data['MemberDelete'] == 1 || Session::get('Level') != 3) { 
                                                        $deleteMemberButton   = "<button class='btn btn-block btn-danger' data-toggle='modal' data-target='#delete-wo-member".$row->IdMember."'><i class='fa fa-times'></i> Delete</button>";
                                                    } else {
                                                        $deleteMemberButton = "<i class='fa fa-exclamation-triangle'></i>";
                                                    }
                                                } else {
                                                    $deleteMemberButton = "<i class='fa fa-exclamation-triangle'></i>";
                                                }
                                                
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><span class='badge bg-blue'>$row->MemberName</span></center></td>
                                                        <td><b>$row->RoleName</b> $row->TypeTitle</td>
                                                        <td>$row->RoleDesc</td>
                                                        <td>
                                                            <center>

                                                                    $deleteMemberButton

                                                            </center>
                                                        </td>
                                                    </tr>
                                                ";
                                                $no++;

                                                echo 
                                                    "
                                                    <div class='modal fade' id='delete-wo-member$row->IdMember' tabindex='-1' role='dialog' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                    <h4 class='modal-title'><i class='fa fa-group'></i> Are you sure want to "._DELETE_WORK_ORDER_MEMBER_LANG_." ?</h4>
                                                                </div>
                                                                <form role='form' method='post' action=''>
                                                                    <div class='modal-body'>
                                                                            <div class='form-group'>
                                                                                <label>Member Name</label>
                                                                                <input type='text' name='IdUser' id='IdUser' class='form-control' placeholder='Enter ...' value='$row->MemberName' disabled/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Member Role</label>
                                                                                <input type='text' name='RoleId' id='RoleId' class='form-control' placeholder='Enter ...' value='$row->RoleName' disabled/>
                                                                            </div>
                                                                            <div class='box-footer'>
                                                                                <input type='hidden' name='IdMember' id='IdMember' value='$row->IdMember'/>
                                                                                <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                                <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                               <button type='input' name='submit' value='delete-wo-member' class='btn btn-danger' ><i class='fa fa-ban'></i> Yes, Delete Member</button>
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
                                            <hr />
                                            <span class='badge bg-red'>There is currently no Work Order Members !</span>
                                        <?php } ?>
                            <?php } ?>
                            </div><!-- /.box-body -->                            

                        </div><!-- /.tab-pane -->
                       
                        <div class="tab-pane" id="finance">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                                     <?php if ($data['FinanceCreate'] == 1 || Session::get('Level') != 3) { ?>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-double-down"></i> Add Finance</button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" data-toggle='modal' data-target='#add-wo-income'>Income</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" data-toggle='modal' data-target='#add-wo-expense'>Expense</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    <?php } ?>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                            <?php if ($data['FinanceView'] == 1 || Session::get('Level') != 3) { ?>
                                <?php if ($data['get_wo_finance']){ ?>
                                <table id="all-finances" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Finance Date</center></th>
                                            <th><center>Income</center></th>
                                            <th><center>Expense</center></th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_wo_finance'] as $row) 
                                            {
                                                $finance   = number_format($row->FinanceAmount, 2);

                                                if($row->FinanceType == 'Income') {
                                                    if($row->FinanceAmount) {
                                                        $income =  "<span class='badge bg-green'>$data[CurrencySymbol] $finance</span>";
                                                        $expense =  "<i class='fa fa-ellipsis-h'></i>";
                                                        $modal = "income";
                                                    }
                                                } else {
                                                    if($row->FinanceAmount) {
                                                        $expense =  "<span class='badge bg-red'>$data[CurrencySymbol] $finance</span>";
                                                        $income =  "<i class='fa fa-ellipsis-h'></i>";
                                                        $modal = "expense";
                                                    }
                                                }

                                                if ($row->LastUpdateDate == '0000-00-00 00:00:00') {
                                                    $LastUpdateDate = "";
                                                } else {
                                                    $LastUpdateDate = "<div class='form-group'>
                                                                            <label>Last Update</label>
                                                                            <input type='text' class='form-control' value='$row->nLastUpdateDate By $row->LastUpdateUser' disabled/>
                                                                        </div>";
                                                }
                                                if ($data['FinanceEdit'] == 1 || Session::get('Level') != 3) { 
                                                    $updateFinanceButton   = "<button class='btn btn-block btn-warning' data-toggle='modal' data-target='#update-wo-$modal".$row->IdFinance."'><i class='fa fa-pencil'></i></button>";
                                                } else {
                                                    $updateFinanceButton = "<i class='fa fa-exclamation-triangle'></i>";
                                                }
                                                if ($data['FinanceDelete'] == 1 || Session::get('Level') != 3) { 
                                                    $deleteIncomeButton   = "<button type='input' name='submit' value='delete-wo-income' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Income</button>";
                                                    $deleteExpenseButton   = "<button type='input' name='submit' value='delete-wo-expense' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Expense</button>";
                                                }
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><span class='badge bg-blue'>$row->nFinanceDate</span></center></td>
                                                        <td><center>$income</center></td>
                                                        <td><center>$expense</center></td>
                                                        <td>$row->FinanceTitle</td>
                                                        <td>$row->FinanceDesc</td>

                                                        <td>
                                                            <center>

                                                                    $updateFinanceButton

                                                            </center>
                                                        </td>
                                                    </tr>
                                                ";
                                                $no++;

                                                echo 
                                                "
                                                <div id='row'>
                                                <div class='modal fade' id='update-wo-income$row->IdFinance' tabindex='-1' role='dialog' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                <h4 class='modal-title'><i class='fa fa-check-square-o'></i> "._UPDATE_WORK_ORDER_INCOME_LANG_."</h4>
                                                            </div>
                                                            <form role='form' method='post' action=''>
                                                                <div class='modal-body'>
                                                                        <div class='form-group'>
                                                                            <label>Income Date</label>
                                                                            <input type='text' name='FinanceDate' id='FinanceDate' class='datepicker form-control' placeholder='Enter ...' value='$row->FinanceDate'/>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>Income Title</label>
                                                                            <input type='text' name='FinanceTitle' id='FinanceTitle' class='form-control' placeholder='Enter ...'' value='$row->FinanceTitle'/>
                                                                        </div>
                                                                         <div class='form-group'>
                                                                            <label>Income Description</label>
                                                                            <input type='text' name='FinanceDesc' id='FinanceDesc' class='form-control' placeholder='Enter ...'' value='$row->FinanceDesc'/>
                                                                        </div>
                                                                        <label>Income Amount</label>
                                                                        <div class='input-group'>
                                                                            <span class='input-group-addon'>$data[CurrencySymbol]</span>
                                                                            <input type='text' name='FinanceAmount' id='FinanceAmount' class='form-control' placeholder='Enter Amount ...'' value='$row->FinanceAmount'>
                                                                            <span class='input-group-addon'>.00</span>
                                                                        </div>
                                                                        <hr />
                                                                        <div class='form-group'>
                                                                            <label>Income Notes</label>
                                                                            <textarea name='FinanceNotes' id='FinanceNotes' class='form-control' rows='3' placeholder='Enter ...'>$row->FinanceNotes</textarea>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>Created Date</label>
                                                                            <input type='text' class='form-control' value='$row->CreatedDate By $row->CreatedName' disabled/>
                                                                        </div>
                                                                        $LastUpdateDate
                                                                        <div class='box-footer'>
                                                                            <input type='hidden' name='IdFinance' id='IdFinance' value='$row->IdFinance'/>
                                                                            <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                            <button type='input' name='submit' value='update-wo-income' class='btn btn-warning'><i class='fa fa-check-square-o'></i> Update Income</button>
                                                                            <button type='button' class='btn pull-right' data-dismiss='modal'> Close</button>
                                                                            $deleteIncomeButton
                                                                        </div>
                                                                        <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                                </form>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                                </div>
                                                ";

                                                echo 
                                                "
                                                <div id='row'>
                                                <div class='modal fade' id='update-wo-expense$row->IdFinance' tabindex='-1' role='dialog' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                <h4 class='modal-title'><i class='fa fa-check-square-o'></i> "._UPDATE_WORK_ORDER_EXPENSE_LANG_."</h4>
                                                            </div>
                                                            <form role='form' method='post' action=''>
                                                                <div class='modal-body'>
                                                                        <div class='form-group'>
                                                                            <label>Expense Date</label>
                                                                            <input type='text' name='FinanceDate' id='FinanceDate' class='datepicker form-control' placeholder='Enter ...' value='$row->FinanceDate'/>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>Expense Title</label>
                                                                            <input type='text' name='FinanceTitle' id='FinanceTitle' class='form-control' placeholder='Enter ...'' value='$row->FinanceTitle'/>
                                                                        </div>
                                                                         <div class='form-group'>
                                                                            <label>Expense Description</label>
                                                                            <input type='text' name='FinanceDesc' id='FinanceDesc' class='form-control' placeholder='Enter ...'' value='$row->FinanceDesc'/>
                                                                        </div>
                                                                        <label>Expense Amount</label>
                                                                        <div class='input-group'>
                                                                            <span class='input-group-addon'>$data[CurrencySymbol]</span>
                                                                            <input type='text' name='FinanceAmount' id='FinanceAmount' class='form-control' placeholder='Enter Amount ...'' value='$row->FinanceAmount'>
                                                                            <span class='input-group-addon'>.00</span>
                                                                        </div>
                                                                        <hr />
                                                                        <div class='form-group'>
                                                                            <label>Expense Notes</label>
                                                                            <textarea name='FinanceNotes' id='FinanceNotes' class='form-control' rows='3' placeholder='Enter ...'>$row->FinanceNotes</textarea>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>Created Date</label>
                                                                            <input type='text' class='form-control' value='$row->CreatedDate By $row->CreatedName' disabled/>
                                                                        </div>
                                                                        $LastUpdateDate
                                                                        <div class='box-footer'>
                                                                            <input type='hidden' name='IdFinance' id='IdFinance' value='$row->IdFinance'/>
                                                                            <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                            <button type='input' name='submit' value='update-wo-expense' class='btn btn-warning'><i class='fa fa-check-square-o'></i> Update Expense</button>
                                                                            <button type='button' class='btn' data-dismiss='modal'> Close</button>
                                                                            $deleteExpenseButton
                                                                        </div>
                                                                        <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                                </form>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                                </div>
                                                ";
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <hr />
                                            <span class='badge bg-red'>There is currently no Finance Data !</span>
                                        <?php } ?>
                                    <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="attachment">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                                <?php if ($data['AttachmentCreate'] == 1 || Session::get('Level') != 3) { ?>
                                    <?php if (!is_dir($data['uploadPath'].WO_CODE.$data['IdProject'])) { ?>
                                    <form role="form" method="post" action="">
                                       <button type='input' name='submit' value='add-wo-folder' class='btn btn-primary'><i class="fa fa-plus"></i> Add Folder</button>

                                        <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                                        <form role="form" method="post" action="">
                                    <?php } else { ?>
                                       <button class="btn btn-success" data-toggle='modal' data-target='#add-wo-attachment'><i class="fa fa-plus"></i> Add Attachment</button>
                                    <?php } ?>
                                <?php } ?>
                                
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_wo_attachment']){ ?>
                                <table id="all-attachments" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Title</center></th>
                                            <th><center>Type</center></th>
                                            <th><center>Size</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_wo_attachment'] as $row) 
                                            {
                                                if ($row->AttachmentType == 'Image') {
                                                    $preview = "<a href='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' height='400' width='400'></a>";
                                                } else if ($row->AttachmentType == 'Document') {
                                                    $preview = "<a href='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/document.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Application') {
                                                    $preview = "<a href='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/application.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Video') {
                                                    $preview = "<a href='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/video.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Audio') {
                                                    $preview = "<a href='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/audio.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Database/Spreadsheet') {
                                                    $preview = "<a href='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/database.png' height='128' width='128'></a>";
                                                } else {
                                                    $preview = "<a href='".DIR.$data['uploadPath'].WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/other.png' height='128' width='128'></a>";
                                                }

                                                if ($row->LastUpdateDate == '0000-00-00 00:00:00') {
                                                    $LastUpdateDate = "";
                                                } else {
                                                    $LastUpdateDate = "<div class='form-group'>
                                                                            <label>Last Update</label>
                                                                            <input type='text' class='form-control' value='$row->nLastUpdateDate By $row->LastUpdateUser' disabled/>
                                                                        </div>";
                                                }

                                                if ($data['AttachmentView'] == 1 || Session::get('Level') != 3) {
                                                    $viewAttachmentButton   = "<button class='btn btn-block btn-primary' data-toggle='modal' data-target='#view-wo-attachment".$row->IdAttachment."'><i class='fa fa-search'></i></button>";
                                                }  else {
                                                    $viewAttachmentButton = "<i class='fa fa-exclamation-triangle'></i>";
                                                }

                                                if ($data['AttachmentEdit'] == 1 || Session::get('Level') != 3) { 
                                                    $updateAttachmentButton   = "<button type='input' name='submit' value='update-wo-attachment' class='btn btn-warning' ><i class='fa fa-check-square-o'></i> Update Attachment</button>";
                                                } 

                                                if ($data['AttachmentDelete'] == 1 || Session::get('Level') != 3) { 
                                                    $deleteAttachmentButton   = "<button type='input' name='submit' value='delete-wo-attachment' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Attachment</button>";
                                                }
                                                
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center>$row->AttachmentTitle</center></td>
                                                        <td><center><span class='badge bg-blue'>$row->AttachmentType</span></center></td>
                                                        <td><center><span class='badge bg-green'>$row->AttachmentSize</span></center></td>
                                                        <td>
                                                            <center>
                                                                    $viewAttachmentButton

                                                            </center>
                                                        </td>
                                                    </tr>
                                                ";
                                                $no++;

                                                echo 
                                                "
                                                <div id='row'>
                                                <div class='modal fade' id='view-wo-attachment$row->IdAttachment' tabindex='-1' role='dialog' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                <h4 class='modal-title'><i class='fa fa-download'></i> "._WORK_ORDER_ATTACHMENT_LANG_."</h4>
                                                            </div>
                                                            <form role='form' method='post' action=''>
                                                                <div class='modal-body'>
                                                                        <div class='form-group'>
                                                                            <label>Title</label>
                                                                            <input type='text' name='AttachmentTitle' id='AttachmentTitle' class='form-control' value='$row->AttachmentTitle' disabled/>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>Change Title</label>
                                                                            <input type='text' name='AttachmentTitle' id='AttachmentTitle' class='form-control' placeholder='Leave it blank if not changed' value='$_POST[AttachmentTitle]'/>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>Notes</label>
                                                                            <textarea name='AttachmentNotes' id='AttachmentNotes' class='form-control' rows='3' placeholder='Enter ...'>$row->AttachmentNotes</textarea>
                                                                        </div>
                                                                        <hr />
                                                                        <center><label>Preview</label></center>
                                                                        <div class='form-group'>
                                                                            <center>
                                                                                $preview
                                                                            </center>
                                                                        </div>
                                                                        <hr />
                                                                        <div class='form-group'>
                                                                            <label>Metadata</label>
                                                                            <input type='text' class='form-control' value='$row->AttachmentType - $row->AttachmentSize' disabled/>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>Created Date</label>
                                                                            <input type='text' class='form-control' value='$row->CreatedDate By $row->CreatedName' disabled/>
                                                                        </div>
                                                                        $LastUpdateDate
                                                                        <div class='box-footer'>
                                                                            <input type='hidden' name='IdAttachment' id='IdAttachment' value='$row->IdAttachment'/>
                                                                            <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                            <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                            <input type='hidden' name='AttachmentTitleOld' id='AttachmentTitleOld' value='$row->AttachmentTitle'/>
                                                                            <input type='hidden' name='AttachmentUrl' id='AttachmentUrl' value='$row->AttachmentUrl'/>
                                                                             $updateAttachmentButton
                                                                            <button type='button' class='btn' data-dismiss='modal'> Close</button>
                                                                            $deleteAttachmentButton
                                                                        </div>
                                                                    <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                                </form>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                                </div>
                                                ";
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <hr />
                                            <span class='badge bg-red'>There is currently no Attachment Data !</span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        
                    </div><!-- /.tab-content -->

                </div><!-- nav-tabs-custom --> 

        </div>

        <div class="col-lg-4"> 
            <div class="box box-primary">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">                                        
                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                    </div><!-- /. tools -->

                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">
                        Work Order Invoices
                    </h3>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                    <?php if ($data['InvoiceView'] == 1 || Session::get('Level') != 3) { ?>
                         <?php if ($data['get_wo_invoice']){ ?>
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th><center>Due Date</center></th>
                                    <th><center>Complete ?</center></th>
                                </tr>
                                <?php
                                    $no = 1;
                                    foreach ($data['get_wo_invoice'] as $row) 
                                    {
                                        $now = date('d-m-Y');
                                        $deadline = $row->nInvoiceDueDate;
                                        $diff = strtotime($deadline) - strtotime($now);
                                        $days = floor($diff/(60*60*24));

                                        if ($row->isCompleted != 1) {
                                           if ($days < 0) {
                                            $invoiceDueDate =  "<span class='badge bg-red'>Due Date Reached</span>";
                                            } elseif ($days == 1 OR $days == 0) {
                                                $invoiceDueDate = "<span class='badge bg-yellow'>1 Day to Due Date</span>";
                                            } else { 
                                                $invoiceDueDate = "<span class='badge bg-info'>$row->nInvoiceDueDate</span>";
                                            } 

                                            $Complete = "<i class='fa fa-times'></i>";
                                        } else {
                                             $invoiceDueDate = "<span class='badge bg-info'>$row->nInvoiceDueDate</span>";
                                             $Complete = "<i class='fa fa-check'></i>";
                                        }

                                       
                                        echo 
                                        "
                                            <tr>
                                                <td><b><a href='".DIR."admin/invoice/view/".$row->invoiceId."'>$row->invoiceNumber</a></b></td>
                                                <td><center>$invoiceDueDate</center></td>
                                                <td><center>$Complete</center></td>
                                            </tr>
                                        ";
                                        $no++;
                                    } 
                                ?>
                                <?php echo "</table>"; ?>
                                <?php } else { ?>
                                    <hr />
                                    <center><span class='badge bg-red'>There is currently no Invoice Data !</span></center>
                                    <br />
                                <?php } ?>
                        <?php } ?>
                    </div>
                </div><!-- /.box-body-->
                <div class="box-footer">
                <?php if ($data['InvoiceCreate'] == 1 || Session::get('Level') != 3) { ?>
                    <button class="btn btn-success" data-toggle="modal" data-target="#add-wo-invoice"><i class="fa fa-plus"></i> Add Invoice</button>
                <?php } ?>
                </div>
            </div>
            <!-- /.box -->
        </div>

        <div class="row">
            <!-- UPDATE WO DATA MODAL -->
            <div class="modal fade" id="update-wo" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-bar-chart-o"></i> <?php echo _UPDATE_WORK_ORDER_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                            <div class="modal-body">
                                <?php if ($data['isArchived'] == '1') { ?>
                                    <div class="form-group">
                                        <label>Work Order Start</label>
                                        <input type="text" name="ProjectStart" id="ProjectStart" class="form-control" placeholder="Enter ..." value="<?php echo $data['ProjectStart'];?>" disabled/>
                                    </div>
                                     <div class="form-group">
                                        <label>Work Order Deadline</label>
                                        <input type="text" name="ProjectDeadline" id="ProjectDeadline" class="form-control" placeholder="Enter ..." value="<?php echo $data['ProjectDeadline'];?>" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea name="ProjectNotes" id="ProjectNotes" class="form-control" rows="3" placeholder="Enter ..." disabled><?php echo $data['ProjectNotes'];?></textarea>
                                    </div>
                                    <div class="box-footer">
                                        <!-- ONLY SUPER USER LEVEL ALLOWED -->
                                        <?php if(Session::get(Level) == '1'){ ?>
                                            <button type='input' name='submit' value='unarchive-wo' class='btn btn-info'><i class="fa fa-check"></i> Unarchived Work Order</button>
                                                <button type='input' name='submit' value='x' class='btn btn-danger pull-right' onclick="return confirm('Permanently DELETE the Work Order  <?php echo WO_CODE.$data['IdProject']; ?>? This action is NOT reversible once completed.');"><i class="fa fa-ban"></i> Delete Work Order</button>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label>Work Order Type</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bar-chart-o"></i></span>
                                            <?php if ($data['service_lists']){ ?>
                                            <select name="TypeId" id="TypeId" class="form-control" >
                                                <?php 
                                                    foreach ($data['service_lists'] as $service) 
                                                    { 

                                                        if ($data['TypeId'] == $service->TypeId) {
                                                            echo "<option value='$service->TypeId' selected>[ $service->TypeCode ] - $service->TypeTitle</option>";
                                                        } else {
                                                            echo 
                                                                "<option value=$service->TypeId>[ $service->TypeCode ] - $service->TypeTitle</option>"
                                                            ;
                                                        }  

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
                                                        foreach ($data['currency_lists'] as $currency) { 

                                                            if ($data['ProjectCurrency'] == $currency->CurrencyId) {
                                                                echo "<option value='$currency->CurrencyId' selected>$currency->CurrencySymbol- $currency->CurrencyName</option>";
                                                            } else {
                                                                echo 
                                                                    "<option value=$currency->CurrencyId>$currency->CurrencySymbol- $currency->CurrencyName</option>"
                                                                ;
                                                            }  
           
                                                        } 
                                                    ?>
                                                </select>
                                                <?php } else { ?>
                                                    <select name="ProjectCurrency" id="ProjectCurrency" class="form-control" disabled>
                                                        <option value="" selected><?php echo _NO_CURRENCY_DATA_LANG_;?>
                                                <?php } ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Work Order Phase</label>
                                            <table class='table table-bordered'>
                                                <thead>
                                                    <th width='100%'><center><a style='width:100%; color:white; background-color:<?php echo $data['PhaseColor'];?>;' class='btn btn-flat'><?php echo $data['PhaseName'];?></a></center></th>
                                                </thead>
                                            </table>
                                    </div>
                                     <div class="form-group">
                                        <label>Change Work Order Phase</label>
                                                <?php if ($data['phase_lists']){ ?>
                                                <select name="ProjectStatus" id="ProjectStatus" class="form-control" >
                                                    <option value="++" selected>Select Work Order Phase</option>
                                                    <?php 
                                                        foreach ($data['phase_lists'] as $phase) { 

                                                            if ($data['ProjectStatus'] == $phase->PhaseId) {
                                                                echo "<option value='$phase->PhaseId' selected>$phase->PhaseName</option>";
                                                            } else {
                                                                echo 
                                                                    "<option value='$phase->PhaseId'>$phase->PhaseName</option>";
                                                                ;
                                                            }  
                                                                    
                                                        } 
                                                    ?>
                                                </select>
                                                <?php } else { ?>
                                                    <select name="ProjectStatus" id="ProjectStatus" class="form-control" disabled>
                                                        <option value="" selected><?php echo _NO_PHASE_DATA_LANG_;?></option>
                                                    </select>
                                                <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Work Order Start</label>
                                        <input type="text" name="ProjectStart" id="ProjectStart" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $data['ProjectStart'];?>"/>
                                    </div>
                                     <div class="form-group">
                                        <label>Work Order Deadline</label>
                                        <input type="text" name="ProjectDeadline" id="ProjectDeadline" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $data['ProjectDeadline'];?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea name="ProjectNotes" id="ProjectNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data['ProjectNotes'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Is Complete ?</label>
                                        <?php if ($data['IsComplete'] == '1') { $active = 'selected'; } else { $active = ''; } ?>
                                        <select name='IsComplete' id='IsComplete' class='form-control'>
                                            <option value='0' <?php echo $active; ?>>No</option>
                                            <option value='1' <?php echo $active; ?>>Yes</option>
                                        </select>
                                    </div>
                                    
                                    <div class="box-footer">
                                        <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                        <button type='input' name='submit' value='update-wo' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Work Order</button>

                                        <!-- ONLY SUPER USER LEVEL ALLOWED -->
                                        <?php if(Session::get(Level) == '1'){ ?>
                                            <?php if ($data['IsComplete'] == '1') { ;?>
                                                <button type='input' name='submit' value='archive-wo' class='btn btn-danger pull-right'><i class="fa fa-archive"></i> Archived Work Order</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

        <div class="row">
            <!-- ADD WO TASK DATA MODAL -->
            <div class="modal fade" id="add-wo-task" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-check-square-o"></i> <?php echo _ADD_NEW_WORK_ORDER_TASK_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label>Task Title</label>
                                        <input type="text" name="TaskDesc" id="TaskDesc" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['TaskDesc'];?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Task Start</label>
                                        <input type="text" name="TaskDate" id="TaskDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['TaskDate'];?>"/>
                                    </div>
                                     <div class="form-group">
                                        <label>Task Deadline</label>
                                        <input type="text" name="TaskDueDate" id="TaskDueDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['TaskDueDate'];?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Task Notes</label>
                                        <textarea name="TaskNotes" id="TaskNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['TaskNotes'];?></textarea>
                                    </div>
                                    <div class="box-footer">
                                        <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                        <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                        <button type='input' name='submit' value='add-wo-task' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add New Task</button>
                                    </div>
                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO TASK DATA MODAL -->
        </div>

        <div class="row">
            <!-- ADD WO SCHEDULE DATA MODAL -->
            <div class="modal fade" id="add-wo-schedule" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-calendar-o"></i> <?php echo _ADD_NEW_WORK_ORDER_SCHEDULE_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label>Schedule Description</label>
                                        <input type="text" name="ScheduleDesc" id="ScheduleDesc" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['ScheduleDesc'];?>"/>
                                    </div>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Schedule Time Start:</label>
                                            <div class="input-group">                                            
                                                <input type="text" name="ScheduleTimeStart" id="ScheduleTimeStart" class="form-control timepicker"/>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->
                                    </div>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Schedule Time End:</label>
                                            <div class="input-group">                                            
                                                <input type="text" name="ScheduleTimeEnd" id="ScheduleTimeEnd" class="form-control timepicker"/>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->
                                    </div>
                                     <div class="form-group">
                                        <label>Schedule Due Date</label>
                                        <input type="text" name="ScheduleDueDate" id="ScheduleDueDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['ScheduleDueDate'];?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Schedule Notes</label>
                                        <textarea name="ScheduleNotes" id="ScheduleNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['ScheduleNotes'];?></textarea>
                                    </div>
                                    <div class="box-footer">
                                        <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                        <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                        <button type='input' name='submit' value='add-wo-schedule' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add New Schedule</button>
                                    </div>
                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO SCHEDULE DATA MODAL -->
        </div>

        <div class="row">
            <!-- ADD WO MEMBER DATA MODAL -->
            <div class="modal fade" id="add-wo-member" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-group"></i> <?php echo _ADD_NEW_WORK_ORDER_MEMBER_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label>Member Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bar-chart-o"></i></span>
                                            <?php if ($data['user_lists']){ ?>
                                            <select name="IdUser" id="IdUser" class="form-control" >
                                                <option value="++" selected>Select Work Order Member</option>
                                                <?php 
                                                    foreach ($data['user_lists'] as $user) { 
                                                             
                                                            echo 
                                                                "<option value=$user->IdUser>$user->FullName</option>"
                                                            ;
                                                            
                                                                
                                                       } 
                                                ?>
                                            </select>
                                            <?php } else { ?>
                                                <select name="IdUser" id="IdUser" class="form-control" disabled>
                                                    <option value="" selected><?php echo _NO_USER_DATA_LANG_;?></option>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Member Role</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bar-chart-o"></i></span>
                                            <?php if ($data['role_lists']){ ?>
                                            <select name="RoleId" id="RoleId" class="form-control" >
                                                <option value="++" selected>Select Member Role</option>
                                                <?php 
                                                    foreach ($data['role_lists'] as $role) { 
                                                             
                                                            echo 
                                                                "<option value=$role->RoleId>$role->RoleName</option>"
                                                            ;
                                                            
                                                                
                                                       } 
                                                ?>
                                            </select>
                                            <?php } else { ?>
                                                <select name="RoleId" id="RoleId" class="form-control" disabled>
                                                    <option value="" selected><?php echo _NO_ROLE_DATA_LANG_;?></option>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                        <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                        <button type='input' name='submit' value='add-wo-member' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add New Member</button>
                                    </div>
                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO MEMBER DATA MODAL --> 
        </div>

        <div class="row">
            <!-- ADD WO INCOME DATA MODAL -->
            <div class="modal fade" id="add-wo-income" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-money"></i> <?php echo _ADD_NEW_WORK_ORDER_INCOME_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" name="FinanceDate" id="FinanceDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $$_POST['FinanceDate'];?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="FinanceTitle" id="FinanceTitle" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['FinanceTitle'];?>"/>
                                    </div>
                                     <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="FinanceDesc" id="FinanceDesc" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['FinanceDesc'];?>"/>
                                    </div>
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><?php echo $data['CurrencySymbol']; ?></span>
                                        <input type="text" name="FinanceAmount" id="FinanceAmount" class="form-control" placeholder="Enter Amount ..." value="<?php echo $_POST['FinanceAmount'];?>">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea name="FinanceNotes" id="FinanceNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['FinanceNotes'];?></textarea>
                                    </div>
                                    <div class="box-footer">
                                        <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                        <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                        <button type='input' name='submit' value='add-wo-income' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add New Income</button>
                                    </div>
                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO INCOME DATA MODAL -->
        </div> 

        <div class="row">
            <!-- ADD WO EXPENSE DATA MODAL -->
            <div class="modal fade" id="add-wo-expense" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-money"></i> <?php echo _ADD_NEW_WORK_ORDER_EXPENSE_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                        <div class="modal-body">
                                <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" name="FinanceDate" id="FinanceDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['FinanceDate'];?>"/>
                                    </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="FinanceTitle" id="FinanceTitle" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['FinanceTitle'];?>"/>
                                </div>
                                 <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="FinanceDesc" id="FinanceDesc" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['FinanceDesc'];?>"/>
                                </div>
                                <label>Amount</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><?php echo $data['CurrencySymbol']; ?></span>
                                    <input type="text" name="FinanceAmount" id="FinanceAmount" class="form-control" placeholder="Enter Amount ..." value="<?php echo $_POST['FinanceAmount'];?>">
                                    <span class="input-group-addon">.00</span>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="FinanceNotes" id="FinanceNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['FinanceNotes'];?></textarea>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                    <button type='input' name='submit' value='add-wo-expense' class='btn btn-danger'><i class="fa fa-check-square-o"></i> Add New Expense</button>
                                </div>
                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO EXPENSE DATA MODAL -->
        </div> 

        <div class="row">
            <!-- ADD WO ATTACHMENT DATA MODAL -->
            <div class="modal fade" id="add-wo-attachment" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-folder-open"></i> <?php echo _ADD_NEW_WORK_ORDER_ATTACHMENT_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form enctype="multipart/form-data" role="form" method="post" action="">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="AttachmentTitle" id="AttachmentTitle" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['AttachmentTitle'];?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="AttachmentNotes" id="AttachmentNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['AttachmentNotes'];?></textarea>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label for="exampleInputFile">File</label>
                                    <input type="file" name="file" id="file" value="">
                                    <p class="help-block">Max. Upload Size : <?php echo ini_get('upload_max_filesize');?> | Allowed Files Ext. : <?php echo $data['filesAllowed'];?></p>
                                </div>
                                <hr />
                                <div class="box-footer">
                                    <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                    <button type='input' name='submit' value='add-wo-attachment' class='btn btn-danger'><i class="fa fa-check-square-o"></i> Add New Attachment</button>
                                </div>
                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO ATTACHMENT DATA MODAL -->
        </div> 

        <div class="row">
            <!-- ADD WO INVOICE DATA MODAL -->
            <div class="modal fade" id="add-wo-invoice" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="ion ion-clipboard"></i> <?php echo _ADD_NEW_WORK_ORDER_INVOICE_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label>Invoice Number</label>
                                    <input type="text" name="invoiceNumber" id="invoiceNumber" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['invoiceNumber'];?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Client Reference</label>
                                    <input type="text" name="invoiceClientReference" id="invoiceClientReference" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['invoiceClientReference'];?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Company Reference</label>
                                    <input type="text" name="invoiceCompanyReference" id="invoiceCompanyReference" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['invoiceCompanyReference'];?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Date</label>
                                    <input type="text" name="invoiceDate" id="invoiceDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['invoiceDate'];?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Due Date</label>
                                    <input type="text" name="invoiceDueDate" id="invoiceDueDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['invoiceDueDate'];?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Currency</label>
                                    <input type="text" class="form-control" value="<?php echo $data['CurrencySymbol']; ?> - <?php echo $data['CurrencyName']; ?>" disabled/>
                                </div>
                                <label>Invoice Tax Rate</label>
                                <div class="input-group">
                                    <span class="input-group-addon">TAX</span>
                                    <input type="text" name="invoiceTaxRate" id="invoiceTaxRate" class="form-control" placeholder="Enter Tax Rate ..." value="<?php echo $_POST['invoiceTaxRate'];?>">
                                    <span class="input-group-addon">%</span>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="invoiceNote" id="invoiceNote" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['invoiceNote'];?></textarea>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                    <input type="hidden" name="invoiceCurrency" id="invoiceCurrency" value="<?php echo $data['ProjectCurrency']; ?>"/>
                                    <button type='input' name='submit' value='add-wo-invoice' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add New Invoice</button>
                                </div>
                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO INVOICE DATA MODAL -->
        </div> 
           
        </div>

    <?php } ?> 

    </section><!-- /.content -->


