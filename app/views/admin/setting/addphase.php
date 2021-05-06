<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/setting/addphase.php
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
            <li class="active"><?php echo _ADD_NEW_PHASE_LANG_; ?></li>
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

            
            <div class="col-lg-12"> 
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _FORM_ADD_NEW_PHASE_LANG_;?></h3> 
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">
                        <div class="form-group">
                            <label>Phase Name</label>
                            <input type="text" name="PhaseName" id="PhaseName" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['PhaseName'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Phase Color</label>                                         
                            <input type="text" name="PhaseColor" id="PhaseColor" class="form-control phasecolor" placeholder="Enter ..." value="<?php echo $_POST['PhaseColor'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Phase Order</label>
                            <input type="text" name="PhaseOrder" id="PhaseOrder" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['PhaseOrder'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Is Active</label>
                            <select name='On' id='On' class='form-control'>
                                <option value='1'>Yes</option>
                                <option value='0'>No</option>
                            </select>
                        </div>

                        </div>
                        <div class="box-footer">
                            
                            <button type='input' name='submit' value='Add' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add Phase</button>

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


