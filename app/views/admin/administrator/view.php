<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/administrator/view.php
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
            <li ><a href='<?php echo DIR;?>admin/administrator'><i class="fa fa-group"></i> <?php echo _ALL_USER_LANG_; ?></a></li>
            <li class="active"><?php echo _VIEW_USER_DATA_LANG_; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) != '3') { ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-info" href='<?php echo DIR;?>admin/administrator' ><i class="fa fa-group"></i>  <?php echo _ALL_USER_LANG_; ?></a>
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
                if(Session::get(successUpdatedUser) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                     <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_USER_LANG_."
                                </div>";
                    Session::pull(successUpdatedUser);
                }
        ?>
        <?php
            if (Session::get(InvalidUser) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <b>"._ERROR_LANG_."</b> "._ERROR_INVALID_USER_DATA_LANG_."
                                </div>";
                Session::pull(InvalidUser);
            } else {
        ?>
        <div class="row">
            <div class="col-lg-4">

            <div class="box">
                <div class="box-body">
                    <center>
                        <?php if ($data['ProfilePicture']!=''){ ?>
                            <img src="<?php echo DIR;?>uploads/administrators/small_<?php echo $data['ProfilePicture'];?>" class="img-circle" alt="User Image"/> 
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
            <?php if($data['Level'] == '3') { ?>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#wo" data-toggle="tab"><?php echo _USER_WORK_ORDER_MEMBER_LANG_;?></a></li>
                  
                    <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="wo">
                                <?php 
                                if ($data['womembercount'])
                                {
                                echo "
                                <table class='table table-bordered'>
                                    <tr>
                                        <th style='width: 10px'>WO#</th>
                                        <th>Type</th>
                                        <th style='width: 40px'>Role</th>
                                    </tr>
                                ";
                                    foreach ($data['womember'] as $row) 
                                    {
                                        echo "
                                            <tr>
                                                <td>".WO_CODE."$row->IdProject</td>
                                                <td><a href=".DIR."project/view/".$row->IdProject.">$row->TypeTitle</a></td>
                                                <td><span style='background-color:$row->PhaseColor;' class='badge'>$row->RoleName</span></td>
                                            </tr>
                                        ";
                                    }
                                echo "
                                </table>
                                ";
                                } else {
                                    echo "
                                        <span class='badge bg-red'>"._NO_ASSOCIATE_WORK_ORDER_MEMBER_LANG_."</span>
                                    ";
                                }
                                ?>
                                
                                   
                    </div><!-- /.tab-pane -->
                   
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
            <?php } ?>

            </div> 
            <div class="col-lg-8"> 
            
             <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _STATISTIC_USER_LANG_;?> : <b><?php echo $data['Username']; ?></b></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <?php if($data['Level'] == '3') { ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['womembercount'];?>
                                    </h3>
                                    <p>
                                        <?php echo _USER_WORK_ORDER_MEMBER_LANG_;?>
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
                    </div>
                <?php } ?>
                    <div class="row">
                        <?php if ($data['LastUpdateDate'] == '0000-00-00 00:00:00') { ?>
                        <div class="col-xs-6">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="Never Updated" disabled/>
                        </div>
                        <?php } else { ?>
                        <div class="col-xs-6">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="<?php echo $data['nLastUpdateDate']; ?>" disabled/>
                        </div>
                            
                        <?php } ?>
                    
                        <?php if ($data['LastLogin'] == '0000-00-00 00:00:00') { ?>
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
                        <?php if ($data['CreatedUser'] == '1') { ?>
                        <div class="col-xs-6">
                            <label>Created User</label>
                            <input type="text" name="CreatedUser" id="CreatedUser" class="form-control" value="Created by Super Admin" disabled/>
                        </div>
                        <?php } ?>
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
                    <h3 class="box-title"><?php echo _VIEW_USER_DATA_LANG_; ?> : <b><?php echo $data['Username']; ?></b></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">

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
                             <?php if (Session::get(Level) == '1') { ?>
                             <div class="form-group">
                                <label>Level</label>
                                <?php if ($data['Level'] == '1') { $super = 'selected'; } else { $super = ''; } ?>
                                <?php if ($data['Level'] == '2') { $normal = 'selected'; } else { $normal = ''; } ?>
                                <?php if ($data['Level'] == '3') { $employee = 'selected'; } else { $employee = ''; } ?>
                                <select name='Level' id='Level' class='form-control'>
                                    <option value='3' <?php echo $employee; ?>>Employee</option>
                                    <option value='2' <?php echo $normal; ?>>Normal</option>
                                    <option value='1' <?php echo $super; ?>>Super Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Is Active</label>
                                <?php if ($data['IsActive'] == '1') { $active = 'selected'; } else { $active = ''; } ?>
                                <select name='On' id='On' class='form-control'>
                                    <option value='0' <?php echo $active; ?>>No</option>
                                    <option value='1' <?php echo $active; ?>>Yes</option>
                                </select>
                            </div>
                            <?php } else { ?>
                            <input name="Level" id="Level" value="<?php echo $data['Level']; ?>" type="hidden">
                            <input name="On" id="On" value="<?php echo $data['IsActive']; ?>" type="hidden">
                            <?php } ?>
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
                                <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $data['IdUser']; ?>"/>
                                <input name="passwordOld" id="passwordOld" value="<?php echo $data['Password']; ?>" type="hidden">
                                <input name="usernameOld" id="usernameOld" value="<?php echo $data['Username']; ?>" type="hidden">
                                <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Users</button>
                                <a class="btn btn-default pull-right" data-toggle='modal' data-target='#update-email'><i class="fa fa-envelope"></i> Change Email</a>
                                <a class="btn btn-default pull-right" data-toggle='modal' data-target='#update-username'><i class="fa fa-user"></i> Change Username</a>
                            </div>
                        <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                    </form>
                </div><!-- /.box-body -->

            </div><!-- /.box -->

        </div>
    <?php } ?>
    <?php } else { ?>
        <div class='alert alert-danger alert-dismissable'>
            <i class='fa fa-ban'></i>
            <b><?php echo _INVALID_LANG_;?></b>, <?php echo _CANNOT_ACCESS_PAGE_LANG_;?>
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
                                    <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $data['IdUser']; ?>"/>
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
                                    <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $data['IdUser']; ?>"/>
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



