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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo CSS ?>/jquery.jscrollpane.css">

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
	        <div class="col-xs-9 col-sm-9 col-md-3 col-lg-3">
	        	<div class="row visible-xs visible-sm hidden-md hidden-lg">
	        		<div class="col-xs-3">
						<i class="fa fa-bars icon-font mobile-menu-btn"></i>
					</div>
					<div class="col-xs-9">
				  		<?php get_product_search_form(); ?>
				  	</div>
			  	</div>
			  	<div class="hidden-xs hidden-sm visible-md visible-lg">
				 	<?php get_product_search_form(); ?>
				</div>
	        </div>
	        
	        <div class="col-xs-3 col-xs-offset-0 col-sm-3 col-sm-offset-0 col-md-5 col-md-offset-4">
	          <div class="header-content">
	            <div id="header-links" class="hidden-xs hidden-sm visible-md-inline visible-lg-inline">
	            	<?php $my_account_page = get_page_by_title( 'My Account' ); ?>
	           		<?php if(is_user_logged_in()): ?>
						<a href="<?php echo get_permalink( $my_account_page->ID ); ?>" title="<?php _e('MY ACCOUNT','woothemes'); ?>"><?php _e('MY ACCOUNT','woothemes'); ?></a> 
	           		<?php else: ?>	
					 	<a href="<?php echo get_permalink( $my_account_page->ID ); ?>?action=register" title="<?php _e('JOIN','woothemes'); ?>"><?php _e('JOIN','woothemes'); ?></a> / 
					 	<a href="<?php echo get_permalink( $my_account_page->ID ); ?>" title="<?php _e('SIGN IN','woothemes'); ?>"><?php _e('SIGN IN','woothemes'); ?></a>
				 	<?php endif; ?>
	            </div>
	            <div id="header-cart-info">
	            <?php $cart_page = get_page_by_title( 'Cart' ); ?>
	              <a href="<?php echo get_permalink( $cart_page->ID ); ?>">
	                <div id="cart-icon"><img src="<?php echo IMAGES ?>/icons/cart-img.png" alt="Cart icon"><div class="white-divider"></div></div>  
	                <div id="cart-item-price" class="hidden-xs hidden-sm visible-md-inline visible-lg-inline">
	                	<?php global $woocommerce; ?>
 
						<a class="cart-contents" href="<?php echo get_permalink( $cart_page->ID ); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
						<span class="cart-items-count-label">
							<?php echo sprintf(_n('%d ITEM', '%d ITEMS', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> -
						</span>
					 	<span class="cart-price">
						 	<?php echo $woocommerce->cart->get_cart_total(); ?>
					 	</span>
						</a>
	                </div>
	               </a>
	                <div id="checkout-btn" class="hidden-xs hidden-sm visible-md-inline visible-lg-inline"><a href="<?php echo get_permalink( $cart_page->ID ); ?>">CHECK OUT</a></div>
	              
	            </div>
	          </div>
	        </div>

	      </div>
	    </header>
	  </div>
	  <div class="mobile-menu-container hidden-md hidden-lg visible-xs visible-sm">
	  	<?php
			$defaults = array(
				'echo' => true,
				'container' => false,
				'theme_location'  => 'main-menu',
				'menu_class'      => 'main-menu mobile-menu inline clearfix'
			);
			wp_nav_menu($defaults);
		?>
	  </div>
	  <div class="container-fluid" id="main-content">
	    <div class="container">
	      <div class="row">
	        <div class="col-md-12 logo-container">
	          <a href="<?php echo home_url(); ?>"><img class="img-responsive" src="<?php echo IMAGES ?>/logo/main-logo.png" alt="Lee Wee Brothers Logo" class="main-logo"></a>
	        </div>
	      </div>
	      <div class="space20"></div>
	      <div class="row hidden-xs hidden-sm visible-md visible-lg">
	        <div class="col-md-12 nav-container">
	          <hr class="nav-hr">
	          <nav class="main-nav">
				<?php

					$defaults = array(
						'echo' => true,
						'container' => false,
						'theme_location'  => 'main-menu',
						'menu_class'      => 'main-menu inline clearfix'
					);


					wp_nav_menu($defaults);
				?>
	          </nav>
	          <hr class="nav-hr">
	        </div>
	      </div>
	      <div class="space20"></div>
	    </div>
	  </div>
