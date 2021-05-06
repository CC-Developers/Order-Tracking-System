<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/project/add.php
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
            <li ><a href='<?php echo DIR;?>admin/project'><i class="fa fa-bar-chart-o"></i> <?php echo _ALL_PROJECT_LANG_; ?></a></li>
            <li class="active"><?php echo _ADD_NEW_PROJECT_LANG_; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) != '3') { ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-info" href='<?php echo DIR;?>admin/project' ><i class="fa fa-bar-chart-o"></i>  <?php echo _ALL_PROJECT_LANG_; ?></a>
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
                    <h3 class="box-title"><?php echo _FORM_ADD_NEW_PROJECT_LANG_;?></h3> 
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">
                        <div class="form-group">
                            <label>Client</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php if ($data['client_lists']){ ?>
                                    <select name="IdClient" id="IdClient" class="form-control" >
                                        <option value="++" selected>Select Client</option>
                                        <?php 
                                            foreach ($data['client_lists'] as $row) { 
                                                     
                                                    echo 
                                                        "<option value=$row->IdClient>$row->FullName</option>"
                                                    ;
                                                    
                                                        
                                               } 
                                        ?>
                                    </select>
                                    <?php } else { ?>
                                        <select name="IdClient" id="IdClient" class="form-control" disabled>
                                            <option value="" selected><?php echo _NO_CLIENT_LANG_;?></option>
                                        </select>
                                    <?php } ?>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Work Order Type</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bar-chart-o"></i></span>
                                    <?php if ($data['service_lists']){ ?>
                                    <select name="TypeId" id="TypeId" class="form-control" >
                                        <option value="++" selected>Select Work Order Type</option>
                                        <?php 
                                            foreach ($data['service_lists'] as $row) { 
                                                     
                                                    echo 
                                                        "<option value=$row->TypeId>[ $row->TypeCode ] - $row->TypeTitle</option>"
                                                    ;
                                                    
                                                        
                                               } 
                                        ?>
                                    </select>
                                    <?php } else { ?>
                                        <select name="TypeId" id="TypeId" class="form-control" disabled>
                                            <option value="" selected><?php echo _NO_SERVICE_DATA_LANG_;?></option>
                                        </select>
                                    <?php } ?>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Work Order Currency</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <?php if ($data['currency_lists']){ ?>
                                    <select name="ProjectCurrency" id="ProjectCurrency" class="form-control" >
                                        <option value="++" selected>Select Work Order Currency</option>
                                        <?php 
                                            foreach ($data['currency_lists'] as $row) { 
                                                     
                                                    echo 
                                                        "<option value=$row->CurrencyId>$row->CurrencySymbol- $row->CurrencyName</option>"
                                                    ;
                                                    
                                                        
                                               } 
                                        ?>
                                    </select>
                                    <?php } else { ?>
                                        <select name="ProjectCurrency" id="ProjectCurrency" class="form-control" disabled>
                                            <option value="" selected><?php echo _NO_CURRENCY_DATA_LANG_;?></option>
                                        </select>
                                    <?php } ?>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Work Order Status</label>
                                    <?php if ($data['phase_lists']){ ?>
                                        <?php 
                                            foreach ($data['phase_lists'] as $row) { 
                                                     
                                                    echo 
                                                        "
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                                <th width='10%'><center><input type='radio' name='ProjectStatus' id='ProjectStatus' class='form-control' value='$row->PhaseId'/></center></th>
                                                                <th width='90%'><center><a style='width:100%; color:white; background-color:$row->PhaseColor;' class='btn btn-flat'>$row->PhaseName</a></center></th>
                                                            </thead>
                                                        </table>
                                                        "
                                                    ;
                                                    
                                                        
                                               } 
                                        ?>
                                    <?php } else { ?>
                                        <select name="ProjectStatus" id="ProjectStatus" class="form-control" disabled>
                                            <option value="" selected><?php echo _NO_PHASE_DATA_LANG_;?></option>
                                        </select>
                                    <?php } ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Work Order Start</label>
                            <input type="text" name="ProjectStart" id="ProjectStart" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['ProjectStart'];?>"/>
                        </div>
                         <div class="form-group">
                            <label>Work Order Deadline</label>
                            <input type="text" name="ProjectDeadline" id="ProjectDeadline" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['ProjectDeadline'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="ProjectNotes" id="ProjectNotes" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['ProjectNotes'];?></textarea>
                        </div>
                        <div class="box-footer">
                            
                            <button type='input' name='submit' value='Add' class='btn btn-success'><i class="fa fa-check-square-o"></i> <?php echo _ADD_NEW_PROJECT_LANG_; ?></button>

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


