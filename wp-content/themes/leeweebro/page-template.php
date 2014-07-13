<?php 
/*
Template Name: Page Template
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="content-wrapper" class="<?php echo ($post->post_name=='terms-conditions' || $post->post_name=='our-outlets' || $post->post_name=='promotions') ? 'align-left' : ''; ?>">
	<div id="breadcrumb" class="container">
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions'): ?>
		<div class="align-left-2">
		<?php endif; ?>
			<div class="row">
				<div class="col-md-12">
					<?php get_template_part( 'content', 'breadcrumb' ); ?>
				</div>
			</div>
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions'): ?>
		</div>
		<?php endif; ?>
	</div>

	<?php 
	if($post->post_parent != 0) {
	  $post_data = get_post($post->post_parent);
	  if(!isset($post_data->post_name)) {
	  	$name = $post->post_name;
	  }else {
	  	$name = $post_data->post_name;
	  }
	}
	?>

	<div id="<?php echo ($post->post_name=='terms-conditions') ? $post->post_name : $name; ?>" class="container">
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions'): ?>
		<div class="align-left-2">
		<?php endif; ?>
			<div class="space30"></div>
			<div class="row">
				<div class="col-md-12" id="page-title">
					<?php $custom_fields = get_post_custom(); 
						if(isset($custom_fields['Sub Title'])): ?>
							<h2><?php echo $custom_fields['Sub Title'][0]; ?></h2>
						<?php endif; ?>
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions'): ?>			
		</div>
		<div class="space40"></div>
		<div class="row">
			<div class="col-md-12" id="banner-img">
				<!-- <img src="images/content/banner-2.jpg" alt="banner"> -->
				<?php 
				if ( has_post_thumbnail() ) {
				  the_post_thumbnail();
				} 
				?>
			</div>
		</div>
		<div class="space30"></div>
		<?php endif; ?>
		
		<?php if($post->post_name=='promotions'): ?>
			<div class="space40"></div>
			<div class="row promo-product-content">
				<div class="col-md-12">
					<div class="promo-product-wrapper">
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
									<div class="promo-product-description">
										<h3><?php the_title(); ?></h3>
										<?php the_excerpt(); ?>
										<p class="promo-price">$<?php echo (isset($sale) && !empty($sale)) ? number_format((float)$sale, 2, '.', '') : number_format((float)$price, 2, '.', '');  ?></p>
										<p class="promo-price-2"></p>
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
		<?php else: ?>
			<?php the_content(); ?>
		<?php endif; ?>

	</div>
</div>
<div class="space50"></div>
<div class="space50"></div>
<?php endwhile; ?>

<?php get_footer(); ?>