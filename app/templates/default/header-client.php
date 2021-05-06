<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ---------------- 
*
* @file       app/templates/default/header-client.php
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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo BARTITLE; //BARTITLE defined in index.php?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/datepicker.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap time Picker -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/style.css" rel="stylesheet" type="text/css" />
        <!-- Favicon: Thanks to favicon.cc -->
        <link rel="shortcut icon" href="<?php echo \helpers\url::get_template_path();?>ico/favicon.ico">
        <!-- End Favicon -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
    </head>
    <body class="skin-black pace-done fixed">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo DIR;?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo SITETITLE; //SITETITLE defined in index.php?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo(Session::get(FullName)); ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-black">
                                    <?php if (Session::get(ProfilePicture) != '') { ?>
                                        <img src="<?php echo DIR;?>uploads/clients/small_<?php echo Session::get(ProfilePicture);?>" class="img-circle" alt="<?php echo(Session::get(FullName)); ?>"/> 
                                    <?php } else { ?>
                                        <img src="<?php echo \helpers\url::get_template_path();?>img/avatar3.png" class="img-circle" alt="<?php echo(Session::get(FullName)); ?>" />
                                    <?php } ?>
                                    <p>
                                        <?php 
                                            echo(Session::get(FullName)); 
                                        ?> - 
                                        Client
                                        <small><?php echo(Session::get(LastLoginIP)); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <center>
                                    <?php if (Session::get(IsLogin)!='0'){ ?>
                                        <a><i class="fa fa-circle text-success"></i> <?php echo _ONLINE_STATUS_LANG_;?></a>
                                    <?php } else { ?>
                                        <a><i class="fa fa-circle text-danger"></i> <?php echo _OFFLINE_STATUS_LANG_;?></a>
                                    <?php } ?>
                                    </center>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href='<?php echo DIR;?>profile' class="btn btn-default btn-flat"><?php echo _PROFILE_LANG_;?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href='<?php echo DIR;?>logout' onclick='return confirm("<?php echo(Session::get(FullName)); ?>, <?php echo _CONFIRM_SIGN_OUT_LANG_;?>")' class='btn btn-default btn-flat'><?php echo _SIGN_OUT_LANG_;?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar"> 

                <!-- <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                        <span class="input-group-btn">
                            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form> -->

                <div class="datebar">
                    <small><?php echo date('l'). ", " .date('jS \of F, Y'); ?></small><br />
                    <h1 align="center"><div id="clock"></div></h1>
                </div>
                
                <ul class="sidebar-menu">
                    
                        <li class='<?php echo $data[active];?>'>
                            <a href='<?php echo DIR;?>'>
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href='<?php echo DIR;?>profile'>
                                <i class="fa fa-user"></i> <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href='<?php echo DIR;?>about'>
                                <i class="fa fa-question"></i> <span>About Applications</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>