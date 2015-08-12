<ul>
	<?php 
		$args = array( 
			'post_type' 	 => 'product', 
			'posts_per_page' => -1, 
			'product_tag' 	 => 'Best Sellers' 
		);

		// Create the new query
		$loop = new WP_Query( $args );

		// Get products number
		$product_count = $loop->post_count;

		if($product_count > 0):
			if ( $loop->have_posts() ) while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php if(has_post_thumbnail()) : ?>
					<li>
						<a href="<?php echo get_permalink(get_the_ID()); ?>">
							<?php //the_post_thumbnail(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
							<img class="sub-slider-lazy" data-original="<?php echo $url; ?>" alt="slider">
							<div class="caption">
								<h3><?php the_title(); ?></h3>
								<?php 
									$sale = get_post_meta( get_the_ID(), '_sale_price', true);
									$price = get_post_meta( get_the_ID(), '_regular_price', true);
								?>
								<p>$<?php echo (!empty($sale)) ? number_format((float)$sale, 2, '.', '') : number_format((float)$price, 2, '.', ''); ?></p>
							</div>
						</a>
					</li>
				<?php endif; ?>	
			<?php endwhile; 
		endif; ?>
</ul>