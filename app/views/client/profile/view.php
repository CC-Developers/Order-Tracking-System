<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/client/profile/view.php
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
            <?php echo _MY_PROFILE_LANG_;?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
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
                if(Session::get(successUpdatedProfile) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_PROFILE_LANG_."
                                </div>";
                    Session::pull(successUpdatedProfile);
                }
        ?>
        <?php
            if (Session::get(InvalidProfile) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                     <b>"._ERROR_LANG_."</b> "._ERROR_INVALID_PROFILE_DATA_LANG_."
                                </div>";
                Session::pull(InvalidProfile);
            } else {
        ?>
        <div class="row">
            <div class="col-lg-4">

            <div class="box">
                <div class="box-body">
                    <center>
                        <?php if ($data['ProfilePicture']!=''){ ?>
                            <img src="<?php echo DIR;?>uploads/clients/small_<?php echo $data['ProfilePicture']; ?>" class="img-circle" alt="User Image"/>  
                        <?php } else { ?>
                            <img src="<?php echo \helpers\url::get_template_path();?>img/avatar3.png" class="img-circle" alt="User Image"/>
                        <?php } ?>
                    </center>
                    <br />
                    <center>
                    <?php if (Session::get(IsLogin)!='0'){ ?>
                        <a><i class="fa fa-circle text-success"></i> <?php echo _ONLINE_STATUS_LANG_;?></a>
                    <?php } else { ?>
                        <a><i class="fa fa-circle text-danger"></i> <?php echo _OFFLINE_STATUS_LANG_;?></a>
                    <?php } ?>
                    </center>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            </div> 
            <div class="col-lg-8"> 
            
             <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _STATISTIC_PROFILE_LANG_;?></b></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['woclientcount'];?>
                                    </h3>
                                    <p>
                                        <?php echo _PROFILE_WORK_ORDER_LANG_;?>
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

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>

        <div class="col-lg-12">

        <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _VIEW_PROFILE_DATA_LANG_; ?> : <b><?php echo $data['Username']; ?></b></h3> 
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
                                <input type="hidden" name="IdClient" id="IdClient" value="<?php echo(Session::get(IdClient)); ?>"/>
                                <input name="passwordOld" id="passwordOld" value="<?php echo $data['Password']; ?>" type="hidden">
                                <input name="usernameOld" id="usernameOld" value="<?php echo $data['Username']; ?>" type="hidden">
                                <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Profile</button>
                                <a class="btn btn-default pull-right" data-toggle='modal' data-target='#update-email'><i class="fa fa-envelope"></i> Change Email</a>
                                <a class="btn btn-default pull-right" data-toggle='modal' data-target='#update-username'><i class="fa fa-user"></i> Change Username</a>
                            </div>
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
                                    <label>Change Email</label>
                                    <input type="text" name="Email" id="Email" class="form-control" placeholder="Please Enter Valid Email Address" value="<?php echo $_POST['Email']; ?>"/>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo(Session::get(IdClient)); ?>"/>
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
                                    <label>Change Username</label>
                                    <input type="text" name="Username" id="Username" class="form-control" placeholder="Alphanumeric Only" value="<?php echo $_POST['Username']; ?>"/>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="IdClient" id="IdClient" value="<?php echo(Session::get(IdClient)); ?>"/>
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


