<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/service/service.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
use \helpers\session as Session,
    \helpers\url as Url;
?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li ><a href='<?php echo DIR;?>admin'><i class="fa fa-dashboard"></i> <?php echo _DASHBOARD_LANG_;?></a></li>
            <li class="active"><?php echo _ALL_SERVICE_LANG_; ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(Session::get(Level) != '3') { ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href='<?php echo DIR;?>admin/service/add' ><i class="fa fa-plus"></i> <?php echo _ADD_NEW_SERVICE_LANG_;?></a>
            </div>
        </div>
        <hr />
        
         <?php
                if(Session::get(successAddService) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_SERVICE_LANG_."
                                </div>";
                    Session::pull(successAddService);
                }
        ?>

        <?php
                if(Session::get(successDeletedService) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_CLIENT_LANG_."
                                </div>";
                    Session::pull(successDeletedService);
                }
        ?>

        <div class="row">
            <div class="col-lg-12"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _ALL_SERVICE_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['active_service']){ ?>
                                <table id="all-services" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>#Type Code</center></th>
                                            <th>Type Title <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Type Description</th>
                                            <th><center>is Active ?</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['active_service'] as $row) 
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
                                                        <td><center><span class='label label-success'>$row->TypeCode</span></center></td>
                                                        <td>$row->TypeTitle</td>
                                                        <td>$row->TypeDesc</td>
                                                        <td>
                                                        <center>
                                                            $IsActive
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/service/view/".$row->TypeId."'>View</a></center></td>
                                                    </tr>
                                                ";
                                                $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_SERVICE_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
        </div>
    <?php } else { ?>
        <div class='alert alert-danger alert-dismissable'>
            <i class='fa fa-ban'></i>
            <b><?php echo _INVALID_LANG_;?></b>, <?php echo _CANNOT_ACCESS_PAGE_LANG_;?>
        </div>
    <?php } ?>
    </section><!-- /.content -->


