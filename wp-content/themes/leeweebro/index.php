<?php get_header();
global $woocommerce;
?>

<div id="content-wrapper">
	<div id="main-slider" class="container">
		<div class="row">
			<div id="myCarousel" class="col-md-12 carousel slide" data-ride="carousel">
				<?php get_template_part( 'content', 'slider' ); ?>
			</div>
		</div>
	</div>

	<div class="space50"></div>
	<div class="space20"></div>

	<div id="special-deal" class="container">
		<div class="row">
			<div class="col-md-12" id="header-text">
				<h3>SOME SPECIAL PRODUCTS FOR YOU</h3>
				<h1>FEATURED PRODUCTS</h1>
			</div>
		</div>
		<div class="space20"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="jcarousel-wrapper">
					<div class="jcarousel" data-jcarousel="true">
					    <?php get_template_part('content', 'sub-slider'); ?>
					</div>
					<a href="#" class="jcarousel-control-prev" data-jcarouselcontrol="true"></a>
					<a href="#" class="jcarousel-control-next" data-jcarouselcontrol="true"></a>
					<hr class="separator">
				</div>
			</div>			
		</div>
	</div>

	<div class="space50"></div>
	<div class="space20"></div>

	<!-- <div id="feature-product" class="container">
		<div class="row">
			<div class="col-md-12" id="header-text">
				<h3>SOME SPECIAL PRODUCTS FOR YOU</h3>
				<h1>FEATURED PRODUCTS</h1>
			</div>
		</div>
		<div class="space20"></div>
		<div class="row feature-product-content">
			<div class="col-md-12">
				<div class="feature-product-wrapper">
					<ul>
						<?php 
						$args = array(
						    'post_type' => 'product',  
						    'meta_key' => '_featured',  
						    'meta_value' => 'yes',  
						    'posts_per_page' => -1  
						);
						  
						$featured_query = new WP_Query( $args );
						      
						if ($featured_query->have_posts()) :   
						  
						    while ($featured_query->have_posts()) :   
						      
						        $featured_query->the_post();
						          
						        $product = get_product( $featured_query->post->ID );

						        if($product->product_type=='variable') {
						        	$product = new WC_Product_Variable( $featured_query->post->ID );
						        	$available_variations = $product->get_available_variations();
						        	$variation_id=$available_variations[0]['variation_id'];
						        	$variable_product1= new WC_Product_Variation( $variation_id );
						        	$price = $variable_product1 ->regular_price;
									$sale = $variable_product1 ->sale_price;

						        }else {
							        $price = get_post_meta( get_the_ID(), '_regular_price', true);
							        $sale = get_post_meta( get_the_ID(), '_sale_price', true);
						        }

						        $attributes = $product->get_attributes();


						        foreach ($attributes as $key => $att) {
						        	if (strpos($att['value'],'|') !== false) {
						        		$att_pa = $att['name'];
						        		$att_value_arr = explode('|', $att['value']);
						        		$att_value = trim($att_value_arr[0]);
						        	}
						        }

						        // print_r($attributes);
						?>
								<li>
									<a href="<?php echo get_permalink(get_the_ID()); ?>">
										<?php //the_post_thumbnail(); ?>
										<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
										<img class="lazy" data-original="<?php echo $url; ?>" alt="feature image">
									
										<div class="feature-product-description">
											<h3><?php the_title(); ?></h3>
											<?php
											$my_excerpt = the_excerpt_max_charlength(120);

											if ( $my_excerpt != '' ) {
												$custom_excerpt = explode('<br>',$my_excerpt);

											} ?>
											<p class="feature-text"><?php echo $custom_excerpt[0]; ?></p>
											
											<div class="row cta">
												<div class="col-md-6">
													<p class="feature-price">$<?php echo (isset($sale) && !empty($sale)) ? number_format((float)$sale, 2, '.', '') : number_format((float)$price, 2, '.', '');  ?></p>
													<p class="feature-price-2"><?php echo (isset($attributes['per']['value'])) ? $attributes['per']['value'] : ''; ?></p>
												</div>
												<?php if($product->product_type=='variable'): 
												$cart_url = $woocommerce->cart->get_cart_url();
												?>
												<div class="col-md-6"><a href="<?php echo $cart_url; ?>?add-to-cart=<?php echo $product->id; ?>&variation_id=<?php echo $variation_id; ?>&attribute_<?php echo strtolower($att_pa); ?>=<?php echo strtolower($att_value); ?>" class="button add-to-cart">Add to cart</a></div>
												<?php else: ?>
												<div class="col-md-6"><a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="button add-to-cart">Add to cart</a></div>
												<?php endif; ?>
											</div>
											
										</div>
									</a>
								</li>
						<?php        
						    endwhile;
						      
						endif;
						  
						wp_reset_query(); // Remember to reset  
						?>
					</ul>			
				</div>
			</div>
		</div>
	</div> -->
</div>
<div class="space50"></div>

<?php get_footer(); ?>