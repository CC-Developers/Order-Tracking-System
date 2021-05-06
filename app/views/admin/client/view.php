<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/client/view.php
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
            <li ><a href='<?php echo DIR;?>admin/client'><i class="fa fa-group"></i> <?php echo _ALL_CLIENT_LANG_; ?></a></li>
            <li class="active"><?php echo _VIEW_CLIENT_DATA_LANG_;?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-info" href='<?php echo DIR;?>admin/client' ><i class="fa fa-group"></i>  <?php echo _ALL_CLIENT_LANG_; ?></a></a>
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
        <?php
                if(Session::get(successUpdatedClient) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_CLIENT_LANG_."
                                </div>";
                    Session::pull(successUpdatedClient);
                }
        ?>
        <?php
                if(Session::get(successArchivedClient) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ARCHIVE_CLIENT_LANG_."
                                </div>";
                    Session::pull(successArchivedClient);
                }
        ?>
        <?php
                if(Session::get(successUnarchivedClient) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UNARCHIVE_CLIENT_LANG_."
                                </div>";
                    Session::pull(successUnarchivedClient);
                }
        ?>

        <?php
            if (Session::get(InvalidClient) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <b>"._ERROR_LANG_."</b> "._ERROR_INVALID_CLIENT_DATA_LANG_."
                                </div>";
                Session::pull(InvalidClient);
            } else {
        ?>

        <div class="row">
            <div class="col-lg-4">

            <div class="box">
                <div class="box-body">
                    <center>
                        <?php if ($data['ProfilePicture']!=''){ ?>
                            <img src="<?php echo DIR;?>uploads/clients/small_<?php echo $data['ProfilePicture'];?>" class="img-circle" alt="User Image"/> 
                        <?php } else { ?>
                            <img src="<?php echo \helpers\url::get_template_path();?>img/avatar3.png" class="img-circle" alt="User Image"/>
                        <?php } ?>
                    </center>
                    <br />
                    <center>
                    <?php if ($data['IsLogin']!='0'){ ?>
                        <a><i class="fa fa-circle text-success"></i> <?php echo _ONLINE_STATUS_LANG_;?></a>
                    <?php } else { ?>
                        <a><i class="fa fa-circle text-danger"></i> <?php echo _OFFLINE_STATUS_LANG_;?></a>
                    <?php } ?>
                    </center>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#wo" data-toggle="tab"><?php echo _CLIENT_WORK_ORDER_LANG_;?></a></li>
                    <li><a href="#invoices" data-toggle="tab"><?php echo _CLIENT_INVOICE_LANG_;?></a></li>
                    <li><a href="#payments" data-toggle="tab"><?php echo _CLIENT_PAYMENT_LANG_;?></a></li>
                  
                    <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="wo">
                                <?php 
                                if ($data['woclient'])
                                {
                                echo "
                                <table class='table table-bordered'>
                                    <tr>
                                        <th><center>WO#</center></th>
                                        <th><center>Progress</center></th>
                                        <th><center>Status</center></th>
                                    </tr>
                                ";
                                    foreach ($data['woclient'] as $row) 
                                    {
                                        echo "
                                            <tr>
                                                <td><center><a href=".DIR."admin/project/view/".$row->IdProject.">".WO_CODE."$row->IdProject</a></center></td>
                                                <td>
                                                <div class='progress xs'>
                                                    <div class='progress-bar' style='background-color:$row->PhaseColor; width: $row->ProjectProgress%'' role='progressbar' aria-valuenow='$row->ProjectProgress' aria-valuemin='0' aria-valuemax='100'>
                                                    </div>
                                                </div>
                                                <center>$row->ProjectProgress%</center>
                                                </td>
                                                <td><center><span style='background-color:$row->PhaseColor;' class='badge'>$row->PhaseName</span></center></td>
                                            </tr>
                                        ";
                                    }
                                echo "
                                </table>
                                ";
                                } else {
                                    echo "
                                        <span class='badge bg-red'>"._NO_CLIENT_WORK_ORDER_LANG_."</span>
                                    ";
                                }
                                ?>
                                
                                   
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="invoices">
                        <?php 
                                if ($data['invoiceclient'])
                                {
                                echo "
                                <table class='table table-bordered'>
                                    <tr>
                                        <th>NO#</th>
                                        <th><center>Status</center></th>
                                        <th>Due Date</th>
                                    </tr>
                                ";
                                    foreach ($data['invoiceclient'] as $row) 
                                    {
                                        if ($row->invoiceStatus == '1') { 
                                            echo "
                                            <tr>
                                                <td><a href=".DIR."admin/invoice/view/".$row->invoiceId.">$row->invoiceNumber</a></td>
                                                <td><center><span class='badge bg-green'>Sent</span></center></td>
                                                <td>$row->invoiceDueDate</td>
                                            </tr>
                                        ";
                                        } else {
                                           echo "
                                            <tr>
                                                <td><a href=".DIR."admin/invoice/view/".$row->invoiceId.">$row->invoiceNumber</a></td>
                                                <td><center><span class='badge bg-yellow'>Not Sent</span></center></td>
                                                <td>$row->invoiceDueDate</td>
                                            </tr>
                                        ";
                                        }  
                                    }
                                echo "
                                </table>
                                ";
                                } else {
                                    echo "
                                        <span class='badge bg-red'>"._NO_CLIENT_INVOICE_LANG_."</span>
                                    ";
                                }
                                ?>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="payments">
                        <?php 
                                if ($data['paymentclient'])
                                {
                                echo "
                                <table class='table table-bordered'>
                                    <tr>
                                        <th>NO#</th>
                                        <th><center>Payment Date</center></th>
                                    </tr>
                                ";
                                    foreach ($data['paymentclient'] as $rows) 
                                    {
                                        echo "
                                            <tr>
                                                <td><a href=".DIR."admin/invoice/view/".$rows->invoiceId.">$rows->invoiceNumber</a></td>
                                                <td><center>$rows->paymentDate<center></td>
                                            </tr>
                                        ";
                                    }
                                echo "
                                </table>
                                ";
                                } else {
                                    echo "
                                        <span class='badge bg-red'>"._NO_CLIENT_PAYMENT_LANG_."</span>
                                    ";
                                }
                                ?>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->

            </div> 
            <div class="col-lg-8"> 
            
             <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _STATISTIC_CLIENT_LANG_;?> : <b><?php echo $data['Username']; ?></b></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['wocount'];?>
                                    </h3>
                                    <p>
                                        <?php echo _CLIENT_WORK_ORDER_LANG_;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
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
                                        <?php echo _CLIENT_INVOICE_LANG_;?>
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
                                        <?php echo $data['paymentcount'];?>
                                    </h3>
                                    <p>
                                        <?php echo _CLIENT_PAYMENT_LANG_;?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-card"></i>
                                </div>
                                <a class="small-box-footer">
                                    <i class="ion ion-refreshing"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>

                    <div class="row">
                        <?php if ($data['LastUpdateDate'] == '0000-00-00 00:00:00') { ?>
                        <div class="col-xs-6">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="Never Updated" disabled/>
                        </div>
                        <?php } else { ?>
                        <div class="col-xs-3">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="<?php echo $data['nLastUpdateDate']; ?>" disabled/>
                        </div>
                        <div class="col-xs-3">
                            <label>Last Update User</label>
                            <input type="text" name="LastUpdateUser" id="LastUpdateUser" class="form-control" value="<?php echo $data['LastUpdateUser']; ?>" disabled/>
                        </div>
                        <?php } ?>
                    
                        <?php if ($data['LastLoginDate'] == '0000-00-00 00:00:00') { ?>
                        <div class="col-xs-6">
                                <label>Last Login Date</label>
                                <input type="text" name="LastLoginDate" id="LastLoginDate" class="form-control" value="Never Login" disabled/>
                            </div>
                        <?php } else { ?>
                        <div class="col-xs-3">
                            <label>Last Login Date</label>
                            <input type="text" name="LastLoginDate" id="LastLoginDate" class="form-control" value="<?php echo $data['nLastLoginDate']; ?>" disabled/>
                        </div>
                         <div class="col-xs-3">
                            <label>Last IP Login</label>
                            <input type="text" name="LastLoginIp" id="LastLoginIp" class="form-control" value="<?php echo $data['LastLoginIp']; ?>" disabled/>
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
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _VIEW_CLIENT_DATA_LANG_; ?> : <b><?php echo $data['Username']; ?></b></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">

                        <?php if ($data['isArchived'] == '1') { ?>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="FullName" id="FullName" class="form-control" placeholder="Enter ..." value="<?php echo $data['FullName']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="Email" id="Email" class="form-control" placeholder="Enter ..." value="<?php echo $data['Email']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Mailing Address</label>
                                <textarea name="MailingAddress" id="MailingAddress" class="form-control" rows="3" placeholder="Enter ..." disabled><?php echo $data['MailingAddress']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="Phone" id="Phone" class="form-control" placeholder="Enter ..." value="<?php echo $data['Phone']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Cell Phone</label>
                                <input type="text" name="CellPhone" id="CellPhone" class="form-control" placeholder="Enter ..." value="<?php echo $data['CellPhone']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea name="Notes" id="Notes" class="form-control" rows="3" placeholder="Enter ..." disabled><?php echo $data['Notes']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Is Active</label>
                                <?php if ($data['IsActive'] == '1') { $active = 'selected'; } else { $active = ''; } ?>
                                <select name='On' id='On' class='form-control' disabled>
                                    <option value='0' <?php echo $active; ?>>No</option>
                                    <option value='1' <?php echo $active; ?>>Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Profile Picture</label>
                                <input type="file" class="uniform-file" name="fupload" id="fupload" value="" disabled/>
                                <p class="help-block">Leave blank if not Changed</p>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="Username" id="Username" class="form-control" placeholder="Leave it blank if not changed" value="" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="Password" id="Password" class="form-control" placeholder="Leave it blank if not changed" value="" disabled/>
                            </div>
                            <div class="box-footer">
                                <!-- ONLY SUPER USER LEVEL ALLOWED -->
                                <?php if(Session::get(Level) == '1'){ ?>
                                    <button type='input' name='submit' value='Unarchive' class='btn btn-success'><i class="fa fa-check-square-o"></i> Un-Archived Client</button>
                                    <button type="input" name="submit" value="x" class="btn btn-danger alignright" onclick="return confirm('Permanently DELETE the Client <?php echo $data['FullName']; ?>? This action is NOT reversible once completed.');"><i class="fa fa-ban"></i> Delete Client</button>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="FullName" id="FullName" class="form-control" placeholder="Enter ..." value="<?php echo $data['FullName']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="Email" id="Email" class="form-control" value="<?php echo $data['Email']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Mailing Address</label>
                                <textarea name="MailingAddress" id="MailingAddress" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data['MailingAddress']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="Phone" id="Phone" class="form-control" placeholder="Enter ..." value="<?php echo $data['Phone']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Cell Phone</label>
                                <input type="text" name="CellPhone" id="CellPhone" class="form-control" placeholder="Enter ..." value="<?php echo $data['CellPhone']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea name="Notes" id="Notes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data['Notes']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Is Active</label>
                                <?php if ($data['IsActive'] == '1') { $active = 'selected'; } else { $active = ''; } ?>
                                <select name='On' id='On' class='form-control'>
                                    <option value='0' <?php echo $active; ?>>No</option>
                                    <option value='1' <?php echo $active; ?>>Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Profile Picture</label>
                                <input type="file" class="uniform-file" name="fupload" id="fupload" value="" />
                                <p class="help-block">Leave blank if not Changed</p>
                            </div>
                            <hr />
                             <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="Username" id="Username" class="form-control" value="<?php echo $data['Username']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="Password" id="Password" class="form-control" placeholder="Leave it blank if not changed" value=""/>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                <input name="passwordOld" id="passwordOld" value="<?php echo $data['Password']; ?>" type="hidden">
                                <input name="usernameOld" id="usernameOld" value="<?php echo $data['Username']; ?>" type="hidden">
                                <?php if(Session::get(Level) != '3') { ?>
                                    <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Client</button>
                                    <a class="btn btn-default pull-right" data-toggle='modal' data-target='#update-email'><i class="fa fa-envelope"></i> Change Email</a>
                                    <a class="btn btn-default pull-right" data-toggle='modal' data-target='#update-username'><i class="fa fa-user"></i> Change Username</a>
                                    <!-- ONLY SUPER USER LEVEL ALLOWED -->
                                    <?php if(Session::get(Level) == '1'){ ?>
                                        <button type='input' name='submit' value='Archive' class='btn btn-warning'><i class="fa fa-check-square-o"></i> Archived Client</button>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                    </form>
                </div><!-- /.box-body -->

            </div><!-- /.box -->

        </div>
        
    <?php } ?>

    </section><!-- /.content -->

     <div class="row">
        <!-- UPDATE EMAIL DATA MODAL -->
        <div class="modal fade" id="update-email" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope"></i> <?php echo _EMAIL_UPDATE_; ?></h4>
                    </div>
                    <form role="form" method="post" action="">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Change Email : <?php echo $data['Email']; ?></label>
                                    <input type="text" name="Email" id="Email" class="form-control" placeholder="Please Enter Valid Email Address" value="<?php echo $_POST['Email']; ?>"/>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                    <button type='input' name='submit' value='update-email' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Email</button>
                                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                </div>

                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- END UPDATE EMAIL DATA MODAL -->
    </div>

    <div class="row">
        <!-- UPDATE USERNAME DATA MODAL -->
        <div class="modal fade" id="update-username" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-user"></i> <?php echo _USERNAME_UPDATE_; ?></h4>
                    </div>
                    <form role="form" method="post" action="">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Change Username : <?php echo $data['Username']; ?></label>
                                    <input type="text" name="Username" id="Username" class="form-control" placeholder="Alphanumeric Only" value="<?php echo $_POST['Username']; ?>"/>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo $data['IdClient']; ?>"/>
                                    <button type='input' name='submit' value='update-username' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Username</button>
                                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                </div>

                                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- END UPDATE USERNAME DATA MODAL -->
    </div>


