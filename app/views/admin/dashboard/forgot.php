<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/admin/dashboard/forgot.php
 * @package    Advanced Work Order Tracking System
 * @author     Comestoarra Labs <labs@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.1@
 * @link       http://comestoarra.com
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo _FORGOT_LANG_.' - '.BARTITLE; //BARTITLE defined in index.php?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
    <body class="bg-black">

        <div class="form-box" id="login-box">
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
            <div class="header"><?php echo _FORGOT_HEADER_LANG_;?></div>
            <form action="" method="post">
                <div class="body bg-gray">
                    <p align="center">
                        <?php echo "<b>"._IP_LANG_." : </b>".$data['ip'];?>
                    </p>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" value="<?php echo $_POST['email'];?>" placeholder="Your Email"/>
                    </div>         
                </div>
                <div class="footer">                                                               
                    <input type="submit" name="submit" value="Recover My Password" class="btn bg-black btn-block">
                </div>

                <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

            </form>

            <div class="margin text-center">
                <span><a style="color:#fff;" href='<?php echo DIR;?>admin/login'><?php echo _FORGOT_BACK_LANG_;?></a></span>
                <br/>

            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo \helpers\url::get_template_path();?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>