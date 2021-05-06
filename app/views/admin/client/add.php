<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/client/add.php
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
            <li class="active"><?php echo _ADD_NEW_CLIENT_LANG_;?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) != '3') { ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-info" href='<?php echo DIR;?>admin/client' ><i class="fa fa-group"></i>  <?php echo _ALL_CLIENT_LANG_; ?></a>
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
            
            <div class="col-lg-12"> 
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _FORM_ADD_NEW_CLIENT_LANG_;?></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="FullName" id="FullName" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['FullName'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="Email" id="Email" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['Email'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Mailing Address</label>
                            <textarea name="MailingAddress" id="MailingAddress" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['MailingAddress'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="Phone" id="Phone" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['Phone'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Cell Phone</label>
                            <input type="text" name="CellPhone" id="CellPhone" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['CellPhone'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="Notes" id="Notes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['Notes'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Is Active</label>
                            <select name='On' id='On' class='form-control'>
                                <option value='1'>Yes</option>
                                <option value='0'>No</option>
                            </select>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="exampleInputFile">Profile Picture</label>
                            <input type="file" class="uniform-file" name="fupload" id="fupload" value="" />
                            <p class="help-block">Leave blank if not Changed</p>
                        </div>
                        <hr />
                         <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="Username" id="Username" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['Username'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="Password" id="Password" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['Password'];?>"/>
                        </div>
                        <div class="box-footer">
                            
                            <button type='input' name='submit' value='Add' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add Client</button>

                        </div>

                        <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                    </form>
                </div><!-- /.box-body -->

            </div><!-- /.box -->

        </div>

    <?php } else { ?>
        <div class='alert alert-danger alert-dismissable'>
            <i class='fa fa-ban'></i>
            <b><?php echo _INVALID_LANG_;?></b>, <?php echo _CANNOT_ACCESS_PAGE_LANG_;?>
        </div>
    <?php } ?>

    </section><!-- /.content -->


