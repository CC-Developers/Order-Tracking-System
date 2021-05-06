<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ---------------- 
*
* @file       error/404.php
 * @package    Work Order Tracking System
 * @author     Comestoarra Labs <hello@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.0@
 * @link       http://wots.comestoarra.com/v1/
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $data['title'].' - '.BARTITLE; //BARTITLE defined in index.php?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo \helpers\url::get_template_path();?>css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

          
                    <div class="error-page">
                        <h2 class="headline text-info"> <?php echo $data['title'];?></h2>
                        <br />
                        <br />
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                            <p>
                                <?php echo $data['error'];?>
                            </p>
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->

<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo \helpers\url::get_template_path();?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>