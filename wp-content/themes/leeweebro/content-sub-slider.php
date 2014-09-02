<ul>
	<?php 
		$args = array(
		    'post_type' => 'product',  
		    'meta_key' => '_featured',  
		    'meta_value' => 'yes',  
		    'posts_per_page' => -1
		);
		// Create the new query
		$loop = new WP_Query( $args );

		// Get products number
		$product_count = $loop->post_count;

		if($product_count > 0):
			if ( $loop->have_posts() ) while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php if(has_post_thumbnail()) : ?>

					<?php 
					$product = get_product( $loop->post->ID );

			        if($product->product_type=='variable') {
			        	$product = new WC_Product_Variable( $loop->post->ID );
			        	$available_variations = $product->get_available_variations();
			        	$variation_id = $available_variations[0]['variation_id'];
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
					?>

					<li>
						<a href="<?php echo get_permalink(get_the_ID()); ?>">
							<?php //the_post_thumbnail(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
							<img class="sub-slider-lazy" data-original="<?php echo $url; ?>" alt="slider">
							<div class="caption">
								<h3><?php the_title(); ?></h3>

								<?php 
									// $sale = get_post_meta( get_the_ID(), '_sale_price', true);
									// $price = get_post_meta( get_the_ID(), '_regular_price', true);
								?>
								<p>$<?php echo (!empty($sale)) ? number_format((float)$sale, 2, '.', '') : number_format((float)$price, 2, '.', ''); ?></p>
							</div>
						</a>
					</li>
				<?php endif; ?>	
			<?php endwhile; 
		endif; ?>
</ul>