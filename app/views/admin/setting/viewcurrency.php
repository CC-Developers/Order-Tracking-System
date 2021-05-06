<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file        app/views/admin/setting/viewcurrency.php
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
            <li class="active"><?php echo _VIEW_CURRENCY_LANG_; ?></li>
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
                if(Session::get(successUpdatedCurrency) == '1') {
                    echo "<div class='alert alert-success alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>"._SUCCESS_LANG_."</b> "._SUCCESS_UPDATE_CURRENCY_LANG_."
                                </div>";
                    Session::pull(successUpdatedCurrency);
                }
        ?>
        <?php
            if (Session::get(InvalidCurrency) == '1') {
                echo "<div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <b>"._ERROR_LANG_."</b> "._ERROR_INVALID_CURRENCY_DATA_LANG_."
                                </div>";
                Session::pull(InvalidCurrency);
            } else {
        ?>
        
            
            <div class="col-lg-12"> 
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo _FORM_UPDATE_CURRENCY_LANG_;?></h3> 
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form enctype="multipart/form-data" role="form" method="post" action="">

                       <div class="form-group">
                            <label>Currency Name</label>
                            <input type="text" name="CurrencyNameOld" id="CurrencyNameOld" class="form-control" value="<?php echo $data['CurrencyName'];?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label>Change Currency Name</label>                                         
                            <input type="text" name="CurrencyName" id="CurrencyName" class="form-control phasecolor" placeholder="Leave blank if not changed !" value="<?php echo $_POST['CurrencyName'];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Currency Symbol</label>
                            <input type="text" name="CurrencySymbolOld" id="CurrencySymbolOld" class="form-control" value="<?php echo $data['CurrencySymbol'];?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label>Change Currency Symbol</label>
                            <input type="text" name="CurrencySymbol" id="CurrencySymbol" class="form-control" placeholder="Leave blank if not changed !" value="<?php echo $_POST['CurrencySymbol'];?>"/>
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
                            <input type="hidden" name="CurrencyId" id="CurrencyId" value="<?php echo $data['CurrencyId']; ?>"/>
                            <input type="hidden" name="CurrencyNameOld" id="CurrencyNameOld" value="<?php echo $data['CurrencyName']; ?>"/>
                            <input type="hidden" name="CurrencySymbolOld" id="CurrencySymbolOld" value="<?php echo $data['CurrencySymbol']; ?>"/>
                            <button type='input' name='submit' value='Update' class='btn btn-success'><i class="fa fa-check-square-o"></i> Update Currency</button>
                            <!-- ONLY SUPER USER LEVEL ALLOWED -->
                            <?php if(Session::get(Level) == '1'){ ?>
                                <button type="input" name="submit" value="x" class="btn btn-danger alignright" onclick="return confirm('Permanently DELETE the Currency <?php echo $data['CurrencyName']; ?>? This action is NOT reversible once completed.');"><i class="fa fa-ban"></i> Delete Currency</button>
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


