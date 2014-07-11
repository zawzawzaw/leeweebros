<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>
	<div class="space10"></div>
	<div id="content-wrapper" class="align-left">
		<div id="all">
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
						<div class="row">
							<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

							<div class="col-md-2" id="page-title">
								<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
							</div>

							<?php endif; ?>

							<div class="col-md-4 col-md-offset-6" id="sort-controls">
								<?php do_action( 'woocommerce_archive_description' ); ?>

								<?php
									/**
									 * woocommerce_before_shop_loop hook
									 *
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									do_action( 'woocommerce_before_shop_loop_custom' );
								?>
							</div>
						</div>
						<hr class="">
						<div class="space10"></div>
						<?php if ( have_posts() ) : ?>

							<?php //woocommerce_product_loop_start(); ?>

								<?php //woocommerce_product_subcategories(); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php //woocommerce_product_loop_end(); ?>
						<hr>
						<div class="row">
							<div class="col-md-3">
							<?php
								/**
								 * woocommerce_after_shop_loop hook
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>
							</div>
							<div class="col-md-4 col-md-offset-5">
							<?php
								/**
								 * woocommerce_after_shop_loop_custom hook
								 *
								 * @hooked woocommerce_result_count - 10
								 */
								do_action( 'woocommerce_after_shop_loop_custom' );
							?>
							</div>
						</div>
						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>
						
					</div><!-- end col-md-9 -->
				</div><!-- end row -->
			</div><!-- end container -->
		</div><!-- end all -->
	</div><!-- end content -->

	<div class="space50"></div>
	<div class="space50"></div>

	<!--<script type="text/javascript" src="<?php echo LIB ?>/bootstrap/dist/js/bootstrap.min.js"></script>-->

<?php get_footer( 'shop' ); ?>