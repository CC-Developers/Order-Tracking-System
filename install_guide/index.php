<?php 
error_reporting( 0 );
ini_set( 'display_errors', FALSE );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head lang="en">
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>Advanced Work Order Tracking System v.1.1</title>
	<!-- Framework CSS -->
	<link rel="stylesheet" href="assets/blueprint-css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="assets/blueprint-css/print.css" type="text/css" media="print">
	<link rel="stylesheet" href="assets/prism.css" data-noprefix>
	<!--[if lt IE 8]><link rel="stylesheet" href="assets/blueprint-css/ie.css" type="text/css" media="screen, projection"><![endif]-->
	<link rel="stylesheet" href="assets/blueprint-css/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
	<style type="text/css" media="screen">
		p, table, hr, .box { margin-bottom:25px; }
		.box p { margin-bottom:10px; }
	</style>
</head>


<body>
	<div class="container">
	
		<h3 class="center alt">&ldquo;Advanced Work Order Tracking System &rdquo; Documentation by &ldquo;Comestoarra Labs&rdquo; v1.1</h3>
		
		<hr>
		
		<h1 class="center"><img src="assets/images/cta.png" alt="_comestoarra_labs_" /><br />&ldquo;Advanced Work Order Tracking System&rdquo;</h1>
		
		<div class="borderTop">
			<div class="span-6 colborder info prepend-1">
				<p class="prepend-top">
					<strong>
					Created: 11/09/2014<br>
					Updated: 15/09/2014<br>
					By: Comestoarra Labs<br>
					Email: <a href="mailto:labs@comestoarra.com">labs@comestoarra.com</a>
					</strong>
				</p>
			</div><!-- end div .span-6 -->		
	
			<div class="span-12 last">
				<p class="prepend-top append-0">Thank you for purchasing my application. If you have any questions that are beyond the scope of this help file, please feel free to email via my user page contact form <a href="http://codecanyon.net/user/comestoarra-labs" target="_blank">here</a>. Thanks so much!</p>
			</div>
		</div><!-- end div .borderTop -->
		
		<hr>
		
		<h2 id="toc" class="alt">Table of Contents</h2>
		<ol class="alpha">
			<li><a href="#check">Installation Check</a></li>
			<li><a href="#installcheck">System Check</a></li>
			<li><a href="#installation">Installation Guide</a></li>
			<li><a href="#config">Configurations</a></li>
			<li><a href="#Structures">Files and Structure</a></li>
			<li><a href="#credits">Sources and Credits</a></li>
		</ol>

		<hr>

		<h3 id="installcheck"><strong>A) Installation Check</strong> - <a href="#toc">top</a></h3>
		<?php
		include "../app/core/_comestoarra_labs_.php";
		 if (!file_exists("../app/core/_comestoarra_labs_")) {
			echo "<div class='error'>ALERT ! You are NOT READY to use this APP, Please follow <a href='#installation'>THIS INSTALLATION GUIDE</a></div>";
		}else{
			echo "<div class='success'><h3>Congratulations, You can <a href='".DIR."admin'>LOGIN HERE</a></h3></div>";
		} 
		
		?>
		
		<hr>
		
		<h3 id="check"><strong>B) System Check</strong> - <a href="#toc">top</a></h3>
		<?php
		if(phpversion() < "5.3"){
			echo "<div class='error'>Your PHP version is ".phpversion()."! PHP 5.3 or higher required!</div>";
		}else{
			echo "<div class='success'>You are running PHP ".phpversion()."</div>";
		} 

		if(phpversion() > "7.0"){
			echo "<div class='error'>Your PHP version is ".phpversion()."! this version currently does not supported PHP 7.X!</div>";
		}
		
		if(!extension_loaded('mysqli')){
			echo "<div class='error'>Mysqli PHP exention missing!</div>";
		}else{
			echo "<div class='success'>Mysqli PHP exention loaded!</div>";
		}
		
    	if(!is_writeable("../app/core")){
			echo "<div class='error'>/app/core folder is not writeable!</div>";
		}else{
			echo "<div class='success'>/app/core folder is writeable!</div>";
		}

		if(!is_writeable("../uploads")){
			echo "<div class='error'>/uploads folder is not writeable!</div>";
		}else{
			echo "<div class='success'>/uploads folder is writeable!</div>";
		}
		?>
		
		<hr>

		<h3 id="installation"><strong>C) Installation Guide</strong> - <a href="#toc">top</a></h3>
		<p>1. Firstly, create new database from phpmyadmin with name : <b>awots</b>.</p>
		<p align="center"><img src="assets/images/create_db.png" width="600" height="150"alt="" /></p>
		<br />

		<p>2. After that, open <b>app/core/_comestoarra_labs_.php</b>, and type your <b>DB_HOST</b>, <b>DB_NAME</b>, <b>DB_USER</b>, <b>DB_PASS</b>, and <b>DIR</b>.</p>
		<?php $config_contents = file_get_contents('assets/_comestoarra_labs_.php'); ?>
		<pre data-line="12,18-21"><code class="language-php"><?php echo $config_contents;?></code></pre>
		<br />

		<p>3. If you install in subdomain / folder, open <b>.htaccess</b> file, and type your <b>FOLDER-NAME</b>, at <b>RewriteBase /FOLDER-NAME/</b>.</p>
		<?php $htaccess_contents = file_get_contents('../.htaccess'); ?>
		<pre data-line="6"><code class="language-php"><?php echo $htaccess_contents;?></code></pre>
		<br />

		<p>4. <b>COPY</b> this <b>SQL FILE</b>, and <b>PASTE</b> in <b>PHPMYADMIN SQL QUERY</b>.</p>
		<p align="center"><img src="assets/images/sql.jpg" /></p>
		<br />
		<?php $file_contents = file_get_contents('awots.sql'); ?>
		<pre><code style="overflow: scroll;max-height: 30em;display: block;" class="language-php"><?php echo $file_contents;?></code></pre>
		<br />

		<form action="action.php" method="post">

          <fieldset>
            <legend>5. PASTE INTO PHPMYADMIN SQL QUERY &amp; HIT FINISH BUTTON</legend>
            <p align="center"><img src="assets/images/sql.jpg" /></p>
            <p align="center">
			<?php 
			if (!file_exists("../app/core/_comestoarra_labs_")) { 
              echo "<strong style='font-size: 20px;'> Click Here if Finished  </strong> <br> >>>> <input style='cursor:pointer; background-color: green;height: 50px;width: 300px;font-size: 30px;' class='btn btn-lg' type='submit' value='FINISH !'> <<<<";
			 } else { 
			  echo "<div class='success'><h3>Congratulations, You can <a href='".DIR."admin'>LOGIN HERE</a></h3></div>";
			} 
			?>
            </p>

          </fieldset>
        </form>
        <br/>

		<p>6. Go to <b><a href='<?php echo DIR;?>admin'>ADMIN LOGIN PAGE</a></b> on your browser. If the steps are <b>CORRECT</b>, you can see <b>LOGIN PAGE</b>.</p>
		<p align="center"><img src="assets/images/login.png" width="600" height="400"alt="" /></p>
		
		<p align="center"><img src="assets/images/dashboard.png" width="800" height="400"alt="" /></p>
		<p align="center"><b>THAT'S ALL !</b></p>
		
		<p>7. One <b><font color="red">IMPORTANT</font></b> thing : through the installation process, we create one file named <b>_comestoarra_labs_</b> with no extention at <b>app/core/</b> folder. <b><font color="red">REMEMBER, DO NOT DELETE THIS FILE !</font></b>.</p>
		<p align="center"><img src="assets/images/dontdelete.jpg" width="267" height="251"alt="" /></p>
		
		<p>8. If you have problems due to installation process, please feel free to email via my user page contact form <a href="http://codecanyon.net/user/comestoarra-labs">here</a> or <a href="mailto:labs@comestoarra.com">labs@comestoarra.com</a></p>

		
		<hr>
		
		<h3 id="config"><strong>D) Configurations</strong> - <a href="#toc">top</a></h3>
		<p>You can define your own code such as, <b>WO_CODE</b>, <b>SITETITLE</b>, <b>BARTITLE</b>, <b>SITEMAIL</b>, and <b>TIMEZONE</b>. You just change the code definition at <b>app/core/_comestoarra_labs_.php</b> file with whatever you want. The code will use primary id on tables with auto_increment mode. For example:
		</p>
		<?php $config_contents = file_get_contents('assets/_comestoarra_labs_.php'); ?>
		<pre data-line="15,27,28,31,34"><code class="language-php"><?php echo $config_contents;?></code></pre>
		<br />
			
		<hr>
		
		<h3 id="Structures"><strong>E) Files and Structure</strong> - <a href="#toc">top</a></h3>
		<p>The file is separated into sections using:</p>  

<pre>
<b>awots</b>
├───<b>app</b>
│   ├───controllers
│   ├───core
│   ├───helpers
│   └───models
│   └───templates
│   └───views
└───<b><font color="red">install_guide</font></b>
├───<b>uploads</b>
├───<b>vendor</b>
└──────.htaccess
└──────composer.json
└──────index.php
└──────README.md
</pre>

		<hr>
		
		<h3 id="credits"><strong>F) Sources and Credits</strong> - <a href="#toc">top</a></h3>
		
		<p>I've used the following icons, favicon, Charts, Calendar or other files as listed.
		
		<ul>
			<li>Thank's to BOOTSTRAP - <a href="http://www.getbootstrap.com" target="_blank">www.getbootstrap.com</a></li>
			<li>Thank's to SMVC PHP FRAMEWORK - <a href="http://www.simplemvcframework.com" target="_blank">www.simplemvcframework.com</a></li>
			<li>Thank's to Clock Face - <a href="http://vitalets.github.io/clockface" target="_blank">www.vitalets.github.io/clockface</a></li>
			<li>Thank's to Font Awesome - <a href="http://fontawesome.io/icons/" target="_blank">www.fontawesome.io</a></li>
			<li>Thank's to Icon Archive - <a href="http://www.iconarchive.com" target="_blank">www.iconarchive.com</a></li>
			<li>Thank's to Favicon - <a href="http://www.favicon.cc" target="_blank">www.favicon.cc</a></li>
			<li>Thank's to Highchart - <a href="http://www.highcharts.com" target="_blank">www.highcharts.com</a></li>
			<li>Thank's to Full Calendar - <a href="http://www.arshaw.com/fullcalendar/" target="_blank">www.arshaw.com/fullcalendar/</a></li>

		</ul>
		
		<hr>
		
		<p>Once again, thank you so much for purchasing this application. As I said at the beginning, I'd be glad to help you if you have any questions relating to this application. No guarantees, but I'll do my best to assist. If you have a more general question relating to the application on CodeCanyon, you might consider visiting the forums and asking your question in the "Item Discussion" section.</p> 
		
		<p class="append-bottom alt large"><strong>Comestoarra Labs</strong></p>
		<p><a href="#toc">Go To Table of Contents</a></p>
		
		<hr class="space">
	</div><!-- end div .container -->
	<script src="assets/prism.js"></script>
</body>
</html>