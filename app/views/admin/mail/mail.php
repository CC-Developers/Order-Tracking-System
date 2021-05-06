<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/mail/mail.php
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
                <section class="content-header no-margin">
                    <h1 class="text-center">
                        <?php echo _MAILBOX_LANG_;?>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> <?php echo _COMPOSE_MESSAGE_LANG_;?></a>
            </div>
        </div>
        <br />
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
                if(Session::get(successReadMail) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_READ_MAIL_LANG_."
                                </div>";
                    Session::pull(successReadMail);
                }
        ?>
        <?php
                if(Session::get(successUnreadMail) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UNREAD_MAIL_LANG_."
                                </div>";
                    Session::pull(successUnreadMail);
                }
        ?>
        <?php
                if(Session::get(successArchivedMail) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_ARCHIVE_MAIL_LANG_."
                                </div>";
                    Session::pull(successArchivedMail);
                }
        ?>
        <?php
                if(Session::get(successUnarchivedMail) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UNARCHIVE_MAIL_LANG_."
                                </div>";
                    Session::pull(successUnarchivedMail);
                }
        ?>
        <?php
                if(Session::get(successComposedMail) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_COMPOSE_MAIL_LANG_."
                                </div>";
                    Session::pull(successComposedMail);
                }
        ?>
        <?php
                if(Session::get(successDeletedMail) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_DELETE_MAIL_LANG_."
                                </div>";
                    Session::pull(successDeletedMail);
                }
        ?>
        <hr />
        <div class="row">
            <div class="col-lg-12"> 
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active" data-toggle="tab"><?php echo _INBOX_LANG_; ?></a></li>
                        <li><a href="#out" data-toggle="tab"><?php echo _OUTBOX_LANG_; ?></a></li>
                        <li><a href="#archived" data-toggle="tab"><?php echo _ARCHIVE_LANG_; ?></a></li>
                      
                        <li class="pull-right"><a class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="active">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_inbox']){ ?>
                                <table id="inbox" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Sender <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Mail Title</th>
                                            <th>Mail Content</th>
                                            <th><center>Sent Date</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_inbox'] as $row) 
                                            {
                                                if ($row->isRead == '1') {
                                                    $isRead = "<span class='label label-success'>Read</span>";
                                                    $markReadButton = "";
                                                    $markUnreadButton = "<button type='input' name='submit' value='UnRead' class='btn btn-danger pull-left'><i class='fa fa-times'></i> Mark as Unread</button>";
                                                    $archiveButton =  "<button type='input' name='submit' value='IsArchived' class='btn btn-warning pull-left'><i class='fa fa-archive'></i> Archive Mail</button>";
                                                    $unarchiveButton =  "";
                                                    $deleteButton = "";
                                                } else {
                                                    $isRead = "<span class='label label-danger'>Unread</span>";
                                                    $markReadButton = "<button type='input' name='submit' value='IsRead' class='btn btn-success pull-left'><i class='fa fa-check'></i> Mark as Read</button>";
                                                    $markUnreadButton = "";
                                                    $archiveButton =  "";
                                                    $unarchiveButton =  "";
                                                    $deleteButton = "";
                                                }
                                                
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td>$row->SenderName</td>
                                                        <td>$row->MailTitle</td>
                                                        <td>$row->MailContent</td>
                                                        <td>
                                                        <center>
                                                        <span class='label label-success'>$row->sentDate</span>
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                        $isRead
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-block btn-primary' data-toggle='modal' data-target='#view-modal".$row->IdMail."'>View Mail</a></center></td>
                                                    </tr>
                                                ";
                                                 $no++;
                                            
                                                echo 
                                                "
                                                    <div class='modal fade' id='view-modal".$row->IdMail."' tabindex='-1' role='dialog' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                    <h4 class='modal-title'><i class='fa fa-envelope-o'></i>".$data[view_title]."</h4>
                                                                </div>
                                                                <form role='form' method='post' action=''>
                                                                    <div class='modal-body'>
                                                                        <div class='form-group'>
                                                                            <div class='input-group'>
                                                                                <span class='input-group-addon'>Sender:</span>
                                                                                <input name='SenderName' id='SenderName' type='text' class='form-control' value='".$row->SenderName."' disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <div class='input-group'>
                                                                                <span class='input-group-addon'>Subject:</span>
                                                                                <input name='MailTitle' id='MailTitle' type='text' class='form-control' value='".$row->MailTitle."' disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <textarea name='MailContent' id='MailContent' class='form-control' style='height: 120px;' disabled>".$row->MailContent."</textarea>
                                                                        </div>


                                                                    </div>
                                                                    <div class='modal-footer clearfix'>
                                                                        <input type='hidden' name='IdMail' id='IdMail' value='".$row->IdMail."'/>
                                                                        <button type='button' class='btn' data-dismiss='modal'> Close</button>
                                                                        ".$markReadButton."
                                                                        ".$markUnreadButton."
                                                                        ".$archiveButton."
                                                                        ".$unarchiveButton."
                                                                        ".$deleteButton."                                                                        
                                                                    </div>
                                                                    <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ";
                                            
                                            } echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_INBOX_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="out">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_outbox']){ ?>
                                <table id="outbox" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Receiver <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Mail Title</th>
                                            <th>Mail Content</th>
                                            <th><center>Sent Date</center></th>
                                            <th><center>Is Read ?</center></th>
                                            <th><center>Is Archived ?</center></th>
                                            <th><center>Is Deleted ?</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_outbox'] as $row) 
                                            {
                                                if ($row->isRead == '1') {
                                                    $isRead = "<span class='label label-success'>Yes</span>";
                                                } else {
                                                    $isRead = "<span class='label label-danger'>No</span>";
                                                }
                                                if ($row->isArchived == '1') {
                                                    $isArchived = "<span class='label label-success'>Yes</span>";
                                                } else {
                                                    $isArchived = "<span class='label label-danger'>No</span>";
                                                }
                                                if ($row->isDeleted == '1') {
                                                    $isDeleted = "<span class='label label-success'>Yes at ".$row->nDeletedDate."</span>";
                                                } else {
                                                    $isDeleted = "<span class='label label-danger'>No</span>";
                                                }
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td>$row->ReceiverName</td>
                                                        <td>$row->MailTitle</td>
                                                        <td>$row->MailContent</td>
                                                        <td>
                                                        <center>
                                                        <span class='label label-info'>$row->sentDate</span>
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                        $isRead
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                        $isArchived
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                        $isDeleted
                                                        </center>
                                                        </td>
                                                    </tr>
                                                ";
                                                 $no++;
                                            } 
                                        ?>
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_OUTBOX_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="archived">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <?php if ($data['get_mail_archived']){ ?>
                                <table id="archive-mail" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Sender <i class="fa fa-sort-alpha-asc"></i></th>
                                            <th>Mail Title</th>
                                            <th>Mail Content</th>
                                            <th><center>Sent Date</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data['get_mail_archived'] as $row) 
                                            {
                                                if ($row->isRead == '1') {
                                                    $isRead = "<span class='label label-success'>Read</span>";
                                                } else {
                                                    $isRead = "<span class='label label-danger'>Unread</span>";
                                                }

                                                if ($row->isArchived == '1') {
                                                    $unarchiveButton =  "<button type='input' name='submit' value='UnArchived' class='btn btn-success pull-left'><i class='fa fa-archive'></i> Unarchive Mail</button>";
                                                    $deleteButton = "<button type='input' name='submit' value='IsDeleted' class='btn btn-danger pull-left'><i class='fa fa-ban'></i> Delete Mail</button>";
                                                } 
                                                
                                                echo 
                                                "
                                                    <tr>
                                                        <td><center>$no</center></td>
                                                        <td>$row->SenderName</td>
                                                        <td>$row->MailTitle</td>
                                                        <td>$row->MailContent</td>
                                                        <td>
                                                        <center>
                                                        <span class='label label-success'>$row->sentDate</span>
                                                        </center>
                                                        </td>
                                                        <td>
                                                        <center>
                                                        $isRead
                                                        </center>
                                                        </td>
                                                        <td><center><a class='btn btn-block btn-primary' data-toggle='modal' data-target='#view-modal".$row->IdMail."'>View Mail</a></center></td>
                                                    </tr>
                                                ";
                                                 $no++;
                                            
                                                echo 
                                                "
                                                    <div class='modal fade' id='view-modal".$row->IdMail."' tabindex='-1' role='dialog' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                    <h4 class='modal-title'><i class='fa fa-envelope-o'></i>"._VIEW_TITLE_LANG_."</h4>
                                                                </div>
                                                                <form role='form' method='post' action=''>
                                                                    <div class='modal-body'>
                                                                        <div class='form-group'>
                                                                            <div class='input-group'>
                                                                                <span class='input-group-addon'>Sender:</span>
                                                                                <input name='SenderName' id='SenderName' type='text' class='form-control' value='".$row->SenderName."' disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <div class='input-group'>
                                                                                <span class='input-group-addon'>Subject:</span>
                                                                                <input name='MailTitle' id='MailTitle' type='text' class='form-control' value='".$row->MailTitle."' disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <textarea name='MailContent' id='MailContent' class='form-control' style='height: 120px;' disabled>".$row->MailContent."</textarea>
                                                                        </div>


                                                                    </div>
                                                                    <div class='modal-footer clearfix'>
                                                                        <input type='hidden' name='IdMail' id='IdMail' value='".$row->IdMail."'/>
                                                                        <button type='button' class='btn' data-dismiss='modal'> Close</button>

                                                                        ".$unarchiveButton."
                                                                        ".$deleteButton."  
                                                                    </div>
                                                                    <input type='hidden' name='".$data["CSRF_TOKEN_NAME"]."' value='".$data['CSRF_TOKEN_VALUE']."'/>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ";
                                            
                                            } ?> 
                                        <?php echo "</tbody></table>"; ?>
                                        <?php } else { ?>
                                            <span class='badge bg-red'><?php echo _NO_ARCHIVE_DATA_LANG_;?></span>
                                        <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->   
        </div>
                    
</section><!-- /.content -->


        <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> <?php echo _COMPOSE_TITLE_LANG_;?></h4>
                    </div>
                    <form role="form" method="post" action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">TO:</span>
                                    <?php if ($data['user_lists']){ ?>
                                    <select name="ReceiverId" id="ReceiverId" class="form-control" >
                                        <option value="++" selected>Select User Recepient</option>
                                        <?php 
                                            foreach ($data['user_lists'] as $row) { 
                                                     
                                                    echo 
                                                        "<option value=$row->IdUser>$row->FullName</option>"
                                                    ;
                                                    
                                                        
                                               } 
                                        ?>
                                    </select>
                                    <?php } else { ?>
                                        <select name="ReceiverId" id="ReceiverId" class="form-control" disabled>
                                            <option value="" selected>There is currently no User Data !</option>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Subject:</span>
                                    <input name="MailTitle" id="MailTitle" type="text" class="form-control" placeholder=" Mail Title" value="<?php echo $_POST['MailTitle'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="MailContent" id="MailContent" class="form-control" placeholder="Mail Content" style="height: 120px;"><?php echo $_POST['MailContent'];?></textarea>
                            </div>


                        </div>
                        <div class="modal-footer clearfix">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type='input' name='submit' value='Compose' class='btn btn-success pull-left'><i class="fa fa-envelope"></i> Compose Message</button>
                        </div>

                        <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->