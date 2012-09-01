<!DOCTYPE html5>
<html>
  <head>
    <title>
      <?php if( $title != "") echo $title.' &raquo; '; ?>GreenTel</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>fav-icon.ico" type="image/ico">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascript/boxOver.js"></script>
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
	<div class="oferte_content">
	  <div class="top_divider">
	    <img src="<?php echo base_url(); ?>images/header_divider.png" alt="" title="" width="1" height="164" />
	  </div>
	<div class="oferta">
	  <div class="oferta_content">
	    <img src="<?php echo base_url(); ?>images/laptop.png" width="94" height="92" border="0" class="oferta_img" />
	    <div class="oferta_details">
	      <div class="oferta_title">Samsung GX 2004 LM</div>
		<div class="oferta_text">
		  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
		</div>
	      <a href="details.php" class="details">details</a>
	    </div>
	  </div>
	  <div class="oferta_pagination">
	    <span class="current">1</span>
	    <a href="#?page=2">2</a>
	    <a href="#?page=3">3</a>
	    <a href="#?page=3">4</a>
	    <a href="#?page=3">5</a>  
	  </div>        
	</div>
	<div class="top_divider">
	  <img src="<?php echo base_url(); ?>images/header_divider.png" alt="" title="" width="1" height="164" />
	</div>
      </div> <!-- end of oferte_content-->
    </div>
    <div id="main_content">
      <div id="menu_tab">
	<div class="left_menu_corner">
	</div>
      <ul class="menu">
	<li><a href="<?php echo base_url(); ?>index.html" class="nav1">Home</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>page/privacy-policy.html" class="nav2">Privacy Policy</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>page/how-to-order.html" class="nav3">How to Order</a></li>
	<li class="divider"></li>
	<?php
	  if($loggedin) {
	    echo '<li><a href="' . base_url() . '/my-account.html" class="nav4">My account</a></li>';
	    echo '<li class="divider"></li>';
	    echo '<li><a href="' . base_url() . 'page/logout.html" class="nav4">Logout</a></li>';
	  } else {
	    echo '<li><a href="' . base_url() . 'page/sign-in.html" class="nav4">Sign In</a></li>';
	    echo '<li class="divider"></li>';
	    echo '<li><a href="' . base_url() . 'page/sign-up.html" class="nav4">Sign Up</a></li>';
	  }
	?>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>page/shipping-returns.html" class="nav5">Shipping/Returns</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>page/contact-us.html" class="nav6">Contact Us</a></li>
	<li class="divider"></li>
	<li><a href="<?php echo base_url(); ?>page/about.html" class="nav6">About</a></li>
      </ul>
      <div class="right_menu_corner">
      </div>
    </div><!-- end of menu tab -->
    <div class="left_content">
      <div class="title_box">Categories</div>
	<ul class="left_menu">
        <?php
            $odd_even = false;
            foreach( $categories as $category ):
                if($odd_even) {
                    echo "<li class='even'><a href='" . base_url() . "category/{$category['slug']}.html'>{$category['name']}</a></li>";
                    $odd_even = false;
                } else {
                    echo "<li class='odd'><a href='"  . base_url() . "category/{$category['slug']}.html'>{$category['name']}</a></li>";
                    $odd_even = true;
                }
            endforeach;
        ?>
	</ul>
	<div class="banner_adds">
	  <a href="#"><img src="<?php echo base_url(); ?>images/bann2.jpg" alt="" title="" border="0" /></a>
	</div>
      </div><!-- end of left content -->
      <?php if( isset($msg) && $msg != "") echo $msg; ?>