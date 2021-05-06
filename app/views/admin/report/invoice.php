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
                                <i class="ion ion-ios7-pricetag-outline"></i>
                                <?php echo _INVOICE_REPORT_LANG_; ?>
                                <small class="pull-right"><b><?php echo BARTITLE;?></b></small>
                            </h2>                          
                        </div><!-- /.col -->
                    </div>
                    
                    <!-- Table row -->
                    <div class="row">
                    <div class="col-xs-12 table-responsive">
                                <?php if ($data['get_wo_invoice']){ ?>
                                <table class="table table-striped">
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
                                            <th><center>Status</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_wo_invoice'] as $row) 
                                            {
                                                if($row->invoiceStatus == 1) {
                                                    $invoiceStatus =  "<span class='badge bg-green'>sent !</span>";
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
                                                } else if(Session::get('newCalculatedInvoice'.$row->invoiceId) == '1') {
                                                    $invoiceTotalDue =  "<i class='fa fa-exclamation-triangle'></i>";
                                                } else {
                                                    $invoiceTotalDue = "<span class='badge bg-info'>$row->CurrencySymbol $due</span>";
                                                }

                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td><center><span class='badge bg-blue'>".WO_CODE."$row->IdProject</span></center></td>
                                                        <td><center><span class='badge'>$row->invoiceNumber</span></center></td>
                                                        <td>$row->nInvoiceDate</td>
                                                        <td>$row->nInvoiceDueDate</td>
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
                                            <center><span class='badge bg-red'><?php echo _NO_INVOICE_DATA_LANG_;?></span></center>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        
                    </div>

            </section><!-- /.content -->
        <?php } ?>

