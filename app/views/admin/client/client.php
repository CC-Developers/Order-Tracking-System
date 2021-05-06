<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/client/client.php
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
            <li class="active"><?php echo _ALL_CLIENT_LANG_; ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <?php if(Session::get(Level) != '3') { ?>
            <div class="col-lg-12">
                <a class="btn btn-success" href='<?php echo DIR;?>admin/client/add' ><i class="fa fa-plus"></i>  <?php echo _ADD_NEW_CLIENT_LANG_;?></a>
                <?php if ($data['active_client']){ ?>
                    <a class="btn btn-warning" data-toggle='modal' data-target='#email-all-clients' ><i class="fa fa-envelope"></i>  <?php echo _EMAIL_ALL_CLIENT_LANG_;?></a>
                <?php } ?>
            </div>
        <?php } ?>
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
                if(Session::get(successAddClient) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ADD_CLIENT_LANG_."
                                </div>";
                    Session::pull(successAddClient);
                }
        ?>

         <?php
                if(Session::get(successDeletedClient) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_CLIENT_LANG_."
                                </div>";
                    Session::pull(successDeletedClient);
                }
        ?>

        <?php
                if(Session::get(successEmailAllClient) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_EMAIL_ALL_CLIENT_LANG_."
                                </div>";
                    Session::pull(successEmailAllClient);
                }
        ?>
        <div class="row">
            <div class="col-lg-12"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _ALL_ACTIVE_CLIENT_LANG_; ?></a></li>
                        <li><a href="#archived" data-toggle="tab"><?php echo _ALL_ARCHIVE_CLIENT_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['active_client']){ ?>
                                <table id="all-clients" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Full Name <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Notes</th>
                                            <th><center>is Active ?</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['active_client'] as $row) 
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
                                                        <td>$row->FullName</td>
                                                        <td><a href='mailto:$row->Email'>$row->Email</a></td>
                                                        <td>$row->Phone</td>
                                                        <td>$row->Notes</td>
                                                        <td>
                                                        <center>
                                                            $IsActive
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/client/view/".$row->IdClient."'>View</a></center></td>
                                                    </tr>
                                                ";
                                                $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_CLIENT_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="archived">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['archived_client']){ ?>
                                <table id="archive-clients" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Full Name <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Notes</th>
                                            <th><center>Archived Date</center></th>
                                            <th><center>Actions</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['archived_client'] as $row) 
                                            {
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td>$row->FullName</td>
                                                        <td><a href='mailto:$row->Email'>$row->Email</a></td>
                                                        <td>$row->Phone</td>
                                                        <td>$row->Notes</td>
                                                        <td>
                                                        <center>
                                                        <span class='label label-danger'>$row->archiveDate</span>
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-primary' href='".DIR."admin/client/view/".$row->IdClient."'>View</a></center></td>
                                                    </tr>
                                                ";
                                                 $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_ARCHIVE_CLIENT_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
        </div>

    </section><!-- /.content -->

    <div class="row">
        <!-- SEND EMAIL TO ALL CLIENTS -->
        <div class="modal fade" id="email-all-clients" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope"></i> <?php echo _SEND_EMAIL_ALL_CLIENT_LANG_; ?></h4>
                    </div>
                    <form role="form" method="post" action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="EmailSubject" id="EmailSubject" class="form-control" placeholder="Enter ..." value="<?php echo $_POST['EmailSubject'];?>"/>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label>Email Text</label>
                                <textarea name="EmailText" id="EmailText" class="form-control" rows="3" placeholder="Enter ..."><?php echo $_POST['EmailText'];?></textarea>
                            </div>
                            <hr />
                            <div class="box-footer">
                                <button type='input' name='submit' value='email-all-clients' class='btn btn-success'><i class="fa fa-envelope"></i> Send Email</button>
                            </div>

                            <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- END MODAL -->
    </div>


