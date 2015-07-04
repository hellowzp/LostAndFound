<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lost and Found</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Lost and Found Site">
<meta name="author" content="Wang">

<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
<link href="<?php echo base_url('css/style.css');?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<style type="text/css">
body {
	background-color: #E4D9C5;
}

.navbar-custom {
	background-color: #2c2c2c;
	background-image: -moz-linear-gradient(top, #EC4242, #772323);
	background-image: -ms-linear-gradient(top, #EC4242, #772323);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#EC4242), to(#772323));
	background-image: -webkit-linear-gradient(top, #EC4242, #772323);
	background-image: -o-linear-gradient(top, #EC4242, #772323);
	background-image: linear-gradient(top, #EC4242, #772323);
	background-repeat: repeat-x;
}

.navbar .brand {
	color: black;
	font-size: 22px;
}

.navbar .nav > li > a {
    color: black;
    font-size: 22px;
    text-decoration: none;
}

.active-custom {
	color: black;
    font-size: 22px;
    text-decoration: none;
    background-color: #962E2E;
}
</style>

</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner navbar-custom">
			<div class="container">

				<div class="span6" style="margin-left: 0; font-size: 24px;">
					<a class="brand text-custom" href="<?php echo site_url(); ?>">Lost and Found</a>
				</div>
		
				<div class="nav-collapse">
					<ul class="nav" style="margin-left: 100px;">
						<li class="active-custom"><a href="<?php echo site_url(); ?>">Home</a></li>
						<li><a class="text-custom" href="<?php echo site_url() . 'home/lost'; ?>">Lost</a></li>
						<li><a class="text-custom" href="<?php echo site_url() . 'home/found'; ?>">Found</a></li>
						<li><a class="text-custom" href="<?php echo site_url() . 'home/post'; ?>">Post</a></li>
						<li><a class="text-custom" href="#search">Search</a></li>
					</ul>
				</div>			
				
				<?php if ( !isset($_SESSION['username']) ) { ?>
					<div class="btn-group pull-right">
						<a class="btn" href="<?php echo site_url('login'); ?>"> <i
							class="icon-user"></i> Login <span class="caret"></span>
						</a>
					</div>
				<?php } else { ?>
					<div class="btn-group pull-right">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						    <i class="icon-user"></i> <?php echo $_SESSION['username']; ?>
						    <span class="caret"></span>
						</a>
						
						<ul class="dropdown-menu">
						    <li><a href="#">Profile</a></li>
						    <li class="divider"></li>
						    <li><a href="<?php echo site_url('logout'); ?>">Sign Out</a></li>
						</ul>
					</div>
				<?php } ?>
				
			</div>
		</div>
	</div>

	<div id="body">
		<div class="container">
			<div class="row">