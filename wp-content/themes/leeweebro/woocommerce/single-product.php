<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<div class="space10"></div>
	<div id="content-wrapper" class="align-left">
		<div id="individual">
			<div id="breadcrumb" class="container">
				<div class="row">
					<div class="col-md-3">
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
						<div class="row">
							<div class="col-md-12"><div class="space26"></div></div>
						</div>
						<div class="row">
							<ul class="side-menu">
								<li class="active">
									<a class="parent-side-menu-item" href="javascript:void(0);" data-toggle="collapse" data-target="#ourfood">OUR FOOD</a>
									<?php 
										// Set up the objects needed
										$my_wp_query = new WP_Query();
										$all_wp_pages = $my_wp_query->query(array('post_type' => 'page','posts_per_page' => -1));
										$our_food_page = get_page_by_title( 'Our Food' );
		          						$catering_page = get_page_by_title( 'Catering' ); 
		          						// Filter through all pages and find Portfolio's children
										$our_food_children = get_page_children( $our_food_page->ID, $all_wp_pages );
										$catering_children = get_page_children( $catering_page->ID, $all_wp_pages );
	          						?>
									<div id="ourfood" class="collapse in">
										<ul class="side-sub-menu">
											<?php foreach ($our_food_children as $key => $child) { ?>
												<li><a href="<?php echo get_permalink( $child->ID ); ?>"><?php echo $child->post_title; ?></a></li>	
											<?php } ?>
										</ul>
									</div>
								</li>
								<li>
									<a class="parent-side-menu-item" href="javascript:void(0);" data-toggle="collapse" data-target="#cathering">CATHERING</a>
									<div id="cathering" class="collapse">
										<ul class="side-sub-menu">
											<?php foreach ($catering_children as $key => $child) { ?>
												<li><a href="<?php echo get_permalink( $child->ID ); ?>"><?php echo $child->post_title; ?></a></li>	
											<?php } ?>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-9">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>
					</div>
					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						// do_action( 'woocommerce_after_main_content' );
					?>

					<?php
						/**
						 * woocommerce_sidebar hook
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						// do_action( 'woocommerce_sidebar' );
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="space50"></div>
	<div class="space50"></div>

<?php get_footer( 'shop' ); ?>