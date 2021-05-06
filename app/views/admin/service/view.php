<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/service/view.php
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
            <li ><a href='<?php echo DIR;?>admin/'><i class="fa fa-dashboard"></i> <?php echo _DASHBOARD_LANG_;?></a></li>
            <li ><a href='<?php echo DIR;?>admin/service'><i class="fa fa-gear"></i> <?php echo _ALL_SERVICE_LANG_; ?></a></li>
            <li class="active"><?php echo _VIEW_SERVICE_DATA_LANG_; ?></li>
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
        <?php
                if(Session::get(successUpdatedService) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_SERVICE_LANG_."
                                </div>";
                    Session::pull(successUpdatedService);
                }
        ?>
        <?php
            if (Session::get(InvalidService) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <b>"._ERROR_LANG_."</b> "._ERROR_INVALID_SERVICE_DATA_LANG_."
                                </div>";
                Session::pull(InvalidService);
            } else {
        ?>
        <div class="row">
            
            <div class="col-lg-12"> 
            
             <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _STATISTIC_SERVICE_LANG_;?> : <b>[ <?php echo $data['TypeCode']; ?> ]</b></h3> 
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
                                        <?php echo $data['get_service_wo_count'];?>
                                    </h3>
                                    <p>
                                        <?php echo _SERVICE_WORK_ORDER_ASSOCIATION_LANG_;?>
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

                    <div class="row">
                        <?php if ($data['LastUpdateDate'] == '0000-00-00 00:00:00') { ?>
                        <div class="col-xs-12">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="Never Updated" disabled/>
                        </div>
                        <?php } else { ?>
                        <div class="col-xs-6">
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="<?php echo $data['nLastUpdateDate']; ?>" disabled/>
                        </div>
                        <div class="col-xs-6">
                            <label>Last Update User</label>
                            <input type="text" name="LastUpdateUser" id="LastUpdateUser" class="form-control" value="<?php echo $data['LastUpdateUser']; ?>" disabled/>
                        </div>
                            
                        <?php } ?>
                    
                        
                        <div class="col-xs-6">
                            <label>Created Date</label>
                            <input type="text" name="CreatedDate" id="CreatedDate" class="form-control" value="<?php echo $data['nCreatedDate']; ?>" disabled/>
                        </div>
                        <div class="col-xs-6">
                            <label>Created User</label>
                            <input type="text" name="CreatedUser" id="CreatedUser" class="form-control" value="<?php echo $data['FullName']; ?>" disabled/>
                        </div>
                        
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _VIEW_SERVICE_DATA_LANG_; ?> : [ <b><?php echo $data['TypeCode']; ?> ]</b> - <?php echo $data['TypeTitle']; ?></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">
                            <div class="form-group">
                                <label>Type Code</label>
                                <input type="text" name="TypeCode" id="TypeCode" class="form-control" value="<?php echo $data['TypeCode']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Change Type Code</label>
                                <input type="text" name="TypeCode" id="TypeCode" class="form-control" placeholder="Leave it blank if not changed" value="<?php echo $_POST['TypeCode']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Type Title</label>
                                <input type="text" name="TypeTitle" id="TypeTitle" class="form-control" value="<?php echo $data['TypeTitle']; ?>" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Change Type Title</label>
                                <input type="text" name="TypeTitle" id="TypeTitle" class="form-control" placeholder="Leave it blank if not changed" value="<?php echo $_POST['TypeTitle']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Type Description</label>
                                <textarea name="TypeDesc" id="TypeDesc" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data['TypeDesc']; ?></textarea>
                            </div>
                             <?php if (Session::get(Level) == '1') { ?>
                            <div class="form-group">
                                <label>Is Active</label>
                                <?php if ($data['IsActive'] == '1') { $active = 'selected'; } else { $active = ''; } ?>
                                <select name='On' id='On' class='form-control'>
                                    <option value='0' <?php echo $active; ?>>No</option>
                                    <option value='1' <?php echo $active; ?>>Yes</option>
                                </select>
                            </div>
                            <?php } else { ?>
                            <input name="On" id="On" value="<?php echo $data['IsActive']; ?>" type="hidden">
                            <?php } ?>

                            <div class="box-footer">
                                <input type="hidden" name="TypeId" id="TypeId" value="<?php echo $data['TypeId']; ?>"/>
                                <input name="TypeCodeOld" id="TypeCodeOld" value="<?php echo $data['TypeCode']; ?>" type="hidden">
                                <input name="TypeTitleOld" id="TypeTitleOld" value="<?php echo $data['TypeTitle']; ?>" type="hidden">
                                <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Work Order Type</button>
                                <!-- ONLY SUPER USER LEVEL ALLOWED -->
                                <?php if(Session::get(Level) == '1'){ ?>
                                    <button type="input" name="submit" value="x" class="btn btn-danger alignright" onclick="return confirm('Permanently DELETE the Service <?php echo $data['TypeTitle']; ?>? This action is NOT reversible once completed.');"><i class="fa fa-ban"></i> Delete</button>
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


