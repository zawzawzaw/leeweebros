<?php 
if(!empty($_POST)):
	if ( !is_user_logged_in() ) {  wp_redirect( home_url().'/my-account?cart' );  }
endif; ?> 
<?php get_header(); ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="content-wrapper" class="align-left">
			<div id="breadcrumb" class="container">
				<div class="row">
					<div class="col-md-12">
						<?php
							/**
							 * woocommerce_before_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
							 * @hooked woocommerce_breadcrumb - 20
							 */

							do_action( 'woocommerce_before_main_content' );
						?>
					</div>
				</div>
			</div>
			<div id="cart" class="container">
				<div class="space30"></div>
				<div class="row">
					<div class="col-md-12" id="page-title"><h1><?php the_title(); ?></h1></div>
				</div>
				<?php 
				global $woocommerce;
				if ( sizeof( $woocommerce->cart->cart_contents ) > 0 ): ?>
				<div class="space50"></div>
				<div class="space20"></div>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>
		</div>
		<div class="space50"></div>
		<div class="space50"></div>
	<?php endwhile; ?>
<?php get_footer(); ?>