<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]>
<!--> 
<html class=""> 
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="keywords" content="Lee Wee">

	<!-- Mobile Viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Force IE to render best possible view -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- FONT -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo LIB ?>/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo LIB ?>/bootstrap/dist/css/bootstrap-theme.min.css" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	<?php
		wp_head();
	?>
</head>
<body>
	<!-- <div class="image-bg">
		<div class="top-bg"></div>
		<div class="middle-bg"></div>
	</div> -->
	<div id="page-wrapper">
	  <div id="header-wrapper" class="container-fluid">
	    <header id="main-header" class="container">
	      <div class="row">
	        <div class="col-md-3">
	          <button class="search-btn"></button>
	          <input type="text" id="search" name="search" placeholder="SEARCH" />
	        </div>
	        
	        <div class="col-md-4 col-md-offset-5">
	          <div class="header-content">
	            <div id="header-links">
				 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('JOIN','woothemes'); ?>"><?php _e('JOIN','woothemes'); ?></a> / 
				 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('SIGN IN','woothemes'); ?>"><?php _e('SIGN IN','woothemes'); ?></a>
	            	<!-- <a href="join.shtml" class="join">JOIN</a> / <a href="login.shtml" class="sign-in">SIGN IN</a> -->
	            </div>
	            <div id="header-cart-info">
	              <a href="<?php echo get_permalink( get_option('woocommerce_cart_page_id') ); ?>">
	                <div id="cart-icon"><img src="<?php echo IMAGES ?>/icons/cart-img.png" alt="Cart icon"><div class="white-divider"></div></div>  
	                <div id="cart-item-price">
	                  <span class="cart-items-count">0</span><span class="cart-items-count-label"> ITEM(S) -</span> 
	                  <span class="cart-price-label">$</span><span class="cart-price">0.00</span>
	                </div> 
	              </a>
	            </div>
	          </div>
	        </div>
	      </div>
	    </header>
	  </div>

	  <div class="container-fluid" id="main-content">
	    <div class="container">
	      <div class="row">
	        <div class="col-md-4 col-md-offset-4 logo-container">
	          <a href="index.shtml"><img src="<?php echo IMAGES ?>/logo/main-logo.png" alt="Lee Wee Brothers Logo" class="main-logo"></a>
	        </div>
	      </div>
	      <div class="space20"></div>
	      <div class="row">
	        <div class="col-md-12 nav-container">
	          <hr class="nav-hr">
	          <nav class="main-nav">
	            <ul class="main-menu">
	              <li class="about">
	                <a href="#">ABOUT US</a>
	                <ul class="sub-menu">
	                  <li>
	                    <a href="#">Our Story</a>
	                  </li>
	                  <li>
	                    <a href="ourhistory.shtml">History</a>
	                  </li>
	                  <li>
	                    <a href="#">The Lee Wee Difference</a>
	                  </li>
	                  <li>
	                    <a href="foodphilosophy.shtml">Food Philosophy</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="food">
	                <a href="ourfood.shtml">OUR FOOD</a>
	                <ul class="sub-menu six">
	                  <li>
	                    <a href="otah.shtml">Otah</a>
	                  </li>
	                  <li>
	                    <a href="otah.shtml">Lunch Boxes</a>
	                  </li>
	                  <li>
	                    <a href="otah.shtml">Satay</a>
	                  </li>
	                  <li>
	                    <a href="otah.shtml">Snacks & Nibbles</a>
	                  </li>
	                  <li>
	                    <a href="otah.shtml">Local Flavours</a>
	                  </li>
	                  <li>
	                    <a href="otah.shtml">Condiments</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="catering">
	                <a href="#">CATERING</a>
	                <ul class="sub-menu two">
	                  <li>
	                    <a href="#">Mini Buffet</a>
	                  </li>
	                  <li>
	                    <a href="#">Others</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="delivery">
	                <a href="#">DELIVERY</a>
	                <ul class="sub-menu two">
	                  <li>
	                    <a href="deliverytime.shtml">Time Slots</a>
	                  </li>
	                  <li>
	                    <a href="terms.shtml">Terms & Conditions</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="outlets"><a href="ouroutlets.shtml">OUTLETS</a></li>
	              <li class="order">
	                <a href="#">ORDER ONLINE</a>
	                <ul class="sub-menu two">
	                  <li>
	                    <a href="#">Check Out & Payment</a>
	                  </li>
	                  <li>
	                    <a href="#">FAQs</a>
	                  </li>
	                </ul>
	              </li>
	              <li class="promo"><a href="promotions.shtml">PROMOTIONS</a></li>
	              <li class="career"><a href="careers.shtml">CAREERS</a></li>
	              <li class="contact"><a href="#">CONTACT</a></li>
	            </ul>
	          </nav>
	          <hr class="nav-hr">
	        </div>
	      </div>
	      <div class="space20"></div>
	    </div>
	  </div>
