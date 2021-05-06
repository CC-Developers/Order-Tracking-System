<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/report/workorder.php
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
    <section class="content-header no-margin">
    <?php if(Session::get(Level) == '3') { ?>
    <br />
    <div class='alert alert-danger alert-dismissable'>
        <i class='fa fa-ban'></i>
        <b><?php echo _INVALID_LANG_;?></b>, <?php echo _CANNOT_ACCESS_PAGE_LANG_;?>
    </div>
    <?php } else { ?>
        <h1>
            <a class="btn btn-default" href='<?php echo DIR;?>admin/report' ><i class="fa fa-bolt"></i>  <?php echo _ALL_REPORT_LANG_;?></a>
            <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> <?php echo _PRINT_LANG_;?></button>
        </h1>
    </section>

    <!-- Main content -->
     <section class="content invoice">                
                    <!-- title row -->
                    <div class="row"> 
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-bar-chart-o"></i> 
                                <?php echo _WORK_ORDER_REPORT_LANG_; ?>
                                <small class="pull-right"><b><?php echo BARTITLE;?></b></small>
                            </h2>                          
                        </div><!-- /.col -->
                    </div>
                    
                    <!-- Table row -->
                    <div class="row">
                    <div class="col-xs-12 table-responsive">
                                <?php if ($data['get_project']){ ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#WO</center></th>
                                            <th>Type</th>
                                            <th>Client</th>
                                            <th><center>Status</center></th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th><center>Currency</center></th>
                                            <th><center>Archived ?</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_project'] as $row) 
                                            {

                                                if ($row->IsComplete == 0) {
                                                    $statusLabel = "<span style='background-color:$row->PhaseColor;' class='badge'>$row->PhaseName</span>";
                                                } else {
                                                    $statusLabel = "<span class='badge bg-green'>Completed</span>";
                                                }

                                                if ($row->isArchived == 0) {
                                                    $IsArchived = "<span class='badge bg-green'>No</span>";
                                                } else {
                                                    $IsArchived = "<span class='badge bg-red'>Yes</span>";
                                                }

                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><span class='badge bg-blue'>".WO_CODE."$row->IdProject</span></center></td>
                                                        <td><b>[$row->TypeCode]</b> $row->TypeTitle</td>
                                                        <td><b>$row->ClientName</b></td>
                                                        <td>
                                                            <center>
                                                                $statusLabel
                                                            </center>
                                                        </td>
                                                        <td>$row->ProjectStart</td>
                                                        <td>$row->ProjectDeadline</td>
                                                        <td>
                                                        <center>
                                                            $row->CurrencyName
                                                        </center>
                                                        </td>
                                                        <td><center>$IsArchived</center></td>
                                                    </tr>
                                                ";
                                                $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <center><span class='badge bg-red'><?php echo _NO_WORK_ORDER_DATA_LANG_;?></span></center>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        
                    </div>

            </section><!-- /.content -->
        <?php } ?>

