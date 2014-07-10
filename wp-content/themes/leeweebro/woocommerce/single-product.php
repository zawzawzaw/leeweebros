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
									<a href="javascript:void(0);" data-toggle="collapse" data-target="#ourfood">OUR FOOD</a>
									<div id="ourfood" class="collapse in">
										<ul class="side-sub-menu">
											<li>Otah</li>
											<li>Lunch Boxes</li>
											<li>Satay</li>
											<li>Snack & Nibbles</li>
											<li>Local Flavors</li>
											<li>Condiments</li>
										</ul>
									</div>
								</li>
								<li>
									<a href="javascript:void(0);" data-toggle="collapse" data-target="#cathering">CATHERING</a>
									<div id="cathering" class="collapse">
										<ul class="side-sub-menu">
											<li>Mini Buffet</li>
											<li>Others</li>
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