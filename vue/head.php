<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title> --= La vallée du Valhalla =-- </title>
  <!-- Bootstrap core CSS -->
  <link href="<?php echo $HOME ?>css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap theme -->
  <link href="<?php echo $HOME ?>css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="<?php echo $HOME ?>css/bootstrap-switch.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?php echo $HOME ?>css/test.css" rel="stylesheet">

  <link href="<?php echo $HOME ?>css/raspcontrol.css" rel="stylesheet" media="screen" />
  <link href="<?php echo $HOME ?>css/theme.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Valhalla</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
				<!-- NavSection -->
				<?php include_once('controleur/nav_bar.php');  ?>
				</ul>
				<!-- Full Link -->
				<?php if (isset($parameters['page'])) GetFullLink($parameters['page']); ?>
			</div><!-- nav-collapse -->
		</div>
	</div>
	<div id='vignette' style='cursor:pointer;position:absolute;display:none' ></div>
	<div id="body" class="container-fluid">
