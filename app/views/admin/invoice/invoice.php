<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/view/admin/invoice/invoice.php
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
        <h1 class="text-center">
            <?php echo _INVOICE_LANG_;?>
        </h1>
    </section>
    <hr />

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) != '3') { ?>      
        
        <div class="row">
            <div class="col-lg-12"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _ALL_INVOICE_LANG_; ?></a></li>
                       
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_invoice']){ ?>
                                <table id="all-invoices" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#WO</center></th>
                                            <th><center>#Invoice</center></th>
                                            <th><center>Invoice Date</center></th>
                                            <th><center>Invoice Due Date</center></th>
                                            <th><center>Currency</center></th>
                                            <th><center>Tax Rate</center></th>
                                            <th><center>Total Paid</center></th>
                                            <th><center>Total Due</center></th>
                                            <th><center>is Generated (PDF) ?</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Complete ?</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_invoice'] as $row) 
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
                                                

                                                if($row->invoiceStatus == 1) {
                                                    $invoiceStatus =  "<span class='badge bg-green'>sent !</span>";
                                                } else {
                                                    $invoiceStatus =  "<span class='badge bg-red'>not sent !</span>";
                                                }

                                                if($row->isGenerated == 1) {
                                                    $isGenerated =  "<span class='badge bg-green'>Yes</span>";
                                                } else {
                                                    $isGenerated =  "<span class='badge bg-red'>No</span>";
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
                                                } else if(Session::get('newCalculatedInvoice'.$row->invoiceId) == '1') {
                                                    $invoiceTotalDue =  "<i class='fa fa-exclamation-triangle'></i>";
                                                } else if(Session::get('needGenerateInvoice'.$row->invoiceId) == '1') {
                                                    $invoiceTotalDue =  "<i class='fa fa-exclamation-triangle'></i>";
                                                } else {
                                                    $invoiceTotalDue = "<span class='badge bg-info'>$row->CurrencySymbol $due</span>";
                                                }

                                                
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><a href='".DIR."admin/project/view/$row->IdProject'><span class='badge bg-blue'>".WO_CODE."$row->IdProject</span></a></center></td>
                                                        <td><center><span class='badge'>$row->invoiceNumber</span></center></td>
                                                        <td><span class='badge bg-green'>$row->nInvoiceDate</span></td>
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
                                                            $isGenerated
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            $invoiceStatus
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            $Complete
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/invoice/view/".$row->invoiceId."'><i class='fa fa-eye'></i></a></center></td>
                                                    </tr>
                                                ";
                                                $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <hr />
                                            <span class='badge bg-red'><?php echo _NO_INVOICE_DATA_LANG_;?></span>
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


