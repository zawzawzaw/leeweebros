<?php get_header(); ?>

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
				<h3>SPECIAL DEAL FOR YOU</h3>
				<h1>DEAL OF THE DAY</h1>
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

	<div id="feature-product" class="container">
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
						        $price = get_post_meta( get_the_ID(), '_regular_price', true);
						        $sale = get_post_meta( get_the_ID(), '_sale_price', true);
						?>
								<li>
									<a href="<?php echo get_permalink(get_the_ID()); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
									<div class="feature-product-description">
										<h3><?php the_title(); ?></h3>
										<p class="feature-text"><?php the_excerpt(); ?></p>
										<p class="feature-price">$<?php echo (isset($sale) && !empty($sale)) ? number_format((float)$sale, 2, '.', '') : number_format((float)$price, 2, '.', '');  ?></p>
									</div>
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
	</div>
</div>
<div class="space50"></div>

<?php get_footer(); ?>