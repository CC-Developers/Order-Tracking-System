<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/report/report.php
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
            <?php echo _REPORT_LANG_;?>
        </h1>
    </section>
    <hr />

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) == '3') { ?>
    <div class='alert alert-danger alert-dismissable'>
        <i class='fa fa-ban'></i>
        <b><?php echo _INVALID_LANG_;?></b>, <?php echo _CANNOT_ACCESS_PAGE_LANG_;?>
    </div>
    <?php } else { ?>
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title"><?php echo BARTITLE;?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                <i class="ion ion-stats-bars"></i>
                            </h3>
                            <p>
                                <?php echo _WORK_ORDER_REPORT_LANG_;?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/workorder' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                <i class="fa fa-check-square-o"></i>
                            </h3>
                            <p>
                                <?php echo _TASK_REPORT_LANG_;?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/task' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3>
                                <i class="ion ion-ios7-pricetag-outline"></i>
                            </h3>
                            <p>
                                <?php echo _INVOICE_REPORT_LANG_; ?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/invoice' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3>
                                <i class="fa fa-money"></i>
                            </h3>
                            <p>
                                <?php echo _PAYMENT_REPORT_LANG_;?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/payment' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>
                                <i class="fa fa-book"></i>
                            </h3>
                            <p>
                                <?php echo _FINANCE_REPORT_LANG_;?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/finance' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                <i class="ion ion-person-stalker"></i>
                            </h3>
                            <p>
                                <?php echo _CLIENT_REPORT_LANG_;?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/client' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                <i class="fa fa-group"></i>
                            </h3>
                            <p>
                                <?php echo _USER_REPORT_LANG_;?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/user' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>
                                <i class="fa fa-rss"></i>
                            </h3>
                            <p>
                                <?php echo _AUDIT_REPORT_LANG_; ?>
                            </p>
                        </div>
                        <a href='<?php echo DIR;?>admin/report/audit' class="small-box-footer">
                            <?php echo _GENERATE_LANG_;?> <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <?php } ?>

    </section><!-- /.content -->