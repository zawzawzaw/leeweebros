<?php 
/*
Template Name: New Page Template
*/
?>

<?php 
get_header(); 
?>

<?php remove_filter ('the_content', 'wpautop'); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="content-wrapper" class="<?php echo ($post->post_name=='terms-conditions' || $post->post_name=='our-outlets' || $post->post_name=='promotions' || $post->post_name=='careers' || $post->post_name=='contact') ? 'align-left' : ''; ?>">
	<div id="breadcrumb" class="container">
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions' && $post->post_name!=='careers' && $post->post_name!=='contact' && $post->post_name!=='faqs'): ?>
		<div class="align-left-2">
		<?php endif; ?>
			<div class="row">
				<div class="col-md-12">
					<?php get_template_part( 'content', 'breadcrumb' ); ?>
				</div>
			</div>
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions' && $post->post_name!=='careers' && $post->post_name!=='contact' && $post->post_name!=='faqs'): ?>
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

	<div class="space50"></div>

	<div id="<?php echo ($post->post_name=='terms-conditions' || $post->post_name=='faqs') ? 'terms-conditions' : $name; ?>" class="container">
		<div class="align-left-2">
			<div class="row">
				<div class="col-md-12"><h1>RECIPES</h1></div>
			</div>
			<div class="space20"></div>
			<div class="row">
				<div class="col-md-6">
					<div id="banner-img">
						<!-- <img src="images/content/banner-2.jpg" alt="banner"> -->
						<?php 
						if ( has_post_thumbnail() ) {
						  //the_post_thumbnail();
						$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
							<img class="lazy" data-original="<?php echo $url; ?>" alt="feature image">
						<?php
						} 
						?>
					</div>
				</div>

				<div class="col-md-6">
					<?php $custom_fields = get_post_custom(); 
						if(isset($custom_fields['Sub Title'])): ?>
							<h2><?php echo $custom_fields['Sub Title'][0]; ?></h2>
						<?php endif; ?>
					<h1><?php the_title(); ?></h1>
					<div class="space20"></div>
					<?php the_content(); ?>

					<div class="space20"></div>
					&nbsp;
					<div class="space40"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="space50"></div>
<div class="space50"></div>
<?php endwhile; ?>

<?php get_footer(); ?>