<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/setting/setting.php
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
            <li class="active"><i class="fa fa-cogs"></i> <?php echo _SETTING_LANG_; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) == '1') { ?>
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
                if(Session::get(successGeneralSetting) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_SETTING_LANG_."
                                </div>";
                    Session::pull(successGeneralSetting);
                }
        ?>
        <?php
                if(Session::get(successAddPhase) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_PHASE_LANG_."
                                </div>";
                    Session::pull(successAddPhase);
                }
        ?>
        <?php
                if(Session::get(successDeletedPhase) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_PHASE_LANG_."
                                </div>";
                    Session::pull(successDeletedPhase);
                }
        ?>
        <?php
                if(Session::get(successAddCurrency) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_CURRENCY_LANG_."
                                </div>";
                    Session::pull(successAddCurrency);
                }
        ?>
        <?php
                if(Session::get(successDeletedCurrency) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_CURRENCY_LANG_."
                                </div>";
                    Session::pull(successDeletedCurrency);
                }
        ?>
        <?php
                if(Session::get(successAddRole) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_ROLE_LANG_."
                                </div>";
                    Session::pull(successAddRole);
                }
        ?>
        <?php
                if(Session::get(successDeletedRole) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_ROLE_LANG_."
                                </div>";
                    Session::pull(successDeletedRole);
                }
        ?>
        <hr />
            
        <div class="row">
            <div class="col-lg-3">
                <div class="box">
                    <div class="box-body">
                        <center>
                            <?php if ($data['AppLogo']!=''){ ?>
                                <img src="<?php echo DIR;?>uploads/logo/small_<?php echo $data['AppLogo'];?>" class="img-circle" alt=""/> 
                            <?php } else { ?>
                                <img src="<?php echo DIR;?>uploads/logo/default.png" class="img-circle" alt=""/>
                            <?php } ?>
                        </center>
                        <br />
                        <center>
                            <a><?php echo $data['appName'];?></a>
                        </center>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo _STATISTIC_SETTING_LANG_;?></h3> 
                        <div class="box-tools pull-right">
                            <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if ($data['LastUpdateDate'] == '0000-00-00 00:00:00') { ?>
                        <div>
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="Never Updated" disabled/>
                        </div>
                        <?php } else { ?>
                        <div>
                            <label>Last Update Date</label>
                            <input type="text" name="LastUpdateDate" id="LastUpdateDate" class="form-control" value="<?php echo $data['nLastUpdateDate']; ?>" disabled/>
                        </div>
                        <div>
                            <label>Last Update User</label>
                            <input type="text" name="LastUpdateUser" id="LastUpdateUser" class="form-control" value="<?php echo $data['LastUpdateUser']; ?>" disabled/>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-9"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _GENERAL_SETTING_LANG_; ?></a></li>
                        <li><a href="#phase" data-toggle="tab"><?php echo _PHASE_SETTING_LANG_; ?></a></li>
                        <li><a href="#currency" data-toggle="tab"><?php echo _CURRENCY_SETTING_LANG_; ?></a></li>
                        <li><a href="#role" data-toggle="tab"><?php echo _ROLE_SETTING_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                                <div class="box-header">
                                    <h3 class="box-title"></h3> 
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form enctype="multipart/form-data" role="form" method="post" action="">
                                        <div class="form-group">
                                            <label>Application URL</label>
                                            <input type="text" name="appUrl" id="appUrl" class="form-control" placeholder="Enter ..." value="<?php echo $data['appUrl'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Application Name</label>
                                            <input type="text" name="appName" id="appName" class="form-control" placeholder="Enter ..." value="<?php echo $data['appName'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Owner Name</label>
                                            <input type="text" name="ownerName" id="ownerName" class="form-control" placeholder="Enter ..." value="<?php echo $data['ownerName'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Owner Address</label>
                                            <textarea name="ownerAddress" id="ownerAddress" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data['ownerAddress'];?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Owner Email</label>
                                            <input type="text" name="ownerEmail" id="ownerEmail" class="form-control" placeholder="Enter ..." value="<?php echo $data['ownerEmail'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Owner Phone</label>
                                            <input type="text" name="ownerPhone" id="ownerPhone" class="form-control" placeholder="Enter ..." value="<?php echo $data['ownerPhone'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Path</label>
                                            <input type="text" name="uploadPath" id="uploadPath" class="form-control" placeholder="Enter ..." value="<?php echo $data['uploadPath'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Files Allowed</label>
                                            <input type="text" name="filesAllowed" id="filesAllowed" class="form-control" placeholder="Enter ..." value="<?php echo $data['filesAllowed'];?>"/>
                                        </div>
                                        <hr />
                                        <div class="form-group">
                                            <label for="exampleInputFile">Application Logo</label>
                                            <input type="file" class="uniform-file" name="fupload" id="fupload" value="" />
                                            <p class="help-block">Leave blank if not Changed</p>
                                        </div>
                                        
                                        <hr />
                                        <div class="box-footer">
                                            <input type="hidden" name="settingsId" id="settingsId" value="<?php echo $data['settingsId']; ?>"/>
                                            <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Settings</button>

                                        </div>
                                        <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                                    </form>
                                </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="phase">
                            <div class="box-header">
                                <h3 class="box-title"><a class="btn btn-success" href='<?php echo DIR;?>admin/phase/add' ><i class="fa fa-plus"></i>  <?php echo _ADD_NEW_PHASE_LANG_;?></a></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_phase']){ ?>
                                <table id="all-phase" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Phase Name <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th><center>Color</center></th>
                                            <th>Order</th>
                                            <th><center>Is Active ?</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_phase'] as $row) 
                                            {
                                                if ($row->IsActive == '1') {
                                                    $IsActive = "<span class='label label-success'>Yes</span>";
                                                } else {
                                                    $IsActive = "<span class='label label-danger'>No</span>";
                                                }
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td>$row->PhaseName</td>
                                                        <td>
                                                        <center>
                                                            <a style='width:100%; color:white; background-color:$row->PhaseColor;' class='btn btn-flat'>$row->PhaseColor</a>
                                                        </center>
                                                        </td>
                                                        <td>$row->PhaseOrder</td>
                                                        <td>
                                                        <center>
                                                            $IsActive
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/phase/view/".$row->PhaseId."'>View</a></center></td>
                                                    </tr>
                                                ";
                                                 $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_PHASE_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="currency">
                            <div class="box-header">
                                <h3 class="box-title"><a class="btn btn-success" href='<?php echo DIR;?>admin/currency/add' ><i class="fa fa-plus"></i>  <?php echo _ADD_NEW_CURRENCY_LANG_;?></a></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_currency']){ ?>
                                <table id="all-currency" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Currency Name <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th><center>Symbol</center></th>
                                            <th><center>Is Active ?</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_currency'] as $row) 
                                            {
                                                if ($row->IsActive == '1') {
                                                    $IsActive = "<span class='label label-success'>Yes</span>";
                                                } else {
                                                    $IsActive = "<span class='label label-danger'>No</span>";
                                                }
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td>$row->CurrencyName</td>
                                                        <td>
                                                        <center>
                                                            $row->CurrencySymbol
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                            $IsActive
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/currency/view/".$row->CurrencyId."'>View</a></center></td>
                                                    </tr>
                                                ";
                                                 $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_CURRENCY_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="role">
                            <div class="box-header">
                                <h3 class="box-title"><a class="btn btn-success" href='<?php echo DIR;?>admin/role/add' ><i class="fa fa-plus"></i>  <?php echo _ADD_NEW_ROLE_LANG_;?></a></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_role']){ ?>
                                <table id="all-role" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Role Name <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Description</th>
                                            <th><center>Is Active ?</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_role'] as $row) 
                                            {
                                                 if ($row->IsActive == '1') {
                                                    $IsActive = "<span class='label label-success'>Yes</span>";
                                                } else {
                                                    $IsActive = "<span class='label label-danger'>No</span>";
                                                }
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td>$row->RoleName</td>
                                                        <td>$row->RoleDesc</td>
                                                        <td>
                                                        <center>
                                                            $IsActive
                                                        </center>
                                                        </td>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/role/view/".$row->RoleId."'>View</a></center></td>
                                                    </tr>
                                                ";
                                                 $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_ROLE_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                    
                    </div><!-- /.tab-content -->

                </div><!-- nav-tabs-custom -->   
        </div>
    </div>
    <?php } else { ?>
        <div class='alert alert-danger alert-dismissable'>
            <i class='fa fa-ban'></i>
            <b><?php echo _INVALID_LANG_;?></b>, <?php echo _CANNOT_ACCESS_PAGE_LANG_;?>
        </div>
    <?php } ?>
    </section><!-- /.content -->


