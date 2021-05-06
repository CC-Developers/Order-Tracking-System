<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/client/project/view.php
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
            <li ><a href='<?php echo DIR;?>'><i class="fa fa-dashboard"></i> <?php echo _DASHBOARD_LANG_;?></a></li>
            <li class="active"><?php echo _OVERVIEW_PROJECT_LANG_; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <hr />
        <?php
            if (Session::get(InvalidProject) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                     <b>"._ERROR_LANG_."</b>, "._INVALID_PROJECT_LANG_."
                                </div>";
                Session::pull(InvalidProject);
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
                                <td><b><?php echo $data['ClientName']; ?></b></td>
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
                            <div class="col-xs-12">
                                <a class='btn btn-block btn-danger' data-toggle='modal' data-target='#question'><?php echo _CLIENT_HAVE_QUESTION_LANG_;?></a>
                            </div>
                        </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>

        <div class="col-lg-4">
                <div class="box box-danger">
                    <div class="box-header">
                        <i class="fa fa-check-square-o"></i>
                        <h3 class="box-title"><?php echo _WORK_ORDER_TASK_LANG_;?></h3>
                        <button class="btn btn-danger pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-top: 5px; margin-right:5px;"><i class="fa fa-minus"></i></button>
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

                                            
                                            if ($row->TaskProgress == 100) {
                                                $taskWO = "
                                                        <a data-toggle='tooltip' title='$row->TaskNotes'><strike>$row->TaskDesc</strike> </a> $TaskEdit
                                                        <small class='pull-right'><span class='badge bg-green'>Finish</span></small>
                                                        <div class='progress xs'>
                                                            <div class='progress-bar progress-bar-green' style='width: 100%' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>
                                                            </div>
                                                        </div>
                                                        ";
                                            } else {
                                                $taskWO = "
                                                        <a data-toggle='tooltip' title='$row->TaskNotes'>$row->TaskDesc</a> $TaskEdit
                                                        <small class='pull-right'>$TaskDueDate $row->TaskProgress%</small>
                                                        <div class='progress xs'>
                                                            <div class='progress-bar progress-bar-red' style='width: $row->TaskProgress%' role='progressbar' aria-valuenow='$row->TaskProgress' aria-valuemin='0' aria-valuemax='100'>
                                                            </div>
                                                        </div>
                                                        ";
                                            }

                                           
                                            echo 
                                            "
                                                <li> 
                                                    $taskWO
                                            </li>
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


                <div class="box">
                    <div class="box-header">
                        <i class="fa fa-calendar-o"></i>
                        <h3 class="box-title"><?php echo _WORK_ORDER_SCHEDULE_LANG_;?></h3>
                        <button class="btn btn-default pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-top: 5px; margin-right:5px;"><i class="fa fa-minus"></i></button>
                        
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

            </div> 

        </div>

        <hr />

            <div class="col-lg-8"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _ALL_WORK_ORDER_MEMBER_LANG_; ?></a></li>

                        <li><a href="#attachment" data-toggle="tab"><?php echo _ALL_WORK_ORDER_ATTACHMENT_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                               
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_wo_member']){ ?>
                                <table id="all-members" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Name</center></th>
                                            <th><center>Email</center></th>
                                            <th><center>Phone</center></th>
                                            <th>Role Name <i class="fa fa-sort-alpha-asc"></i></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_wo_member'] as $row) 
                                            {

                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><span class='badge bg-blue'>$row->MemberName</span></center></td>
                                                        <td><center><a href='mailto:$row->MemberEmail'>$row->MemberEmail</a></center></td>
                                                        <td><center>$row->MemberPhone</center></td>
                                                        <td><b>$row->RoleName</b> $row->TypeTitle</td>
                                                    </tr>
                                                ";
                                                $no++;

                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <hr />
                                            <span class='badge bg-red'>There is currently no Work Order Members !</span>
                                        <?php } ?>
                            </div><!-- /.box-body -->                            

                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="attachment">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                               
                                
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
                                                    $preview = "<a href='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' height='400' width='400'></a>";
                                                } else if ($row->AttachmentType == 'Document') {
                                                    $preview = "<a href='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/document.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Application') {
                                                    $preview = "<a href='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/application.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Video') {
                                                    $preview = "<a href='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/video.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Audio') {
                                                    $preview = "<a href='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/audio.png' height='128' width='128'></a>";
                                                } else if ($row->AttachmentType == 'Database/Spreadsheet') {
                                                    $preview = "<a href='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/database.png' height='128' width='128'></a>";
                                                } else {
                                                    $preview = "<a href='".DIR."uploads/projects/".WO_CODE."$row->IdProject/$row->AttachmentUrl' target='_blank'><img src='".DIR."uploads/icons/other.png' height='128' width='128'></a>";
                                                }

                                                

                                                if ($data['AttachmentView'] == 1 || Session::get('Level') != 3) {
                                                    $viewAttachmentButton   = "<button class='btn btn-block btn-primary' data-toggle='modal' data-target='#view-wo-attachment".$row->IdAttachment."'><i class='fa fa-search'></i></button>";
                                                }  else {
                                                    $viewAttachmentButton = "<i class='fa fa-exclamation-triangle'></i>";
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
                                                                            <label>Notes</label>
                                                                            <textarea name='AttachmentNotes' id='AttachmentNotes' class='form-control' rows='3' placeholder='Enter ...' disabled>$row->AttachmentNotes</textarea>
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
                                                                        <div class='box-footer'>
                                                                            <button type='button' class='btn' data-dismiss='modal'> Close</button>
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
                                                <td><b><a href='".DIR."invoice/view/".$row->invoiceId."'>$row->invoiceNumber</a></b></td>
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

                    </div>
                </div><!-- /.box-body-->
                <div class="box-footer">
                
                </div>
            </div>
            <!-- /.box -->
        </div>

    <?php } ?> 

    </section><!-- /.content -->

    <div class="row">
            <!-- AHAVE A QUESTIONS MODAL -->
            <div class="modal fade" id="question" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-comments-o"></i> <?php echo _CLIENT_HAVE_QUESTION_LANG_; ?></h4>
                        </div>
                        <form role="form" method="post" action="">
                            <div class="modal-body">
                                    <p><?php echo _CLIENT_QUESTION_INSTRUCTION_LANG_;?></p>
                                    <div class="box-footer">

                                    </div>
                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END ADD WO TASK DATA MODAL -->
        </div>


