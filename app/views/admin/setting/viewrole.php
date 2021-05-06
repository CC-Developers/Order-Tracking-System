<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/setting/viewrole.php
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
            <li ><a href='<?php echo DIR;?>admin/setting'><i class="fa fa-cogs"></i> <?php echo _SETTING_LANG_; ?></a></li>
            <li class="active"><?php echo _VIEW_ROLE_LANG_; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) == '1') { ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-warning" href='<?php echo DIR;?>admin/setting' ><?php echo _BACK_LANG_;?></a>
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
                if(Session::get(successUpdatedRole) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_ROLE_LANG_."
                                </div>";
                    Session::pull(successUpdatedRole);
                }
        ?>
        <?php
            if (Session::get(InvalidRole) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <b>"._ERROR_LANG_."</b> "._ERROR_INVALID_ROLE_DATA_LANG_."
                                </div>";
                Session::pull(InvalidRole);
            } else {
        ?>
        
            
            <div class="col-lg-12"> 
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _FORM_UPDATE_ROLE_LANG_;?></h3> 
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" name="RoleNameOld" id="RoleNameOld" class="form-control" value="<?php echo $data['RoleName'];?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label>Change Role Name</label>
                            <input type="text" name="RoleName" id="RoleName" class="form-control" placeholder="Leave blank if not changed !" value="<?php echo $_POST['RoleName'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Role Description</label> 
                            <textarea name="RoleDesc" id="RoleDesc" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data['RoleDesc'];?></textarea>                                
                        </div>
                        <div class="form-group">
                            <label>Is Active ?</label>
                            <?php if ($data['IsActive'] == '1') { $active = 'selected'; } else { $active = ''; } ?>
                            <select name='On' id='On' class='form-control'>
                                <option value='0' <?php echo $active; ?>>No</option>
                                <option value='1' <?php echo $active; ?>>Yes</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                        <label>Set Role Access</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><center>Work Order Edit</center></th>
                                    <th><center>Task View</center></th>
                                    <th><center>Task Create</center></th>
                                    <th><center>Task Edit</center></th>
                                    <th><center>Task Delete</center></th>
                                    <th><center>Schedule View</center></th>
                                    <th><center>Schedule Create</center></th>
                                    <th><center>Schedule Edit</center></th>
                                    <th><center>Schedule Delete</center></th>
                                    <th><center>Member View</center></th>
                                    <th><center>Member Create</center></th>
                                    <th><center>Member Edit</center></th>
                                    <th><center>Member Delete</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <center><input type="checkbox" name="GeneralEdit" id="GeneralEdit" value="1" <?php if ($data['GeneralEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="TaskView" id="TaskView" value="1" <?php if ($data['TaskView'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="TaskCreate" id="TaskCreate" value="1" <?php if ($data['TaskCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="TaskEdit" id="TaskEdit" value="1" <?php if ($data['TaskEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="TaskDelete" id="TaskDelete" value="1" <?php if ($data['TaskDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="ScheduleView" id="ScheduleView" value="1" <?php if ($data['ScheduleView'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                               <td>
                                    <center><input type="checkbox" name="ScheduleCreate" id="ScheduleCreate" value="1" <?php if ($data['ScheduleCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="ScheduleEdit" id="ScheduleEdit" value="1" <?php if ($data['ScheduleEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="ScheduleDelete" id="ScheduleDelete" value="1" <?php if ($data['ScheduleDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="MemberView" id="MemberView" value="1" <?php if ($data['MemberView'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="MemberCreate" id="MemberCreate" value="1" <?php if ($data['MemberCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="MemberEdit" id="MemberEdit" value="1" <?php if ($data['MemberEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="MemberDelete" id="MemberDelete" value="1" <?php if ($data['MemberDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><center>Finance View</center></th>
                                    <th><center>Finance Create</center></th>
                                    <th><center>Finance Edit</center></th>
                                    <th><center>Finance Delete</center></th>
                                    <th><center>Attachment View</center></th>
                                    <th><center>Attachment Create</center></th>
                                    <th><center>Attachment Edit</center></th>
                                    <th><center>Attachment Delete</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <center><input type="checkbox" name="FinanceView" id="FinanceView" value="1" <?php if ($data['FinanceView'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="FinanceCreate" id="FinanceCreate" value="1" <?php if ($data['FinanceCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="FinanceEdit" id="FinanceEdit" value="1" <?php if ($data['FinanceEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="FinanceDelete" id="FinanceDelete" value="1" <?php if ($data['FinanceDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="AttachmentView" id="AttachmentView" value="1" <?php if ($data['AttachmentView'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="AttachmentCreate" id="AttachmentCreate" value="1" <?php if ($data['AttachmentCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="AttachmentEdit" id="AttachmentEdit" value="1" <?php if ($data['AttachmentEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="AttachmentDelete" id="AttachmentDelete" value="1" <?php if ($data['AttachmentDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><center>Invoice View</center></th>
                                    <th><center>Invoice Create</center></th>
                                    <th><center>Invoice Edit</center></th>
                                    <th><center>Invoice Delete</center></th>
                                    <th><center>Invoice Generate</center></th>
                                    <th><center>Invoice Send</center></th>
                                    <th><center>Payment Create</center></th>
                                    <th><center>Payment Edit</center></th>
                                    <th><center>Payment Delete</center></th>
                                    <th><center>Item Create</center></th>
                                    <th><center>Item Edit</center></th>
                                    <th><center>Item Delete</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <center><input type="checkbox" name="InvoiceView" id="InvoiceView" value="1" <?php if ($data['InvoiceView'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="InvoiceCreate" id="InvoiceCreate" value="1" <?php if ($data['InvoiceCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="InvoiceEdit" id="InvoiceEdit" value="1" <?php if ($data['InvoiceEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="InvoiceDelete" id="InvoiceDelete" value="1" <?php if ($data['InvoiceDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="InvoiceGenerate" id="InvoiceGenerate" value="1" <?php if ($data['InvoiceGenerate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="InvoiceSend" id="InvoiceSend" value="1" <?php if ($data['InvoiceSendMail'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="PaymentCreate" id="PaymentCreate" value="1" <?php if ($data['PaymentCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                               <td>
                                    <center><input type="checkbox" name="PaymentEdit" id="PaymentEdit" value="1" <?php if ($data['PaymentEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="PaymentDelete" id="PaymentDelete" value="1" <?php if ($data['PaymentDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                <td>
                                    <center><input type="checkbox" name="ItemCreate" id="ItemCreate" value="1" <?php if ($data['ItemCreate'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="ItemEdit" id="ItemEdit" value="1" <?php if ($data['ItemEdit'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                                 <td>
                                    <center><input type="checkbox" name="ItemDelete" id="ItemDelete" value="1" <?php if ($data['ItemDelete'] == '1') { echo "checked"; } else {  echo ""; } ?>/></center>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>

                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="RoleId" id="RoleId" value="<?php echo $data['RoleId']; ?>"/>
                            <input type="hidden" name="RoleNameOld" id="RoleNameOld" value="<?php echo $data['RoleName']; ?>"/>
                            <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Role</button>
                            <!-- ONLY SUPER USER LEVEL ALLOWED -->
                            <?php if(Session::get(Level) == '1'){ ?>
                                <button type="input" name="submit" value="x" class="btn btn-danger alignright" onclick="return confirm('Permanently DELETE the Role <?php echo $data['RoleName']; ?>? This action is NOT reversible once completed.');"><i class="fa fa-ban"></i> Delete Role</button>
                            <?php } ?>
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


