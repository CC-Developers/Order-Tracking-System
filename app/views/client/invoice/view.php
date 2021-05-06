<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/client/invoice/view.php
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
                <?php
                    if (Session::get(InvalidInvoice) == '1') {
                        echo "<div class='pad margin no-print'><div class='alert alert-danger' style='margin-bottom: 0!important;'>
                                            <i class='fa fa-ban'></i>
                                            <b>"._ERROR_LANG_."</b>, "._INVALID_INVOICE_LANG_."
                                        </div></div>";
                        Session::pull(InvalidInvoice);
                    } else {
                ?>              
                <!-- Content Header (Page header) -->
                <section class="content-header no-margin">
                    <h1>
                        Invoice
                        <small><b><?php echo $data['invoiceNumber']; ?></b></small>
                        <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> <?php echo _PRINT_LANG_;?></button>
                    </h1>
                </section>
                <hr />
                <div class="pad margin no-print">

                     <?php if ($data['isSync'] != 1 && $data['isCompleted'] != 1) { ?>
                        <div class="callout callout-danger">
                            <h4><?php echo _NEED_SYNC_LANG_;?></h4>
                            <p><b><?php echo _IMPORTANT_LANG_;?></b> Invoice have new calculation, and currently not <i><u>Sync Invoice Calculation</u></i> by Admin. Please contact Work Order Member !</p>
                        </div>
                    <?php } ?> 
                    
                    <?php if ($data['invoiceStatus'] == 1 && $data['isCompleted'] != 1) { ?>
                        <div class="callout callout-info">
                            <h4><?php echo _NOTIFICATION_LANG_;?></h4>
                            <p><?php echo _SUCCESSFULLY_SENT_INVOICE_LANG_;?></p>
                        </div>
                    <?php } ?> 

                    <?php if ($data['isCompleted'] == 1) { ?>
                        <div class="callout callout-info">
                            <h4><?php echo _PAID_LANG_;?></h4>
                            <p><?php echo _SUCCESSFULLY_PAID_INVOICE_LANG_;?></p>
                        </div>
                    <?php } else { ?> 
                        <div class="callout callout-warning">
                            <h4><?php echo _UNPAID_LANG_;?></h4>
                            <p><?php echo _NOTIFICATION_UNPAID_INVOICE_LANG_;?></p>
                        </div>
                    <?php } ?> 

                </div>
                <!-- Main content -->

                <section class="content invoice">                
                    <!-- title row -->
                    <div class="row"> 
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-home"></i> 
                                <?php echo $data['ownerName']; ?>
                                <small class="pull-right">Invoice Due Date: <b><?php echo $data['nInvoiceDueDate'];?></b></small>
                            </h2>                          
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong><?php echo $data['ownerName']; ?></strong><br>
                                <?php echo $data['ownerAddress']; ?><br/>
                                Phone: <?php echo $data['ownerPhone']; ?><br/>
                                Email: <?php echo $data['ownerEmail']; ?>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong><?php echo $data['ClientName']; ?></strong><br>
                                <?php echo $data['ClientAddress']; ?><br/>
                                Phone: <?php echo $data['ClientPhone']; ?><br/>
                                Email: <?php echo $data['ClientEmail']; ?>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice Number: </b><?php echo $data['invoiceNumber']; ?><br/>
                            <b>Company Reference: </b>
                            <?php 
                                if ($data['invoiceCompanyReference'] == '') {
                                    echo "<i class='fa fa-ellipsis-h'></i>";
                                } else {
                                    echo $data['invoiceCompanyReference']; 
                                }
                            ?>
                            <br/>
                            <b>Client Reference: </b>
                            <?php 
                                if ($data['invoiceClientReference'] == '') {
                                    echo "<i class='fa fa-ellipsis-h'></i>";
                                } else {
                                    echo $data['invoiceClientReference']; 
                                }
                            ?>
                            <br/>
                            <br/>
                            <b>Work Order ID: </b><?php echo WO_CODE.$data['IdProject']; ?><br/>
                            <b>Invoice Date: </b><?php echo $data['nInvoiceDate']; ?><br/>
                            <b>Invoice Due Date: </b><?php echo $data['nInvoiceDueDate']; ?><br/>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <br/>
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <?php if ($data['get_invoice_item']){ ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Amount (<b><?php echo $data['CurrencySymbol'];?></b>)</th>
                                        <th>Sub Total (<b><?php echo $data['CurrencySymbol'];?></b>)</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data['get_invoice_item'] as $row) 
                                        { 
                                            if ($row->ItemAmount) {
                                                $ItemAmount = number_format($row->ItemAmount, 2);
                                                $ItemTotalAmount = number_format($row->ItemTotalAmount, 2);
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
                                                <tr>
                                                    <td>$no</td>
                                                    <td>$row->ItemTitle</td>
                                                    <td>$row->ItemDesc</td>
                                                    <td>$row->ItemQty</td>
                                                    <td>$ItemAmount</td>
                                                    <td>$ItemTotalAmount</td>
                                                </tr>
                                            ";
                                            $no++;

                                            
                                        } 
                                    ?>
                                <?php echo "</tbody></table>"; ?>
                                <?php } else { ?>
                                    <hr />
                                    <center><span class='badge bg-red'><?php echo _NO_INVOICE_ITEM_DATA_LANG_;?></span></center>
                                <?php } ?>                           
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Invoice Notes:</p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                <?php echo $data['invoiceNote']; ?>
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <?php
                                            $InvoiceSubTotalAmountItem = $data['InvoiceSubTotalAmountItem'];
                                        ?>
                                        <td>
                                            <?php echo $data['CurrencySymbol']; ?> <?php echo number_format($InvoiceSubTotalAmountItem, 2); ?>
                                            <input type="hidden" name="invoiceSubtotal" id="invoiceSubtotal" value="<?php echo $InvoiceSubTotalAmountItem; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tax (<?php echo $data['invoiceTaxRate']; ?>%)</th>
                                        <?php
                                            $invoiceTax = ($data['InvoiceSubTotalAmountItem']*$data['invoiceTaxRate'])/100;
                                        ?>
                                        <td>
                                            <?php echo $data['CurrencySymbol']; ?> <?php echo number_format($invoiceTax, 2); ?>
                                            <input type="hidden" name="invoiceTax" id="invoiceTax" value="<?php echo $invoiceTax; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Payment:</th>
                                        <?php
                                            $invoiceTotalPaid = $data['InvoicePaymentTotal'];
                                        ?>
                                        <td>
                                            <?php echo $data['CurrencySymbol']; ?> <?php echo number_format($invoiceTotalPaid, 2); ?>
                                            <input type="hidden" name="invoiceTotalPaid" id="invoiceTotalPaid" value="<?php echo $invoiceTotalPaid; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Due:</th>
                                        <?php
                                            $invoiceTotalDue = ($InvoiceSubTotalAmountItem+$invoiceTax)-($invoiceTotalPaid);
                                        ?>
                                        <td>
                                            <?php echo $data['CurrencySymbol']; ?> <?php echo number_format($invoiceTotalDue, 2); ?>
                                            <input type="hidden" name="invoiceTotalDue" id="invoiceTotalDue" value="<?php echo $invoiceTotalDue; ?>"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                        <?php if ($data['isGenerated'] == '1') { ?>
                            <?php if (file_exists("uploads/invoices/".$data['invoiceNumber'].".pdf")) { ?>
                                <a class="btn btn-success" href='<?php echo DIR;?>uploads/invoices/<?php echo $data['invoiceNumber'];?>.pdf' target="_blank"><i class="fa fa-download"></i> Preview Invoice</a>
                            <?php } ?>
                        <?php } ?>


                             <a class="btn btn-info pull-right" href='<?php echo DIR;?>project/view/<?php echo $data['IdProject'];?>' ><i class="fa fa-bar-chart-o"></i>  Go to Work Orders : <b><?php echo WO_CODE.$data['IdProject']; ?></b></a>
                        </div>
                    </div>
                    <br />
                    <hr/>
                    <div class="row no-print">
                    <div class="col-xs-12"> 
                        <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#active" data-toggle="tab"><?php echo _INVOICE_TITLE_PAYMENT_LANG_; ?></a></li>
                           
                          
                            <li class="pull-right"><a class="text-muted"><i class="fa fa-money"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="active">
                                <div class="box-header">                               
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <?php if ($data['get_invoice_payment']){ ?>
                                    <table id="all-payments" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><center>No</center></th>
                                                <th><center>Payment Date</center></th>
                                                <th><center>Type</center></th>
                                                <th><center>Amount</center></th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach ($data['get_invoice_payment'] as $row) 
                                                {
                                                    $PaymentAmount   = number_format($row->PaymentAmount, 2);
                                                    if($row->PaymentNotes == '') {
                                                        $PaymentNotes =  "<center><i class='fa fa-ellipsis-h'></i></center>";
                                                    } else {
                                                        $PaymentNotes =  "$row->PaymentNotes";
                                                    }

                                                   
                                                    if ($row->LastUpdateDate == '0000-00-00 00:00:00') {
                                                        $LastUpdateDate = "";
                                                    } else {
                                                        $LastUpdateDate = "<div class='form-group'>
                                                                                <label>Last Update</label>
                                                                                <input type='text' class='form-control' value='$row->nLastUpdateDate By $row->LastUpdateUser' disabled/>
                                                                            </div>";
                                                    }


                                                    if ($data['PaymentDelete'] == 1 || Session::get('Level') != 3) {
                                                        $deleteButton = "<button type='input' name='submit' value='delete-invoice-payment' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Payment</button>";
                                                    }
                                                    
                                                    echo 
                                                    "
                                                        <tr>
                                                            <td><center>$no</center></td>
                                                            <td><center><span class='badge bg-primary'>$row->nPaymentDate</span></center></td>
                                                            <td><center>$row->PaymentType</center></td>
                                                            <td><center><span class='badge bg-green'>$PaymentAmount</span></center></td>
                                                            <td>$PaymentNotes</td>
                                                        </tr>
                                                    ";
                                                    $no++;

                                                   
                                                } 
                                            ?>
                                            <?php echo "</tbody></table>"; ?>
                                            <?php } else { ?>
                                                <hr />
                                                <span class='badge bg-red'><?php echo _NO_INVOICE_PAYMENT_DATA_LANG_;?></span>
                                            <?php } ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.tab-pane -->
                            
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->   
            </div>
            </div>

            </section><!-- /.content -->

         <?php } ?>



