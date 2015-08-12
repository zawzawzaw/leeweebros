<!-- Indicators -->
<ol class="carousel-indicators">
	<?php 
	$i = 0;
	$args = array(
		'post_type' => 'slider',
		'meta_key' => 'sort',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'place',
				'field' => 'slug',
				'terms' => 'main'
			)
		)										
	);
	$query1 = new WP_Query( $args );
	if ( $query1->have_posts() ) while ( $query1->have_posts() ) : $query1->the_post(); ?>
		<?php if(has_post_thumbnail()) : ?>
			<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i==0) ? 'active' : ''; ?>"></li>
			<?php $i++; ?>		
		<?php endif; ?>	
	<?php endwhile; ?>
</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner">
	<?php
	$i = 0;
	if ( $query1->have_posts() ) while ( $query1->have_posts() ) : $query1->the_post(); ?>
			<?php if(has_post_thumbnail()) : ?>
				<div class="<?php echo ($i==0) ? 'active' : ''; ?> item">
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<img class="slider-lazy" data-original="<?php echo $url; ?>" alt="slider">
					<div class="carousel-caption">
						<h1><?php the_title() ?></h1>
						<p class="hidden-xs hidden-sm visible-lg visible-md"><?php echo get_the_content(); ?></p>
					</div>
				</div>
				
				<?php $i++; ?>		
			<?php endif; ?>	
	<?php endwhile; ?>
</div>
	
	