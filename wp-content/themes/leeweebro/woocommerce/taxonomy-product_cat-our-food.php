<?php get_header(); ?>

<?php
$page_data = get_page_by_title( 'Our Food' );
?>
<div id="content-wrapper" class="">
	<div id="breadcrumb" class="container">
		<div class="align-left-2">
			<div class="row">
				<div class="col-md-12">
					<a href="<?php echo home_url(); ?>">Home</a> / <a href="#" class="active"><?php echo $page_data->post_title ?></a>
				</div>
			</div>
		</div>
	</div>

	<div id="our-food" class="container">
		
		<div class="align-left-2">
			<div class="space30"></div>
			<div class="row">
				<div class="col-md-12" id="page-title">
					<h1><?php echo $page_data->post_title ?></h1>
				</div>
			</div>
		</div>
		<div class="space40"></div>
		<div class="row">
			<div class="col-md-12" id="banner-img">
				<!-- <img src="images/content/banner-2.jpg" alt="banner"> -->
				<?php echo get_the_post_thumbnail($page_data->ID); ?>
			</div>
		</div>
		<div class="space30"></div>
		
		<?php echo apply_filters('the_content', $page_data->post_content); ?>

	</div>
</div>
<div class="space50"></div>
<div class="space50"></div>

<?php get_footer(); ?>