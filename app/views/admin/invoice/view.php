<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/view/admin/invoice/view.php
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
                    } else if (Session::get(InvalidAccessInvoice) == '1') {
                        echo "<div class='pad margin no-print'><div class='alert alert-danger' style='margin-bottom: 0!important;'>
                                            <i class='fa fa-ban'></i>
                                            <b>"._INVALID_LANG_."</b>, "._CANNOT_ACCESS_PAGE_LANG_."
                                        </div></div>";
                        Session::pull(InvalidAccessInvoice);
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
                    <?php
                        if(isset($error)) {
                            foreach ($error as $error) {
                                echo "<div class='alert alert-danger alert-dismissable'>
                                                <i class='fa fa-ban'></i>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <b>"._ALERT_LANG_."</b> $error
                                            </div><br />";
                            }
                        }
                    ?>
                    
                    <?php
                            if(Session::get(successInvoiceCalculation) == '1') {
                                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0!important;'>
                                                <i class='fa fa-ban'></i>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_CALCULATE_INVOICE_LANG_."
                                            </div><br />";
                                Session::pull(successInvoiceCalculation);
                            }
                    ?> 
                    <?php
                            if(Session::get(successUpdatedInvoice) == '1') {
                                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0!important;'>
                                                <i class='fa fa-ban'></i>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_INVOICE_LANG_."
                                            </div><br />";
                                Session::pull(successUpdatedInvoice);
                            }
                    ?> 
                    <?php
                            if(Session::get(SuccessGeneratedInvoice) == '1') {
                                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0!important;'>
                                                <i class='fa fa-ban'></i>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_GENERATE_UPDATE_INVOICE_LANG_."
                                            </div><br />";
                                Session::pull(SuccessGeneratedInvoice);
                            }
                    ?> 

                    <?php
                            if(Session::get(successSendEmail) == '1') {
                                echo "<div class='alert alert-success alert-dismissable' style='margin-bottom: 0!important;'>
                                                <i class='fa fa-ban'></i>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <b>"._SUCCESS_LANG_."</b> "._SUCCESS_SENT_INVOICE_LANG_."
                                            </div><br />";
                                Session::pull(successSendEmail);
                            }
                    ?> 
                    
                    <?php
                            if(Session::get('newCalculatedInvoice'.$data['invoiceId']) == '1' && $data['isSync'] != '1') {
                                 echo "<div class='alert alert-danger' style='margin-bottom: 0!important;'>
                                                <i class='fa fa-ban'></i>
                                                <b>"._IMPORTANT_LANG_."</b> Invoice have new calculation, please click  <i><u>Sync Invoice Calculation</u></i> button.
                                            </div><br />";
                            }
                    ?> 

                    <?php
                            if(Session::get('needGenerateInvoice'.$data['invoiceId']) == '1' && $data['isGenerated'] != '1') {
                                 echo "<div class='alert alert-danger' style='margin-bottom: 0!important;'>
                                                <i class='fa fa-ban'></i>
                                                <b>"._IMPORTANT_LANG_."</b> Invoice have new calculation, please click  <i><u>Generate PDF Button</u></i> button.
                                            </div><br />";
                            }
                    ?> 

                    <?php if (Session::get('newCalculatedInvoice'.$data['invoiceId']) != '1' && $data['invoiceStatus'] == 1) { ?>
                        <div class="callout callout-info">
                            <h4><?php echo _NOTIFICATION_LANG_;?></h4>
                            <p><?php echo _SUCCESSFULLY_SENT_INVOICE_LANG_;?></p>
                        </div>
                    <?php } ?> 

                    <?php if (Session::get('newCalculatedInvoice'.$data['invoiceId']) != '1' && Session::get('needGenerateInvoice'.$data['invoiceId']) != '1'&& $data['isSync'] != 1) { ?>
                        <div class="callout callout-danger">
                            <h4><?php echo _NEED_SYNC_LANG_;?></h4>
                            <p><b><?php echo _IMPORTANT_LANG_;?></b> Invoice have new calculation, please click  <i><u>Sync Invoice Calculation</u></i> button.</p>
                        </div>
                    <?php } ?> 

                    <?php if (Session::get('newCalculatedInvoice'.$data['invoiceId']) != '1' && Session::get('needGenerateInvoice'.$data['invoiceId']) != '1'&& $data['isGenerated'] != 1) { ?>
                        <div class="callout callout-danger">
                            <h4><?php echo _NEED_GENERATE_LANG_;?></h4>
                            <p><b><?php echo _IMPORTANT_LANG_;?></b> Invoice have new calculation, please click  <i><u>Sync Generate PDF Button</u></i> button.</p>
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
                <form role="form" method="post" enctype="multipart/form-data" action="">
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
                                            if ($data['isCompleted'] != 1) { 
                                                if ($data['ItemEdit'] == 1 || Session::get('Level') != 3) { 
                                                    if($data['isSync'] == '1'  && $data['isGenerated'] == '1') {
                                                        $ItemTitle = "<a href='#' data-toggle='modal' data-target='#edit-invoice-item$row->ItemId'>$row->ItemTitle</a>";
                                                    } else {
                                                        $ItemTitle = "$row->ItemTitle";
                                                    }
                                                } else {
                                                    $ItemTitle = "$row->ItemTitle";
                                                }
                                            }
                                            if ($data['isCompleted'] != 1 && !$data['get_invoice_payment']) {
                                                if ($data['ItemDelete'] == 1 || Session::get('Level') != 3) {
                                                    $deleteButton = "<button type='input' name='submit' value='delete-invoice-item' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Item</button>";
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

                                            echo 
                                            "
                                                <tr>
                                                    <td>$no</td>
                                                    <td>$ItemTitle</td>
                                                    <td>$row->ItemDesc</td>
                                                    <td>$row->ItemQty</td>
                                                    <td>$ItemAmount</td>
                                                    <td>$ItemTotalAmount</td>
                                                </tr>
                                            ";
                                            $no++;

                                            echo 
                                            "
                                            <div class='modal fade' id='edit-invoice-item$row->ItemId' tabindex='-1' role='dialog' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                            <h4 class='modal-title'><i class='fa fa-bars'></i> "._INVOICE_EDIT_ITEM_LANG_."</h4>
                                                        </div>
                                                        <form role='form' method='post' action=''>
                                                            <div class='modal-body'>
                                                                    <div class='form-group'>
                                                                        <label>Item Title</label>
                                                                        <input type='text' name='ItemTitle' id='ItemTitle' class='form-control' placeholder='Enter ...' value='$row->ItemTitle'/>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Description</label>
                                                                        <input type='text' name='ItemDesc' id='ItemDesc' class='form-control' placeholder='Enter ...'' value='$row->ItemDesc'/>
                                                                    </div>
                                                                     <div class='form-group'>
                                                                        <label>Qty</label>
                                                                        <input type='text' name='ItemQty' id='ItemQty' class='form-control' placeholder='Enter ...' value='$row->ItemQty'/>
                                                                    </div>
                                                                    <label>Amount</label>
                                                                    <div class='input-group'>
                                                                        <span class='input-group-addon'>$data[CurrencySymbol]</span>
                                                                        <input type='text' name='ItemAmount' id='ItemAmount' class='form-control' placeholder='Enter Amount ...' value='$row->ItemAmount'>
                                                                        <span class='input-group-addon'>.00</span>
                                                                    </div>
                                                                    <hr />
                                                                    $LastUpdateDate
                                                                    <div class='box-footer'>
                                                                        <input type='hidden' name='ItemId' id='ItemId' value='$row->ItemId'/>
                                                                        <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                        <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                        <input type='hidden' name='invoiceId' id='invoiceId' value='$row->invoiceId'/>
                                                                        <button type='input' name='submit' value='edit-invoice-item' class='btn btn-warning'><i class='fa fa-check-square-o'></i> Update Item</button>
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
                                <?php echo "</tbody></table>"; ?>
                                <?php } else { ?>
                                    <hr />
                                    <center><span class='badge bg-red'><?php echo _NO_INVOICE_ITEM_DATA_LANG_;?></span></center>
                                <?php } ?>                           
                        </div><!-- /.col -->
                        <?php if ($data['isCompleted'] != 1) { ?>
                            <?php if($data['isGenerated'] == '1') { ?>
                                <?php if($data['isSync'] == '1') { ?>
                                <div class="col-xs-12 no-print">
                                    <?php if ($data['ItemCreate'] == 1 || Session::get('Level') != 3) { ?>
                                        <button class="btn btn-default pull-right" data-toggle='modal' data-target='#add-invoice-item'><i class="fa fa-plus"></i> Add Item</button>  
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
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
                            
                            <p class="lead">
                                <?php

                                    if ($data['isSync'] != '1') { 
                                            echo "
                                                <button type='input' name='submit' value='update-invoice-calculation' class='btn btn-success'><i class='fa fa-bolt'></i> Sync Invoice Calculation</button>
                                                <input type='hidden' name='invoiceId' id='invoiceId' value='$data[invoiceId]'/>
                                            ";
                                    }
                                    
                                
                                ?> 
                            </p>
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
                    <?php if($data['isSync'] == '1') { ?>
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">

                        <?php
                        /*
                         *---------------------------------------------------------------
                         * INVOICE FLOW <BUTTON>
                         *---------------------------------------------------------------
                         */
                        ?>

                        <?php if ($data['get_invoice_item']){ ?>
                            <?php if ($data['isCompleted'] != 1) { ?>
                                <?php if($data['isGenerated'] == '1') { ?>
                                    <?php if ($data['InvoiceEdit'] == 1 || Session::get('Level') != 3) { ?>
                                         <a class="btn btn-primary" data-toggle='modal' data-target='#update-wo-invoice'><i class="fa fa-pencil"></i> Update Invoice Data</a>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                        <?php if ($data['isCompleted'] != 1 && $data['invoiceStatus'] == 1) { ?>
                            <?php if ($data['isGenerated'] == '1' && Session::get('Level') != 3) { ?>
                                <button type='input' name='submit' value='complete-wo-invoice' class='btn btn-success'><i class='fa fa-check'></i> Complete Invoice</button>
                                <?php if (file_exists("uploads/invoices/".$data['invoiceNumber'].".pdf")) { ?>
                                    <?php if(Session::get('needGenerateInvoice'.$data['invoiceId']) != '1') { ?>
                                            <a class="btn btn-default" href='<?php echo DIR;?>uploads/invoices/<?php echo $data['invoiceNumber'];?>.pdf' target="_blank"><i class="fa fa-search"></i> Preview Invoice</a>
                                    <?php } ?>
                                 <?php } ?>
                            <?php } ?> 
                        <?php } ?> 

                        <?php if ($data['isCompleted'] == 1 && $data['invoiceStatus'] == 1) { ?>
                            <?php if ($data['isGenerated'] == '1' && Session::get('Level') != 3) { ?>
                                <button type='input' name='submit' value='incomplete-wo-invoice' class='btn btn-danger'><i class='fa fa-reply'></i> Roll Back Invoice</button>
                            <?php } ?> 
                        <?php } ?> 

                        <?php if ($data['get_invoice_item']){ ?>
                            <?php if ($data['isCompleted'] != 1) { ?>
                                <?php if (file_exists("uploads/invoices/".$data['invoiceNumber'].".pdf")) { ?>
                                    <?php if ($data['invoiceStatus'] == 0) { ?>
                                        <?php if($data['isGenerated'] == '1') { ?>
                                            <?php if ($data['InvoiceSendMail'] == 1 || Session::get('Level') != 3) { ?>
                                                <a class="btn btn-default" data-toggle='modal' data-target='#send-invoice-email'><i class="fa fa-envelope"></i> Send Invoice</a>
                                                <a class="btn btn-default" href='<?php echo DIR;?>uploads/invoices/<?php echo $data['invoiceNumber'];?>.pdf' target="_blank"><i class="fa fa-search"></i> Preview Invoice</a>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                        <?php if ($data['isCompleted'] != 1) { ?>
                            <?php if ($data['InvoiceGenerate'] == 1 || Session::get('Level') != 3) { ?>
                                 <?php if($data['isGenerated'] != '1') { ?>
                                    <button type='input' name='submit' value='generate-invoice-pdf' class='btn btn-default'><i class='fa fa-download'></i> Generate PDF</button>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                             <a class="btn btn-info pull-right" href='<?php echo DIR;?>admin/project/view/<?php echo $data['IdProject'];?>' ><i class="fa fa-bar-chart-o"></i>  Go to Work Orders : <b><?php echo WO_CODE.$data['IdProject']; ?></b></a>
                            <?php
                            /*
                             *---------------------------------------------------------------
                             * END INVOICE FLOW <BUTTON>
                             *---------------------------------------------------------------
                             */
                            ?>

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
                                <?php if ($data['get_invoice_item']){ ?>
                                    <?php if ($data['isCompleted'] != 1) { ?>
                                        <?php if($data['isGenerated'] == '1') { ?>
                                            <?php if ($data['PaymentCreate'] == 1 || Session::get('Level') != 3) { ?>
                                                <button class="btn btn-success" data-toggle='modal' data-target='#add-invoice-payment'><i class="fa fa-credit-card"></i> Submit Payment</button>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
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
                                                <th><center>Actions</center></th>
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
                                                    if ($data['isCompleted'] != 1) {
                                                        if ($data['PaymentEdit'] == 1 || Session::get('Level') != 3) {
                                                            if($data['isSync'] == '1'  && $data['isGenerated'] == '1') {
                                                                $ButtonAction = "<a class='btn btn-warning' href='#' data-toggle='modal' data-target='#edit-invoice-payment$row->IdPayment'><i class='fa fa-pencil'></i></a>";
                                                            } else {
                                                                $ButtonAction = "<i class='fa fa-exclamation-triangle'></i>";
                                                            }
                                                        } else {
                                                            $ButtonAction = "<i class='fa fa-exclamation-triangle'></i>";
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
                                                            <td><center>$ButtonAction</center></td>
                                                        </tr>
                                                    ";
                                                    $no++;

                                                    echo 
                                                    "
                                                    <div class='row'>
                                                    <div class='modal fade' id='edit-invoice-payment$row->IdPayment' tabindex='-1' role='dialog' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                    <h4 class='modal-title'><i class='fa fa-money'></i> "._INVOICE_EDIT_PAYMENT_LANG_."</h4>
                                                                </div>
                                                                <form role='form' method='post' action=''>
                                                                    <div class='modal-body'>
                                                                            <div class='form-group'>
                                                                                <label>Payment Date</label>
                                                                                <input type='text' name='PaymentDate' id='PaymentDate' class='datepicker form-control' placeholder='Enter ...' value='$row->PaymentDate'/>
                                                                            </div>
                                                                            <div class='form-group'>
                                                                                <label>Payment Type</label>
                                                                                <input type='text' name='PaymentType' id='PaymentType' class='form-control' placeholder='Enter ...'' value='$row->PaymentType'/>
                                                                            </div>
                                                                            <label>Amount</label>
                                                                            <div class='input-group'>
                                                                                <span class='input-group-addon'>$data[CurrencySymbol]</span>
                                                                                <input type='text' name='PaymentAmount' id='PaymentAmount' class='form-control' placeholder='Enter Amount ...' value='$row->PaymentAmount'>
                                                                                <span class='input-group-addon'>.00</span>
                                                                            </div>
                                                                            <hr />
                                                                            <div class='form-group'>
                                                                                <label>Payment Notes</label>
                                                                                <textarea name='PaymentNotes' id='PaymentNotes' class='form-control' rows='3' placeholder='Enter ...'>$row->PaymentNotes</textarea>
                                                                            </div>
                                                                            <hr />
                                                                            <div class='form-group'>
                                                                                <label>Created Date</label>
                                                                                <input type='text' class='form-control' value='$row->CreatedDate By $row->AdminName' disabled/>
                                                                            </div>
                                                                            $LastUpdateDate
                                                                            <div class='box-footer'>
                                                                                <input type='hidden' name='IdPayment' id='IdPayment' value='$row->IdPayment'/>
                                                                                <input type='hidden' name='IdProject' id='IdProject' value='$row->IdProject'/>
                                                                                <input type='hidden' name='IdClient' id='IdClient' value='$row->IdClient'/>
                                                                                <input type='hidden' name='invoiceId' id='invoiceId' value='$row->invoiceId'/>
                                                                                <button type='input' name='submit' value='edit-invoice-payment' class='btn btn-warning'><i class='fa fa-check-square-o'></i> Update Payment</button>
                                                                                <button type='button' class='btn pull-right' data-dismiss='modal'> Close</button>
                                                                                $deleteButton
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
                                                <span class='badge bg-red'><?php echo _NO_INVOICE_PAYMENT_DATA_LANG_;?></span>
                                            <?php } ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.tab-pane -->
                            
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->   
            </div>
            </div>

            <?php } ?>
            </section><!-- /.content -->

                    <div class="row">
                        <!-- SEND INVOICE ATTACHMENT TO EMAIL -->
                        <div class="modal fade" id="send-invoice-email" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-envelope"></i> <?php echo _INVOICE_SEND_MAIL_LANG_; ?> : <b><?php echo $data['invoiceNumber']; ?></b></h4>
                                    </div>
                                    <form role="form" method="post" action="">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Subject</label>
                                                    <input type="text" name="EmailSubject" id="EmailSubject" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['EmailSubject'];?>"/>
                                                </div>
                                                <label>Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                    <input type="text" name="EmailTarget" id="EmailTarget" class="form-control" placeholder="Enter ..." value="<?php echo $data['ClientEmail']; ?>">
                                                </div>
                                                <hr />
                                                <div class="form-group">
                                                    <label>Email Text</label>
                                                    <textarea name="EmailText" id="EmailText" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['EmailText'];?></textarea>
                                                </div>
                                                <hr />
                                                <center><label><?php echo $data['invoiceNumber']; ?>.pdf</label></center>
                                                <div class='form-group'>
                                                    <center>
                                                        <a href="<?php echo DIR;?>uploads/invoices/<?php echo $data['invoiceNumber']; ?>.pdf" target="_blank"><img src="<?php echo DIR;?>uploads/icons/invoice-icon.png"/></a> 
                                                    </center>
                                                </div>
                                                <div class="box-footer">
                                                    <input type="hidden" name="invoiceId" id="IdClient" value="<?php echo $data['invoiceId']; ?>"/>
                                                    <button type='input' name='submit' value='send-invoice-email' class='btn btn-success'><i class="fa fa-envelope"></i> Send Email</button>
                                                </div>

                                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- END ADD WO TASK DATA MODAL -->
                    </div>

                    <div class="row">
                        <!-- ADD INVOICE ITEM DATA MODAL -->
                        <div class="modal fade" id="add-invoice-item" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-bars"></i> <?php echo _INVOICE_ADD_ITEM_LANG_; ?> : <b><?php echo $data['invoiceNumber']; ?></b></h4>
                                    </div>
                                    <form role="form" method="post" action="">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Title</label>
                                                    <input type="text" name="ItemTitle" id="ItemTitle" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['ItemTitle'];?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text" name="ItemDesc" id="ItemDesc" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['ItemDesc'];?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Qty</label>
                                                    <input type="text" name="ItemQty" id="ItemQty" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['ItemQty'];?>"/>
                                                </div>
                                                <label>Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><?php echo $data['CurrencySymbol']; ?></span>
                                                    <input type="text" name="ItemAmount" id="ItemAmount" class="form-control" placeholder="Enter Amount ..." value="<?php echo $_POST['ItemAmount'];?>">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                                <hr />
                                                <div class="box-footer">
                                                    <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                                    <input type="hidden" name="invoiceId" id="IdClient" value="<?php echo $data['invoiceId']; ?>"/>
                                                    <button type='input' name='submit' value='add-invoice-item' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add New Item</button>
                                                </div>

                                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- END ADD WO TASK DATA MODAL -->
                    </div>

                    <div class="row">
                        <!-- ADD INVOICE PAYMENT DATA MODAL -->
                        <div class="modal fade" id="add-invoice-payment" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-bars"></i> <?php echo _INVOICE_ADD_PAYMENT_LANG_; ?> : <b><?php echo $data['invoiceNumber']; ?></b></h4>
                                    </div>
                                    <form role="form" method="post" action="">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Payment Date</label>
                                                    <input type="text" name="PaymentDate" id="PaymentDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $_POST['PaymentDate'];?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Payment Type</label>
                                                    <input type="text" name="PaymentType" id="PaymentType" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['PaymentType'];?>"/>
                                                </div>
                                                <label>Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><?php echo $data['CurrencySymbol']; ?></span>
                                                    <input type="text" name="PaymentAmount" id="PaymentAmount" class="form-control" placeholder="Enter Amount ..." value="<?php echo $_POST['PaymentAmount'];?>">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                                <hr />
                                                <div class="form-group">
                                                    <label>Payment Notes</label>
                                                    <textarea name="PaymentNotes" id="PaymentNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['PaymentNotes'];?></textarea>
                                                </div>
                                                <div class="box-footer">
                                                    <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                                    <input type="hidden" name="invoiceId" id="invoiceId" value="<?php echo $data['invoiceId']; ?>"/>
                                                    <button type='input' name='submit' value='add-invoice-payment' class='btn btn-success'><i class="fa fa-money"></i> Add New Payment</button>
                                                </div>
                                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- END ADD WO TASK DATA MODAL -->
                    </div>

                    <div class="row">
                        <!-- UPDATE WO INVOICE DATA MODAL -->
                        <div class="modal fade" id="update-wo-invoice" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><i class="ion ion-clipboard"></i> <?php echo _INVOICE_UPDATE_LANG_; ?> : <b><?php echo WO_CODE.$data['IdProject']; ?></b></h4>
                                    </div>
                                    <form role="form" method="post" action="">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label>Invoice Number</label>
                                                <input type="text" class="form-control" value="<?php echo $data['invoiceNumber'];?>" disabled/>
                                            </div>
                                            <div class="form-group">
                                                <label>Change Invoice Number</label>
                                                <input type="text" name="invoiceNumber" id="invoiceNumber" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['invoiceNumber'];?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Invoice Client Reference</label>
                                                <input type="text" name="invoiceClientReference" id="invoiceClientReference" class="form-control" placeholder="Enter ..." value="<?php echo $data['invoiceClientReference'];?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Invoice Company Reference</label>
                                                <input type="text" name="invoiceCompanyReference" id="invoiceCompanyReference" class="form-control" placeholder="Enter ..." value="<?php echo $data['invoiceCompanyReference'];?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Invoice Date</label>
                                                <input type="text" name="invoiceDate" id="invoiceDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $data['InvoiceDate'];?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Invoice Due Date</label>
                                                <input type="text" name="invoiceDueDate" id="invoiceDueDate" class="datepicker form-control" placeholder="Enter ..." value="<?php echo $data['InvoiceDueDate'];?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Invoice Currency</label>
                                                <input type="text" class="form-control" value="<?php echo $data['CurrencySymbol']; ?> - <?php echo $data['CurrencyName']; ?>" disabled/>
                                            </div>
                                            <label>Invoice Tax Rate</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">TAX</span>
                                                <input type="text" name="invoiceTaxRate" id="invoiceTaxRate" class="form-control" placeholder="Enter Tax Rate ..." value="<?php echo $data['invoiceTaxRate'];?>">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label>Notes</label>
                                                <textarea name="invoiceNote" id="invoiceNote" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data['invoiceNote'];?></textarea>
                                            </div>
                                            <div class='form-group'>
                                                <label>Created Date</label>
                                                <input type="text" class="form-control" value="<?php echo $data['CreatedDate'];?> By <?php echo $data['AdminName'];?>" disabled/>
                                            </div>
                                            <?php
                                                if ($data['LastUpdateDate'] == '0000-00-00 00:00:00') {
                                                   echo "<div class='form-group'>
                                                                            <label>Last Update</label>
                                                                            <input type='text' class='form-control' value='Never Updated' disabled/>
                                                                        </div>";
                                                } else {
                                                    echo "<div class='form-group'>
                                                                            <label>Last Update</label>
                                                                            <input type='text' class='form-control' value='$data[nLastUpdateDate] By $data[LastUpdateUser]' disabled/>
                                                                        </div>";
                                                }
                                            ?>
                                            <div class="box-footer">
                                                <input type="hidden" name="invoiceId" id="invoiceId" value="<?php echo $data['invoiceId']; ?>"/>
                                                <input type="hidden" name="IdProject" id="IdProject" value="<?php echo $data['IdProject']; ?>"/>
                                                <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                                <input type="hidden" name="invoiceNumberOld" id="invoiceNumberOld" value="<?php echo $data['invoiceNumber']; ?>"/>
                                                <input type="hidden" name="invoiceCurrency" id="invoiceCurrency" value="<?php echo $data['invoiceCurrency']; ?>"/>
                                                <button type='input' name='submit' value='update-wo-invoice' class='btn btn-warning'><i class="fa fa-check-square-o"></i> Update Invoice</button>
                                                <button type='input' name='submit' value='delete-wo-invoice' class='btn btn-danger pull-right' ><i class='fa fa-ban'></i> Delete Invoice</button>
                                            </div>

                                        <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- END UPDATE WO INVOICE DATA MODAL -->
                    </div>

                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                        </form>
         <?php } ?>



