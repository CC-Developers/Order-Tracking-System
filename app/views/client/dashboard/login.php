<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/views/client/dashboard/login.php
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
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <title><?php echo _LOGIN_LANG_.' - '.BARTITLE; //BARTITLE defined in index.php?></title>
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
    <body> 
         <div class="center">            
           
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
            
            <div class="lockscreen-name"><?php echo BARTITLE;?></div>
            <br />
            
            <div class="lockscreen-item">

                <div class="lockscreen-image">
                    <img src="<?php echo DIR;?>uploads/logo/login.png" alt=""/>
                </div>

                <div class="lockscreen-credentials">   
                <form action="" method="post">    
                    <div class="input-group">
                        <input type="text" name="username" class="form-control" value="<?php echo $_POST['username'];?>" placeholder="Username"/>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $_POST['password'];?>"/>
                        <div class="input-group-btn">
                            <button type="submit" name="submit" value="Secure Login" class="btn btn-flat"><i class="fa fa-arrow-right text-muted"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="<?php echo $data['CSRF_TOKEN_NAME']; ?>" value="<?php echo $data['CSRF_TOKEN_VALUE']; ?>"/>

                </form>
                </div>

            </div>

            <div class="lockscreen-link">
                <a style="color:#fff;" href='<?php echo DIR;?>forgot'><?php echo _FORGOT_LANG_;?></a>
            </div> RE9XTkxPQURFRCBGUk9NIENPREVMSVNULkND           
        </div><!-- /.center -->

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo \helpers\url::get_template_path();?>js/bootstrap.min.js" type="text/javascript"></script>  
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $(".center").center();
                $(window).resize(function() {
                    $(".center").center();
                });
            });

            /* CENTER ELEMENTS IN THE SCREEN */
            jQuery.fn.center = function() {
                this.css("position", "absolute");
                this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
                        $(window).scrollTop()) - 30 + "px");
                this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                        $(window).scrollLeft()) + "px");
                return this;
            }
        </script>
    </body>

    </body>
</html>