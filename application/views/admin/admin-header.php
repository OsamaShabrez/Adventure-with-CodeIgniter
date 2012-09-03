<!DOCTYPE html5>
<html>
  <head>
    <title>
      <?php if( $title != "") echo $title.' &raquo; '; ?>GreenTel</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>fav-icon.ico" type="image/ico">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascript/boxOver.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascript/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascript/livevalidation.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  </head>
  <body>
    <div id="main_container">
      <div class="top_bar">
      </div>
      <div id="header">
	<div id="logo">
	  <a href="index.html"><img src="<?php echo base_url(); ?>images/logo.png" alt="" title="" border="0" width="237" height="140" /></a>
	</div>
      </div>
    <div id="main_content">
      <div id="menu_tab">
	<div class="left_menu_corner">
	</div>
      <ul class="menu">
	<li><a href="<?php echo base_url(); ?>admin/index.html" class="nav1">Admin Panel</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>admin/check-status.html" class="nav3">Check Status</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>admin/manage-stock.html" class="nav2">Manage Stock</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>admin/manage-products.html" class="nav2">Manage Products</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>admin/manage-orders.html" class="nav5">Manage Orders</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>admin/profile.html" class="nav4">Profile</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>admin/logout.html" class="nav4">Logout</a></li>
      </ul>
      <div class="right_menu_corner">
      </div>
    </div><!-- end of menu tab -->
    <div class="left_content">
	<div class="banner_adds">
	</div>
    </div><!-- end of left content -->
    <div class="center_content">
        <div class="center_title_bar"><?php echo $title; ?></div>