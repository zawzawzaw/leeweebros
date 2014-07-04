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
								<li><a href="#">OUR FOOD</a></li>
								<li><a href="#">CATHERING</a></li>
							</ul>
						</div>
					</div>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>
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