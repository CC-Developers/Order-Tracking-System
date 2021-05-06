<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/setting/viewphase.php
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
            <li class="active"><?php echo _VIEW_PHASE_LANG_; ?></li>
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
                if(Session::get(successUpdatedPhase) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_PHASE_LANG_."
                                </div>";
                    Session::pull(successUpdatedPhase);
                }
        ?>
        <?php
            if (Session::get(InvalidPhase) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <b>"._ERROR_LANG_."</b> "._ERROR_INVALID_PHASE_DATA_LANG_."
                                </div>";
                Session::pull(InvalidPhase);
            } else {
        ?>
            
            <div class="col-lg-12"> 
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _FORM_UPDATE_PHASE_LANG_;?></h3> 
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">
                        <div class="form-group">
                            <label>Phase Name</label>
                            <input type="text" name="PhaseName" id="PhaseName" class="form-control" placeholder="Enter ..." value="<?php echo $data['PhaseName'];?>"/>
                        </div>

                        <div class="form-group">
                            <label>Phase Color</label> 
                            <a style='width:100%; color:white; background-color:<?php echo $data['PhaseColor'];?>;' class='btn btn-flat'><?php echo $data['PhaseColor'];?></a>                                        
                            
                        </div>
                        <div class="form-group">
                            <label>Change Phase Color</label>                                         
                            <input type="text" name="PhaseColor" id="PhaseColor" class="form-control phasecolor" placeholder="Leave blank if not changed !" value="<?php echo $_POST['PhaseColor'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Phase Order</label>
                            <input type="text" name="PhaseOrderOld" id="PhaseOrderOld" class="form-control" value="<?php echo $data['PhaseOrder'];?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label>Change Phase Order</label>
                            <input type="text" name="PhaseOrder" id="PhaseOrder" class="form-control" placeholder="Leave blank if not changed !" value="<?php echo $_POST['PhaseOrder'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Is Active ?</label>
                            <?php if ($data['IsActive'] == '1') { $active = 'selected'; } else { $active = ''; } ?>
                            <select name='On' id='On' class='form-control'>
                                <option value='0' <?php echo $active; ?>>No</option>
                                <option value='1' <?php echo $active; ?>>Yes</option>
                            </select>
                        </div>

                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="PhaseId" id="PhaseId" value="<?php echo $data['PhaseId']; ?>"/>
                            <input type="hidden" name="PhaseColorOld" id="PhaseColorOld" value="<?php echo $data['PhaseColor']; ?>"/>
                            <input type="hidden" name="PhaseOrderOld" id="PhaseOrderOld" value="<?php echo $data['PhaseOrder']; ?>"/>
                            <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Phase</button>
                            <!-- ONLY SUPER USER LEVEL ALLOWED -->
                            <?php if(Session::get(Level) == '1'){ ?>
                                <?php if($data['PhaseId'] != '1'){ ?>
                                    <button type="input" name="submit" value="x" class="btn btn-danger alignright" onclick="return confirm('Permanently DELETE the Phase <?php echo $data['PhaseName']; ?>? This action is NOT reversible once completed.');"><i class="fa fa-ban"></i> Delete Phase</button>
                                <?php } ?>
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


