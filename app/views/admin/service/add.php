<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/service/add.php
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
            <li ><a href='<?php echo DIR;?>admin/service'><i class="fa fa-gear"></i> <?php echo _ALL_SERVICE_LANG_; ?></a></li>
            <li class="active"><?php echo _ADD_NEW_SERVICE_LANG_; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) != '3') { ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-info" href='<?php echo DIR;?>admin/service' ><i class="fa fa-gear"></i>  <?php echo _ALL_SERVICE_LANG_; ?></a>
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
                    <h3 class="box-title">Form Add New Work Order Type</h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">
                        <div class="form-group">
                            <label>Type Code</label>
                            <input type="text" name="TypeCode" id="TypeCode" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['TypeCode'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Type Title</label>
                            <input type="text" name="TypeTitle" id="TypeTitle" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['TypeTitle'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Type Description</label>
                            <textarea name="TypeDesc" id="TypeDesc" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['TypeDesc'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Is Active</label>
                            <select name='On' id='On' class='form-control'>
                                <option value='1'>Yes</option>
                                <option value='0'>No</option>
                            </select>
                        </div>
                        <div class="box-footer">
                            
                            <button type='input' name='submit' value='Add' class='btn btn-success'><i class="fa fa-check-square-o"></i> Add Work Order Type</button>

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
        </div>
    <?php } ?>
    </section><!-- /.content -->


