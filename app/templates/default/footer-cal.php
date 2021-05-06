<?php
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ----------------
*
* @file       app/templates/default/footer-cal.php
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
<section class="content">
<hr />
<div class="row">
    <div class="col-lg-12">
    <p align="right">
        &copy; <?php echo date('Y'); ?> <?php echo BARTITLE; ?> 
        <br />
        <?php
        //PAGE RENDERED
        $timeStart = microtime(true);
        usleep(100);
        $timeEnd = microtime(true);
        $time = round(($timeEnd - $timeStart), 4);
        echo 'Page rendered in <b>'.$time.' seconds</b>';
        ?>
    </p>RG93bmxvYWRlZCBmcm9tIENPREVMSVNULkND
    </div>
</div>
</section>
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<?php echo $data['js']."\n";?>

<?php echo $data['jq']."\n";?>


<!-- CALENDAR -->
<script type='text/javascript'>
jQuery(document).ready(function() {
var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();
var calendar = jQuery('#bigCalendar').fullCalendar({
header: 	{
left: 'prev,next today',
center: 'title',
right: ''
		},
buttonText: {
	prev: '&laquo;',
	next: '&raquo;',
	prevYear: '&nbsp;&lt;&lt;&nbsp;',
	nextYear: '&nbsp;&gt;&gt;&nbsp;',
	today: 'today'
},
events: "<?php echo DIR;?>app/core/event.php",
eventAfterRender: function (calEvent, element) {
				var find = '<span class="fc-event-title">';
				var replace = find + '<span style="background-color:'+ calEvent.label +';"class="label">' + calEvent.description + '</span> ';
				var newHTML = $(element).html().replace(find, replace);
				$(element).html(newHTML);
		},
eventClick: function(calEvent, jsEvent, view) {
			window.location = "<?php echo DIR;?>admin/project/view/" + calEvent.id;

		}
	});
});
</script>
<!-- END CALENDAR -->

<!-- CLOCK -->
<script type="text/javascript">
	function startTime() {
		var today=new Date(),
		curr_hour=today.getHours(),
		curr_min=today.getMinutes(),
		curr_sec=today.getSeconds();
		curr_hour=checkTime(curr_hour);
		curr_min=checkTime(curr_min);
		curr_sec=checkTime(curr_sec);
		document.getElementById('clock').innerHTML=curr_hour+":"+curr_min+":"+curr_sec;
	}
	function checkTime(i) {
		if (i<10) {
			i="0" + i;
		}
		return i;
	}
	setInterval(startTime, 500);
</script>
<!-- END CLOCK -->


<!-- fullCalendar -->
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!-- jQuery UI 1.10.3 -->
<script src="<?php echo \helpers\url::get_template_path();?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="<?php echo \helpers\url::get_template_path();?>js/bootstrap.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo \helpers\url::get_template_path();?>js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="<?php echo \helpers\url::get_template_path();?>js/app/app.js" type="text/javascript"></script>



</body>
</html>
